<?php
include 'root/config.php';
$ai_core->aiCheckLogin();

// --- CONFIGURATION ---
$page_nm = "DSC Logs";
$table = "tbl_dsc_logs";
$redirection_url = "dsc_logs.php";

// --- AJAX FETCH HANDLER ---
if (isset($_POST['ajax_fetch'])) {
    $where = " WHERE 1=1";
    $search = $_POST['search'] ?? '';
    $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
    $limit = 10;
    $offset = ($page - 1) * $limit;

    if (!empty($search)) {
        $where .= " AND (performed_by LIKE '%$search%' OR certification_name LIKE '%$search%' OR action LIKE '%$search%')";
    }

    $total_res = $ai_db->aiGetQueryObj("SELECT COUNT(*) as total FROM $table $where");
    $total_records = $total_res[0]->total;
    $total_pages = ceil($total_records / $limit);

    $sql = "SELECT * FROM $table $where ORDER BY id DESC LIMIT $limit OFFSET $offset";
    $list_data = $ai_db->aiGetQueryObj($sql);

    ob_start();
    if (empty($list_data)) {
        echo '<tr><td colspan="7" class="text-center py-5 text-muted">No logs found.</td></tr>';
    } else {
        $sr = $offset + 1;
        foreach ($list_data as $row) {
            ?>
            <tr>
                <td class="ps-4"><?php echo $sr++; ?></td>
                <td><span class="text-muted fw-medium"><?php echo date('m/d/Y, h:i:s A', strtotime($row->timestamp)); ?></span></td>
                <td>
                    <?php
                    $action = $row->action;
                    $badgeClass = 'bg-soft-info text-info';
                    if (strpos($action, 'In') !== false)
                        $badgeClass = 'bg-soft-success text-success';
                    if (strpos($action, 'Out') !== false)
                        $badgeClass = 'bg-soft-warning text-warning';
                    ?>
                    <span class="badge <?php echo $badgeClass; ?> px-2 text-uppercase"><?php echo $action; ?></span>
                </td>
                <td><span class="fw-bold text-dark"><?php echo $row->performed_by; ?></span></td>
                <td><span class="fw-medium text-secondary"><?php echo $row->certification_name; ?></span></td>
                <td><span class="text-muted"><?php echo date('d/m/Y', strtotime($row->expiry_date)); ?></span></td>
                <td>
                    <?php
                    $stBadge = 'bg-soft-secondary text-dark';
                    if ($row->status == 'In')
                        $stBadge = 'bg-soft-success text-success';
                    if ($row->status == 'Out')
                        $stBadge = 'bg-soft-warning text-warning';
                    ?>
                    <span class="badge <?php echo $stBadge; ?> px-2"><?php echo $row->status; ?></span>
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
        <ul class="pagination pagination-sm justify-content-end mb-0">
            <li class="page-item <?php echo $page <= 1 ? 'disabled' : ''; ?>"><a class="page-link" href="javascript:void(0)"
                    onclick="loadData(<?php echo $page - 1; ?>)">Previous</a></li>
            <?php for ($i = 1; $i <= min(5, $total_pages); $i++): ?>
                <li class="page-item <?php echo $i == $page ? 'active' : ''; ?>"><a class="page-link" href="javascript:void(0)"
                        onclick="loadData(<?php echo $i; ?>)"><?php echo $i; ?></a></li>
            <?php endfor; ?>
            <?php if ($total_pages > 5): ?>
                <li class="page-item disabled"><span class="page-link">...</span></li>
                <li class="page-item"><a class="page-link" href="javascript:void(0)"
                        onclick="loadData(<?php echo $total_pages; ?>)"><?php echo $total_pages; ?></a></li>
            <?php endif; ?>
            <li class="page-item <?php echo $page >= $total_pages ? 'disabled' : ''; ?>"><a class="page-link"
                    href="javascript:void(0)" onclick="loadData(<?php echo $page + 1; ?>)">Next</a></li>
        </ul>
    </nav>
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
            </div>
            <div class="mb-2">
                <button class="btn btn-soft-primary d-flex align-items-center shadow-sm" type="button"
                    data-bs-toggle="collapse" data-bs-target="#filterCollapse" aria-expanded="false">
                    <i class="ti ti-filter me-2"></i>Filter
                </button>
            </div>
        </div>

        <!-- Filters Section (Collapsible) -->
        <div class="collapse mb-4" id="filterCollapse">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-3">
                    <div class="row g-3">
                        <div class="col-md-10"><input type="text" id="searchInput" class="form-control"
                                placeholder="Search logs by user, certificate or action..."></div>
                        <div class="col-md-2"><button class="btn btn-primary w-100 shadow-sm"
                                onclick="loadData(1)">Filter</button></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-bottom-0 py-3">
                <h5 class="card-title mb-0">System Audit Trail</h5>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th class="ps-4">Sr No.</th>
                                <th>Timestamp</th>
                                <th>Action</th>
                                <th>Performed By</th>
                                <th>Certification Name</th>
                                <th>Expiry Date</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody id="tableBody">
                            <?php if (empty($list_data)): ?>
                                <tr>
                                    <td colspan="7" class="text-center py-5 text-muted">No logs found.</td>
                                </tr>
                            <?php else: ?>
                                <?php $sr = 1;
                                foreach ($list_data as $row): ?>
                                    <tr>
                                        <td class="ps-4"><?php echo $sr++; ?></td>
                                        <td><span
                                                class="text-muted fw-medium"><?php echo date('m/d/Y, h:i:s A', strtotime($row->timestamp)); ?></span>
                                        </td>
                                        <td>
                                            <?php
                                            $action = $row->action;
                                            $badgeClass = 'bg-soft-info text-info';
                                            if (strpos($action, 'In') !== false)
                                                $badgeClass = 'bg-soft-success text-success';
                                            if (strpos($action, 'Out') !== false)
                                                $badgeClass = 'bg-soft-warning text-warning';
                                            ?>
                                            <span
                                                class="badge <?php echo $badgeClass; ?> px-2 text-uppercase"><?php echo $action; ?></span>
                                        </td>
                                        <td><span class="fw-bold text-dark"><?php echo $row->performed_by; ?></span></td>
                                        <td><span
                                                class="fw-medium text-secondary"><?php echo $row->certification_name; ?></span>
                                        </td>
                                        <td><span
                                                class="text-muted"><?php echo date('d/m/Y', strtotime($row->expiry_date)); ?></span>
                                        </td>
                                        <td>
                                            <?php
                                            $stBadge = 'bg-soft-secondary text-dark';
                                            if ($row->status == 'In')
                                                $stBadge = 'bg-soft-success text-success';
                                            if ($row->status == 'Out')
                                                $stBadge = 'bg-soft-warning text-warning';
                                            ?>
                                            <span class="badge <?php echo $stBadge; ?> px-2"><?php echo $row->status; ?></span>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer bg-white border-top-0 p-3" id="paginationContainer">
                <nav>
                    <ul class="pagination pagination-sm justify-content-end mb-0">
                        <li class="page-item disabled"><a class="page-link" href="#">Previous</a></li>
                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                        <?php if ($total_pages > 1): ?>
                            <li class="page-item"><a class="page-link" href="javascript:void(0)" onclick="loadData(2)">2</a>
                            </li>
                        <?php endif; ?>
                        <li class="page-item <?php echo $total_pages <= 1 ? 'disabled' : ''; ?>"><a class="page-link"
                                href="javascript:void(0)" onclick="loadData(2)">Next</a></li>
                    </ul>
                </nav>
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

        fetch('dsc_logs.php', {
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
    document.getElementById('searchInput')?.addEventListener('keyup', function () {
        clearTimeout(timeout);
        timeout = setTimeout(() => { loadData(1); }, 500);
    });
</script>

<?php include 'includes/footer.php'; ?>