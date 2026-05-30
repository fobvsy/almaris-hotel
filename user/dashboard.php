<?php
session_start();

// Protect: only authenticated users may access this page
if (!isset($_SESSION['user_id'])) {
    header("Location: ../admin/login.php");
    exit;
}

// Also block admins from user dashboard
if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin') {
    header("Location: ../admin/dashboard.php");
    exit;
}

$userName = htmlspecialchars($_SESSION['nama'] ?? 'User');
$userInitials = strtoupper(mb_substr($userName, 0, 2));
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard | Almaris Hotel</title>
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
        .user-avatar-large {
            width: 120px;
            height: 120px;
            background-color: var(--color-gold);
            color: var(--color-navy);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 3rem;
            font-weight: bold;
            border: 4px solid white;
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }
        .dashboard-card {
            background: white;
            border-radius: var(--radius-md);
            padding: 30px;
            box-shadow: var(--shadow-soft);
            border: none;
            height: 100%;
            transition: transform 0.3s ease;
        }
        .dashboard-card:hover { transform: translateY(-5px); }
        .stat-icon {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            margin-bottom: 20px;
        }
        .icon-blue { background-color: rgba(15, 23, 42, 0.1); color: var(--color-navy); }
        .icon-gold { background-color: rgba(212, 175, 55, 0.1); color: var(--color-gold); }
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
                    <li class="nav-item"><a class="nav-link active" href="dashboard.php">Dashboard</a></li>
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
                    <h1 class="fw-bold mb-2">Welcome back, <?= htmlspecialchars(explode(' ', $_SESSION['nama'])[0]) ?>!</h1>
                    <p class="text-white-50 mb-0">Manage your bookings, profile, and preferences all in one place.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <section class="section-padding" style="padding-top: 80px; margin-bottom: 50px;">
        <div class="container">
            <div class="row g-4">
                
                <!-- Profile Info Sidebar -->
                <div class="col-lg-4">
                    <div class="dashboard-card text-center">
                        <div class="user-avatar-large mx-auto mb-4"><?= $userInitials ?></div>
                        <h4 class="fw-bold text-navy mb-1"><?= $userName ?></h4>
                        <p class="text-muted mb-4"><?= htmlspecialchars($_SESSION['email'] ?? '') ?></p>
                        <hr class="text-muted">
                        <div class="text-start mt-4">
                            <p class="mb-2"><i class="bi bi-telephone text-gold me-2"></i> +62 812 3456 7890</p>
                            <p class="mb-0"><i class="bi bi-geo-alt text-gold me-2"></i> Jakarta, Indonesia</p>
                        </div>
                        <button class="btn btn-outline-navy w-100 mt-4 py-2 fw-semibold" style="border: 1px solid var(--color-navy); color: var(--color-navy);">Edit Profile</button>
                    </div>
                </div>

                <!-- Dashboard Stats & Actions -->
                <div class="col-lg-8">
                    <div class="row g-4 mb-4">
                        <!-- Total Reservations -->
                        <div class="col-md-6">
                            <div class="dashboard-card d-flex align-items-center">
                                <div class="stat-icon icon-blue mb-0 me-4"><i class="bi bi-calendar-check"></i></div>
                                <div>
                                    <h2 class="fw-bold text-navy mb-0">12</h2>
                                    <p class="text-muted mb-0">Total Reservations</p>
                                </div>
                            </div>
                        </div>
                        <!-- Active Reservations -->
                        <div class="col-md-6">
                            <div class="dashboard-card d-flex align-items-center" style="border: 1px solid var(--color-gold);">
                                <div class="stat-icon icon-gold mb-0 me-4"><i class="bi bi-bell"></i></div>
                                <div>
                                    <h2 class="fw-bold text-navy mb-0">1</h2>
                                    <p class="text-muted mb-0">Active Reservation</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Access Cards -->
                    <div class="row g-4">
                        <div class="col-md-6">
                            <div class="dashboard-card bg-navy text-white text-center" style="background-color: var(--color-navy);">
                                <i class="bi bi-clock-history fs-1 text-gold mb-3 d-block"></i>
                                <h4 class="fw-bold mb-3">Booking History</h4>
                                <p class="text-white-50 mb-4 fs-7">View your past and upcoming stays, download invoices, and manage your current bookings.</p>
                                <a href="riwayat.php" class="btn btn-gold w-100 py-2 fw-semibold">View History</a>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="dashboard-card text-center" style="border: 1px solid rgba(0,0,0,0.1);">
                                <i class="bi bi-house-door fs-1 text-gold mb-3 d-block"></i>
                                <h4 class="fw-bold text-navy mb-3">Book a Room</h4>
                                <p class="text-muted mb-4 fs-7">Planning your next trip? Browse our luxury rooms and book your perfect stay today.</p>
                                <a href="../kamar.php" class="btn w-100 py-2 fw-semibold" style="border: 1px solid var(--color-navy); color: var(--color-navy);">Browse Rooms</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer (Minimal for dashboard) -->
    <footer class="bg-navy py-4 text-center text-white-50" style="background-color: var(--color-navy);">
        <div class="container">
            <p class="mb-0 fs-7">&copy; 2026 Almaris Hotel. All rights reserved.</p>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
