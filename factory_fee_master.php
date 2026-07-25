<?php
include 'root/config.php';
$ai_core->aiCheckLogin();
include 'includes/header.php';
include 'includes/sidebar.php';

// --- CONFIGURATION ---
$page_nm = "Factory Act Fee Master";
$table = "tbl_factory_fee_master";
$redirection_url = "factory_fee_master.php";

$mode = $_REQUEST['mode'] ?? 'list';
$view_type = $_GET['view'] ?? 'matrix'; // Default to matrix view
$id = isset($_REQUEST['id']) ? intval($_REQUEST['id']) : 0;
$data = null;

// --- HANDLE POST ACTIONS ---
if (isset($_POST['btn_submit'])) {
    $hp_range = addslashes($_POST['hp_range']);
    $worker_range = addslashes($_POST['worker_range']);
    $fee = floatval($_POST['fee']);

    if ($mode === "add") {
        $sql = "INSERT INTO $table SET hp_range='$hp_range', worker_range='$worker_range', fee='$fee'";
        $msg = 1;
    } else {
        $sql = "UPDATE $table SET hp_range='$hp_range', worker_range='$worker_range', fee='$fee' WHERE id='$id'";
        $msg = 2;
    }

    $ai_db->aiQuery($sql);
    $ai_core->aiGoPage($redirection_url . "?msg=$msg&view=$view_type");
}

// --- HANDLE DELETE ---
if ($mode === "delete" && $id) {
    $ai_db->aiQuery("DELETE FROM $table WHERE id='$id'");
    $ai_core->aiGoPage($redirection_url . "?msg=3&view=$view_type");
}

// --- FETCH LIST DATA ---
$all_data = $ai_db->aiGetQueryObj("SELECT * FROM $table ORDER BY id ASC");
$total_entries = count($all_data);
$max_fee = 0;
$min_fee = $total_entries > 0 ? (float) $all_data[0]->fee : 0;

$hp_ranges = [];
$worker_ranges = [];
$matrix = [];

foreach ($all_data as $row) {
    if (!in_array($row->hp_range, $hp_ranges))
        $hp_ranges[] = $row->hp_range;
    if (!in_array($row->worker_range, $worker_ranges))
        $worker_ranges[] = $row->worker_range;
    $matrix[$row->hp_range][$row->worker_range] = $row;

    if ((float) $row->fee > $max_fee)
        $max_fee = (float) $row->fee;
    if ((float) $row->fee < $min_fee)
        $min_fee = (float) $row->fee;
}

// Pagination logic for List View
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$limit = 20;
$offset = ($page - 1) * $limit;
$search_hp = $_GET['search_hp'] ?? '';
$search_workers = $_GET['search_workers'] ?? '';

$where = " WHERE 1=1";
if (!empty($search_hp))
    $where .= " AND hp_range LIKE '%$search_hp%'";
if (!empty($search_workers))
    $where .= " AND worker_range LIKE '%$search_workers%'";

$total_res = $ai_db->aiGetQueryObj("SELECT COUNT(*) as total FROM $table $where");
$total_records = $total_res[0]->total;
$total_pages = ceil($total_records / $limit);
$list_data = $ai_db->aiGetQueryObj("SELECT * FROM $table $where ORDER BY id ASC LIMIT $limit OFFSET $offset");

// --- FETCH DATA FOR EDIT ---
if (($mode === "edit") && $id && !isset($_POST['btn_submit'])) {
    $result = $ai_db->aiGetQueryObj("SELECT * FROM $table WHERE id='$id' LIMIT 1");
    $data = $result[0] ?? null;
}
?>

<style>
    .stat-card {
        transition: all 0.3s ease;
        border-radius: 16px;
        overflow: hidden;
    }

    .stat-card:hover {
        transform: translateY(-5px);
    }

    .fee-matrix-container {
        border-radius: 20px;
        background: #1e293b;
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
        overflow: hidden;
        border: 1px solid rgba(255, 255, 255, 0.05);
    }

    .matrix-table th {
        background: rgba(15, 23, 42, 0.4);
        font-weight: 700;
        font-size: 11px;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: #94a3b8;
        border-bottom: 2px solid rgba(255, 255, 255, 0.05) !important;
        padding: 18px 15px !important;
    }

    .matrix-table td {
        padding: 15px;
        border-right: 1px solid rgba(255, 255, 255, 0.02);
        border-bottom: 1px solid rgba(255, 255, 255, 0.02);
        transition: background 0.2s;
        color: #cbd5e1;
    }

    .matrix-table tr:last-child td {
        border-bottom: none !important;
    }

    .matrix-table tr:hover td {
        background-color: rgba(255, 255, 255, 0.02);
    }

    .hp-cell {
        background: #1e293b !important;
        font-weight: 800;
        color: #fff;
        position: sticky;
        left: 0;
        z-index: 10;
        border-right: 2px solid rgba(255, 255, 255, 0.1) !important;
    }

    .fee-badge {
        font-weight: 700;
        font-size: 13px;
        padding: 8px 12px;
        border-radius: 10px;
        display: inline-block;
        min-width: 80px;
        text-align: center;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        border: 1px solid transparent;
    }

    .fee-badge:hover {
        background: #1e3a8a !important;
        color: #fff !important;
        transform: scale(1.1) translateY(-2px);
        box-shadow: 0 10px 15px -3px rgba(30, 58, 138, 0.3);
        cursor: pointer;
    }

    .view-toggle {
        background: rgba(241, 245, 249, 0.1);
        padding: 5px;
        border-radius: 12px;
        display: inline-flex;
        border: 1px solid rgba(255, 255, 255, 0.1);
    }

    .view-toggle .btn {
        padding: 8px 20px;
        border-radius: 10px;
        border: none;
        font-weight: 600;
        font-size: 14px;
        color: #94a3b8;
        transition: all 0.3s;
    }

    .view-toggle .btn.active {
        background: #fff;
        color: #1e3a8a;
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
    }

    .form-card {
        background: #1e293b;
        border: 1px solid rgba(255, 255, 255, 0.05);
        border-radius: 24px;
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
    }

    .form-control-premium {
        background: rgba(15, 23, 42, 0.5) !important;
        border: 1px solid rgba(255, 255, 255, 0.1) !important;
        color: #fff !important;
        padding: 14px 18px;
        border-radius: 14px;
        transition: all 0.3s;
    }

    .form-control-premium:focus {
        border-color: #3b82f6 !important;
        box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.1) !important;
    }

    .input-group-premium {
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 14px;
        background: rgba(15, 23, 42, 0.5);
        overflow: hidden;
    }

    .input-group-premium .input-group-text {
        background: transparent;
        border: none;
        color: #3b82f6;
        padding-left: 18px;
    }

    .input-group-premium .form-control {
        background: transparent;
        border: none;
        color: #fff;
        padding: 14px 18px;
    }
</style>

<div class="page-wrapper">
    <div class="content">

        <?php if ($mode == 'list'): ?>
            <!-- Header Section -->
            <div class="d-md-flex d-block align-items-center justify-content-between mb-4">
                <div class="my-auto mb-2">
                    <h3 class="page-title mb-1 fw-bold"><?php echo $page_nm; ?></h3>
                    <p class="text-muted small mb-0"><i class="ti ti-info-circle me-1"></i>Manage dynamic fee slabs for
                        workers and HP ranges</p>
                </div>
                <div class="mb-2 d-flex gap-3 align-items-center">
                    <div class="view-toggle">
                        <a href="?view=matrix" class="btn <?php echo $view_type == 'matrix' ? 'active' : ''; ?>">
                            <i class="ti ti-layout-grid me-1"></i> Matrix View
                        </a>
                        <a href="?view=list" class="btn <?php echo $view_type == 'list' ? 'active' : ''; ?>">
                            <i class="ti ti-list me-1"></i> List View
                        </a>
                    </div>
                    <a href="factory_fee_master.php?mode=add&view=<?php echo $view_type; ?>"
                        class="btn btn-primary d-flex align-items-center shadow-sm py-2 px-3 rounded-pill">
                        <i class="ti ti-plus me-2"></i>New Fee Entry
                    </a>
                </div>
            </div>

            <!-- Summary Cards -->
            <div class="row mb-4">
                <div class="col-md-3">
                    <div class="card stat-card border-0 shadow-sm bg-primary text-white">
                        <div class="card-body p-4">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="mb-1 opacity-75">Total Slabs</h6>
                                    <h2 class="mb-0 fw-bold"><?php echo $total_entries; ?></h2>
                                </div>
                                <div class="bg-soft-light p-3 rounded-3">
                                    <i class="ti ti-table fs-32"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card stat-card border-0 shadow-sm">
                        <div class="card-body p-4 border-start border-4 border-info">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="text-muted mb-1">HP Ranges</h6>
                                    <h2 class="mb-0 fw-bold"><?php echo count($hp_ranges); ?></h2>
                                </div>
                                <div class="bg-soft-info p-3 rounded-3 text-info">
                                    <i class="ti ti-bolt fs-32"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card stat-card border-0 shadow-sm">
                        <div class="card-body p-4 border-start border-4 border-success">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="text-muted mb-1">Worker Ranges</h6>
                                    <h2 class="mb-0 fw-bold"><?php echo count($worker_ranges); ?></h2>
                                </div>
                                <div class="bg-soft-success p-3 rounded-3 text-success">
                                    <i class="ti ti-users fs-32"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card stat-card border-0 shadow-sm">
                        <div class="card-body p-4 border-start border-4 border-warning">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="text-muted mb-1">Max Fee</h6>
                                    <h2 class="mb-0 fw-bold">₹<?php echo number_format($max_fee); ?></h2>
                                </div>
                                <div class="bg-soft-warning p-3 rounded-3 text-warning">
                                    <i class="ti ti-currency-rupee fs-32"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <?php if ($view_type == 'matrix'): ?>
                <!-- MATRIX VIEW -->
                <div class="fee-matrix-container">
                    <div class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center">
                        <h5 class="mb-0 fw-bold text-dark"><i class="ti ti-grid-pattern me-2 text-primary"></i>Fee Matrix
                            Schedule</h5>
                        <small class="text-muted">Click any fee to edit</small>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table matrix-table mb-0 text-center">
                                <thead>
                                    <tr>
                                        <th class="hp-cell text-start">HP \ Workers</th>
                                        <?php foreach ($worker_ranges as $wr): ?>
                                            <th><?php echo $wr; ?></th>
                                        <?php endforeach; ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($hp_ranges as $hp): ?>
                                        <tr>
                                            <td class="hp-cell text-start"><?php echo $hp; ?> HP</td>
                                            <?php foreach ($worker_ranges as $wr): ?>
                                                <td>
                                                    <?php if (isset($matrix[$hp][$wr])):
                                                        $item = $matrix[$hp][$wr];
                                                        ?>
                                                        <a href="?mode=edit&id=<?php echo $item->id; ?>&view=matrix"
                                                            class="text-decoration-none">
                                                            <span class="fee-badge bg-soft-primary text-primary">
                                                                ₹<?php echo number_format($item->fee); ?>
                                                            </span>
                                                        </a>
                                                    <?php else: ?>
                                                        <span class="text-muted small">-</span>
                                                    <?php endif; ?>
                                                </td>
                                            <?php endforeach; ?>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            <?php else: ?>
                <!-- LIST VIEW -->
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center">
                        <h5 class="mb-0 fw-bold text-dark"><i class="ti ti-list me-2 text-primary"></i>Detailed Fee List</h5>
                        <button class="btn btn-sm btn-soft-secondary" type="button" data-bs-toggle="collapse"
                            data-bs-target="#filterCollapse">
                            <i class="ti ti-filter"></i> Filters
                        </button>
                    </div>

                    <div class="collapse <?php echo (!empty($search_hp) || !empty($search_workers)) ? 'show' : ''; ?>"
                        id="filterCollapse">
                        <div class="p-3 bg-light border-bottom">
                            <form method="GET" class="row g-3">
                                <input type="hidden" name="mode" value="list">
                                <input type="hidden" name="view" value="list">
                                <div class="col-md-5">
                                    <input type="text" name="search_hp" class="form-control" value="<?php echo $search_hp; ?>"
                                        placeholder="HP Range...">
                                </div>
                                <div class="col-md-5">
                                    <input type="text" name="search_workers" class="form-control"
                                        value="<?php echo $search_workers; ?>" placeholder="Worker Range...">
                                </div>
                                <div class="col-md-2">
                                    <button type="submit" class="btn btn-primary w-100">Apply</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="bg-light">
                                    <tr>
                                        <th class="ps-4">Sr No.</th>
                                        <th>HP Range</th>
                                        <th>Worker Range</th>
                                        <th>Fee Amount</th>
                                        <th class="text-end pe-4">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    foreach ($list_data as $row):
                                        $sn = $offset + $i++;
                                        ?>
                                        <tr>
                                            <td class="ps-4 text-muted">#<?php echo str_pad($sn, 2, '0', STR_PAD_LEFT); ?></td>
                                            <td class="fw-bold"><?php echo $row->hp_range; ?> HP</td>
                                            <td><span
                                                    class="badge bg-soft-info text-info rounded-pill px-3"><?php echo $row->worker_range; ?></span>
                                            </td>
                                            <td>
                                                <h6 class="mb-0 fw-bold text-primary">₹<?php echo number_format($row->fee, 2); ?>
                                                </h6>
                                            </td>
                                            <td class="text-end pe-4">
                                                <a href="?mode=edit&id=<?php echo $row->id; ?>&view=list"
                                                    class="btn btn-sm btn-icon btn-soft-info rounded-circle me-1"><i
                                                        class="ti ti-edit"></i></a>
                                                <a href="?mode=delete&id=<?php echo $row->id; ?>&view=list"
                                                    class="btn btn-sm btn-icon btn-soft-danger rounded-circle"
                                                    onclick="return confirm('Delete?')"><i class="ti ti-trash"></i></a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <?php if ($total_pages > 1): ?>
                        <div class="card-footer bg-white border-top-0 p-3">
                            <nav><?php /* Pagination logic */ ?></nav>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endif; ?>

        <?php elseif ($mode == 'add' || $mode == 'edit'): ?>
            <div class="row justify-content-center mt-5">
                <div class="col-md-7">
                    <div class="form-card">
                        <div class="card-body p-5">
                            <form action="factory_fee_master.php" method="POST">
                                <input type="hidden" name="mode" value="<?php echo $mode; ?>">
                                <input type="hidden" name="id" value="<?php echo $id; ?>">
                                <input type="hidden" name="view" value="<?php echo $view_type; ?>">

                                <div class="mb-4">
                                    <label class="form-label fw-bold text-white opacity-75 mb-2">Horse Power Range <span
                                            class="text-danger">*</span></label>
                                    <div class="input-group-premium d-flex align-items-center">
                                        <span class="input-group-text"><i class="ti ti-bolt"></i></span>
                                        <select name="hp_range" class="form-control" required>
                                            <option value="">Select or type HP range...</option>
                                            <?php foreach ($hp_ranges as $hp): ?>
                                                <option value="<?php echo $hp; ?>" <?php echo (isset($data->hp_range) && $data->hp_range == $hp) ? 'selected' : ''; ?>><?php echo $hp; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <small class="text-muted mt-2 d-block px-2">Choose an existing range or manually enter
                                        in list view</small>
                                </div>

                                <div class="mb-4">
                                    <label class="form-label fw-bold text-white opacity-75 mb-2">Number of Workers <span
                                            class="text-danger">*</span></label>
                                    <div class="input-group-premium d-flex align-items-center">
                                        <span class="input-group-text"><i class="ti ti-users"></i></span>
                                        <select name="worker_range" class="form-control" required>
                                            <option value="">Select worker range...</option>
                                            <?php foreach ($worker_ranges as $wr): ?>
                                                <option value="<?php echo $wr; ?>" <?php echo (isset($data->worker_range) && $data->worker_range == $wr) ? 'selected' : ''; ?>><?php echo $wr; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <label class="form-label fw-bold text-white opacity-75 mb-2">Base Fee Amount (INR) <span
                                            class="text-danger">*</span></label>
                                    <div class="input-group-premium d-flex align-items-center"
                                        style="border-left: 4px solid #3b82f6;">
                                        <span class="input-group-text fw-bold">₹</span>
                                        <input type="number" step="0.01" name="fee"
                                            class="form-control fs-18 fw-bold text-info"
                                            value="<?php echo $data->fee ?? ''; ?>" placeholder="0.00" required>
                                    </div>
                                </div>

                                <div class="pt-4">
                                    <button type="submit" name="btn_submit"
                                        class="btn btn-primary w-100 py-3 rounded-pill fw-bold shadow-lg">
                                        <i
                                            class="ti ti-check-double me-2"></i><?php echo $mode == 'add' ? 'Create Pricing Slab' : 'Save & Update Pricing'; ?>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>

    </div>
</div>

<?php include 'includes/footer.php'; ?>