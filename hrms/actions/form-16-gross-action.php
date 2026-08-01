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

// Define the static list of components as in the Form-16 Gross screenshot
$static_components = [
    'BA' => 'BASIC',
    'HRA' => 'HOUSE RENT ALLOWANCE',
    'MA' => 'MEDICAL ALLOWANCE',
    'CA' => 'CONVEYANCE ALLOWANCE',
    'EDU' => 'EDUCATIONAL ALLOWANCE',
    'WA' => 'WASH.ALLOW.',
    'PAPE' => 'PAPER ALLOW.',
    'RECO' => 'RECOVERY ALLOW',
    'CITY' => 'CITY ALLOW',
    'ATTE' => 'ATTEN ALLOW',
    'OTHE' => 'OTHER ALLOWANCE',
    'LA' => 'LEAVE ALLOWANCE',
    'BON' => 'BONUS',
    'GRAT' => 'GRATUITY'
];

if ($action === 'get_branches') {
    $branches = $ai_db->aiGetQuery("SELECT id, branch_name, branch_code FROM hrms_branches WHERE company_id = $company_id ORDER BY branch_name ASC");
    echo json_encode([
        'status' => 'success',
        'data' => $branches
    ]);
    exit;

} else if ($action === 'get_components') {
    $branch_id = isset($_GET['branch_id']) ? intval($_GET['branch_id']) : 0;
    if ($branch_id <= 0) {
        echo json_encode(['status' => 'error', 'message' => 'Invalid Branch selected.']);
        exit;
    }

    // Get the configured components for this branch
    $db_components = $ai_db->aiGetQuery("SELECT component_name, is_applicable FROM hrms_form16_branch_components WHERE company_id = $company_id AND branch_id = $branch_id");

    // Map existing configuration or set defaults
    $mapped = [];
    foreach ($db_components as $row) {
        $mapped[$row['component_name']] = intval($row['is_applicable']);
    }

    $response_data = [];
    foreach ($static_components as $code => $description) {
        $response_data[] = [
            'code' => $code,
            'description' => $description,
            'is_applicable' => isset($mapped[$code]) ? $mapped[$code] : 0
        ];
    }

    echo json_encode([
        'status' => 'success',
        'data' => $response_data
    ]);
    exit;

} else if ($action === 'save_components') {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $branch_id = isset($_POST['branch_id']) ? intval($_POST['branch_id']) : 0;
        if ($branch_id <= 0) {
            echo json_encode(['status' => 'error', 'message' => 'Please select a valid branch.']);
            exit;
        }

        $components = isset($_POST['components']) ? $_POST['components'] : []; // Array of codes that are checked

        // Delete existing components mapping and insert new
        $ai_db->aiQuery("DELETE FROM hrms_form16_branch_components WHERE company_id = $company_id AND branch_id = $branch_id");

        foreach ($static_components as $code => $description) {
            $is_applicable = in_array($code, $components) ? 1 : 0;
            $sql = "INSERT INTO hrms_form16_branch_components (company_id, branch_id, component_name, is_applicable)
                    VALUES ($company_id, $branch_id, '" . mysqli_real_escape_string($ai_conn, $code) . "', $is_applicable)
                    ON DUPLICATE KEY UPDATE is_applicable = $is_applicable";
            $ai_db->aiQuery($sql);
        }

        echo json_encode([
            'status' => 'success',
            'message' => 'Form-16 Gross Component mapping updated successfully.'
        ]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
    }
    exit;
}

echo json_encode(['status' => 'error', 'message' => 'Invalid action specified.']);
exit;
?>
