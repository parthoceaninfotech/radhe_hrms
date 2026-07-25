<?php
include 'root/config.php';
$ai_core->aiCheckLogin();

// --- CONFIGURATION ---
$page_nm = "SMTP Settings";
$config_file = 'root/config_smtp.php';
$redirection_url = "smtp_settings.php";

// Load current config
$smtp_config = include $config_file;

// --- HANDLE POST ACTIONS ---
if (isset($_POST['btn_submit'])) {
    $host = $_POST['host'];
    $port = $_POST['port'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $encryption = $_POST['encryption'];
    $from_email = $_POST['from_email'];
    $from_name = $_POST['from_name'];
    $reply_to = $_POST['reply_to'];

    $content = "<?php
return [
    'host' => '$host',
    'port' => $port,
    'username' => '$username',
    'password' => '$password',
    'encryption' => '$encryption',
    'from_email' => '$from_email',
    'from_name' => '$from_name',
    'reply_to' => '$reply_to',
];
?>";

    if (file_put_contents($config_file, $content)) {
        $_SESSION['success'] = "SMTP settings updated successfully!";
    } else {
        $_SESSION['error'] = "Failed to update SMTP settings. Check file permissions.";
    }
    $ai_core->aiGoPage($redirection_url);
}

include 'includes/header.php';
include 'includes/sidebar.php';
?>

<div class="page-wrapper">
    <div class="content">

        <div class="row justify-content-center">
            <div class="col-xl-12">
                <div class="form-header-bar">
                    <nav>
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                            <li class="breadcrumb-item active">SMTP Configuration</li>
                        </ol>
                    </nav>
                    <a href="dashboard.php" class="btn-back-standard">
                        <i class="ti ti-chevrons-left"></i> Back
                    </a>
                </div>

                <form action="smtp_settings.php" method="POST" class="needs-validation" novalidate>
                    <div class="form-card-standard">
                        <div class="mb-4 border-bottom pb-2">
                            <h5 class="fw-bold text-primary"><i class="ti ti-mail-cog me-2"></i>Email Server Details
                            </h5>
                            <p class="text-muted small">Configure your outgoing mail server settings here.</p>
                        </div>

                        <div class="row g-4">
                            <div class="col-md-9">
                                <label class="form-label">SMTP Host <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="ti ti-server"></i></span>
                                    <input type="text" name="host" class="form-control"
                                        value="<?php echo htmlspecialchars($smtp_config['host']); ?>"
                                        placeholder="e.g. smtp.gmail.com" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Port <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="ti ti-hash"></i></span>
                                    <input type="number" name="port" class="form-control"
                                        value="<?php echo htmlspecialchars($smtp_config['port']); ?>" placeholder="587"
                                        required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Username / Email <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="ti ti-user"></i></span>
                                    <input type="text" name="username" class="form-control"
                                        value="<?php echo htmlspecialchars($smtp_config['username']); ?>"
                                        placeholder="your-email@example.com" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Password / App Key <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="ti ti-lock"></i></span>
                                    <input type="password" name="password" class="form-control"
                                        value="<?php echo htmlspecialchars($smtp_config['password']); ?>"
                                        placeholder="••••••••••••" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Security Encryption</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="ti ti-shield-lock"></i></span>
                                    <select name="encryption" class="form-select">
                                        <option value="tls" <?php echo ($smtp_config['encryption'] == 'tls') ? 'selected' : ''; ?>>TLS (Recommended)</option>
                                        <option value="ssl" <?php echo ($smtp_config['encryption'] == 'ssl') ? 'selected' : ''; ?>>SSL</option>
                                        <option value="" <?php echo ($smtp_config['encryption'] == '') ? 'selected' : ''; ?>>None</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Display Name (From Name) <span
                                        class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="ti ti-id"></i></span>
                                    <input type="text" name="from_name" class="form-control"
                                        value="<?php echo htmlspecialchars($smtp_config['from_name']); ?>"
                                        placeholder="Radhe Advisory " required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Sender Email Address <span
                                        class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="ti ti-mail"></i></span>
                                    <input type="email" name="from_email" class="form-control"
                                        value="<?php echo htmlspecialchars($smtp_config['from_email']); ?>"
                                        placeholder="info@radheadvisory.com" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Reply-To Address</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="ti ti-message-reply"></i></span>
                                    <input type="email" name="reply_to" class="form-control"
                                        value="<?php echo htmlspecialchars($smtp_config['reply_to']); ?>"
                                        placeholder="support@radheadvisory.com">
                                </div>
                            </div>
                        </div>

                        <div class="form-action-btns">
                            <button type="submit" name="btn_submit" class="btn-submit-standard">
                                <i class="ti ti-device-floppy me-2"></i> Save Configuration
                            </button>
                            <a href="dashboard.php" class="btn-cancel-standard">Cancel</a>
                        </div>
                    </div>
                </form>

                <div class="card border-0 shadow-sm mt-4 bg-soft-info border-start border-info border-4">
                    <div class="card-body">
                        <h6 class="fw-bold text-info"><i class="ti ti-bulb me-2"></i>Quick Help & Settings:</h6>
                        <div class="row mt-3">
                            <div class="col-md-4">
                                <div class="p-2 border-end border-info-subtle">
                                    <p class="mb-1 fw-bold text-dark small">Gmail Settings</p>
                                    <ul class="mb-0 x-small text-muted ps-3">
                                        <li>Host: smtp.gmail.com</li>
                                        <li>Port: 587 (TLS)</li>
                                        <li>
                                            <a href="https://myaccount.google.com/apppasswords" target="_blank"
                                                class="text-primary fw-bold text-decoration-underline">
                                                <i class="ti ti-external-link"></i> Create App Password
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="p-2 border-end border-info-subtle">
                                    <p class="mb-1 fw-bold text-dark small">Outlook/O365</p>
                                    <ul class="mb-0 x-small text-muted ps-3">
                                        <li>Host: smtp.office365.com</li>
                                        <li>Port: 587 (STARTTLS)</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="p-2">
                                    <p class="mb-1 fw-bold text-dark small">Common Issues</p>
                                    <ul class="mb-0 x-small text-muted ps-3">
                                        <li>Check 2-Step Verification</li>
                                        <li>Firewall blocking port 587</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>