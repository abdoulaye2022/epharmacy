<?php
require_once("Controller.php");

$error = "";
$success  = "";

if(isset($_POST['btn_add'])) {
	if(isset($_POST['name'], $_POST['phone'], $_POST['email'], $_POST['adress'], $_POST['city'], $_POST['province'], $_POST['country'], $_POST['postal_code'], $_FILES['image'])) {
		if(!empty($_POST['name']) && !empty($_POST['phone']) && !empty($_POST['email']) && !empty($_POST['adress']) && !empty($_POST['city']) && !empty($_POST['province']) && !empty($_POST['country'])  && !empty($_POST['postal_code'])) {
			$name = $helper->validateString($_POST['name']);
			$phone = $helper->validateString($_POST['phone']);
			$email = $helper->validateString($_POST['email']);
			$adress = $helper->validateString($_POST['adress']);
			$city = $helper->validateString($_POST['city']);
			$province = $helper->validateString($_POST['province']);
			$country = $helper->validateString($_POST['country']);
			$postal_code = $helper->validateString($_POST['postal_code']);

			$fileName = "";

			if($_FILES['image']['error'] === UPLOAD_ERR_OK) {
			    if(isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK){
			        // Informations sur le fichier téléchargé
			        $fileName = $_FILES['image']['name'];
			        $fileSize = $_FILES['image']['size'];
			        $fileType = $_FILES['image']['type'];
			        $fileTmpName = $_FILES['image']['tmp_name'];

			        $uploadDir = 'assets/images/company/';

			        $uploadPath = $uploadDir . $fileName;

			        if($_FILES['image']['error'] != UPLOAD_ERR_NO_FILE) {
			        	if(move_uploaded_file($fileTmpName, $uploadPath)){
				        	// $user->updateImages ($id, $fileName);
				        } else {
				            $error = "Image download error, please try again.";
				        }
			        }
			    } else {
			        $error = "Image download error, please try again.";
			    }
			}

			if($company->create($name, $phone, $email, $adress, $city, $province, $country, $postal_code, $fileName)) {
				$success = "Company was added successfully.";
			} else {
				$error = "An error occurred. Please try again.";
			}
		} else {
			$error = "Please complete all required fields.";
		}
	}
	
}


$companies = $company->getCompany($_SESSION['company_id']);
?>