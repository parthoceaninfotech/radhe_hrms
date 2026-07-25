<?php
include 'root/config.php';
$ai_core->aiCheckLogin();

$page_nm = $_GET['page'] ?? 'Feature';
include 'includes/header.php';
include 'includes/sidebar.php';
?>

<div class="page-wrapper d-flex align-items-center justify-content-center">
    <div class="content w-100">
        <div class="row justify-content-center">
            <div class="col-xl-6 col-lg-8 text-center">
                <div class="card border-0 premium-cs-card shadow-lg">
                    <div class="card-body p-5">
                        <div class="mb-5 position-relative">
                            <div class="cs-circle-glow"></div>
                            <div class="avatar avatar-xxl mx-auto mb-4 rocket-wrapper">
                                <i class="ti ti-rocket fs-80 text-white animate-rocket"></i>
                            </div>
                        </div>
                        <h1 class="display-4 fw-bold text-dark mb-2">Coming Soon</h1>
                        <h4 class="text-primary fw-bold mb-4">The <span class="text-navy"><?php echo htmlspecialchars($page_nm); ?></span> module is launching soon!</h4>
                        <p class="text-muted fs-16 mb-5 px-lg-5">We're building something extraordinary for you. Our team is working hard to deliver a seamless experience. Stay tuned!</p>
                        
                        <div class="row g-4 justify-content-center mb-5 countdown-wrapper">
                            <div class="col-3">
                                <div class="p-3 countdown-item">
                                    <h2 class="fw-bold mb-0 text-navy">15</h2>
                                    <span class="text-muted small text-uppercase fw-bold">Days</span>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="p-3 countdown-item">
                                    <h2 class="fw-bold mb-0 text-navy">08</h2>
                                    <span class="text-muted small text-uppercase fw-bold">Hours</span>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="p-3 countdown-item">
                                    <h2 class="fw-bold mb-0 text-navy">45</h2>
                                    <span class="text-muted small text-uppercase fw-bold">Mins</span>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex flex-wrap gap-3 justify-content-center mt-5">
                            <a href="dashboard.php" class="btn btn-primary-premium px-5 py-3 fw-bold rounded-pill">
                                <i class="ti ti-arrow-left me-2"></i>Go to Dashboard
                            </a>
                            <button class="btn btn-outline-navy px-5 py-3 fw-bold rounded-pill" onclick="toastr.info('We will notify you once it is ready!')">
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
:root {
    --navy-blue: #0f172a;
    --vibrant-blue: #3b82f6;
}

.text-navy { color: var(--navy-blue); }

.premium-cs-card {
    border-radius: 40px;
    background: #ffffff;
    border: 1px solid rgba(0,0,0,0.05) !important;
}

.cs-circle-glow {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 250px;
    height: 250px;
    background: radial-gradient(circle, rgba(59, 130, 246, 0.1) 0%, rgba(255, 255, 255, 0) 70%);
    z-index: 0;
}

.rocket-wrapper {
    width: 150px;
    height: 150px;
    background: linear-gradient(135deg, var(--navy-blue), var(--vibrant-blue));
    border-radius: 35px;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 20px 40px rgba(15, 23, 42, 0.2);
    position: relative;
    z-index: 1;
}

@keyframes rocket-move {
  0% { transform: translateY(0) rotate(0deg); }
  25% { transform: translateY(-10px) rotate(5deg); }
  50% { transform: translateY(0) rotate(0deg); }
  75% { transform: translateY(-10px) rotate(-5deg); }
  100% { transform: translateY(0) rotate(0deg); }
}

.animate-rocket {
  animation: rocket-move 3s infinite ease-in-out;
}

.countdown-item {
    background: #f8fafc;
    border-radius: 24px;
    border: 1px solid #e2e8f0;
    transition: all 0.4s ease;
}

.countdown-item:hover {
    transform: translateY(-5px);
    background: #ffffff;
    border-color: var(--vibrant-blue);
    box-shadow: 0 10px 30px rgba(59, 130, 246, 0.1);
}

.btn-primary-premium {
    background: linear-gradient(135deg, var(--navy-blue), var(--vibrant-blue));
    color: #fff;
    border: none;
    box-shadow: 0 10px 25px rgba(15, 23, 42, 0.2);
    transition: all 0.3s ease;
}

.btn-primary-premium:hover {
    transform: translateY(-3px);
    box-shadow: 0 15px 35px rgba(15, 23, 42, 0.3);
    color: #fff;
}

.btn-outline-navy {
    border: 2px solid var(--navy-blue);
    color: var(--navy-blue);
    background: transparent;
    transition: all 0.3s ease;
}

.btn-outline-navy:hover {
    background: var(--navy-blue);
    color: #fff;
}
</style>

<?php include 'includes/footer.php'; ?>

<?php include 'includes/footer.php'; ?>