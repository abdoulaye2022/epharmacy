<?php
require_once("Controller.php");

if(isset($_POST['email'], $_POST['password'])) {
	if(!empty($_POST['email']) && !empty($_POST['password'])) {
		if($helper->isValidEmail($_POST['email'])) {
			$email = $helper->validateString($_POST['email']);
			$password = $helper->validateString($_POST['password']);

			$user = $auth->login($email);

			if(password_verify($password, $user['password'])) {

				if(!$auth->userAccountIsBlock($email)) {
					if($user['role_id'] == 1 || $user['role_id'] == 2) {
						header("location: dashboard.php");
						exit();
					} else if($user['role_id'] == 3) {
						header("location: home.php");
						exit();
					} else {
						$error = "An error occurred. Please try again.";
					}
				} else {
					$error = "Your account has been blocked. Please contact the administrator for assistance.";
				}
			} else {
				$error = "Invalid credentials. Please check your email address and password.";
			}
		} else {
			$error = "E-mail is invalid.";
		}
	} else {
		$error = "All fields are required.";
	}
}

?>