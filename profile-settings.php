<?php
include 'includes/header.php';
include 'includes/sidebar.php';
?>

<!-- Page Wrapper -->
<div class="page-wrapper">
    <div class="content">
        <!-- Page Header -->
        <div class="d-md-flex d-block align-items-center justify-content-between mb-3">
            <div class="my-auto mb-2">
                <h3 class="page-title mb-1">Profile Settings</h3>
                <nav>
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                        <li class="breadcrumb-item active">Profile Settings</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!-- /Page Header -->

        <div class="row">
            <!-- Profile Info -->
            <div class="col-xl-8">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Basic Information</h5>
                    </div>
                    <div class="card-body">
                        <form action="" method="POST" class="needs-validation" novalidate>
                            <div class="row">
                                <div class="col-md-12 mb-4 text-center">
                                    <div class="profile-img-wrap position-relative d-inline-block">
                                        <img src="assets/img/users/user-01.jpg" class="rounded-circle avatar avatar-xl border border-3 border-primary" id="profileImg" alt="Profile">
                                        <label for="imgUpload" class="position-absolute bottom-0 end-0 bg-primary text-white rounded-circle p-2 cursor-pointer" style="width: 35px; height: 35px; display: flex; align-items: center; justify-content: center;">
                                            <i class="ti ti-camera"></i>
                                            <input type="file" id="imgUpload" class="d-none" accept="image/*">
                                        </label>
                                    </div>
                                    <p class="text-muted fs-13 mt-2">Allowed JPG, GIF or PNG. Max size of 2MB</p>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Full Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="full_name" value="Admin User" required placeholder="Enter Full Name">
                                    <div class="invalid-feedback">Required field.</div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Email Address <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control" name="email" value="admin@armorfire.com" required placeholder="Enter Email">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Phone Number</label>
                                    <input type="text" class="form-control" name="phone" value="+1 234 567 890" placeholder="Enter Phone">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Designation</label>
                                    <input type="text" class="form-control" name="designation" value="Administrator" placeholder="Enter Designation">
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Bio / About</label>
                                    <textarea class="form-control" name="bio" rows="4" placeholder="Tell us about yourself...">Experienced administrator focusing on fire safety compliance and insurance management.</textarea>
                                </div>
                            </div>
                            <div class="text-end mt-3">
                                <button type="submit" class="btn btn-primary px-5">Save Changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Side Cards -->
            <div class="col-xl-4">
                <!-- Change Password -->
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Security</h5>
                    </div>
                    <div class="card-body">
                        <form action="" method="POST" class="needs-validation" novalidate>
                            <div class="mb-3">
                                <label class="form-label">Current Password</label>
                                <input type="password" class="form-control" required placeholder="********">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">New Password</label>
                                <input type="password" class="form-control" required placeholder="********">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Confirm New Password</label>
                                <input type="password" class="form-control" required placeholder="********">
                            </div>
                            <button type="submit" class="btn btn-outline-primary w-100">Update Password</button>
                        </form>
                    </div>
                </div>

                <!-- Notification Preferences -->
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Preferences</h5>
                    </div>
                    <div class="card-body">
                        <div class="form-check form-switch mb-3">
                            <input class="form-check-input" type="checkbox" id="emailNotify" checked>
                            <label class="form-check-label" for="emailNotify">Email Notifications</label>
                        </div>
                        <div class="form-check form-switch mb-3">
                            <input class="form-check-input" type="checkbox" id="smsNotify">
                            <label class="form-check-label" for="smsNotify">SMS Alerts</label>
                        </div>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="darkMode" checked>
                            <label class="form-check-label" for="darkMode">Dark Mode Default</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<script>
// Image preview
document.getElementById('imgUpload').addEventListener('change', function(e) {
    if (e.target.files && e.target.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('profileImg').src = e.target.result;
        }
        reader.readAsDataURL(e.target.files[0]);
    }
});

// Form validation
(function () {
  'use strict'
  var forms = document.querySelectorAll('.needs-validation')
  Array.prototype.slice.call(forms).forEach(function (form) {
      form.addEventListener('submit', function (event) {
        if (!form.checkValidity()) {
          event.preventDefault();
          event.stopPropagation();
        }
        form.classList.add('was-validated');
      }, false);
    });
})();
</script>

<?php include 'includes/footer.php'; ?>
