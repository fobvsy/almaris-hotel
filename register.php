<?php
session_start();
require_once 'config/koneksi.php';

// If already logged in, redirect
if (isset($_SESSION['user_id'])) {
    if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin') {
        header("Location: admin/dashboard.php");
    } else {
        header("Location: index.php");
    }
    exit;
}

// Generate CSRF token if not exists
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate CSRF token
    if (!isset($_POST['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
        $error = "Invalid CSRF token.";
    } else {
        $nama     = trim($_POST['nama'] ?? '');
        $email    = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';

        if (empty($nama) || empty($email) || empty($password)) {
            $error = "All fields are required.";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error = "Invalid email format.";
        } else {
            // Check if email exists
            $stmt = $koneksi->prepare("SELECT id_user FROM users WHERE email = ?");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $stmt->store_result();

            if ($stmt->num_rows > 0) {
                $error = "Email is already registered.";
            } else {
                // Hash password
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                $role = 'user'; // Default role

                // Insert new user
                $insert_stmt = $koneksi->prepare("INSERT INTO users (nama, email, password, role) VALUES (?, ?, ?, ?)");
                $insert_stmt->bind_param("ssss", $nama, $email, $hashed_password, $role);

                if ($insert_stmt->execute()) {
                    $success = "Account created successfully! You can now login.";
                    $nama  = '';
                    $email = '';
                } else {
                    $error = "An error occurred during registration. Please try again.";
                }
                $insert_stmt->close();
            }
            $stmt->close();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account - Almaris Luxury Hotel</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <!-- Custom Styles -->
    <link href="assets/css/styles.css" rel="stylesheet">
    <style>
        .auth-section {
            min-height: 100vh;
            background: linear-gradient(135deg, rgba(15,23,42,0.85) 0%, rgba(15,23,42,0.95) 100%), url('https://images.unsplash.com/photo-1542314831-068cd1dbfeeb?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80') center/cover no-repeat;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 20px;
        }
        .auth-card {
            width: 100%;
            max-width: 500px;
            padding: 40px;
        }
        .auth-input-group .input-group-text {
            background: transparent;
            border-right: none;
            color: var(--color-gold);
            border-color: #E2E8F0;
        }
        .auth-input-group .form-control {
            border-left: none;
            padding-left: 0;
        }
        .auth-input-group .form-control:focus {
            border-color: var(--color-gold);
            box-shadow: none;
        }
        .auth-input-group:focus-within .input-group-text,
        .auth-input-group:focus-within .form-control {
            border-color: var(--color-gold);
        }
        .back-home {
            position: absolute;
            top: 30px;
            left: 30px;
            color: rgba(255,255,255,0.7);
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s;
        }
        .back-home:hover {
            color: var(--color-gold);
        }
    </style>
</head>
<body>

    <a href="index.php" class="back-home d-none d-md-flex align-items-center gap-2">
        <i class="bi bi-arrow-left"></i> Back to Home
    </a>

    <section class="auth-section">
        <div class="glassmorphism auth-card">
            <div class="text-center mb-4">
                <a href="index.php" class="text-decoration-none">
                    <h2 class="fw-bold text-navy mb-1" style="font-family: var(--font-heading);">ALMARIS</h2>
                </a>
                <p class="text-muted fs-7">Create an account to start your journey.</p>
            </div>

            <?php if (!empty($error)): ?>
                <div class="alert alert-danger p-2 fs-7 text-center"><?= htmlspecialchars($error) ?></div>
            <?php endif; ?>
            <?php if (!empty($success)): ?>
                <div class="alert alert-success p-2 fs-7 text-center">
                    <?= htmlspecialchars($success) ?> <a href="login.php" class="alert-link">Login here</a>
                </div>
            <?php endif; ?>

            <form action="register.php" method="POST">
                <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token']) ?>">

                <div class="mb-4">
                    <label class="form-label fw-medium text-navy fs-7">Full Name</label>
                    <div class="input-group auth-input-group">
                        <span class="input-group-text"><i class="bi bi-person"></i></span>
                        <input type="text" class="form-control custom-input" name="nama" placeholder="Enter your full name" value="<?= isset($nama) ? htmlspecialchars($nama) : '' ?>" required>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-medium text-navy fs-7">Email Address</label>
                    <div class="input-group auth-input-group">
                        <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                        <input type="email" class="form-control custom-input" name="email" placeholder="Enter your email" value="<?= isset($email) ? htmlspecialchars($email) : '' ?>" required>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-medium text-navy fs-7">Password</label>
                    <div class="input-group auth-input-group">
                        <span class="input-group-text"><i class="bi bi-lock"></i></span>
                        <input type="password" class="form-control custom-input" name="password" placeholder="Create a strong password" required>
                    </div>
                </div>

                <div class="mb-4 form-check">
                    <input type="checkbox" class="form-check-input" id="agreeTerms" required>
                    <label class="form-check-label text-muted fs-7" for="agreeTerms">
                        I agree to the <a href="#" class="text-gold text-decoration-none">Terms of Service</a> &amp; <a href="#" class="text-gold text-decoration-none">Privacy Policy</a>
                    </label>
                </div>

                <button type="submit" class="btn btn-navy w-100 py-3 fw-bold mb-4" style="background: var(--color-navy); color: white;">
                    Create Account <i class="bi bi-person-plus ms-2"></i>
                </button>
            </form>

            <div class="text-center">
                <p class="text-muted fs-7 mb-0">Already have an account? <a href="login.php" class="text-gold fw-bold text-decoration-none">Sign In</a></p>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
