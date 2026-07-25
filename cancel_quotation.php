<?php
include 'root/config.php';
require_once 'root/ai_core/class.mailer.php';

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$hash = $_GET['hash'] ?? '';

if ($id && $hash === md5($id . "radhe_secret")) {
    $table = "tbl_factory_quotations";

    // Check if already processed
    $check = $ai_db->aiGetQueryObj("SELECT * FROM $table WHERE id='$id' LIMIT 1");
    if (!$check) {
        die("Invalid Quotation ID.");
    }

    $data = $check[0];

    if ($data->client_approval_status === 'Cancelled by Client') {
        $msg = "This quotation has already been cancelled.";
        $status_type = "warning";
    } elseif ($data->client_approval_status === 'Approved by Client') {
        $msg = "This quotation was already approved. If you wish to change your decision, please contact us.";
        $status_type = "info";
    } else {
        // Update Status
        $ai_db->aiQuery("UPDATE $table SET client_approval_status='Cancelled by Client', mail_status='send' WHERE id='$id'");

        // Notify Radhe Advisory
        $mailer = new RadheMailer();
        $config = include 'root/config_smtp.php';

        $subject = "Quotation CANCELLED by Client: " . $data->company_name;
        $message = "
            <div style='font-family: Arial, sans-serif; padding: 20px; border: 1px solid #f8d7da; border-radius: 8px;'>
                <h3 style='color: #721c24;'>Quotation Cancelled</h3>
                <p><strong>Company:</strong> " . $data->company_name . "</p>
                <p><strong>Quotation No:</strong> " . $data->quotation_no . "</p>
                <p><strong>Status:</strong> Cancelled by Client</p>
                <p>The client has declined the quotation.</p>
            </div>
        ";
        $mailer->sendMail($config['from_email'], $subject, $message);

        $msg = "Quotation Cancelled Successfully. Thank you for your feedback.";
        $status_type = "success";
    }
} else {
    die("Invalid request.");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quotation Status | Radhe Advisory</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700&display=swap"
        rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #fff1f2 0%, #fee2e2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Plus Jakarta Sans', sans-serif;
            margin: 0;
            padding: 20px;
        }

        .main-card {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            border-radius: 30px;
            padding: 60px 40px;
            box-shadow: 0 25px 50px -12px rgba(239, 68, 68, 0.1);
            max-width: 550px;
            width: 100%;
            text-align: center;
            border: 1px solid rgba(255, 255, 255, 0.3);
            animation: slideUp 0.8s cubic-bezier(0.16, 1, 0.3, 1);
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .icon-container {
            width: 100px;
            height: 100px;
            background: #ef4444;
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 50px;
            margin: 0 auto 30px;
            box-shadow: 0 10px 25px rgba(239, 68, 68, 0.3);
            animation: scaleIn 0.5s cubic-bezier(0.34, 1.56, 0.64, 1) 0.2s both;
        }

        @keyframes scaleIn {
            from {
                transform: scale(0);
            }

            to {
                transform: scale(1);
            }
        }

        h1 {
            font-weight: 800;
            color: #991b1b;
            margin-bottom: 15px;
            font-size: 32px;
        }

        p {
            color: #7f1d1d;
            font-size: 18px;
            line-height: 1.6;
            margin-bottom: 40px;
            opacity: 0.8;
        }

        .branding {
            border-top: 1px solid #fecaca;
            padding-top: 30px;
        }

        .firm-name {
            font-weight: 700;
            color: #ef4444;
            font-size: 16px;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        .firm-tagline {
            color: #991b1b;
            font-size: 12px;
            margin-top: 5px;
            opacity: 0.6;
        }
    </style>
</head>

<body>
    <div class="main-card">
        <div class="icon-container">✕</div>
        <h1>Status Updated</h1>
        <p><?php echo $msg; ?></p>
        <div class="branding">
            <div class="firm-name">Radhe Advisory </div>
            <div class="firm-tagline">Strategic Industrial Compliance Partners</div>
        </div>
    </div>
</body>

</html>