<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us | Almaris Hotel</title>
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
            background: url('https://images.unsplash.com/photo-1563911302283-d2bc129e7570?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80') center/cover no-repeat;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 60px;
        }
        .page-header::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            background: rgba(15, 23, 42, 0.8);
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
        
        .contact-info-card {
            background: var(--color-white);
            border-radius: var(--radius-md);
            padding: 40px 30px;
            box-shadow: var(--shadow-soft);
            border: 1px solid rgba(0,0,0,0.05);
            text-align: center;
            height: 100%;
            transition: all 0.3s ease;
        }
        
        .contact-info-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 35px rgba(0,0,0,0.1);
        }

        .contact-icon {
            width: 70px;
            height: 70px;
            background-color: rgba(212, 175, 55, 0.1);
            color: var(--color-gold);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            margin: 0 auto 20px;
            transition: all 0.3s ease;
        }

        .contact-info-card:hover .contact-icon {
            background-color: var(--color-gold);
            color: var(--color-white);
        }

        .form-control-custom {
            border: 1px solid #E5E7EB;
            border-radius: 8px;
            padding: 14px 20px;
            transition: all 0.3s;
            background-color: #F9FAFB;
        }
        
        .form-control-custom:focus {
            background-color: #fff;
            border-color: var(--color-gold);
            box-shadow: 0 0 0 0.25rem rgba(212, 175, 55, 0.25);
        }

        .map-container {
            border-radius: var(--radius-md);
            overflow: hidden;
            box-shadow: var(--shadow-soft);
            height: 400px;
            border: 1px solid rgba(0,0,0,0.05);
        }
        
        iframe {
            width: 100%;
            height: 100%;
            border: 0;
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
                        <a class="nav-link active" href="kontak.php">Contact</a>
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
            <span class="text-gold fw-bold text-uppercase tracking-wide fs-7 mb-2 d-block">Get In Touch</span>
            <h1 class="display-3 fw-bold text-white mb-3">Contact Us</h1>
            <p class="text-white-50 lead mx-auto" style="max-width: 600px;">We're here to assist you with any questions or requests. Reach out to our dedicated team anytime.</p>
        </div>
    </div>

    <!-- Contact Info Cards Section -->
    <section class="section-padding pt-0">
        <div class="container">
            <div class="row g-4">
                <!-- Address -->
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="contact-info-card">
                        <div class="contact-icon">
                            <i class="bi bi-geo-alt"></i>
                        </div>
                        <h4 class="fw-bold text-navy mb-3">Our Location</h4>
                        <p class="text-muted mb-0">123 Luxury Avenue,<br>Metropolis City, 10012<br>Indonesia</p>
                    </div>
                </div>

                <!-- Email -->
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="contact-info-card">
                        <div class="contact-icon">
                            <i class="bi bi-envelope"></i>
                        </div>
                        <h4 class="fw-bold text-navy mb-3">Email Address</h4>
                        <p class="text-muted mb-1">For Reservation:</p>
                        <p class="fw-medium text-navy mb-3">booking@almarishotel.com</p>
                        <p class="text-muted mb-1">General Inquiries:</p>
                        <p class="fw-medium text-navy mb-0">info@almarishotel.com</p>
                    </div>
                </div>

                <!-- Phone -->
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                    <div class="contact-info-card">
                        <div class="contact-icon">
                            <i class="bi bi-telephone"></i>
                        </div>
                        <h4 class="fw-bold text-navy mb-3">Phone Number</h4>
                        <p class="text-muted mb-1">24/7 Front Desk:</p>
                        <p class="fw-medium text-navy fs-5 mb-3">+62 812 3456 7890</p>
                        <p class="text-muted mb-1">WhatsApp Available</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Map and Form Section -->
    <section class="section-padding bg-light">
        <div class="container">
            <div class="row g-5 align-items-center">
                
                <!-- Send Message Form -->
                <div class="col-lg-6" data-aos="fade-right">
                    <div class="bg-white p-5 rounded-4 shadow-soft">
                        <div class="mb-4">
                            <span class="text-gold fw-bold text-uppercase fs-7">Drop a line</span>
                            <h2 class="fw-bold text-navy mt-2">Send Message</h2>
                            <p class="text-muted">Fill out the form below and our team will get back to you within 24 hours.</p>
                        </div>

                        <form>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label fs-7 fw-semibold text-navy">Full Name</label>
                                    <input type="text" class="form-control form-control-custom" placeholder="John Doe">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fs-7 fw-semibold text-navy">Email Address</label>
                                    <input type="email" class="form-control form-control-custom" placeholder="john@example.com">
                                </div>
                                <div class="col-12">
                                    <label class="form-label fs-7 fw-semibold text-navy">Subject</label>
                                    <input type="text" class="form-control form-control-custom" placeholder="How can we help?">
                                </div>
                                <div class="col-12">
                                    <label class="form-label fs-7 fw-semibold text-navy">Message</label>
                                    <textarea class="form-control form-control-custom" rows="5" placeholder="Write your message here..."></textarea>
                                </div>
                                <div class="col-12 mt-4">
                                    <button type="button" class="btn btn-navy w-100 py-3 fw-bold text-white shadow-soft" style="background-color: var(--color-navy);" onclick="alert('Demo: Message Sent!')">
                                        Send Message <i class="bi bi-arrow-right ms-2"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Google Maps -->
                <div class="col-lg-6" data-aos="fade-left">
                    <div class="map-container">
                        <!-- Example embedded Google map (using a generic coordinate for Metropolis / Jakarta demo) -->
                        <iframe 
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d126920.24036066861!2d106.74415891461942!3d-6.229746499999999!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f3e945e34b9d%3A0x100c5e82dd4b820!2sJakarta!5e0!3m2!1sen!2sid!4v1689234567890!5m2!1sen!2sid" 
                            allowfullscreen="" 
                            loading="lazy" 
                            referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
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
