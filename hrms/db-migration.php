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

// 3. Create hrms_employee_payroll table
$payrollTableSql = "CREATE TABLE IF NOT EXISTS hrms_employee_payroll (
    id INT AUTO_INCREMENT PRIMARY KEY,
    employee_id INT NOT NULL,
    company_id INT NOT NULL,
    payl_type VARCHAR(50) DEFAULT 'Monthly',
    pf_applicable TINYINT(1) DEFAULT 0,
    pf_percentage DECIMAL(5,2) DEFAULT 0.00,
    pf_amount DECIMAL(12,2) DEFAULT 0.00,
    ptax_applicable TINYINT(1) DEFAULT 1,
    ptax_amount DECIMAL(12,2) DEFAULT 0.00,
    ptax_type VARCHAR(2) DEFAULT 'V',
    gratuity DECIMAL(12,2) DEFAULT 0.00,
    bonus_percentage DECIMAL(5,2) DEFAULT 0.00,
    basic_rate DECIMAL(12,2) DEFAULT 0.00,
    basic_amt DECIMAL(12,2) DEFAULT 0.00,
    basic_type VARCHAR(2) DEFAULT 'V',
    hra_rate DECIMAL(12,2) DEFAULT 0.00,
    hra_amt DECIMAL(12,2) DEFAULT 0.00,
    hra_type VARCHAR(2) DEFAULT 'V',
    medical_rate DECIMAL(12,2) DEFAULT 0.00,
    medical_amt DECIMAL(12,2) DEFAULT 0.00,
    medical_type VARCHAR(2) DEFAULT 'V',
    conveyance_rate DECIMAL(12,2) DEFAULT 0.00,
    conveyance_amt DECIMAL(12,2) DEFAULT 0.00,
    conveyance_type VARCHAR(2) DEFAULT 'V',
    education_rate DECIMAL(12,2) DEFAULT 0.00,
    education_amt DECIMAL(12,2) DEFAULT 0.00,
    education_type VARCHAR(2) DEFAULT 'V',
    washing_rate DECIMAL(12,2) DEFAULT 0.00,
    washing_amt DECIMAL(12,2) DEFAULT 0.00,
    washing_type VARCHAR(2) DEFAULT 'V',
    paper_rate DECIMAL(12,2) DEFAULT 0.00,
    paper_amt DECIMAL(12,2) DEFAULT 0.00,
    paper_type VARCHAR(2) DEFAULT 'V',
    recovery_rate DECIMAL(12,2) DEFAULT 0.00,
    recovery_amt DECIMAL(12,2) DEFAULT 0.00,
    recovery_type VARCHAR(2) DEFAULT 'V',
    city_rate DECIMAL(12,2) DEFAULT 0.00,
    city_amt DECIMAL(12,2) DEFAULT 0.00,
    city_type VARCHAR(2) DEFAULT 'V',
    atten_rate DECIMAL(12,2) DEFAULT 0.00,
    atten_amt DECIMAL(12,2) DEFAULT 0.00,
    atten_type VARCHAR(2) DEFAULT 'V',
    other_allow_rate DECIMAL(12,2) DEFAULT 0.00,
    other_allow_amt DECIMAL(12,2) DEFAULT 0.00,
    other_allow_type VARCHAR(2) DEFAULT 'V',
    leave_allow_rate DECIMAL(12,2) DEFAULT 0.00,
    leave_allow_amt DECIMAL(12,2) DEFAULT 0.00,
    leave_allow_type VARCHAR(2) DEFAULT 'V',
    other_ded_rate DECIMAL(12,2) DEFAULT 0.00,
    other_ded_amt DECIMAL(12,2) DEFAULT 0.00,
    other_ded_type VARCHAR(2) DEFAULT 'V',
    total_earn DECIMAL(12,2) DEFAULT 0.00,
    total_ded DECIMAL(12,2) DEFAULT 0.00,
    net_amount DECIMAL(12,2) DEFAULT 0.00,
    employer_pf DECIMAL(12,2) DEFAULT 0.00,
    act_wage DECIMAL(12,2) DEFAULT 0.00,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    UNIQUE KEY idx_emp_id (employee_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";

if ($ai_db->aiQuery($payrollTableSql)) {
    echo "<p style='color: green;'>[OK] Table 'hrms_employee_payroll' verified / created successfully.</p>\n";
} else {
    echo "<p style='color: red;'>[ERROR] Failed to verify / create table 'hrms_employee_payroll'.</p>\n";
}

// 4. Create hrms_employee_hour_rate table
$hourRateTableSql = "CREATE TABLE IF NOT EXISTS hrms_employee_hour_rate (
    id INT AUTO_INCREMENT PRIMARY KEY,
    employee_id INT NOT NULL,
    company_id INT NOT NULL,
    effective_year INT NOT NULL,
    effective_month INT NOT NULL,
    day_rate DECIMAL(12,2) DEFAULT 0.00,
    night_rate DECIMAL(12,2) DEFAULT 0.00,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    UNIQUE KEY idx_emp_period (employee_id, effective_year, effective_month)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";

if ($ai_db->aiQuery($hourRateTableSql)) {
    echo "<p style='color: green;'>[OK] Table 'hrms_employee_hour_rate' verified / created successfully.</p>\n";
} else {
    echo "<p style='color: red;'>[ERROR] Failed to verify / create table 'hrms_employee_hour_rate'.</p>\n";
}

// 5. Create hrms_employee_nominees table
$nomineesTableSql = "CREATE TABLE IF NOT EXISTS hrms_employee_nominees (
    id INT AUTO_INCREMENT PRIMARY KEY,
    employee_id INT NOT NULL,
    company_id INT NOT NULL,
    dependent_name VARCHAR(255) NOT NULL,
    relation VARCHAR(100) DEFAULT '',
    birth_date DATE NULL,
    share_percentage DECIMAL(5,2) DEFAULT 0.00,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    KEY idx_nom_emp_id (employee_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";

if ($ai_db->aiQuery($nomineesTableSql)) {
    echo "<p style='color: green;'>[OK] Table 'hrms_employee_nominees' verified / created successfully.</p>\n";
} else {
    echo "<p style='color: red;'>[ERROR] Failed to verify / create table 'hrms_employee_nominees'.</p>\n";
}

// 6. Create hrms_pf_rates table
$pfRatesTableSql = "CREATE TABLE IF NOT EXISTS hrms_pf_rates (
    id INT AUTO_INCREMENT PRIMARY KEY,
    company_id INT NOT NULL,
    pf_ac_1 DECIMAL(10,3) DEFAULT 0.000,
    pf_ac_2 DECIMAL(10,3) DEFAULT 0.000,
    pf_ac_10 DECIMAL(10,3) DEFAULT 0.000,
    pf_ac_21 DECIMAL(10,3) DEFAULT 0.000,
    pf_ac_22 DECIMAL(10,3) DEFAULT 0.000,
    pension DECIMAL(10,3) DEFAULT 0.000,
    employer_pf DECIMAL(10,3) DEFAULT 0.000,
    employee_pf DECIMAL(10,3) DEFAULT 0.000,
    employee_pen DECIMAL(10,3) DEFAULT 0.000,
    max_amount DECIMAL(12,2) DEFAULT 0.00,
    pf_ceiling_amount DECIMAL(12,2) DEFAULT 0.00,
    effective_date DATE NOT NULL,
    created_by VARCHAR(100) DEFAULT '',
    updated_by VARCHAR(100) DEFAULT '',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    KEY idx_company_id (company_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";

if ($ai_db->aiQuery($pfRatesTableSql)) {
    echo "<p style='color: green;'>[OK] Table 'hrms_pf_rates' verified / created successfully.</p>\n";
} else {
    echo "<p style='color: red;'>[ERROR] Failed to verify / create table 'hrms_pf_rates'.</p>\n";
}

// 7. Create hrms_pf_branch_components table
$pfComponentsTableSql = "CREATE TABLE IF NOT EXISTS hrms_pf_branch_components (
    id INT AUTO_INCREMENT PRIMARY KEY,
    company_id INT NOT NULL,
    branch_id INT NOT NULL,
    component_name VARCHAR(100) NOT NULL,
    is_applicable TINYINT(1) DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    UNIQUE KEY idx_branch_comp (company_id, branch_id, component_name)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";

if ($ai_db->aiQuery($pfComponentsTableSql)) {
    echo "<p style='color: green;'>[OK] Table 'hrms_pf_branch_components' verified / created successfully.</p>\n";
} else {
    echo "<p style='color: red;'>[ERROR] Failed to verify / create table 'hrms_pf_branch_components'.</p>\n";
}

// 8. Create hrms_ptax_rules table
$ptaxRulesTableSql = "CREATE TABLE IF NOT EXISTS hrms_ptax_rules (
    id INT AUTO_INCREMENT PRIMARY KEY,
    company_id INT NOT NULL,
    state_name VARCHAR(100) NOT NULL,
    effective_date DATE NOT NULL,
    tax_type VARCHAR(20) DEFAULT 'MONTHLY',
    applicable_male TINYINT(1) DEFAULT 1,
    applicable_female TINYINT(1) DEFAULT 1,
    created_by VARCHAR(100) DEFAULT '',
    updated_by VARCHAR(100) DEFAULT '',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    KEY idx_company_id (company_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";

if ($ai_db->aiQuery($ptaxRulesTableSql)) {
    echo "<p style='color: green;'>[OK] Table 'hrms_ptax_rules' verified / created successfully.</p>\n";
} else {
    echo "<p style='color: red;'>[ERROR] Failed to verify / create table 'hrms_ptax_rules'.</p>\n";
}

// 9. Create hrms_ptax_slabs table
$ptaxSlabsTableSql = "CREATE TABLE IF NOT EXISTS hrms_ptax_slabs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    ptax_rule_id INT NOT NULL,
    salary_from DECIMAL(12,2) DEFAULT 0.00,
    salary_to DECIMAL(12,2) DEFAULT 99999999.00,
    rate DECIMAL(12,2) DEFAULT 0.00,
    apr DECIMAL(12,2) DEFAULT 0.00,
    may DECIMAL(12,2) DEFAULT 0.00,
    jun DECIMAL(12,2) DEFAULT 0.00,
    jul DECIMAL(12,2) DEFAULT 0.00,
    aug DECIMAL(12,2) DEFAULT 0.00,
    sep DECIMAL(12,2) DEFAULT 0.00,
    oct DECIMAL(12,2) DEFAULT 0.00,
    nov DECIMAL(12,2) DEFAULT 0.00,
    `dec` DECIMAL(12,2) DEFAULT 0.00,
    jan DECIMAL(12,2) DEFAULT 0.00,
    feb DECIMAL(12,2) DEFAULT 0.00,
    mar DECIMAL(12,2) DEFAULT 0.00,
    KEY idx_rule_id (ptax_rule_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";

if ($ai_db->aiQuery($ptaxSlabsTableSql)) {
    echo "<p style='color: green;'>[OK] Table 'hrms_ptax_slabs' verified / created successfully.</p>\n";
} else {
    echo "<p style='color: red;'>[ERROR] Failed to verify / create table 'hrms_ptax_slabs'.</p>\n";
}

// 10. Create hrms_glwf_rates table
$glwfRatesTableSql = "CREATE TABLE IF NOT EXISTS hrms_glwf_rates (
    id INT AUTO_INCREMENT PRIMARY KEY,
    company_id INT NOT NULL,
    state_name VARCHAR(100) NOT NULL,
    glwf_rate DECIMAL(10,3) DEFAULT 0.000,
    company_rate DECIMAL(10,3) DEFAULT 0.000,
    effective_date DATE NOT NULL,
    deduct_months VARCHAR(255) DEFAULT '',
    created_by VARCHAR(100) DEFAULT '',
    updated_by VARCHAR(100) DEFAULT '',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    KEY idx_company_id (company_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";

if ($ai_db->aiQuery($glwfRatesTableSql)) {
    echo "<p style='color: green;'>[OK] Table 'hrms_glwf_rates' verified / created successfully.</p>\n";
} else {
    echo "<p style='color: red;'>[ERROR] Failed to verify / create table 'hrms_glwf_rates'.</p>\n";
}

// 11. Create hrms_gratuity_rates table
$gratuityRatesTableSql = "CREATE TABLE IF NOT EXISTS hrms_gratuity_rates (
    id INT AUTO_INCREMENT PRIMARY KEY,
    company_id INT NOT NULL,
    gratuity_rate DECIMAL(10,3) DEFAULT 0.000,
    effective_date DATE NOT NULL,
    created_by VARCHAR(100) DEFAULT '',
    updated_by VARCHAR(100) DEFAULT '',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    KEY idx_company_id (company_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";

if ($ai_db->aiQuery($gratuityRatesTableSql)) {
    echo "<p style='color: green;'>[OK] Table 'hrms_gratuity_rates' verified / created successfully.</p>\n";
} else {
    echo "<p style='color: red;'>[ERROR] Failed to verify / create table 'hrms_gratuity_rates'.</p>\n";
}

// 12. Create hrms_bonus_rates table
$bonusRatesTableSql = "CREATE TABLE IF NOT EXISTS hrms_bonus_rates (
    id INT AUTO_INCREMENT PRIMARY KEY,
    company_id INT NOT NULL,
    bonus_rate DECIMAL(10,3) DEFAULT 0.000,
    pay_basic_limit DECIMAL(12,2) DEFAULT 0.00,
    bonus_ceiling DECIMAL(12,2) DEFAULT 0.00,
    min_pay_days INT DEFAULT 0,
    effective_date DATE NOT NULL,
    created_by VARCHAR(100) DEFAULT '',
    updated_by VARCHAR(100) DEFAULT '',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    KEY idx_company_id (company_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";

if ($ai_db->aiQuery($bonusRatesTableSql)) {
    echo "<p style='color: green;'>[OK] Table 'hrms_bonus_rates' verified / created successfully.</p>\n";
} else {
    echo "<p style='color: red;'>[ERROR] Failed to verify / create table 'hrms_bonus_rates'.</p>\n";
}

// 13. Create hrms_esic_rates table
$esicRatesTableSql = "CREATE TABLE IF NOT EXISTS hrms_esic_rates (
    id INT AUTO_INCREMENT PRIMARY KEY,
    company_id INT NOT NULL,
    employee_rate DECIMAL(10,3) DEFAULT 0.750,
    employer_rate DECIMAL(10,3) DEFAULT 3.250,
    effective_date DATE NOT NULL,
    created_by VARCHAR(100) DEFAULT '',
    updated_by VARCHAR(100) DEFAULT '',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    KEY idx_company_id (company_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";

if ($ai_db->aiQuery($esicRatesTableSql)) {
    echo "<p style='color: green;'>[OK] Table 'hrms_esic_rates' verified / created successfully.</p>\n";
} else {
    echo "<p style='color: red;'>[ERROR] Failed to verify / create table 'hrms_esic_rates'.</p>\n";
}

// 14. Create hrms_minimum_wages table
$minWagesTableSql = "CREATE TABLE IF NOT EXISTS hrms_minimum_wages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    company_id INT NOT NULL,
    state_name VARCHAR(100) NOT NULL,
    zone_type VARCHAR(100) NOT NULL,
    effective_date DATE NOT NULL,
    highly_skilled DECIMAL(12,2) DEFAULT 0.00,
    skilled DECIMAL(12,2) DEFAULT 0.00,
    semi_skilled DECIMAL(12,2) DEFAULT 0.00,
    unskilled DECIMAL(12,2) DEFAULT 0.00,
    created_by VARCHAR(100) DEFAULT '',
    updated_by VARCHAR(100) DEFAULT '',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    KEY idx_company_id (company_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";

if ($ai_db->aiQuery($minWagesTableSql)) {
    echo "<p style='color: green;'>[OK] Table 'hrms_minimum_wages' verified / created successfully.</p>\n";
} else {
    echo "<p style='color: red;'>[ERROR] Failed to verify / create table 'hrms_minimum_wages'.</p>\n";
}

// 15. Create hrms_form16_branch_components table
$form16ComponentsTableSql = "CREATE TABLE IF NOT EXISTS hrms_form16_branch_components (
    id INT AUTO_INCREMENT PRIMARY KEY,
    company_id INT NOT NULL,
    branch_id INT NOT NULL,
    component_name VARCHAR(100) NOT NULL,
    is_applicable TINYINT(1) DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    UNIQUE KEY idx_branch_comp (company_id, branch_id, component_name)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";

if ($ai_db->aiQuery($form16ComponentsTableSql)) {

    echo "<p style='color: green;'>[OK] Table 'hrms_form16_branch_components' verified / created successfully.</p>\n";
} else {
    echo "<p style='color: red;'>[ERROR] Failed to verify / create table 'hrms_form16_branch_components'.</p>\n";
}

// 16. Create hrms_esic_branch_components table
$esicComponentsTableSql = "CREATE TABLE IF NOT EXISTS hrms_esic_branch_components (
    id INT AUTO_INCREMENT PRIMARY KEY,
    company_id INT NOT NULL,
    branch_id INT NOT NULL,
    component_name VARCHAR(100) NOT NULL,
    is_applicable TINYINT(1) DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    UNIQUE KEY idx_branch_comp (company_id, branch_id, component_name)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";

if ($ai_db->aiQuery($esicComponentsTableSql)) {
    echo "<p style='color: green;'>[OK] Table 'hrms_esic_branch_components' verified / created successfully.</p>\n";
} else {
    echo "<p style='color: red;'>[ERROR] Failed to verify / create table 'hrms_esic_branch_components'.</p>\n";
}

echo "<h3>Migration completed successfully.</h3>\n";
?>