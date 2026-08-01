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
    $rates = $ai_db->aiGetQuery("SELECT * FROM hrms_minimum_wages WHERE company_id = $company_id ORDER BY state_name ASC, effective_date DESC, id DESC");
    echo json_encode([
        'status' => 'success',
        'data' => $rates
    ]);
    exit;

} else if ($action === 'save_rate') {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
        $state_name = mysqli_real_escape_string($ai_conn, $_POST['state_name'] ?? '');
        $zone_type = mysqli_real_escape_string($ai_conn, $_POST['zone_type'] ?? '');
        
        $highly_skilled = floatval($_POST['highly_skilled'] ?? 0);
        $skilled = floatval($_POST['skilled'] ?? 0);
        $semi_skilled = floatval($_POST['semi_skilled'] ?? 0);
        $unskilled = floatval($_POST['unskilled'] ?? 0);

        $effective_date_raw = $_POST['effective_date'] ?? '';
        if (empty($state_name)) {
            echo json_encode(['status' => 'error', 'message' => 'State Name is required.']);
            exit;
        }
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
            $sql = "UPDATE hrms_minimum_wages SET 
                        state_name = '$state_name',
                        zone_type = '$zone_type',
                        highly_skilled = $highly_skilled,
                        skilled = $skilled,
                        semi_skilled = $semi_skilled,
                        unskilled = $unskilled,
                        effective_date = '$effective_date',
                        updated_by = '$username'
                    WHERE id = $id AND company_id = $company_id";
        } else {
            $sql = "INSERT INTO hrms_minimum_wages (
                        company_id, state_name, zone_type, highly_skilled, skilled, 
                        semi_skilled, unskilled, effective_date, created_by, updated_by
                    ) VALUES (
                        $company_id, '$state_name', '$zone_type', $highly_skilled, $skilled, 
                        $semi_skilled, $unskilled, '$effective_date', '$username', '$username'
                    )";
        }

        if ($ai_db->aiQuery($sql)) {
            $rate_id = ($id > 0) ? $id : $ai_db->aiLastInsert();
            echo json_encode(['status' => 'success', 'message' => 'Minimum Wage saved successfully.', 'rate_id' => $rate_id]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to save Minimum Wage.']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
    }
    exit;

} else if ($action === 'delete_rate') {
    $id = isset($_GET['id']) ? intval($_GET['id']) : 0;
    if ($id > 0) {
        $result = $ai_db->aiQuery("DELETE FROM hrms_minimum_wages WHERE id = $id AND company_id = $company_id");
        if ($result) {
            echo json_encode(['status' => 'success', 'message' => 'Minimum Wage deleted successfully.']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to delete Minimum Wage.']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Invalid ID specified.']);
    }
    exit;
}

echo json_encode(['status' => 'error', 'message' => 'Invalid action specified.']);
exit;
?>
