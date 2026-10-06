jQuery(document).ready(function () {

    // Change Password / Update Settings via Create Button
    $("#create").click(function (event) {
        event.preventDefault(); // Browser default form reload එක නවත්වයි

        // --- FORM INPUT VALUES ---
        currentPassword = $('#current_password').val() ? $('#current_password').val().trim() : "";
        newPassword = $('#new_password').val() ? $('#new_password').val().trim() : "";
        confirmPassword = $('#confirm_password').val() ? $('#confirm_password').val().trim() : "";

        // --- FRONT-END VALIDATION (IF/ELSE IF STRUCTURE) ---
        if (!currentPassword || currentPassword.length === 0) {
            swal({
                title: "Error!",
                text: "Please enter your Current Password!",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
        } else if (!newPassword || newPassword.length === 0) {
            swal({
                title: "Error!",
                text: "Please enter a New Password!",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
        } else if (!confirmPassword || confirmPassword.length === 0) {
            swal({
                title: "Error!",
                text: "Please confirm your New Password!",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
        } else if (newPassword !== confirmPassword) {
            swal({
                title: "Mismatch!",
                text: "New passwords do not match!",
                type: 'warning',
                timer: 2000,
                showConfirmButton: false
            });
        } else {

            // Preloader start (Optional)
            $('.someBlock').preloader();

            // Grab all form data from the form
            formData = new FormData($("#settings-ajax-form")[0]);
            formData.append('create', true);

            $.ajax({
                url: "settings.php",
                type: 'POST',
                data: formData,
                async: false,
                cache: false,
                contentType: false,
                processData: false,
                dataType: 'json', // PHP එකෙන් එන JSON කියවීමට
                success: function (data) {
                    // Remove preloader
                    $('.someBlock').preloader('remove');

                    if (data.status === 'success') {
                        swal({
                            title: "Success!",
                            text: "Password updated successfully!",
                            type: 'success',
                            timer: 2000,
                            showConfirmButton: false
                        });

                        window.setTimeout(function () {
                            window.location.reload();
                        }, 2000);

                    } else {
                        // Backend එකෙන් error එකක් ආවොත් (උදා: Current Password වැරදියි නම්)
                        swal({
                            title: "Error!",
                            text: data.text || "Something went wrong.",
                            type: 'error',
                            timer: 2000,
                            showConfirmButton: false
                        });
                    }
                },
                error: function (xhr, status, error) {
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