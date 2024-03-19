<?php
require_once("Controller.php");

$error = "";
$success = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["btnUpdate"])) {
        $userId = $_POST["user_id"];
        $firstName = $_POST["firstname"];
        $lastName = $_POST["lastname"];
        
        if ($statistic->updateName($userId, $firstName, $lastName)) {
            $success = "User's name updated successfully.";
        } else {
            $error = "Failed to update user's name.";
        }
    }
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["btnUpdate"])) {
        $id = $_POST["id"];
        $total_amount = $_POST["total_amount"];
        $order_date = $_POST["order_date"];
        $status = $_POST["status"];
        
        if ($statistic->updateName($id, $total_amount, $order_date, $status)) {
            $success = "Order has been updated successfully.";
        } else {
            $error = "Failed to update the order.";
        }
    }
}
$orders = $order->getAllOrders();
$customers = $user->getTotalCustomers();
?>
