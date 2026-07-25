<!-- Footer Start -->
<div class="footer text-center p-3 border-top"
    style="background: var(--sidebar-bg); border-color: rgba(255, 255, 255, 0.05) !important;">
    <p class="mb-0" style="color: rgba(255, 255, 255, 0.6); font-size: 13px; font-weight: 500;">
        2026 &copy; <a href="javascript:void(0);"
            style="color: var(--primary); text-decoration: none; font-weight: 700;">radheconsultancy Software</a>. All
        Rights Reserved.
    </p>
</div>
<!-- Footer End -->

</div>

<!-- jQuery -->
<script src="assets/js/jquery-3.7.1.min.js"></script>

<!-- Bootstrap Core JS -->
<script src="assets/js/bootstrap.bundle.min.js"></script>

<!-- Simplebar JS -->
<script src="assets/plugins/simplebar/simplebar.min.js"></script>

<!-- Chart JS -->
<script src="assets/plugins/apexchart/apexcharts.min.js"></script>
<script src="assets/plugins/apexchart/chart-data.js"></script>

<!-- Daterangepikcer JS -->
<script src="assets/js/moment.min.js"></script>
<script src="assets/plugins/daterangepicker/daterangepicker.js"></script>
<script src="assets/js/bootstrap-datetimepicker.min.js"></script>

<!-- Select2 JS -->
<script src="assets/plugins/select2/js/select2.min.js"></script>

<!-- Main JS -->
<script src="assets/js/script.js"></script>

<!-- Toastr JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<!-- Form Validation JS -->
<script src="assets/js/form-validation.js"></script>

<!-- SweetAlert2 JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    // Toggle Password Visibility
    function togglePassword(inputId, iconElement) {
        const input = document.getElementById(inputId);
        const icon = iconElement.querySelector('i');
        if (input.type === 'password') {
            input.type = 'text';
            icon.classList.replace('ti-eye', 'ti-eye-off');
        } else {
            input.type = 'password';
            icon.classList.replace('ti-eye-off', 'ti-eye');
        }
    }

    // Global Delete Confirmation
    function confirmDelete(url, message = "You won't be able to revert this!") {
        Swal.fire({
            title: 'Are you sure?',
            text: message,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3b82f6',
            cancelButtonColor: '#ef4444',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'Cancel',
            background: document.documentElement.getAttribute('data-bs-theme') === 'dark' ? '#1a1f2e' : '#ffffff',
            color: document.documentElement.getAttribute('data-bs-theme') === 'dark' ? '#ffffff' : '#1e293b'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = url;
            }
        });
        return false;
    }

    // Global Loader Functions
    function showLoader() {
        document.body.classList.remove('loaded');
        document.body.classList.add('loading');
    }

    function hideLoader() {
        document.body.classList.add('loaded');
        document.body.classList.remove('loading');
    }

    $(document).ready(function () {
        // Global AJAX Loader Hooks
        $(document).ajaxStart(function () {
            showLoader();
        }).ajaxStop(function () {
            hideLoader();
        });

        // Automatically hook into all delete buttons that use standard confirm()
        // Use capturing phase (true) to intercept before the inline onclick executes
        document.addEventListener('click', function (e) {
            let target = e.target.closest('a[onclick*="confirm"]');
            if (target) {
                e.preventDefault();
                e.stopImmediatePropagation();

                let url = target.getAttribute('href');
                let onclickAttr = target.getAttribute('onclick');
                let match = onclickAttr.match(/'([^']+)'/);
                let message = match ? match[1] : "Are you sure you want to delete this?";

                confirmDelete(url, message);
            }
        }, true);

        // Initialize Select2 for all select elements
        $('select').select2({
            width: '100%',
            placeholder: "Select an option",
            allowClear: true,
            templateResult: function (data, container) {
                if (data.element) {
                    if (data.text.trim().toLowerCase() === 'active') {
                        $(container).addClass('active-status');
                    } else if (data.text.trim().toLowerCase() === 'inactive') {
                        $(container).addClass('inactive-status');
                    }
                }
                return data.text;
            },
            templateSelection: function (data, container) {
                if (data.element) {
                    if (data.text.trim().toLowerCase() === 'active') {
                        $(container).addClass('active-status');
                    } else if (data.text.trim().toLowerCase() === 'inactive') {
                        $(container).addClass('inactive-status');
                    }
                }
                return data.text;
            }
        });

        // Toastr Configuration
        toastr.options = {
            "closeButton": true,
            "debug": false,
            "newestOnTop": true,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        };

        // Check for msg parameter in URL
        const urlParams = new URLSearchParams(window.location.search);
        if (urlParams.has('msg')) {
            const msgId = urlParams.get('msg');
            if (msgId == '1') toastr.success("Record Added Successfully!");
            else if (msgId == '2') toastr.success("Record Updated Successfully!");
            else if (msgId == '3') toastr.error("Record Deleted Successfully!");
            else if (msgId == 'mail_sent') toastr.success("Quotation Mail Sent Successfully!");
            else if (msgId == 'mail_failed') toastr.error("Failed to Send Mail. Check SMTP Settings.");
            else if (msgId == 'invalid_email') toastr.warning("Invalid Email Address provided.");
            else if (msgId == 'plan_shared') toastr.success("Plan Shared with Plan Maker!");
            else if (msgId == 'plan_approved') toastr.success("Plan Approved and Notification Sent!");
            else if (msgId == 'stability_mail_sent') toastr.success("Stability Mail Sent to Checker!");
        }

        // Check for session messages
        <?php if (isset($_SESSION['success'])): ?>
            toastr.success("<?php echo $_SESSION['success']; ?>");
            <?php unset($_SESSION['success']); ?>
        <?php endif; ?>

        <?php if (isset($_SESSION['error'])): ?>
            toastr.error("<?php echo $_SESSION['error']; ?>");
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>

        <?php if (isset($_SESSION['info'])): ?>
            toastr.info("<?php echo $_SESSION['info']; ?>");
            <?php unset($_SESSION['info']); ?>
        <?php endif; ?>

        <?php if (isset($_SESSION['warning'])): ?>
            toastr.warning("<?php echo $_SESSION['warning']; ?>");
            <?php unset($_SESSION['warning']); ?>
        <?php endif; ?>

        // Mobile Sidebar Toggle
        $('#mobile_btn').on('click', function (e) {
            e.preventDefault();
            $('body').toggleClass('menu-opened');
            return false;
        });

        // Close Sidebar when clicking overlay
        $('#sidebar_overlay').on('click', function () {
            $('body').removeClass('menu-opened');
        });

        // Close Sidebar on window resize if > 991px
        $(window).resize(function () {
            if ($(window).width() > 991) {
                $('body').removeClass('menu-opened');
            }
        });

        // Real-time uppercase conversion as user types (excluding passwords, files, and checkboxes/radios)
        $(document).on('input', 'input, textarea', function () {
            if (this.type !== 'password' && this.type !== 'file' && this.type !== 'checkbox' && this.type !== 'radio') {
                const start = this.selectionStart;
                const end = this.selectionEnd;
                this.value = this.value.toUpperCase();
                if (start !== null && end !== null) {
                    this.setSelectionRange(start, end);
                }
            }
        });

        // Auto-convert typed inputs to uppercase on submit (handles autofill / missed events)
        $('form').on('submit', function () {
            $(this).find('input[type="text"], input[type="search"], input[type="url"], input[type="tel"], input[type="email"], textarea').each(function () {
                this.value = this.value.toUpperCase();
            });
        });
    });
</script>

</body>

</html>