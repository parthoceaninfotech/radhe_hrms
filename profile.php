<?php
include 'root/config.php';
$ai_core->aiCheckLogin();

$page_nm = "Profile Settings";
$user_type = $_SESSION['user_type'] ?? '';
$table = ($user_type === 'admin') ? "tbl_admin" : "tbl_users";
$admin_id = $_SESSION['id'];

// Map column names based on table
$name_col = ($table === 'tbl_admin') ? 'username' : 'name';

if (isset($_POST['update_profile'])) {
    $username = addslashes($_POST[$name_col]);
    $email = addslashes($_POST['email']);

    $sql = "UPDATE $table SET $name_col='$username', email='$email' WHERE id='$admin_id'";
    $ai_db->aiQuery($sql);

    if (isset($_FILES['profile_pic']) && $_FILES['profile_pic']['error'] == 0) {
        $path = ($table === 'tbl_admin') ? "assets/img/profiles/" : "assets/img/users/";
        $old_pic = $ai_db->aiGetQueryObj("SELECT profile_pic FROM $table WHERE id='$admin_id'")[0]->profile_pic ?? '';
        $new_pic = $ai_core->aiUpload($_FILES['profile_pic'], $path, "image", $old_pic);
        if ($new_pic) {
            $ai_db->aiQuery("UPDATE $table SET profile_pic='$new_pic' WHERE id='$admin_id'");
        }
    }

    if (!empty($_POST['new_password'])) {
        $password = md5($_POST['new_password']);
        $ai_db->aiQuery("UPDATE $table SET password='$password' WHERE id='$admin_id'");
    }

    $_SESSION['success'] = "Profile Updated Successfully!";
    $_SESSION['username'] = $username;
    $ai_core->aiGoPage("profile.php");
}

include 'includes/header.php';
include 'includes/sidebar.php';

$admin_info = $ai_db->aiGetQueryObj("SELECT * FROM $table WHERE id='$admin_id'")[0] ?? null;

// Ensure admin_pic is set
$admin_pic = "assets/img/profiles/avatar.png"; // Default
if ($admin_info && !empty($admin_info->profile_pic)) {
    $path = ($table === 'tbl_admin') ? "assets/img/profiles/" : "assets/img/users/";
    $admin_pic = $path . $admin_info->profile_pic;
}
?>

<div class="page-wrapper">
    <div class="content">
        <div class="mb-4">
            <h3 class="page-title"><?php echo $page_nm; ?></h3>
            <p class="text-muted">Manage your personal account information and security</p>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="card border-0 shadow-sm text-center">
                    <div class="card-body p-5">
                        <div class="position-relative d-inline-block mb-4">
                            <img src="<?php echo $admin_pic; ?>"
                                class="rounded-circle object-fit-cover border shadow-sm" width="150" height="150"
                                id="profilePreview">
                            <label for="profile_input"
                                class="position-absolute bottom-0 end-0 bg-primary text-white p-2 rounded-circle shadow-sm border border-white cursor-pointer"
                                style="width: 40px; height: 40px; transform: translate(5px, 5px);">
                                <i class="ti ti-camera fs-18"></i>
                            </label>
                        </div>
                        <h4 class="fw-bold mb-1"><?php echo $admin_info ? $admin_info->$name_col : 'User'; ?></h4>
                        <p class="text-muted small"><?php echo $admin_info ? $admin_info->email : 'No Email'; ?></p>
                        <span
                            class="badge bg-soft-primary text-primary px-3 rounded-pill"><?php echo ucfirst($user_type); ?></span>
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white border-bottom-0 pt-4 px-4">
                        <h5 class="fw-bold mb-0">Edit Profile Details</h5>
                    </div>
                    <div class="card-body p-4">
                        <form action="" method="POST" enctype="multipart/form-data">
                            <input type="file" name="profile_pic" id="profile_input" class="d-none"
                                onchange="previewProfile(this)">
                            <div class="row g-4">
                                <div class="col-md-6">
                                    <label class="form-label fw-bold small text-muted">Full Name / Username</label>
                                    <input type="text" name="<?php echo $name_col; ?>" class="form-control"
                                        value="<?php echo $admin_info ? $admin_info->$name_col : ''; ?>" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold small text-muted">Email Address</label>
                                    <input type="email" name="email" class="form-control"
                                        value="<?php echo $admin_info ? $admin_info->email : ''; ?>" required>
                                </div>
                                <div class="col-md-12">
                                    <hr class="my-2 opacity-50">
                                    <h6 class="fw-bold mb-3 text-primary"><i class="ti ti-lock me-2"></i>Change Password
                                        (Leave blank to keep current)</h6>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold small text-muted">New Password</label>
                                    <input type="password" name="new_password" class="form-control"
                                        placeholder="••••••••">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold small text-muted">Confirm Password</label>
                                    <input type="password" class="form-control" placeholder="••••••••">
                                </div>
                                <div class="col-md-12 pt-3">
                                    <button type="submit" name="update_profile"
                                        class="btn btn-primary px-5 py-2 fw-bold shadow-sm rounded-pill">UPDATE
                                        PROFILE</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function previewProfile(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                document.getElementById('profilePreview').src = e.target.result;
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>

<style>
    .cursor-pointer {
        cursor: pointer;
    }
</style>

<?php include 'includes/footer.php'; ?>