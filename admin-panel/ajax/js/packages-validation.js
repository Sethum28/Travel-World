jQuery(document).ready(function () {

    // Add Package (Create button click style)
    $("#create").click(function (event) {
        event.preventDefault(); // Browser default form submit reload එක නවත්වයි

        // --- FRONT-END VALIDATION (IF/ELSE IF STRUCTURE) ---
        if (!$('#title').val() || $('#title').val().length === 0) {
            swal({
                title: "Error!",
                text: "Please enter the Package Title!",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
        } else if (!$('#subtitle').val() || $('#subtitle').val().length === 0) {
            swal({
                title: "Error!",
                text: "Please enter the Subtitle!",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
        } else if (!$('#type').val() || $('#type').val().length === 0) {
            swal({
                title: "Error!",
                text: "Please select a Category Type!",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
        } else if (!$('#color').val() || $('#color').val().length === 0) {
            swal({
                title: "Error!",
                text: "Please select a Theme Color!",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
        } else if (!$('#image').val() || $('#image').val().length === 0) {
            swal({
                title: "Error!",
                text: "Please enter the Image URL or Filename!",
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
        } else if (!$('#highlights').val() || $('#highlights').val().length === 0) {
            swal({
                title: "Error!",
                text: "Please enter the Tour Highlights!",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
        } else if (!$('#itinerary').val() || $('#itinerary').val().length === 0) {
            swal({
                title: "Error!",
                text: "Please enter the Itinerary!",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
        } else {
            
            // Preloader start
            $('.someBlock').preloader();

            // Grab all form data (Variable keywords නැතුව)
            formData = new FormData($("#packages-add-form")[0]);
            formData.append('add_package', '1'); // PHP logic එකට අවශ්‍යයි

            $.ajax({
                url: "packages.php",
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

                    // JSON Response check
                    if (result.status === 'success') {
                        swal({
                            title: "Success!",
                            text: "Package added successfully!",
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