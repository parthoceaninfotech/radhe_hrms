<?php
include 'root/config.php';
$ai_core->aiCheckLogin();

// --- CONFIGURATION ---
$page_nm = "Blog Management";
$table = "tbl_blogs";
$redirection_url = "blog_management.php";
$imgUrl = "assets/img/blogs/";

if (!is_dir($imgUrl)) {
    mkdir($imgUrl, 0777, true);
}

$mode = $_REQUEST['mode'] ?? 'list';
$id = isset($_REQUEST['id']) ? intval($_REQUEST['id']) : 0;
$data = null;

// --- AJAX FETCH HANDLER ---
if (isset($_POST['ajax_fetch'])) {
    $where = " WHERE 1=1";
    $search = $_POST['search'] ?? '';
    $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
    $limit = 10;
    $offset = ($page - 1) * $limit;

    if (!empty($search)) {
        $where .= " AND (title LIKE '%$search%' OR author LIKE '%$search%' OR category LIKE '%$search%')";
    }

    $total_res = $ai_db->aiGetQueryObj("SELECT COUNT(*) as total FROM $table $where");
    $total_records = $total_res[0]->total;
    $total_pages = ceil($total_records / $limit);

    $sql = "SELECT * FROM $table $where ORDER BY id DESC LIMIT $limit OFFSET $offset";
    $list_data = $ai_db->aiGetQueryObj($sql);

    ob_start();
    if (empty($list_data)) {
        echo '<tr><td colspan="5" class="text-center py-5 text-muted">No blog posts found.</td></tr>';
    } else {
        foreach ($list_data as $row) {
            ?>
            <tr>
                <td class="ps-4">
                    <div class="d-flex align-items-center">
                        <?php if($row->cover_image): ?>
                            <img src="<?php echo $imgUrl . $row->cover_image; ?>" class="avatar avatar-md rounded me-2 shadow-sm border">
                        <?php else: ?>
                            <div class="avatar avatar-md rounded me-2 bg-soft-primary text-primary d-flex align-items-center justify-content-center fw-bold"><?php echo substr($row->title, 0, 1); ?></div>
                        <?php endif; ?>
                        <div>
                            <span class="fw-bold d-block text-dark"><?php echo $row->title; ?></span>
                            <small class="text-muted"><?php echo $row->category; ?></small>
                        </div>
                    </div>
                </td>
                <td><span class="text-muted"><?php echo $row->author; ?></span></td>
                <td><span class="badge bg-soft-info text-info"><?php echo date('d M Y', strtotime($row->created_at)); ?></span></td>
                <td>
                    <span class="badge <?php echo $row->status == 'Published' ? 'bg-soft-success text-success' : 'bg-soft-warning text-warning'; ?> px-3">
                        <?php echo $row->status; ?>
                    </span>
                </td>
                <td class="text-end pe-4">
                    <div class="dropdown dropdown-action">
                        <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown"><i class="ti ti-dots-vertical"></i></a>
                        <div class="dropdown-menu dropdown-menu-end shadow border-0">
                            <a class="dropdown-item py-2" href="blog_management.php?mode=edit&id=<?php echo $row->id; ?>"><i class="ti ti-edit me-2 text-info"></i> Edit</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item py-2 text-danger" href="blog_management.php?mode=delete&id=<?php echo $row->id; ?>" onclick="return confirm('Delete?')"><i class="ti ti-trash me-2"></i> Delete</a>
                        </div>
                    </div>
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
            <li class="page-item <?php echo $page <= 1 ? 'disabled' : ''; ?>"><a class="page-link" href="javascript:void(0)" onclick="loadData(<?php echo $page - 1; ?>)">Previous</a></li>
            <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                <li class="page-item <?php echo $i == $page ? 'active' : ''; ?>"><a class="page-link" href="javascript:void(0)" onclick="loadData(<?php echo $i; ?>)"><?php echo $i; ?></a></li>
            <?php endfor; ?>
            <li class="page-item <?php echo $page >= $total_pages ? 'disabled' : ''; ?>"><a class="page-link" href="javascript:void(0)" onclick="loadData(<?php echo $page + 1; ?>)">Next</a></li>
        </ul>
    </nav>
    <?php
    $pagination_html = ob_get_clean();

    echo json_encode(['status' => 'success', 'table' => $table_html, 'pagination' => $pagination_html]);
    exit;
}

// --- HANDLE POST ACTIONS ---
if (isset($_POST['btn_submit'])) {
    $title = addslashes($_POST['title']);
    $category = addslashes($_POST['category']);
    $status = $_POST['status'] ?? 'Published';
    $author = addslashes($_POST['author']);
    $tags = addslashes($_POST['tags']);
    $excerpt = addslashes($_POST['excerpt']);
    $content = addslashes($_POST['content']);

    $old_img = $_POST['old_img'] ?? '';
    if (!empty($_FILES['cover_image']['name'])) {
        $cover_image = $ai_core->aiUpload($_FILES['cover_image'], $imgUrl, 'blog', $old_img);
    } else {
        $cover_image = $old_img;
    }

    if ($mode === "add") {
        $sql = "INSERT INTO $table SET title='$title', category='$category', status='$status', author='$author', tags='$tags', excerpt='$excerpt', content='$content', cover_image='$cover_image'";
        $msg = 1;
    } else {
        $sql = "UPDATE $table SET title='$title', category='$category', status='$status', author='$author', tags='$tags', excerpt='$excerpt', content='$content', cover_image='$cover_image' WHERE id='$id'";
        $msg = 2;
    }

    $ai_db->aiQuery($sql);
    $ai_core->aiGoPage($redirection_url . "?msg=$msg");
}

// --- HANDLE DELETE ---
if ($mode === "delete" && $id) {
    $result = $ai_db->aiGetQueryObj("SELECT cover_image FROM $table WHERE id='$id' LIMIT 1");
    if (!empty($result[0]->cover_image)) {
        @unlink($imgUrl . $result[0]->cover_image);
    }
    $ai_db->aiQuery("DELETE FROM $table WHERE id='$id'");
    $ai_core->aiGoPage($redirection_url . "?msg=3");
}

include 'includes/header.php';
include 'includes/sidebar.php';

// Fetch for Edit
if (($mode === "edit") && $id && !isset($_POST['btn_submit'])) {
    $result = $ai_db->aiGetQueryObj("SELECT * FROM $table WHERE id='$id' LIMIT 1");
    $data = $result[0] ?? null;
}

// Initial List Data
if ($mode === 'list') {
    $limit = 10;
    $total_res = $ai_db->aiGetQueryObj("SELECT COUNT(*) as total FROM $table");
    $total_records = $total_res[0]->total;
    $total_pages = ceil($total_records / $limit);
    $list_data = $ai_db->aiGetQueryObj("SELECT * FROM $table ORDER BY id DESC LIMIT $limit");
}
?>

<div class="page-wrapper">
    <div class="content">
        
        <?php if ($mode == 'list'): ?>
            <div class="d-md-flex d-block align-items-center justify-content-between mb-4">
                <div class="my-auto mb-2"><h3 class="page-title mb-1"><?php echo $page_nm; ?></h3></div>
                <div class="mb-2 d-flex gap-2">
                    <button class="btn btn-soft-primary d-flex align-items-center shadow-sm" type="button" data-bs-toggle="collapse" data-bs-target="#filterCollapse" aria-expanded="false">
                        <i class="ti ti-filter me-2"></i>Filter
                    </button>
                    <a href="blog_management.php?mode=add" class="btn btn-primary shadow-sm"><i class="ti ti-plus me-2"></i>New Blog Post</a>
                </div>
            </div>

            <!-- Filters Section (Collapsible) -->
            <div class="collapse mb-4" id="filterCollapse">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-3">
                        <form id="filterForm" class="row g-3">
                            <div class="col-md-10"><input type="text" name="search" id="searchInput" class="form-control" placeholder="Search by Title, Category or Author..."></div>
                            <div class="col-md-2"><button type="submit" class="btn btn-primary w-100 shadow-sm">Filter</button></div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-bottom-0 py-3">
                    <h5 class="card-title mb-0">Blog Directory</h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th class="ps-4">Blog Post</th>
                                    <th>Author</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th class="text-end pe-4">Action</th>
                                </tr>
                            </thead>
                            <tbody id="tableBody">
                                <?php if(empty($list_data)): ?>
                                    <tr><td colspan="5" class="text-center py-5 text-muted">No blog posts found.</td></tr>
                                <?php else: ?>
                                    <?php foreach($list_data as $row): ?>
                                    <tr>
                                        <td class="ps-4">
                                            <div class="d-flex align-items-center">
                                                <?php if($row->cover_image): ?>
                                                    <img src="<?php echo $imgUrl . $row->cover_image; ?>" class="avatar avatar-md rounded me-2 shadow-sm border">
                                                <?php else: ?>
                                                    <div class="avatar avatar-md rounded me-2 bg-soft-primary text-primary d-flex align-items-center justify-content-center fw-bold"><?php echo substr($row->title, 0, 1); ?></div>
                                                <?php endif; ?>
                                                <div>
                                                    <span class="fw-bold d-block text-dark"><?php echo $row->title; ?></span>
                                                    <small class="text-muted"><?php echo $row->category; ?></small>
                                                </div>
                                            </div>
                                        </td>
                                        <td><span class="text-muted"><?php echo $row->author; ?></span></td>
                                        <td><span class="badge bg-soft-info text-info"><?php echo date('d M Y', strtotime($row->created_at)); ?></span></td>
                                        <td>
                                            <span class="badge <?php echo $row->status == 'Published' ? 'bg-soft-success text-success' : 'bg-soft-warning text-warning'; ?> px-3">
                                                <?php echo $row->status; ?>
                                            </span>
                                        </td>
                                        <td class="text-end pe-4">
                                            <div class="dropdown dropdown-action">
                                                <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown"><i class="ti ti-dots-vertical"></i></a>
                                                <div class="dropdown-menu dropdown-menu-end shadow border-0">
                                                    <a class="dropdown-item py-2" href="blog_management.php?mode=edit&id=<?php echo $row->id; ?>"><i class="ti ti-edit me-2 text-info"></i> Edit</a>
                                                    <div class="dropdown-divider"></div>
                                                    <a class="dropdown-item py-2 text-danger" href="blog_management.php?mode=delete&id=<?php echo $row->id; ?>" onclick="return confirm('Delete?')"><i class="ti ti-trash me-2"></i> Delete</a>
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
                <div class="card-footer bg-white border-top-0 p-3" id="paginationContainer">
                    <nav>
                        <ul class="pagination pagination-sm justify-content-end mb-0">
                            <li class="page-item disabled"><a class="page-link" href="#">Previous</a></li>
                            <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                                <li class="page-item <?php echo $i == 1 ? 'active' : ''; ?>"><a class="page-link" href="javascript:void(0)" onclick="loadData(<?php echo $i; ?>)"><?php echo $i; ?></a></li>
                            <?php endfor; ?>
                            <li class="page-item <?php echo $total_pages <= 1 ? 'disabled' : ''; ?>"><a class="page-link" href="javascript:void(0)" onclick="loadData(2)">Next</a></li>
                        </ul>
                    </nav>
                </div>
            </div>

        <?php elseif ($mode == 'add' || $mode == 'edit'): ?>
            <div class="d-md-flex d-block align-items-center justify-content-between mb-4">
                <div class="my-auto mb-2"><h3 class="page-title mb-1"><?php echo $mode == 'add' ? 'New Blog Post' : 'Edit Blog Post'; ?></h3></div>
                <div class="mb-2"><a href="blog_management.php" class="btn btn-outline-secondary shadow-sm"><i class="ti ti-arrow-left me-2"></i>Back to Directory</a></div>
            </div>

            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <form action="blog_management.php" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                        <input type="hidden" name="mode" value="<?php echo $mode; ?>">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="hidden" name="old_img" value="<?php echo $data->cover_image ?? ''; ?>">
                        
                        <div class="row" id="formWrapper">
                            <div class="col-xl-8 border-end">
                                <h5 class="card-title mt-0 mb-4 pb-2 border-bottom fw-bold">Blog Content</h5>
                                <div class="row g-4">
                                    <div class="col-md-12">
                                        <label class="form-label fw-bold">Post Title <span class="text-danger">*</span></label>
                                        <input type="text" name="title" class="form-control form-control-lg fw-bold" value="<?php echo $data->title ?? ''; ?>" placeholder="Enter blog title..." required>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <label class="form-label fw-bold small">Category</label>
                                        <select name="category" class="form-select">
                                            <option value="General" <?php echo ($data && $data->category == 'General') ? 'selected' : ''; ?>>General</option>
                                            <option value="Compliance" <?php echo ($data && $data->category == 'Compliance') ? 'selected' : ''; ?>>Compliance</option>
                                            <option value="Industrial" <?php echo ($data && $data->category == 'Industrial') ? 'selected' : ''; ?>>Industrial</option>
                                            <option value="Legal" <?php echo ($data && $data->category == 'Legal') ? 'selected' : ''; ?>>Legal</option>
                                        </select>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <label class="form-label fw-bold small">Author Name</label>
                                        <input type="text" name="author" class="form-control" value="<?php echo $data->author ?? 'Radhe Consultancy'; ?>">
                                    </div>
                                    
                                    <div class="col-md-12">
                                        <label class="form-label fw-bold small">Tags (comma separated)</label>
                                        <input type="text" name="tags" class="form-control" value="<?php echo $data->tags ?? ''; ?>" placeholder="e.g. compliance, labor-law, updates">
                                    </div>
                                    
                                    <div class="col-md-12">
                                        <label class="form-label fw-bold small">Excerpt</label>
                                        <textarea name="excerpt" class="form-control" rows="2" placeholder="Brief summary for listing pages..."><?php echo $data->excerpt ?? ''; ?></textarea>
                                    </div>
                                    
                                    <div class="col-md-12">
                                        <label class="form-label fw-bold small">Article Content <span class="text-danger">*</span></label>
                                        <textarea name="content" class="form-control" rows="12" placeholder="Write your full story here..." required><?php echo $data->content ?? ''; ?></textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-4">
                                <h5 class="card-title mt-0 mb-4 pb-2 border-bottom fw-bold">Publishing Settings</h5>
                                
                                <div class="mb-4">
                                    <label class="form-label fw-bold small d-block">Cover Image</label>
                                    <div class="bg-light p-3 rounded-3 text-center mb-3">
                                        <img src="<?php echo ($data && $data->cover_image) ? $imgUrl . $data->cover_image : 'assets/img/placeholder.png'; ?>" id="imgPreview" class="img-fluid rounded shadow-sm mb-3" style="max-height: 200px;">
                                        <input type="file" name="cover_image" class="form-control form-control-sm" onchange="document.getElementById('imgPreview').src = window.URL.createObjectURL(this.files[0])">
                                        <small class="text-muted mt-2 d-block" style="font-size: 10px;">Recommended: 1200x630px</small>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <label class="form-label fw-bold small">Publication Status</label>
                                    <select name="status" class="form-select">
                                        <option value="Published" <?php echo ($data && $data->status == 'Published') ? 'selected' : ''; ?>>Published</option>
                                        <option value="Draft" <?php echo ($data && $data->status == 'Draft') ? 'selected' : ''; ?>>Draft</option>
                                        <option value="Archived" <?php echo ($data && $data->status == 'Archived') ? 'selected' : ''; ?>>Archived</option>
                                    </select>
                                </div>

                                <div class="bg-soft-primary p-3 rounded-3 mt-4">
                                    <h6 class="fw-bold text-primary small mb-1"><i class="ti ti-info-circle me-1"></i> Writing Tip</h6>
                                    <p class="text-muted small mb-0" style="font-size: 11px;">Keep your titles catchy and your content informative for better engagement.</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row mt-4 pt-4 border-top">
                            <div class="col-12 text-center">
                                <button type="submit" name="btn_submit" class="btn btn-primary px-5 py-2 fw-bold shadow-sm">
                                    <i class="ti ti-upload me-2"></i><?php echo $mode == 'add' ? 'Publish Blog' : 'Update Blog Post'; ?>
                                </button>
                                <a href="blog_management.php" class="btn btn-white border px-5 py-2 fw-bold shadow-sm ms-2">
                                    <i class="ti ti-arrow-left me-2"></i>Back
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
                    </form>
                </div>
            </div>
        <?php endif; ?>

    </div>
</div>

<script>
function loadData(page = 1) {
    const formData = new FormData(document.getElementById('filterForm'));
    formData.append('ajax_fetch', '1');
    formData.append('page', page);

    fetch('blog_management.php', {
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

document.getElementById('filterForm')?.addEventListener('submit', function(e) {
    e.preventDefault();
    loadData(1);
});

let timeout = null;
document.getElementById('searchInput')?.addEventListener('keyup', function() {
    clearTimeout(timeout);
    timeout = setTimeout(() => { loadData(1); }, 500);
});
</script>

<?php include 'includes/footer.php'; ?>
