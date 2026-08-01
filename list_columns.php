<?php
require_once('root/config.php');
global $ai_db;
$columns = $ai_db->aiGetQuery("DESCRIBE hrms_employee_payroll");
foreach ($columns as $col) {
    echo $col['Field'] . " - " . $col['Type'] . "\n";
}
