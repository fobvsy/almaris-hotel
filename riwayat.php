<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking History | Almaris Hotel</title>
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
        
        .profile-card {
            background: var(--color-white);
            border-radius: var(--radius-md);
            padding: 30px;
            box-shadow: var(--shadow-soft);
            border: 1px solid rgba(0,0,0,0.05);
            text-align: center;
            position: sticky;
            top: 100px;
        }
        
        .profile-avatar {
            width: 100px;
            height: 100px;
            background-color: var(--color-navy);
            color: var(--color-gold);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2.5rem;
            font-weight: bold;
            margin: 0 auto 20px;
        }

        .booking-history-card {
            background: var(--color-white);
            border-radius: var(--radius-md);
            box-shadow: var(--shadow-soft);
            border: 1px solid rgba(0,0,0,0.05);
            overflow: hidden;
            margin-bottom: 24px;
            transition: all 0.3s ease;
        }

        .booking-history-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0,0,0,0.1);
        }

        .booking-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            min-height: 200px;
        }

        .status-badge {
            padding: 8px 16px;
            border-radius: 50px;
            font-weight: 500;
            font-size: 0.85rem;
            display: inline-block;
        }

        .status-pending { background-color: #FEF3C7; color: #92400E; }
        .status-checkin { background-color: #D1FAE5; color: #065F46; }
        .status-checkout { background-color: #F3F4F6; color: #4B5563; }

        .booking-details-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
            margin-top: 15px;
        }

        .detail-item {
            display: flex;
            flex-direction: column;
        }
        
        .detail-label {
            font-size: 0.8rem;
            text-transform: uppercase;
            color: var(--color-gray-text);
            letter-spacing: 0.5px;
            margin-bottom: 2px;
        }
        
        .detail-value {
            font-weight: 500;
            color: var(--color-navy);
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
                    <div class="dropdown">
                        <a class="text-white text-decoration-none dropdown-toggle nav-link-custom" href="#" role="button" data-bs-toggle="dropdown">
                            <i class="bi bi-person-circle me-1"></i> My Account
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end border-0 shadow-sm mt-2">
                            <li><a class="dropdown-item active" href="riwayat.php">Booking History</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item text-danger" href="logout.php">Logout</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Page Header -->
    <div class="page-header">
        <div class="page-header-content container" data-aos="fade-up" data-aos-duration="1000">
            <span class="text-gold fw-bold text-uppercase tracking-wide fs-7 mb-2 d-block">My Account</span>
            <h1 class="display-4 fw-bold text-white mb-3">Booking History</h1>
            <p class="text-white-50">View and manage all your past and upcoming reservations.</p>
        </div>
    </div>

    <!-- History Section -->
    <section class="section-padding pt-0 mb-5">
        <div class="container">
            <div class="row g-5">
                
                <!-- Left Sidebar: Profile Summary -->
                <div class="col-lg-4" data-aos="fade-right">
                    <div class="profile-card">
                        <div class="profile-avatar">
                            JD
                        </div>
                        <h4 class="fw-bold text-navy mb-1">John Doe</h4>
                        <p class="text-muted mb-4">johndoe@example.com</p>
                        
                        <div class="d-flex justify-content-center gap-4 text-start mt-4 pt-4 border-top">
                            <div>
                                <span class="d-block text-gold fw-bold fs-4">3</span>
                                <span class="text-muted fs-7 text-uppercase">Total Bookings</span>
                            </div>
                            <div>
                                <span class="d-block text-gold fw-bold fs-4">1</span>
                                <span class="text-muted fs-7 text-uppercase">Upcoming</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Content: Booking List -->
                <div class="col-lg-8" data-aos="fade-left" data-aos-delay="100">
                    
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h3 class="fw-bold text-navy mb-0">Your Reservations</h3>
                        <select class="form-select w-auto bg-light border-0">
                            <option value="all">All Bookings</option>
                            <option value="upcoming">Upcoming</option>
                            <option value="completed">Completed</option>
                        </select>
                    </div>

                    <!-- Booking Card 1: Pending (Upcoming) -->
                    <div class="booking-history-card">
                        <div class="row g-0">
                            <div class="col-md-4">
                                <img src="https://images.unsplash.com/photo-1590490360182-c33d57733427?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Executive Suite" class="booking-img">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body p-4">
                                    <div class="d-flex justify-content-between align-items-start mb-3">
                                        <div>
                                            <span class="text-muted fs-7 mb-1 d-block">Booking ID: #RES-1002</span>
                                            <h4 class="fw-bold text-navy mb-0">Executive Suite</h4>
                                        </div>
                                        <span class="status-badge status-pending">Pending</span>
                                    </div>
                                    
                                    <div class="booking-details-grid">
                                        <div class="detail-item">
                                            <span class="detail-label">Check In</span>
                                            <span class="detail-value"><i class="bi bi-calendar-event me-2 text-gold"></i>28 May 2026</span>
                                        </div>
                                        <div class="detail-item">
                                            <span class="detail-label">Check Out</span>
                                            <span class="detail-value"><i class="bi bi-calendar-check me-2 text-gold"></i>30 May 2026</span>
                                        </div>
                                        <div class="detail-item">
                                            <span class="detail-label">Total Amount</span>
                                            <span class="detail-value fs-5 fw-bold text-navy">Rp 5.600.000</span>
                                        </div>
                                        <div class="detail-item justify-content-center">
                                            <button class="btn btn-outline-navy btn-sm mt-2">View Invoice</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Booking Card 2: Checkin (Active) -->
                    <div class="booking-history-card">
                        <div class="row g-0">
                            <div class="col-md-4">
                                <img src="https://images.unsplash.com/photo-1611892440504-42a792e24d32?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Deluxe Ocean View" class="booking-img">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body p-4">
                                    <div class="d-flex justify-content-between align-items-start mb-3">
                                        <div>
                                            <span class="text-muted fs-7 mb-1 d-block">Booking ID: #RES-0985</span>
                                            <h4 class="fw-bold text-navy mb-0">Deluxe Ocean View</h4>
                                        </div>
                                        <span class="status-badge status-checkin">Checked In</span>
                                    </div>
                                    
                                    <div class="booking-details-grid">
                                        <div class="detail-item">
                                            <span class="detail-label">Check In</span>
                                            <span class="detail-value"><i class="bi bi-calendar-event me-2 text-gold"></i>20 May 2026</span>
                                        </div>
                                        <div class="detail-item">
                                            <span class="detail-label">Check Out</span>
                                            <span class="detail-value"><i class="bi bi-calendar-check me-2 text-gold"></i>25 May 2026</span>
                                        </div>
                                        <div class="detail-item">
                                            <span class="detail-label">Total Amount</span>
                                            <span class="detail-value fs-5 fw-bold text-navy">Rp 7.500.000</span>
                                        </div>
                                        <div class="detail-item justify-content-center">
                                            <button class="btn btn-outline-navy btn-sm mt-2">View Invoice</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Booking Card 3: Checkout (Completed) -->
                    <div class="booking-history-card" style="opacity: 0.8;">
                        <div class="row g-0">
                            <div class="col-md-4">
                                <img src="https://images.unsplash.com/photo-1578683010236-d716f9a3f461?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Standard City View" class="booking-img" style="filter: grayscale(30%);">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body p-4">
                                    <div class="d-flex justify-content-between align-items-start mb-3">
                                        <div>
                                            <span class="text-muted fs-7 mb-1 d-block">Booking ID: #RES-0542</span>
                                            <h4 class="fw-bold text-navy mb-0">Standard City View</h4>
                                        </div>
                                        <span class="status-badge status-checkout">Checked Out</span>
                                    </div>
                                    
                                    <div class="booking-details-grid">
                                        <div class="detail-item">
                                            <span class="detail-label">Check In</span>
                                            <span class="detail-value"><i class="bi bi-calendar-event me-2 text-gold"></i>10 Feb 2026</span>
                                        </div>
                                        <div class="detail-item">
                                            <span class="detail-label">Check Out</span>
                                            <span class="detail-value"><i class="bi bi-calendar-check me-2 text-gold"></i>12 Feb 2026</span>
                                        </div>
                                        <div class="detail-item">
                                            <span class="detail-label">Total Amount</span>
                                            <span class="detail-value fs-5 fw-bold text-navy">Rp 1.600.000</span>
                                        </div>
                                        <div class="detail-item justify-content-center">
                                            <button class="btn btn-link text-gold text-decoration-none btn-sm mt-2"><i class="bi bi-download me-1"></i> Download Receipt</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
