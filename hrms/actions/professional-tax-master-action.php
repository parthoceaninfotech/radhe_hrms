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

if ($action === 'view_rules') {
    // Get all PT rules for this company
    $rules = $ai_db->aiGetQuery("SELECT * FROM hrms_ptax_rules WHERE company_id = $company_id ORDER BY state_name ASC, effective_date DESC, id DESC");
    echo json_encode([
        'status' => 'success',
        'data' => $rules
    ]);
    exit;

} else if ($action === 'get_slabs') {
    $rule_id = isset($_GET['rule_id']) ? intval($_GET['rule_id']) : 0;
    if ($rule_id <= 0) {
        echo json_encode(['status' => 'success', 'data' => []]);
        exit;
    }
    $slabs = $ai_db->aiGetQuery("SELECT * FROM hrms_ptax_slabs WHERE ptax_rule_id = $rule_id ORDER BY salary_from ASC");
    echo json_encode([
        'status' => 'success',
        'data' => $slabs
    ]);
    exit;

} else if ($action === 'save_rule') {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
        $state_name = mysqli_real_escape_string($ai_conn, $_POST['state_name'] ?? '');
        $tax_type = mysqli_real_escape_string($ai_conn, $_POST['tax_type'] ?? 'MONTHLY');
        $applicable_male = isset($_POST['applicable_male']) ? 1 : 0;
        $applicable_female = isset($_POST['applicable_female']) ? 1 : 0;

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

        // Decode the JSON slabs payload
        $slabs_json = $_POST['slabs'] ?? '[]';
        $slabs = json_decode($slabs_json, true);

        if ($id > 0) {
            $sql = "UPDATE hrms_ptax_rules SET 
                        state_name = '$state_name',
                        effective_date = '$effective_date',
                        tax_type = '$tax_type',
                        applicable_male = $applicable_male,
                        applicable_female = $applicable_female,
                        updated_by = '$username'
                    WHERE id = $id AND company_id = $company_id";
            $result = $ai_db->aiQuery($sql);
            $rule_id = $id;
        } else {
            $sql = "INSERT INTO hrms_ptax_rules (
                        company_id, state_name, effective_date, tax_type, 
                        applicable_male, applicable_female, created_by, updated_by
                    ) VALUES (
                        $company_id, '$state_name', '$effective_date', '$tax_type', 
                        $applicable_male, $applicable_female, '$username', '$username'
                    )";
            $result = $ai_db->aiQuery($sql);
            $rule_id = $ai_db->aiLastInsert();
        }

        if ($result && $rule_id > 0) {
            // Delete existing slabs for this rule
            $ai_db->aiQuery("DELETE FROM hrms_ptax_slabs WHERE ptax_rule_id = $rule_id");

            // Insert new slabs
            if (is_array($slabs)) {
                foreach ($slabs as $slab) {
                    $salary_from = floatval($slab['salary_from'] ?? 0);
                    $salary_to = floatval($slab['salary_to'] ?? 99999999);
                    $rate = floatval($slab['rate'] ?? 0);
                    $apr = floatval($slab['apr'] ?? 0);
                    $may = floatval($slab['may'] ?? 0);
                    $jun = floatval($slab['jun'] ?? 0);
                    $jul = floatval($slab['jul'] ?? 0);
                    $aug = floatval($slab['aug'] ?? 0);
                    $sep = floatval($slab['sep'] ?? 0);
                    $oct = floatval($slab['oct'] ?? 0);
                    $nov = floatval($slab['nov'] ?? 0);
                    $dec = floatval($slab['dec'] ?? 0);
                    $jan = floatval($slab['jan'] ?? 0);
                    $feb = floatval($slab['feb'] ?? 0);
                    $mar = floatval($slab['mar'] ?? 0);

                    $slabSql = "INSERT INTO hrms_ptax_slabs (
                                    ptax_rule_id, salary_from, salary_to, rate, 
                                    apr, may, jun, jul, aug, sep, oct, nov, `dec`, jan, feb, mar
                                ) VALUES (
                                    $rule_id, $salary_from, $salary_to, $rate,
                                    $apr, $may, $jun, $jul, $aug, $sep, $oct, $nov, $dec, $jan, $feb, $mar
                                )";
                    $ai_db->aiQuery($slabSql);
                }
            }

            echo json_encode(['status' => 'success', 'message' => 'Professional Tax Rule saved successfully.', 'rule_id' => $rule_id]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to save Professional Tax Rule.']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
    }
    exit;

} else if ($action === 'delete_rule') {
    $id = isset($_GET['id']) ? intval($_GET['id']) : 0;
    if ($id > 0) {
        $result = $ai_db->aiQuery("DELETE FROM hrms_ptax_rules WHERE id = $id AND company_id = $company_id");
        if ($result) {
            echo json_encode(['status' => 'success', 'message' => 'Professional Tax Rule deleted successfully.']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to delete Professional Tax Rule.']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Invalid ID specified.']);
    }
    exit;
}

echo json_encode(['status' => 'error', 'message' => 'Invalid action specified.']);
exit;
?>