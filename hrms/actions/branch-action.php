<?php
require_once('../root/config.php');
global $ai_db;
global $ai_core;
global $ai_conn;

header('Content-Type: application/json');

$action = isset($_GET['action']) ? $_GET['action'] : '';

if ($action === 'view') {
    $company_id = isset($_GET['company_id']) ? intval($_GET['company_id']) : 0;
    if ($company_id > 0) {
        $branches = $ai_db->aiGetQuery("SELECT * FROM hrms_branches WHERE company_id = $company_id ORDER BY id ASC");
        echo json_encode([
            'status' => 'success',
            'data' => $branches
        ]);
    } else {
        echo json_encode([
            'status' => 'error',
            'message' => 'Invalid Company ID.'
        ]);
    }
} else if ($action === 'save') {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
        $company_id = isset($_POST['company_id']) ? intval($_POST['company_id']) : 0;

        if ($company_id <= 0) {
            echo json_encode(['status' => 'error', 'message' => 'Invalid Company ID.']);
            exit;
        }

        $branch_code = mysqli_real_escape_string($ai_conn, $_POST['branch_code'] ?? '');
        $branch_name = mysqli_real_escape_string($ai_conn, $_POST['branch_name'] ?? '');
        $address = mysqli_real_escape_string($ai_conn, $_POST['address'] ?? '');
        $place = mysqli_real_escape_string($ai_conn, $_POST['place'] ?? '');
        $city = mysqli_real_escape_string($ai_conn, $_POST['city'] ?? '');
        $district = mysqli_real_escape_string($ai_conn, $_POST['district'] ?? '');
        $state = mysqli_real_escape_string($ai_conn, $_POST['state'] ?? '');
        $pt_state = mysqli_real_escape_string($ai_conn, $_POST['pt_state'] ?? '');
        $pt_prc_no = mysqli_real_escape_string($ai_conn, $_POST['pt_prc_no'] ?? '');
        $pt_pec_no = mysqli_real_escape_string($ai_conn, $_POST['pt_pec_no'] ?? '');
        $salary_month_start_from = isset($_POST['salary_month_start_from']) ? intval($_POST['salary_month_start_from']) : 1;

        if ($id > 0) {
            // UPDATE query
            $sql = "UPDATE hrms_branches SET 
                        branch_code = '$branch_code',
                        branch_name = '$branch_name',
                        address = '$address',
                        place = '$place',
                        city = '$city',
                        district = '$district',
                        state = '$state',
                        pt_state = '$pt_state',
                        pt_prc_no = '$pt_prc_no',
                        pt_pec_no = '$pt_pec_no',
                        salary_month_start_from = $salary_month_start_from
                    WHERE id = $id AND company_id = $company_id";

            $result = $ai_db->aiQuery($sql);
            if ($result) {
                echo json_encode(['status' => 'success', 'message' => 'Branch updated successfully.']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Failed to update branch.']);
            }
        } else {
            // INSERT query
            $sql = "INSERT INTO hrms_branches (
                        company_id, branch_code, branch_name, address, place, city, district, state, pt_state, pt_prc_no, pt_pec_no, salary_month_start_from
                    ) VALUES (
                        $company_id, '$branch_code', '$branch_name', '$address', '$place', '$city', '$district', '$state', '$pt_state', '$pt_prc_no', '$pt_pec_no', $salary_month_start_from
                    )";

            $result = $ai_db->aiQuery($sql);
            if ($result) {
                echo json_encode(['status' => 'success', 'message' => 'Branch created successfully.', 'insert_id' => $ai_db->aiLastInsert()]);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Failed to create branch.']);
            }
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
    }
} else if ($action === 'delete') {
    $id = isset($_GET['id']) ? intval($_GET['id']) : 0;
    if ($id > 0) {
        $result = $ai_db->aiQuery("DELETE FROM hrms_branches WHERE id = $id");
        if ($result) {
            echo json_encode(['status' => 'success', 'message' => 'Branch deleted successfully.']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to delete branch.']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Invalid ID specified.']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid action specified.']);
}
?>