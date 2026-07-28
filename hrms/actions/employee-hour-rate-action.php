<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
header('Content-Type: application/json');

if (php_sapi_name() === 'cli' && !isset($_SERVER['HTTP_HOST'])) {
    $_SERVER['HTTP_HOST'] = 'localhost';
}

require_once __DIR__ . '/../root/config.php';
global $ai_db, $ai_conn;

$company_id = isset($_SESSION['selected_company_id']) ? intval($_SESSION['selected_company_id']) : 0;
if ($company_id <= 0) {
    echo json_encode(['status' => 'error', 'message' => 'No active company session. Please select a company.']);
    exit;
}

$action = $_GET['action'] ?? '';

if ($action === 'get_employee') {
    $emp_code = mysqli_real_escape_string($ai_conn, $_GET['emp_code'] ?? '');
    if (empty($emp_code)) {
        echo json_encode(['status' => 'error', 'message' => 'Employee Code is required.']);
        exit;
    }

    $sql = "SELECT e.*, d.dept_name 
            FROM hrms_employeemaster e
            LEFT JOIN hrms_departments d ON e.dept_id = d.id
            WHERE e.company_id = $company_id AND e.emp_code = '$emp_code'";
    $res = $ai_db->aiGetQuery($sql);

    if (count($res) > 0) {
        echo json_encode(['status' => 'success', 'data' => $res[0]]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Employee not found.']);
    }
    exit;
}

if ($action === 'view') {
    $sql = "SELECT h.*, e.emp_code, e.emp_name, d.dept_name 
            FROM hrms_employee_hour_rate h
            INNER JOIN hrms_employeemaster e ON h.employee_id = e.id
            LEFT JOIN hrms_departments d ON e.dept_id = d.id
            WHERE h.company_id = $company_id";
    $res = $ai_db->aiGetQuery($sql);
    echo json_encode(['status' => 'success', 'data' => $res]);
    exit;
}

if ($action === 'save') {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
        exit;
    }

    $emp_code = mysqli_real_escape_string($ai_conn, $_POST['emp_code'] ?? '');
    if (empty($emp_code)) {
        echo json_encode(['status' => 'error', 'message' => 'Employee Code is required.']);
        exit;
    }

    $empSql = "SELECT id FROM hrms_employeemaster WHERE company_id = $company_id AND emp_code = '$emp_code'";
    $empRes = $ai_db->aiGetQuery($empSql);
    if (count($empRes) == 0) {
        echo json_encode(['status' => 'error', 'message' => 'Employee not found.']);
        exit;
    }
    $employee_id = intval($empRes[0]['id']);

    $effective_year = intval($_POST['effective_year'] ?? 0);
    $effective_month = intval($_POST['effective_month'] ?? 0);
    $day_rate = floatval($_POST['day_rate'] ?? 0.00);
    $night_rate = floatval($_POST['night_rate'] ?? 0.00);

    if ($effective_year <= 0 || $effective_month <= 0) {
        echo json_encode(['status' => 'error', 'message' => 'Valid Effective Year and Month are required.']);
        exit;
    }

    // Check if duplicate for same employee and period
    $checkSql = "SELECT id FROM hrms_employee_hour_rate 
                 WHERE employee_id = $employee_id 
                   AND effective_year = $effective_year 
                   AND effective_month = $effective_month";
    $checkRes = $ai_db->aiGetQuery($checkSql);

    if (count($checkRes) > 0) {
        $rate_id = intval($checkRes[0]['id']);
        $sql = "UPDATE hrms_employee_hour_rate SET 
                    company_id = $company_id,
                    day_rate = $day_rate,
                    night_rate = $night_rate
                WHERE id = $rate_id";
    } else {
        $sql = "INSERT INTO hrms_employee_hour_rate (
                    employee_id, company_id, effective_year, effective_month, day_rate, night_rate
                ) VALUES (
                    $employee_id, $company_id, $effective_year, $effective_month, $day_rate, $night_rate
                )";
    }

    if ($ai_db->aiQuery($sql)) {
        echo json_encode(['status' => 'success', 'message' => 'Hour rate details saved successfully.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to save hour rate details.']);
    }
    exit;
}

if ($action === 'delete') {
    $id = intval($_GET['id'] ?? 0);
    if ($id <= 0) {
        echo json_encode(['status' => 'error', 'message' => 'Invalid ID.']);
        exit;
    }

    $sql = "DELETE FROM hrms_employee_hour_rate WHERE id = $id";
    if ($ai_db->aiQuery($sql)) {
        echo json_encode(['status' => 'success', 'message' => 'Hour rate details deleted successfully.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to delete hour rate details.']);
    }
    exit;
}

echo json_encode(['status' => 'error', 'message' => 'Invalid Action.']);
?>