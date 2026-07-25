<?php
include_once 'root/config.php';
$ai_core->aiCheckLogin();

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
if (!$id) {
    echo "Invalid Request";
    exit;
}

$data = $ai_db->aiGetQueryObj("SELECT * FROM tbl_factory_quotations WHERE id='$id' LIMIT 1")[0] ?? null;

if (!$data) {
    echo "Quotation not found";
    exit;
}

// Fetch Settings for Logo and Company Name
$settings_res = $ai_db->aiGetQueryObj("SELECT * FROM tbl_settings");
$sys_settings = [];
foreach ($settings_res as $s) {
    $sys_settings[$s->meta_key] = $s->meta_value;
}

$logo = $sys_settings['logo'] ?? 'assets/logo/radheadvisory.png';
$site_name = "RADHE ADVISORY";

// Calculate Additional Charges
$additional_charges = (float) $data->admin_charge + (float) $data->consultancy_fees + (float) $data->plan_charge + (float) $data->stability_cert_amount + (float) $data->excess_fees;

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quotation - <?php echo $data->quotation_no; ?></title>
    <style>
        @page {
            size: A4;
            margin: 0;
        }

        html {
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'DejaVu Sans', Helvetica, Arial, sans-serif;
            color: #1a1f2e;
            line-height: 1.4;
            margin: 10mm;
            padding: 0;
            background: #fff;
        }

        .container {
            width: 100%;
            margin: 0;
            padding: 0;
            background: #fff;
            border: 2px solid #1e3a8a !important;
            height: auto;
            min-height: 275mm;
            position: relative;
        }

        .container-content {
            padding: 20px;
        }

        /* Use Table for Header to ensure stability in Dompdf */
        .header-table {
            width: 100%;
            margin-bottom: 15px;
            padding-bottom: 10px;
        }

        .logo-section {
            width: 50%;
            text-align: left;
            vertical-align: middle;
            border: none !important;
        }

        .logo-section img {
            max-width: 220px;
            height: auto;
        }

        .our-details {
            width: 50%;
            text-align: right;
            vertical-align: middle;
            border: none !important;
        }

        .our-details h2 {
            margin: 0 0 5px 0;
            font-size: 18px;
            font-weight: bold;
            color: #1e3a8a;
        }

        .our-details p {
            margin: 1px 0;
            font-size: 11px;
            color: #475569;
        }

        .info-grid {
            width: 100%;
            margin-bottom: 15px;
            border-collapse: collapse;
        }

        .info-box {
            padding: 8px 12px;
            width: 50%;
            /* border-left: 3px solid #1e3a8a !important; */
            vertical-align: top;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }

        .label {
            font-weight: bold;
            font-size: 10px;
            text-transform: uppercase;
            color: #64748b;
            display: block;
            margin-bottom: 3px;
        }

        .value {
            font-size: 13px;
            color: #1e293b;
            font-weight: bold;
            display: block;
        }

        .section-title {
            font-size: 15px;
            font-weight: bold;
            margin-bottom: 8px;
            color: #1e3a8a !important;
            /* border-left: 4px solid #1e3a8a !important; */
            padding-left: 8px;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }

        table.items-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }

        th {
            background-color: #1e3a8a !important;
            color: #ffffff !important;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
            font-weight: bold;
            text-transform: uppercase;
            font-size: 11px;
            padding: 10px;
            text-align: left;
            border: 1px solid #1e3a8a !important;
        }

        td {
            border: 1px solid #cbd5e1;
            padding: 8px 10px;
            text-align: left;
            font-size: 12px;
            color: #334155;
        }

        /* Border overrides for layout structure */
        .header-table td {
            border: none !important;
        }

        .items-table tfoot td.no-border {
            border: none !important;
        }

        tr.even {
            background-color: #f1f5f9;
        }

        .total-label {
            text-align: right;
            font-weight: bold;
            color: #1e3a8a;
            font-size: 13px;
            padding: 10px;
        }

        .total-value {
            background-color: #1e3a8a !important;
            color: #ffffff !important;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
            font-weight: bold;
            text-align: right;
            font-size: 15px;
            padding: 10px;
            border: 1px solid #1e3a8a !important;
        }

        .footer-section {
            margin-top: 15px;
            padding-top: 10px;
            border-top: 1px solid #cbd5e1;
        }

        .terms h3 {
            font-size: 11px;
            font-weight: bold;
            margin-bottom: 5px;
            color: #1e3a8a;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .terms p {
            font-size: 10px;
            margin: 2px 0;
            color: #64748b;
            line-height: 1.4;
        }

        .signature-table {
            width: 100%;
            margin-top: 20px;
        }

        .sig-box {
            width: 100%;
            text-align: left;
        }

        .sig-line {
            border-top: 1px solid #1e293b;
            width: 200px;
            margin-top: 30px;
            padding-top: 5px;
            font-size: 11px;
            font-weight: bold;
        }

        .thank-you {
            text-align: center;
            margin-top: 15px;
            font-size: 16px;
            font-weight: bold;
            color: #1e3a8a;
        }

        @media print {
            .btn-print {
                display: none;
            }

            .container {
                padding: 0;
            }
        }

        .btn-print {
            position: fixed;
            top: 20px;
            right: 20px;
            padding: 10px 20px;
            background: #1e3a8a;
            color: #fff;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-weight: bold;
            z-index: 100;
        }
    </style>
</head>

<body>
    <?php if (!isset($is_inclusion)): ?>
        <button class="btn-print" onclick="window.print()">Print Quotation</button>
    <?php endif; ?>

    <div class="container">
        <div class="container-content">
            <table class="header-table" style="border:none;">
                <tr>
                    <td class="logo-section" style="border:none;">
                        <img src="<?php echo $logo; ?>" alt="Logo">
                    </td>
                    <td class="our-details" style="border:none;">
                        <h2>Our Details</h2>
                        <p>RADHE ADVISORY</p>
                        <p>LABOUR LAW CONSULTANT</p>
                        <p>Email: radheconsultancy17@yahoo.com</p>
                        <p>Phone: +91-9913014516, +91-85111172645</p>
                    </td>
                </tr>
            </table>

            <table class="info-grid">
                <tr>
                    <td class="info-box">
                        <span class="label">COMPANY NAME</span>
                        <span class="value"><?php echo $data->company_name; ?></span>
                    </td>
                    <td class="info-box">
                        <span class="label">QUOTATION DATE</span>
                        <span class="value"><?php echo date('d/m/Y', strtotime($data->created_at)); ?></span>
                    </td>
                </tr>
                <tr>
                    <td class="info-box">
                        <span class="label">COMPANY ADDRESS</span>
                        <span class="value"><?php echo $data->address; ?></span>
                    </td>
                    <td class="info-box">
                        <span class="label">QUOTATION NUMBER</span>
                        <span class="value"><?php echo $data->quotation_no; ?></span>
                    </td>
                </tr>
            </table>

            <div class="section-title">Service Breakdown</div>
            <table class="items-table">
                <thead>
                    <tr>
                        <th style="width: 50px; text-align: center;">Sr. No.</th>
                        <th>Particular</th>
                        <th style="text-align: center;">No of Workers</th>
                        <th style="text-align: center;">Horse Power</th>
                        <th style="text-align: center;">Year</th>
                        <?php if (isset($_SESSION['user_type']) && $_SESSION['user_type'] === 'admin'): ?>
                            <th style="text-align: right;">Total</th>
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="text-align: center;">1</td>
                        <td style="font-weight: bold;">Factory License Fees</td>
                        <td style="text-align: center;"><?php echo $data->num_workers; ?></td>
                        <td style="text-align: center;"><?php echo $data->horse_power; ?> HP</td>
                        <td style="text-align: center;"><?php echo $data->years_multiplier; ?> Year(s)</td>
                        <?php if (isset($_SESSION['user_type']) && $_SESSION['user_type'] === 'admin'): ?>
                            <td style="text-align: right;"><?php echo number_format($data->calc_amount, 2); ?></td>
                        <?php endif; ?>
                    </tr>
                    <?php if ($additional_charges > 0): ?>
                        <tr class="even">
                            <td style="text-align: center;">2</td>
                            <td style="font-weight: bold;">Additional Charges</td>
                            <td style="text-align: center;">-</td>
                            <td style="text-align: center;">-</td>
                            <td style="text-align: center;">-</td>
                            <?php if (isset($_SESSION['user_type']) && $_SESSION['user_type'] === 'admin'): ?>
                                <td style="text-align: right;"><?php echo number_format($additional_charges, 2); ?></td>
                            <?php endif; ?>
                        </tr>
                    <?php endif; ?>
                </tbody>
                <?php if (isset($_SESSION['user_type']) && $_SESSION['user_type'] === 'admin'): ?>
                    <tfoot>
                        <tr>
                            <td colspan="4" class="no-border"></td>
                            <td class="total-label">Total Amount</td>
                            <td class="total-value">
                                &#8377;<?php echo number_format($data->total_amount, 2); ?>
                            </td>
                        </tr>
                    </tfoot>
                <?php endif; ?>
            </table>

            <div class="footer-section">
                <div class="terms">
                    <h3>Terms & Conditions:</h3>
                    <p>• GST will be charged as applicable</p>
                    <p>• Standard government fees are subject to change as per notification</p>
                    <p>• This is a computer-generated quotation and does not require a physical signature</p>
                </div>

                <table class="signature-table" style="width: 100%; border-collapse: collapse; margin-top: 15px;">
                    <tr>
                        <td style="padding: 15px;">
                            <div class="sig-box">
                                <div class="sig-line">Authorized Signatory</div>
                                <p style="font-size: 10px; color: #64748b; margin-top: 5px;">RADHE ADVISORY</p>
                            </div>
                        </td>
                    </tr>
                </table>

                <div class="thank-you" style="border-top: 1px dashed #cbd5e1; padding-top: 10px; margin-top: 15px;">
                    Thank You for Your Business!
                </div>
            </div>
        </div>
    </div>
    <script>
        // Auto-trigger print dialog after page load
        window.onload = function () {
            setTimeout(function () {
                window.print();
            }, 500);
        };
    </script>
</body>

</html>