<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Almaris</title>
    
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

        .stat-card {
            display: flex;
            align-items: center;
        }

        .stat-icon {
            width: 60px;
            height: 60px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            margin-right: 20px;
        }

        .stat-icon.rooms { background-color: rgba(212, 175, 55, 0.1); color: var(--accent); }
        .stat-icon.users { background-color: #DBEAFE; color: #1E40AF; }
        .stat-icon.reservations { background-color: #D1FAE5; color: #065F46; }

        .stat-info h3 {
            font-size: 1.8rem;
            font-weight: 700;
            margin: 0;
            color: var(--primary);
        }

        .stat-info p {
            margin: 0;
            color: var(--text-muted);
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
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
            <a href="dashboard.php" class="nav-item active">
                <i class="fas fa-home"></i> Dashboard
            </a>
            <a href="kamar.php" class="nav-item">
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
                <h1 class="page-title">Dashboard Overview</h1>
                <p class="text-muted mb-0">Welcome back, here's what's happening today.</p>
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

        <!-- Stats Row -->
        <div class="row g-4 mb-4">
            <div class="col-md-4">
                <div class="modern-card stat-card">
                    <div class="stat-icon rooms">
                        <i class="fas fa-door-open"></i>
                    </div>
                    <div class="stat-info">
                        <p>Total Kamar</p>
                        <h3>24</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="modern-card stat-card">
                    <div class="stat-icon users">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="stat-info">
                        <p>Total User</p>
                        <h3>156</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="modern-card stat-card">
                    <div class="stat-icon reservations">
                        <i class="fas fa-calendar-check"></i>
                    </div>
                    <div class="stat-info">
                        <p>Total Reservasi</p>
                        <h3>89</h3>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Reservations -->
        <div class="modern-card">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h5 class="mb-0" style="color: var(--primary); font-weight: 600;">Recent Reservations</h5>
                <a href="reservasi.php" class="btn btn-outline-primary btn-sm" style="border-color: var(--primary); color: var(--primary); border-radius: 6px; padding: 6px 12px; text-decoration: none;">View All</a>
            </div>

            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Booking ID</th>
                            <th>Guest Name</th>
                            <th>Room Type</th>
                            <th>Check In</th>
                            <th>Check Out</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><span class="fw-bold text-muted">#RES-1001</span></td>
                            <td>John Doe</td>
                            <td>Deluxe Ocean View</td>
                            <td>2026-06-01</td>
                            <td>2026-06-03</td>
                            <td><span class="status-badge status-pending">Pending</span></td>
                        </tr>
                        <tr>
                            <td><span class="fw-bold text-muted">#RES-1002</span></td>
                            <td>Jane Smith</td>
                            <td>Executive Suite</td>
                            <td>2026-05-28</td>
                            <td>2026-05-30</td>
                            <td><span class="status-badge status-checkin">Check-in</span></td>
                        </tr>
                        <tr>
                            <td><span class="fw-bold text-muted">#RES-1003</span></td>
                            <td>Michael Brown</td>
                            <td>Standard City View</td>
                            <td>2026-05-25</td>
                            <td>2026-05-27</td>
                            <td><span class="status-badge status-checkout">Check-out</span></td>
                        </tr>
                        <tr>
                            <td><span class="fw-bold text-muted">#RES-1004</span></td>
                            <td>Sarah Wilson</td>
                            <td>Presidential Suite</td>
                            <td>2026-06-05</td>
                            <td>2026-06-10</td>
                            <td><span class="status-badge status-pending">Pending</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
