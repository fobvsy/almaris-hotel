<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Room Details | Almaris Hotel</title>
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
        .detail-hero {
            height: 60vh;
            min-height: 400px;
            background: url('https://images.unsplash.com/photo-1611892440504-42a792e24d32?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80') center/cover no-repeat;
            position: relative;
            display: flex;
            align-items: flex-end;
            padding-bottom: 50px;
            margin-bottom: 50px;
        }
        .detail-hero::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            background: linear-gradient(to top, rgba(15, 23, 42, 0.9) 0%, rgba(15, 23, 42, 0.2) 100%);
        }
        .detail-hero-content {
            position: relative;
            z-index: 2;
            color: white;
            width: 100%;
        }
        #navbar {
            background: rgba(15, 23, 42, 0.95);
            backdrop-filter: blur(10px);
            padding: 15px 0;
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
        }
        
        .amenity-item {
            display: flex;
            align-items: center;
            padding: 15px;
            background: var(--color-gray-light);
            border-radius: var(--radius-sm);
            margin-bottom: 15px;
            transition: all 0.3s;
        }
        .amenity-item:hover {
            background: white;
            box-shadow: var(--shadow-soft);
            transform: translateY(-2px);
        }
        .amenity-icon {
            width: 40px;
            height: 40px;
            background: rgba(212, 175, 55, 0.1);
            color: var(--color-gold);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            margin-right: 15px;
        }
        
        .booking-card-sticky {
            position: sticky;
            top: 100px;
            background: white;
            border-radius: var(--radius-md);
            padding: 30px;
            box-shadow: var(--shadow-soft);
            border: 1px solid rgba(0,0,0,0.05);
        }
        
        .gallery-img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: var(--radius-sm);
            cursor: pointer;
            transition: all 0.3s;
        }
        .gallery-img:hover {
            opacity: 0.8;
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

    <!-- Room Hero -->
    <div class="detail-hero">
        <div class="detail-hero-content container" data-aos="fade-up">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <span class="badge bg-success px-3 py-2 rounded-pill mb-3" style="font-family: var(--font-body); font-size: 0.9rem;">Tersedia</span>
                    <h1 class="display-4 fw-bold mb-2">Deluxe Ocean View</h1>
                    <p class="fs-5 text-white-50 mb-0"><i class="bi bi-geo-alt text-gold me-2"></i>Main Tower, Floor 15-20</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <section class="section-padding pt-0">
        <div class="container">
            <div class="row g-5">
                
                <!-- Left Content: Details -->
                <div class="col-lg-8" data-aos="fade-right">
                    
                    <!-- Overview -->
                    <div class="mb-5">
                        <h3 class="fw-bold text-navy mb-4">Overview</h3>
                        <p class="text-muted lh-lg">
                            Experience the ultimate relaxation in our Deluxe Ocean View room. Elegantly designed with modern aesthetics and touches of luxury, this spacious 45 sqm room offers breathtaking panoramic views of the ocean right from your private balcony.
                        </p>
                        <p class="text-muted lh-lg">
                            Furnished with a plush king-size bed wrapped in premium linens, a comfortable seating area, and a state-of-the-art entertainment system, every detail is crafted to ensure your stay is unforgettable. The marble en-suite bathroom features a walk-in rain shower and exclusive bath amenities.
                        </p>
                    </div>

                    <!-- Room Facilities -->
                    <div class="mb-5">
                        <h3 class="fw-bold text-navy mb-4">Room Facilities</h3>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="amenity-item">
                                    <div class="amenity-icon"><i class="bi bi-arrows-fullscreen"></i></div>
                                    <div class="fw-medium text-navy">45 Square Meters</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="amenity-item">
                                    <div class="amenity-icon"><i class="bi bi-wifi"></i></div>
                                    <div class="fw-medium text-navy">High-Speed Wi-Fi</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="amenity-item">
                                    <div class="amenity-icon"><i class="bi bi-tv"></i></div>
                                    <div class="fw-medium text-navy">55" Smart TV</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="amenity-item">
                                    <div class="amenity-icon"><i class="bi bi-cup-hot"></i></div>
                                    <div class="fw-medium text-navy">Coffee / Tea Maker</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="amenity-item">
                                    <div class="amenity-icon"><i class="bi bi-snow"></i></div>
                                    <div class="fw-medium text-navy">Air Conditioning</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="amenity-item">
                                    <div class="amenity-icon"><i class="bi bi-safe"></i></div>
                                    <div class="fw-medium text-navy">In-Room Safe</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Photo Gallery -->
                    <div>
                        <h3 class="fw-bold text-navy mb-4">Gallery</h3>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <img src="https://images.unsplash.com/photo-1582719478250-c894e4dc240e?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" class="gallery-img" alt="Room Interior">
                            </div>
                            <div class="col-md-6">
                                <img src="https://images.unsplash.com/photo-1584622650111-993a426fbf0a?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" class="gallery-img" alt="Bathroom">
                            </div>
                        </div>
                    </div>

                </div>

                <!-- Right Content: Booking Sidebar -->
                <div class="col-lg-4" data-aos="fade-left" data-aos-delay="200">
                    <div class="booking-card-sticky">
                        <div class="text-center mb-4">
                            <span class="text-muted d-block mb-1">Price Start From</span>
                            <h2 class="fw-bold text-gold mb-0">Rp 1.500.000</h2>
                            <span class="text-muted fs-7">/ night (taxes included)</span>
                        </div>

                        <hr class="text-muted mb-4">

                        <form action="booking.php" method="GET">
                            <!-- Hidden input to pass room ID to booking page -->
                            <input type="hidden" name="room_id" value="1">
                            
                            <div class="mb-3">
                                <label class="form-label text-navy fw-semibold fs-7 text-uppercase">Check-in</label>
                                <input type="date" class="form-control" required>
                            </div>
                            <div class="mb-4">
                                <label class="form-label text-navy fw-semibold fs-7 text-uppercase">Check-out</label>
                                <input type="date" class="form-control" required>
                            </div>
                            
                            <button type="submit" class="btn btn-navy w-100 py-3 fw-bold text-white shadow-soft" style="background-color: var(--color-navy);">
                                Book This Room
                            </button>
                        </form>

                        <div class="mt-4 pt-3 border-top text-center">
                            <p class="text-muted fs-7 mb-0">
                                <i class="bi bi-info-circle text-gold me-1"></i> Free cancellation up to 24 hours before check-in.
                            </p>
                        </div>
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
</body>
</html>
