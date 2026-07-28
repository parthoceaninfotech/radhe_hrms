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

// Helper to convert date
function parseDate($dateStr)
{
    if (empty($dateStr))
        return null;
    $parts = explode('/', $dateStr);
    if (count($parts) === 3) {
        return sprintf('%04d-%02d-%02d', $parts[2], $parts[1], $parts[0]);
    }
    return $dateStr; // fallback if already Y-m-d
}

if ($action === 'get_employee') {
    $emp_code = mysqli_real_escape_string($ai_conn, $_GET['emp_code'] ?? '');
    if (empty($emp_code)) {
        echo json_encode(['status' => 'error', 'message' => 'Employee Code is required.']);
        exit;
    }

    $sql = "SELECT e.*, d.dept_name, dg.desig_name 
            FROM hrms_employeemaster e
            LEFT JOIN hrms_departments d ON e.dept_id = d.id
            LEFT JOIN hrms_designations dg ON e.desig_id = dg.id
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
    // Fetch unique employees with nominees
    $sql = "SELECT DISTINCT e.id as employee_id, e.emp_code, e.emp_name, d.dept_name, dg.desig_name, DATE_FORMAT(e.joining_date, '%d/%m/%Y') as joining_date
            FROM hrms_employee_nominees n
            INNER JOIN hrms_employeemaster e ON n.employee_id = e.id
            LEFT JOIN hrms_departments d ON e.dept_id = d.id
            LEFT JOIN hrms_designations dg ON e.desig_id = dg.id
            WHERE n.company_id = $company_id";
    $res = $ai_db->aiGetQuery($sql);
    echo json_encode(['status' => 'success', 'data' => $res]);
    exit;
}

if ($action === 'get_nominees') {
    $employee_id = intval($_GET['employee_id'] ?? 0);
    if ($employee_id <= 0) {
        echo json_encode(['status' => 'error', 'message' => 'Invalid Employee ID.']);
        exit;
    }

    $sql = "SELECT *, DATE_FORMAT(birth_date, '%d/%m/%Y') as birth_date FROM hrms_employee_nominees WHERE employee_id = $employee_id AND company_id = $company_id";
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

    // Parse JSON nominees array from request
    $nomineesData = json_decode($_POST['nominees_json'] ?? '[]', true);

    // Delete existing nominees
    $ai_db->aiQuery("DELETE FROM hrms_employee_nominees WHERE employee_id = $employee_id AND company_id = $company_id");

    // Insert new nominees
    $success = true;
    foreach ($nomineesData as $nominee) {
        $dependent_name = mysqli_real_escape_string($ai_conn, $nominee['dependent_name'] ?? '');
        $relation = mysqli_real_escape_string($ai_conn, $nominee['relation'] ?? '');
        $birth_date_raw = parseDate($nominee['birth_date'] ?? '');
        $birth_date = $birth_date_raw ? "'$birth_date_raw'" : "NULL";
        $share_percentage = floatval($nominee['share_percentage'] ?? 0.00);

        if (!empty($dependent_name)) {
            $insertSql = "INSERT INTO hrms_employee_nominees (
                            employee_id, company_id, dependent_name, relation, birth_date, share_percentage
                          ) VALUES (
                            $employee_id, $company_id, '$dependent_name', '$relation', $birth_date, $share_percentage
                          )";
            if (!$ai_db->aiQuery($insertSql)) {
                $success = false;
            }
        }
    }

    if ($success) {
        echo json_encode(['status' => 'success', 'message' => 'Nominee details saved successfully.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to save nominee details.']);
    }
    exit;
}

if ($action === 'delete') {
    $employee_id = intval($_GET['employee_id'] ?? 0);
    if ($employee_id <= 0) {
        echo json_encode(['status' => 'error', 'message' => 'Invalid Employee ID.']);
        exit;
    }

    $sql = "DELETE FROM hrms_employee_nominees WHERE employee_id = $employee_id AND company_id = $company_id";
    if ($ai_db->aiQuery($sql)) {
        echo json_encode(['status' => 'success', 'message' => 'Nominee details deleted successfully.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to delete nominee details.']);
    }
    exit;
}

echo json_encode(['status' => 'error', 'message' => 'Invalid Action.']);
?>