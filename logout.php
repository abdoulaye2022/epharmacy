<?php
require_once("./controllers/AuthController.php");

if(isset($_SESSION['login_date'], $_SESSION['connection_id']) && !empty($_SESSION['login_date']) && !empty($_SESSION['connection_id'])) {
    $login_date = new DateTime($_SESSION['login_date']);
    $logout_date = new DateTime();

    $diff = $login_date->diff($logout_date);

    $onsite_time = $diff->format("%h:%i:%s");
    $dateTimeString = $logout_date->format('Y-m-d H:i:s');

    $connectionHistory->logout($dateTimeString, $onsite_time, $_SESSION['connection_id']);
}

$_SESSION = array();

if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

session_destroy();

header("Location: index.php");
exit();
?>
