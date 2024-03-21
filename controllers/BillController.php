<?php
require_once("Controller.php");

$companies = $company->getCompany($_SESSION['company_id']);
if(isset($_GET['bill_id'])) {
	$bill_id = intval($_GET['bill_id']);
	$accountings = $accounting->getBill($bill_id);
} else {
	header("location: accounting.php");
	exit();
}

?>