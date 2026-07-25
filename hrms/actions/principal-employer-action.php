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
        $employers = $ai_db->aiGetQuery("SELECT * FROM hrms_principal_employers WHERE company_id = $company_id ORDER BY id ASC");
        echo json_encode([
            'status' => 'success',
            'data' => $employers
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

        $employer_code = mysqli_real_escape_string($ai_conn, $_POST['employer_code'] ?? '');
        $employer_name = mysqli_real_escape_string($ai_conn, $_POST['employer_name'] ?? '');
        $employer_address = mysqli_real_escape_string($ai_conn, $_POST['employer_address'] ?? '');
        $establishment_name = mysqli_real_escape_string($ai_conn, $_POST['establishment_name'] ?? '');
        $establishment_address = mysqli_real_escape_string($ai_conn, $_POST['establishment_address'] ?? '');
        $nature_of_work = mysqli_real_escape_string($ai_conn, $_POST['nature_of_work'] ?? '');
        $location_of_work = mysqli_real_escape_string($ai_conn, $_POST['location_of_work'] ?? '');
        $labour_no = mysqli_real_escape_string($ai_conn, $_POST['labour_no'] ?? '');
        $pan_no = mysqli_real_escape_string($ai_conn, $_POST['pan_no'] ?? '');
        $mobile_no = mysqli_real_escape_string($ai_conn, $_POST['mobile_no'] ?? '');
        $email = mysqli_real_escape_string($ai_conn, $_POST['email'] ?? '');

        if ($id > 0) {
            // UPDATE query
            $sql = "UPDATE hrms_principal_employers SET 
                        employer_code = '$employer_code',
                        employer_name = '$employer_name',
                        employer_address = '$employer_address',
                        establishment_name = '$establishment_name',
                        establishment_address = '$establishment_address',
                        nature_of_work = '$nature_of_work',
                        location_of_work = '$location_of_work',
                        labour_no = '$labour_no',
                        pan_no = '$pan_no',
                        mobile_no = '$mobile_no',
                        email = '$email'
                    WHERE id = $id AND company_id = $company_id";

            $result = $ai_db->aiQuery($sql);
            if ($result) {
                echo json_encode(['status' => 'success', 'message' => 'Principal Employer updated successfully.']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Failed to update principal employer.']);
            }
        } else {
            // INSERT query
            $sql = "INSERT INTO hrms_principal_employers (
                        company_id, employer_code, employer_name, employer_address, establishment_name, establishment_address, nature_of_work, location_of_work, labour_no, pan_no, mobile_no, email
                    ) VALUES (
                        $company_id, '$employer_code', '$employer_name', '$employer_address', '$establishment_name', '$establishment_address', '$nature_of_work', '$location_of_work', '$labour_no', '$pan_no', '$mobile_no', '$email'
                    )";

            $result = $ai_db->aiQuery($sql);
            if ($result) {
                echo json_encode(['status' => 'success', 'message' => 'Principal Employer created successfully.', 'insert_id' => $ai_db->aiLastInsert()]);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Failed to create principal employer.']);
            }
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
    }
} else if ($action === 'delete') {
    $id = isset($_GET['id']) ? intval($_GET['id']) : 0;
    if ($id > 0) {
        $result = $ai_db->aiQuery("DELETE FROM hrms_principal_employers WHERE id = $id");
        if ($result) {
            echo json_encode(['status' => 'success', 'message' => 'Principal Employer deleted successfully.']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to delete principal employer.']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Invalid ID specified.']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid action specified.']);
}
?>