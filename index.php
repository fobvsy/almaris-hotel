<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Almaris Hotel - Luxury Stay</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    
    <link href="assets/css/styles.css" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
</head>
<body>

    <nav class="navbar navbar-expand-lg fixed-top" id="mainNavbar">
        <div class="container">
            <a class="navbar-brand fw-bold text-white fs-3" href="#">ALMARIS</a>
            <button class="navbar-toggler border-0 text-white" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <i class="bi bi-list fs-1"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0 gap-3 text-center">
                    <li class="nav-item"><a class="nav-link text-white active" href="#">Home</a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="#about">About</a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="#facilities">Facilities</a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="#rooms">Rooms</a></li>
                </ul>
                <div class="text-center">
                    <a href="#" class="btn btn-gold px-4 py-2 fw-semibold">RESERVATION</a>
                </div>
            </div>
        </div>
    </nav>

    <section class="hero-section d-flex align-items-center">
        <div class="container">
            <div class="row align-items-center gy-5">
                <div class="col-lg-6 text-white">
                    <h1 class="display-4 fw-bold mb-3">Discover A New Luxury Hotel</h1>
                    <p class="lead text-white-50 mb-4">Savor the ultimate relaxation and sophisticated comfort at Almaris. A sanctuary designed to elevate your staycation experience.</p>
                    <a href="#rooms" class="btn btn-outline-light px-4 py-2 fw-medium">Explore Rooms</a>
                </div>
                <div class="col-lg-6 text-center text-lg-end">
                    <img src="https://images.unsplash.com/photo-1566073771259-6a8506099945?q=80&w=600&auto=format&fit=crop" alt="Hero Almaris" class="img-fluid img-arch hero-img">
                </div>
            </div>
        </div>
    </section>

    <div class="container booking-bar-container">
        <div class="booking-bar p-4 shadow">
            <form class="row g-3 align-items-center">
                <div class="col-lg-2 col-md-6">
                    <label class="form-label small fw-bold text-secondary">CHECK-IN</label>
                    <input type="date" class="form-control">
                </div>
                <div class="col-lg-2 col-md-6">
                    <label class="form-label small fw-bold text-secondary">CHECK-OUT</label>
                    <input type="date" class="form-control">
                </div>
                <div class="col-lg-2 col-md-6">
                    <label class="form-label small fw-bold text-secondary">ADULT</label>
                    <div class="input-group">
                        <button class="btn btn-outline-secondary btn-minus" type="button">-</button>
                        <input type="text" class="form-control text-center counter-input" value="1" readonly>
                        <button class="btn btn-outline-secondary btn-plus" type="button">+</button>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6">
                    <label class="form-label small fw-bold text-secondary">CHILDREN</label>
                    <div class="input-group">
                        <button class="btn btn-outline-secondary btn-minus" type="button">-</button>
                        <input type="text" class="form-control text-center counter-input" value="0" readonly>
                        <button class="btn btn-outline-secondary btn-plus" type="button">+</button>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12 text-lg-end pt-lg-4">
                    <button type="button" class="btn btn-dark-navy w-100 py-3 fw-bold">CHECK AVAILABILITY</button>
                </div>
            </form>
        </div>
    </div>

    <section class="section-padding" id="about">
        <div class="container">
            <div class="text-center mb-5">
                <div class="d-flex align-items-center justify-content-center gap-2 mb-2 text-gold">
                    <i class="bi bi-star-fill"></i>
                    <span class="fw-bold text-dark-navy">4.9 out of 5</span>
                    <span class="text-secondary">Based on 25,000+ reviews</span>
                </div>
                <h2 class="fw-bold text-dark-navy mb-3 display-6">Uncompromising Luxury, Tailored For You</h2>
                <p class="text-secondary max-w-2xl mx-auto" style="max-width: 700px;">Every corner of Almaris is crafted to spark unforgettable moments. Combining modern architectural design with high-end premium hospitality services.</p>
            </div>
            
            <div class="row g-4" id="facilities">
                
                <div class="col-lg-4 col-md-6">
                    <div class="p-4 border rounded-3 bg-white h-100 d-flex align-items-start gap-3 facility-card shadow-sm">
                        <div class="facility-icon-shape d-flex align-items-center justify-content-center flex-shrink-0">
                            <i class="bi bi-egg-fried fs-4"></i>
                        </div>
                        <div>
                            <h5 class="fw-bold text-dark-navy mb-2">Restaurant</h5>
                            <p class="text-secondary small mb-0 lh-base">Do dolore laboris commodo amet cillum qui voluptate velit occaecat adipisicing laboris est minim.</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="p-4 border rounded-3 bg-white h-100 d-flex align-items-start gap-3 facility-card shadow-sm">
                        <div class="facility-icon-shape d-flex align-items-center justify-content-center flex-shrink-0">
                            <i class="bi bi-water fs-4"></i>
                        </div>
                        <div>
                            <h5 class="fw-bold text-dark-navy mb-2">Swimming Pool</h5>
                            <p class="text-secondary small mb-0 lh-base">Do dolore laboris commodo amet cillum qui voluptate velit occaecat adipisicing laboris est minim.</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 position-relative">
                    <div class="p-4 border rounded-3 bg-white h-100 d-flex align-items-start gap-3 facility-card shadow-sm">
                        <div class="facility-icon-shape d-flex align-items-center justify-content-center flex-shrink-0">
                            <i class="bi bi-activity fs-4"></i>
                        </div>
                        <div>
                            <h5 class="fw-bold text-dark-navy mb-2">Fitness Center</h5>
                            <p class="text-secondary small mb-0 lh-base">Do dolore laboris commodo amet cillum qui voluptate velit occaecat adipisicing laboris est minim.</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="p-4 border rounded-3 bg-white h-100 d-flex align-items-start gap-3 facility-card shadow-sm">
                        <div class="facility-icon-shape d-flex align-items-center justify-content-center flex-shrink-0">
                            <i class="bi bi-flower1 fs-4"></i>
                        </div>
                        <div>
                            <h5 class="fw-bold text-dark-navy mb-2">Spa & Massage</h5>
                            <p class="text-secondary small mb-0 lh-base">Do dolore laboris commodo amet cillum qui voluptate velit occaecat adipisicing laboris est minim.</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="p-4 border rounded-3 bg-white h-100 d-flex align-items-start gap-3 facility-card shadow-sm">
                        <div class="facility-icon-shape d-flex align-items-center justify-content-center flex-shrink-0">
                            <i class="bi bi-easel2 fs-4"></i>
                        </div>
                        <div>
                            <h5 class="fw-bold text-dark-navy mb-2">Meeting Room</h5>
                            <p class="text-secondary small mb-0 lh-base">Do dolore laboris commodo amet cillum qui voluptate velit occaecat adipisicing laboris est minim.</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="p-4 border rounded-3 bg-white h-100 d-flex align-items-start gap-3 facility-card shadow-sm">
                        <div class="facility-icon-shape d-flex align-items-center justify-content-center flex-shrink-0">
                            <i class="bi bi-smartwatch fs-4"></i>
                        </div>
                        <div>
                            <h5 class="fw-bold text-dark-navy mb-2">Laundry Service</h5>
                            <p class="text-secondary small mb-0 lh-base">Do dolore laboris commodo amet cillum qui voluptate velit occaecat adipisicing laboris est minim.</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <section class="bg-light section-padding" id="rooms">
        <div class="container position-relative">
            <div class="text-center mb-5">
                <h2 class="fw-bold text-dark-navy display-6">Our Finest Accommodations</h2>
                <p class="text-secondary">Handpicked luxury suites for your ultimate comfort</p>
            </div>

            <div id="roomCarousel" class="carousel slide" data-bs-ride="false">
                <div class="carousel-inner">
                    
                    <div class="carousel-item active">
                        <div class="row g-4">
                            <div class="col-lg-4 col-md-6">
                                <div class="card room-card border-0 bg-transparent">
                                    <div class="room-img-container">
                                        <img src="https://images.unsplash.com/photo-1611892440504-42a792e24d32?q=80&w=500&auto=format&fit=crop" alt="Deluxe Room" class="img-fluid img-arch room-img">
                                        <button class="btn-wishlist"><i class="bi bi-heart"></i></button>
                                        <div class="room-overlay d-flex flex-column align-items-center justify-content-center">
                                            <h4 class="text-white fw-bold mb-3">$129 <span class="fs-6 fw-normal">/ night</span></h4>
                                            <a href="#" class="btn btn-gold px-4 py-2 fw-semibold">VIEW DETAILS</a>
                                        </div>
                                    </div>
                                    <div class="card-body px-0 pt-3">
                                        <h4 class="fw-bold text-dark-navy mb-2">Deluxe Room</h4>
                                        <p class="room-details text-secondary mb-0">2 Guests <span class="mx-2 text-muted">|</span> 35 Feets Size</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6">
                                <div class="card room-card border-0 bg-transparent">
                                    <div class="room-img-container">
                                        <img src="https://images.unsplash.com/photo-1590490360182-c33d57733427?q=80&w=500&auto=format&fit=crop" alt="Family Suite" class="img-fluid img-arch room-img">
                                        <button class="btn-wishlist"><i class="bi bi-heart"></i></button>
                                        <div class="room-overlay d-flex flex-column align-items-center justify-content-center">
                                            <h4 class="text-white fw-bold mb-3">$199 <span class="fs-6 fw-normal">/ night</span></h4>
                                            <a href="#" class="btn btn-gold px-4 py-2 fw-semibold">VIEW DETAILS</a>
                                        </div>
                                    </div>
                                    <div class="card-body px-0 pt-3">
                                        <h4 class="fw-bold text-dark-navy mb-2">Family Suite</h4>
                                        <p class="room-details text-secondary mb-0">4 Guests <span class="mx-2 text-muted">|</span> 60 Feets Size</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-12">
                                <div class="card room-card border-0 bg-transparent">
                                    <div class="room-img-container">
                                        <img src="https://images.unsplash.com/photo-1596394516093-501ba68a0ba6?q=80&w=500&auto=format&fit=crop" alt="Urban Loft" class="img-fluid img-arch room-img">
                                        <button class="btn-wishlist"><i class="bi bi-heart"></i></button>
                                        <div class="room-overlay d-flex flex-column align-items-center justify-content-center">
                                            <h4 class="text-white fw-bold mb-3">$249 <span class="fs-6 fw-normal">/ night</span></h4>
                                            <a href="#" class="btn btn-gold px-4 py-2 fw-semibold">VIEW DETAILS</a>
                                        </div>
                                    </div>
                                    <div class="card-body px-0 pt-3">
                                        <h4 class="fw-bold text-dark-navy mb-2">Urban Loft</h4>
                                        <p class="room-details text-secondary mb-0">2 Guests <span class="mx-2 text-muted">|</span> 45 Feets Size</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="carousel-item">
                        <div class="row g-4">
                            <div class="col-lg-4 col-md-6">
                                <div class="card room-card border-0 bg-transparent">
                                    <div class="room-img-container">
                                        <img src="https://images.unsplash.com/photo-1595576508898-0ad5c879a061?q=80&w=500&auto=format&fit=crop" alt="Premium Suite" class="img-fluid img-arch room-img">
                                        <button class="btn-wishlist"><i class="bi bi-heart"></i></button>
                                        <div class="room-overlay d-flex flex-column align-items-center justify-content-center">
                                            <h4 class="text-white fw-bold mb-3">$299 <span class="fs-6 fw-normal">/ night</span></h4>
                                            <a href="#" class="btn btn-gold px-4 py-2 fw-semibold">VIEW DETAILS</a>
                                        </div>
                                    </div>
                                    <div class="card-body px-0 pt-3">
                                        <h4 class="fw-bold text-dark-navy mb-2">Premium Suite</h4>
                                        <p class="room-details text-secondary mb-0">2 Guests <span class="mx-2 text-muted">|</span> 50 Feets Size</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6">
                                <div class="card room-card border-0 bg-transparent">
                                    <div class="room-img-container">
                                        <img src="https://images.unsplash.com/photo-1618773928121-c32242e63f39?q=80&w=500&auto=format&fit=crop" alt="Presidential Room" class="img-fluid img-arch room-img">
                                        <button class="btn-wishlist"><i class="bi bi-heart"></i></button>
                                        <div class="room-overlay d-flex flex-column align-items-center justify-content-center">
                                            <h4 class="text-white fw-bold mb-3">$399 <span class="fs-6 fw-normal">/ night</span></h4>
                                            <a href="#" class="btn btn-gold px-4 py-2 fw-semibold">VIEW DETAILS</a>
                                        </div>
                                    </div>
                                    <div class="card-body px-0 pt-3">
                                        <h4 class="fw-bold text-dark-navy mb-2">Presidential Room</h4>
                                        <p class="room-details text-secondary mb-0">2 Guests <span class="mx-2 text-muted">|</span> 65 Feets Size</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-12">
                                <div class="card room-card border-0 bg-transparent">
                                    <div class="room-img-container">
                                        <img src="https://images.unsplash.com/photo-1591088398332-8a77d4972842?q=80&w=500&auto=format&fit=crop" alt="Master Family Suite" class="img-fluid img-arch room-img">
                                        <button class="btn-wishlist"><i class="bi bi-heart"></i></button>
                                        <div class="room-overlay d-flex flex-column align-items-center justify-content-center">
                                            <h4 class="text-white fw-bold mb-3">$499 <span class="fs-6 fw-normal">/ night</span></h4>
                                            <a href="#" class="btn btn-gold px-4 py-2 fw-semibold">VIEW DETAILS</a>
                                        </div>
                                    </div>
                                    <div class="card-body px-0 pt-3">
                                        <h4 class="fw-bold text-dark-navy mb-2">Master Family Suite</h4>
                                        <p class="room-details text-secondary mb-0">4 Guests <span class="mx-2 text-muted">|</span> 80 Feets Size</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <button class="carousel-control-prev custom-carousel-btn" type="button" data-bs-target="#roomCarousel" data-bs-slide="prev">
                    <i class="bi bi-chevron-left"></i>
                </button>
                <button class="carousel-control-next custom-carousel-btn" type="button" data-bs-target="#roomCarousel" data-bs-slide="next">
                    <i class="bi bi-chevron-right"></i>
                </button>
            </div>
        </div>
    </section>

    <footer class="bg-dark-navy text-white py-5">
        <div class="container text-center text-md-start">
            <div class="row gy-4">
                <div class="col-md-6">
                    <h3 class="fw-bold text-white mb-3">ALMARIS</h3>
                    <p class="text-white-50">Experience the pinnacle of luxury accommodations and elite, custom services tailored exclusively to your comfort requirements.</p>
                </div>
                <div class="col-md-3">
                    <h5 class="fw-bold mb-3 text-gold">Quick Links</h5>
                    <ul class="list-unstyled d-flex flex-column gap-2">
                        <li><a href="#" class="text-white-50 text-decoration-none hover-gold">About Us</a></li>
                        <li><a href="#" class="text-white-50 text-decoration-none hover-gold">Our Services</a></li>
                        <li><a href="#" class="text-white-50 text-decoration-none hover-gold">Privacy Policy</a></li>
                    </ul>
                </div>
                <div class="col-md-3">
                    <h5 class="fw-bold mb-3 text-gold">Contact</h5>
                    <p class="text-white-50 mb-1"><i class="bi bi-geo-alt-fill me-2"></i> 123 Luxury St, Paradise Island</p>
                    <p class="text-white-50"><i class="bi bi-telephone-fill me-2"></i> +1 (234) 567-890</p>
                </div>
            </div>
            <hr class="border-secondary my-4">
            <div class="text-center text-white-50 small">
                &copy; 2026 Almaris Hotel. All Rights Reserved.
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/script.js"></script>
</body>
</html>