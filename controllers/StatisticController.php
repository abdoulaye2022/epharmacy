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
} elseif ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["search_customer_orders"])) {
    // Retrieve the selected customer ID and status
    $customer_id = $_POST["customer_id"];
    $status = $_POST["status"];

    // Fetch orders for the selected customer and status
    $orders = $order->getOrdersByCustomerIdAndStatus($customer_id, $status);

    // Check if there are any orders
    if ($orders) {
        $num_orders = count($orders);
        if ($num_orders > 0) {
            // There are orders, display them
            foreach ($orders as $order) {
                // Display order details
            }
        } else {
            // No orders found
            echo "No orders found.";
        }
    } else {
        // Error occurred while fetching orders
        echo "Error fetching orders.";
    }
} else {
    // Fetch all orders if not searching by date range or customer
    $orders = $order->getAllOrders();
}

// Fetch total customers
$customers = $user->getTotalCustomers();
?>
