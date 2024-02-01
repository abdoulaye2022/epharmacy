<?php
require_once("Controller.php");

$error = "";
$success = "";

if(isset($_POST['id'],$_POST['firstname'], $_POST['lastname'], $_POST['phone'], $_POST['designation'], 
	$_POST['adress'], $_POST['city'], $_POST['province'], $_POST['country'], $_POST['postal_code'], $_POST['old_password'], $_POST['new_password'], $_POST['confirm_new_password'], $_FILES['profil_img'])) {

	if(!empty($_POST['id']) && !empty($_POST['firstname']) && !empty($_POST['lastname']) && $_POST['id'] == $_SESSION['id']) {
		$id = $helper->validateString($_POST['id']);
		$firstname = $helper->validateString($_POST['firstname']);
		$lastname = $helper->validateString($_POST['lastname']);
		$phone = $helper->validateString($_POST['phone']);
		$designation = $helper->validateString($_POST['designation']);
		$adress = $helper->validateString($_POST['adress']);
		$city = $helper->validateString($_POST['city']);
		$province = $helper->validateString($_POST['province']);
		$country = $helper->validateString($_POST['country']);
		$postal_code = $helper->validateString($_POST['postal_code']);

		$old_password = $helper->validateString($_POST['old_password']);
		$new_password = $helper->validateString($_POST['new_password']);
		$confirm_new_password = $helper->validateString($_POST['confirm_new_password']);

		if($_FILES['profil_img']['error'] === UPLOAD_ERR_OK) {
		    if(isset($_FILES['profil_img']) && $_FILES['profil_img']['error'] === UPLOAD_ERR_OK){
		        // Informations sur le fichier téléchargé
		        $fileName = $_FILES['profil_img']['name'];
		        $fileSize = $_FILES['profil_img']['size'];
		        $fileType = $_FILES['profil_img']['type'];
		        $fileTmpName = $_FILES['profil_img']['tmp_name'];

		        $uploadDir = 'assets/images/profil/';

		        $uploadPath = $uploadDir . $fileName;

		        if($_FILES['profil_img']['error'] != UPLOAD_ERR_NO_FILE) {
		        	if(move_uploaded_file($fileTmpName, $uploadPath)){
			        	$user->updateImages ($id, $fileName);
			        } else {
			            $error = "Image download error, please try again.";
			        }
		        }
		    } else {
		        $error = "Image download error, please try again.";
		    }
		}

		if($old_password == "" && $new_password == "" && $confirm_new_password == "") {
			if($user->updateProfil ($id, $firstname, $lastname, $designation, $adress, $city, $province, $country, $postal_code, $phone)) {
				isset($fileName) ? $fileName : $fileName = $_SESSION['image'];
				$auth->refreshSession($firstname, $lastname, $phone, $designation, $adress, $city, $province, $country, $postal_code, $fileName);
				$success = "Profile is updated successfully.";
			} else {
				$error = "An error occurred. Please try again.";
			}
		} else {
			if(password_verify($old_password, $_SESSION['password'])) {
				if($new_password == $confirm_new_password) {
					$pawwordHash = password_hash($new_password, PASSWORD_DEFAULT);

					$user->updatePassword($id, $pawwordHash);
					$success = "Your password is updated successfully.";
				} else {
					$error = "New password and confirmation new password must match.";
				}
			} else {
				$error = "Old password is incorrect.";
			}
		}
	} else {
		$error = "Please complete all required fields.";
	}
}

?>