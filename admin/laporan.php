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

// Filter handling
$whereClauses = [];
$params = [];
$types = "";

$startDate = $_GET['start_date'] ?? '';
$endDate = $_GET['end_date'] ?? '';
$statusFilter = $_GET['status'] ?? 'all';

if (!empty($startDate)) {
    $whereClauses[] = "r.check_in >= ?";
    $params[] = $startDate;
    $types .= "s";
}
if (!empty($endDate)) {
    $whereClauses[] = "r.check_in <= ?";
    $params[] = $endDate;
    $types .= "s";
}
if ($statusFilter !== 'all') {
    $whereClauses[] = "r.status = ?";
    $params[] = $statusFilter;
    $types .= "s";
}

$whereSql = "";
if (count($whereClauses) > 0) {
    $whereSql = "WHERE " . implode(" AND ", $whereClauses);
}

// Fetch data
$sql = "SELECT r.id_reservasi, r.check_in, r.check_out, r.total_harga, r.status, u.nama, k.tipe_kamar 
        FROM reservasi r 
        JOIN users u ON r.id_user = u.id_user 
        JOIN kamar k ON r.id_kamar = k.id_kamar 
        $whereSql 
        ORDER BY r.created_at DESC";

$stmt = $koneksi->prepare($sql);
if (!empty($params)) {
    $stmt->bind_param($types, ...$params);
}
$stmt->execute();
$result = $stmt->get_result();
$reservations = $result->fetch_all(MYSQLI_ASSOC);
$stmt->close();

// Calculate Totals
$totalReservations = count($reservations);
$totalRevenue = 0;
foreach ($reservations as $res) {
    $totalRevenue += $res['total_harga'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reports - Almaris Admin</title>
    
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

        /* Table Styling */
        .table-responsive {
            border-radius: 12px;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        .table {
            margin-bottom: 0;
            white-space: nowrap;
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

        /* User Avatar Placeholder */
        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: var(--primary);
            color: var(--accent);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
        }

        .btn-accent {
            background-color: var(--accent);
            color: var(--primary);
            font-weight: 600;
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

        /* Print Specific Styles */
        @media print {
            body {
                background-color: #fff;
            }
            #sidebar, .page-header, .filter-section, .pagination-container {
                display: none !important;
            }
            #main-content {
                margin-left: 0;
                padding: 0;
            }
            .modern-card {
                box-shadow: none;
                border: none;
                padding: 0;
            }
            /* Add print header logo */
            .modern-card::before {
                content: 'ALMARIS HOTEL - RESERVATION REPORT';
                display: block;
                font-family: 'Montserrat', sans-serif;
                font-size: 1.5rem;
                font-weight: 700;
                color: #0F172A;
                text-align: center;
                margin-bottom: 20px;
                padding-bottom: 10px;
                border-bottom: 2px solid #D4AF37;
            }
        }
        
        /* Dark Mode Styles */
        body.dark-mode {
            --bg-main: #0f172a;
            --bg-white: #1e293b;
            --text-main: #f8fafc;
            --text-muted: #94a3b8;
        }
        body.dark-mode .page-title,
        body.dark-mode .stat-info h3,
        body.dark-mode h5,
        body.dark-mode .modal-title,
        body.dark-mode .form-label,
        body.dark-mode .text-primary {
            color: #f8fafc !important;
        }
        body.dark-mode .table thead th {
            background-color: #334155;
            color: #f8fafc;
            border-bottom-color: #475569;
        }
        body.dark-mode .table tbody td {
            border-bottom-color: #334155;
            color: #f8fafc;
        }
        body.dark-mode .table-hover tbody tr:hover td {
            background-color: #475569;
            color: #f8fafc;
        }
        body.dark-mode .form-control, 
        body.dark-mode .form-select {
            background-color: #0f172a;
            border-color: #334155;
            color: #f8fafc;
        }
        body.dark-mode .form-control:focus, 
        body.dark-mode .form-select:focus {
            background-color: #0f172a;
            color: #f8fafc;
        }
        body.dark-mode .modal-content {
            background-color: #1e293b;
        }
        body.dark-mode .modal-header,
        body.dark-mode .modal-footer {
            border-color: #334155;
        }
        body.dark-mode .bg-light {
            background-color: #334155 !important;
        }
        body.dark-mode .input-group-text {
            background-color: #0f172a !important;
            border-color: #334155;
            color: #94a3b8;
        }
        body.dark-mode .btn-light {
            background-color: #334155;
            color: #f8fafc;
            border-color: #475569;
        }
        body.dark-mode .btn-light:hover {
            background-color: #475569;
            color: #f8fafc;
        }
        body.dark-mode .pagination .page-link {
            background-color: #1e293b;
            border-color: #334155;
        }
        body.dark-mode .pagination .page-item.active .page-link {
            background-color: var(--primary);
            border-color: var(--primary);
        }
        body.dark-mode .btn-outline-primary {
            border-color: #f8fafc;
            color: #f8fafc;
        }
        body.dark-mode .btn-outline-primary:hover {
            background-color: #f8fafc;
            color: #0f172a;
        }
        body.dark-mode .modern-card {
            background-color: #1e293b;
        }
        body.dark-mode .stat-icon.users { background-color: #1e3a8a; color: #60a5fa; }
        body.dark-mode .stat-icon.reservations { background-color: #064e3b; color: #34d399; }
        body.dark-mode .text-muted { color: #94a3b8 !important; }

        /* Mobile Responsiveness */
        .mobile-navbar {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            height: 60px;
            background-color: var(--primary);
            z-index: 998;
            align-items: center;
            padding: 0 20px;
            justify-content: space-between;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .mobile-nav-toggle {
            background: none;
            border: none;
            color: var(--accent);
            font-size: 1.5rem;
            cursor: pointer;
        }

        @media (max-width: 768px) {
            #sidebar {
                transform: translateX(-100%);
            }
            #sidebar.show {
                transform: translateX(0);
                box-shadow: 4px 0 10px rgba(0,0,0,0.1);
            }
            #main-content {
                margin-left: 0;
                padding: 15px;
                padding-top: 80px;
            }
            .mobile-navbar {
                display: flex;
            }
            .page-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }
            .user-profile {
                align-self: flex-start;
                margin-top: 10px;
            }
        }
    </style>
</head>
<body>

    <!-- Mobile Navbar -->
    <div class="mobile-navbar">
        <div class="brand-text text-white fw-bold" style="font-family: 'Montserrat', sans-serif; font-size: 1.2rem; letter-spacing: 1px;">
            ALMARIS <span style="color: var(--accent);">Admin</span>
        </div>
        <button class="mobile-nav-toggle" id="mobileNavToggle">
            <i class="fas fa-bars"></i>
        </button>
    </div>

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
            <a href="reservasi.php" class="nav-item">
                <i class="fas fa-calendar-alt"></i> Reservations
            </a>
            <a href="user.php" class="nav-item">
                <i class="fas fa-users"></i> Manage Users
            </a>
            <a href="laporan.php" class="nav-item active">
                <i class="fas fa-chart-line"></i> Reports
            </a>
            <a href="#" class="nav-item mt-3" id="darkModeToggle">
                <i class="fas fa-moon"></i> Dark Mode
            </a>
            <a href="../logout.php" class="nav-item mt-2 text-danger">
                <i class="fas fa-sign-out-alt text-danger"></i> Logout
            </a>
        </div>
    </nav>

    <!-- Main Content -->
    <main id="main-content">
        <div class="page-header">
            <div>
                <h1 class="page-title">Reservation Reports</h1>
                <p class="text-muted mb-0">View and generate PDF reports of hotel reservations.</p>
            </div>
            <div class="user-profile d-flex align-items-center">
                <div class="text-end me-3">
                    <div class="fw-bold" style="font-size: 0.9rem; color: var(--primary);"><?= htmlspecialchars($adminName) ?></div>
                    <div class="text-muted" style="font-size: 0.75rem;"><?= htmlspecialchars($adminEmail) ?></div>
                </div>
                <div class="user-avatar">
                    <?= strtoupper(substr($adminName, 0, 1)) ?>
                </div>
            </div>
        </div>

        <div class="modern-card">
            <div class="filter-section">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h5 class="mb-0" style="color: var(--primary); font-weight: 600;">Report Data</h5>
                    <button class="btn btn-accent" onclick="window.print()">
                        <i class="fas fa-file-pdf me-2"></i> Cetak PDF
                    </button>
                </div>

                <!-- Filter Controls -->
                <form method="GET" action="laporan.php" class="row g-3 mb-4 p-4 rounded-3" style="background-color: #F8FAFC; border: 1px solid #E2E8F0;">
                    <div class="col-md-4">
                        <label class="form-label" style="font-size: 0.85rem; font-weight: 600; color: var(--primary);">Start Date</label>
                        <input type="date" name="start_date" class="form-control" value="<?= htmlspecialchars($startDate) ?>">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label" style="font-size: 0.85rem; font-weight: 600; color: var(--primary);">End Date</label>
                        <input type="date" name="end_date" class="form-control" value="<?= htmlspecialchars($endDate) ?>">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label" style="font-size: 0.85rem; font-weight: 600; color: var(--primary);">Status Filter</label>
                        <div class="d-flex gap-2">
                            <select name="status" class="form-select w-100">
                                <option value="all" <?= $statusFilter === 'all' ? 'selected' : '' ?>>All Status</option>
                                <option value="checkin" <?= $statusFilter === 'checkin' ? 'selected' : '' ?>>Check-in</option>
                                <option value="checkout" <?= $statusFilter === 'checkout' ? 'selected' : '' ?>>Check-out</option>
                                <option value="pending" <?= $statusFilter === 'pending' ? 'selected' : '' ?>>Pending</option>
                            </select>
                            <button type="submit" class="btn" style="background-color: var(--primary); color: white; min-width: 100px;">
                                <i class="fas fa-filter"></i> Filter
                            </button>
                            <a href="laporan.php" class="btn btn-outline-secondary" title="Reset Filters">
                                <i class="fas fa-undo"></i>
                            </a>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Summary Statistics -->
            <div class="row mb-4">
                <div class="col-md-6">
                    <div class="p-3 border rounded-3 text-center bg-white" style="border-left: 4px solid var(--primary) !important;">
                        <span class="d-block text-muted fs-7 text-uppercase fw-bold mb-1">Total Reservations (Filtered)</span>
                        <span class="fs-3 fw-bold" style="color: var(--primary);"><?= $totalReservations ?></span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="p-3 border rounded-3 text-center bg-white" style="border-left: 4px solid var(--accent) !important;">
                        <span class="d-block text-muted fs-7 text-uppercase fw-bold mb-1">Total Revenue (Filtered)</span>
                        <span class="fs-3 fw-bold" style="color: var(--accent);">Rp <?= number_format($totalRevenue, 0, ',', '.') ?></span>
                    </div>
                </div>
            </div>

            <!-- Table -->
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID Reservasi</th>
                            <th>Guest Name</th>
                            <th>Kamar</th>
                            <th>Check-in</th>
                            <th>Check-out</th>
                            <th>Total Harga</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($reservations)): ?>
                            <tr>
                                <td colspan="7" class="text-center py-4 text-muted">No reservations found for the selected filters.</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($reservations as $res): ?>
                                <?php
                                    $badgeClass = 'status-pending';
                                    if ($res['status'] === 'checkin') $badgeClass = 'status-checkin';
                                    if ($res['status'] === 'checkout') $badgeClass = 'status-checkout';
                                ?>
                                <tr>
                                    <td><span class="text-muted fw-bold">#RES-<?= htmlspecialchars($res['id_reservasi']) ?></span></td>
                                    <td><?= htmlspecialchars($res['nama']) ?></td>
                                    <td><?= htmlspecialchars($res['tipe_kamar']) ?></td>
                                    <td><?= htmlspecialchars($res['check_in']) ?></td>
                                    <td><?= htmlspecialchars($res['check_out']) ?></td>
                                    <td class="fw-medium">Rp <?= number_format($res['total_harga'], 0, ',', '.') ?></td>
                                    <td><span class="status-badge <?= $badgeClass ?>"><?= ucfirst(htmlspecialchars($res['status'])) ?></span></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination (UI only) -->
            <div class="pagination-container d-flex justify-content-between align-items-center mt-4 pt-3 border-top">
                <!-- <span class="text-muted" style="font-size: 0.85rem;">Showing 1 to 4 of 124 entries</span> -->
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

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            <?php if (empty($reservations) && (!empty($startDate) || !empty($endDate) || $statusFilter !== 'all')): ?>
                Swal.fire({
                    icon: 'info',
                    title: 'No Data Found',
                    text: 'No reservations match your current filter criteria.',
                    confirmButtonColor: '#0F172A'
                });
            <?php endif; ?>
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const toggleBtn = document.getElementById('mobileNavToggle');
            if (toggleBtn) {
                toggleBtn.addEventListener('click', function() {
                    document.getElementById('sidebar').classList.toggle('show');
                });
            }
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const darkModeToggle = document.getElementById('darkModeToggle');
            const body = document.body;
            if (!darkModeToggle) return;
            const icon = darkModeToggle.querySelector('i');
            
            if (localStorage.getItem('adminDarkMode') === 'enabled') {
                body.classList.add('dark-mode');
                icon.classList.remove('fa-moon');
                icon.classList.add('fa-sun');
            }
            
            darkModeToggle.addEventListener('click', function(e) {
                e.preventDefault();
                body.classList.toggle('dark-mode');
                if (body.classList.contains('dark-mode')) {
                    localStorage.setItem('adminDarkMode', 'enabled');
                    icon.classList.remove('fa-moon');
                    icon.classList.add('fa-sun');
                } else {
                    localStorage.setItem('adminDarkMode', 'disabled');
                    icon.classList.remove('fa-sun');
                    icon.classList.add('fa-moon');
                }
            });
        });
    </script>
</body>
</html>
