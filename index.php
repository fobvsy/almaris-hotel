<?php 
session_start(); 
require_once 'config/koneksi.php';

// Fetch 3 featured rooms for index
$queryFeatured = $koneksi->query("SELECT * FROM kamar GROUP BY tipe_kamar ASC LIMIT 3");
$featuredRooms = [];
if ($queryFeatured) {
    $featuredRooms = $queryFeatured->fetch_all(MYSQLI_ASSOC);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Almaris | Modern Luxury Hotel</title>
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
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg fixed-top" id="navbar">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">ALMARIS</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <i class="bi bi-list text-white fs-2"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="#home">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#about">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#rooms">Rooms</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#facilities">Facilities</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#contact">Contact</a>
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

    <!-- Hero Section -->
    <section id="home" class="hero-section">
        <div class="hero-overlay"></div>
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-lg-8 hero-content" data-aos="fade-up" data-aos-duration="1000">
                    <span class="badge-custom mb-3">Welcome to Paradise</span>
                    <h1 class="display-1 fw-bold text-white mb-4">Experience Unrivaled <br><span class="text-gold">Luxury</span></h1>
                    <p class="lead text-white-50 mb-5">Discover a world of comfort, elegance, and impeccable service at Almaris Hotel. Your perfect staycation begins here.</p>
                    <div class="d-flex gap-3">
                        <a href="#rooms" class="btn btn-gold btn-lg">Explore Rooms <i class="bi bi-arrow-right ms-2"></i></a>
                        <a href="https://youtu.be/cdKx1Zv3YKs?si=XQ38Ww_JImh9uax8" target="_blank" class="btn btn-outline-light btn-lg d-flex align-items-center gap-2">
                            <i class="bi bi-play-circle-fill"></i> Watch Video
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Booking Bar -->
    <div class="container booking-bar-wrapper" data-aos="fade-up" data-aos-delay="200">
        <div class="booking-bar glassmorphism">
            <form class="row g-4 align-items-end">
                <div class="col-lg-3 col-md-6">
                    <div class="form-group">
                        <label class="text-uppercase text-gold mb-2 fw-semibold fs-7">Check In</label>
                        <div class="input-container">
                            <i class="bi bi-calendar3"></i>
                            <input type="date" class="form-control custom-input" required>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="form-group">
                        <label class="text-uppercase text-gold mb-2 fw-semibold fs-7">Check Out</label>
                        <div class="input-container">
                            <i class="bi bi-calendar3"></i>
                            <input type="date" class="form-control custom-input" required>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="form-group">
                        <label class="text-uppercase text-gold mb-2 fw-semibold fs-7">Guests</label>
                        <div class="input-container">
                            <i class="bi bi-people"></i>
                            <select class="form-select custom-input">
                                <option value="1">1 Person</option>
                                <option value="2" selected>2 Persons</option>
                                <option value="3">3 Persons</option>
                                <option value="4">4 Persons</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <button type="button" class="btn btn-gold w-100 py-3 fw-bold shadow-gold">Check Availability</button>
                </div>
            </form>
        </div>
    </div>

    <!-- About Section -->
    <section id="about" class="section-padding">
        <div class="container">
            <div class="row align-items-center gy-5">
                <div class="col-lg-6 relative" data-aos="fade-right">
                    <div class="about-image-wrapper">
                        <img src="https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Hotel Interior" class="img-fluid rounded-4 shadow-lg main-img">
                        <div class="experience-badge glass-dark">
                            <h3 class="text-gold fw-bold mb-0">15+</h3>
                            <p class="text-white mb-0 fs-7 text-uppercase">Years Experience</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 offset-lg-1" data-aos="fade-left">
                    <span class="text-gold fw-bold text-uppercase tracking-wide fs-7 mb-2 d-block">About Almaris</span>
                    <h2 class="display-5 fw-bold text-navy mb-4">A Legacy of <br>Premium Hospitality</h2>
                    <p class="text-muted mb-4 lh-lg">Nestled in the heart of the city, Almaris Hotel redefines luxury living. With breathtaking views, bespoke services, and meticulously designed interiors, every moment of your stay is crafted to perfection.</p>
                    
                    <ul class="list-unstyled mb-5">
                        <li class="d-flex align-items-center mb-3">
                            <div class="icon-box-small me-3"><i class="bi bi-check-lg"></i></div>
                            <span class="fw-medium text-navy">World-class luxury suites</span>
                        </li>
                        <li class="d-flex align-items-center mb-3">
                            <div class="icon-box-small me-3"><i class="bi bi-check-lg"></i></div>
                            <span class="fw-medium text-navy">Award-winning dining experience</span>
                        </li>
                        <li class="d-flex align-items-center">
                            <div class="icon-box-small me-3"><i class="bi bi-check-lg"></i></div>
                            <span class="fw-medium text-navy">24/7 personalized concierge</span>
                        </li>
                    </ul>
                    
                    <a href="#" class="btn btn-outline-navy btn-lg">Discover More</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Rooms Section -->
    <section id="rooms" class="section-padding bg-light-gray">
        <div class="container">
            <div class="text-center mb-5 pb-3" data-aos="fade-up">
                <span class="text-gold fw-bold text-uppercase tracking-wide fs-7 mb-2 d-block">Our Accommodations</span>
                <h2 class="display-5 fw-bold text-navy">Featured Rooms</h2>
                <div class="divider mx-auto mt-3"></div>
            </div>

            <div class="row g-4">
                <?php if (empty($featuredRooms)): ?>
                    <div class="col-12 text-center text-muted">No featured rooms available.</div>
                <?php else: ?>
                    <?php 
                    $delay = 100;
                    foreach ($featuredRooms as $room): 
                        $tipe = strtolower($room['tipe_kamar']);
                        $size = "32 sqm"; $guests = "2 Guests"; $extra = "Free Wifi";
                        $iconExtra = "bi-wifi";
                        if (strpos($tipe, 'deluxe') !== false) { $size = "45 sqm"; }
                        if (strpos($tipe, 'suite') !== false) { $size = "65 sqm"; $guests = "3 Guests"; $extra = "Breakfast"; $iconExtra = "bi-cup-hot"; }
                        if (strpos($tipe, 'presidential') !== false) { $size = "120 sqm"; $guests = "4 Guests"; $extra = "VIP"; $iconExtra = "bi-star"; }
                        
                        $fotoSrc = (!empty($room['foto']) && file_exists('assets/images/' . $room['foto'])) 
                                   ? 'assets/images/' . $room['foto'] 
                                   : 'https://images.unsplash.com/photo-1578683010236-d716f9a3f461?auto=format&fit=crop&w=800&q=80';
                        
                        $priceFormat = $room['harga'] >= 1000000 
                            ? rtrim(rtrim(number_format($room['harga'] / 1000000, 2, '.', ''), '0'), '.') . 'M' 
                            : number_format($room['harga'], 0, ',', '.');
                    ?>
                    <!-- Room -->
                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="<?= $delay ?>">
                        <div class="room-card">
                            <div class="room-img-wrapper">
                                <img src="<?= htmlspecialchars($fotoSrc) ?>" alt="<?= htmlspecialchars($room['tipe_kamar']) ?>">
                                <div class="room-price">
                                    <span class="fs-4 fw-bold">Rp <?= $priceFormat ?></span> / night
                                </div>
                            </div>
                            <div class="room-content">
                                <h3 class="h4 fw-bold text-navy mb-3"><?= htmlspecialchars($room['tipe_kamar']) ?></h3>
                                <div class="room-amenities d-flex gap-3 mb-4 text-muted fs-7">
                                    <span><i class="bi bi-arrows-fullscreen text-gold me-1"></i> <?= $size ?></span>
                                    <span><i class="bi bi-people text-gold me-1"></i> <?= $guests ?></span>
                                    <span><i class="bi <?= $iconExtra ?> text-gold me-1"></i> <?= $extra ?></span>
                                </div>
                                <p class="text-muted mb-4">Experience ultimate comfort in our <?= htmlspecialchars($room['tipe_kamar']) ?>. Carefully designed to provide a relaxing and memorable stay.</p>
                                <a href="booking.php?id=<?= $room['id_kamar'] ?>" class="btn btn-outline-navy w-100">Book Now</a>
                            </div>
                        </div>
                    </div>
                    <?php 
                        $delay += 100;
                    endforeach; 
                    ?>
                <?php endif; ?>
            </div>
            
            <div class="text-center mt-5" data-aos="fade-up">
                <a href="kamar.php" class="btn btn-link text-navy text-decoration-none fw-bold view-all-link">
                    View All Rooms <i class="bi bi-arrow-right ms-2 transition-transform"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- Facilities Section -->
    <section id="facilities" class="section-padding">
        <div class="container">
            <div class="row align-items-center mb-5 pb-3">
                <div class="col-lg-6" data-aos="fade-right">
                    <span class="text-gold fw-bold text-uppercase tracking-wide fs-7 mb-2 d-block">Premium Services</span>
                    <h2 class="display-5 fw-bold text-navy">Hotel Facilities</h2>
                </div>
                <div class="col-lg-6 text-lg-end mt-4 mt-lg-0" data-aos="fade-left">
                    <p class="text-muted mb-0 max-w-md ms-auto">Immerse yourself in our world-class amenities designed to elevate your stay to new heights of comfort and leisure.</p>
                </div>
            </div>

            <div class="row g-4">
                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="facility-card text-center">
                        <div class="facility-icon mx-auto mb-4">
                            <i class="bi bi-water"></i>
                        </div>
                        <h4 class="fw-bold text-navy mb-3">Infinity Pool</h4>
                        <p class="text-muted fs-7 mb-0">Relax in our temperature-controlled infinity pool overlooking the city skyline.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="facility-card text-center">
                        <div class="facility-icon mx-auto mb-4">
                            <i class="bi bi-shop"></i>
                        </div>
                        <h4 class="fw-bold text-navy mb-3">Restoran</h4>
                        <p class="text-muted fs-7 mb-0">Enjoy delicious, high-quality dishes prepared especially for you.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="300">
                    <div class="facility-card text-center">
                        <div class="facility-icon mx-auto mb-4">
                            <i class="bi bi-heart-pulse"></i>
                        </div>
                        <h4 class="fw-bold text-navy mb-3">Spa & Wellness</h4>
                        <p class="text-muted fs-7 mb-0">Rejuvenate your body and mind with our holistic spa treatments.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="400">
                    <div class="facility-card text-center">
                        <div class="facility-icon mx-auto mb-4">
                            <i class="bi bi-car-front"></i>
                        </div>
                        <h4 class="fw-bold text-navy mb-3">Airport Transfer</h4>
                        <p class="text-muted fs-7 mb-0">Seamless luxury transport to and from the airport for your convenience.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="500">
                    <div class="facility-card text-center">
                        <div class="facility-icon mx-auto mb-4">
                            <i class="bi bi-easel"></i>
                        </div>
                        <h4 class="fw-bold text-navy mb-3">Meeting Room</h4>
                        <p class="text-muted fs-7 mb-0">A modern meeting room with all the amenities you need for your business needs.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="600">
                    <div class="facility-card text-center">
                        <div class="facility-icon mx-auto mb-4">
                            <i class="bi bi-bicycle"></i>
                        </div>
                        <h4 class="fw-bold text-navy mb-3">Fitness Center</h4>
                        <p class="text-muted fs-7 mb-0">Stay in shape during your stay with our state-of-the-art fitness center.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="700">
                    <div class="facility-card text-center">
                        <div class="facility-icon mx-auto mb-4">
                            <i class="bi bi-stars"></i>
                        </div>
                        <h4 class="fw-bold text-navy mb-3">Laundry Service</h4>
                        <p class="text-muted fs-7 mb-0">Professional laundry service to keep your clothes clean and fresh.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="800">
                    <div class="facility-card text-center">
                        <div class="facility-icon mx-auto mb-4">
                            <i class="bi bi-cup-hot"></i>
                        </div>
                        <h4 class="fw-bold text-navy mb-3">Fine Dining</h4>
                        <p class="text-muted fs-7 mb-0">Experience culinary masterpieces crafted by our Michelin-starred chefs.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer id="contact" class="footer-section">
        <div class="container">
            <div class="row gy-5">
                <div class="col-lg-4 col-md-6 pe-lg-5">
                    <a class="navbar-brand fw-bold text-white fs-2 mb-4 d-block" href="#">ALMARIS</a>
                    <p class="text-white-50 mb-4">The Almaris Hotel Reservation Website offers an easy, fast, and reliable booking experience for your perfect vacation.</p>
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
                        <li><a href="#home">Home</a></li>
                        <li><a href="#about">About Us</a></li>
                        <li><a href="#rooms">Rooms</a></li>
                        <li><a href="#facilities">Facilities</a></li>
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
</body>
</html>
