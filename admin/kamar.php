<?php
session_start();
require_once '../config/koneksi.php';

// Auth Guard
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../login.php");
    exit;
}

$adminName = $_SESSION['nama'] ?? 'Admin';
$adminId = $_SESSION['user_id'];
$queryAdmin = $koneksi->query("SELECT email FROM users WHERE id_user = $adminId");
$adminEmail = $queryAdmin->fetch_assoc()['email'] ?? 'admin@almaris.com';

$alert = '';
if (isset($_SESSION['alert'])) {
    $alert = $_SESSION['alert'];
    unset($_SESSION['alert']);
}

// Handle Delete
if (isset($_GET['delete'])) {
    $id_kamar = (int)$_GET['delete'];
    
    // Get old photo to delete file
    $qFoto = $koneksi->query("SELECT foto FROM kamar WHERE id_kamar = $id_kamar");
    if ($qFoto && $qFoto->num_rows > 0) {
        $foto = $qFoto->fetch_assoc()['foto'];
        if ($foto && file_exists("../assets/images/" . $foto)) {
            unlink("../assets/images/" . $foto);
        }
    }
    
    $stmt = $koneksi->prepare("DELETE FROM kamar WHERE id_kamar = ?");
    $stmt->bind_param("i", $id_kamar);
    if ($stmt->execute()) {
        $_SESSION['alert'] = "Swal.fire('Deleted!', 'Room has been deleted successfully.', 'success');";
    } else {
        $_SESSION['alert'] = "Swal.fire('Error!', 'Failed to delete room.', 'error');";
    }
    $stmt->close();
    header("Location: kamar.php");
    exit;
}

// Handle Add/Edit Room
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nomor_kamar = $_POST['nomor_kamar'] ?? '';
    $tipe_kamar = $_POST['tipe_kamar'] ?? '';
    $harga = $_POST['harga'] ?? 0;
    $status = $_POST['status'] ?? 'tersedia';
    $action = $_POST['action'] ?? '';
    
    // Photo upload handling
    $foto = '';
    $fotoPath = '';
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
        $tmp = $_FILES['foto']['tmp_name'];
        $ext = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);
        $foto = "room_" . time() . "_" . rand(1000,9999) . "." . $ext;
        $fotoPath = "../assets/images/" . $foto;
        move_uploaded_file($tmp, $fotoPath);
    }
    
    if ($action === 'add') {
        $stmt = $koneksi->prepare("INSERT INTO kamar (nomor_kamar, tipe_kamar, harga, status, foto) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("ssiss", $nomor_kamar, $tipe_kamar, $harga, $status, $foto);
        if ($stmt->execute()) {
            $_SESSION['alert'] = "Swal.fire('Success!', 'Room added successfully.', 'success');";
        } else {
            $_SESSION['alert'] = "Swal.fire('Error!', 'Failed to add room. Perhaps a duplicate room number?', 'error');";
        }
        $stmt->close();
    } elseif ($action === 'edit') {
        $id_kamar = (int)$_POST['id_kamar'];
        if ($foto !== '') {
            // Get old photo to delete
            $qFoto = $koneksi->query("SELECT foto FROM kamar WHERE id_kamar = $id_kamar");
            if ($qFoto && $qFoto->num_rows > 0) {
                $oldFoto = $qFoto->fetch_assoc()['foto'];
                if ($oldFoto && file_exists("../assets/images/" . $oldFoto)) {
                    unlink("../assets/images/" . $oldFoto);
                }
            }
            $stmt = $koneksi->prepare("UPDATE kamar SET nomor_kamar=?, tipe_kamar=?, harga=?, status=?, foto=? WHERE id_kamar=?");
            $stmt->bind_param("ssissi", $nomor_kamar, $tipe_kamar, $harga, $status, $foto, $id_kamar);
        } else {
            $stmt = $koneksi->prepare("UPDATE kamar SET nomor_kamar=?, tipe_kamar=?, harga=?, status=? WHERE id_kamar=?");
            $stmt->bind_param("ssisi", $nomor_kamar, $tipe_kamar, $harga, $status, $id_kamar);
        }
        
        if ($stmt->execute()) {
            $_SESSION['alert'] = "Swal.fire('Success!', 'Room updated successfully.', 'success');";
        } else {
            $_SESSION['alert'] = "Swal.fire('Error!', 'Failed to update room.', 'error');";
        }
        $stmt->close();
    }
    header("Location: kamar.php");
    exit;
}

// Fetch all rooms
$queryKamar = $koneksi->query("SELECT * FROM kamar ORDER BY created_at DESC");
$rooms = $queryKamar->fetch_all(MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Rooms - Almaris Admin</title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
        }

        /* Buttons */
        .btn-accent {
            background-color: var(--accent);
            color: var(--primary);
            font-weight: 500;
            border: none;
            border-radius: 8px;
            padding: 10px 20px;
            transition: all 0.3s ease;
        }

        .btn-accent:hover {
            background-color: #c19f30;
            color: var(--primary);
            transform: translateY(-1px);
        }
        
        .btn-outline-primary {
            color: var(--primary);
            border-color: var(--primary);
            border-radius: 8px;
        }
        
        .btn-outline-primary:hover {
            background-color: var(--primary);
            color: var(--bg-white);
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

        .room-img-thumb {
            width: 80px;
            height: 60px;
            object-fit: cover;
            border-radius: 8px;
        }

        .status-badge {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 500;
        }

        .status-tersedia {
            background-color: #D1FAE5;
            color: #065F46;
        }

        .status-dipesan {
            background-color: #FEE2E2;
            color: #991B1B;
        }

        .action-btn {
            width: 32px;
            height: 32px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 8px;
            border: none;
            transition: 0.2s;
            margin-right: 5px;
        }

        .btn-edit { background-color: #DBEAFE; color: #1E40AF; }
        .btn-edit:hover { background-color: #BFDBFE; }
        
        .btn-delete { background-color: #FEE2E2; color: #991B1B; }
        .btn-delete:hover { background-color: #FECACA; }

        /* Form Modal */
        .modal-content {
            border-radius: 16px;
            border: none;
        }
        
        .modal-header {
            border-bottom: 1px solid #E5E7EB;
            padding: 20px 24px;
        }
        
        .modal-body {
            padding: 24px;
        }
        
        .modal-footer {
            border-top: 1px solid #E5E7EB;
            padding: 16px 24px;
        }

        .form-control, .form-select {
            border-radius: 8px;
            padding: 12px 16px;
            border: 1px solid #D1D5DB;
        }
        
        .form-control:focus, .form-select:focus {
            border-color: var(--accent);
            box-shadow: 0 0 0 0.25rem rgba(212, 175, 55, 0.25);
        }

        .form-label {
            font-weight: 500;
            color: var(--primary);
            font-size: 0.9rem;
        }
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
            <a href="kamar.php" class="nav-item active">
                <i class="fas fa-bed"></i> Manage Rooms
            </a>
            <a href="reservasi.php" class="nav-item">
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
                <h1 class="page-title">Manage Rooms</h1>
                <p class="text-muted mb-0">Add, edit, or remove hotel rooms.</p>
            </div>
            <div class="user-profile d-flex align-items-center">
                <div class="text-end me-3">
                    <div class="fw-bold" style="font-size: 0.9rem; color: var(--primary);"><?= htmlspecialchars($adminName) ?></div>
                    <div class="text-muted" style="font-size: 0.75rem;"><?= htmlspecialchars($adminEmail) ?></div>
                </div>
                <div style="width: 40px; height: 40px; border-radius: 50%; background-color: var(--primary); color: var(--accent); display: flex; align-items: center; justify-content: center; font-weight: bold;">
                    <?= strtoupper(substr($adminName, 0, 1)) ?>
                </div>
            </div>
        </div>

        <div class="modern-card">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h5 class="mb-0" style="color: var(--primary); font-weight: 600;">Room List</h5>
                <button class="btn btn-accent" data-bs-toggle="modal" data-bs-target="#addRoomModal">
                    <i class="fas fa-plus me-2"></i> Add New Room
                </button>
            </div>

            <!-- Search and Filter (UI only) -->
            <div class="row mb-4">
                <div class="col-md-4">
                    <div class="input-group">
                        <span class="input-group-text bg-white" style="border-right: none;"><i class="fas fa-search text-muted"></i></span>
                        <input type="text" class="form-control border-start-0 ps-0" placeholder="Search room number or type...">
                    </div>
                </div>
                <div class="col-md-3">
                    <select class="form-select">
                        <option value="">All Status</option>
                        <option value="tersedia">Tersedia</option>
                        <option value="dipesan">Dipesan</option>
                    </select>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th width="80">Photo</th>
                            <th>Room No.</th>
                            <th>Type</th>
                            <th>Price / Night</th>
                            <th>Status</th>
                            <th width="120" class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($rooms)): ?>
                            <tr>
                                <td colspan="6" class="text-center py-4 text-muted">No rooms found.</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($rooms as $room): ?>
                            <tr>
                                <td>
                                    <?php if (!empty($room['foto']) && file_exists("../assets/images/" . $room['foto'])): ?>
                                        <img src="../assets/images/<?= htmlspecialchars($room['foto']) ?>" alt="Room <?= htmlspecialchars($room['nomor_kamar']) ?>" class="room-img-thumb">
                                    <?php else: ?>
                                        <div class="bg-light d-flex align-items-center justify-content-center room-img-thumb">
                                            <i class="fas fa-image text-muted"></i>
                                        </div>
                                    <?php endif; ?>
                                </td>
                                <td><span class="fw-bold"><?= htmlspecialchars($room['nomor_kamar']) ?></span></td>
                                <td><?= htmlspecialchars($room['tipe_kamar']) ?></td>
                                <td>Rp <?= number_format($room['harga'], 0, ',', '.') ?></td>
                                <td><span class="status-badge status-<?= $room['status'] === 'tersedia' ? 'tersedia' : 'dipesan' ?>"><?= ucfirst(htmlspecialchars($room['status'])) ?></span></td>
                                <td class="text-center">
                                    <button class="action-btn btn-edit" data-bs-toggle="modal" data-bs-target="#editRoomModal" 
                                        data-id="<?= $room['id_kamar'] ?>"
                                        data-nomor="<?= htmlspecialchars($room['nomor_kamar']) ?>"
                                        data-tipe="<?= htmlspecialchars($room['tipe_kamar']) ?>"
                                        data-harga="<?= $room['harga'] ?>"
                                        data-status="<?= $room['status'] ?>"
                                        data-foto="<?= htmlspecialchars($room['foto'] ?? '') ?>"
                                        title="Edit">
                                        <i class="fas fa-pen"></i>
                                    </button>
                                    <button class="action-btn btn-delete" onclick="confirmDelete(<?= $room['id_kamar'] ?>)" title="Delete">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination (UI only) -->
            <div class="d-flex justify-content-between align-items-center mt-4 pt-3 border-top">
                <span class="text-muted" style="font-size: 0.85rem;">Showing 1 to 4 of 24 entries</span>
                <nav>
                    <ul class="pagination pagination-sm mb-0">
                        <li class="page-item disabled"><a class="page-link" href="#">Previous</a></li>
                        <li class="page-item active"><a class="page-link" href="#" style="background-color: var(--primary); border-color: var(--primary);">1</a></li>
                        <li class="page-item"><a class="page-link" href="#" style="color: var(--primary);">2</a></li>
                        <li class="page-item"><a class="page-link" href="#" style="color: var(--primary);">3</a></li>
                        <li class="page-item"><a class="page-link" href="#" style="color: var(--primary);">Next</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </main>

    <!-- Add Room Modal -->
    <div class="modal fade" id="addRoomModal" tabindex="-1" aria-labelledby="addRoomModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addRoomModalLabel" style="color: var(--primary); font-weight: 600;">Add New Room</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="kamar.php" method="POST" enctype="multipart/form-data" id="addRoomForm">
                        <input type="hidden" name="action" value="add">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Room Number</label>
                                <input type="text" name="nomor_kamar" class="form-control" placeholder="e.g. 101" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Room Type</label>
                                <select name="tipe_kamar" class="form-select" required>
                                    <option value="" disabled selected>Select type</option>
                                    <option value="Deluxe Room">Deluxe Room</option>
                                    <option value="Executive Suite">Executive Suite</option>
                                    <option value="Presidential Room">Presidential Room</option>
                                </select>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Price per Night (Rp)</label>
                            <input type="number" name="harga" class="form-control" placeholder="e.g. 500000" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Status</label>
                            <select name="status" class="form-select" required>
                                <option value="tersedia" selected>Tersedia</option>
                                <option value="dipesan">Dipesan</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Room Photo</label>
                            <input type="file" name="foto" class="form-control" accept="image/*">
                            <div class="form-text text-muted" style="font-size: 0.8rem;">Max file size 2MB. Recommended resolution 800x600.</div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal" style="border-radius: 8px;">Cancel</button>
                    <button type="submit" form="addRoomForm" class="btn btn-accent">Save Room</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Room Modal (Identical Structure for Demo) -->
    <div class="modal fade" id="editRoomModal" tabindex="-1" aria-labelledby="editRoomModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editRoomModalLabel" style="color: var(--primary); font-weight: 600;">Edit Room</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="kamar.php" method="POST" enctype="multipart/form-data" id="editRoomForm">
                        <input type="hidden" name="action" value="edit">
                        <input type="hidden" name="id_kamar" id="edit_id_kamar">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Room Number</label>
                                <input type="text" name="nomor_kamar" id="edit_nomor_kamar" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Room Type</label>
                                <select name="tipe_kamar" id="edit_tipe_kamar" class="form-select" required>
                                    <option value="Deluxe Room">Deluxe Room</option>
                                    <option value="Executive Suite">Executive Suite</option>
                                    <option value="Presidential Room">Presidential Room</option>
                                    <option value="Standard">Standard</option>
                                    <option value="Deluxe">Deluxe</option>
                                    <option value="Suite">Suite</option>
                                    <option value="Presidential">Presidential</option>
                                </select>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Price per Night (Rp)</label>
                            <input type="number" name="harga" id="edit_harga" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Status</label>
                            <select name="status" id="edit_status" class="form-select" required>
                                <option value="tersedia">Tersedia</option>
                                <option value="dipesan">Dipesan</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Update Photo</label>
                            <input type="file" name="foto" class="form-control" accept="image/*">
                            <div class="mt-2" id="edit_photo_preview_container" style="display:none;">
                                <span class="d-block text-muted" style="font-size: 0.8rem; margin-bottom: 5px;">Current Photo:</span>
                                <img src="" id="edit_photo_preview" alt="Current Photo" class="room-img-thumb" style="width: 120px; height: 80px; object-fit: cover;">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal" style="border-radius: 8px;">Cancel</button>
                    <button type="submit" form="editRoomForm" class="btn btn-accent">Update Room</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Populate edit modal
        document.addEventListener('DOMContentLoaded', function() {
            var editModal = document.getElementById('editRoomModal');
            if(editModal) {
                editModal.addEventListener('show.bs.modal', function (event) {
                    var button = event.relatedTarget;
                    var id = button.getAttribute('data-id');
                    var nomor = button.getAttribute('data-nomor');
                    var tipe = button.getAttribute('data-tipe');
                    var harga = button.getAttribute('data-harga');
                    var status = button.getAttribute('data-status');
                    var foto = button.getAttribute('data-foto');

                    document.getElementById('edit_id_kamar').value = id;
                    document.getElementById('edit_nomor_kamar').value = nomor;
                    
                    var typeSelect = document.getElementById('edit_tipe_kamar');
                    // Add option if not exists
                    var exists = false;
                    for(var i = 0; i < typeSelect.options.length; i++) {
                        if(typeSelect.options[i].value === tipe) { exists = true; break; }
                    }
                    if(!exists && tipe) {
                        var opt = document.createElement('option');
                        opt.value = tipe;
                        opt.innerHTML = tipe;
                        typeSelect.appendChild(opt);
                    }
                    typeSelect.value = tipe;
                    
                    document.getElementById('edit_harga').value = harga;
                    document.getElementById('edit_status').value = status;

                    var previewContainer = document.getElementById('edit_photo_preview_container');
                    var previewImg = document.getElementById('edit_photo_preview');
                    if (foto) {
                        previewImg.src = "../assets/images/" + foto;
                        previewContainer.style.display = 'block';
                    } else {
                        previewContainer.style.display = 'none';
                    }
                });
            }

            // Show SweetAlert if session alert exists
            <?php if (!empty($alert)): ?>
                <?= $alert ?>
            <?php endif; ?>
        });

        // SweetAlert Delete Confirmation
        function confirmDelete(id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this! This action will remove the room permanently.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#991B1B',
                cancelButtonColor: '#6B7280',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'kamar.php?delete=' + id;
                }
            })
        }
    </script>
</body>
</html>
