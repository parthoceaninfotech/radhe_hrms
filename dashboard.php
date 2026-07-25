<?php
include 'root/config.php';
$ai_core->aiCheckLogin();

// --- ROLE-BASED REDIRECTION ---
if (($_SESSION['role'] ?? '') === 'Plan Maker') {
    $ai_core->aiGoPage("plan_maker_dashboard.php");
    exit;
}

// --- FETCH DYNAMIC STATS ---
$total_companies = $ai_db->aiGetQueryObj("SELECT COUNT(id) as total FROM tbl_vendors_companies")[0]->total ?? 0;
$total_consumers = $ai_db->aiGetQueryObj("SELECT COUNT(id) as total FROM tbl_vendors_consumers")[0]->total ?? 0;
$total_dsc = $ai_db->aiGetQueryObj("SELECT COUNT(id) as total FROM tbl_dsc")[0]->total ?? 0;

// Unified Insurance Count
$total_insurance = $ai_db->aiGetQueryObj("SELECT COUNT(id) as total FROM tbl_insurance")[0]->total ?? 0;
$total_ins_v = $ai_db->aiGetQueryObj("SELECT COUNT(id) as total FROM tbl_insurance WHERE insurance_type='Vehicle'")[0]->total ?? 0;

// Compliance Stats
$total_labour_insp = $ai_db->aiGetQueryObj("SELECT COUNT(id) as total FROM tbl_labour_inspections")[0]->total ?? 0;
$total_labour_lic = $ai_db->aiGetQueryObj("SELECT COUNT(id) as total FROM tbl_labour_licenses")[0]->total ?? 0;
$total_compliance = $total_labour_insp + $total_labour_lic;

// Calculate Ratios for Chart
$total_all = $total_insurance + $total_compliance + $total_dsc;
if ($total_all > 0) {
    $ins_per = round(($total_insurance / $total_all) * 100);
    $comp_per = round(($total_compliance / $total_all) * 100);
    $dsc_per = 100 - ($ins_per + $comp_per);
} else {
    $ins_per = 33;
    $comp_per = 33;
    $dsc_per = 34;
}

include 'includes/header.php';
include 'includes/sidebar.php';
?>

<div class="page-wrapper">
    <div class="content">
        <!-- Page Header -->
        <div class="d-md-flex d-block align-items-center justify-content-between mb-4">
            <div class="my-auto mb-2">
                <h3 class="page-title mb-1 fw-bold text-dark">Executive Dashboard</h3>
                <p class="text-muted mb-0">Welcome back, Admin! Here's what's happening today.</p>
            </div>
            <div class="d-flex my-xl-auto btn-view gap-2">
                <button class="btn btn-white btn-icon shadow-sm rounded-circle" onclick="location.reload();"
                    title="Refresh Dashboard">
                    <i class="ti ti-refresh text-primary"></i>
                </button>
                <a href="vendors_companies.php?mode=add"
                    class="btn btn-primary d-flex align-items-center shadow-sm rounded-pill px-4 fw-bold">
                    <i class="ti ti-plus me-2"></i>Quick Action
                </a>
            </div>
        </div>

        <!-- Premium Stat Cards -->
        <div class="row g-4 mb-4">
            <!-- Total Companies -->
            <div class="col-xl-3 col-md-6">
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden stat-card h-100">
                    <div class="card-body p-4 position-relative z-1">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <div class="bg-soft-primary p-3 rounded-3">
                                <i class="ti ti-building-community fs-28 text-primary"></i>
                            </div>
                            <span class="badge bg-soft-success text-success rounded-pill px-3 py-1">Live</span>
                        </div>
                        <h6 class="text-muted mb-1 fw-medium">Total Companies</h6>
                        <h2 class="mb-0 fw-bold counter"><?php echo number_format($total_companies); ?></h2>
                        <div class="mt-3 d-flex align-items-center small">
                            <span class="text-success me-2 fw-bold"><i class="ti ti-trending-up me-1"></i>+12%</span>
                            <span class="text-muted">vs last month</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Active Insurance -->
            <div class="col-xl-3 col-md-6">
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden stat-card h-100">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <div class="bg-soft-info p-3 rounded-3">
                                <i class="ti ti-shield-check fs-28 text-info"></i>
                            </div>
                            <span class="badge bg-soft-info text-info rounded-pill px-3 py-1">Active</span>
                        </div>
                        <h6 class="text-muted mb-1 fw-medium">Insurance Policies</h6>
                        <h2 class="mb-0 fw-bold counter"><?php echo number_format($total_insurance); ?></h2>
                        <div class="mt-3 d-flex align-items-center small">
                            <span class="text-info me-2 fw-bold"><i
                                    class="ti ti-arrow-up-right me-1"></i><?php echo $total_ins_v; ?></span>
                            <span class="text-muted text-truncate">New Vehicle policies</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- DSC Applications -->
            <div class="col-xl-3 col-md-6">
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden stat-card h-100">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <div class="bg-soft-warning p-3 rounded-3">
                                <i class="ti ti-signature fs-28 text-warning"></i>
                            </div>
                            <span class="badge bg-soft-warning text-warning rounded-pill px-3 py-1">Pending</span>
                        </div>
                        <h6 class="text-muted mb-1 fw-medium">DSC Applications</h6>
                        <h2 class="mb-0 fw-bold counter"><?php echo number_format($total_dsc); ?></h2>
                        <div class="mt-3 d-flex align-items-center small">
                            <span class="text-warning me-2 fw-bold"><i class="ti ti-clock me-1"></i>High</span>
                            <span class="text-muted">priority queue</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total Consumers -->
            <div class="col-xl-3 col-md-6">
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden stat-card h-100">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <div class="bg-soft-purple p-3 rounded-3">
                                <i class="ti ti-users fs-28 text-purple"></i>
                            </div>
                            <span class="badge bg-soft-purple text-purple rounded-pill px-3 py-1">New</span>
                        </div>
                        <h6 class="text-muted mb-1 fw-medium">Total Consumers</h6>
                        <h2 class="mb-0 fw-bold counter"><?php echo number_format($total_consumers); ?></h2>
                        <div class="mt-3 d-flex align-items-center small">
                            <span class="text-purple me-2 fw-bold"><i class="ti ti-user-plus me-1"></i>Growth</span>
                            <span class="text-muted">increasing weekly</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-4 mb-4">
            <!-- Service Analytics Chart -->
            <div class="col-xl-8 col-lg-7">
                <div class="card border-0 shadow-sm rounded-4 h-100 overflow-hidden">
                    <div
                        class="card-header bg-white border-bottom-0 py-4 px-4 d-flex align-items-center justify-content-between">
                        <div>
                            <h5 class="fw-bold mb-0 text-dark">Business Overview</h5>
                            <p class="text-muted small mb-0">Comparative analysis of all major services</p>
                        </div>
                        <div class="dropdown">
                            <button class="btn btn-soft-secondary btn-sm rounded-pill px-3 dropdown-toggle"
                                type="button" data-bs-toggle="dropdown">
                                Current Year
                            </button>
                        </div>
                    </div>
                    <div class="card-body px-4 pb-4">
                        <div id="business-overview-chart" style="height: 380px;"></div>
                    </div>
                </div>
            </div>

            <!-- Service Distribution -->
            <div class="col-xl-4 col-lg-5">
                <div class="card border-0 shadow-sm rounded-4 h-100">
                    <div class="card-header bg-white border-bottom-0 py-4 px-4">
                        <h5 class="fw-bold mb-0 text-dark">Service Distribution</h5>
                        <p class="text-muted small mb-0">Market share by service category</p>
                    </div>
                    <div class="card-body px-4 pb-4">
                        <div id="service-donut-chart" style="height: 300px;"></div>
                        <div class="mt-4 pt-2">
                            <div
                                class="d-flex align-items-center justify-content-between mb-3 p-2 rounded-3 bg-light bg-opacity-50">
                                <span class="text-dark fw-medium d-flex align-items-center">
                                    <span class="dot bg-primary me-2"></span>Insurance
                                </span>
                                <span class="badge bg-primary rounded-pill"><?php echo $ins_per; ?>%</span>
                            </div>
                            <div
                                class="d-flex align-items-center justify-content-between mb-3 p-2 rounded-3 bg-light bg-opacity-50">
                                <span class="text-dark fw-medium d-flex align-items-center">
                                    <span class="dot bg-info me-2"></span>Compliance
                                </span>
                                <span class="badge bg-info rounded-pill"><?php echo $comp_per; ?>%</span>
                            </div>
                            <div
                                class="d-flex align-items-center justify-content-between p-2 rounded-3 bg-light bg-opacity-50">
                                <span class="text-dark fw-medium d-flex align-items-center">
                                    <span class="dot bg-warning me-2"></span>DSC & Others
                                </span>
                                <span class="badge bg-warning rounded-pill"><?php echo $dsc_per; ?>%</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Activity Table -->
        <div class="row">
            <div class="col-12">
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                    <div
                        class="card-header bg-white border-bottom-0 py-4 px-4 d-flex align-items-center justify-content-between">
                        <div>
                            <h5 class="fw-bold mb-0 text-dark">Recent Activity</h5>
                            <p class="text-muted small mb-0">Latest 5 insurance policy registrations</p>
                        </div>
                        <a href="insurance_vehicle.php" class="btn btn-soft-primary px-4 rounded-pill fw-bold">View
                            History</a>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="bg-light">
                                    <tr>
                                        <th class="ps-4 border-0">Client Name</th>
                                        <th class="border-0">Service Type</th>
                                        <th class="border-0">Policy No</th>
                                        <th class="border-0">Amount</th>
                                        <th class="border-0">Status</th>
                                        <th class="text-end pe-4 border-0">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $recent_tx = $ai_db->aiGetQueryObj("SELECT proposer_name, insurance_type as type, policy_no, gross_premium, status FROM tbl_insurance ORDER BY id DESC LIMIT 5");
                                    if (empty($recent_tx)) {
                                        echo '<tr><td colspan="6" class="text-center py-5 text-muted">No recent records found. Start adding policies to see them here.</td></tr>';
                                    } else {
                                        foreach ($recent_tx as $tx) {
                                            ?>
                                            <tr class="transition-all">
                                                <td class="ps-4">
                                                    <div class="d-flex align-items-center">
                                                        <div
                                                            class="avatar avatar-sm bg-soft-primary text-primary rounded-pill me-3 d-flex align-items-center justify-content-center fw-bold">
                                                            <?php echo strtoupper(substr($tx->proposer_name, 0, 1)); ?>
                                                        </div>
                                                        <span class="fw-bold text-dark"><?php echo $tx->proposer_name; ?></span>
                                                    </div>
                                                </td>
                                                <td><span class="badge bg-soft-info text-info border-0"><?php echo $tx->type; ?>
                                                        Insurance</span></td>
                                                <td class="text-muted small"><?php echo $tx->policy_no; ?></td>
                                                <td><span
                                                        class="fw-bold text-dark">₹<?php echo number_format($tx->gross_premium, 2); ?></span>
                                                </td>
                                                <td>
                                                    <?php if ($tx->status == 'active'): ?>
                                                        <span
                                                            class="badge bg-soft-success text-success px-3 rounded-pill">Active</span>
                                                    <?php else: ?>
                                                        <span
                                                            class="badge bg-soft-danger text-danger px-3 rounded-pill"><?php echo ucfirst($tx->status); ?></span>
                                                    <?php endif; ?>
                                                </td>
                                                <td class="text-end pe-4">
                                                    <button class="btn btn-icon btn-white border rounded-circle shadow-sm"><i
                                                            class="ti ti-eye text-muted"></i></button>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
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
        border-color: rgba(31, 79, 156, 0.2) !important;
    }

    .bg-soft-primary {
        background: rgba(31, 79, 156, 0.1);
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

    .bg-soft-purple {
        background: rgba(139, 92, 246, 0.1);
    }

    .text-purple {
        color: #8b5cf6;
    }

    .dot {
        height: 10px;
        width: 10px;
        border-radius: 50%;
        display: inline-block;
    }

    .transition-all {
        transition: all 0.2s ease;
    }

    .transition-all:hover {
        background-color: rgba(0, 0, 0, 0.01);
    }
</style>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        // Business Overview Chart (Area)
        var overviewOptions = {
            series: [{
                name: 'Insurance',
                data: [31, 40, 28, 51, 42, 109, 100]
            }, {
                name: 'Compliance',
                data: [11, 32, 45, 32, 34, 52, 41]
            }],
            chart: { height: 380, type: 'area', toolbar: { show: false }, fontFamily: 'Inter, sans-serif' },
            colors: ['#1f4f9c', '#0ea5e9'],
            dataLabels: { enabled: false },
            stroke: { curve: 'smooth', width: 2.5 },
            fill: { type: 'gradient', gradient: { shadeIntensity: 1, opacityFrom: 0.3, opacityTo: 0.05, stops: [0, 90, 100] } },
            xaxis: { categories: ["Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun"], axisBorder: { show: false } },
            grid: { borderColor: '#f1f1f1', strokeDashArray: 4 },
            legend: { position: 'top', horizontalAlign: 'right' }
        };
        new ApexCharts(document.querySelector("#business-overview-chart"), overviewOptions).render();

        // Service Donut Chart
        var donutOptions = {
            series: [<?php echo $ins_per; ?>, <?php echo $comp_per; ?>, <?php echo $dsc_per; ?>],
            chart: { type: 'donut', height: 300 },
            labels: ['Insurance', 'Compliance', 'DSC'],
            colors: ['#1f4f9c', '#0ea5e9', '#f59e0b'],
            plotOptions: { pie: { donut: { size: '75%', labels: { show: true, total: { show: true, label: 'Services', fontWeight: 600 } } } } },
            dataLabels: { enabled: false },
            legend: { show: false }
        };
        new ApexCharts(document.querySelector("#service-donut-chart"), donutOptions).render();
    });
</script>

<?php include 'includes/footer.php'; ?>