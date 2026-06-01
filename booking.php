<?php
session_start();
require_once 'config/koneksi.php';

$bookingSuccess = false;
$bookingError = '';

// Protect: only authenticated users may access this page
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}


// Fetch available rooms for the dropdown
$stmtRooms = $koneksi->prepare("SELECT id_kamar, tipe_kamar, harga FROM kamar WHERE status = 'tersedia'");
$stmtRooms->execute();
$availableRooms = $stmtRooms->get_result()->fetch_all(MYSQLI_ASSOC);

// Generate CSRF token if not set
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // CSRF check
    if (!isset($_POST['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
        $bookingError = 'Invalid request. Please try again.';
    } else {
        $roomId   = $_POST['room_id']   ?? '';
        $checkIn  = $_POST['check_in']  ?? '';
        $checkOut = $_POST['check_out'] ?? '';

        if (empty($roomId) || empty($checkIn) || empty($checkOut)) {
            $bookingError = 'Please fill in all required fields.';
        } elseif ($checkOut <= $checkIn) {
            $bookingError = 'Check-out date must be after check-in date.';
        } else {
            // Look up id_kamar and harga by id_kamar where status = tersedia
            $stmtRoom = $koneksi->prepare(
                "SELECT id_kamar, harga FROM kamar WHERE id_kamar = ? AND status = 'tersedia' LIMIT 1"
            );
            $stmtRoom->bind_param('i', $roomId);
            $stmtRoom->execute();
            $roomResult = $stmtRoom->get_result();

                if ($roomResult->num_rows === 0) {
                    $bookingError = 'Sorry, that room is no longer available. Please select another.';
                } else {
                    $roomRow  = $roomResult->fetch_assoc();
                    $idKamar  = $roomRow['id_kamar'];
                    $hargaPerMalam = $roomRow['harga'];
                    $idUser   = $_SESSION['user_id'];
                    
                    $datetime1 = new DateTime($checkIn);
                    $datetime2 = new DateTime($checkOut);
                    $interval = $datetime1->diff($datetime2);
                    $nights = $interval->days;
                    
                    if ($nights <= 0) {
                        $bookingError = 'Check-out date must be after check-in date.';
                    } else {
                        $totalHargaCalculated = $hargaPerMalam * $nights;
                        
                        // Insert reservation
                        $stmtIns = $koneksi->prepare(
                            "INSERT INTO reservasi (id_user, id_kamar, check_in, check_out, total_harga, status)
                             VALUES (?, ?, ?, ?, ?, 'pending')"
                        );
                        $stmtIns->bind_param('iissi', $idUser, $idKamar, $checkIn, $checkOut, $totalHargaCalculated);

                        if ($stmtIns->execute()) {
                            // Mark room as booked
                            $stmtUpd = $koneksi->prepare(
                                "UPDATE kamar SET status = 'dipesan' WHERE id_kamar = ?"
                            );
                            $stmtUpd->bind_param('i', $idKamar);
                            $stmtUpd->execute();

                            $bookingSuccess = true;
                            // Regenerate CSRF token after use
                            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
                        } else {
                            $bookingError = 'Booking failed. Please try again.';
                        }
                    }
                }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking & Reservation | Almaris Hotel</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <!-- AOS Animation -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <!-- Custom Styles -->
    <link href="assets/css/styles.css" rel="stylesheet">
    <style>
        .page-header {
            height: 40vh;
            min-height: 300px;
            background: url('https://images.unsplash.com/photo-1542314831-068cd1dbfeeb?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80') center/cover no-repeat;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 50px;
        }
        .page-header::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            background: rgba(15, 23, 42, 0.7);
        }
        .page-header-content {
            position: relative;
            z-index: 2;
            text-align: center;
        }
        #navbar {
            background: rgba(15, 23, 42, 0.95);
            backdrop-filter: blur(10px);
            padding: 15px 0;
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
        }
        .booking-card {
            background: var(--color-white);
            border-radius: var(--radius-md);
            padding: 40px;
            box-shadow: var(--shadow-soft);
            border: 1px solid rgba(0,0,0,0.05);
        }
        .summary-card {
            background: var(--color-navy);
            color: var(--color-white);
            border-radius: var(--radius-md);
            padding: 40px;
            box-shadow: var(--shadow-soft);
            position: sticky;
            top: 100px;
        }
        .summary-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: var(--radius-sm);
            margin-bottom: 20px;
        }
        .divider-light {
            border-top: 1px solid rgba(255,255,255,0.1);
            margin: 20px 0;
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg fixed-top" id="navbar">
        <div class="container">
            <a class="navbar-brand fw-bold" href="index.php">ALMARIS</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <i class="bi bi-list text-white fs-2"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php#home">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php#about">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="kamar.php">Rooms</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php#facilities">Facilities</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php#contact">Contact</a>
                    </li>
                </ul>
                <div class="d-flex align-items-center gap-3 auth-buttons">
                    <?php if (isset($_SESSION['user_id'])): ?>
                        <?php
                            $dashboardUrl = (isset($_SESSION['role']) && $_SESSION['role'] === 'admin')
                                ? 'admin/dashboard.php'
                                : 'user/dashboard.php';
                        ?>
                        <span class="text-white-50 d-none d-lg-inline" style="font-size:0.85rem;">Hi, <?= htmlspecialchars($_SESSION['nama']) ?></span>
                        <a href="<?= $dashboardUrl ?>" class="navbar-action-btn dashboard-btn">
                            <i class="bi bi-grid-1x2"></i>
                            <span>Dashboard</span>
                        </a>
                        <a href="logout.php" class="navbar-action-btn logout-btn">
                            <i class="bi bi-box-arrow-right"></i>
                            <span>Logout</span>
                        </a>
                    <?php else: ?>
                        <a href="login.php" class="text-white text-decoration-none nav-link-custom">Login</a>
                        <a href="register.php" class="btn btn-gold">Sign Up</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </nav>

    <!-- Page Header -->
    <div class="page-header">
        <div class="page-header-content container" data-aos="fade-up" data-aos-duration="1000">
            <span class="text-gold fw-bold text-uppercase tracking-wide fs-7 mb-2 d-block">Reservation</span>
            <h1 class="display-4 fw-bold text-white mb-3">Complete Your Booking</h1>
        </div>
    </div>

    <!-- Booking Section -->
    <section class="section-padding pt-0">
        <div class="container">

            <?php if ($bookingSuccess): ?>
            <!-- Success Message -->
            <div class="row justify-content-center mb-5" data-aos="fade-up">
                <div class="col-lg-8 text-center">
                    <div class="p-5 rounded-4 shadow-soft" style="background: white;">
                        <div class="mb-4" style="font-size: 4rem;">🎉</div>
                        <h2 class="fw-bold text-navy mb-3">Booking Confirmed!</h2>
                        <p class="text-muted mb-4">Your reservation has been successfully submitted with status <strong>Pending</strong>. Our team will confirm it shortly.</p>
                        <div class="d-flex justify-content-center gap-3">
                            <a href="user/dashboard.php" class="btn btn-gold px-4 py-2 fw-bold shadow-gold"><i class="bi bi-grid me-2"></i>Go to Dashboard</a>
                            <a href="user/riwayat.php" class="btn btn-outline-navy px-4 py-2 fw-bold"><i class="bi bi-clock-history me-2"></i>View History</a>
                        </div>
                    </div>
                </div>
            </div>
            <?php else: ?>

            <?php if (!empty($bookingError)): ?>
            <div class="alert alert-danger alert-dismissible fade show rounded-3 mb-4" role="alert">
                <i class="bi bi-exclamation-triangle-fill me-2"></i><?= htmlspecialchars($bookingError) ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            <?php endif; ?>

            <form id="bookingForm" action="booking.php" method="POST">
                <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token']) ?>">
                <input type="hidden" name="room_id" id="roomIdInput" value="">
                <input type="hidden" name="check_in" id="checkInHidden" value="">
                <input type="hidden" name="check_out" id="checkOutHidden" value="">
                <input type="hidden" name="total_harga" id="totalHargaInput" value="">
                <div class="row g-5">
                    
                    <!-- Left Column: Booking Details -->
                    <div class="col-lg-7" data-aos="fade-right" data-aos-delay="100">
                        <div class="booking-card">
                            <h3 class="fw-bold text-navy mb-4 pb-3 border-bottom">Booking Information</h3>
                            
                            <div class="row g-4">
                                <div class="col-md-12">
                                    <label class="form-label text-navy fw-semibold fs-7 text-uppercase tracking-wide">Select Room</label>
                                    <div class="input-container">
                                        <i class="bi bi-door-open"></i>
                                        <select class="form-select custom-input" id="roomSelect" required>
                                            <option value="" disabled selected>Choose your room...</option>
                                            <?php foreach ($availableRooms as $room): ?>
                                                <option value="<?= $room['id_kamar'] ?>" data-name="<?= htmlspecialchars($room['tipe_kamar']) ?>" data-price="<?= $room['harga'] ?>">
                                                    <?= htmlspecialchars($room['tipe_kamar']) ?> (Rp <?= number_format($room['harga'], 0, ',', '.') ?> / Night)
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label text-navy fw-semibold fs-7 text-uppercase tracking-wide">Check-in Date</label>
                                    <div class="input-container">
                                        <i class="bi bi-calendar3"></i>
                                        <input type="date" class="form-control custom-input" id="checkIn" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label text-navy fw-semibold fs-7 text-uppercase tracking-wide">Check-out Date</label>
                                    <div class="input-container">
                                        <i class="bi bi-calendar3"></i>
                                        <input type="date" class="form-control custom-input" id="checkOut" required>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label text-navy fw-semibold fs-7 text-uppercase tracking-wide">Guests</label>
                                    <div class="input-container">
                                        <i class="bi bi-people"></i>
                                        <select class="form-select custom-input" required>
                                            <option value="1">1 Person</option>
                                            <option value="2" selected>2 Persons</option>
                                            <option value="3">3 Persons</option>
                                            <option value="4">4 Persons</option>
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <label class="form-label text-navy fw-semibold fs-7 text-uppercase tracking-wide">Phone Number</label>
                                    <div class="input-container">
                                        <i class="bi bi-telephone"></i>
                                        <input type="tel" class="form-control custom-input" placeholder="+62 812..." required>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <label class="form-label text-navy fw-semibold fs-7 text-uppercase tracking-wide">Special Requests (Optional)</label>
                                    <textarea class="form-control p-3 bg-light-gray border-0" rows="4" placeholder="Any special requests or preferences..."></textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Right Column: Summary -->
                    <div class="col-lg-5" data-aos="fade-left" data-aos-delay="200">
                        <div class="summary-card">
                            <h4 class="fw-bold text-white mb-4">Booking Summary</h4>
                            
                            <img src="https://images.unsplash.com/photo-1611892440504-42a792e24d32?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Room Image" class="summary-image" id="summaryImage">
                            
                            <h5 class="fw-bold text-gold mb-3" id="summaryRoomName">Deluxe Ocean View</h5>
                            
                            <div class="d-flex justify-content-between mb-2 fs-7 text-white-50">
                                <span>Price per Night</span>
                                <span class="text-white" id="summaryPricePerNight">Rp 1.500.000</span>
                            </div>
                            
                            <div class="d-flex justify-content-between mb-2 fs-7 text-white-50">
                                <span>Duration</span>
                                <span class="text-white"><span id="summaryNights">1</span> Night(s)</span>
                            </div>

                            <div class="divider-light"></div>
                            
                            <div class="d-flex justify-content-between mb-4">
                                <span class="fs-5">Total Price</span>
                                <span class="fs-4 fw-bold text-gold" id="summaryTotalPrice">Rp 1.500.000</span>
                            </div>
                            
                            <button type="submit" class="btn btn-gold w-100 py-3 fw-bold fs-5 shadow-gold mt-2">
                                Confirm Booking
                            </button>
                            
                            <p class="text-center text-white-50 fs-7 mt-3 mb-0">
                                <i class="bi bi-shield-check text-gold me-1"></i> Secure and encrypted payment
                            </p>
                        </div>
                    </div>

                </div>
            </form>
            <?php endif; ?>

        </div>
    </section>

    <!-- Footer -->
    <footer id="contact" class="footer-section">
        <div class="container">
            <div class="row gy-5">
                <div class="col-lg-4 col-md-6 pe-lg-5">
                    <a class="navbar-brand fw-bold text-white fs-2 mb-4 d-block" href="index.php">ALMARIS</a>
                    <p class="text-white-50 mb-4">Almaris Hotel Reservation Website memberikan pengalaman reservasi yang mudah, cepat, dan terpercaya untuk liburan sempurna Anda.</p>
                    <div class="social-links d-flex gap-3">
                        <a href="#"><i class="bi bi-facebook"></i></a>
                        <a href="#"><i class="bi bi-instagram"></i></a>
                        <a href="#"><i class="bi bi-twitter-x"></i></a>
                        <a href="#"><i class="bi bi-youtube"></i></a>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6">
                    <h5 class="text-white fw-bold mb-4">Quick Links</h5>
                    <ul class="list-unstyled footer-links">
                        <li><a href="index.php#home">Home</a></li>
                        <li><a href="index.php#about">About Us</a></li>
                        <li><a href="kamar.php">Rooms</a></li>
                        <li><a href="index.php#facilities">Facilities</a></li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h5 class="text-white fw-bold mb-4">Support</h5>
                    <ul class="list-unstyled footer-links">
                        <li><a href="#">FAQ</a></li>
                        <li><a href="#">Terms & Conditions</a></li>
                        <li><a href="#">Privacy Policy</a></li>
                        <li><a href="#">Help Center</a></li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h5 class="text-white fw-bold mb-4">Contact Us</h5>
                    <ul class="list-unstyled footer-contact text-white-50">
                        <li class="mb-3 d-flex"><i class="bi bi-geo-alt text-gold me-3 fs-5"></i> 123 Luxury Avenue, Metropolis, 10012</li>
                        <li class="mb-3 d-flex"><i class="bi bi-envelope text-gold me-3 fs-5"></i> info@almarishotel.com</li>
                        <li class="d-flex"><i class="bi bi-telephone text-gold me-3 fs-5"></i> +62 812 3456 7890</li>
                    </ul>
                </div>
            </div>
            <div class="footer-bottom mt-5 pt-4 border-top border-secondary text-center text-white-50">
                <p class="mb-0">&copy; 2026 Almaris Hotel. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="assets/js/script.js"></script>
    
    <!-- Booking Logic Script -->
    <script src="assets/js/booking.js"></script>
</body>
</html>
