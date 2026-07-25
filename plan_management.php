<?php
include 'root/config.php';
$ai_core->aiCheckLogin();
include 'includes/header.php';
include 'includes/sidebar_advisory.php';

// --- CONFIGURATION ---
$page_nm = "Plan Management";
$table = "tbl_plans";
$redirection_url = "plan_management.php";

$mode = $_REQUEST['mode'] ?? 'list';
$id = isset($_REQUEST['id']) ? intval($_REQUEST['id']) : 0;
$data = null;

// --- HANDLE POST ACTIONS ---
if (isset($_POST['btn_submit'])) {
    $company_name = addslashes($_POST['company_name']);
    $address = addslashes($_POST['address']);
    $email = addslashes($_POST['email']);
    $phone = addslashes($_POST['phone']);
    $status = $_POST['status'] ?? 'Plan';
    $assigned_date = $_POST['assigned_date'];
    $submitted_date = $_POST['submitted_date'];

    $inward_letter = ($data && isset($data->inward_letter)) ? $data->inward_letter : '';
    if (isset($_FILES['inward_letter']) && $_FILES['inward_letter']['error'] == 0) {
        $inward_letter = $ai_core->aiUpload($_FILES['inward_letter'], 'uploads/plans/');
    }

    if ($mode === "add") {
        $sql = "INSERT INTO $table SET company_name='$company_name', address='$address', email='$email', phone='$phone', status='$status', assigned_date='$assigned_date', submitted_date='$submitted_date', inward_letter='$inward_letter'";
        $msg = 1;
    } else {
        $sql = "UPDATE $table SET company_name='$company_name', address='$address', email='$email', phone='$phone', status='$status', assigned_date='$assigned_date', submitted_date='$submitted_date', inward_letter='$inward_letter' WHERE id='$id'";
        $msg = 2;
    }

    $ai_db->aiQuery($sql);
    $ai_core->aiGoPage($redirection_url . "?msg=$msg");
}

// --- HANDLE DELETE ---
if ($mode === "delete" && $id) {
    $ai_db->aiQuery("DELETE FROM $table WHERE id='$id'");
    $ai_core->aiGoPage($redirection_url . "?msg=3");
}

// --- FETCH LIST DATA WITH FILTERS ---
$list_data = [];
if ($mode === 'list') {
    $where = " WHERE 1=1";
    $search = $_GET['search'] ?? '';
    if (!empty($search)) {
        $where .= " AND (company_name LIKE '%$search%' OR phone LIKE '%$search%')";
    }
    $sql = "SELECT * FROM $table $where ORDER BY id DESC";
    $list_data = $ai_db->aiGetQueryObj($sql);

    // Stats
    $stats = [
        'total' => count($ai_db->aiGetQueryObj("SELECT id FROM $table")),
        'planning' => count($ai_db->aiGetQueryObj("SELECT id FROM $table WHERE status='Plan'")),
        'submitted' => count($ai_db->aiGetQueryObj("SELECT id FROM $table WHERE status='Submit'")),
        'approved' => count($ai_db->aiGetQueryObj("SELECT id FROM $table WHERE status='Approved'")),
        'rejected' => count($ai_db->aiGetQueryObj("SELECT id FROM $table WHERE status='Rejected'")),
        'recent' => count($ai_db->aiGetQueryObj("SELECT id FROM $table WHERE created_at >= DATE_SUB(NOW(), INTERVAL 30 DAY)"))
    ];
}

// --- FETCH DATA FOR EDIT ---
if (($mode === "edit") && $id && !isset($_POST['btn_submit'])) {
    $result = $ai_db->aiGetQueryObj("SELECT * FROM $table WHERE id='$id' LIMIT 1");
    $data = $result[0] ?? null;
}
?>

<div class="page-wrapper">
    <div class="content">

        <?php if ($mode == 'list'): ?>
            <div class="d-md-flex d-block align-items-center justify-content-between mb-4">
                <div class="my-auto mb-2">
                    <h3 class="page-title mb-1"><?php echo $page_nm; ?> Statistics</h3>
                </div>
                <div class="mb-2 d-flex gap-2">
                    <button class="btn btn-soft-primary d-flex align-items-center shadow-sm" type="button"
                        data-bs-toggle="collapse" data-bs-target="#filterCollapse" aria-expanded="false">
                        <i class="ti ti-filter me-2"></i>Filter
                    </button>
                    <a href="plan_management.php?mode=add" class="btn btn-primary shadow-sm"><i
                            class="ti ti-plus me-2"></i>Add New Plan</a>
                </div>
            </div>

            <!-- Filters Section (Collapsible) -->
            <div class="collapse mb-4" id="filterCollapse">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-3">
                        <form action="plan_management.php" method="GET" class="row g-3">
                            <input type="hidden" name="mode" value="list">
                            <div class="col-md-10"><input type="text" name="search" class="form-control"
                                    value="<?php echo $_GET['search'] ?? ''; ?>"
                                    placeholder="Search by Company or Phone..."></div>
                            <div class="col-md-2"><button type="submit"
                                    class="btn btn-primary w-100 shadow-sm">Filter</button></div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Stats Cards -->
            <div class="row g-3 mb-4" style="display: none;">
                <div class="col-xl-2 col-md-4 col-6">
                    <div class="card border-0 shadow-sm border-start border-primary border-3">
                        <div class="card-body p-3">
                            <div class="d-flex align-items-center">
                                <div class="avatar avatar-sm bg-soft-primary text-primary me-2"><i class="ti ti-shield"></i>
                                </div>
                                <div>
                                    <h5 class="mb-0 fw-bold"><?php echo $stats['total']; ?></h5><small
                                        class="text-muted text-uppercase" style="font-size: 10px;">Total Plans</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-2 col-md-4 col-6">
                    <div class="card border-0 shadow-sm border-start border-info border-3">
                        <div class="card-body p-3">
                            <div class="d-flex align-items-center">
                                <div class="avatar avatar-sm bg-soft-info text-info me-2"><i class="ti ti-file-text"></i>
                                </div>
                                <div>
                                    <h5 class="mb-0 fw-bold"><?php echo $stats['planning']; ?></h5><small
                                        class="text-muted text-uppercase" style="font-size: 10px;">In Planning</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-2 col-md-4 col-6">
                    <div class="card border-0 shadow-sm border-start border-warning border-3">
                        <div class="card-body p-3">
                            <div class="d-flex align-items-center">
                                <div class="avatar avatar-sm bg-soft-warning text-warning me-2"><i
                                        class="ti ti-trending-up"></i></div>
                                <div>
                                    <h5 class="mb-0 fw-bold"><?php echo $stats['submitted']; ?></h5><small
                                        class="text-muted text-uppercase" style="font-size: 10px;">Submitted</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-2 col-md-4 col-6">
                    <div class="card border-0 shadow-sm border-start border-success border-3">
                        <div class="card-body p-3">
                            <div class="d-flex align-items-center">
                                <div class="avatar avatar-sm bg-soft-success text-success me-2"><i class="ti ti-check"></i>
                                </div>
                                <div>
                                    <h5 class="mb-0 fw-bold"><?php echo $stats['approved']; ?></h5><small
                                        class="text-muted text-uppercase" style="font-size: 10px;">Approved</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-2 col-md-4 col-6">
                    <div class="card border-0 shadow-sm border-start border-danger border-3">
                        <div class="card-body p-3">
                            <div class="d-flex align-items-center">
                                <div class="avatar avatar-sm bg-soft-danger text-danger me-2"><i
                                        class="ti ti-alert-circle"></i></div>
                                <div>
                                    <h5 class="mb-0 fw-bold"><?php echo $stats['rejected']; ?></h5><small
                                        class="text-muted text-uppercase" style="font-size: 10px;">Rejected</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-2 col-md-4 col-6">
                    <div class="card border-0 shadow-sm border-start border-warning border-3">
                        <div class="card-body p-3">
                            <div class="d-flex align-items-center">
                                <div class="avatar avatar-sm bg-soft-warning text-warning me-2"><i
                                        class="ti ti-calendar"></i></div>
                                <div>
                                    <h5 class="mb-0 fw-bold"><?php echo $stats['recent']; ?></h5><small
                                        class="text-muted text-uppercase" style="font-size: 10px;">Recent (30 Days)</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card border-0 shadow-sm">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th class="ps-4">Sr No.</th>
                                    <th>Company Details</th>
                                    <th>Plan Status</th>
                                    <th>Inward Letter</th>
                                    <th>Assigned Date</th>
                                    <th>Submitted Date</th>
                                    <th class="text-end pe-4">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (empty($list_data)): ?>
                                    <tr>
                                        <td colspan="6" class="text-center py-5 text-muted">No plan records found.</td>
                                    </tr>
                                <?php else: ?>
                                    <?php $sr = 1;
                                    foreach ($list_data as $row): ?>
                                        <tr>
                                            <td class="ps-4"><?php echo $sr++; ?></td>
                                            <td>
                                                <div class="p-2">
                                                    <div class="mb-1"><span class="fw-bold">Name:</span>
                                                        <?php echo $row->company_name; ?></div>
                                                    <div class="mb-1 small"><span class="fw-bold">Address:</span>
                                                        <?php echo $row->address; ?></div>
                                                    <div class="mb-1 small"><span class="fw-bold">Email:</span>
                                                        <?php echo $row->email; ?></div>
                                                    <div class="small"><span class="fw-bold">Phone:</span>
                                                        <?php echo $row->phone; ?></div>
                                                </div>
                                            </td>
                                            <span
                                                class="badge <?php echo $statusClass; ?> border px-3 py-2"><?php echo $row->status; ?></span>
                                            </td>
                                            <td>
                                                <?php if (!empty($row->inward_letter)): ?>
                                                    <a href="uploads/plans/<?php echo $row->inward_letter; ?>" target="_blank"
                                                        class="btn btn-soft-primary btn-sm"><i class="ti ti-file-download"></i> View</a>
                                                <?php else: ?>
                                                    <span class="text-muted">No File</span>
                                                <?php endif; ?>
                                            </td>
                                            <td><i
                                                    class="ti ti-calendar me-1"></i><?php echo !empty($row->assigned_date) ? date('d/m/Y', strtotime($row->assigned_date)) : '-'; ?>
                                            </td>
                                            <td><i
                                                    class="ti ti-calendar me-1"></i><?php echo !empty($row->submitted_date) ? date('d/m/Y', strtotime($row->submitted_date)) : '-'; ?>
                                            </td>
                                            <td class="text-end pe-4">
                                                <div class="dropdown dropdown-action">
                                                    <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown"><i
                                                            class="ti ti-dots-vertical"></i></a>
                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        <a class="dropdown-item py-2"
                                                            href="plan_management.php?mode=edit&id=<?php echo $row->id; ?>"><i
                                                                class="ti ti-edit me-2"></i> Edit</a>
                                                        <a class="dropdown-item py-2 text-danger"
                                                            href="plan_management.php?mode=delete&id=<?php echo $row->id; ?>"
                                                            onclick="return confirm('Delete?')"><i class="ti ti-trash me-2"></i>
                                                            Delete</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        <?php elseif ($mode == 'add' || $mode == 'edit'): ?>
            <div class="form-header-bar">
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="advisory_dashboard.php">Home</a></li>
                        <li class="breadcrumb-item"><a href="plan_management.php">Plan Management</a></li>
                        <li class="breadcrumb-item active"><?php echo $mode == 'add' ? 'Add New Plan' : 'Edit Plan'; ?></li>
                    </ol>
                </nav>
                <a href="plan_management.php" class="btn-back-standard">
                    <i class="ti ti-chevrons-left"></i> Back
                </a>
            </div>

            <form action="plan_management.php" method="POST" class="needs-validation" enctype="multipart/form-data"
                novalidate>
                <input type="hidden" name="mode" value="<?php echo $mode; ?>">
                <input type="hidden" name="id" value="<?php echo $id; ?>">

                <div class="form-card-standard">
                    <div class="row" id="formWrapper">
                        <div class="col-xl-8 border-end pe-xl-4">
                            <h5 class="card-title mt-0 mb-4 text-primary fw-bold">Plan Configuration</h5>
                            <div class="row g-4">
                                <div class="col-md-6">
                                    <label class="form-label">Company Name <span class="text-danger">*</span></label>
                                    <input type="text" name="company_name" class="form-control"
                                        value="<?php echo $data->company_name ?? ''; ?>" placeholder="Enter Company Name"
                                        required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Phone Number</label>
                                    <input type="text" name="phone" class="form-control"
                                        value="<?php echo $data->phone ?? ''; ?>" placeholder="10 Digit Mobile">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Email Address</label>
                                    <input type="email" name="email" class="form-control"
                                        value="<?php echo $data->email ?? ''; ?>" placeholder="email@example.com">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Assigned Date</label>
                                    <input type="date" name="assigned_date" class="form-control"
                                        value="<?php echo $data->assigned_date ?? ''; ?>">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Submitted Date</label>
                                    <input type="date" name="submitted_date" class="form-control"
                                        value="<?php echo $data->submitted_date ?? ''; ?>">
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label">Inward Letter Attachment</label>
                                    <input type="file" name="inward_letter" class="form-control">
                                    <?php if (!empty($data->inward_letter)): ?>
                                        <div class="mt-2 small text-muted">Current: <a
                                                href="uploads/plans/<?php echo $data->inward_letter; ?>"
                                                target="_blank"><?php echo $data->inward_letter; ?></a></div>
                                    <?php endif; ?>
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label">Address</label>
                                    <textarea name="address" class="form-control" rows="3"
                                        placeholder="Full Industrial Address"><?php echo $data->address ?? ''; ?></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-4 ps-xl-4">
                            <h5 class="card-title mt-0 mb-4 text-primary fw-bold">Status Settings</h5>
                            <div class="mb-4">
                                <label class="form-label fw-bold">Current Status</label>
                                <select name="status" class="form-select select2-no-search">
                                    <option value="Plan" <?php echo ($data && $data->status == 'Plan') ? 'selected' : ''; ?>>
                                        Planning</option>
                                    <option value="Submit" <?php echo ($data && $data->status == 'Submit') ? 'selected' : ''; ?>>Submitted</option>
                                    <option value="Approved" <?php echo ($data && $data->status == 'Approved') ? 'selected' : ''; ?>>Approved</option>
                                    <option value="Rejected" <?php echo ($data && $data->status == 'Rejected') ? 'selected' : ''; ?>>Rejected</option>
                                </select>
                            </div>
                            <div class="bg-light p-3 rounded-3 mt-4 border-start border-primary border-3">
                                <p class="text-muted small mb-0"><i class="ti ti-info-circle me-1"></i> Ensure all dates and
                                    contact info are accurate for plan approvals.</p>
                            </div>
                        </div>
                    </div>

                    <div class="form-action-btns mt-4 pt-4 border-top">
                        <button type="submit" name="btn_submit" class="btn-submit-standard">
                            <i class="ti ti-device-floppy me-2"></i> Save Plan Info
                        </button>
                        <a href="plan_management.php" class="btn-cancel-standard">
                            Cancel
                        </a>
                    </div>
                </div>
            </form>
        <?php endif; ?>

    </div>
</div>

<?php include 'includes/footer.php'; ?>
