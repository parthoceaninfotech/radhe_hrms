<?php
include 'root/config.php';
$ai_core->aiCheckLogin();

echo "<h2>Database Repair Tool</h2>";

// 1. Fix tbl_factory_quotations status column
$sql1 = "ALTER TABLE tbl_factory_quotations MODIFY COLUMN status VARCHAR(20) DEFAULT 'active'";
if($ai_db->aiQuery($sql1)) {
    echo "<p style='color:green;'>[SUCCESS] tbl_factory_quotations: status column modified to VARCHAR.</p>";
    $ai_db->aiQuery("UPDATE tbl_factory_quotations SET status = 'active' WHERE status = '0' OR status IS NULL OR status = ''");
    echo "<p style='color:green;'>[SUCCESS] tbl_factory_quotations: reset '0' values to 'active'.</p>";
} else {
    echo "<p style='color:red;'>[ERROR] Failed to modify status column in tbl_factory_quotations.</p>";
}

// 2. Ensure total_amount is float
$sql2 = "ALTER TABLE tbl_factory_quotations MODIFY COLUMN total_amount DECIMAL(15,2) DEFAULT 0.00";
$ai_db->aiQuery($sql2);

echo "<br><a href='factory_act_quotation.php'>Go Back to Quotations</a>";
