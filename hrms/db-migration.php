<?php
/**
 * Database Migration Script
 * Run this file to apply schema updates (e.g. creating tables, adding columns)
 * Can be run via CLI: php db-migration.php
 * Or via web browser: http://your-domain/hrms/db-migration.php
 */

// Handle CLI environment host detection constraint
if (php_sapi_name() === 'cli') {
    if (!isset($_SERVER['HTTP_HOST'])) {
        $_SERVER['HTTP_HOST'] = 'localhost';
    }
}

require_once 'root/config.php';
global $ai_db, $ai_conn;

echo "<h3>Starting database migration...</h3>\n";

// 1. Create hrms_employeemaster table if not exists
$tableSql = "CREATE TABLE IF NOT EXISTS hrms_employeemaster (
    id INT AUTO_INCREMENT PRIMARY KEY,
    company_id INT NOT NULL,
    emp_code VARCHAR(50) NOT NULL,
    emp_name VARCHAR(255) NOT NULL,
    father_name VARCHAR(255) DEFAULT '',
    address_1 VARCHAR(255) DEFAULT '',
    address_2 VARCHAR(255) DEFAULT '',
    address_3 VARCHAR(255) DEFAULT '',
    city VARCHAR(100) DEFAULT '',
    pincode VARCHAR(20) DEFAULT '',
    mobile VARCHAR(20) DEFAULT '',
    emergency_person VARCHAR(100) DEFAULT '',
    emergency_contact VARCHAR(20) DEFAULT '',
    email VARCHAR(150) DEFAULT '',
    branch_id INT DEFAULT 0,
    dept_id INT DEFAULT 0,
    sub_dept VARCHAR(100) DEFAULT '',
    desig_id INT DEFAULT 0,
    marital_status VARCHAR(50) DEFAULT '',
    gender VARCHAR(20) DEFAULT '',
    blood_group VARCHAR(10) DEFAULT '',
    category VARCHAR(50) DEFAULT '',
    punch_code VARCHAR(50) DEFAULT '',
    joining_date DATE NULL,
    birth_date DATE NULL,
    pension TINYINT(1) DEFAULT 1,
    pf_applicable TINYINT(1) DEFAULT 1,
    esic_applicable TINYINT(1) DEFAULT 0,
    pt_applicable TINYINT(1) DEFAULT 0,
    ceiling_amount DECIMAL(12,2) DEFAULT 0.00,
    pf_start_date DATE NULL,
    ot_applicable TINYINT(1) DEFAULT 1,
    abry_scheme TINYINT(1) DEFAULT 0,
    salary_mode VARCHAR(50) DEFAULT 'BANK',
    bank_name VARCHAR(100) DEFAULT '',
    branch_name VARCHAR(100) DEFAULT '',
    bank_account_no VARCHAR(100) DEFAULT '',
    ifsc_code VARCHAR(50) DEFAULT '',
    aadhar_no VARCHAR(50) DEFAULT '',
    pan_no VARCHAR(50) DEFAULT '',
    pf_no VARCHAR(50) DEFAULT '',
    uan_no VARCHAR(50) DEFAULT '',
    esic_no VARCHAR(50) DEFAULT '',
    resign TINYINT(1) DEFAULT 0,
    resign_date DATE NULL,
    photo_path VARCHAR(255) DEFAULT '',
    signature_path VARCHAR(255) DEFAULT '',
    status VARCHAR(20) DEFAULT 'active',
    created_by VARCHAR(100) DEFAULT '',
    updated_by VARCHAR(100) DEFAULT '',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    KEY idx_company_id (company_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";

if ($ai_db->aiQuery($tableSql)) {
    echo "<p style='color: green;'>[OK] Table 'hrms_employeemaster' verified / created successfully.</p>\n";
} else {
    echo "<p style='color: red;'>[ERROR] Failed to verify / create table 'hrms_employeemaster'.</p>\n";
}

// 2. Add resign_remark column if not exists
$checkColumnQuery = "SHOW COLUMNS FROM hrms_employeemaster LIKE 'resign_remark'";
$colResult = mysqli_query($ai_conn, $checkColumnQuery);

if ($colResult && mysqli_num_rows($colResult) == 0) {
    // Column does not exist, add it
    $alterSql = "ALTER TABLE hrms_employeemaster ADD COLUMN resign_remark TEXT AFTER resign_date";
    if ($ai_db->aiQuery($alterSql)) {
        echo "<p style='color: green;'>[OK] Column 'resign_remark' added successfully.</p>\n";
    } else {
        echo "<p style='color: red;'>[ERROR] Failed to add column 'resign_remark'.</p>\n";
    }
} else {
    echo "<p style='color: blue;'>[INFO] Column 'resign_remark' already exists.</p>\n";
}

echo "<h3>Migration completed successfully.</h3>\n";
?>