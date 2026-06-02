<?php 
session_start();
require_once 'config/koneksi.php';

// Handle filter and sort
$typeFilter = $_GET['type'] ?? '';
$sortOption = $_GET['sort'] ?? 'recommended';

$whereClause = "";
$orderBy = "GROUP BY tipe_kamar ORDER BY tipe_kamar";

if (!empty($typeFilter)) {
    $typeEscaped = $koneksi->real_escape_string($typeFilter);
    $whereClause = "WHERE tipe_kamar LIKE '%$typeEscaped%'";
}

if ($sortOption === 'price_low') {
    $orderBy = "ORDER BY harga ASC";
} elseif ($sortOption === 'price_high') {
    $orderBy = "ORDER BY harga DESC";
}

$queryKamar = $koneksi->query("SELECT * FROM kamar $whereClause $orderBy");
$rooms = $queryKamar->fetch_all(MYSQLI_ASSOC);

// SweetAlert Session
$alert = '';
if (isset($_SESSION['alert'])) {
    $alert = $_SESSION['alert'];
    unset($_SESSION['alert']);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rooms & Suites | Almaris Hotel</title>
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
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Custom Styles -->
    <link href="assets/css/styles.css" rel="stylesheet">
    <style>
        .page-header {
            height: 50vh;
            min-height: 400px;
            background: url('https://images.unsplash.com/photo-1566073771259-6a8506099945?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80') center/cover no-repeat;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 50px;
            background-attachment: fixed;
        }
        .page-header::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            background: rgba(15, 23, 42, 0.6);
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
        .line-clamp-3 {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
            height: 72px; /* fallback height */
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
                        <a class="nav-link active" href="kamar.php">Rooms</a>
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
            <span class="text-gold fw-bold text-uppercase tracking-wide fs-7 mb-2 d-block">Our Accommodations</span>
            <h1 class="display-3 fw-bold text-white mb-3">Rooms & Suites</h1>
            <p class="lead text-white-50 max-w-md mx-auto mb-0">Experience the perfect blend of comfort and luxury in our meticulously designed rooms.</p>
        </div>
    </div>

    <!-- Filter Section -->
    <div class="container mb-5 mt-n4 position-relative" style="z-index: 10;" data-aos="fade-up" data-aos-delay="200">
        <div class="glassmorphism bg-white p-4 shadow-sm border rounded-4">
            <form action="kamar.php" method="GET" class="row g-3 align-items-end">
                <div class="col-md-4">
                    <label class="form-label text-navy fw-semibold fs-7 text-uppercase tracking-wide">Room Type</label>
                    <div class="input-container">
                        <i class="bi bi-door-open"></i>
                        <select name="type" class="form-select custom-input border-0 bg-light-gray w-100">
                            <option value="">All Types</option>
                            <option value="Standard" <?= stripos($typeFilter, 'Standard') !== false ? 'selected' : '' ?>>Standard Room</option>
                            <option value="Deluxe" <?= stripos($typeFilter, 'Deluxe') !== false ? 'selected' : '' ?>>Deluxe Room</option>
                            <option value="Suite" <?= stripos($typeFilter, 'Suite') !== false ? 'selected' : '' ?>>Suite / Executive</option>
                            <option value="Presidential" <?= stripos($typeFilter, 'Presidential') !== false ? 'selected' : '' ?>>Presidential Suite</option>
                            <option value="Exclusive" <?= stripos($typeFilter, 'Exclusive') !== false ? 'selected' : '' ?>>Exclusive</option>
                            <option value="Family" <?= stripos($typeFilter, 'Family') !== false ? 'selected' : '' ?>>Family</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <label class="form-label text-navy fw-semibold fs-7 text-uppercase tracking-wide">Sort By</label>
                    <div class="input-container">
                        <i class="bi bi-sort-down"></i>
                        <select name="sort" class="form-select custom-input border-0 bg-light-gray w-100">
                            <option value="recommended" <?= $sortOption === 'recommended' ? 'selected' : '' ?>>Recommended</option>
                            <option value="price_low" <?= $sortOption === 'price_low' ? 'selected' : '' ?>>Price: Low to High</option>
                            <option value="price_high" <?= $sortOption === 'price_high' ? 'selected' : '' ?>>Price: High to Low</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <button type="submit" class="btn btn-navy w-100 fw-bold text-white shadow-soft transition-transform" style="background-color: var(--color-navy); height: 50px;">
                        <i class="bi bi-funnel me-2"></i>Filter Rooms
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Rooms List -->
    <section class="section-padding pt-4">
        <div class="container">
            <div class="row g-4">
                
                <?php if (empty($rooms)): ?>
                    <div class="col-12 text-center py-5">
                        <i class="bi bi-journal-x fs-1 text-muted mb-3 d-block"></i>
                        <h4 class="text-navy fw-bold">No Rooms Found</h4>
                        <p class="text-muted">We couldn't find any rooms matching your criteria. Try adjusting your filters.</p>
                        <a href="kamar.php" class="btn btn-outline-navy mt-2" style="border: 2px solid var(--color-navy); color: var(--color-navy); border-radius: 8px; font-weight: 500; padding: 10px 24px; text-decoration: none;">Clear Filters</a>
                    </div>
                <?php else: ?>
                    <?php 
                    $delay = 100;
                    foreach ($rooms as $room): 
                        $statusBadgeClass = ($room['status'] === 'tersedia') ? 'bg-success' : 'bg-danger';
                        $statusLabel = ucfirst($room['status']);
                        
                        // Fake amenities based on room type since the DB doesn't have them
                        $tipe = strtolower($room['tipe_kamar']);
                        $size = "32 sqm"; $guests = "2 Guests"; $extra = "Free Wifi";
                        if (strpos($tipe, 'deluxe') !== false) { $size = "45 sqm"; }
                        if (strpos($tipe, 'suite') !== false) { $size = "65 sqm"; $guests = "3 Guests"; $extra = "Breakfast Included"; }
                        if (strpos($tipe, 'presidential') !== false) { $size = "120 sqm"; $guests = "4 Guests"; $extra = "VIP Access"; }
                        
                        $fotoSrc = (!empty($room['foto']) && file_exists('assets/images/' . $room['foto'])) 
                                   ? 'assets/images/' . $room['foto'] 
                                   : 'https://images.unsplash.com/photo-1578683010236-d716f9a3f461?auto=format&fit=crop&w=800&q=80';
                    ?>
                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="<?= $delay ?>">
                        <div class="room-card h-100 d-flex flex-column" style="background: #fff; border-radius: 16px; overflow: hidden; box-shadow: 0 4px 20px rgba(0,0,0,0.05);">
                            <div class="room-img-wrapper position-relative" style="height: 250px; overflow: hidden;">
                                <img src="<?= $fotoSrc ?>" alt="<?= htmlspecialchars($room['tipe_kamar']) ?>" style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s;">
                                <div class="position-absolute bottom-0 end-0 m-3 p-2 text-white" style="background: rgba(15, 23, 42, 0.85); backdrop-filter: blur(5px); border-radius: 8px;">
                                    <span class="fs-4 fw-bold">Rp <?= number_format($room['harga'], 0, ',', '.') ?></span> / night
                                </div>
                                <div class="position-absolute top-0 start-0 m-3">
                                    <span class="badge <?= $statusBadgeClass ?> px-3 py-2 rounded-pill shadow-sm" style="font-family: var(--font-body); font-weight: 500;"><?= $statusLabel ?></span>
                                </div>
                            </div>
                            <div class="room-content p-4 d-flex flex-column flex-grow-1">
                                <h3 class="h4 fw-bold text-navy mb-3"><?= htmlspecialchars($room['tipe_kamar']) ?> <span class="fs-6 text-muted fw-normal">(No. <?= htmlspecialchars($room['nomor_kamar']) ?>)</span></h3>
                                <div class="room-amenities d-flex flex-wrap gap-3 mb-4 text-muted fs-7">
                                    <span><i class="bi bi-arrows-fullscreen text-gold me-1"></i> <?= $size ?></span>
                                    <span><i class="bi bi-people text-gold me-1"></i> <?= $guests ?></span>
                                    <span><i class="bi bi-star text-gold me-1"></i> <?= $extra ?></span>
                                </div>
                                <p class="text-muted mb-4 line-clamp-3">Experience ultimate comfort in our <?= htmlspecialchars($room['tipe_kamar']) ?>. Carefully designed to provide a relaxing and memorable stay.</p>
                                <div class="d-flex gap-2 mt-auto">
                                    <a href="detail_kamar.php?id=<?= $room['id_kamar'] ?>" class="btn btn-outline-navy flex-grow-1" style="border: 2px solid var(--color-navy); color: var(--color-navy); border-radius: 8px; font-weight: 600;">Detail</a>
                                    <?php if ($room['status'] === 'tersedia'): ?>
                                        <a href="booking.php?id=<?= $room['id_kamar'] ?>" class="btn btn-gold flex-grow-1 shadow-gold" style="border-radius: 8px; font-weight: 600;">Book Now</a>
                                    <?php else: ?>
                                        <button class="btn btn-secondary flex-grow-1 border-0" disabled style="background-color: #CBD5E1; color: #64748B; border-radius: 8px; font-weight: 600;">Unavailable</button>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php 
                        $delay += 100;
                        if ($delay > 300) $delay = 100;
                    endforeach; 
                    ?>
                <?php endif; ?>

            </div>
            
            <!-- Pagination -->
            <div class="mt-5 d-flex justify-content-center" data-aos="fade-up">
                <nav aria-label="Page navigation">
                    <ul class="pagination pagination-lg shadow-sm rounded-3 overflow-hidden">
                        <li class="page-item disabled">
                            <a class="page-link text-navy border-0 bg-white" href="#" tabindex="-1"><i class="bi bi-chevron-left"></i></a>
                        </li>
                        <li class="page-item active"><a class="page-link bg-gold border-gold text-white fw-bold" href="#" style="background-color: var(--color-gold); border-color: var(--color-gold);">1</a></li>
                        <li class="page-item"><a class="page-link text-navy border-0 bg-white" href="#">2</a></li>
                        <li class="page-item"><a class="page-link text-navy border-0 bg-white" href="#">3</a></li>
                        <li class="page-item">
                            <a class="page-link text-navy border-0 bg-white" href="#"><i class="bi bi-chevron-right"></i></a>
                        </li>
                    </ul>
                </nav>
            </div>
            
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
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            <?php if (!empty($alert)): ?>
                <?= $alert ?>
            <?php endif; ?>
        });
    </script>
</body>
</html>
