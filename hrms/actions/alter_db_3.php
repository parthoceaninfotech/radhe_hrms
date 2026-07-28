<?php
$_SERVER['HTTP_HOST'] = 'localhost';
require_once '../root/config.php';
global $ai_db;

$sql = "ALTER TABLE hrms_employee_payroll 
        ADD COLUMN IF NOT EXISTS washing_rate DECIMAL(12,2) DEFAULT 0.00 AFTER education_type,
        ADD COLUMN IF NOT EXISTS washing_amt DECIMAL(12,2) DEFAULT 0.00 AFTER washing_rate,
        ADD COLUMN IF NOT EXISTS washing_type VARCHAR(2) DEFAULT 'V' AFTER washing_amt,
        
        ADD COLUMN IF NOT EXISTS paper_rate DECIMAL(12,2) DEFAULT 0.00 AFTER washing_type,
        ADD COLUMN IF NOT EXISTS paper_amt DECIMAL(12,2) DEFAULT 0.00 AFTER paper_rate,
        ADD COLUMN IF NOT EXISTS paper_type VARCHAR(2) DEFAULT 'V' AFTER paper_amt,
        
        ADD COLUMN IF NOT EXISTS recovery_rate DECIMAL(12,2) DEFAULT 0.00 AFTER paper_type,
        ADD COLUMN IF NOT EXISTS recovery_amt DECIMAL(12,2) DEFAULT 0.00 AFTER recovery_rate,
        ADD COLUMN IF NOT EXISTS recovery_type VARCHAR(2) DEFAULT 'V' AFTER recovery_amt,
        
        ADD COLUMN IF NOT EXISTS city_rate DECIMAL(12,2) DEFAULT 0.00 AFTER recovery_type,
        ADD COLUMN IF NOT EXISTS city_amt DECIMAL(12,2) DEFAULT 0.00 AFTER city_rate,
        ADD COLUMN IF NOT EXISTS city_type VARCHAR(2) DEFAULT 'V' AFTER city_amt,
        
        ADD COLUMN IF NOT EXISTS atten_rate DECIMAL(12,2) DEFAULT 0.00 AFTER city_type,
        ADD COLUMN IF NOT EXISTS atten_amt DECIMAL(12,2) DEFAULT 0.00 AFTER atten_rate,
        ADD COLUMN IF NOT EXISTS atten_type VARCHAR(2) DEFAULT 'V' AFTER atten_amt,
        
        ADD COLUMN IF NOT EXISTS other_allow_rate DECIMAL(12,2) DEFAULT 0.00 AFTER atten_type,
        ADD COLUMN IF NOT EXISTS other_allow_amt DECIMAL(12,2) DEFAULT 0.00 AFTER other_allow_rate,
        ADD COLUMN IF NOT EXISTS other_allow_type VARCHAR(2) DEFAULT 'V' AFTER other_allow_amt,
        
        ADD COLUMN IF NOT EXISTS leave_allow_rate DECIMAL(12,2) DEFAULT 0.00 AFTER other_allow_type,
        ADD COLUMN IF NOT EXISTS leave_allow_amt DECIMAL(12,2) DEFAULT 0.00 AFTER leave_allow_rate,
        ADD COLUMN IF NOT EXISTS leave_allow_type VARCHAR(2) DEFAULT 'V' AFTER leave_allow_amt";

$ai_db->aiQuery($sql);
echo "New allowance columns added successfully.\n";
?>