<?php
include 'root/config.php';
global $ai_db;

echo "<h2>Database Migration</h2>";

$queries = [
    // Create or Alter hrms_departments
    "CREATE TABLE IF NOT EXISTS hrms_departments (
        id INT AUTO_INCREMENT PRIMARY KEY,
        company_id INT NOT NULL,
        dept_code VARCHAR(50) NOT NULL,
        dept_name VARCHAR(255) NOT NULL,
        status VARCHAR(20) DEFAULT 'active',
        created_by VARCHAR(255) NULL,
        updated_by VARCHAR(255) NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )",
    "ALTER TABLE hrms_departments ADD COLUMN IF NOT EXISTS created_by VARCHAR(255) NULL",
    "ALTER TABLE hrms_departments ADD COLUMN IF NOT EXISTS updated_by VARCHAR(255) NULL",
    "ALTER TABLE hrms_departments ADD COLUMN IF NOT EXISTS created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP",
    "ALTER TABLE hrms_departments ADD COLUMN IF NOT EXISTS updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP",

    // Create or Alter hrms_designations
    "CREATE TABLE IF NOT EXISTS hrms_designations (
        id INT AUTO_INCREMENT PRIMARY KEY,
        company_id INT NOT NULL,
        desig_code VARCHAR(50) NOT NULL,
        desig_name VARCHAR(255) NOT NULL,
        status VARCHAR(20) DEFAULT 'active',
        created_by VARCHAR(255) NULL,
        updated_by VARCHAR(255) NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )",
    "ALTER TABLE hrms_designations ADD COLUMN IF NOT EXISTS created_by VARCHAR(255) NULL",
    "ALTER TABLE hrms_designations ADD COLUMN IF NOT EXISTS updated_by VARCHAR(255) NULL",
    "ALTER TABLE hrms_designations ADD COLUMN IF NOT EXISTS created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP",
    "ALTER TABLE hrms_designations ADD COLUMN IF NOT EXISTS updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP"
];

foreach ($queries as $sql) {
    if ($ai_db->aiQuery($sql)) {
        echo "<p style='color:green;'>SUCCESS: " . htmlspecialchars(substr($sql, 0, 70)) . "...</p>";
    } else {
        echo "<p style='color:red;'>ERROR: " . htmlspecialchars(substr($sql, 0, 70)) . "...</p>";
    }
}

echo "<hr><p>Migration Complete.</p>";
?>