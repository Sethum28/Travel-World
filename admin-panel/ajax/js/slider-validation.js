jQuery(document).ready(function () {

    // Create / Save Slider via Create Button
    $("#create").click(function (event) {
        event.preventDefault(); // Browser default form reload එක නවත්වයි

        // --- FORM INPUT VALUES ---
        title = $('#title').val() ? $('#title').val().trim() : "";
        image = $('#image').val() ? $('#image').val().trim() : "";

        // --- FRONT-END VALIDATION (IF/ELSE IF STRUCTURE) ---
        if (!title || title.length === 0) {
            swal({
                title: "Error!",
                text: "Please enter the Destination Title!",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
        } else if (!image || image.length === 0) {
            swal({
                title: "Error!",
                text: "Please enter the Image File Name or URL!",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
        } else {

            // Preloader start (Optional)
            $('.someBlock').preloader();

            // Grab all form data from the form
            formData = new FormData($("#slider-ajax-form")[0]);
            formData.append('create', true); // Branch කෝඩ් එකේ රටාවට 'create' කියන එක append කලා

            $.ajax({
                url: "slider.php",
                type: 'POST',
                data: formData,
                async: false,
                cache: false,
                contentType: false,
                processData: false,
                success: function (result) {
                    // Remove preloader
                    $('.someBlock').preloader('remove');

                    // PHP එකෙන් එන response එක JSON string එකක් නම් ඒක Object එකක් කරගැනීමට
                    try {
                        data = typeof result === 'string' ? JSON.parse(result) : result;
                    } catch (e) {
                        data = result;
                    }

                    if (data.status === 'success' || data.icon === 'success') {
                        swal({
                            title: "Success!",
                            text: "Slider saved successfully!",
                            type: 'success',
                            timer: 2000,
                            showConfirmButton: false
                        });

                        window.setTimeout(function () {
                            window.location.reload();
                        }, 2000);

                    } else {
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