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

    // 2. Navbar Scroll Effect
    const navbar = document.getElementById('navbar');
    
    if (navbar) {
        window.addEventListener('scroll', () => {
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });
        
        // Trigger once on load in case user refreshed while scrolled down
        if (window.scrollY > 50) {
            navbar.classList.add('scrolled');
        }
    }

    // 3. Smooth Scrolling for Anchor Links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            const targetId = this.getAttribute('href');
            if(targetId === '#') return;
            
            const targetElement = document.querySelector(targetId);
            
            if(targetElement) {
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
    if(bookingBtn) {
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
