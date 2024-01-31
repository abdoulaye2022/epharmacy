<?php
require_once("Controller.php");

$error = "";
$success = "";

if(isset($_POST['id'],$_POST['firstname'], $_POST['lastname'], $_POST['phone'], $_POST['designation'], 
	$_POST['adress'], $_POST['city'], $_POST['province'], $_POST['country'], $_POST['postal_code'])) {

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

		if($user->updateProfil ($id, $firstname, $lastname, $designation, $adress, $city, $province, $country, $postal_code, $phone)) {
			$auth->refreshSession($firstname, $lastname, $phone, $designation, $adress, $city, $province, $country, $postal_code);
			$success = "Profile is updated successfully.";
		} else {
			$error = "An error occurred. Please try again.";
		}
	} else {
		$error = "Please complete all required fields.";
	}
}

?>