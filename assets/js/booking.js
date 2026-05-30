/**
 * ALMARIS HOTEL
 * Custom JavaScript for Booking Page Interactions
 */

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
