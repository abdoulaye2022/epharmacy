<?php
require_once("Controller.php");

$error = "";
$success  = "";


if(isset($_SESSION['role_id']) && $_SESSION['role_id'] == 3) {
	$accountings = $accounting->getAllCustomerAccountings($_SESSION['id']);
} else {
	$accountings = $accounting->getAll();
}
?>