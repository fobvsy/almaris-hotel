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
            <a href="#" class="nav-item">
                <i class="fas fa-home"></i> Dashboard
            </a>
            <a href="kamar.php" class="nav-item active">
                <i class="fas fa-bed"></i> Manage Rooms
            </a>
            <a href="#" class="nav-item">
                <i class="fas fa-calendar-alt"></i> Reservations
            </a>
            <a href="#" class="nav-item">
                <i class="fas fa-users"></i> Manage Users
            </a>
            <a href="#" class="nav-item">
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
                <h1 class="page-title">Manage Rooms</h1>
                <p class="text-muted mb-0">Add, edit, or remove hotel rooms.</p>
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
                        <!-- Dummy Data Row 1 -->
                        <tr>
                            <td>
                                <img src="https://images.unsplash.com/photo-1611892440504-42a792e24d32?auto=format&fit=crop&w=150&q=80" alt="Room 101" class="room-img-thumb">
                            </td>
                            <td><span class="fw-bold">101</span></td>
                            <td>Standard</td>
                            <td>Rp 350,000</td>
                            <td><span class="status-badge status-tersedia">Tersedia</span></td>
                            <td class="text-center">
                                <button class="action-btn btn-edit" data-bs-toggle="modal" data-bs-target="#editRoomModal" title="Edit">
                                    <i class="fas fa-pen"></i>
                                </button>
                                <button class="action-btn btn-delete" title="Delete">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                        
                        <!-- Dummy Data Row 2 -->
                        <tr>
                            <td>
                                <img src="https://images.unsplash.com/photo-1590490360182-c33d57733427?auto=format&fit=crop&w=150&q=80" alt="Room 201" class="room-img-thumb">
                            </td>
                            <td><span class="fw-bold">201</span></td>
                            <td>Deluxe</td>
                            <td>Rp 550,000</td>
                            <td><span class="status-badge status-dipesan">Dipesan</span></td>
                            <td class="text-center">
                                <button class="action-btn btn-edit" data-bs-toggle="modal" data-bs-target="#editRoomModal" title="Edit">
                                    <i class="fas fa-pen"></i>
                                </button>
                                <button class="action-btn btn-delete" title="Delete">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                        
                        <!-- Dummy Data Row 3 -->
                        <tr>
                            <td>
                                <img src="https://images.unsplash.com/photo-1582719478250-c894e4dc240e?auto=format&fit=crop&w=150&q=80" alt="Room 301" class="room-img-thumb">
                            </td>
                            <td><span class="fw-bold">301</span></td>
                            <td>Suite</td>
                            <td>Rp 950,000</td>
                            <td><span class="status-badge status-tersedia">Tersedia</span></td>
                            <td class="text-center">
                                <button class="action-btn btn-edit" data-bs-toggle="modal" data-bs-target="#editRoomModal" title="Edit">
                                    <i class="fas fa-pen"></i>
                                </button>
                                <button class="action-btn btn-delete" title="Delete">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>

                        <!-- Dummy Data Row 4 -->
                        <tr>
                            <td>
                                <div class="bg-light d-flex align-items-center justify-content-center room-img-thumb">
                                    <i class="fas fa-image text-muted"></i>
                                </div>
                            </td>
                            <td><span class="fw-bold">401</span></td>
                            <td>Presidential</td>
                            <td>Rp 1,800,000</td>
                            <td><span class="status-badge status-tersedia">Tersedia</span></td>
                            <td class="text-center">
                                <button class="action-btn btn-edit" data-bs-toggle="modal" data-bs-target="#editRoomModal" title="Edit">
                                    <i class="fas fa-pen"></i>
                                </button>
                                <button class="action-btn btn-delete" title="Delete">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
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
                    <form>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Room Number</label>
                                <input type="text" class="form-control" placeholder="e.g. 101" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Room Type</label>
                                <select class="form-select" required>
                                    <option value="" disabled selected>Select type</option>
                                    <option value="Standard">Standard</option>
                                    <option value="Deluxe">Deluxe</option>
                                    <option value="Suite">Suite</option>
                                    <option value="Presidential">Presidential</option>
                                </select>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Price per Night (Rp)</label>
                            <input type="number" class="form-control" placeholder="e.g. 500000" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Status</label>
                            <select class="form-select" required>
                                <option value="tersedia" selected>Tersedia</option>
                                <option value="dipesan">Dipesan</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Room Photo</label>
                            <input type="file" class="form-control" accept="image/*">
                            <div class="form-text text-muted" style="font-size: 0.8rem;">Max file size 2MB. Recommended resolution 800x600.</div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal" style="border-radius: 8px;">Cancel</button>
                    <button type="button" class="btn btn-accent">Save Room</button>
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
                    <form>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Room Number</label>
                                <input type="text" class="form-control" value="101" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Room Type</label>
                                <select class="form-select" required>
                                    <option value="Standard" selected>Standard</option>
                                    <option value="Deluxe">Deluxe</option>
                                    <option value="Suite">Suite</option>
                                    <option value="Presidential">Presidential</option>
                                </select>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Price per Night (Rp)</label>
                            <input type="number" class="form-control" value="350000" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Status</label>
                            <select class="form-select" required>
                                <option value="tersedia" selected>Tersedia</option>
                                <option value="dipesan">Dipesan</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Update Photo</label>
                            <input type="file" class="form-control" accept="image/*">
                            <div class="mt-2">
                                <span class="d-block text-muted" style="font-size: 0.8rem; margin-bottom: 5px;">Current Photo:</span>
                                <img src="https://images.unsplash.com/photo-1611892440504-42a792e24d32?auto=format&fit=crop&w=150&q=80" alt="Current Photo" class="room-img-thumb" style="width: 120px; height: 80px;">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal" style="border-radius: 8px;">Cancel</button>
                    <button type="button" class="btn btn-accent">Update Room</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Simple script to handle delete button confirmation
        document.querySelectorAll('.btn-delete').forEach(button => {
            button.addEventListener('click', function() {
                if(confirm('Are you sure you want to delete this room? This action cannot be undone.')) {
                    // Logic to delete item would go here
                    alert('Room deleted (demo)!');
                }
            });
        });
    </script>
</body>
</html>
