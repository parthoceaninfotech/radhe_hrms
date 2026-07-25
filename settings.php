<?php
include 'root/config.php';
$ai_core->aiCheckLogin();

$page_nm = "System Settings";
$table = "tbl_settings";

if (isset($_POST['submit_settings'])) {
    foreach ($_POST['meta'] as $key => $value) {
        $key = addslashes($key);
        $value = addslashes($value);
        
        $check = $ai_db->aiGetQueryObj("SELECT id FROM $table WHERE meta_key='$key'");
        if ($check) {
            $ai_db->aiQuery("UPDATE $table SET meta_value='$value' WHERE meta_key='$key'");
        } else {
            $ai_db->aiQuery("INSERT INTO $table SET meta_key='$key', meta_value='$value'");
        }
    }

    if (isset($_FILES['logo']) && $_FILES['logo']['error'] == 0) {
        $old_logo = $ai_db->aiGetQueryObj("SELECT meta_value FROM $table WHERE meta_key='logo'")[0]->meta_value ?? '';
        $new_logo = $ai_core->aiUpload($_FILES['logo'], "assets/img/logo/", "image", $old_logo);
        
        if ($new_logo) {
            $check_logo = $ai_db->aiGetQueryObj("SELECT id FROM $table WHERE meta_key='logo'");
            if ($check_logo) {
                $ai_db->aiQuery("UPDATE $table SET meta_value='$new_logo' WHERE meta_key='logo'");
            } else {
                $ai_db->aiQuery("INSERT INTO $table SET meta_key='logo', meta_value='$new_logo'");
            }
        }
    }

    $_SESSION['success'] = "Settings Updated Successfully!";
    $ai_core->aiGoPage("settings.php");
}

include 'includes/header.php';
include 'includes/sidebar.php';

// Fetch current settings
$settings_res = $ai_db->aiGetQueryObj("SELECT * FROM $table");
$current_settings = [];
foreach($settings_res as $s) { $current_settings[$s->meta_key] = $s->meta_value; }
?>

<div class="page-wrapper">
    <div class="content">
        <div class="mb-4">
            <h3 class="page-title"><?php echo $page_nm; ?></h3>
            <p class="text-muted">Manage global system branding and configurations</p>
        </div>

        <div class="row">
            <div class="col-md-8">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white border-bottom-0 pt-4 px-4">
                        <h5 class="fw-bold mb-0">General Configuration</h5>
                    </div>
                    <div class="card-body p-4">
                        <form action="" method="POST" enctype="multipart/form-data">
                            <div class="row g-4">
                                <div class="col-md-12">
                                    <label class="form-label fw-bold small text-muted">Site Name</label>
                                    <input type="text" name="meta[site_name]" class="form-control" value="<?php echo $current_settings['site_name'] ?? 'RADHE CONSULTANCY'; ?>" placeholder="e.g. Radhe Consultancy">
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label fw-bold small text-muted">System Logo</label>
                                    <div class="d-flex align-items-center gap-3 mt-1">
                                        <div class="logo-preview border rounded p-2 bg-light d-flex align-items-center justify-content-center" style="width: 100px; height: 100px;">
                                            <?php if(isset($current_settings['logo'])): ?>
                                                <img src="assets/img/logo/<?php echo $current_settings['logo']; ?>" class="mw-100 mh-100" id="logoPreview">
                                            <?php else: ?>
                                                <i class="ti ti-photo fs-32 text-muted" id="logoPlaceholder"></i>
                                                <img src="" class="mw-100 mh-100 d-none" id="logoPreview">
                                            <?php endif; ?>
                                        </div>
                                        <div class="flex-grow-1">
                                            <input type="file" name="logo" class="form-control mb-2" onchange="previewImage(this)">
                                            <small class="text-muted d-block">Recommended size: 200x50px. Max 2MB.</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label fw-bold small text-muted">Copyright Text</label>
                                    <input type="text" name="meta[copyright]" class="form-control" value="<?php echo $current_settings['copyright'] ?? '2026 © Radhe Consultancy Software'; ?>">
                                </div>
                                <div class="col-md-12 pt-3">
                                    <button type="submit" name="submit_settings" class="btn btn-primary px-5 py-2 fw-bold shadow-sm rounded-pill">SAVE SETTINGS</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="card border-0 shadow-sm bg-primary text-white">
                    <div class="card-body p-4 text-center">
                        <i class="ti ti-info-circle fs-40 mb-3 d-block"></i>
                        <h5 class="fw-bold mb-2">Global Impact</h5>
                        <p class="opacity-75 small">Changes made here will reflect across the entire administrative dashboard, including the top bar, footer, and emails.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function previewImage(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('logoPreview').src = e.target.result;
            document.getElementById('logoPreview').classList.remove('d-none');
            const placeholder = document.getElementById('logoPlaceholder');
            if(placeholder) placeholder.classList.add('d-none');
        }
        reader.readAsDataURL(input.files[0]);
    }
}
</script>

<?php include 'includes/footer.php'; ?>
