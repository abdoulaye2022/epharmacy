<?php
require_once("Controller.php");

$error = "";
$success = "";

// Add user
if(isset($_POST['add_user'])) {
	if(isset($_POST['firstname'], $_POST['lastname'], $_POST['phone'], $_POST['email'], $_POST['adress'], $_POST['city'], $_POST['country'], $_POST['province'], $_POST['password'], $_POST['confirm_password'], $_POST['designation'], $_POST['postal_code'], $_POST['role_id'])) {
		if(!empty($_POST['firstname']) && !empty($_POST['lastname']) && !empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['password']) && !empty($_POST['role_id'])) {
			if($helper->isValidEmail($_POST['email'])) {
				if($_POST['password'] === $_POST['confirm_password']) {
					$firstname = $helper->validateString($_POST['firstname']);
					$lastname = $helper->validateString($_POST['lastname']);
					$phone = $helper->validateString($_POST['phone']);
					$email = $helper->validateString($_POST['email']);
					$adress = $helper->validateString($_POST['adress']);
					$city = $helper->validateString($_POST['city']);
					$country = $helper->validateString($_POST['country']);
					$province = $helper->validateString($_POST['province']);
					$password = $helper->validateString($_POST['password']);
					$confirm_password = $helper->validateString($_POST['confirm_password']);
					$designation = $helper->validateString($_POST['designation']);
					$postal_code = $helper->validateString($_POST['postal_code']);
					$role_id = $helper->validateString($_POST['role_id']);

					$pawwordHash = password_hash($password, PASSWORD_DEFAULT);

					if($helper->isValidProfil($role_id)) {
						if(!$user->emailExist($email)) {
							if($user->create ($firstname, $lastname, $designation, $adress, $city, $province, $country, $postal_code, $phone, $email, $pawwordHash, $role_id)) {
								$success = "User is added successfully.";
							} else {
								$error = "An error occurred. Please try again.";
							}
						} else {
							$error = "The email address already exists.";
						}
					} else {
						$error = "Profil is invalid.";
					}

				} else {
					$error = "The password and confirmation password must match.";
				}
			} else {
				$error = "E-mail is invalid.";
			}
		} else {
			$error = "Please complete all required fields.";
		}
	}
}

// Update user
if(isset($_POST['edit_user'])) {
	if(isset($_POST['id'], $_POST['firstname'], $_POST['lastname'], $_POST['phone'], $_POST['adress'], $_POST['city'], $_POST['country'], $_POST['province'], $_POST['password'], $_POST['confirm_password'], $_POST['designation'], $_POST['role_id'], $_POST['postal_code'], $_POST['old_password'])) {
		if(!empty($_POST['id']) && !empty($_POST['firstname']) && !empty($_POST['lastname']) && !empty($_POST['password']) && !empty($_POST['password']) && !empty($_POST['role_id']) && !empty($_POST['old_password'])) {
			if($_POST['password'] === $_POST['confirm_password']) {
				$id = $helper->validateInteger($_POST['id']);
				$firstname = $helper->validateString($_POST['firstname']);
				$lastname = $helper->validateString($_POST['lastname']);
				$phone = $helper->validateString($_POST['phone']);
				$adress = $helper->validateString($_POST['adress']);
				$city = $helper->validateString($_POST['city']);
				$country = $helper->validateString($_POST['country']);
				$province = $helper->validateString($_POST['province']);
				$password = $helper->validateString($_POST['password']);
				$confirm_password = $helper->validateString($_POST['confirm_password']);
				$old_password = $helper->validateString($_POST['old_password']);
				$designation = $helper->validateString($_POST['designation']);
				$postal_code = $helper->validateString($_POST['postal_code']);
				$role_id = $helper->validateString($_POST['role_id']);

				if($old_password != $password) {
					$password = password_hash($password, PASSWORD_DEFAULT);
				}

				if($helper->isValidProfil($role_id)) {
					if($user->update($id, $firstname, $lastname, $designation, $adress, $city, $province, $country, $postal_code, $phone, $password, $role_id)) {
							$success = "User is updated successfully.";
					} else {
						$error = "An error occurred. Please try again.";
					}
				} else {
					$error = "Profil is invalid.";
				}

			} else {
				$error = "The password and confirmation password must match.";
			}
		} else {
			$error = "Please complete all required fields.";
		}
	}
}

// Blocque un compte utilisateur
if(isset($_POST['btnblock'],)) {
	if (isset($_POST['block'], $_POST['id'])) {
		$id = $helper->validateInteger($_POST['id']);
		$block = $helper->validateInteger($_POST['block']);

		if($user->blockUserAccount($id, $block)) {
			$success = "User account is blocked successfully.";
		} else {
			$error = "An error occurred. Please try again.";
		}
	}
	
}

$users = $user->getAll();
?>