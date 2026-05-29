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
                    <a href="login.php" class="text-white text-decoration-none nav-link-custom">Login</a>
                    <a href="register.php" class="btn btn-gold">Sign Up</a>
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
                        <button class="btn btn-outline-light btn-lg d-flex align-items-center gap-2">
                            <i class="bi bi-play-circle-fill"></i> Watch Video
                        </button>
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
                <!-- Room 1 -->
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="room-card">
                        <div class="room-img-wrapper">
                            <img src="https://images.unsplash.com/photo-1611892440504-42a792e24d32?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Deluxe Room">
                            <div class="room-price">
                                <span class="fs-4 fw-bold">Rp 1.5M</span> / night
                            </div>
                        </div>
                        <div class="room-content">
                            <h3 class="h4 fw-bold text-navy mb-3">Deluxe Ocean View</h3>
                            <div class="room-amenities d-flex gap-3 mb-4 text-muted fs-7">
                                <span><i class="bi bi-arrows-fullscreen text-gold me-1"></i> 45 sqm</span>
                                <span><i class="bi bi-people text-gold me-1"></i> 2 Guests</span>
                                <span><i class="bi bi-wifi text-gold me-1"></i> Free Wifi</span>
                            </div>
                            <p class="text-muted mb-4">Elegant and spacious room with stunning ocean views and premium amenities for a relaxing stay.</p>
                            <a href="booking.php" class="btn btn-outline-navy w-100">Book Now</a>
                        </div>
                    </div>
                </div>

                <!-- Room 2 -->
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="room-card">
                        <div class="room-img-wrapper">
                            <img src="https://images.unsplash.com/photo-1590490360182-c33d57733427?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Executive Suite">
                            <div class="room-price">
                                <span class="fs-4 fw-bold">Rp 2.8M</span> / night
                            </div>
                        </div>
                        <div class="room-content">
                            <h3 class="h4 fw-bold text-navy mb-3">Executive Suite</h3>
                            <div class="room-amenities d-flex gap-3 mb-4 text-muted fs-7">
                                <span><i class="bi bi-arrows-fullscreen text-gold me-1"></i> 65 sqm</span>
                                <span><i class="bi bi-people text-gold me-1"></i> 3 Guests</span>
                                <span><i class="bi bi-cup-hot text-gold me-1"></i> Breakfast</span>
                            </div>
                            <p class="text-muted mb-4">A luxurious suite featuring a separate living area, panoramic city views, and exclusive lounge access.</p>
                            <a href="booking.php" class="btn btn-gold w-100">Book Now</a>
                        </div>
                    </div>
                </div>

                <!-- Room 3 -->
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                    <div class="room-card">
                        <div class="room-img-wrapper">
                            <img src="https://images.unsplash.com/photo-1582719508461-905c673771fd?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Presidential Suite">
                            <div class="room-price">
                                <span class="fs-4 fw-bold">Rp 5.5M</span> / night
                            </div>
                        </div>
                        <div class="room-content">
                            <h3 class="h4 fw-bold text-navy mb-3">Presidential Suite</h3>
                            <div class="room-amenities d-flex gap-3 mb-4 text-muted fs-7">
                                <span><i class="bi bi-arrows-fullscreen text-gold me-1"></i> 120 sqm</span>
                                <span><i class="bi bi-people text-gold me-1"></i> 4 Guests</span>
                                <span><i class="bi bi-star text-gold me-1"></i> VIP</span>
                            </div>
                            <p class="text-muted mb-4">The pinnacle of luxury. Features a private jacuzzi, dedicated butler, and breathtaking 360-degree views.</p>
                            <a href="booking.php" class="btn btn-outline-navy w-100">Book Now</a>
                        </div>
                    </div>
                </div>
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
                        <p class="text-muted fs-7 mb-0">Nikmati hidangan lezat dan berkualitas tinggi yang disajikan khusus untuk Anda.</p>
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
                        <p class="text-muted fs-7 mb-0">Ruang pertemuan modern dengan fasilitas lengkap untuk keperluan bisnis Anda.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="600">
                    <div class="facility-card text-center">
                        <div class="facility-icon mx-auto mb-4">
                            <i class="bi bi-bicycle"></i>
                        </div>
                        <h4 class="fw-bold text-navy mb-3">Fitness Center</h4>
                        <p class="text-muted fs-7 mb-0">Tetap bugar selama menginap dengan pusat kebugaran mutakhir kami.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="700">
                    <div class="facility-card text-center">
                        <div class="facility-icon mx-auto mb-4">
                            <i class="bi bi-stars"></i>
                        </div>
                        <h4 class="fw-bold text-navy mb-3">Laundry Service</h4>
                        <p class="text-muted fs-7 mb-0">Layanan laundry profesional agar pakaian Anda selalu bersih dan segar.</p>
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
