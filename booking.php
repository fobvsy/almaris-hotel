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
                    <a href="login.php" class="text-white text-decoration-none nav-link-custom">Login</a>
                    <a href="register.php" class="btn btn-gold">Sign Up</a>
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
            <form id="bookingForm" action="#" method="POST">
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
                                            <option value="" disabled>Choose your room...</option>
                                            <option value="1500000" data-name="Deluxe Ocean View" selected>Deluxe Ocean View (Rp 1.500.000 / Night)</option>
                                            <option value="800000" data-name="Standard City View">Standard City View (Rp 800.000 / Night)</option>
                                            <option value="2800000" data-name="Executive Suite">Executive Suite (Rp 2.800.000 / Night)</option>
                                            <option value="5500000" data-name="Presidential Suite">Presidential Suite (Rp 5.500.000 / Night)</option>
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
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const roomSelect = document.getElementById('roomSelect');
            const checkIn = document.getElementById('checkIn');
            const checkOut = document.getElementById('checkOut');
            
            const summaryRoomName = document.getElementById('summaryRoomName');
            const summaryPricePerNight = document.getElementById('summaryPricePerNight');
            const summaryNights = document.getElementById('summaryNights');
            const summaryTotalPrice = document.getElementById('summaryTotalPrice');
            const summaryImage = document.getElementById('summaryImage');

            // Format number to Rupiah
            const formatRupiah = (number) => {
                return new Intl.NumberFormat('id-ID', {
                    style: 'currency',
                    currency: 'IDR',
                    minimumFractionDigits: 0
                }).format(number);
            };

            // Calculate duration and total price
            const calculatePrice = () => {
                let pricePerNight = parseInt(roomSelect.value) || 0;
                let roomName = roomSelect.options[roomSelect.selectedIndex].getAttribute('data-name');
                
                let date1 = new Date(checkIn.value);
                let date2 = new Date(checkOut.value);
                let nights = 1;

                if(checkIn.value && checkOut.value) {
                    if (date2 <= date1) {
                        alert('Check-out date must be after check-in date!');
                        checkOut.value = '';
                    } else {
                        const timeDiff = Math.abs(date2.getTime() - date1.getTime());
                        nights = Math.ceil(timeDiff / (1000 * 3600 * 24));
                    }
                }

                let totalPrice = pricePerNight * nights;

                // Update UI
                if(roomName) summaryRoomName.innerText = roomName;
                summaryPricePerNight.innerText = formatRupiah(pricePerNight);
                summaryNights.innerText = nights;
                summaryTotalPrice.innerText = formatRupiah(totalPrice);

                // Dummy image change based on room type
                if (roomName && roomName.includes('City View')) {
                    summaryImage.src = 'https://images.unsplash.com/photo-1578683010236-d716f9a3f461?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80';
                } else if (roomName && roomName.includes('Executive')) {
                    summaryImage.src = 'https://images.unsplash.com/photo-1590490360182-c33d57733427?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80';
                } else if (roomName && roomName.includes('Presidential')) {
                    summaryImage.src = 'https://images.unsplash.com/photo-1582719508461-905c673771fd?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80';
                } else {
                    summaryImage.src = 'https://images.unsplash.com/photo-1611892440504-42a792e24d32?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80';
                }
            };

            // Set today and tomorrow as default dates
            const today = new Date();
            const tomorrow = new Date(today);
            tomorrow.setDate(tomorrow.getDate() + 1);

            checkIn.valueAsDate = today;
            checkOut.valueAsDate = tomorrow;

            // Prevent selecting past dates
            checkIn.min = today.toISOString().split('T')[0];
            checkOut.min = tomorrow.toISOString().split('T')[0];

            // Event Listeners
            roomSelect.addEventListener('change', calculatePrice);
            checkIn.addEventListener('change', function() {
                const minCheckOut = new Date(checkIn.value);
                minCheckOut.setDate(minCheckOut.getDate() + 1);
                checkOut.min = minCheckOut.toISOString().split('T')[0];
                if(new Date(checkOut.value) <= new Date(checkIn.value)) {
                    checkOut.valueAsDate = minCheckOut;
                }
                calculatePrice();
            });
            checkOut.addEventListener('change', calculatePrice);

            // Initial calculation
            calculatePrice();
        });
    </script>
</body>
</html>
