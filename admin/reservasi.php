<?php
session_start();
require_once '../config/koneksi.php';

$updateMsg = '';

// Handle status update POST
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_status'])) {
    $idRes    = intval($_POST['id_reservasi'] ?? 0);
    $newStatus = $_POST['new_status'] ?? '';
    $allowed   = ['pending', 'checkin', 'checkout'];

    if ($idRes > 0 && in_array($newStatus, $allowed, true)) {
        $stmtUpd = $koneksi->prepare(
            "UPDATE reservasi SET status = ? WHERE id_reservasi = ?"
        );
        $stmtUpd->bind_param('si', $newStatus, $idRes);
        if ($stmtUpd->execute()) {
            // If checking out, free the room again
            if ($newStatus === 'checkout') {
                $stmtFree = $koneksi->prepare(
                    "UPDATE kamar k
                     JOIN reservasi r ON r.id_kamar = k.id_kamar
                     SET k.status = 'tersedia'
                     WHERE r.id_reservasi = ?"
                );
                $stmtFree->bind_param('i', $idRes);
                $stmtFree->execute();
            }
            $updateMsg = 'success';
        } else {
            $updateMsg = 'error';
        }
    }
}

// Fetch all reservations with guest and room info
$result = $koneksi->query(
    "SELECT r.id_reservasi, r.check_in, r.check_out, r.total_harga, r.status, r.created_at,
            u.nama, u.email,
            k.tipe_kamar, k.nomor_kamar
     FROM reservasi r
     JOIN users u  ON r.id_user  = u.id_user
     JOIN kamar k  ON r.id_kamar = k.id_kamar
     ORDER BY r.created_at DESC"
);
$reservations = $result ? $result->fetch_all(MYSQLI_ASSOC) : [];
$totalRes = count($reservations);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Reservations - Almaris Admin</title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --primary: #0F172A;
            --accent: #D4AF37;
            --bg-main: #F3F4F6;
            --bg-white: #FFFFFF;
            --text-main: #333333;
            --text-muted: #6B7280;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--bg-main);
            color: var(--text-main);
        }

        h1, h2, h3, h4, h5, h6, .brand-text {
            font-family: 'Montserrat', sans-serif;
        }

        /* Sidebar Styling */
        #sidebar {
            width: 260px;
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            background-color: var(--primary);
            color: var(--bg-white);
            z-index: 1000;
            transition: all 0.3s;
        }

        .sidebar-header {
            padding: 24px;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }

        .sidebar-header .brand-text {
            color: var(--accent);
            font-weight: 700;
            font-size: 1.5rem;
            letter-spacing: 1px;
        }

        .nav-menu {
            padding: 20px 0;
        }

        .nav-item {
            padding: 12px 24px;
            color: rgba(255,255,255,0.7);
            display: flex;
            align-items: center;
            text-decoration: none;
            transition: 0.3s;
        }

        .nav-item:hover, .nav-item.active {
            color: var(--bg-white);
            background-color: rgba(212, 175, 55, 0.1);
            border-right: 4px solid var(--accent);
        }

        .nav-item i {
            width: 24px;
            margin-right: 12px;
            font-size: 1.1rem;
            color: var(--accent);
        }

        /* Main Content */
        #main-content {
            margin-left: 260px;
            padding: 30px;
        }

        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .page-title {
            font-size: 1.75rem;
            font-weight: 600;
            color: var(--primary);
            margin: 0;
        }

        /* Cards */
        .modern-card {
            background: var(--bg-white);
            border-radius: 16px;
            border: none;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03);
            padding: 24px;
            margin-bottom: 24px;
            height: 100%;
        }

        /* Table Styling */
        .table-responsive {
            border-radius: 12px;
            overflow: hidden;
        }

        .table {
            margin-bottom: 0;
        }

        .table thead th {
            background-color: #F8F9FA;
            color: var(--primary);
            font-weight: 600;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border-bottom: 2px solid #E5E7EB;
            padding: 16px;
        }

        .table tbody td {
            padding: 16px;
            vertical-align: middle;
            border-bottom: 1px solid #E5E7EB;
            color: var(--text-main);
            font-size: 0.95rem;
        }

        .status-badge {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 500;
        }

        .status-pending { background-color: #FEF3C7; color: #92400E; }
        .status-checkin { background-color: #D1FAE5; color: #065F46; }
        .status-checkout { background-color: #E5E7EB; color: #4B5563; }
    </style>
</head>
<body>

    <!-- Sidebar -->
    <nav id="sidebar">
        <div class="sidebar-header">
            <div class="brand-text">ALMARIS</div>
            <small style="color: rgba(255,255,255,0.5);">Admin Dashboard</small>
        </div>
        <div class="nav-menu">
            <a href="dashboard.php" class="nav-item">
                <i class="fas fa-home"></i> Dashboard
            </a>
            <a href="kamar.php" class="nav-item">
                <i class="fas fa-bed"></i> Manage Rooms
            </a>
            <a href="reservasi.php" class="nav-item active">
                <i class="fas fa-calendar-alt"></i> Reservations
            </a>
            <a href="user.php" class="nav-item">
                <i class="fas fa-users"></i> Manage Users
            </a>
            <a href="laporan.php" class="nav-item">
                <i class="fas fa-chart-line"></i> Reports
            </a>
            <a href="../logout.php" class="nav-item mt-5 text-danger">
                <i class="fas fa-sign-out-alt text-danger"></i> Logout
            </a>
        </div>
    </nav>

    <!-- Main Content -->
    <main id="main-content">
        <div class="page-header">
            <div>
                <h1 class="page-title">Manage Reservations</h1>
                <p class="text-muted mb-0">View and update guest reservations. Total: <strong><?= $totalRes ?></strong> bookings.</p>
            </div>
            <div class="user-profile d-flex align-items-center">
                <div class="text-end me-3">
                    <div class="fw-bold" style="font-size: 0.9rem; color: var(--primary);">Admin User</div>
                    <div class="text-muted" style="font-size: 0.75rem;">admin@almaris.com</div>
                </div>
                <div style="width: 40px; height: 40px; border-radius: 50%; background-color: var(--primary); color: var(--accent); display: flex; align-items: center; justify-content: center; font-weight: bold;">
                    A
                </div>
            </div>
        </div>

        <?php if ($updateMsg === 'success'): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                Status updated successfully!
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php elseif ($updateMsg === 'error'): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                Failed to update status.
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <div class="modern-card">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Booking ID</th>
                            <th>Guest Info</th>
                            <th>Room Info</th>
                            <th>Dates</th>
                            <th>Total Price</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($reservations)): ?>
                            <tr>
                                <td colspan="7" class="text-center py-5 text-muted">
                                    <i class="fas fa-inbox fs-1 mb-3 text-light"></i>
                                    <br>No reservations found.
                                </td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($reservations as $res): ?>
                                <tr>
                                    <td class="fw-bold">#<?= htmlspecialchars($res['id_reservasi']) ?></td>
                                    <td>
                                        <div class="fw-bold text-dark"><?= htmlspecialchars($res['nama']) ?></div>
                                        <div class="small text-muted"><?= htmlspecialchars($res['email']) ?></div>
                                    </td>
                                    <td>
                                        <div class="fw-bold"><?= htmlspecialchars($res['tipe_kamar']) ?></div>
                                        <div class="small text-muted">Room <?= htmlspecialchars($res['nomor_kamar']) ?></div>
                                    </td>
                                    <td>
                                        <div><i class="fas fa-sign-in-alt text-success me-1"></i> <?= htmlspecialchars($res['check_in']) ?></div>
                                        <div><i class="fas fa-sign-out-alt text-danger me-1"></i> <?= htmlspecialchars($res['check_out']) ?></div>
                                    </td>
                                    <td class="fw-bold text-success">
                                        Rp <?= number_format($res['total_harga'], 0, ',', '.') ?>
                                    </td>
                                    <td>
                                        <?php
                                            $badgeClass = 'status-pending';
                                            if ($res['status'] === 'checkin') $badgeClass = 'status-checkin';
                                            if ($res['status'] === 'checkout') $badgeClass = 'status-checkout';
                                        ?>
                                        <span class="status-badge <?= $badgeClass ?>"><?= ucfirst(htmlspecialchars($res['status'])) ?></span>
                                    </td>
                                    <td>
                                        <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#editStatusModal" data-id="<?= $res['id_reservasi'] ?>" data-status="<?= htmlspecialchars($res['status']) ?>">
                                            <i class="fas fa-edit"></i> Edit
                                        </button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <!-- Edit Status Modal -->
    <div class="modal fade" id="editStatusModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow">
                <div class="modal-header border-bottom-0 pb-0">
                    <h5 class="modal-title fw-bold text-primary">Update Booking <span id="modalBookingId"></span></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form action="reservasi.php" method="POST" id="updateStatusForm">
                        <input type="hidden" name="update_status" value="1">
                        <input type="hidden" name="id_reservasi" id="inputIdReservasi" value="">
                        
                        <div class="mb-4">
                            <label class="form-label text-muted fs-7 text-uppercase fw-semibold mb-2">Reservation Status</label>
                            <select class="form-select" name="new_status" id="reservationStatus">
                                <option value="pending">Pending</option>
                                <option value="checkin">Check In</option>
                                <option value="checkout">Check Out</option>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer border-top-0 pt-0 pb-4 px-4">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" form="updateStatusForm" class="btn btn-dark px-4" style="background-color: var(--primary);">Save Changes</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Script to populate modal -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const editStatusModal = document.getElementById('editStatusModal');
            if (editStatusModal) {
                editStatusModal.addEventListener('show.bs.modal', function (event) {
                    const button = event.relatedTarget;
                    const bookingId = button.getAttribute('data-id');
                    const status = button.getAttribute('data-status');
                    
                    editStatusModal.querySelector('#modalBookingId').textContent = '#' + bookingId;
                    editStatusModal.querySelector('#inputIdReservasi').value = bookingId;
                    editStatusModal.querySelector('#reservationStatus').value = status;
                });
            }
        });
    </script>
</body>
</html>
