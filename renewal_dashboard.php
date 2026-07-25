<?php
include 'root/config.php';
$ai_core->aiCheckLogin();
include 'includes/header.php';
include 'includes/sidebar.php';
?>

<div class="page-wrapper">
    <div class="content">
        <div class="row justify-content-center align-items-center" style="min-height: 70vh;">
            <div class="col-md-8 text-center">
                <div class="card border-0 shadow-lg overflow-hidden" style="border-radius: 30px; background: linear-gradient(135deg, #ffffff, #f4f7fe);">
                    <div class="card-body p-5">
                        <div class="mb-4">
                            <div class="avatar avatar-xxl bg-soft-info mx-auto mb-4" style="width: 120px; height: 120px;">
                                <i class="ti ti-refresh fs-60 text-info animate-spin"></i>
                            </div>
                        </div>
                        <h1 class="fw-bold text-dark mb-2">Renewal Tracking</h1>
                        <h3 class="text-info mb-4">Coming Soon!</h3>
                        <p class="text-muted fs-18 mb-5">We are crafting a powerful renewal management system to help you track policies, licenses, and certificates with ease. Stay tuned for the launch!</p>
                        
                        <div class="row g-3 justify-content-center mb-5">
                            <div class="col-auto">
                                <div class="p-3 bg-white shadow-sm rounded-3 border text-center" style="min-width: 100px;">
                                    <h4 class="fw-bold mb-0">12</h4>
                                    <small class="text-muted">Days</small>
                                </div>
                            </div>
                            <div class="col-auto">
                                <div class="p-3 bg-white shadow-sm rounded-3 border text-center" style="min-width: 100px;">
                                    <h4 class="fw-bold mb-0">14</h4>
                                    <small class="text-muted">Hours</small>
                                </div>
                            </div>
                            <div class="col-auto">
                                <div class="p-3 bg-white shadow-sm rounded-3 border text-center" style="min-width: 100px;">
                                    <h4 class="fw-bold mb-0">22</h4>
                                    <small class="text-muted">Mins</small>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex gap-3 justify-content-center">
                            <a href="dashboard.php" class="btn btn-info text-white px-5 py-3 fw-bold shadow-sm rounded-pill">
                                <i class="ti ti-smart-home me-2"></i>Back to Dashboard
                            </a>
                            <button class="btn btn-outline-info px-5 py-3 fw-bold rounded-pill" onclick="toastr.info('We will notify you once it is ready!')">
                                <i class="ti ti-bell me-2"></i>Notify Me
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
@keyframes spin {
  from { transform: rotate(0deg); }
  to { transform: rotate(360deg); }
}
.animate-spin {
  animation: spin 8s linear infinite;
}
.bg-soft-info {
    background-color: rgba(14, 165, 233, 0.1);
}
.avatar-xxl {
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
}
</style>

<?php include 'includes/footer.php'; ?>
