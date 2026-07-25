<?php
include 'root/config.php';
$ai_core->aiCheckLogin();

// --- CONFIGURATION ---
$page_nm = "Renewal Log History";
$table = "tbl_renewal_logs";
$redirection_url = "renewal_log.php";

// --- AJAX FETCH HANDLER ---
if (isset($_POST['ajax_fetch'])) {
    $where = " WHERE 1=1";
    $status_filter = $_POST['status_filter'] ?? '';
    $policy_filter = $_POST['policy_filter'] ?? '';
    $reminder_filter = $_POST['reminder_filter'] ?? '';
    
    $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
    $limit = 10;
    $offset = ($page - 1) * $limit;

    if (!empty($status_filter)) $where .= " AND status = '$status_filter'";
    if (!empty($policy_filter)) $where .= " AND policy_type = '$policy_filter'";
    if (!empty($reminder_filter)) $where .= " AND reminder_type = '$reminder_filter'";

    $total_res = $ai_db->aiGetQueryObj("SELECT COUNT(*) as total FROM $table $where");
    $total_records = $total_res[0]->total;
    $total_pages = ceil($total_records / $limit);

    $sql = "SELECT * FROM $table $where ORDER BY id DESC LIMIT $limit OFFSET $offset";
    $list_data = $ai_db->aiGetQueryObj($sql);

    ob_start();
    if (empty($list_data)) {
        echo '<tr><td colspan="6" class="text-center py-5 text-muted">No renewal logs found.</td></tr>';
    } else {
        foreach ($list_data as $row) {
            $diff = strtotime($row->expiry_date) - time();
            $days_left = round($diff / (60 * 60 * 24));
            ?>
            <tr>
                <td class="ps-4">
                    <span class="fw-bold d-block text-dark"><?php echo $row->policy_type; ?></span>
                    <small class="text-muted"><?php echo $row->policy_type; ?> Status Updat...</small>
                </td>
                <td>
                    <span class="fw-bold d-block text-dark"><?php echo $row->client_name; ?></span>
                    <small class="text-primary text-decoration-underline"><?php echo $row->client_email; ?></small>
                </td>
                <td>
                    <span class="badge bg-soft-primary text-primary px-2"><i class="ti ti-mail me-1"></i><?php echo $row->reminder_type; ?></span>
                </td>
                <td>
                    <span class="badge <?php echo $row->status == 'Successful' ? 'bg-soft-success text-success' : 'bg-soft-danger text-danger'; ?> px-3 rounded-pill">
                        <?php echo $row->status; ?>
                    </span>
                </td>
                <td>
                    <span class="text-dark fw-medium"><?php echo date('j M Y, h:i', strtotime($row->sent_date)); ?></span>
                    <small class="text-muted d-block text-lowercase"><?php echo date('a', strtotime($row->sent_date)); ?></small>
                </td>
                <td class="text-end pe-4">
                    <button class="btn btn-soft-info btn-sm px-3 rounded shadow-sm fw-bold">STATUS UPDATE</button>
                </td>
            </tr>
            <?php
        }
    }
    $table_html = ob_get_clean();

    // Pagination
    ob_start();
    ?>
    <nav>
        <ul class="pagination pagination-sm justify-content-center gap-1 mb-0">
            <li class="page-item"><a class="page-link rounded" href="javascript:void(0)" onclick="loadData(1)">First</a></li>
            <li class="page-item <?php echo $page <= 1 ? 'disabled' : ''; ?>"><a class="page-link rounded" href="javascript:void(0)" onclick="loadData(<?php echo $page - 1; ?>)"><i class="ti ti-chevron-left"></i></a></li>
            <li class="page-item active"><a class="page-link rounded" href="javascript:void(0)"><?php echo $page; ?></a></li>
            <li class="page-item <?php echo $page >= $total_pages ? 'disabled' : ''; ?>"><a class="page-link rounded" href="javascript:void(0)" onclick="loadData(<?php echo $page + 1; ?>)"><i class="ti ti-chevron-right"></i></a></li>
            <li class="page-item"><a class="page-link rounded" href="javascript:void(0)" onclick="loadData(<?php echo $total_pages; ?>)">Last</a></li>
        </ul>
    </nav>
    <?php
    $pagination_html = ob_get_clean();

    echo json_encode(['status' => 'success', 'table' => $table_html, 'pagination' => $pagination_html]);
    exit;
}

include 'includes/header.php';
include 'includes/sidebar.php';

// Initial Stats and List Data
$stats = [
    'total' => count($ai_db->aiGetQueryObj("SELECT id FROM $table")),
    'successful' => count($ai_db->aiGetQueryObj("SELECT id FROM $table WHERE status='Successful'")),
    'failed' => count($ai_db->aiGetQueryObj("SELECT id FROM $table WHERE status='Failed'")),
    'engaged' => count($ai_db->aiGetQueryObj("SELECT id FROM $table WHERE status='Engaged'"))
];

$limit = 10;
$total_res = $ai_db->aiGetQueryObj("SELECT COUNT(*) as total FROM $table");
$total_records = $total_res[0]->total;
$total_pages = ceil($total_records / $limit);
$list_data = $ai_db->aiGetQueryObj("SELECT * FROM $table ORDER BY id DESC LIMIT $limit");
?>

<div class="page-wrapper">
    <div class="content">
        
        <div class="mb-4">
            <div class="d-md-flex d-block align-items-center justify-content-between mb-2">
                <div class="d-flex align-items-center">
                    <span class="fs-24 me-2">📋</span>
                    <h3 class="page-title mb-0"><?php echo $page_nm; ?></h3>
                </div>
                <div class="mt-2 mt-md-0">
                    <button class="btn btn-soft-primary d-flex align-items-center shadow-sm" type="button" data-bs-toggle="collapse" data-bs-target="#filterCollapse" aria-expanded="false">
                        <i class="ti ti-filter me-2"></i>Filter
                    </button>
                </div>
            </div>
            <p class="text-muted mb-1">Complete history of all renewal reminders sent automatically</p>
            <div class="d-flex align-items-center gap-3">
                <small class="text-danger"><i class="ti ti-alarm me-1"></i>Automatic emails sent daily at 9:00 AM IST</small>
                <small class="text-warning"><i class="ti ti-lock me-1"></i>Currently Active: DSC + Labour License + Stability Certificate + Factory License (Renewal) + Factory Quotation Status + Labour Inspection</small>
            </div>
        </div>

        <!-- Filters Section (Collapsible) -->
        <div class="collapse mb-4" id="filterCollapse">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-3">
                    <form id="filterForm" class="row g-3 align-items-end">
                        <div class="col-md-3">
                            <label class="form-label small fw-bold text-muted mb-1">Status:</label>
                            <select name="status_filter" class="form-select">
                                <option value="">All Status</option>
                                <option value="Successful">Successful</option>
                                <option value="Failed">Failed</option>
                                <option value="Engaged">Engaged</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label small fw-bold text-muted mb-1">Policy Type:</label>
                            <select name="policy_filter" class="form-select">
                                <option value="">All Types</option>
                                <option value="Factory Quotation Status">Factory Quotation Status</option>
                                <option value="DSC">DSC</option>
                                <option value="Labour License">Labour License</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label small fw-bold text-muted mb-1">Reminder Type:</label>
                            <select name="reminder_filter" class="form-select">
                                <option value="">All Types</option>
                                <option value="EMAIL">EMAIL</option>
                                <option value="SMS">SMS</option>
                                <option value="WHATSAPP">WHATSAPP</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <button type="button" onclick="loadData(1)" class="btn btn-filter-standard w-100"><i class="ti ti-refresh me-1"></i> Filter</button>
                        </div>
                        <div class="col-md-2">
                            <button type="button" onclick="resetFilters()" class="btn btn-premium-reset w-100">
                                <i class="ti ti-refresh"></i> Reset
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
v>

        <!-- Stats Grid -->
        <div class="row g-3 mb-4">
            <div class="col-md-3">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body p-4 d-flex align-items-center">
                        <h2 class="mb-0 fw-bold me-3"><?php echo $stats['total']; ?></h2>
                        <small class="text-muted text-uppercase fw-bold">Total Reminders</small>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body p-4 d-flex align-items-center">
                        <h2 class="mb-0 fw-bold me-3"><?php echo $stats['successful']; ?></h2>
                        <small class="text-muted text-uppercase fw-bold">Successful</small>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body p-4 d-flex align-items-center">
                        <h2 class="mb-0 fw-bold me-3 text-danger"><?php echo $stats['failed']; ?></h2>
                        <small class="text-muted text-uppercase fw-bold">Failed</small>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body p-4 d-flex align-items-center">
                        <h2 class="mb-0 fw-bold me-3"><?php echo $stats['engaged']; ?></h2>
                        <small class="text-muted text-uppercase fw-bold">Engaged</small>
                    </div>
                </div>
            </div>
        </div>

        <div class="card border-0 shadow-sm">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light text-muted small">
                            <tr>
                                <th class="ps-4">POLICY INFO</th>
                                <th>CLIENT DETAILS</th>
                                <th>REMINDER DETAILS</th>
                                <th>STATUS</th>
                                <th>SENT DATE</th>
                                <th class="text-end pe-4">DAYS UNTIL EXPIRY</th>
                            </tr>
                        </thead>
                        <tbody id="tableBody">
                            <?php if(empty($list_data)): ?>
                                <tr><td colspan="6" class="text-center py-5 text-muted">No logs found.</td></tr>
                            <?php else: ?>
                                <?php foreach($list_data as $row): ?>
                                <tr>
                                    <td class="ps-4">
                                        <span class="fw-bold d-block text-dark"><?php echo $row->policy_type; ?></span>
                                        <small class="text-muted"><?php echo $row->policy_type; ?> Status Updat...</small>
                                    </td>
                                    <td>
                                        <span class="fw-bold d-block text-dark"><?php echo $row->client_name; ?></span>
                                        <small class="text-primary text-decoration-underline"><?php echo $row->client_email; ?></small>
                                    </td>
                                    <td>
                                        <span class="badge bg-soft-primary text-primary px-2"><i class="ti ti-mail me-1"></i><?php echo $row->reminder_type; ?></span>
                                    </td>
                                    <td>
                                        <span class="badge <?php echo $row->status == 'Successful' ? 'bg-soft-success text-success' : 'bg-soft-danger text-danger'; ?> px-3 rounded-pill">
                                            <?php echo $row->status; ?>
                                        </span>
                                    </td>
                                    <td>
                                        <span class="text-dark fw-medium"><?php echo date('j M Y, h:i', strtotime($row->sent_date)); ?></span>
                                        <small class="text-muted d-block text-lowercase"><?php echo date('a', strtotime($row->sent_date)); ?></small>
                                    </td>
                                    <td class="text-end pe-4">
                                        <button class="btn btn-soft-info btn-sm px-3 rounded shadow-sm fw-bold">STATUS UPDATE</button>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
                <div class="card-footer bg-white border-top-0 p-3" id="paginationContainer">
                    <nav>
                        <ul class="pagination pagination-sm justify-content-end mb-0">
                            <li class="page-item disabled"><a class="page-link" href="#">Previous</a></li>
                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                            <?php if($total_pages > 1): ?>
                                <li class="page-item"><a class="page-link" href="javascript:void(0)" onclick="loadData(2)">2</a></li>
                            <?php endif; ?>
                            <li class="page-item <?php echo $total_pages <= 1 ? 'disabled' : ''; ?>"><a class="page-link" href="javascript:void(0)" onclick="loadData(2)">Next</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>

    </div>
</div>

<script>
function loadData(page = 1) {
    const formData = new FormData(document.getElementById('filterForm'));
    formData.append('ajax_fetch', '1');
    formData.append('page', page);

    fetch('renewal_log.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            document.getElementById('tableBody').innerHTML = data.table;
            document.getElementById('paginationContainer').innerHTML = data.pagination;
        }
    });
}

function resetFilters() {
    document.getElementById('filterForm').reset();
    loadData(1);
}

document.getElementById('filterForm')?.addEventListener('submit', function (e) {
    e.preventDefault();
    loadData(1);
});

document.addEventListener('DOMContentLoaded', function () {
    if (document.getElementById('filterForm')) loadData(1);
});
</script>

<style>
.pagination .page-link { border: none; background: #f8f9fa; color: #6c757d; margin: 0 2px; }
.pagination .page-item.active .page-link { background: #0d6efd; color: #fff; }
.btn-soft-info { background-color: rgba(13, 202, 240, 0.1); color: #0dcaf0; border: none; }
.btn-soft-info:hover { background-color: #0dcaf0; color: #fff; }
</style>

<?php include 'includes/footer.php'; ?>
