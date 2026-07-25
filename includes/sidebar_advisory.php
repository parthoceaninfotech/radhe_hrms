<?php
$current_page = basename($_SERVER['PHP_SELF']);

// --- PERMISSION SYSTEM ---
$user_type = $_SESSION['user_type'] ?? '';
$user_role = $_SESSION['role'] ?? '';
$user_perms = [];

if ($user_type !== 'admin' && !empty($user_role)) {
    $role_data = $ai_db->aiGetQueryObj("SELECT permissions FROM tbl_roles WHERE role_name = '$user_role' AND status = 'active' LIMIT 1");
    if (!empty($role_data)) {
        $user_perms = json_decode($role_data[0]->permissions, true) ?: [];
    }
}

if (!function_exists('hasPerm')) {
    function hasPerm($module, $action = 'view')
    {
        global $user_type, $user_perms;
        if ($user_type === 'admin')
            return true;
        return isset($user_perms[$module]) && in_array($action, $user_perms[$module]);
    }
}
?>

<style>
    .premium-logo {
        filter: drop-shadow(0 0 10px rgba(255, 255, 255, 0.15));
        transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        animation: pulsate 3s infinite ease-in-out;
    }

    @keyframes pulsate {
        0% {
            transform: scale(1);
            filter: drop-shadow(0 0 8px rgba(59, 130, 246, 0.2));
        }

        50% {
            transform: scale(1.01);
            filter: drop-shadow(0 0 15px rgba(59, 130, 246, 0.4));
        }

        100% {
            transform: scale(1);
            filter: drop-shadow(0 0 8px rgba(59, 130, 246, 0.2));
        }
    }

    .sidebar-logo:hover .premium-logo {
        transform: scale(1.05);
        filter: drop-shadow(0 0 20px rgba(59, 130, 246, 0.6));
        animation: none;
    }
</style>
<!-- Sidenav Menu Start -->
<div class="sidebar" id="sidebar">
    <?php
    // Fetch Global Settings for Sidebar
    $side_settings_res = $ai_db->aiGetQueryObj("SELECT * FROM tbl_settings");
    $side_settings = [];
    foreach ($side_settings_res as $s) {
        $side_settings[$s->meta_key] = $s->meta_value;
    }
    $side_logo = $side_settings['logo'] ?? '';
    ?>
    <!-- Start Logo -->
    <div class="sidebar-logo d-flex align-items-center justify-content-center px-4"
        style="height: 150px; border-bottom: 1px solid rgba(255, 255, 255, 0.08); background: inherit !important; transition: all 0.3s ease;">
        <a href="advisory_dashboard.php" class="logo-link d-flex align-items-center justify-content-center w-100">
            <div class="logo-text d-flex flex-column align-items-center w-100">
                <img src="assets/logo/radheadvisory-dark.png" class="side-logo-img logo-dark-mode premium-logo"
                    style="max-height: 130px; width: auto; max-width: 100%; object-fit: contain;">
                <img src="assets/logo/radheadvisory-white.png" class="side-logo-img logo-light-mode premium-logo"
                    style="max-height: 130px; width: auto; max-width: 100%; object-fit: contain;">
            </div>
        </a>
    </div>
    <!-- End Logo -->

    <!-- Sidenav Menu Start -->
    <div class="sidebar-inner" data-simplebar style="padding-top: 100px;">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <li class="menu-title"><span>Main Menu</span></li>
                <?php if ($user_role !== 'Plan Maker'): ?>
                    <li class="menu-title"><span>Advisory Menu</span></li>

                    <!-- 1. Advisory Dashboard -->
                    <li>
                        <a href="advisory_dashboard.php"
                            class="<?= ($current_page == 'advisory_dashboard.php') ? 'active' : '' ?>">
                            <i class="ti ti-layout-dashboard"></i><span>Advisory Dashboard</span>
                        </a>
                    </li>

                    <li class="menu-title"><span>Compliance Services</span></li>

                    <!-- 2. Factory ACT Quotation -->
                    <li>
                        <a href="factory_act_quotation.php"
                            class="<?= ($current_page == 'factory_act_quotation.php') ? 'active' : '' ?>">
                            <i class="ti ti-file-invoice"></i><span>Factory ACT Quotation</span>
                        </a>
                    </li>

                    <!-- 2.1 Factory Fee Master -->
                    <!-- <li>
                        <a href="factory_fee_master.php"
                            class="<?= ($current_page == 'factory_fee_master.php') ? 'active' : '' ?>">
                            <i class="ti ti-settings"></i><span>Factory Fee Master</span>
                        </a>
                    </li> -->
                <?php endif; ?>

                <!-- 2.1 Plan Maker Dashboard (Task Queue) - hidden only as requested -->
                <li style="display: none;">
                    <a href="plan_maker_dashboard.php"
                        class="<?= ($current_page == 'plan_maker_dashboard.php') ? 'active' : '' ?>">
                        <i class="ti ti-list-check"></i><span>My Task Queue (Plan Maker)</span>
                    </a>
                </li>

                <?php if ($user_role !== 'Plan Maker'): ?>
                    <!-- 3. Factory ACT Renewal -->
                    <li>
                        <a href="factory_act_renewal.php"
                            class="<?= ($current_page == 'factory_act_renewal.php') ? 'active' : '' ?>">
                            <i class="ti ti-refresh"></i><span>Factory ACT Renewal</span>
                        </a>
                    </li>

                    <!-- 4. Plan Management -->
                    <li style="display: none;">
                        <a href="plan_management.php"
                            class="<?= ($current_page == 'plan_management.php') ? 'active' : '' ?>">
                            <i class="ti ti-map-pin"></i><span>Plan Management</span>
                        </a>
                    </li>

                    <!-- 5. Stability Management -->
                    <li>
                        <a href="stability_management.php"
                            class="<?= ($current_page == 'stability_management.php') ? 'active' : '' ?>">
                            <i class="ti ti-building-bridge"></i><span>Stability Management</span>
                        </a>
                    </li>

                    <?php if (hasPerm('settings')): ?>
                        <li class="submenu">
                            <a href="javascript:void(0);" class="<?= ($current_page == 'smtp_settings.php') ? 'active' : '' ?>">
                                <i class="ti ti-settings-cog"></i><span>Configuration</span>
                                <span class="menu-arrow"></span>
                            </a>
                            <ul>
                                <li><a href="smtp_settings.php"
                                        class="<?= ($current_page == 'smtp_settings.php') ? 'active' : '' ?>">SMTP Settings</a>
                                </li>
                            </ul>
                        </li>
                    <?php endif; ?>

                    <!-- Switch Back Button -->
                    <li class="mt-2">
                        <a href="dashboard.php"
                            class="bg-primary text-white mx-3 rounded-pill py-2 px-4 justify-content-center"
                            style="margin: 0 20px !important;">
                            <i class="ti ti-arrow-left text-white me-2" style="margin-right: 5px !important;"></i>
                            <span>Back to Consultancy</span>
                        </a>
                    </li>
                <?php endif; ?>

            </ul>
        </div>
    </div>
    <!-- Sidenav Menu End -->
</div>
<!-- Sidenav Menu End -->