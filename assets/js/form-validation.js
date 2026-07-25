
// Example starter JavaScript for disabling form submissions if there are invalid fields
(function () {
    'use strict';
    window.addEventListener('load', function () {
        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.getElementsByClassName('needs-validation');
        // Loop over them and prevent submission
        var validation = Array.prototype.filter.call(forms, function (form) {
            form.addEventListener('submit', function (event) {
                if (form.checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();

                    // Find all invalid elements
                    var invalidElements = form.querySelectorAll(':invalid');
                    if (invalidElements.length > 0) {
                        // Just show toast for the first invalid element to avoid spamming
                        var firstInvalid = invalidElements[0];
                        var fieldLabel = "";

                        // Try to find the label text
                        var label = form.querySelector('label[for="' + firstInvalid.id + '"]') ||
                            firstInvalid.closest('.col-md-3, .col-md-4, .col-md-6, .mb-3')?.querySelector('.form-label');

                        if (label) {
                            fieldLabel = label.innerText.replace('*', '').trim();
                        } else {
                            fieldLabel = firstInvalid.getAttribute('placeholder') || firstInvalid.getAttribute('name') || "this field";
                        }

                        // Check specific validity states
                        toastr.clear(); // Clear existing toasts to prevent stacking
                        if (firstInvalid.validity.valueMissing) {
                            toastr.error("Please enter " + fieldLabel, "Action Required");
                        } else if (firstInvalid.validity.typeMismatch && firstInvalid.type === 'email') {
                            toastr.error("Please enter a valid email address", "Invalid Email");
                        } else if (firstInvalid.validity.patternMismatch) {
                            toastr.error("Invalid format for " + fieldLabel, "Pattern Mismatch");
                        } else {
                            toastr.error("Please check the input for " + fieldLabel, "Error Occurred");
                        }

                        firstInvalid.focus();
                    }
                }
                form.classList.add('was-validated');
            }, false);
        });
    }, false);
})();