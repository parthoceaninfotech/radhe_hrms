<?php
require_once('../root/config.php');
header('Content-Type: application/json');

$action = isset($_GET['action']) ? $_GET['action'] : '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($action === 'test_mail') {
        $to = isset($_GET['to']) ? trim($_GET['to']) : '';
        if (empty($to)) {
            echo json_encode(['status' => 'error', 'message' => 'Recipient email is required.']);
            exit;
        }
        if (!filter_var($to, FILTER_VALIDATE_EMAIL)) {
            echo json_encode(['status' => 'error', 'message' => 'Invalid recipient email format: ' . htmlspecialchars($to)]);
            exit;
        }

        $sender_mail = isset($_POST['sender_mail']) ? $_POST['sender_mail'] : '';
        $mail_server = isset($_POST['mail_server']) ? $_POST['mail_server'] : '';
        $mail_port = isset($_POST['mail_port']) ? intval($_POST['mail_port']) : 25;
        $mail_ssl = isset($_POST['mail_ssl']) ? true : false;
        $mail_username = isset($_POST['mail_username']) ? $_POST['mail_username'] : '';
        $mail_password = isset($_POST['mail_password']) ? $_POST['mail_password'] : '';

        require_once('../root/include/class.phpmailer.php');
        require_once('../root/include/class.smtp.php');

        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = $mail_server;
        $mail->Port = $mail_port;
        $mail->SMTPAuth = !empty($mail_username);
        $mail->Username = $mail_username;
        $mail->Password = $mail_password;
        if ($mail_ssl) {
            $mail->SMTPSecure = 'ssl';
        } else {
            $mail->SMTPSecure = '';
        }
        $mail->From = $sender_mail;
        $mail->FromName = "HRMS Test Connection";
        $mail->addAddress($to);
        $mail->isHTML(true);
        $mail->Subject = "HRMS SMTP Settings Test";
        $mail->Body = "<h3>SMTP Configuration Verification Success!</h3><p>Your mail server settings are configured correctly in the HRMS System!</p>";

        if ($mail->send()) {
            echo json_encode(['status' => 'success', 'message' => 'Test email sent successfully to ' . $to]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'SMTP Error: ' . $mail->ErrorInfo]);
        }
        exit;
    }
}

echo json_encode(['status' => 'error', 'message' => 'Invalid action or request method.']);
exit;
