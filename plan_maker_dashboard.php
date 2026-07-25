<?php
include 'root/config.php';
ob_start();
$ai_core->aiCheckLogin();

// --- ROLE-BASED ACCESS CONTROL ---
$user_role = $_SESSION['role'] ?? '';
if ($user_role !== 'Plan Maker' && $_SESSION['user_type'] !== 'admin') {
    $ai_core->aiGoPage("advisory_dashboard.php");
    exit;
}

include 'includes/header.php';
include 'includes/sidebar_advisory.php';

$page_nm = "Plan Maker Dashboard";
$table = "tbl_factory_quotations";
$redirection_url = "plan_maker_dashboard.php";

$user_id = $_SESSION['id'] ?? 0;

// --- HANDLE FILE UPLOAD ---
// --- AJAX UPLOAD INWARD HANDLER ---
if (isset($_POST['action']) && $_POST['action'] == 'ajax_upload_inward') {
    ob_clean();
    header('Content-Type: application/json');
    $id = intval($_POST['quotation_id']);
    $inward_letter = '';

    if (isset($_FILES['inward_letter']) && $_FILES['inward_letter']['error'] == 0) {
        $inward_letter = $ai_core->aiUpload($_FILES['inward_letter'], 'uploads/plans/');
        if ($ai_db->aiQuery("UPDATE $table SET inward_letter='$inward_letter', plan_approval_status='Inward Submitted' WHERE id='$id' AND plan_maker_id='$user_id'")) {
            echo json_encode(['status' => 'success', 'message' => 'Document Uploaded Successfully!']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to update database.']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'File upload failed.']);
    }
    exit;
}

if (isset($_POST['btn_upload_inward']) && isset($_POST['quotation_id'])) {
    $id = intval($_POST['quotation_id']);
    $inward_letter = '';

    if (isset($_FILES['inward_letter']) && $_FILES['inward_letter']['error'] == 0) {
        $inward_letter = $ai_core->aiUpload($_FILES['inward_letter'], 'uploads/plans/');
        $ai_db->aiQuery("UPDATE $table SET inward_letter='$inward_letter', plan_approval_status='Inward Submitted' WHERE id='$id' AND plan_maker_id='$user_id'");
        $ai_core->aiGoPage($redirection_url . "?msg=uploaded");
    }
}

// --- FETCH ASSIGNED PLANS ---
$assigned_plans = $ai_db->aiGetQueryObj("SELECT * FROM $table WHERE plan_maker_id='$user_id' AND plan_approval_status != 'Assigned' AND plan_approval_status IS NOT NULL AND plan_approval_status != '' ORDER BY id DESC");
?>

<div class="page-wrapper">
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="d-md-flex d-block align-items-center justify-content-between mb-4 pb-3 border-bottom">
                    <div>
                        <div class="d-flex align-items-center mb-1">
                            <div class="bg-primary-gradient p-2 rounded-3 me-3">
                                <i class="ti ti-list-check text-white fs-24"></i>
                            </div>
                            <div>
                                <h3 class="page-title mb-0 fw-bold">My Assigned Plans</h3>
                                <p class="text-muted small mb-0"><i class="ti ti-user-check me-1"></i>Task Queue | Plan
                                    Maker Interface</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card border-0 shadow-sm">
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle table-nowrap mb-0">
                                <thead class="bg-light">
                                    <tr>
                                        <th class="ps-4">Sr No</th>
                                        <th>Company Details</th>
                                        <th>Status</th>
                                        <th>Inward Letter</th>
                                        <th class="text-end pe-4">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (empty($assigned_plans)): ?>
                                        <tr>
                                            <td colspan="5" class="text-center py-5 text-muted">No plans assigned yet.</td>
                                        </tr>
                                    <?php else: ?>
                                        <?php $sr = 1;
                                        foreach ($assigned_plans as $row): ?>
                                            <tr>
                                                <td class="ps-4 fw-bold text-muted"><?php echo $sr++; ?></td>
                                                <td style="max-width: 400px; white-space: normal;">
                                                    <span
                                                        class="fw-bold d-block text-dark fs-14 mb-1"><?php echo $row->company_name; ?></span>
                                                    <div class="d-flex flex-column gap-1">
                                                        <span class="text-muted small" style="line-height: 1.4;">
                                                            <i
                                                                class="ti ti-map-pin me-1 text-primary"></i><?php echo $row->address; ?>
                                                        </span>
                                                        <span class="text-muted small"><i
                                                                class="ti ti-phone me-1 text-success"></i><?php echo $row->phone; ?></span>
                                                        <span class="text-muted small"><i
                                                                class="ti ti-mail me-1 text-info"></i><?php echo $row->email; ?></span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <?php
                                                    $cls = "bg-soft-warning text-warning";
                                                    if ($row->plan_approval_status == 'Plan Approved')
                                                        $cls = "bg-soft-success text-success";
                                                    if ($row->plan_approval_status == 'Inward Submitted')
                                                        $cls = "bg-soft-info text-info";
                                                    ?>
                                                    <span
                                                        class="badge <?php echo $cls; ?>"><?php echo $row->plan_approval_status; ?></span>
                                                </td>
                                                <td>
                                                    <?php if ($row->inward_letter): ?>
                                                        <?php
                                                        $ext = pathinfo($row->inward_letter, PATHINFO_EXTENSION);
                                                        $is_image = in_array(strtolower($ext), ['jpg', 'jpeg', 'png', 'gif', 'webp']);
                                                        $file_path = "uploads/plans/" . $row->inward_letter;
                                                        ?>
                                                        <?php if ($is_image): ?>
                                                            <button type="button" class="btn btn-sm btn-soft-primary"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#imageModal<?php echo $row->id; ?>">
                                                                <i class="ti ti-eye me-1"></i> View Image
                                                            </button>
                                                        <?php else: ?>
                                                            <a href="<?php echo $file_path; ?>" target="_blank"
                                                                class="btn btn-sm btn-soft-primary">
                                                                <i class="ti ti-eye me-1"></i> View PDF
                                                            </a>
                                                        <?php endif; ?>
                                                    <?php else: ?>
                                                        <span class="text-muted small">Not Uploaded</span>
                                                    <?php endif; ?>
                                                </td>
                                                <td class="text-end pe-4">
                                                    <?php if (!$row->inward_letter || $row->plan_approval_status == 'Shared'): ?>
                                                        <button class="btn btn-primary btn-sm px-3 fw-bold" data-bs-toggle="modal"
                                                            data-bs-target="#uploadModal<?php echo $row->id; ?>">
                                                            <i class="ti ti-upload me-1"></i> Upload Inward
                                                        </button>
                                                    <?php else: ?>
                                                        <span class="badge bg-soft-success text-success py-2 px-3">
                                                            <i class="ti ti-circle-check me-1"></i>Submitted
                                                        </span>
                                                    <?php endif; ?>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php if (!empty($assigned_plans)): ?>
    <?php foreach ($assigned_plans as $row): ?>
        <div class="modal fade" id="uploadModal<?php echo $row->id; ?>" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <form id="uploadForm_<?php echo $row->id; ?>" method="POST" enctype="multipart/form-data"
                    onsubmit="ajaxSubmitInward(<?php echo $row->id; ?>, event, this)">
                    <div class="modal-content border-0 shadow-lg" style="border-radius: 20px;">
                        <div class="modal-header border-0 pb-0 px-4 pt-4">
                            <h5 class="modal-title fw-bold text-dark">
                                <i class="ti ti-file-upload me-2 text-primary"></i>Upload Inward Letter
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body px-4 py-4">
                            <input type="hidden" name="quotation_id" value="<?php echo $row->id; ?>">
                            <input type="hidden" name="action" value="ajax_upload_inward">
                            <div class="upload-area p-4 border-dashed rounded-3 text-center bg-light mb-3">
                                <i class="ti ti-cloud-upload fs-40 text-primary mb-2 d-block"></i>
                                <p class="mb-2 fw-medium text-dark">Select Document to Upload</p>
                                <p class="text-muted small mb-3">Support: PDF, JPG, PNG (Max 5MB)</p>
                                <input type="file" name="inward_letter" class="form-control border-0 bg-white shadow-sm"
                                    required>
                            </div>
                            <div class="alert alert-soft-info d-flex align-items-center border-0 mb-0">
                                <i class="ti ti-info-circle fs-20 me-2"></i>
                                <span class="small">This document will be visible to the admin once submitted.</span>
                            </div>
                        </div>
                        <div class="modal-footer border-0 px-4 pb-4 pt-0">
                            <button type="button" class="btn btn-soft-secondary px-4 fw-bold"
                                data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary px-4 fw-bold shadow-lg">
                                <i class="ti ti-circle-check me-1"></i>Submit Document
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Image Preview Modal -->
        <?php
        $ext = pathinfo($row->inward_letter, PATHINFO_EXTENSION);
        if (in_array(strtolower($ext), ['jpg', 'jpeg', 'png', 'gif', 'webp'])):
            ?>
            <div class="modal fade" id="imageModal<?php echo $row->id; ?>" tabindex="-1">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content border-0 shadow-lg" style="border-radius: 20px; overflow: hidden;">
                        <div class="modal-header border-0 bg-white px-4 pt-4 pb-2">
                            <h5 class="modal-title fw-bold text-dark">Document Preview</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body p-0 text-center bg-light">
                            <img src="uploads/plans/<?php echo $row->inward_letter; ?>" class="img-fluid"
                                style="max-height: 80vh; width: auto;">
                        </div>
                        <div class="modal-footer border-0 bg-white p-3 justify-content-center">
                            <a href="uploads/plans/<?php echo $row->inward_letter; ?>" download
                                class="btn btn-primary px-4 fw-bold">
                                <i class="ti ti-download me-1"></i>Download Original
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    <?php endforeach; ?>
<?php endif; ?>

<script>
    function ajaxSubmitInward(id, event, form) {
        event.preventDefault();
        const formData = new FormData(form);
        const btn = form.querySelector('button[type="submit"]');
        const originalHtml = btn.innerHTML;
        btn.innerHTML = '<i class="ti ti-loader-2 rotate me-2"></i> Submitting...';
        btn.disabled = true;

        $.ajax({
            url: 'plan_maker_dashboard.php',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            dataType: 'json',
            success: function (data) {
                if (data.status === 'success') {
                    toastr.success(data.message, 'Success');
                    closeBootstrapModal(`uploadModal${id}`);
                    setTimeout(() => location.reload(), 1000);
                } else {
                    toastr.error(data.message, 'Error');
                }
            },
            error: function (xhr) {
                console.error(xhr.responseText);
                toastr.error('Failed to upload document.', 'Server Error');
            },
            complete: function () {
                btn.innerHTML = originalHtml;
                btn.disabled = false;
            }
        });
    }

    function closeBootstrapModal(id) {
        const el = document.getElementById(id);
        if (!el) return;

        try {
            const modalInstance = bootstrap.Modal.getInstance(el) || new bootstrap.Modal(el);
            if (modalInstance) modalInstance.hide();
        } catch (e) {
            console.error("BS Modal hide error", e);
        }

        if (typeof jQuery !== 'undefined') {
            try {
                $(`#${id}`).modal('hide');
            } catch (e) { }
        }

        // Force cleanup
        setTimeout(() => {
            const backdrops = document.querySelectorAll('.modal-backdrop');
            if (backdrops.length > 0) {
                backdrops.forEach(b => b.remove());
            }
            document.body.classList.remove('modal-open');
            document.body.style.overflow = '';
            document.body.style.paddingRight = '';
            if (document.activeElement instanceof HTMLElement) {
                document.activeElement.blur();
            }
            el.classList.remove('show');
            el.style.display = 'none';
        }, 400);
    }
</script>
<style>
    .rotate {
        animation: spin 1s linear infinite;
        display: inline-block;
    }

    @keyframes spin {
        from {
            transform: rotate(0deg);
        }

        to {
            transform: rotate(360deg);
        }
    }
</style>
<?php include 'includes/footer.php'; ?>