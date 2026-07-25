<?php
include 'root/config.php';
$ai_core->aiCheckLogin();

// --- FETCH DYNAMIC STATS (Advisory Real-time Data) ---
$total_clients = $ai_db->aiGetQueryObj("SELECT COUNT(DISTINCT company_name) as count FROM (
    SELECT company_name FROM tbl_factory_quotations
    UNION
    SELECT company_name FROM tbl_factory_renewals
) as combined")[0]->count ?? 0;

$active_cases = $ai_db->aiGetQueryObj("SELECT COUNT(*) as count FROM tbl_factory_quotations WHERE final_approval_status != 'Final Approved'")[0]->count ?? 0;

$pending_consultations = $ai_db->aiGetQueryObj("SELECT COUNT(*) as count FROM tbl_factory_quotations WHERE client_approval_status = 'Pending'")[0]->count ?? 0;

$rev_q = $ai_db->aiGetQueryObj("SELECT SUM(total_amount) as total FROM tbl_factory_quotations")[0]->total ?? 0;
$rev_r = $ai_db->aiGetQueryObj("SELECT SUM(total_amount) as total FROM tbl_factory_renewals")[0]->total ?? 0;
$total_revenue = (float) $rev_q + (float) $rev_r;

// Monthly Growth Data
$growth_data = $ai_db->aiGetQueryObj("SELECT 
    DATE_FORMAT(created_at, '%b') as month, 
    COUNT(*) as count 
    FROM tbl_factory_quotations 
    WHERE created_at >= DATE_SUB(NOW(), INTERVAL 6 MONTH)
    GROUP BY YEAR(created_at), MONTH(created_at)
    ORDER BY YEAR(created_at) ASC, MONTH(created_at) ASC");

$months = [];
$counts = [];
foreach ($growth_data as $g) {
    $months[] = $g->month;
    $counts[] = (int) $g->count;
}

// Client Types Data (Segmented by Workers)
$sme_count = $ai_db->aiGetQueryObj("SELECT COUNT(*) as count FROM tbl_factory_quotations WHERE num_workers IN ('Up To 20', '21 to 50', '51 to 100')")[0]->count ?? 0;
$org_count = $ai_db->aiGetQueryObj("SELECT COUNT(*) as count FROM tbl_factory_quotations WHERE num_workers IN ('101 to 250', '251 to 500', '501 to 1000')")[0]->count ?? 0;
$ind_count = $ai_db->aiGetQueryObj("SELECT COUNT(*) as count FROM tbl_factory_quotations WHERE num_workers IN ('1001 to 2000', '2001 to 5000', '5001 to above')")[0]->count ?? 0;

$total_types = (int) $sme_count + (int) $org_count + (int) $ind_count;
$sme_per = $total_types > 0 ? round(($sme_count / $total_types) * 100) : 0;
$org_per = $total_types > 0 ? round(($org_count / $total_types) * 100) : 0;
$ind_per = $total_types > 0 ? round(($ind_count / $total_types) * 100) : 0;

include 'includes/header.php';
include 'includes/sidebar_advisory.php';
?>

<div class="page-wrapper">
    <div class="content">
        <!-- Page Header -->
        <div class="d-md-flex d-block align-items-center justify-content-between mb-4">
            <div class="my-auto mb-2">
                <h3 class="page-title mb-1 fw-bold text-dark">Advisory Hub</h3>
                <p class="text-muted mb-0">Welcome to Radhe Advisory Dashboard.</p>
            </div>
            <div class="d-flex my-xl-auto btn-view gap-2">
                <button class="btn btn-white btn-icon shadow-sm rounded-circle" onclick="location.reload();"
                    title="Refresh Dashboard">
                    <i class="ti ti-refresh text-primary"></i>
                </button>
                <button class="btn btn-purple d-flex align-items-center shadow-sm rounded-pill px-4 fw-bold text-white"
                    style="background: #a855f7; border: none;">
                    <i class="ti ti-plus me-2"></i>New Consultation
                </button>
            </div>
        </div>

        <!-- Premium Stat Cards -->
        <div class="row g-4 mb-4">
            <!-- Total Clients -->
            <div class="col-xl-3 col-md-6">
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden stat-card h-100">
                    <div class="card-body p-4 position-relative z-1">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <div class="bg-soft-purple p-3 rounded-3">
                                <i class="ti ti-users-group fs-28 text-purple"></i>
                            </div>
                            <span class="badge bg-soft-success text-success rounded-pill px-3 py-1">Active</span>
                        </div>
                        <h6 class="text-muted mb-1 fw-medium">Total Clients</h6>
                        <h2 class="mb-0 fw-bold counter"><?php echo number_format($total_clients); ?></h2>
                        <div class="mt-3 d-flex align-items-center small">
                            <span class="text-success me-2 fw-bold"><i class="ti ti-trending-up me-1"></i>+8%</span>
                            <span class="text-muted">this quarter</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Active Cases -->
            <div class="col-xl-3 col-md-6">
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden stat-card h-100">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <div class="bg-soft-info p-3 rounded-3">
                                <i class="ti ti-folder fs-28 text-info"></i>
                            </div>
                            <span class="badge bg-soft-info text-info rounded-pill px-3 py-1">In-Progress</span>
                        </div>
                        <h6 class="text-muted mb-1 fw-medium">Active Cases</h6>
                        <h2 class="mb-0 fw-bold counter"><?php echo number_format($active_cases); ?></h2>
                        <div class="mt-3 d-flex align-items-center small">
                            <span class="text-info me-2 fw-bold"><i class="ti ti-arrow-up-right me-1"></i>5 New</span>
                            <span class="text-muted">this week</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pending Consultations -->
            <div class="col-xl-3 col-md-6">
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden stat-card h-100">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <div class="bg-soft-warning p-3 rounded-3">
                                <i class="ti ti-message-2-share fs-28 text-warning"></i>
                            </div>
                            <span class="badge bg-soft-warning text-warning rounded-pill px-3 py-1">Priority</span>
                        </div>
                        <h6 class="text-muted mb-1 fw-medium">Consultations</h6>
                        <h2 class="mb-0 fw-bold counter"><?php echo number_format($pending_consultations); ?></h2>
                        <div class="mt-3 d-flex align-items-center small">
                            <span class="text-warning me-2 fw-bold"><i class="ti ti-clock me-1"></i>High</span>
                            <span class="text-muted">attention needed</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total Revenue -->
            <div class="col-xl-3 col-md-6">
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden stat-card h-100">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <div class="bg-soft-success p-3 rounded-3">
                                <i class="ti ti-receipt-2 fs-28 text-success"></i>
                            </div>
                            <span class="badge bg-soft-success text-success rounded-pill px-3 py-1">Target</span>
                        </div>
                        <h6 class="text-muted mb-1 fw-medium">Billing Volume</h6>
                        <h2 class="mb-0 fw-bold counter">₹<?php echo number_format($total_revenue); ?></h2>
                        <div class="mt-3 d-flex align-items-center small">
                            <span class="text-success me-2 fw-bold"><i class="ti ti-user-plus me-1"></i>On track</span>
                            <span class="text-muted">for monthly goal</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-4 mb-4">
            <!-- Advisory Growth Chart -->
            <div class="col-xl-8 col-lg-7">
                <div class="card border-0 shadow-sm rounded-4 h-100 overflow-hidden">
                    <div
                        class="card-header bg-white border-bottom-0 py-4 px-4 d-flex align-items-center justify-content-between">
                        <div>
                            <h5 class="fw-bold mb-0 text-dark">Advisory Growth</h5>
                            <p class="text-muted small mb-0">Monthly analysis of consultation requests</p>
                        </div>
                    </div>
                    <div class="card-body px-4 pb-4">
                        <div id="advisory-growth-chart" style="height: 380px;"></div>
                    </div>
                </div>
            </div>

            <!-- Client Distribution -->
            <div class="col-xl-4 col-lg-5">
                <div class="card border-0 shadow-sm rounded-4 h-100">
                    <div class="card-header bg-white border-bottom-0 py-4 px-4">
                        <h5 class="fw-bold mb-0 text-dark">Client Types</h5>
                        <p class="text-muted small mb-0">Portfolio distribution</p>
                    </div>
                    <div class="card-body px-4 pb-4">
                        <div id="client-donut-chart" style="height: 300px;"></div>
                        <div class="mt-4 pt-2">
                            <div
                                class="d-flex align-items-center justify-content-between mb-3 p-2 rounded-3 bg-light bg-opacity-50">
                                <span class="text-dark fw-medium d-flex align-items-center">
                                    <span class="dot bg-purple me-2"></span>SME (0-100)
                                </span>
                                <span class="badge bg-purple rounded-pill text-white"
                                    style="background:#a855f7;"><?php echo $sme_per; ?>%</span>
                            </div>
                            <div
                                class="d-flex align-items-center justify-content-between mb-3 p-2 rounded-3 bg-light bg-opacity-50">
                                <span class="text-dark fw-medium d-flex align-items-center">
                                    <span class="dot bg-info me-2"></span>Org (101-1000)
                                </span>
                                <span class="badge bg-info rounded-pill"><?php echo $org_per; ?>%</span>
                            </div>
                            <div
                                class="d-flex align-items-center justify-content-between p-2 rounded-3 bg-light bg-opacity-50">
                                <span class="text-dark fw-medium d-flex align-items-center">
                                    <span class="dot bg-warning me-2"></span>Large (1000+)
                                </span>
                                <span class="badge bg-warning rounded-pill"><?php echo $ind_per; ?>%</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .stat-card {
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        border: 1px solid rgba(0, 0, 0, 0.05) !important;
    }

    .stat-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.08) !important;
        border-color: rgba(168, 85, 247, 0.2) !important;
    }

    .bg-soft-purple {
        background: rgba(168, 85, 247, 0.1);
    }

    .bg-soft-info {
        background: rgba(14, 165, 233, 0.1);
    }

    .bg-soft-warning {
        background: rgba(245, 158, 11, 0.1);
    }

    .bg-soft-success {
        background: rgba(16, 185, 129, 0.1);
    }

    .text-purple {
        color: #a855f7;
    }

    .bg-purple {
        background: #a855f7;
    }

    .dot {
        height: 10px;
        width: 10px;
        border-radius: 50%;
        display: inline-block;
    }
</style>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        // Growth Chart
        var growthOptions = {
            series: [{
                name: 'Consultations',
                data: <?php echo json_encode($counts); ?>
            }],
            chart: { height: 380, type: 'bar', toolbar: { show: false } },
            colors: ['#a855f7'],
            plotOptions: { bar: { borderRadius: 10, columnWidth: '40%' } },
            xaxis: { categories: <?php echo json_encode($months); ?> },
            grid: { borderColor: '#f1f1f1', strokeDashArray: 4 }
        };
        new ApexCharts(document.querySelector("#advisory-growth-chart"), growthOptions).render();

        // Client Donut Chart
        var donutOptions = {
            series: [<?php echo $sme_per; ?>, <?php echo $org_per; ?>, <?php echo $ind_per; ?>],
            chart: { type: 'donut', height: 300 },
            labels: ['SME', 'Organisation', 'Large Scale'],
            colors: ['#a855f7', '#0ea5e9', '#f59e0b'],
            plotOptions: { pie: { donut: { size: '75%', labels: { show: true, total: { show: true, label: 'Clients', fontWeight: 600 } } } } },
            dataLabels: { enabled: false },
            legend: { show: false }
        };
        new ApexCharts(document.querySelector("#client-donut-chart"), donutOptions).render();
    });
</script>

<?php include 'includes/footer.php'; ?>