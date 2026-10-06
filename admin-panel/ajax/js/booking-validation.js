jQuery(document).ready(function () {

    // Tour Booking Form Submit
    $("#booking-ajax-form").submit(function (event) {
        event.preventDefault(); // පිටුව Refresh වීම වළක්වයි

        // --- FORM INPUT VALUES ලබා ගැනීම (jQuery වලින්) ---
        const travelPackage = $('#booking-ajax-form [name="travel_package"]').val();
        const arrivalDate = $('#booking-ajax-form [name="arrival_date"]').val();
        const departureDate = $('#booking-ajax-form [name="departure_date"]').val();
        const adults = $('#booking-ajax-form [name="adults"]').val() ? $('#booking-ajax-form [name="adults"]').val().trim() : "";
        const clientName = $('#booking-ajax-form [name="client_name"]').val() ? $('#booking-ajax-form [name="client_name"]').val().trim() : "";
        const clientPhone = $('#booking-ajax-form [name="client_phone"]').val() ? $('#booking-ajax-form [name="client_phone"]').val().trim() : "";
        const clientEmail = $('#booking-ajax-form [name="client_email"]').val() ? $('#booking-ajax-form [name="client_email"]').val().trim() : "";
        const clientMessage = $('#booking-ajax-form [name="client_message"]').val() ? $('#booking-ajax-form [name="client_message"]').val().trim() : "";

        // --- FRONT-END VALIDATION (OLD SWEETALERT STYLE) ---

        // 1. Travel Package පරික්ෂා කිරීම
        if (travelPackage === "" || travelPackage === null) {
            showSwalError('Please select a Travel Package!');
            return false;
        }

        // 2. Arrival Date පරික්ෂා කිරීම
        if (arrivalDate === "") {
            showSwalError('Please enter the Arrival Date!');
            return false;
        }

        // 3. Departure Date පරික්ෂා කිරීම
        if (departureDate === "") {
            showSwalError('Please enter the Departure Date!');
            return false;
        }

        // 4. Adults Count පරික්ෂා කිරීම
        if (adults === "" || parseInt(adults) < 1) {
            showSwalError('Please specify at least 1 Adult!');
            return false;
        }

        // 5. Customer Full Name පරික්ෂා කිරීම
        if (clientName === "") {
            showSwalError('Please enter the Customer\'s Full Name!');
            return false;
        }

        // 6. Contact Phone Number පරික්ෂා කිරීම
        if (clientPhone === "") {
            showSwalError('Please enter a Contact Phone Number!');
            return false;
        }

        // 7. Email Address පරික්ෂා කිරීම
        if (clientEmail === "") {
            showSwalError('Please enter the Email Address!');
            return false;
        }

        // 8. Message පරික්ෂා කිරීම
        if (clientMessage === "") {
            showSwalError('Please enter a Message!');
            return false;
        }

        // --- AJAX (SUBMIT DATA) ---
        // Preloader start
        $('.someBlock').preloader();

        var formData = new FormData($(this)[0]);

        $.ajax({
            url: "Ajax/php/process_booking.php",
            type: 'POST',
            data: formData,
            async: false,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "JSON",
            success: function (data) {
                // Remove preloader
                $('.someBlock').preloader('remove');

                if (data.status === 'success') {
                    swal({
                        title: "Booking Saved!",
                        text: data.message || "The booking has been successfully recorded.",
                        type: 'success',
                        timer: 2000,
                        showConfirmButton: false
                    });

                    window.setTimeout(function () {
                        $('#booking-ajax-form')[0].reset(); 
                        window.location.reload();
                    }, 2000);

                } else {
                    swal({
                        title: "Error!",
                        text: data.message || "Something went wrong on the server.",
                        type: 'error',
                        timer: 2000,
                        showConfirmButton: false
                    });
                }
            },
            error: function (error) {
                $('.someBlock').preloader('remove');
                
                swal({
                    title: "Oops...",
                    text: "Failed to connect to the server. Please try again.",
                    type: 'error',
                    timer: 2000,
                    showConfirmButton: false
                });
                console.error('Error:', error);
            }
        });

        return false;
    });

});

// SweetAlert වැරදි පණිවිඩ පෙන්වන පොදු ශ්‍රිතය (පැරණි swal ස්ටයිල් එකට වෙනස් කළා)
function showSwalError(messageText) {
    swal({
        title: "Error!",
        text: messageText,
        type: 'error',
        timer: 2000,
        showConfirmButton: false
    });
}




