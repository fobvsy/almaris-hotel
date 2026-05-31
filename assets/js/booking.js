/**
 * ALMARIS HOTEL
 * Custom JavaScript for Booking Page Interactions
 */

document.addEventListener('DOMContentLoaded', function() {
    const roomSelect = document.getElementById('roomSelect');
    const checkIn    = document.getElementById('checkIn');
    const checkOut   = document.getElementById('checkOut');

    const summaryRoomName      = document.getElementById('summaryRoomName');
    const summaryPricePerNight = document.getElementById('summaryPricePerNight');
    const summaryNights        = document.getElementById('summaryNights');
    const summaryTotalPrice    = document.getElementById('summaryTotalPrice');
    const summaryImage         = document.getElementById('summaryImage');

    // Hidden inputs for PHP backend
    const roomIdInput     = document.getElementById('roomIdInput');
    const checkInHidden   = document.getElementById('checkInHidden');
    const checkOutHidden  = document.getElementById('checkOutHidden');
    const totalHargaInput = document.getElementById('totalHargaInput');

    // Format number to Rupiah
    const formatRupiah = (number) => {
        return new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR',
            minimumFractionDigits: 0
        }).format(number);
    };

    let currentTotalPrice = 0;

    // Calculate duration, update summary UI, and sync hidden fields
    const calculatePrice = () => {
        if (!roomSelect || !checkIn || !checkOut) return;

        let pricePerNight = 0;
        let roomName = null;
        
        if (roomSelect.selectedIndex >= 0 && roomSelect.options[roomSelect.selectedIndex].value !== "") {
            let opt = roomSelect.options[roomSelect.selectedIndex];
            pricePerNight = parseInt(opt.getAttribute('data-price')) || 0;
            roomName = opt.getAttribute('data-name');
        }


        let date1  = new Date(checkIn.value);
        let date2  = new Date(checkOut.value);
        let nights = 1;

        if (checkIn.value && checkOut.value) {
            if (date2 <= date1) {
                alert('Check-out date must be after check-in date!');
                checkOut.value = '';
            } else {
                const timeDiff = Math.abs(date2.getTime() - date1.getTime());
                nights = Math.ceil(timeDiff / (1000 * 3600 * 24));
            }
        }

        let totalPrice = pricePerNight * nights;
        currentTotalPrice = totalPrice;

        // Update summary UI
        if (summaryRoomName && roomName) summaryRoomName.innerText = roomName;
        if (summaryPricePerNight) summaryPricePerNight.innerText = formatRupiah(pricePerNight);
        if (summaryNights) summaryNights.innerText = nights;
        if (summaryTotalPrice) summaryTotalPrice.innerText = formatRupiah(totalPrice);

        // Sync hidden fields for PHP
        if (roomIdInput)     roomIdInput.value     = roomSelect.value;
        if (checkInHidden)   checkInHidden.value   = checkIn.value;
        if (checkOutHidden)  checkOutHidden.value  = checkOut.value;
        if (totalHargaInput) totalHargaInput.value = totalPrice;

        // Room image swap
        if (summaryImage) {
            if (roomName && roomName.includes('City View')) {
                summaryImage.src = 'https://images.unsplash.com/photo-1578683010236-d716f9a3f461?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80';
            } else if (roomName && roomName.includes('Executive')) {
                summaryImage.src = 'https://images.unsplash.com/photo-1590490360182-c33d57733427?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80';
            } else if (roomName && roomName.includes('Presidential')) {
                summaryImage.src = 'https://images.unsplash.com/photo-1582719508461-905c673771fd?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80';
            } else {
                summaryImage.src = 'https://images.unsplash.com/photo-1611892440504-42a792e24d32?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80';
            }
        }
    };

    // Set default dates: today and tomorrow
    const today    = new Date();
    const tomorrow = new Date(today);
    tomorrow.setDate(tomorrow.getDate() + 1);

    if (checkIn)  checkIn.valueAsDate  = today;
    if (checkOut) checkOut.valueAsDate = tomorrow;

    // Prevent selecting past dates
    if (checkIn)  checkIn.min  = today.toISOString().split('T')[0];
    if (checkOut) checkOut.min = tomorrow.toISOString().split('T')[0];

    // Event Listeners
    if (roomSelect) roomSelect.addEventListener('change', calculatePrice);
    if (checkIn) {
        checkIn.addEventListener('change', function() {
            const minCheckOut = new Date(checkIn.value);
            minCheckOut.setDate(minCheckOut.getDate() + 1);
            if (checkOut) {
                checkOut.min = minCheckOut.toISOString().split('T')[0];
                if (new Date(checkOut.value) <= new Date(checkIn.value)) {
                    checkOut.valueAsDate = minCheckOut;
                }
            }
            calculatePrice();
        });
    }
    if (checkOut) checkOut.addEventListener('change', calculatePrice);

    // Ensure hidden fields are synced just before form submission
    const bookingForm = document.getElementById('bookingForm');
    if (bookingForm) {
        bookingForm.addEventListener('submit', function(e) {
            if (roomIdInput)     roomIdInput.value     = roomSelect ? roomSelect.value : '';
            if (checkInHidden)   checkInHidden.value   = checkIn  ? checkIn.value  : '';
            if (checkOutHidden)  checkOutHidden.value  = checkOut ? checkOut.value : '';
            if (totalHargaInput) totalHargaInput.value = currentTotalPrice;

            if (!roomSelect || !roomSelect.value || !checkIn || !checkIn.value ||
                !checkOut || !checkOut.value || currentTotalPrice <= 0) {
                e.preventDefault();
                alert('Please complete all booking fields before confirming.');
            }
        });
    }

    // Initial calculation
    calculatePrice();
});
