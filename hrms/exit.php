<?php
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}
unset($_SESSION['selected_company_id']);
unset($_SESSION['selected_company_name']);
header("Location: ../dashboard.php");
exit;
?>