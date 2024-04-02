<?php
require_once("Controller.php");

$error = "";
$success = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["search_orders"])) {
    // Retrieve the selected date range
    $start_date = $_POST["start_date"];
    $end_date = $_POST["end_date"];

    // Fetch orders within the specified date range
    $orders = $order->getOrdersByDateRange($start_date, $end_date);
}

// Fetch all orders if not searching by date range
if (!isset($orders)) {
    $orders = $order->getAllOrders();
}

$customers = $user->getTotalCustomers();
?>