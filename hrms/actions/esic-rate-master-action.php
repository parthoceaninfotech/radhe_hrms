<?php
require_once('../root/config.php');
global $ai_db, $ai_conn;

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

if ($action === 'view_rates') {
    $rates = $ai_db->aiGetQuery("SELECT * FROM hrms_esic_rates WHERE company_id = $company_id ORDER BY effective_date DESC, id DESC");
    echo json_encode([
        'status' => 'success',
        'data' => $rates
    ]);
    exit;

} else if ($action === 'save_rate') {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
        $employee_rate = floatval($_POST['employee_rate'] ?? 0);
        $employer_rate = floatval($_POST['employer_rate'] ?? 0);

        $effective_date_raw = $_POST['effective_date'] ?? '';
        if (empty($effective_date_raw)) {
            echo json_encode(['status' => 'error', 'message' => 'Effective Date is required.']);
            exit;
        }

        // Convert date format from DD/MM/YYYY to YYYY-MM-DD
        if (strpos($effective_date_raw, '/') !== false) {
            $parts = explode('/', $effective_date_raw);
            if (count($parts) === 3) {
                $effective_date = $parts[2] . '-' . $parts[1] . '-' . $parts[0];
            } else {
                $effective_date = date('Y-m-d', strtotime($effective_date_raw));
            }
        } else {
            $effective_date = date('Y-m-d', strtotime($effective_date_raw));
        }
        $effective_date = mysqli_real_escape_string($ai_conn, $effective_date);

        if ($id > 0) {
            $sql = "UPDATE hrms_esic_rates SET 
                        employee_rate = $employee_rate,
                        employer_rate = $employer_rate,
                        effective_date = '$effective_date',
                        updated_by = '$username'
                    WHERE id = $id AND company_id = $company_id";
        } else {
            $sql = "INSERT INTO hrms_esic_rates (
                        company_id, employee_rate, employer_rate, effective_date, created_by, updated_by
                    ) VALUES (
                        $company_id, $employee_rate, $employer_rate, '$effective_date', '$username', '$username'
                    )";
        }

        if ($ai_db->aiQuery($sql)) {
            $rate_id = ($id > 0) ? $id : $ai_db->aiLastInsert();
            echo json_encode(['status' => 'success', 'message' => 'ESIC Rate saved successfully.', 'rate_id' => $rate_id]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to save ESIC Rate.']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
    }
    exit;

} else if ($action === 'delete_rate') {
    $id = isset($_GET['id']) ? intval($_GET['id']) : 0;
    if ($id > 0) {
        $result = $ai_db->aiQuery("DELETE FROM hrms_esic_rates WHERE id = $id AND company_id = $company_id");
        if ($result) {
            echo json_encode(['status' => 'success', 'message' => 'ESIC Rate deleted successfully.']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to delete ESIC Rate.']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Invalid ID specified.']);
    }
    exit;

} else if ($action === 'get_branches') {
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

    $static_components = [
        'BASIC' => 'BASIC',
        'HOUSE RENT ALLOWANCE' => 'HOUSE RENT ALLOWANCE',
        'MEDICAL ALLOWANCE' => 'MEDICAL ALLOWANCE',
        'CONVEYANCE ALLOWANCE' => 'CONVEYANCE ALLOWANCE',
        'EDUCATIONAL ALLOWANCE' => 'EDUCATIONAL ALLOWANCE',
        'WASH.ALLOW.' => 'WASH.ALLOW.',
        'PAPER ALLOW' => 'PAPER ALLOW',
        'RECOVERY ALLOW' => 'RECOVERY ALLOW',
        'CITY ALLOW' => 'CITY ALLOW',
        'ATTEN ALLOW' => 'ATTEN ALLOW',
        'OTHER ALLOWANCE' => 'OTHER ALLOWANCE',
        'BONUS' => 'BONUS',
        'GRATUITY' => 'GRATUITY',
        'OVER TIME' => 'OVER TIME',
        'PRODUCTION INCENTIVE' => 'PRODUCTION INCENTIVE',
        'BONUS IN SALARY' => 'BONUS IN SALARY',
        'LEAVE IN SALARY' => 'LEAVE IN SALARY',
        'GRATUITY IN SALARY' => 'GRATUITY IN SALARY'
    ];

    // Get the configured components for this branch
    $db_components = $ai_db->aiGetQuery("SELECT component_name, is_applicable FROM hrms_esic_branch_components WHERE company_id = $company_id AND branch_id = $branch_id");

    // Map existing configuration or set defaults
    $mapped = [];
    foreach ($db_components as $row) {
        $mapped[$row['component_name']] = intval($row['is_applicable']);
    }

    $response_data = [];
    foreach ($static_components as $key => $display_name) {
        $response_data[] = [
            'display_name' => $key,
            'db_name' => $display_name,
            'is_applicable' => isset($mapped[$display_name]) ? $mapped[$display_name] : 0
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

        $static_components = [
            'BASIC' => 'BASIC',
            'HOUSE RENT ALLOWANCE' => 'HOUSE RENT ALLOWANCE',
            'MEDICAL ALLOWANCE' => 'MEDICAL ALLOWANCE',
            'CONVEYANCE ALLOWANCE' => 'CONVEYANCE ALLOWANCE',
            'EDUCATIONAL ALLOWANCE' => 'EDUCATIONAL ALLOWANCE',
            'WASH.ALLOW.' => 'WASH.ALLOW.',
            'PAPER ALLOW' => 'PAPER ALLOW',
            'RECOVERY ALLOW' => 'RECOVERY ALLOW',
            'CITY ALLOW' => 'CITY ALLOW',
            'ATTEN ALLOW' => 'ATTEN ALLOW',
            'OTHER ALLOWANCE' => 'OTHER ALLOWANCE',
            'BONUS' => 'BONUS',
            'GRATUITY' => 'GRATUITY',
            'OVER TIME' => 'OVER TIME',
            'PRODUCTION INCENTIVE' => 'PRODUCTION INCENTIVE',
            'BONUS IN SALARY' => 'BONUS IN SALARY',
            'LEAVE IN SALARY' => 'LEAVE IN SALARY',
            'GRATUITY IN SALARY' => 'GRATUITY IN SALARY'
        ];

        $components = isset($_POST['components']) ? $_POST['components'] : []; // Array of database names that are checked

        // Delete existing components mapping and insert new
        $ai_db->aiQuery("DELETE FROM hrms_esic_branch_components WHERE company_id = $company_id AND branch_id = $branch_id");

        foreach ($static_components as $key => $display_name) {
            $is_applicable = in_array($display_name, $components) ? 1 : 0;
            $sql = "INSERT INTO hrms_esic_branch_components (company_id, branch_id, component_name, is_applicable)
                    VALUES ($company_id, $branch_id, '" . mysqli_real_escape_string($ai_conn, $display_name) . "', $is_applicable)
                    ON DUPLICATE KEY UPDATE is_applicable = $is_applicable";
            $ai_db->aiQuery($sql);
        }

        echo json_encode([
            'status' => 'success',
            'message' => 'ESIC Component mapping updated successfully.'
        ]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
    }
    exit;
}

echo json_encode(['status' => 'error', 'message' => 'Invalid action specified.']);
exit;
?>