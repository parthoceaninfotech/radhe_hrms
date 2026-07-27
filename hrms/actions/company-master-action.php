<?php
require_once('../root/config.php');
global $ai_db;
global $ai_core;
global $ai_conn;

header('Content-Type: application/json');

$action = isset($_GET['action']) ? $_GET['action'] : '';

if ($action === 'view') {
    $id = isset($_SESSION['selected_company_id']) ? intval($_SESSION['selected_company_id']) : 0;
    if ($id > 0) {
        $companies = $ai_db->aiGetQuery("SELECT * FROM hrms_companies WHERE id = $id ORDER BY id ASC");
    } else {
        $companies = $ai_db->aiGetQuery("SELECT * FROM hrms_companies ORDER BY id ASC");
    }
    echo json_encode([
        'status' => 'success',
        'data' => $companies
    ]);
    exit;
} else if ($action === 'select') {
    $id = isset($_GET['id']) ? intval($_GET['id']) : 0;
    if ($id > 0) {
        $_SESSION['selected_company_id'] = $id;
        echo json_encode(['status' => 'success']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Invalid ID.']);
    }
    exit;
} else if ($action === 'list') {
    $companies = $ai_db->aiGetQuery("SELECT * FROM hrms_companies ORDER BY id ASC");
    echo json_encode([
        'status' => 'success',
        'data' => $companies
    ]);
    exit;
} else if ($action === 'next_code') {
    $res = $ai_db->aiGetQuery("SELECT MAX(CAST(company_code AS UNSIGNED)) as max_code FROM hrms_companies");
    $max_code = isset($res[0]['max_code']) ? intval($res[0]['max_code']) : 0;
    $next_code = str_pad($max_code + 1, 3, '0', STR_PAD_LEFT);
    echo json_encode([
        'status' => 'success',
        'next_code' => $next_code
    ]);
    exit;
} else if ($action === 'upload') {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $type = isset($_GET['type']) ? $_GET['type'] : '';
        $old_file = isset($_POST['old_file']) ? $_POST['old_file'] : '';

        if (!isset($_FILES['file']) || $_FILES['file']['error'] !== 0) {
            echo json_encode(['status' => 'error', 'message' => 'No file uploaded or file upload error.']);
            exit;
        }

        $folder = '';
        if ($type === 'logo') {
            $folder = '../uploads/logos/';
        } elseif ($type === 'signature') {
            $folder = '../uploads/signatures/';
        } elseif ($type === 'extra') {
            $folder = '../uploads/specimens/';
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Invalid upload type specified.']);
            exit;
        }

        $new_name = $ai_core->aiUpload($_FILES['file'], $folder, 'image', $old_file);
        if ($new_name) {
            echo json_encode(['status' => 'success', 'filename' => $new_name]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'File upload failed.']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
    }
    exit;
} else if ($action === 'save') {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = isset($_POST['id']) ? intval($_POST['id']) : 0;

        // Map form inputs to database columns
        $company_id = mysqli_real_escape_string($ai_conn, $_POST['company_id'] ?? '');
        $company_name = mysqli_real_escape_string($ai_conn, $_POST['company_name'] ?? '');
        $address = mysqli_real_escape_string($ai_conn, $_POST['address'] ?? '');
        $nature_of_bus = mysqli_real_escape_string($ai_conn, $_POST['nature_of_bus'] ?? '');
        $owner_name = mysqli_real_escape_string($ai_conn, $_POST['owner_name'] ?? '');
        $owner_desig = mysqli_real_escape_string($ai_conn, $_POST['owner_desig'] ?? '');
        $owner_address = mysqli_real_escape_string($ai_conn, $_POST['owner_address'] ?? '');
        $contact_no = mysqli_real_escape_string($ai_conn, $_POST['contact_no'] ?? '');

        $official_name = mysqli_real_escape_string($ai_conn, $_POST['official_name'] ?? '');
        $official_address = mysqli_real_escape_string($ai_conn, $_POST['official_address'] ?? '');
        $auth_name = mysqli_real_escape_string($ai_conn, $_POST['auth_name'] ?? '');
        $auth_desig = mysqli_real_escape_string($ai_conn, $_POST['auth_desig'] ?? '');
        $auth_address = mysqli_real_escape_string($ai_conn, $_POST['auth_address'] ?? '');
        $email = mysqli_real_escape_string($ai_conn, $_POST['email'] ?? '');
        $website = mysqli_real_escape_string($ai_conn, $_POST['website'] ?? '');

        $pan_no = mysqli_real_escape_string($ai_conn, $_POST['pan_no'] ?? '');
        $tan_no = mysqli_real_escape_string($ai_conn, $_POST['tan_no'] ?? '');
        $pf_code = mysqli_real_escape_string($ai_conn, $_POST['pf_no'] ?? '');
        $esic_code = mysqli_real_escape_string($ai_conn, $_POST['esic_no'] ?? '');
        $reg_no = mysqli_real_escape_string($ai_conn, $_POST['cin_no'] ?? '');
        $reg_date = mysqli_real_escape_string($ai_conn, $_POST['regis_date'] ?? '');

        // SMTP / Mailing
        $mailing_email = mysqli_real_escape_string($ai_conn, $_POST['sender_mail'] ?? '');
        $mailing_address = mysqli_real_escape_string($ai_conn, $_POST['mail_server'] ?? '');
        $mailing_phone = mysqli_real_escape_string($ai_conn, $_POST['mail_port'] ?? '');

        // Newly added columns from Tab 2 and Tab 3
        $cit_tds_address = mysqli_real_escape_string($ai_conn, $_POST['cit_tds_address'] ?? '');
        $place = mysqli_real_escape_string($ai_conn, $_POST['place'] ?? '');
        $city = mysqli_real_escape_string($ai_conn, $_POST['city'] ?? '');
        $district = mysqli_real_escape_string($ai_conn, $_POST['district'] ?? '');
        $state = mysqli_real_escape_string($ai_conn, $_POST['state'] ?? '');
        $er1_code = mysqli_real_escape_string($ai_conn, $_POST['er1_code'] ?? '');

        $machine_code_percentage = mysqli_real_escape_string($ai_conn, $_POST['machine_code_percentage'] ?? '');
        $leave_salary_val = mysqli_real_escape_string($ai_conn, $_POST['leave_salary_val'] ?? '');

        $pt_prc_no = mysqli_real_escape_string($ai_conn, $_POST['pt_prc_no'] ?? '');
        $pt_pec_no = mysqli_real_escape_string($ai_conn, $_POST['pt_pec_no'] ?? '');
        $labour_id_no = mysqli_real_escape_string($ai_conn, $_POST['labour_id_no'] ?? '');
        $lwf_est_code = mysqli_real_escape_string($ai_conn, $_POST['lwf_est_code'] ?? '');
        $license_reg_no = mysqli_real_escape_string($ai_conn, $_POST['license_reg_no'] ?? '');
        $w_off = mysqli_real_escape_string($ai_conn, $_POST['w_off'] ?? 'NONE');

        $register_format = mysqli_real_escape_string($ai_conn, $_POST['register_format'] ?? '');
        $leave_code_muster = mysqli_real_escape_string($ai_conn, $_POST['leave_code_muster'] ?? 'PL');
        $leave_month_start = mysqli_real_escape_string($ai_conn, $_POST['leave_month_start'] ?? '1');
        $salary_process_on = mysqli_real_escape_string($ai_conn, $_POST['salary_process_on'] ?? '');
        $pt_state = mysqli_real_escape_string($ai_conn, $_POST['pt_state'] ?? '');

        $mail_username = mysqli_real_escape_string($ai_conn, $_POST['mail_username'] ?? '');
        $mail_password = mysqli_real_escape_string($ai_conn, $_POST['mail_password'] ?? '');

        // Handle checkbox active states (1 if checked, 0 otherwise)
        $machine_code_excel = isset($_POST['machine_code_excel']) ? '1' : '0';
        $leave_in_salary = isset($_POST['leave_in_salary']) ? '1' : '0';
        $gratuity_in_salary = isset($_POST['gratuity_in_salary']) ? '1' : '0';
        $leave_in_muster = isset($_POST['leave_in_muster']) ? '1' : '0';
        $maintain_leave = isset($_POST['maintain_leave']) ? '1' : '0';
        $bonus_in_salary = isset($_POST['bonus_in_salary']) ? '1' : '0';
        $maintain_loan_record = isset($_POST['maintain_loan_record']) ? '1' : '0';
        $lwf_applicable = isset($_POST['lwf_applicable']) ? '1' : '0';
        $mail_ssl = isset($_POST['mail_ssl']) ? '1' : '0';

        // Handle logo and signature file uploads if provided
        $logo_name = '';
        if (isset($_FILES['logo']) && $_FILES['logo']['error'] === 0) {
            $logo_name = $ai_core->aiUpload($_FILES['logo'], '../uploads/logos/', 'image', $_POST['old_logo'] ?? '');
        } else {
            $logo_name = $_POST['old_logo'] ?? '';
        }

        $sig_name = '';
        if (isset($_FILES['owner_signature']) && $_FILES['owner_signature']['error'] === 0) {
            $sig_name = $ai_core->aiUpload($_FILES['owner_signature'], '../uploads/signatures/', 'image', $_POST['old_sig'] ?? '');
        } else {
            $sig_name = $_POST['old_sig'] ?? '';
        }

        if ($id > 0) {
            // UPDATE query
            $sql = "UPDATE hrms_companies SET 
                        company_code = '$company_id',
                        company_name = '$company_name',
                        address = '$address',
                        nature_of_bus = '$nature_of_bus',
                        owner_name = '$owner_name',
                        owner_desig = '$owner_desig',
                        owner_address = '$owner_address',
                        contact_no = '$contact_no',
                        official_name = '$official_name',
                        official_address = '$official_address',
                        auth_name = '$auth_name',
                        auth_desig = '$auth_desig',
                        auth_address = '$auth_address',
                        email = '$email',
                        website = '$website',
                        pan_no = '$pan_no',
                        tan_no = '$tan_no',
                        pf_code = '$pf_code',
                        esic_code = '$esic_code',
                        reg_no = '$reg_no',
                        reg_date = " . (!empty($reg_date) ? "'$reg_date'" : "NULL") . ",
                        logo = '$logo_name',
                        owner_signature = '$sig_name',
                        mailing_email = '$mailing_email',
                        mailing_address = '$mailing_address',
                        mailing_phone = '$mailing_phone',
                        cit_tds_address = '$cit_tds_address',
                        place = '$place',
                        city = '$city',
                        district = '$district',
                        state = '$state',
                        er1_code = '$er1_code',
                        machine_code_excel = '$machine_code_excel',
                        machine_code_percentage = '$machine_code_percentage',
                        leave_in_salary = '$leave_in_salary',
                        leave_salary_val = '$leave_salary_val',
                        gratuity_in_salary = '$gratuity_in_salary',
                        leave_in_muster = '$leave_in_muster',
                        maintain_leave = '$maintain_leave',
                        bonus_in_salary = '$bonus_in_salary',
                        maintain_loan_record = '$maintain_loan_record',
                        pt_prc_no = '$pt_prc_no',
                        pt_pec_no = '$pt_pec_no',
                        lwf_applicable = '$lwf_applicable',
                        labour_id_no = '$labour_id_no',
                        lwf_est_code = '$lwf_est_code',
                        license_reg_no = '$license_reg_no',
                        w_off = '$w_off',
                        register_format = '$register_format',
                        leave_code_muster = '$leave_code_muster',
                        leave_month_start = '$leave_month_start',
                        salary_process_on = '$salary_process_on',
                        pt_state = '$pt_state',
                        mail_ssl = '$mail_ssl',
                        mail_username = '$mail_username',
                        mail_password = '$mail_password'
                    WHERE id = $id";

            $result = $ai_db->aiQuery($sql);
            if ($result) {
                if (isset($_SESSION['selected_company_id']) && intval($_SESSION['selected_company_id']) === $id) {
                    $_SESSION['selected_company_name'] = $company_name;
                }
                echo json_encode(['status' => 'success', 'message' => 'Company details updated successfully.']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Failed to update company details.']);
            }
        } else {
            // INSERT query
            $sql = "INSERT INTO hrms_companies (
                        company_code, company_name, address, nature_of_bus, owner_name, owner_desig, owner_address, contact_no,
                        official_name, official_address, auth_name, auth_desig, auth_address, email, website,
                        pan_no, tan_no, pf_code, esic_code, reg_no, reg_date, logo, owner_signature,
                        mailing_email, mailing_address, mailing_phone, status,
                        cit_tds_address, place, city, district, state, er1_code,
                        machine_code_excel, machine_code_percentage, leave_in_salary, leave_salary_val,
                        gratuity_in_salary, leave_in_muster, maintain_leave, bonus_in_salary, maintain_loan_record,
                        pt_prc_no, pt_pec_no, lwf_applicable, labour_id_no, lwf_est_code, license_reg_no,
                        w_off, register_format, leave_code_muster, leave_month_start, salary_process_on, pt_state,
                        mail_ssl, mail_username, mail_password
                    ) VALUES (
                        '$company_id', '$company_name', '$address', '$nature_of_bus', '$owner_name', '$owner_desig', '$owner_address', '$contact_no',
                        '$official_name', '$official_address', '$auth_name', '$auth_desig', '$auth_address', '$email', '$website',
                        '$pan_no', '$tan_no', '$pf_code', '$esic_code', '$reg_no', " . (!empty($reg_date) ? "'$reg_date'" : "NULL") . ", '$logo_name', '$sig_name',
                        '$mailing_email', '$mailing_address', '$mailing_phone', 'active',
                        '$cit_tds_address', '$place', '$city', '$district', '$state', '$er1_code',
                        '$machine_code_excel', '$machine_code_percentage', '$leave_in_salary', '$leave_salary_val',
                        '$gratuity_in_salary', '$leave_in_muster', '$maintain_leave', '$bonus_in_salary', '$maintain_loan_record',
                        '$pt_prc_no', '$pt_pec_no', '$lwf_applicable', '$labour_id_no', '$lwf_est_code', '$license_reg_no',
                        '$w_off', '$register_format', '$leave_code_muster', '$leave_month_start', '$salary_process_on', '$pt_state',
                        '$mail_ssl', '$mail_username', '$mail_password'
                    )";

            $result = $ai_db->aiQuery($sql);
            if ($result) {
                $new_id = $ai_db->aiLastInsert();
                $_SESSION['selected_company_id'] = $new_id;
                $_SESSION['selected_company_name'] = $company_name;
                echo json_encode(['status' => 'success', 'message' => 'Company created successfully.', 'insert_id' => $new_id]);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Failed to create company.']);
            }
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
    }
    exit;
} else if ($action === 'delete') {
    $id = isset($_GET['id']) ? intval($_GET['id']) : 0;
    if ($id > 0) {
        $result = $ai_db->aiQuery("DELETE FROM hrms_companies WHERE id = $id");
        if ($result) {
            if (isset($_SESSION['selected_company_id']) && intval($_SESSION['selected_company_id']) === $id) {
                unset($_SESSION['selected_company_id']);
                unset($_SESSION['selected_company_name']);
            }
            echo json_encode(['status' => 'success', 'message' => 'Company record deleted successfully.']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to delete company record.']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Invalid ID specified.']);
    }
    exit;
}

echo json_encode(['status' => 'error', 'message' => 'Invalid action specified.']);
exit;
?>