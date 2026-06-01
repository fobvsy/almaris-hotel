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

// Handle Delete
if (isset($_GET['delete'])) {
    $id_delete = (int)$_GET['delete'];
    if ($id_delete === (int)$_SESSION['user_id']) {
        $_SESSION['alert'] = "Swal.fire('Error!', 'You cannot delete your own account.', 'error');";
    } else {
        $stmt = $koneksi->prepare("DELETE FROM users WHERE id_user = ?");
        $stmt->bind_param("i", $id_delete);
        if ($stmt->execute()) {
            $_SESSION['alert'] = "Swal.fire('Deleted!', 'The user has been deleted successfully.', 'success');";
        } else {
            $_SESSION['alert'] = "Swal.fire('Error!', 'Failed to delete user.', 'error');";
        }
        $stmt->close();
    }
    header("Location: user.php");
    exit;
}

// Handle Change Password
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'change_password') {
    $id_user = (int)$_POST['id_user'];
    $new_password = $_POST['new_password'];
    
    // Hash password
    $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
    
    $stmt = $koneksi->prepare("UPDATE users SET password = ? WHERE id_user = ?");
    $stmt->bind_param("si", $hashed_password, $id_user);
    if ($stmt->execute()) {
        $_SESSION['alert'] = "Swal.fire('Success!', 'Password has been updated successfully.', 'success');";
    } else {
        $_SESSION['alert'] = "Swal.fire('Error!', 'Failed to update password.', 'error');";
    }
    $stmt->close();
    header("Location: user.php");
    exit;
}

$alert = '';
if (isset($_SESSION['alert'])) {
    $alert = $_SESSION['alert'];
    unset($_SESSION['alert']);
}

// Fetch all users
$queryUsers = $koneksi->query("SELECT * FROM users ORDER BY created_at DESC");
$users = $queryUsers->fetch_all(MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users - Almaris Admin</title>
    
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

        .role-badge {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 500;
        }

        .role-admin { background-color: #DBEAFE; color: #1E40AF; }
        .role-user { background-color: #F3F4F6; color: #4B5563; }

        .action-btn {
            width: 32px;
            height: 32px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 8px;
            border: none;
            transition: 0.2s;
        }
        
        .btn-edit { background-color: #DBEAFE; color: #1E40AF; }
        .btn-edit:hover { background-color: #BFDBFE; }
        .btn-delete { background-color: #FEE2E2; color: #991B1B; }
        .btn-delete:hover { background-color: #FECACA; }

        /* User Avatar Placeholder */
        .user-avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background-color: var(--primary);
            color: var(--accent);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 0.9rem;
            margin-right: 12px;
        }

        .search-input {
            border-radius: 8px;
            padding: 10px 16px;
            border: 1px solid #D1D5DB;
        }
        .search-input:focus {
            border-color: var(--accent);
            box-shadow: 0 0 0 0.25rem rgba(212, 175, 55, 0.25);
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
            <a href="reservasi.php" class="nav-item">
                <i class="fas fa-calendar-alt"></i> Reservations
            </a>
            <a href="user.php" class="nav-item active">
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
                <h1 class="page-title">Manage Users</h1>
                <p class="text-muted mb-0">View registered users and manage their accounts.</p>
            </div>
            <div class="user-profile d-flex align-items-center">
                <div class="text-end me-3">
                    <div class="fw-bold" style="font-size: 0.9rem; color: var(--primary);"><?= htmlspecialchars($adminName) ?></div>
                    <div class="text-muted" style="font-size: 0.75rem;"><?= htmlspecialchars($adminEmail) ?></div>
                </div>
                <div class="user-avatar" style="margin-right: 0; width: 40px; height: 40px;">
                    <?= strtoupper(substr($adminName, 0, 1)) ?>
                </div>
            </div>
        </div>

        <div class="modern-card">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h5 class="mb-0" style="color: var(--primary); font-weight: 600;">Registered Users List</h5>
                
                <div class="input-group" style="width: 300px;">
                    <span class="input-group-text bg-white border-end-0"><i class="fas fa-search text-muted"></i></span>
                    <input type="text" class="form-control search-input border-start-0 ps-0" placeholder="Search by name or email...">
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>User ID</th>
                            <th>Name</th>
                            <th>Email Address</th>
                            <th>Role</th>
                            <th width="100" class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($users)): ?>
                            <tr>
                                <td colspan="5" class="text-center py-4 text-muted">No users found.</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($users as $u): ?>
                                <?php
                                    $firstLetter = strtoupper(substr($u['nama'], 0, 1));
                                    $isAdmin = ($u['role'] === 'admin');
                                    $avatarStyle = $isAdmin 
                                        ? "background-color: var(--primary); color: var(--accent);" 
                                        : "background-color: #DBEAFE; color: #1E40AF;";
                                ?>
                                <tr>
                                    <td><span class="text-muted fw-medium">#USR-<?= htmlspecialchars($u['id_user']) ?></span></td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="user-avatar" style="<?= $avatarStyle ?>"><?= $firstLetter ?></div>
                                            <span class="fw-bold <?= $isAdmin ? 'text-primary' : '' ?>"><?= htmlspecialchars($u['nama']) ?></span>
                                        </div>
                                    </td>
                                    <td><?= htmlspecialchars($u['email']) ?></td>
                                    <td><span class="role-badge <?= $isAdmin ? 'role-admin' : 'role-user' ?>"><?= ucfirst(htmlspecialchars($u['role'])) ?></span></td>
                                    <td class="text-center">
                                        <?php if ($isAdmin): ?>
                                            <button class="action-btn btn-delete" title="Delete User" disabled style="opacity: 0.5; cursor: not-allowed;">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        <?php else: ?>
                                            <button class="action-btn btn-edit me-1" onclick="openPasswordModal(<?= $u['id_user'] ?>, '<?= htmlspecialchars(addslashes($u['nama'])) ?>')" title="Change Password">
                                                <i class="fas fa-key"></i>
                                            </button>
                                            <button class="action-btn btn-delete" onclick="confirmDelete(<?= $u['id_user'] ?>)" title="Delete User">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination (UI only) -->
            <div class="d-flex justify-content-between align-items-center mt-4 pt-3 border-top">
                <span class="text-muted" style="font-size: 0.85rem;">Showing 1 to 4 of 156 entries</span>
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

    <!-- Change Password Modal -->
    <div class="modal fade" id="changePasswordModal" tabindex="-1" aria-labelledby="changePasswordModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border-radius: 16px; border: none;">
                <div class="modal-header" style="border-bottom: 1px solid #E5E7EB; padding: 20px 24px;">
                    <h5 class="modal-title" id="changePasswordModalLabel" style="color: var(--primary); font-weight: 600;">Change Password</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" style="padding: 24px;">
                    <p class="mb-3 text-muted" style="font-size: 0.9rem;">Change password for user: <strong id="modalUserName" class="text-primary"></strong></p>
                    <form action="user.php" method="POST" id="changePasswordForm">
                        <input type="hidden" name="action" value="change_password">
                        <input type="hidden" name="id_user" id="pwd_id_user">
                        
                        <div class="mb-3">
                            <label class="form-label" style="font-weight: 500; color: var(--primary); font-size: 0.9rem;">New Password</label>
                            <input type="password" name="new_password" class="form-control" style="border-radius: 8px; padding: 12px 16px; border: 1px solid #D1D5DB;" required minlength="6" placeholder="Enter new password">
                        </div>
                    </form>
                </div>
                <div class="modal-footer" style="border-top: 1px solid #E5E7EB; padding: 16px 24px;">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal" style="border-radius: 8px;">Cancel</button>
                    <button type="submit" form="changePasswordForm" class="btn" style="background-color: var(--accent); color: var(--primary); font-weight: 500; border-radius: 8px; padding: 8px 20px;">Save Password</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        function confirmDelete(id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this! This action will remove the user permanently.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#991B1B',
                cancelButtonColor: '#6B7280',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'user.php?delete=' + id;
                }
            })
        }

        function openPasswordModal(id, name) {
            document.getElementById('pwd_id_user').value = id;
            document.getElementById('modalUserName').innerText = name;
            var modal = new bootstrap.Modal(document.getElementById('changePasswordModal'));
            modal.show();
        }

        document.addEventListener('DOMContentLoaded', function() {
            <?php if (!empty($alert)): ?>
                <?= $alert ?>
            <?php endif; ?>
        });
    </script>
</body>
</html>
