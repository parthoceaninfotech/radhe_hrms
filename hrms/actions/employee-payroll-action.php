<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
header('Content-Type: application/json');

// Mock host if in CLI mode
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
    // Fetch all payroll details for this company's employees
    $sql = "SELECT p.*, e.emp_code, e.emp_name 
            FROM hrms_employee_payroll p
            INNER JOIN hrms_employeemaster e ON p.employee_id = e.id
            WHERE p.company_id = $company_id";
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

    // Lookup employee by code
    $empSql = "SELECT id FROM hrms_employeemaster WHERE company_id = $company_id AND emp_code = '$emp_code'";
    $empRes = $ai_db->aiGetQuery($empSql);
    if (count($empRes) == 0) {
        echo json_encode(['status' => 'error', 'message' => 'Employee not found.']);
        exit;
    }
    $employee_id = intval($empRes[0]['id']);

    $payl_type = mysqli_real_escape_string($ai_conn, $_POST['payl_type'] ?? 'Monthly');
    $pf_applicable = isset($_POST['pf_applicable']) ? 1 : 0;
    $pf_percentage = floatval($_POST['pf_percentage'] ?? 0.00);
    $pf_amount = floatval($_POST['pf_amount'] ?? 0.00);
    $ptax_applicable = isset($_POST['ptax_applicable']) ? 1 : 0;
    $ptax_amount = floatval($_POST['ptax_amount'] ?? 0.00);
    $gratuity = floatval($_POST['gratuity'] ?? 0.00);
    $bonus_percentage = floatval($_POST['bonus_percentage'] ?? 0.00);

    // Rates, Amounts & Types
    $basic_rate = floatval($_POST['basic_rate'] ?? 0.00);
    $basic_amt = floatval($_POST['basic_amt'] ?? 0.00);
    $basic_type = mysqli_real_escape_string($ai_conn, $_POST['basic_type'] ?? 'V');

    $hra_rate = floatval($_POST['hra_rate'] ?? 0.00);
    $hra_amt = floatval($_POST['hra_amt'] ?? 0.00);
    $hra_type = mysqli_real_escape_string($ai_conn, $_POST['hra_type'] ?? 'V');

    $medical_rate = floatval($_POST['medical_rate'] ?? 0.00);
    $medical_amt = floatval($_POST['medical_amt'] ?? 0.00);
    $medical_type = mysqli_real_escape_string($ai_conn, $_POST['medical_type'] ?? 'V');

    $conveyance_rate = floatval($_POST['conveyance_rate'] ?? 0.00);
    $conveyance_amt = floatval($_POST['conveyance_amt'] ?? 0.00);
    $conveyance_type = mysqli_real_escape_string($ai_conn, $_POST['conveyance_type'] ?? 'V');

    $education_rate = floatval($_POST['education_rate'] ?? 0.00);
    $education_amt = floatval($_POST['education_amt'] ?? 0.00);
    $education_type = mysqli_real_escape_string($ai_conn, $_POST['education_type'] ?? 'V');

    $washing_rate = floatval($_POST['washing_rate'] ?? 0.00);
    $washing_amt = floatval($_POST['washing_amt'] ?? 0.00);
    $washing_type = mysqli_real_escape_string($ai_conn, $_POST['washing_type'] ?? 'V');

    $paper_rate = floatval($_POST['paper_rate'] ?? 0.00);
    $paper_amt = floatval($_POST['paper_amt'] ?? 0.00);
    $paper_type = mysqli_real_escape_string($ai_conn, $_POST['paper_type'] ?? 'V');

    $recovery_rate = floatval($_POST['recovery_rate'] ?? 0.00);
    $recovery_amt = floatval($_POST['recovery_amt'] ?? 0.00);
    $recovery_type = mysqli_real_escape_string($ai_conn, $_POST['recovery_type'] ?? 'V');

    $city_rate = floatval($_POST['city_rate'] ?? 0.00);
    $city_amt = floatval($_POST['city_amt'] ?? 0.00);
    $city_type = mysqli_real_escape_string($ai_conn, $_POST['city_type'] ?? 'V');

    $atten_rate = floatval($_POST['atten_rate'] ?? 0.00);
    $atten_amt = floatval($_POST['atten_amt'] ?? 0.00);
    $atten_type = mysqli_real_escape_string($ai_conn, $_POST['atten_type'] ?? 'V');

    $other_allow_rate = floatval($_POST['other_allow_rate'] ?? 0.00);
    $other_allow_amt = floatval($_POST['other_allow_amt'] ?? 0.00);
    $other_allow_type = mysqli_real_escape_string($ai_conn, $_POST['other_allow_type'] ?? 'V');

    $leave_allow_rate = floatval($_POST['leave_allow_rate'] ?? 0.00);
    $leave_allow_amt = floatval($_POST['leave_allow_amt'] ?? 0.00);
    $leave_allow_type = mysqli_real_escape_string($ai_conn, $_POST['leave_allow_type'] ?? 'V');

    $ptax_rate_ded = floatval($_POST['ptax_rate_ded'] ?? 0.00);
    $ptax_amt_ded = floatval($_POST['ptax_amt_ded'] ?? 0.00);
    $ptax_type = mysqli_real_escape_string($ai_conn, $_POST['ptax_type'] ?? 'V');

    $other_ded_rate = floatval($_POST['other_ded_rate'] ?? 0.00);
    $other_ded_amt = floatval($_POST['other_ded_amt'] ?? 0.00);
    $other_ded_type = mysqli_real_escape_string($ai_conn, $_POST['other_ded_type'] ?? 'V');

    // Totals
    $total_earn = floatval($_POST['total_earn'] ?? 0.00);
    $total_ded = floatval($_POST['total_ded'] ?? 0.00);
    $net_amount = floatval($_POST['net_amount'] ?? 0.00);
    $employer_pf = floatval($_POST['employer_pf'] ?? 0.00);
    $act_wage = floatval($_POST['act_wage'] ?? 0.00);

    // Check if payroll record already exists
    $checkSql = "SELECT id FROM hrms_employee_payroll WHERE employee_id = $employee_id";
    $checkRes = $ai_db->aiGetQuery($checkSql);

    if (count($checkRes) > 0) {
        $payroll_id = intval($checkRes[0]['id']);
        $sql = "UPDATE hrms_employee_payroll SET 
                    company_id = $company_id,
                    payl_type = '$payl_type',
                    pf_applicable = $pf_applicable,
                    pf_percentage = $pf_percentage,
                    pf_amount = $pf_amount,
                    ptax_applicable = $ptax_applicable,
                    ptax_amount = $ptax_amount,
                    gratuity = $gratuity,
                    bonus_percentage = $bonus_percentage,
                    
                    basic_rate = $basic_rate,
                    basic_amt = $basic_amt,
                    basic_type = '$basic_type',
                    
                    hra_rate = $hra_rate,
                    hra_amt = $hra_amt,
                    hra_type = '$hra_type',
                    
                    medical_rate = $medical_rate,
                    medical_amt = $medical_amt,
                    medical_type = '$medical_type',
                    
                    conveyance_rate = $conveyance_rate,
                    conveyance_amt = $conveyance_amt,
                    conveyance_type = '$conveyance_type',
                    
                    education_rate = $education_rate,
                    education_amt = $education_amt,
                    education_type = '$education_type',
                    
                    washing_rate = $washing_rate,
                    washing_amt = $washing_amt,
                    washing_type = '$washing_type',
                    
                    paper_rate = $paper_rate,
                    paper_amt = $paper_amt,
                    paper_type = '$paper_type',
                    
                    recovery_rate = $recovery_rate,
                    recovery_amt = $recovery_amt,
                    recovery_type = '$recovery_type',
                    
                    city_rate = $city_rate,
                    city_amt = $city_amt,
                    city_type = '$city_type',
                    
                    atten_rate = $atten_rate,
                    atten_amt = $atten_amt,
                    atten_type = '$atten_type',
                    
                    other_allow_rate = $other_allow_rate,
                    other_allow_amt = $other_allow_amt,
                    other_allow_type = '$other_allow_type',
                    
                    leave_allow_rate = $leave_allow_rate,
                    leave_allow_amt = $leave_allow_amt,
                    leave_allow_type = '$leave_allow_type',
                    
                    ptax_amount = $ptax_amt_ded,
                    ptax_type = '$ptax_type',
                    
                    other_ded_rate = $other_ded_rate,
                    other_ded_amt = $other_ded_amt,
                    other_ded_type = '$other_ded_type',
                    
                    total_earn = $total_earn,
                    total_ded = $total_ded,
                    net_amount = $net_amount,
                    employer_pf = $employer_pf,
                    act_wage = $act_wage
                WHERE id = $payroll_id";
    } else {
        $sql = "INSERT INTO hrms_employee_payroll (
                    employee_id, company_id, payl_type, pf_applicable, pf_percentage, pf_amount,
                    ptax_applicable, ptax_amount, gratuity, bonus_percentage,
                    basic_rate, basic_amt, basic_type,
                    hra_rate, hra_amt, hra_type, 
                    medical_rate, medical_amt, medical_type,
                    conveyance_rate, conveyance_amt, conveyance_type, 
                    education_rate, education_amt, education_type,
                    washing_rate, washing_amt, washing_type,
                    paper_rate, paper_amt, paper_type,
                    recovery_rate, recovery_amt, recovery_type,
                    city_rate, city_amt, city_type,
                    atten_rate, atten_amt, atten_type,
                    other_allow_rate, other_allow_amt, other_allow_type,
                    leave_allow_rate, leave_allow_amt, leave_allow_type,
                    ptax_type, other_ded_rate, other_ded_amt, other_ded_type, 
                    total_earn, total_ded, net_amount, employer_pf, act_wage
                ) VALUES (
                    $employee_id, $company_id, '$payl_type', $pf_applicable, $pf_percentage, $pf_amount,
                    $ptax_applicable, $ptax_amt_ded, $gratuity, $bonus_percentage,
                    $basic_rate, $basic_amt, '$basic_type',
                    $hra_rate, $hra_amt, '$hra_type', 
                    $medical_rate, $medical_amt, '$medical_type',
                    $conveyance_rate, $conveyance_amt, '$conveyance_type', 
                    $education_rate, $education_amt, '$education_type',
                    $washing_rate, $washing_amt, '$washing_type',
                    $paper_rate, $paper_amt, '$paper_type',
                    $recovery_rate, $recovery_amt, '$recovery_type',
                    $city_rate, $city_amt, '$city_type',
                    $atten_rate, $atten_amt, '$atten_type',
                    $other_allow_rate, $other_allow_amt, '$other_allow_type',
                    $leave_allow_rate, $leave_allow_amt, '$leave_allow_type',
                    '$ptax_type', $other_ded_rate, $other_ded_amt, '$other_ded_type', 
                    $total_earn, $total_ded, $net_amount, $employer_pf, $act_wage
                )";
    }

    if ($ai_db->aiQuery($sql)) {
        echo json_encode(['status' => 'success', 'message' => 'Payroll details saved successfully.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to save payroll details.']);
    }
    exit;
}

if ($action === 'delete') {
    $id = intval($_GET['id'] ?? 0);
    if ($id <= 0) {
        echo json_encode(['status' => 'error', 'message' => 'Invalid ID.']);
        exit;
    }

    $sql = "DELETE FROM hrms_employee_payroll WHERE id = $id";
    if ($ai_db->aiQuery($sql)) {
        echo json_encode(['status' => 'success', 'message' => 'Payroll details deleted successfully.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to delete payroll details.']);
    }
    exit;
}

echo json_encode(['status' => 'error', 'message' => 'Invalid Action.']);
?>