/**
 * ALMARIS HOTEL
 * Custom JavaScript for Landing Page Interactions
 */

document.addEventListener('DOMContentLoaded', () => {
    // 1. Initialize AOS Animation Library
    if (typeof AOS !== 'undefined') {
        AOS.init({
            duration: 1000,
            easing: 'ease-out-cubic',
            once: true,
            offset: 50,
            delay: 50,
        });
    }

    // 2. Navbar Scroll Effect & Scrollspy
    const navbar = document.getElementById('navbar');
    const sections = document.querySelectorAll('section, footer');
    const navLinks = document.querySelectorAll('.navbar-nav .nav-link');

    function handleScroll() {
        if (!navbar) return;

        // Navbar background effect
        if (window.scrollY > 50) {
            navbar.classList.add('scrolled');
        } else {
            navbar.classList.remove('scrolled');
        }

        // Scrollspy effect
        let current = '';
        sections.forEach(section => {
            const sectionTop = section.offsetTop;
            // Trigger when the section crosses the middle of the viewport
            if (window.scrollY >= (sectionTop - (window.innerHeight / 2))) {
                current = section.getAttribute('id');
            }
        });

        // Check if user has scrolled to the bottom of the page
        if ((window.innerHeight + Math.round(window.scrollY)) >= document.body.offsetHeight - 50) {
            current = 'contact';
        }

        navLinks.forEach(link => {
            link.classList.remove('active');
            if (link.getAttribute('href') === `#${current}`) {
                link.classList.add('active');
            }
        });
    }

    if (navbar) {
        window.addEventListener('scroll', handleScroll);

        // Trigger once on load in case user refreshed while scrolled down
        handleScroll();
    }

    // 3. Smooth Scrolling for Anchor Links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            const targetId = this.getAttribute('href');
            if (targetId === '#') return;

            const targetElement = document.querySelector(targetId);

            if (targetElement) {
                e.preventDefault();
                const headerOffset = 80;
                const elementPosition = targetElement.getBoundingClientRect().top;
                const offsetPosition = elementPosition + window.pageYOffset - headerOffset;

                window.scrollTo({
                    top: offsetPosition,
                    behavior: 'smooth'
                });
            }
        });
    });

    // 4. Booking Bar Demo Interactivity (Prevent submission since it's frontend only)
    const bookingBtn = document.querySelector('.booking-bar button');
    if (bookingBtn) {
        bookingBtn.addEventListener('click', (e) => {
            e.preventDefault();

            // Simple visual feedback
            const originalText = bookingBtn.innerHTML;
            bookingBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span> Checking...';
            bookingBtn.disabled = true;

            setTimeout(() => {
                bookingBtn.innerHTML = '<i class="bi bi-check-circle-fill me-2"></i> Available';
                bookingBtn.classList.remove('btn-gold');
                bookingBtn.classList.add('btn-success');

                setTimeout(() => {
                    bookingBtn.innerHTML = originalText;
                    bookingBtn.disabled = false;
                    bookingBtn.classList.add('btn-gold');
                    bookingBtn.classList.remove('btn-success');
                }, 2000);
            }, 1000);
        });
    }
});
