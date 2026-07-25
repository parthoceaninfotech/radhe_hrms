<?php
include 'root/config.php';
$ai_core->aiCheckLogin();

// --- CONFIGURATION ---
$page_nm = "Contact & Newsletter";
$table_inq = "tbl_contact_inquiries";
$table_news = "tbl_newsletter";
$redirection_url = "contact_newsletter.php";

$mode = $_REQUEST['mode'] ?? 'list';
$tab = $_REQUEST['tab'] ?? 'inquiries';

// --- AJAX FETCH HANDLER ---
if (isset($_POST['ajax_fetch'])) {
    $current_tab = $_POST['tab'] ?? 'inquiries';
    $search = $_POST['search'] ?? '';
    $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
    $limit = 10;
    $offset = ($page - 1) * $limit;

    if ($current_tab === 'inquiries') {
        $where = " WHERE 1=1";
        if (!empty($search)) $where .= " AND (name LIKE '%$search%' OR email LIKE '%$search%' OR phone LIKE '%$search%')";
        
        $total_records = $ai_db->aiGetQueryObj("SELECT COUNT(*) as total FROM $table_inq $where")[0]->total;
        $total_pages = ceil($total_records / $limit);
        $list_data = $ai_db->aiGetQueryObj("SELECT * FROM $table_inq $where ORDER BY id DESC LIMIT $limit OFFSET $offset");

        ob_start();
        if (empty($list_data)) {
            echo '<tr><td colspan="6" class="text-center py-5 text-muted">No inquiries found.</td></tr>';
        } else {
            $sr = $offset + 1;
            foreach ($list_data as $row) {
                ?>
                <tr>
                    <td class="ps-4"><?php echo $sr++; ?></td>
                    <td><span class="fw-bold d-block text-dark"><?php echo $row->name; ?></span><small class="text-muted"><?php echo date('d M Y', strtotime($row->created_at)); ?></small></td>
                    <td><a href="mailto:<?php echo $row->email; ?>" class="text-primary text-decoration-underline"><?php echo $row->email; ?></a></td>
                    <td><a href="tel:<?php echo $row->phone; ?>" class="text-dark"><?php echo $row->phone; ?></a></td>
                    <td><a href="javascript:void(0)" class="text-primary fw-medium" onclick="alert('<?php echo addslashes($row->message); ?>')">View</a></td>
                    <td class="text-end pe-4">
                        <div class="dropdown dropdown-action">
                            <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown"><i class="ti ti-dots-vertical"></i></a>
                            <div class="dropdown-menu dropdown-menu-end shadow border-0">
                                <a class="dropdown-item py-2" href="?mode=update_status&id=<?php echo $row->id; ?>&status=Replied"><i class="ti ti-check me-2 text-success"></i> Mark as Replied</a>
                                <a class="dropdown-item py-2 text-danger" href="?mode=delete_inq&id=<?php echo $row->id; ?>" onclick="return confirm('Delete?')"><i class="ti ti-trash me-2"></i> Delete</a>
                            </div>
                        </div>
                    </td>
                </tr>
                <?php
            }
        }
    } else {
        // Newsletter Tab
        $where = " WHERE 1=1";
        if (!empty($search)) $where .= " AND email LIKE '%$search%'";

        $total_records = $ai_db->aiGetQueryObj("SELECT COUNT(*) as total FROM $table_news $where")[0]->total;
        $total_pages = ceil($total_records / $limit);
        $list_data = $ai_db->aiGetQueryObj("SELECT * FROM $table_news $where ORDER BY id DESC LIMIT $limit OFFSET $offset");

        ob_start();
        if (empty($list_data)) {
            echo '<tr><td colspan="4" class="text-center py-5 text-muted">No subscribers found.</td></tr>';
        } else {
            $sr = $offset + 1;
            foreach ($list_data as $row) {
                ?>
                <tr>
                    <td class="ps-4"><?php echo $sr++; ?></td>
                    <td><span class="fw-bold text-dark"><?php echo $row->email; ?></span></td>
                    <td><span class="text-muted"><?php echo date('d M Y', strtotime($row->created_at)); ?></span></td>
                    <td class="text-end pe-4">
                        <a href="?mode=delete_news&id=<?php echo $row->id; ?>" class="btn btn-soft-danger btn-sm" onclick="return confirm('Remove subscriber?')"><i class="ti ti-trash"></i></a>
                    </td>
                </tr>
                <?php
            }
        }
    }
    $table_html = ob_get_clean();

    // Pagination
    ob_start();
    ?>
    <nav>
        <ul class="pagination pagination-sm justify-content-end mb-0">
            <li class="page-item <?php echo $page <= 1 ? 'disabled' : ''; ?>"><a class="page-link" href="javascript:void(0)" onclick="loadData(<?php echo $page - 1; ?>)">First</a></li>
            <li class="page-item <?php echo $page == 1 ? 'active' : ''; ?>"><a class="page-link" href="javascript:void(0)" onclick="loadData(1)">1</a></li>
            <?php if($total_pages > 1): ?>
                <li class="page-item <?php echo $page == 2 ? 'active' : ''; ?>"><a class="page-link" href="javascript:void(0)" onclick="loadData(2)">2</a></li>
            <?php endif; ?>
            <li class="page-item <?php echo $page >= $total_pages ? 'disabled' : ''; ?>"><a class="page-link" href="javascript:void(0)" onclick="loadData(<?php echo $page + 1; ?>)">Next</a></li>
        </ul>
    </nav>
    <?php
    $pagination_html = ob_get_clean();

    echo json_encode(['status' => 'success', 'table' => $table_html, 'pagination' => $pagination_html]);
    exit;
}

// --- HANDLE ACTIONS ---
if ($mode === 'delete_inq' && isset($_GET['id'])) {
    $ai_db->aiQuery("DELETE FROM $table_inq WHERE id='".intval($_GET['id'])."'");
    $ai_core->aiGoPage($redirection_url . "?msg=3");
}
if ($mode === 'delete_news' && isset($_GET['id'])) {
    $ai_db->aiQuery("DELETE FROM $table_news WHERE id='".intval($_GET['id'])."'");
    $ai_core->aiGoPage($redirection_url . "?msg=3&tab=newsletter");
}
if ($mode === 'update_status' && isset($_GET['id'])) {
    $ai_db->aiQuery("UPDATE $table_inq SET status='".addslashes($_GET['status'])."' WHERE id='".intval($_GET['id'])."'");
    $ai_core->aiGoPage($redirection_url . "?msg=2");
}

include 'includes/header.php';
include 'includes/sidebar.php';

// Initial Stats
$stats = [
    'total' => count($ai_db->aiGetQueryObj("SELECT id FROM $table_inq")),
    'new' => count($ai_db->aiGetQueryObj("SELECT id FROM $table_inq WHERE status='New'")),
    'replied' => count($ai_db->aiGetQueryObj("SELECT id FROM $table_inq WHERE status='Replied'"))
];

$limit = 10;
$total_inq = count($ai_db->aiGetQueryObj("SELECT id FROM $table_inq"));
$total_pages_inq = ceil($total_inq / $limit);
$list_inq = $ai_db->aiGetQueryObj("SELECT * FROM $table_inq ORDER BY id DESC LIMIT $limit");
?>

<div class="page-wrapper">
    <div class="content">
        
        <div class="mb-4">
            <h3 class="page-title mb-1"><?php echo $page_nm; ?></h3>
        </div>

        <!-- Stats Grid -->
        <div class="row g-3 mb-4">
            <div class="col-md-4">
                <div class="card border-0 shadow-sm border-start border-primary border-3">
                    <div class="card-body p-3 d-flex align-items-center">
                        <div class="avatar avatar-sm bg-soft-primary text-primary me-2"><i class="ti ti-mail"></i></div>
                        <div><h5 class="mb-0 fw-bold"><?php echo $stats['total']; ?></h5><small class="text-muted text-uppercase" style="font-size: 10px;">Total Inquiries</small></div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 shadow-sm border-start border-success border-3">
                    <div class="card-body p-3 d-flex align-items-center">
                        <div class="avatar avatar-sm bg-soft-success text-success me-2"><i class="ti ti-mail-opened"></i></div>
                        <div><h5 class="mb-0 fw-bold"><?php echo $stats['new']; ?></h5><small class="text-muted text-uppercase" style="font-size: 10px;">New</small></div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 shadow-sm border-start border-warning border-3">
                    <div class="card-body p-3 d-flex align-items-center">
                        <div class="avatar avatar-sm bg-soft-warning text-warning me-2"><i class="ti ti-checks"></i></div>
                        <div><h5 class="mb-0 fw-bold"><?php echo $stats['replied']; ?></h5><small class="text-muted text-uppercase" style="font-size: 10px;">Replied</small></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-bottom-0 pt-3">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <div class="nav nav-pills gap-2" id="v-pills-tab" role="tablist">
                        <button class="nav-link active py-2 px-4 shadow-sm fw-bold d-flex align-items-center" id="tabInq" data-bs-toggle="pill" type="button" role="tab" onclick="switchTab('inquiries')"><i class="ti ti-mail me-2"></i>Contact Inquiries</button>
                        <button class="nav-link py-2 px-4 shadow-sm fw-bold d-flex align-items-center" id="tabNews" data-bs-toggle="pill" type="button" role="tab" onclick="switchTab('newsletter')"><i class="ti ti-news me-2"></i>Newsletter Subscribers</button>
                    </div>
                    <button class="btn btn-soft-primary d-flex align-items-center shadow-sm" type="button" data-bs-toggle="collapse" data-bs-target="#filterCollapse" aria-expanded="false">
                        <i class="ti ti-filter me-2"></i>Filter
                    </button>
                </div>

                <!-- Filters Section (Collapsible) -->
                <div class="collapse mb-3" id="filterCollapse">
                    <div class="input-icon-start position-relative w-100">
                        <span class="input-icon-addon ps-2"><i class="ti ti-search"></i></span>
                        <input type="text" id="searchInput" class="form-control ps-5" placeholder="Search by name, email or phone...">
                    </div>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light" id="tableHead">
                            <tr>
                                <th class="ps-4">Sr No.</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Message</th>
                                <th class="text-end pe-4">Action</th>
                            </tr>
                        </thead>
                        <tbody id="tableBody">
                            <?php $sr=1; foreach($list_inq as $row): ?>
                            <tr>
                                <td class="ps-4"><?php echo $sr++; ?></td>
                                <td><span class="fw-bold d-block text-dark"><?php echo $row->name; ?></span><small class="text-muted"><?php echo date('d M Y', strtotime($row->created_at)); ?></small></td>
                                <td><a href="mailto:<?php echo $row->email; ?>" class="text-primary text-decoration-underline"><?php echo $row->email; ?></a></td>
                                <td><a href="tel:<?php echo $row->phone; ?>" class="text-dark"><?php echo $row->phone; ?></a></td>
                                <td><a href="javascript:void(0)" class="text-primary fw-medium" onclick="alert('<?php echo addslashes($row->message); ?>')">View</a></td>
                                <td class="text-end pe-4">
                                    <div class="dropdown dropdown-action">
                                        <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown"><i class="ti ti-dots-vertical"></i></a>
                                        <div class="dropdown-menu dropdown-menu-end shadow border-0">
                                            <a class="dropdown-item py-2" href="?mode=update_status&id=<?php echo $row->id; ?>&status=Replied"><i class="ti ti-check me-2 text-success"></i> Mark as Replied</a>
                                            <a class="dropdown-item py-2 text-danger" href="?mode=delete_inq&id=<?php echo $row->id; ?>" onclick="return confirm('Delete?')"><i class="ti ti-trash me-2"></i> Delete</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <div class="card-footer bg-white border-top-0 p-3" id="paginationContainer">
                    <nav>
                        <ul class="pagination pagination-sm justify-content-end mb-0">
                            <li class="page-item <?php echo $page <= 1 ? 'disabled' : ''; ?>"><a class="page-link" href="javascript:void(0)" onclick="loadData(<?php echo $page - 1; ?>)">Previous</a></li>
                            <?php for ($i = 1; $i <= $total_pages_inq; $i++): ?>
                                <li class="page-item <?php echo $i == 1 ? 'active' : ''; ?>"><a class="page-link" href="javascript:void(0)" onclick="loadData(<?php echo $i; ?>)"><?php echo $i; ?></a></li>
                            <?php endfor; ?>
                            <li class="page-item <?php echo $total_pages_inq <= 1 ? 'disabled' : ''; ?>"><a class="page-link" href="javascript:void(0)" onclick="loadData(2)">Next</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>

    </div>
</div>

<script>
let currentTab = 'inquiries';

function switchTab(tab) {
    currentTab = tab;
    const tableHead = document.getElementById('tableHead');
    if(tab === 'inquiries') {
        tableHead.innerHTML = `<tr><th class="ps-4">Sr No.</th><th>Name</th><th>Email</th><th>Phone</th><th>Message</th><th class="text-end pe-4">Action</th></tr>`;
    } else {
        tableHead.innerHTML = `<tr><th class="ps-4">Sr No.</th><th>Email</th><th>Subscribe Date</th><th class="text-end pe-4">Action</th></tr>`;
    }
    loadData(1);
}

function loadData(page = 1) {
    const search = document.getElementById('searchInput').value;
    const formData = new FormData();
    formData.append('ajax_fetch', '1');
    formData.append('tab', currentTab);
    formData.append('search', search);
    formData.append('page', page);

    fetch('contact_newsletter.php', {
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
.nav-pills .nav-link { color: #6c757d; background: #f8f9fa; border: 1px solid #e9ecef; }
.nav-pills .nav-link.active { background: #0d6efd !important; color: #fff !important; border-color: #0d6efd; }
</style>

<?php include 'includes/footer.php'; ?>
