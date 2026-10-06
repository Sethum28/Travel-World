jQuery(document).ready(function () {

    // Add Tour Destination (Create button click style)
    $("#create").click(function (event) {
        event.preventDefault(); // Browser default behavior එක නවත්වයි

        // --- FRONT-END VALIDATION (IF/ELSE IF STRUCTURE) ---
        if (!$('#title').val() || $('#title').val().length === 0) {
            swal({
                title: "Error!",
                text: "Please enter the Tour Title!",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
        } else if (!$('#province').val() || $('#province').val().length === 0) {
            swal({
                title: "Error!",
                text: "Please select a Province!",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
        } else if (!$('#price').val() || $('#price').val().length === 0) {
            swal({
                title: "Error!",
                text: "Please enter the Price!",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
        } else if (!$('#description').val() || $('#description').val().length === 0) {
            swal({
                title: "Error!",
                text: "Please enter the Tour Highlights & Description!",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
        } else {
            
            // Preloader start
            $('.someBlock').preloader();

            // Grab all form data (Variable keywords නැතුව)
            formData = new FormData($("#onedaytour-ajax-form")[0]);
            formData.append('add_destination', '1'); // PHP isset($_POST['add_destination']) කොටසට අවශ්‍යයි

            $.ajax({
                url: "onedaytour.php",
                type: 'POST',
                data: formData,
                async: false,
                cache: false,
                contentType: false,
                processData: false,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                },
                success: function (result) {
                    // Remove preloader
                    $('.someBlock').preloader('remove');

                    // JSON Response check (PHP එකෙන් json_decode කරලා එවන Object එකක් නම්)
                    if (result.status === 'success') {
                        swal({
                            title: "Success!",
                            text: "Tour added successfully!",
                            type: 'success',
                            timer: 2000,
                            showConfirmButton: false
                        });

                        // තත්පර 2කට පසු page එක reload වෙයි
                        window.setTimeout(function () {
                            window.location.reload();
                        }, 2000);

                    } else if (result.status === 'error') {
                        swal({
                            title: "Error!",
                            text: result.message || "Something went wrong.",
                            type: 'error',
                            timer: 2000,
                            showConfirmButton: false
                        });
                    }
                },
                error: function (error) {
                    $('.someBlock').preloader('remove');
                    
                    swal({
                        title: "Error!",
                        text: "Something went wrong. Please try again.",
                        type: 'error',
                        timer: 2000,
                        showConfirmButton: false
                    });
                    console.error('Error:', error);
                }
            });
        }
        return false;
    });

});