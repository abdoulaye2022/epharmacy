<?php
require_once("Controller.php");

$error = "";


$total_product = $product->getTotalProducts();
$total_products = $total_product->rowCount();
$total_orders = 0;
if(isset($_SESSION['role_id']) && $_SESSION['role_id'] == 3) {
	$total_order = $order->getTotalCustomerOrders($_SESSION['id']);
	$total_orders = $total_order->rowCount();
} else {
	$total_order = $order->getTotalInProgressOrders();
	$total_orders = $total_order->rowCount();
}

$total_customer = $user->getTotalCustomers();
$total_customers = $total_customer->rowCount();
$total_balances = 0;
