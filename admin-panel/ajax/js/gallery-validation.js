jQuery(document).ready(function () {

    // Gallery Image Add
    $("#create").click(function (event) {
        event.preventDefault();

        // --- FRONT-END VALIDATION ---
        if (!$('#caption').val() || $('#caption').val().length === 0) {
            swal({
                title: "Error!",
                text: "Please enter the Image Caption!",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
        } else if (!$("#gallery-image-input")[0] || !$("#gallery-image-input")[0].files || $("#gallery-image-input")[0].files.length === 0) {
            swal({
                title: "Error!",
                text: "Please select an Image to upload!",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
        } else {
            
            // Preloader start
            $('.someBlock').preloader();

            // Grab all form data (Variable keywords නැතුව)
            formData = new FormData($("#gallery-add-form")[0]);
            formData.append('create', true);

            $.ajax({
                url: "gallery.php",
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
                            text: "Image uploaded successfully!",
                            type: 'success',
                            timer: 2000,
                            showConfirmButton: false
                        });

                        window.setTimeout(function () {
                            window.location.reload();
                        }, 2000);

                    } else if (result.status === 'error') {
                        swal({
                            title: "Error!",
                            text: "Something went wrong.",
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