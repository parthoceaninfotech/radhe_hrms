<?php
require_once('../root/config.php');
global $ai_db;
global $ai_conn;

header('Content-Type: application/json');

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['id']) || $_SESSION['id'] == '') {
    echo json_encode(['status' => 'error', 'message' => 'User not logged in.']);
    exit;
}

$user_id = $_SESSION['id'];
$user_type = $_SESSION['user_type'] ?? '';
$table = ($user_type === 'admin') ? "tbl_admin" : "tbl_users";

$old_password = $_POST['old_password'] ?? '';
$new_password = $_POST['new_password'] ?? '';

if (empty($old_password) || empty($new_password)) {
    echo json_encode(['status' => 'error', 'message' => 'All password fields are required.']);
    exit;
}

// Fetch current user details to check old password
$user_res = $ai_db->aiGetQuery("SELECT * FROM $table WHERE id = " . intval($user_id));

if (count($user_res) === 0) {
    echo json_encode(['status' => 'error', 'message' => 'User not found.']);
    exit;
}

$db_password = $user_res[0]['password'];
$md5_old = md5($old_password);

if ($db_password !== $md5_old) {
    echo json_encode(['status' => 'error', 'message' => 'Incorrect old password.']);
    exit;
}

$md5_new = md5($new_password);

if ($table === 'tbl_users') {
    $sql = "UPDATE tbl_users SET password = '$md5_new', cp_pass = '" . mysqli_real_escape_string($ai_conn, $new_password) . "' WHERE id = " . intval($user_id);
} else {
    $sql = "UPDATE tbl_admin SET password = '$md5_new' WHERE id = " . intval($user_id);
}

$result = $ai_db->aiQuery($sql);
if ($result) {
    echo json_encode(['status' => 'success', 'message' => 'Password changed successfully.']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Failed to change password. Please try again.']);
}
exit;
