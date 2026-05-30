<?php
session_start();
require_once '../config/koneksi.php';

$userId   = $_SESSION['user_id'] ?? 0;
$userName = htmlspecialchars($_SESSION['nama'] ?? 'User');
$userInitials = strtoupper(mb_substr($userName, 0, 2));

// Fetch all reservations for this user with room details
$stmtRes = $koneksi->prepare(
    "SELECT r.id_reservasi, r.check_in, r.check_out, r.total_harga, r.status, r.created_at,
            k.tipe_kamar, k.nomor_kamar
     FROM reservasi r
     JOIN kamar k ON r.id_kamar = k.id_kamar
     WHERE r.id_user = ?
     ORDER BY r.created_at DESC"
);
$stmtRes->bind_param('i', $userId);
$stmtRes->execute();
$reservations = $stmtRes->get_result()->fetch_all(MYSQLI_ASSOC);

$totalBookings  = count($reservations);
$activeBookings = count(array_filter($reservations, fn($r) => in_array($r['status'], ['pending','checkin'])));

// Room image map by tipe_kamar
$roomImages = [
    'Deluxe Ocean View'   => 'https://images.unsplash.com/photo-1611892440504-42a792e24d32?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
    'Executive Suite'     => 'https://images.unsplash.com/photo-1590490360182-c33d57733427?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
    'Presidential Suite'  => 'https://images.unsplash.com/photo-1582719508461-905c673771fd?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
    'Standard City View'  => 'https://images.unsplash.com/photo-1578683010236-d716f9a3f461?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
    'Family Suite'        => 'https://images.unsplash.com/photo-1631049307264-da0ec9d70304?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
    'Honeymoon Suite'     => 'https://images.unsplash.com/photo-1566665797739-1674de7a421a?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80'
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking History | Almaris Hotel</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <!-- Custom Styles -->
    <link href="../assets/css/styles.css" rel="stylesheet">
    <style>
        body { background-color: var(--color-gray-light); }
        #navbar {
            background: rgba(15, 23, 42, 0.95);
            padding: 15px 0;
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
        }
        .dashboard-header {
            background: linear-gradient(135deg, var(--color-navy) 0%, #1e293b 100%);
            padding: 120px 0 60px 0;
            color: white;
            margin-bottom: -50px;
        }
        .history-card {
            background: white;
            border-radius: var(--radius-md);
            padding: 24px;
            box-shadow: var(--shadow-soft);
            border: none;
            margin-bottom: 24px;
            display: flex;
            align-items: stretch;
        }
        .room-thumbnail {
            width: 200px;
            height: 100%;
            min-height: 150px;
            object-fit: cover;
            border-radius: var(--radius-sm);
            margin-right: 24px;
        }
        .status-badge {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
        }
        .status-pending { background-color: #FEF3C7; color: #92400E; }
        .status-checkin { background-color: #D1FAE5; color: #065F46; }
        .status-checkout { background-color: #E5E7EB; color: #4B5563; }
        
        @media (max-width: 768px) {
            .history-card {
                flex-direction: column;
            }
            .room-thumbnail {
                width: 100%;
                height: 200px;
                margin-right: 0;
                margin-bottom: 20px;
            }
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg fixed-top" id="navbar">
        <div class="container">
            <a class="navbar-brand fw-bold" href="../index.php">ALMARIS</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <i class="bi bi-list text-white fs-2"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item"><a class="nav-link" href="../index.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="../kamar.php">Rooms</a></li>
                    <li class="nav-item"><a class="nav-link" href="../index.php#about">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="../kontak.php">Contact</a></li>
                    <li class="nav-item"><a class="nav-link" href="dashboard.php">Dashboard</a></li>
                </ul>
                <div class="d-flex align-items-center gap-3">
                    <span class="text-white-50 me-2">Hi, <?= $userName ?></span>
                    <a href="../logout.php" class="btn btn-outline-light btn-sm" style="border-color: rgba(255,255,255,0.5); color: white;">Logout</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Dashboard Header -->
    <div class="dashboard-header">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-8 mt-4">
                    <span class="text-gold fw-bold text-uppercase tracking-wide fs-7 mb-2 d-block">My Account</span>
                    <h1 class="fw-bold mb-2">Booking History</h1>
                    <p class="text-white-50 mb-0">View all your past and upcoming reservations.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <section class="section-padding" style="padding-top: 80px; margin-bottom: 50px;">
        <div class="container">
            <div class="row mb-4 align-items-center">
                <div class="col-md-6">
                    <h4 class="fw-bold text-navy mb-0">All Reservations (<?= $totalBookings ?>)</h4>
                </div>
                <div class="col-md-6 text-md-end mt-3 mt-md-0">
                    <a href="dashboard.php" class="btn btn-outline-navy fw-semibold" style="border: 1px solid var(--color-navy); color: var(--color-navy);">
                        <i class="bi bi-arrow-left me-2"></i> Back to Dashboard
                    </a>
                </div>
            </div>

            <?php if (empty($reservations)): ?>
                <div class="text-center py-5 bg-white rounded-3 shadow-sm border border-light">
                    <i class="bi bi-inbox text-muted" style="font-size: 4rem;"></i>
                    <h4 class="text-navy mt-3 fw-bold">No reservations found.</h4>
                    <p class="text-muted">You haven't made any bookings yet.</p>
                    <a href="../kamar.php" class="btn btn-gold mt-3 px-4 py-2">Book a Room Now</a>
                </div>
            <?php else: ?>
                <?php foreach ($reservations as $res): ?>
                    <?php
                        $badgeClass = 'status-pending';
                        if ($res['status'] === 'checkin') $badgeClass = 'status-checkin';
                        if ($res['status'] === 'checkout') $badgeClass = 'status-checkout';
                        
                        $imgUrl = $roomImages[$res['tipe_kamar']] ?? 'https://images.unsplash.com/photo-1611892440504-42a792e24d32?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80';
                    ?>
                    <div class="history-card">
                        <img src="<?= $imgUrl ?>" alt="<?= htmlspecialchars($res['tipe_kamar']) ?>" class="room-thumbnail">
                        <div class="flex-grow-1 d-flex flex-column justify-content-between">
                            <div>
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <div>
                                        <h4 class="fw-bold text-navy mb-1"><?= htmlspecialchars($res['tipe_kamar']) ?></h4>
                                        <p class="text-muted fs-7 mb-0">Booking ID: #<?= htmlspecialchars($res['id_reservasi']) ?> | Booked on <?= date('M d, Y', strtotime($res['created_at'])) ?></p>
                                    </div>
                                    <span class="status-badge <?= $badgeClass ?>"><?= ucfirst(htmlspecialchars($res['status'])) ?></span>
                                </div>
                                <hr class="my-3 text-muted" style="opacity: 0.1;">
                                <div class="row g-3 mb-3">
                                    <div class="col-sm-4">
                                        <div class="text-muted fs-7 text-uppercase fw-semibold mb-1">Check-in</div>
                                        <div class="fw-bold text-navy"><i class="bi bi-box-arrow-in-right text-success me-2"></i><?= date('D, M d, Y', strtotime($res['check_in'])) ?></div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="text-muted fs-7 text-uppercase fw-semibold mb-1">Check-out</div>
                                        <div class="fw-bold text-navy"><i class="bi bi-box-arrow-right text-danger me-2"></i><?= date('D, M d, Y', strtotime($res['check_out'])) ?></div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="text-muted fs-7 text-uppercase fw-semibold mb-1">Room</div>
                                        <div class="fw-bold text-navy"><i class="bi bi-door-closed text-gold me-2"></i>Room <?= htmlspecialchars($res['nomor_kamar']) ?></div>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between align-items-end border-top pt-3 mt-2">
                                <div>
                                    <div class="text-muted fs-7 text-uppercase fw-semibold mb-1">Total Amount</div>
                                    <h4 class="fw-bold text-gold mb-0">Rp <?= number_format($res['total_harga'], 0, ',', '.') ?></h4>
                                </div>
                                <button class="btn btn-outline-navy fw-semibold" style="border: 1px solid var(--color-navy); color: var(--color-navy);" data-bs-toggle="modal" data-bs-target="#detailModal<?= $res['id_reservasi'] ?>">
                                    View Details
                                </button>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Detail Modal -->
                    <div class="modal fade" id="detailModal<?= $res['id_reservasi'] ?>" tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content border-0 shadow">
                                <div class="modal-header border-bottom-0 pb-0">
                                    <h5 class="modal-title fw-bold text-navy">Booking Details</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="text-center mb-4">
                                        <span class="status-badge <?= $badgeClass ?> mb-2"><?= ucfirst(htmlspecialchars($res['status'])) ?></span>
                                        <h4 class="fw-bold text-navy">Booking #<?= htmlspecialchars($res['id_reservasi']) ?></h4>
                                        <p class="text-muted fs-7 mb-0">Created on <?= date('F d, Y \a\t H:i', strtotime($res['created_at'])) ?></p>
                                    </div>
                                    
                                    <div class="bg-light p-3 rounded-3 mb-4">
                                        <div class="d-flex justify-content-between mb-2">
                                            <span class="text-muted">Guest Name</span>
                                            <span class="fw-bold text-navy"><?= $userName ?></span>
                                        </div>
                                        <div class="d-flex justify-content-between mb-2">
                                            <span class="text-muted">Room Type</span>
                                            <span class="fw-bold text-navy"><?= htmlspecialchars($res['tipe_kamar']) ?></span>
                                        </div>
                                        <div class="d-flex justify-content-between mb-2">
                                            <span class="text-muted">Room Number</span>
                                            <span class="fw-bold text-navy"><?= htmlspecialchars($res['nomor_kamar']) ?></span>
                                        </div>
                                    </div>
                                    
                                    <div class="row g-2 mb-4">
                                        <div class="col-6">
                                            <div class="border rounded-3 p-3 text-center">
                                                <div class="text-muted fs-7 text-uppercase mb-1">Check-in</div>
                                                <div class="fw-bold text-navy fs-5"><?= date('d M Y', strtotime($res['check_in'])) ?></div>
                                                <div class="text-muted fs-7">14:00 PM</div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="border rounded-3 p-3 text-center">
                                                <div class="text-muted fs-7 text-uppercase mb-1">Check-out</div>
                                                <div class="fw-bold text-navy fs-5"><?= date('d M Y', strtotime($res['check_out'])) ?></div>
                                                <div class="text-muted fs-7">12:00 PM</div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="d-flex justify-content-between align-items-center border-top pt-3">
                                        <span class="text-uppercase fw-bold text-navy">Total Payment</span>
                                        <h3 class="fw-bold text-gold mb-0">Rp <?= number_format($res['total_harga'], 0, ',', '.') ?></h3>
                                    </div>
                                </div>
                                <div class="modal-footer border-top-0 pt-0 pb-4 px-4">
                                    <button type="button" class="btn btn-navy w-100 py-2 fw-semibold" style="background-color: var(--color-navy); color: white;" data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </section>

    <!-- Footer (Minimal) -->
    <footer class="bg-navy py-4 text-center text-white-50" style="background-color: var(--color-navy);">
        <div class="container">
            <p class="mb-0 fs-7">&copy; 2026 Almaris Hotel. All rights reserved.</p>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
