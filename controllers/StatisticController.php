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

$customers = $user->getTotalCustomers();
?>
