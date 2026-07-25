<?php
include 'root/config.php';
$ai_core->aiCheckLogin();

// --- CONFIGURATION ---
$page_nm = "User Role Work Log";
$table = "tbl_work_logs";
$redirection_url = "user_role_work_log.php";

// --- AJAX FETCH HANDLER ---
if (isset($_POST['ajax_fetch'])) {
    $where = " WHERE 1=1";
    $search = $_POST['search'] ?? '';
    $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
    $limit = 10;
    $offset = ($page - 1) * $limit;

    if (!empty($search)) {
        $where .= " AND (actor LIKE '%$search%' OR action LIKE '%$search%' OR target_user LIKE '%$search%')";
    }

    $total_res = $ai_db->aiGetQueryObj("SELECT COUNT(*) as total FROM $table $where");
    $total_records = $total_res[0]->total;
    $total_pages = ceil($total_records / $limit);

    $sql = "SELECT * FROM $table $where ORDER BY id DESC LIMIT $limit OFFSET $offset";
    $list_data = $ai_db->aiGetQueryObj($sql);

    ob_start();
    if (empty($list_data)) {
        echo '<tr><td colspan="5" class="text-center py-5 text-muted">No activity logs found.</td></tr>';
    } else {
        foreach ($list_data as $row) {
            ?>
            <tr>
                <td class="ps-4">#<?php echo $row->id; ?></td>
                <td><span class="fw-bold text-dark"><?php echo $row->actor; ?></span></td>
                <td><span class="text-secondary"><?php echo $row->action; ?></span></td>
                <td><span class="text-muted small">Loading...</span></td>
                <td class="pe-4"><span class="fw-medium text-dark"><?php echo $row->target_user; ?></span></td>
            </tr>
            <?php
        }
    }
    $table_html = ob_get_clean();

    // Pagination
    ob_start();
    ?>
    <div class="d-flex justify-content-between align-items-center">
        <div class="small text-muted">Showing <?php echo $offset + 1; ?> to <?php echo min($offset + $limit, $total_records); ?> of <?php echo $total_records; ?> entries</div>
        <nav>
            <ul class="pagination pagination-sm justify-content-end mb-0">
                <li class="page-item <?php echo $page <= 1 ? 'disabled' : ''; ?>"><a class="page-link" href="javascript:void(0)" onclick="loadData(1)">First</a></li>
                <li class="page-item <?php echo $page <= 1 ? 'disabled' : ''; ?>"><a class="page-link" href="javascript:void(0)" onclick="loadData(<?php echo $page - 1; ?>)"><i class="ti ti-chevron-left"></i></a></li>
                <?php for ($i = max(1, $page - 2); $i <= min($total_pages, $page + 2); $i++): ?>
                    <li class="page-item <?php echo $i == $page ? 'active' : ''; ?>"><a class="page-link" href="javascript:void(0)" onclick="loadData(<?php echo $i; ?>)"><?php echo $i; ?></a></li>
                <?php endfor; ?>
                <li class="page-item <?php echo $page >= $total_pages ? 'disabled' : ''; ?>"><a class="page-link" href="javascript:void(0)" onclick="loadData(<?php echo $page + 1; ?>)"><i class="ti ti-chevron-right"></i></a></li>
                <li class="page-item <?php echo $page >= $total_pages ? 'disabled' : ''; ?>"><a class="page-link" href="javascript:void(0)" onclick="loadData(<?php echo $total_pages; ?>)">Last</a></li>
            </ul>
        </nav>
    </div>
    <?php
    $pagination_html = ob_get_clean();

    echo json_encode(['status' => 'success', 'table' => $table_html, 'pagination' => $pagination_html]);
    exit;
}

include 'includes/header.php';
include 'includes/sidebar.php';

$limit = 10;
$total_res = $ai_db->aiGetQueryObj("SELECT COUNT(*) as total FROM $table");
$total_records = $total_res[0]->total;
$total_pages = ceil($total_records / $limit);
$list_data = $ai_db->aiGetQueryObj("SELECT * FROM $table ORDER BY id DESC LIMIT $limit");
?>

<div class="page-wrapper">
    <div class="content">
        
        <div class="d-md-flex d-block align-items-center justify-content-between mb-4">
            <div class="my-auto mb-2">
                <h3 class="page-title mb-1"><?php echo $page_nm; ?></h3>
                <p class="text-muted small mb-0">Track all user role-related activities and changes</p>
            </div>
            <div class="mb-2">
                <button class="btn btn-soft-primary d-flex align-items-center shadow-sm" type="button" data-bs-toggle="collapse" data-bs-target="#filterCollapse" aria-expanded="false">
                    <i class="ti ti-filter me-2"></i>Filter
                </button>
            </div>
        </div>

        <!-- Filters Section (Collapsible) -->
        <div class="collapse mb-4" id="filterCollapse">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-3">
                    <div class="input-icon-start position-relative">
                        <span class="input-icon-addon ps-3"><i class="ti ti-search"></i></span>
                        <input type="text" id="searchInput" class="form-control ps-5" placeholder="Search by actor, action or target...">
                    </div>
                </div>
            </div>
        </div>

        <div class="card border-0 shadow-sm">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light text-muted">
                            <tr>
                                <th class="ps-4" style="width: 80px;">ID</th>
                                <th>Actor</th>
                                <th>Action</th>
                                <th>Details</th>
                                <th class="pe-4">Target User</th>
                            </tr>
                        </thead>
                        <tbody id="tableBody">
                            <?php if(empty($list_data)): ?>
                                <tr><td colspan="5" class="text-center py-5 text-muted">No activity logs found.</td></tr>
                            <?php else: ?>
                                <?php foreach($list_data as $row): ?>
                                <tr>
                                    <td class="ps-4">#<?php echo $row->id; ?></td>
                                    <td><span class="fw-bold text-dark"><?php echo $row->actor; ?></span></td>
                                    <td><span class="text-secondary"><?php echo $row->action; ?></span></td>
                                    <td><span class="text-muted small">Loading...</span></td>
                                    <td class="pe-4"><span class="fw-medium text-dark"><?php echo $row->target_user; ?></span></td>
                                </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
                <div class="card-footer bg-white border-top-0 p-3" id="paginationContainer">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="small text-muted">Showing 1 to <?php echo count($list_data); ?> of <?php echo $total_records; ?> entries</div>
                        <nav>
                            <ul class="pagination pagination-sm justify-content-end mb-0">
                                <li class="page-item disabled"><a class="page-link" href="#">First</a></li>
                                <li class="page-item disabled"><a class="page-link" href="#"><i class="ti ti-chevron-left"></i></a></li>
                                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                <?php if($total_pages > 1): ?>
                                    <li class="page-item"><a class="page-link" href="javascript:void(0)" onclick="loadData(2)">2</a></li>
                                <?php endif; ?>
                                <li class="page-item <?php echo $total_pages <= 1 ? 'disabled' : ''; ?>"><a class="page-link" href="javascript:void(0)" onclick="loadData(2)"><i class="ti ti-chevron-right"></i></a></li>
                                <li class="page-item <?php echo $total_pages <= 1 ? 'disabled' : ''; ?>"><a class="page-link" href="javascript:void(0)" onclick="loadData(<?php echo $total_pages; ?>)">Last</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<script>
function loadData(page = 1) {
    const search = document.getElementById('searchInput').value;
    const formData = new FormData();
    formData.append('ajax_fetch', '1');
    formData.append('search', search);
    formData.append('page', page);

    fetch('user_role_work_log.php', {
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

let timeout = null;
document.getElementById('searchInput')?.addEventListener('keyup', function() {
    clearTimeout(timeout);
    timeout = setTimeout(() => { loadData(1); }, 500);
});
</script>

<style>
#searchInput::placeholder { color: rgba(255,255,255,0.6); }
#searchInput:focus { background: #000 !important; outline: none; box-shadow: 0 0 10px rgba(0,0,0,0.2); }
</style>

<?php include 'includes/footer.php'; ?>
