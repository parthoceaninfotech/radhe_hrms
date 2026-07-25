<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Meta Tags -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Admin Dashboard | Radhe Consultancy</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Radhe Consultancy">

    <!-- Favicon -->
    <link rel="shortcut icon" href="assets/logo/favicon.png">

    <!-- Apple Icon -->
    <link rel="apple-touch-icon" href="assets/img/apple-icon.png">

    <!-- Theme Config Js -->
    <script src="assets/js/theme-script.js"></script>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">

    <!-- Datetimepicker CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap-datetimepicker.min.css">

    <!-- Daterangepikcer CSS -->
    <link rel="stylesheet" href="assets/plugins/daterangepicker/daterangepicker.css">

    <!-- Fontawesome CSS -->
    <link rel="stylesheet" href="assets/plugins/fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="assets/plugins/fontawesome/css/all.min.css">

    <!-- Tabler Icon CSS -->
    <link rel="stylesheet" href="assets/plugins/tabler-icons/tabler-icons.min.css">

    <!-- Simplebar CSS -->
    <link rel="stylesheet" href="assets/plugins/simplebar/simplebar.min.css">

    <!-- Select2 CSS -->
    <link rel="stylesheet" href="assets/plugins/select2/css/select2.min.css">

    <!-- Main CSS -->
    <link rel="stylesheet" href="assets/css/style.css" id="app-style">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="assets/css/custom.css">

    <!-- Toastr CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">


    <!-- Preloader CSS -->
    <style>
        #preloader {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(255, 255, 255, 0.6);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            z-index: 9999999;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: opacity 0.5s ease, visibility 0.5s ease;
        }

        [data-bs-theme=dark] #preloader {
            background-color: rgba(3, 4, 26, 0.6);
        }

        .loader-wrapper {
            width: 90px;
            height: 90px;
            display: flex;
            align-items: center;
            justify-content: center;
            filter: drop-shadow(0 0 12px rgba(0, 123, 255, 0.35));
        }

        .loader-svg {
            width: 100%;
            height: 100%;
            animation: loader-rotate 2s linear infinite;
        }

        .loader-circle {
            fill: none;
            stroke: #2269e5;
            stroke-width: 10;
            stroke-linecap: round;
            stroke-dasharray: 1, 200;
            stroke-dashoffset: 0;
            animation: loader-dash 1.5s ease-in-out infinite;
        }

        @keyframes loader-rotate {
            100% {
                transform: rotate(360deg);
            }
        }

        @keyframes loader-dash {
            0% {
                stroke-dasharray: 1, 200;
                stroke-dashoffset: 0;
            }

            50% {
                stroke-dasharray: 90, 200;
                stroke-dashoffset: -35;
            }

            100% {
                stroke-dasharray: 90, 200;
                stroke-dashoffset: -124;
            }
        }

        body.loaded #preloader {
            opacity: 0;
            visibility: hidden;
        }
    </style>
</head>

<body class="loading">

    <!-- Preloader -->
    <div id="preloader">
        <div class="loader-wrapper">
            <svg class="loader-svg" viewBox="0 0 100 100">
                <circle class="loader-circle" cx="50" cy="50" r="40"></circle>
            </svg>
        </div>
    </div>

    <script>
        window.addEventListener('load', function () {
            setTimeout(function () {
                document.body.classList.add('loaded');
                document.body.classList.remove('loading');
            }, 300); // Small delay for smoothness
        });
    </script>

    <!-- Main Wrapper -->
    <div class="main-wrapper">
        <div class="sidebar-overlay" id="sidebar_overlay"></div>

        <?php
        // Check mode (Consultancy or Advisory)
        $current_file = basename($_SERVER['PHP_SELF']);
        $advisory_files = ['advisory_dashboard.php', 'factory_act_quotation.php', 'factory_act_renewal.php', 'plan_management.php', 'stability_management.php', 'plan_maker_dashboard.php'];
        $is_advisory_mode = (strpos($current_file, 'advisory_') !== false) || in_array($current_file, $advisory_files);

        // Fetch User Role
        $user_role = $_SESSION['role'] ?? '';

        // Fetch Global Settings
        $settings_res = $ai_db->aiGetQueryObj("SELECT * FROM tbl_settings");
        $sys_settings = [];
        foreach ($settings_res as $s) {
            $sys_settings[$s->meta_key] = $s->meta_value;
        }

        $sys_logo = $sys_settings['logo'] ?? '';
        $sys_name = $is_advisory_mode ? 'RADHE ADVISORY' : ($sys_settings['site_name'] ?? 'RADHE CONSULTANCY');

        // Fetch Current User Data
        $admin_id = $_SESSION['id'] ?? 0;
        $user_type = $_SESSION['user_type'] ?? 'admin';
        if ($user_type === 'admin') {
            $admin_data = $ai_db->aiGetQueryObj("SELECT * FROM tbl_admin WHERE id='$admin_id' LIMIT 1")[0] ?? null;
            $user_display_name = $admin_data->username ?? 'Admin';
            $user_email = $admin_data->email ?? $_SESSION['email'] ?? 'admin@example.com';
            $admin_pic = ($admin_data && $admin_data->profile_pic) ? 'assets/img/profiles/' . $admin_data->profile_pic : 'assets/img/users/user-01.jpg';
        } else {
            $admin_data = $ai_db->aiGetQueryObj("SELECT * FROM tbl_users WHERE id='$admin_id' LIMIT 1")[0] ?? null;
            $user_display_name = $admin_data->name ?? $admin_data->username ?? 'User';
            $user_email = $admin_data->email ?? $_SESSION['email'] ?? 'user@example.com';
            $admin_pic = ($admin_data && $admin_data->logo) ? 'assets/img/profiles/' . $admin_data->logo : 'assets/img/users/user-01.jpg';
        }
        ?>
        <!-- Topbar Start -->
        <header class="navbar-header">
            <div class="topbar-inner d-flex align-items-center justify-content-between w-100 px-4">
                <div class="d-flex align-items-center gap-3">

                    <!-- Sidebar Toggle Button (Desktop) -->
                    <button class="sidenav-toggle-btn d-none d-lg-flex" id="toggle_btn">
                        <i class="ti ti-menu-2 fs-22"></i>
                    </button>

                    <!-- Mobile Logo -->
                    <div class="logo d-lg-none d-flex align-items-center">
                        <span
                            class="fw-bold text-white fs-20"><?php echo $is_advisory_mode ? 'ADVISORY' : 'RADHE'; ?></span>
                    </div>

                    <!-- Sidebar Mobile Toggle -->
                    <a id="mobile_btn" class="mobile-btn d-lg-none" href="#sidebar">
                        <i class="ti ti-menu-deep fs-24"></i>
                    </a>

                    <!-- Plan Maker Title / Search Bar -->
                    <?php if ($user_role === 'Plan Maker'): ?>
                        <div class="ms-2">
                            <h4 class="mb-0 text-white fw-bold">My Assigned Plans</h4>
                        </div>
                    <?php else: ?>
                        <div class="header-search d-none d-lg-block position-relative">
                            <!-- <span class="position-absolute top-50 start-0 translate-middle-y ms-3 text-muted">
                                <i class="ti ti-search fs-18"></i>
                            </span> -->
                            <!-- <input type="text" class="form-control" placeholder="Search anything..."> -->
                        </div>
                    <?php endif; ?>
                </div>

                <div class="d-flex align-items-center gap-3">
                    <!-- Company Switcher & HRMS Buttons -->
                    <?php if ($user_role !== 'Plan Maker'): ?>
                        <div class="d-flex align-items-center gap-2">
                            <!-- HRMS Button -->
                            <div class="header-item d-none d-md-block">
                                <a href="hrms/" class="btn-advisory"
                                    style="background: linear-gradient(135deg, #FF512F 0%, #DD2476 100%); box-shadow: 0 4px 15px rgba(221, 36, 118, 0.25);">
                                    <i class="ti ti-users"></i>
                                    <span>HRMS</span>
                                </a>
                            </div>

                            <!-- <?php if ($is_advisory_mode): ?>
                        <div class="header-item d-none d-md-block">
                            <a href="dashboard.php" class="btn-advisory btn-consultancy-toggle">
                                <i class="ti ti-briefcase"></i>
                                <span>Radhe Consultancy</span>
                            </a>
                        </div>
                        <?php else: ?> -->
                                <!-- <div class="header-item d-none d-md-block">
                                    <a href="advisory_dashboard.php" class="btn-advisory">
                                        <i class="ti ti-building-skyscraper"></i>
                                        <span>Radhe Advisory</span>
                                    </a>
                                </div> -->
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>

                    <!-- Light/Dark Mode Toggle -->
                    <div class="header-item">
                        <a href="javascript:void(0);" id="light-dark-mode" class="topbar-link">
                            <i class="ti ti-moon fs-22 dark-mode-active"></i>
                            <i class="ti ti-sun fs-22 light-mode-active"></i>
                        </a>
                    </div>

                    <!-- User Profile -->
                    <div class="dropdown">
                        <div class="user-info dropdown-toggle drop-arrow-none" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <div class="text-end d-none d-md-block">
                                <p class="user-name mb-0"><?php echo htmlspecialchars($user_display_name); ?></p>
                                <p class="user-role mb-0">
                                    <?php echo htmlspecialchars(($user_type === 'admin') ? 'Administrator' : ($user_role ?: 'User')); ?>
                                </p>
                            </div>
                            <div class="position-relative">
                                <img src="<?php echo $admin_pic; ?>" class="rounded-circle border shadow-sm" width="40"
                                    height="40" style="object-fit: cover;">
                                <span
                                    class="position-absolute bottom-0 end-0 bg-success border border-white border-2 rounded-circle"
                                    style="width: 12px; height: 12px;"></span>
                            </div>
                        </div>
                        <div class="dropdown-menu dropdown-menu-end shadow-lg border-0 p-2 mt-2"
                            style="border-radius: 16px; min-width: 200px;">
                            <div class="p-3 border-bottom mb-2">
                                <p class="fw-bold text-dark mb-0"><?php echo htmlspecialchars($user_display_name); ?></p>
                                <p class="small text-muted mb-0"><?php echo htmlspecialchars($user_email); ?></p>
                            </div>
                            <a class="dropdown-item rounded-3 py-2" href="profile.php"><i
                                    class="ti ti-user-circle me-2 text-primary fs-18"></i>My Profile</a>
                            <a class="dropdown-item rounded-3 py-2" href="settings.php"><i
                                    class="ti ti-settings me-2 text-info fs-18"></i>Settings</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item rounded-3 py-2 text-danger" href="logout.php"><i
                                    class="ti ti-logout me-2 fs-18"></i>Logout</a>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- Topbar End -->

        <script>
            // Automatically clean URL parameters (like ?msg=1) after Toastr has shown
            window.addEventListener('load', function () {
                setTimeout(function () {
                    const url = new URL(window.location);
                    let changed = false;
                    if (url.searchParams.has('msg')) { url.searchParams.delete('msg'); changed = true; }
                    if (url.searchParams.has('send_auto_id')) { url.searchParams.delete('send_auto_id'); changed = true; }
                    if (changed) window.history.replaceState({}, document.title, url.pathname + url.search);
                }, 1500); // 1.5 seconds delay
            });
        </script>