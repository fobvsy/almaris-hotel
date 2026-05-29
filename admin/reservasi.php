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
            display: inline-block;
            text-align: center;
            min-width: 90px;
        }

        .status-pending { background-color: #FEF3C7; color: #92400E; }
        .status-confirmed { background-color: #DBEAFE; color: #1E40AF; }
        .status-checkin { background-color: #D1FAE5; color: #065F46; }
        .status-checkout { background-color: #E5E7EB; color: #4B5563; }
        .status-cancelled { background-color: #FEE2E2; color: #991B1B; }
        
        .action-btn {
            padding: 6px 12px;
            border-radius: 6px;
            font-size: 0.8rem;
            font-weight: 500;
            transition: all 0.2s;
        }
        
        /* Edit Modal specific */
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
            <a href="#" class="nav-item mt-5 text-danger">
                <i class="fas fa-sign-out-alt text-danger"></i> Logout
            </a>
        </div>
    </nav>

    <!-- Main Content -->
    <main id="main-content">
        <div class="page-header">
            <div>
                <h1 class="page-title">Manage Reservations</h1>
                <p class="text-muted mb-0">View and update guest reservations.</p>
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

        <!-- Filter and Search -->
        <div class="modern-card py-3 mb-4">
            <div class="row g-3 align-items-center">
                <div class="col-md-4">
                    <div class="input-group">
                        <span class="input-group-text bg-white border-end-0"><i class="fas fa-search text-muted"></i></span>
                        <input type="text" class="form-control border-start-0 ps-0" placeholder="Search by Booking ID or Name...">
                    </div>
                </div>
                <div class="col-md-3">
                    <select class="form-select">
                        <option value="">All Statuses</option>
                        <option value="pending">Pending</option>
                        <option value="confirmed">Confirmed</option>
                        <option value="checkin">Checked-in</option>
                        <option value="checkout">Checked-out</option>
                        <option value="cancelled">Cancelled</option>
                    </select>
                </div>
                <div class="col-md-5 text-md-end">
                    <button class="btn btn-outline-secondary"><i class="fas fa-filter"></i> Filter</button>
                    <button class="btn btn-dark" style="background-color: var(--primary);"><i class="fas fa-download"></i> Export</button>
                </div>
            </div>
        </div>

        <!-- Reservations Table -->
        <div class="modern-card">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th>Booking ID</th>
                            <th>Guest Info</th>
                            <th>Room Details</th>
                            <th>Dates</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><span class="fw-bold" style="color: var(--primary);">#RES-1001</span><br><small class="text-muted">Booked: 2026-05-20</small></td>
                            <td>
                                <div class="fw-bold">John Doe</div>
                                <div class="text-muted" style="font-size: 0.8rem;"><i class="fas fa-envelope"></i> john@example.com</div>
                                <div class="text-muted" style="font-size: 0.8rem;"><i class="fas fa-phone"></i> +62 812 3456 7890</div>
                            </td>
                            <td>
                                <div class="fw-bold">Deluxe Ocean View</div>
                                <div class="text-muted" style="font-size: 0.8rem;"><i class="fas fa-users"></i> 2 Guests</div>
                            </td>
                            <td>
                                <div><span class="text-muted" style="font-size: 0.8rem;">In:</span> 2026-06-01</div>
                                <div><span class="text-muted" style="font-size: 0.8rem;">Out:</span> 2026-06-03</div>
                                <div class="badge bg-light text-dark mt-1">2 Nights</div>
                            </td>
                            <td class="fw-bold">Rp 3,000,000</td>
                            <td><span class="status-badge status-pending">Pending</span></td>
                            <td class="text-center">
                                <button class="btn btn-outline-primary btn-sm action-btn" data-bs-toggle="modal" data-bs-target="#editStatusModal" data-id="RES-1001" data-status="pending">
                                    <i class="fas fa-edit"></i> Edit Status
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td><span class="fw-bold" style="color: var(--primary);">#RES-1002</span><br><small class="text-muted">Booked: 2026-05-22</small></td>
                            <td>
                                <div class="fw-bold">Jane Smith</div>
                                <div class="text-muted" style="font-size: 0.8rem;"><i class="fas fa-envelope"></i> jane.s@example.com</div>
                                <div class="text-muted" style="font-size: 0.8rem;"><i class="fas fa-phone"></i> +62 877 6543 2109</div>
                            </td>
                            <td>
                                <div class="fw-bold">Executive Suite</div>
                                <div class="text-muted" style="font-size: 0.8rem;"><i class="fas fa-users"></i> 3 Guests</div>
                            </td>
                            <td>
                                <div><span class="text-muted" style="font-size: 0.8rem;">In:</span> 2026-05-28</div>
                                <div><span class="text-muted" style="font-size: 0.8rem;">Out:</span> 2026-05-30</div>
                                <div class="badge bg-light text-dark mt-1">2 Nights</div>
                            </td>
                            <td class="fw-bold">Rp 5,600,000</td>
                            <td><span class="status-badge status-checkin">Checked-in</span></td>
                            <td class="text-center">
                                <button class="btn btn-outline-primary btn-sm action-btn" data-bs-toggle="modal" data-bs-target="#editStatusModal" data-id="RES-1002" data-status="checkin">
                                    <i class="fas fa-edit"></i> Edit Status
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td><span class="fw-bold" style="color: var(--primary);">#RES-1003</span><br><small class="text-muted">Booked: 2026-05-18</small></td>
                            <td>
                                <div class="fw-bold">Michael Brown</div>
                                <div class="text-muted" style="font-size: 0.8rem;"><i class="fas fa-envelope"></i> mikeb@example.com</div>
                                <div class="text-muted" style="font-size: 0.8rem;"><i class="fas fa-phone"></i> +62 855 1234 5678</div>
                            </td>
                            <td>
                                <div class="fw-bold">Standard City View</div>
                                <div class="text-muted" style="font-size: 0.8rem;"><i class="fas fa-users"></i> 1 Guest</div>
                            </td>
                            <td>
                                <div><span class="text-muted" style="font-size: 0.8rem;">In:</span> 2026-05-25</div>
                                <div><span class="text-muted" style="font-size: 0.8rem;">Out:</span> 2026-05-27</div>
                                <div class="badge bg-light text-dark mt-1">2 Nights</div>
                            </td>
                            <td class="fw-bold">Rp 1,800,000</td>
                            <td><span class="status-badge status-checkout">Checked-out</span></td>
                            <td class="text-center">
                                <button class="btn btn-outline-primary btn-sm action-btn" data-bs-toggle="modal" data-bs-target="#editStatusModal" data-id="RES-1003" data-status="checkout">
                                    <i class="fas fa-edit"></i> Edit Status
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td><span class="fw-bold" style="color: var(--primary);">#RES-1004</span><br><small class="text-muted">Booked: 2026-05-24</small></td>
                            <td>
                                <div class="fw-bold">Sarah Wilson</div>
                                <div class="text-muted" style="font-size: 0.8rem;"><i class="fas fa-envelope"></i> swilson@example.com</div>
                                <div class="text-muted" style="font-size: 0.8rem;"><i class="fas fa-phone"></i> +62 811 9876 5432</div>
                            </td>
                            <td>
                                <div class="fw-bold">Presidential Suite</div>
                                <div class="text-muted" style="font-size: 0.8rem;"><i class="fas fa-users"></i> 4 Guests</div>
                            </td>
                            <td>
                                <div><span class="text-muted" style="font-size: 0.8rem;">In:</span> 2026-06-05</div>
                                <div><span class="text-muted" style="font-size: 0.8rem;">Out:</span> 2026-06-10</div>
                                <div class="badge bg-light text-dark mt-1">5 Nights</div>
                            </td>
                            <td class="fw-bold">Rp 27,500,000</td>
                            <td><span class="status-badge status-confirmed">Confirmed</span></td>
                            <td class="text-center">
                                <button class="btn btn-outline-primary btn-sm action-btn" data-bs-toggle="modal" data-bs-target="#editStatusModal" data-id="RES-1004" data-status="confirmed">
                                    <i class="fas fa-edit"></i> Edit Status
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td><span class="fw-bold" style="color: var(--primary);">#RES-1005</span><br><small class="text-muted">Booked: 2026-05-25</small></td>
                            <td>
                                <div class="fw-bold">David Lee</div>
                                <div class="text-muted" style="font-size: 0.8rem;"><i class="fas fa-envelope"></i> dlee@example.com</div>
                                <div class="text-muted" style="font-size: 0.8rem;"><i class="fas fa-phone"></i> +62 822 3344 5566</div>
                            </td>
                            <td>
                                <div class="fw-bold">Deluxe Ocean View</div>
                                <div class="text-muted" style="font-size: 0.8rem;"><i class="fas fa-users"></i> 2 Guests</div>
                            </td>
                            <td>
                                <div><span class="text-muted" style="font-size: 0.8rem;">In:</span> 2026-05-29</div>
                                <div><span class="text-muted" style="font-size: 0.8rem;">Out:</span> 2026-05-31</div>
                                <div class="badge bg-light text-dark mt-1">2 Nights</div>
                            </td>
                            <td class="fw-bold">Rp 3,000,000</td>
                            <td><span class="status-badge status-cancelled">Cancelled</span></td>
                            <td class="text-center">
                                <button class="btn btn-outline-primary btn-sm action-btn" data-bs-toggle="modal" data-bs-target="#editStatusModal" data-id="RES-1005" data-status="cancelled">
                                    <i class="fas fa-edit"></i> Edit Status
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination -->
            <div class="d-flex justify-content-between align-items-center mt-4">
                <div class="text-muted" style="font-size: 0.9rem;">Showing 1 to 5 of 89 entries</div>
                <nav>
                    <ul class="pagination mb-0">
                        <li class="page-item disabled"><a class="page-link" href="#">Previous</a></li>
                        <li class="page-item active"><a class="page-link" style="background-color: var(--primary); border-color: var(--primary);" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" style="color: var(--primary);" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" style="color: var(--primary);" href="#">3</a></li>
                        <li class="page-item"><a class="page-link" style="color: var(--primary);" href="#">Next</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </main>

    <!-- Edit Status Modal -->
    <div class="modal fade" id="editStatusModal" tabindex="-1" aria-labelledby="editStatusModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0" style="border-radius: 16px; overflow: hidden;">
                <div class="modal-header" style="background-color: #F8F9FA; border-bottom: 1px solid #E5E7EB;">
                    <h5 class="modal-title fw-bold" id="editStatusModalLabel" style="color: var(--primary);">Update Reservation Status</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <p class="mb-4">Update status for booking <span class="fw-bold" id="modalBookingId" style="color: var(--primary);">#RES-XXXX</span></p>
                    
                    <form id="updateStatusForm">
                        <div class="mb-4">
                            <label for="reservationStatus" class="form-label">Current Status</label>
                            <select class="form-select form-select-lg" id="reservationStatus" style="font-size: 0.95rem;">
                                <option value="pending">Pending</option>
                                <option value="confirmed">Confirmed</option>
                                <option value="checkin">Checked-in</option>
                                <option value="checkout">Checked-out</option>
                                <option value="cancelled">Cancelled</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="statusNotes" class="form-label">Notes (Optional)</label>
                            <textarea class="form-control" id="statusNotes" rows="2" placeholder="Add any notes about this status change..."></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer border-top-0 pt-0 pb-4 px-4">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-dark px-4" style="background-color: var(--primary);" onclick="alert('Status updated (Frontend Demo)')" data-bs-dismiss="modal">Save Changes</button>
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
                    // Button that triggered the modal
                    const button = event.relatedTarget;
                    // Extract info from data-* attributes
                    const bookingId = button.getAttribute('data-id');
                    const status = button.getAttribute('data-status');
                    
                    // Update the modal's content
                    const modalTitle = editStatusModal.querySelector('#modalBookingId');
                    const statusSelect = editStatusModal.querySelector('#reservationStatus');
                    
                    modalTitle.textContent = '#' + bookingId;
                    statusSelect.value = status;
                });
            }
        });
    </script>
</body>
</html>
