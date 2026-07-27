<?php
require_once('../root/config.php');
global $ai_db;
global $ai_core;
global $ai_conn;

header('Content-Type: application/json');

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$company_id = isset($_SESSION['selected_company_id']) ? intval($_SESSION['selected_company_id']) : 0;
if ($company_id <= 0) {
    echo json_encode(['status' => 'error', 'message' => 'No active company session. Please select a company.']);
    exit;
}

$action = isset($_GET['action']) ? $_GET['action'] : '';
$username = isset($_SESSION['username']) ? mysqli_real_escape_string($ai_conn, $_SESSION['username']) : 'System';

if ($action === 'view') {
    $departments = $ai_db->aiGetQuery("SELECT * FROM hrms_departments WHERE company_id = $company_id ORDER BY id ASC");
    echo json_encode([
        'status' => 'success',
        'data' => $departments
    ]);
    exit;
} else if ($action === 'next_code') {
    $res = $ai_db->aiGetQuery("SELECT MAX(CAST(dept_code AS UNSIGNED)) as max_code FROM hrms_departments WHERE company_id = $company_id");
    $max_code = isset($res[0]['max_code']) ? intval($res[0]['max_code']) : 0;
    $next_code = str_pad($max_code + 1, 3, '0', STR_PAD_LEFT);
    echo json_encode([
        'status' => 'success',
        'next_code' => $next_code
    ]);
    exit;
} else if ($action === 'save') {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
        $dept_code = mysqli_real_escape_string($ai_conn, $_POST['dept_id'] ?? '');
        $dept_name = mysqli_real_escape_string($ai_conn, $_POST['dept_name'] ?? '');

        if (empty($dept_code) || empty($dept_name)) {
            echo json_encode(['status' => 'error', 'message' => 'Please enter Department ID and Name.']);
            exit;
        }

        if ($id > 0) {
            $check = $ai_db->aiGetQuery("SELECT * FROM hrms_departments WHERE company_id = $company_id AND dept_code = '$dept_code' AND id != $id");
            if (count($check) > 0) {
                echo json_encode(['status' => 'error', 'message' => 'Department ID already exists for this company.']);
                exit;
            }

            $sql = "UPDATE hrms_departments SET 
                        dept_code = '$dept_code',
                        dept_name = '$dept_name',
                        updated_by = '$username'
                    WHERE id = $id AND company_id = $company_id";
            $result = $ai_db->aiQuery($sql);
            if ($result) {
                echo json_encode(['status' => 'success', 'message' => 'Department updated successfully.']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Failed to update department.']);
            }
        } else {
            $check = $ai_db->aiGetQuery("SELECT * FROM hrms_departments WHERE company_id = $company_id AND dept_code = '$dept_code'");
            if (count($check) > 0) {
                echo json_encode(['status' => 'error', 'message' => 'Department ID already exists for this company.']);
                exit;
            }

            $sql = "INSERT INTO hrms_departments (company_id, dept_code, dept_name, status, created_by, updated_by) 
                    VALUES ($company_id, '$dept_code', '$dept_name', 'active', '$username', '$username')";
            $result = $ai_db->aiQuery($sql);
            if ($result) {
                $new_id = $ai_db->aiLastInsert();
                echo json_encode(['status' => 'success', 'message' => 'Department created successfully.', 'insert_id' => $new_id]);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Failed to create department.']);
            }
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
    }
    exit;
} else if ($action === 'delete') {
    $id = isset($_GET['id']) ? intval($_GET['id']) : 0;
    if ($id > 0) {
        $result = $ai_db->aiQuery("DELETE FROM hrms_departments WHERE id = $id AND company_id = $company_id");
        if ($result) {
            echo json_encode(['status' => 'success', 'message' => 'Department record deleted successfully.']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to delete department record.']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Invalid ID specified.']);
    }
    exit;
}

echo json_encode(['status' => 'error', 'message' => 'Invalid action specified.']);
exit;
?>