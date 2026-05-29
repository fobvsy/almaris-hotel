document.addEventListener("DOMContentLoaded", function () {
    
    // 1. Navbar dinamis saat scroll
    const navbar = document.getElementById("mainNavbar");
    window.addEventListener("scroll", function () {
        if (window.scrollY > 50) {
            navbar.classList.add("scrolled");
        } else {
            navbar.classList.remove("scrolled");
        }
    });

    // 2. Counter Tamu (Plus Minus) fungsional
    const minusButtons = document.querySelectorAll(".btn-minus");
    const plusButtons = document.querySelectorAll(".btn-plus");

    minusButtons.forEach(button => {
        button.addEventListener("click", function () {
            const input = this.nextElementSibling;
            let currentValue = parseInt(input.value);
            const isAdult = this.closest('.col-lg-2').innerText.includes("ADULT");
            const minValue = isAdult ? 1 : 0;
            
            if (currentValue > minValue) {
                input.value = currentValue - 1;
            }
        });
    });

    plusButtons.forEach(button => {
        button.addEventListener("click", function () {
            const input = this.previousElementSibling;
            let currentValue = parseInt(input.value);
            input.value = currentValue + 1;
        });
    });

    // 3. Klik Interaktif Ikon Hati (Wishlist)
    const wishlistButtons = document.querySelectorAll(".btn-wishlist");
    wishlistButtons.forEach(button => {
        button.addEventListener("click", function (e) {
            e.stopPropagation(); 
            const icon = this.querySelector("i");
            this.classList.toggle("active");
            
            if (this.classList.contains("active")) {
                icon.classList.remove("bi-heart");
                icon.classList.add("bi-heart-fill");
            } else {
                icon.classList.remove("bi-heart-fill");
                icon.classList.add("bi-heart");
            }
        });
    });
});
