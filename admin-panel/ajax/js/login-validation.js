jQuery(document).ready(function () {

    // Login Form Submit (Create button click style)
    $("#create").click(function (event) {
        event.preventDefault(); 

        // --- FRONT-END VALIDATION ---
        if (!$('#username').val() || $('#username').val().length === 0) {
            swal({
                title: "Error!",
                text: "Please enter your Username!",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
        } else if (!$('#password').val() || $('#password').val().length === 0) {
            swal({
                title: "Error!",
                text: "Please enter your Password!",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
        } else {
            
            // Preloader start
            $('.someBlock').preloader();

            // Grab all form data (Variable keywords නැතුව)
            formData = new FormData($("#login-ajax-form")[0]);
            formData.append('login', '1'); 

            $.ajax({
                url: "login.php",
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
                            text: "Login successfully!",
                            type: 'success',
                            timer: 2000,
                            showConfirmButton: false
                        });

                        // තත්පර 2කට පස්සේ dashboard එකට රීඩිරෙක්ට් කරනවා
                        window.setTimeout(function () {
                            window.location.href = 'dashboard.php';
                        }, 2000);

                    } else if (result.status === 'error') {
                        swal({
                            title: "Error!",
                            text: result.message || "Invalid Username or Password.",
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