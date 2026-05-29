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
                    <a href="login.php" class="text-white text-decoration-none nav-link-custom">Login</a>
                    <a href="register.php" class="btn btn-gold">Sign Up</a>
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
            <form class="row g-3 align-items-end">
                <div class="col-md-4">
                    <label class="form-label text-navy fw-semibold fs-7 text-uppercase tracking-wide">Room Type</label>
                    <div class="input-container">
                        <i class="bi bi-door-open"></i>
                        <select class="form-select custom-input border-0 bg-light-gray w-100">
                            <option value="">All Types</option>
                            <option value="standard">Standard Room</option>
                            <option value="deluxe">Deluxe Room</option>
                            <option value="suite">Executive Suite</option>
                            <option value="presidential">Presidential Suite</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <label class="form-label text-navy fw-semibold fs-7 text-uppercase tracking-wide">Sort By</label>
                    <div class="input-container">
                        <i class="bi bi-sort-down"></i>
                        <select class="form-select custom-input border-0 bg-light-gray w-100">
                            <option value="recommended">Recommended</option>
                            <option value="price_low">Price: Low to High</option>
                            <option value="price_high">Price: High to Low</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <button type="button" class="btn btn-navy w-100 fw-bold text-white shadow-soft transition-transform" style="background-color: var(--color-navy); height: 50px;">
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
                
                <!-- Room 1 -->
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="room-card">
                        <div class="room-img-wrapper">
                            <img src="https://images.unsplash.com/photo-1611892440504-42a792e24d32?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Deluxe Ocean View">
                            <div class="room-price">
                                <span class="fs-4 fw-bold">Rp 1.5M</span> / night
                            </div>
                            <div class="position-absolute top-0 start-0 m-3">
                                <span class="badge bg-success px-3 py-2 rounded-pill shadow-sm" style="font-family: var(--font-body); font-weight: 500;">Tersedia</span>
                            </div>
                        </div>
                        <div class="room-content">
                            <h3 class="h4 fw-bold text-navy mb-3">Deluxe Ocean View</h3>
                            <div class="room-amenities d-flex flex-wrap gap-3 mb-4 text-muted fs-7">
                                <span><i class="bi bi-arrows-fullscreen text-gold me-1"></i> 45 sqm</span>
                                <span><i class="bi bi-people text-gold me-1"></i> 2 Guests</span>
                                <span><i class="bi bi-wifi text-gold me-1"></i> Free Wifi</span>
                                <span><i class="bi bi-tv text-gold me-1"></i> Smart TV</span>
                            </div>
                            <p class="text-muted mb-4 line-clamp-3">Elegant and spacious room with stunning ocean views and premium amenities for a relaxing stay.</p>
                            <div class="d-flex gap-2">
                                <a href="detail_kamar.php?id=1" class="btn btn-outline-navy flex-grow-1">Detail</a>
                                <a href="booking.php?id=1" class="btn btn-gold flex-grow-1 shadow-gold">Book Now</a>
                            </div>
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
                            <div class="position-absolute top-0 start-0 m-3">
                                <span class="badge bg-danger px-3 py-2 rounded-pill shadow-sm" style="font-family: var(--font-body); font-weight: 500;">Dipesan</span>
                            </div>
                        </div>
                        <div class="room-content">
                            <h3 class="h4 fw-bold text-navy mb-3">Executive Suite</h3>
                            <div class="room-amenities d-flex flex-wrap gap-3 mb-4 text-muted fs-7">
                                <span><i class="bi bi-arrows-fullscreen text-gold me-1"></i> 65 sqm</span>
                                <span><i class="bi bi-people text-gold me-1"></i> 3 Guests</span>
                                <span><i class="bi bi-cup-hot text-gold me-1"></i> Breakfast</span>
                                <span><i class="bi bi-safe text-gold me-1"></i> Safe</span>
                            </div>
                            <p class="text-muted mb-4 line-clamp-3">A luxurious suite featuring a separate living area, panoramic city views, and exclusive lounge access.</p>
                            <div class="d-flex gap-2">
                                <a href="detail_kamar.php?id=2" class="btn btn-outline-navy flex-grow-1">Detail</a>
                                <button class="btn btn-secondary flex-grow-1 border-0" disabled style="background-color: #CBD5E1; color: #64748B;">Unavailable</button>
                            </div>
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
                            <div class="position-absolute top-0 start-0 m-3">
                                <span class="badge bg-success px-3 py-2 rounded-pill shadow-sm" style="font-family: var(--font-body); font-weight: 500;">Tersedia</span>
                            </div>
                        </div>
                        <div class="room-content">
                            <h3 class="h4 fw-bold text-navy mb-3">Presidential Suite</h3>
                            <div class="room-amenities d-flex flex-wrap gap-3 mb-4 text-muted fs-7">
                                <span><i class="bi bi-arrows-fullscreen text-gold me-1"></i> 120 sqm</span>
                                <span><i class="bi bi-people text-gold me-1"></i> 4 Guests</span>
                                <span><i class="bi bi-star text-gold me-1"></i> VIP</span>
                                <span><i class="bi bi-water text-gold me-1"></i> Jacuzzi</span>
                            </div>
                            <p class="text-muted mb-4 line-clamp-3">The pinnacle of luxury. Features a private jacuzzi, dedicated butler, and breathtaking 360-degree views.</p>
                            <div class="d-flex gap-2">
                                <a href="detail_kamar.php?id=3" class="btn btn-outline-navy flex-grow-1">Detail</a>
                                <a href="booking.php?id=3" class="btn btn-gold flex-grow-1 shadow-gold">Book Now</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Room 4 -->
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="room-card">
                        <div class="room-img-wrapper">
                            <img src="https://images.unsplash.com/photo-1578683010236-d716f9a3f461?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Standard City View">
                            <div class="room-price">
                                <span class="fs-4 fw-bold">Rp 800K</span> / night
                            </div>
                            <div class="position-absolute top-0 start-0 m-3">
                                <span class="badge bg-success px-3 py-2 rounded-pill shadow-sm" style="font-family: var(--font-body); font-weight: 500;">Tersedia</span>
                            </div>
                        </div>
                        <div class="room-content">
                            <h3 class="h4 fw-bold text-navy mb-3">Standard City View</h3>
                            <div class="room-amenities d-flex flex-wrap gap-3 mb-4 text-muted fs-7">
                                <span><i class="bi bi-arrows-fullscreen text-gold me-1"></i> 32 sqm</span>
                                <span><i class="bi bi-people text-gold me-1"></i> 2 Guests</span>
                                <span><i class="bi bi-wifi text-gold me-1"></i> Free Wifi</span>
                            </div>
                            <p class="text-muted mb-4 line-clamp-3">Comfortable and cozy room with beautiful city views, perfect for solo travelers or couples.</p>
                            <div class="d-flex gap-2">
                                <a href="detail_kamar.php?id=4" class="btn btn-outline-navy flex-grow-1">Detail</a>
                                <a href="booking.php?id=4" class="btn btn-gold flex-grow-1 shadow-gold">Book Now</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Room 5 -->
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="room-card">
                        <div class="room-img-wrapper">
                            <img src="https://images.unsplash.com/photo-1631049307264-da0ec9d70304?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Family Suite">
                            <div class="room-price">
                                <span class="fs-4 fw-bold">Rp 3.5M</span> / night
                            </div>
                            <div class="position-absolute top-0 start-0 m-3">
                                <span class="badge bg-success px-3 py-2 rounded-pill shadow-sm" style="font-family: var(--font-body); font-weight: 500;">Tersedia</span>
                            </div>
                        </div>
                        <div class="room-content">
                            <h3 class="h4 fw-bold text-navy mb-3">Family Suite</h3>
                            <div class="room-amenities d-flex flex-wrap gap-3 mb-4 text-muted fs-7">
                                <span><i class="bi bi-arrows-fullscreen text-gold me-1"></i> 85 sqm</span>
                                <span><i class="bi bi-people text-gold me-1"></i> 5 Guests</span>
                                <span><i class="bi bi-tv text-gold me-1"></i> 2 Smart TVs</span>
                                <span><i class="bi bi-cup-hot text-gold me-1"></i> Kitchenette</span>
                            </div>
                            <p class="text-muted mb-4 line-clamp-3">Spacious family suite featuring multiple bedrooms, a living area, and a mini kitchenette.</p>
                            <div class="d-flex gap-2">
                                <a href="detail_kamar.php?id=5" class="btn btn-outline-navy flex-grow-1">Detail</a>
                                <a href="booking.php?id=5" class="btn btn-gold flex-grow-1 shadow-gold">Book Now</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Room 6 -->
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                    <div class="room-card">
                        <div class="room-img-wrapper">
                            <img src="https://images.unsplash.com/photo-1566665797739-1674de7a421a?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Honeymoon Suite">
                            <div class="room-price">
                                <span class="fs-4 fw-bold">Rp 4.2M</span> / night
                            </div>
                            <div class="position-absolute top-0 start-0 m-3">
                                <span class="badge bg-danger px-3 py-2 rounded-pill shadow-sm" style="font-family: var(--font-body); font-weight: 500;">Dipesan</span>
                            </div>
                        </div>
                        <div class="room-content">
                            <h3 class="h4 fw-bold text-navy mb-3">Honeymoon Suite</h3>
                            <div class="room-amenities d-flex flex-wrap gap-3 mb-4 text-muted fs-7">
                                <span><i class="bi bi-arrows-fullscreen text-gold me-1"></i> 75 sqm</span>
                                <span><i class="bi bi-people text-gold me-1"></i> 2 Guests</span>
                                <span><i class="bi bi-flower1 text-gold me-1"></i> Decor</span>
                                <span><i class="bi bi-droplet text-gold me-1"></i> Bathtub</span>
                            </div>
                            <p class="text-muted mb-4 line-clamp-3">Romantic suite specially designed for couples, featuring a free-standing bathtub and romantic decorations.</p>
                            <div class="d-flex gap-2">
                                <a href="detail_kamar.php?id=6" class="btn btn-outline-navy flex-grow-1">Detail</a>
                                <button class="btn btn-secondary flex-grow-1 border-0" disabled style="background-color: #CBD5E1; color: #64748B;">Unavailable</button>
                            </div>
                        </div>
                    </div>
                </div>

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
</body>
</html>
