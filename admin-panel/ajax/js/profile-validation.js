jQuery(document).ready(function () {

    // Profile Update (Create button click style)
    $("#create").click(function (event) {
        event.preventDefault(); // Browser default form submit reload එක නවත්වයි

        // --- FRONT-END VALIDATION (IF/ELSE IF STRUCTURE) ---
        if (!$('#name').val() || $('#name').val().length === 0) {
            swal({
                title: "Error!",
                text: "Please enter your Full Name!",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
        } else if (!$('#address').val() || $('#address').val().length === 0) {
            swal({
                title: "Error!",
                text: "Please enter your Address!",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
        } else if (!$('#mobile').val() || $('#mobile').val().length === 0) {
            swal({
                title: "Error!",
                text: "Please enter your Mobile Number!",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
        } else {
            
            // Preloader start
            $('.someBlock').preloader();

            // Grab all form data (Variable keywords නැතුව)
            formData = new FormData($("#profile-ajax-form")[0]);
            formData.append('update_profile', '1'); // PHP logic එකට අවශ්‍යයි

            $.ajax({
                url: "profile.php",
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
                            text: "Profile updated successfully!",
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