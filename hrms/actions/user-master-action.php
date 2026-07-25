<?php
require_once('../root/config.php');
global $ai_db;
global $ai_conn;

header('Content-Type: application/json');

$action = isset($_GET['action']) ? $_GET['action'] : '';

if ($action === 'list') {
    // Fetch all users
    $users = $ai_db->aiGetQuery("SELECT id, user_type, name, username, password, cp_pass, email, phone, address, status, file_path FROM tbl_users WHERE user_type = 'employee' ORDER BY id ASC");
    echo json_encode([
        'status' => 'success',
        'data' => $users
    ]);
    exit;
} else if ($action === 'save') {
    $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
    $username = mysqli_real_escape_string($ai_conn, $_POST['user_id'] ?? '');
    $name = mysqli_real_escape_string($ai_conn, $_POST['user_name'] ?? '');
    $password = $_POST['password'] ?? '';
    $file_path = mysqli_real_escape_string($ai_conn, $_POST['file_path'] ?? '');
    $status = (isset($_POST['deactivate_user']) && $_POST['deactivate_user'] == '1') ? 'inactive' : 'active';

    if (empty($username) || empty($name)) {
        echo json_encode(['status' => 'error', 'message' => 'User ID and User Name are required.']);
        exit;
    }

    // Check if username already exists for a new user, or another user
    $check_qry = "SELECT id FROM tbl_users WHERE username = '$username'" . ($id > 0 ? " AND id != $id" : "");
    $check_res = $ai_db->aiGetQuery($check_qry);
    if (count($check_res) > 0) {
        echo json_encode(['status' => 'error', 'message' => 'User ID (Username) already exists.']);
        exit;
    }

    if ($id > 0) {
        // Update
        $sql = "UPDATE tbl_users SET 
                username = '$username', 
                name = '$name', 
                user_type = 'employee',
                file_path = '$file_path', 
                status = '$status'";

        if (!empty($password)) {
            $md5_pass = md5($password);
            $sql .= ", password = '$md5_pass', cp_pass = '$password'";
        }
        $sql .= " WHERE id = $id";

        $result = $ai_db->aiQuery($sql);
        if ($result) {
            echo json_encode(['status' => 'success', 'message' => 'User updated successfully.']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to update user.']);
        }
    } else {
        // Insert
        $md5_pass = !empty($password) ? md5($password) : '';
        $plain_pass = $password;

        $sql = "INSERT INTO tbl_users (user_type, name, username, password, cp_pass, file_path, status) 
                VALUES ('employee', '$name', '$username', '$md5_pass', '$plain_pass', '$file_path', '$status')";

        $result = $ai_db->aiQuery($sql);
        if ($result) {
            echo json_encode(['status' => 'success', 'message' => 'User created successfully.']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to create user.']);
        }
    }
    exit;
} else if ($action === 'delete') {
    $id = isset($_GET['id']) ? intval($_GET['id']) : 0;
    if ($id > 0) {
        $result = $ai_db->aiQuery("DELETE FROM tbl_users WHERE id = $id");
        if ($result) {
            echo json_encode(['status' => 'success', 'message' => 'User deleted successfully.']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to delete user.']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Invalid ID.']);
    }
    exit;
} else {
    echo json_encode(['status' => 'error', 'message' => 'Unknown action.']);
    exit;
}
