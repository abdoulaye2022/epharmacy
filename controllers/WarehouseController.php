<?php
require_once("Controller.php");

$error = "";
$success = "";

// Add warehouse
if(isset($_POST['add_warehouse'])) {
	if(isset($_POST['name'], $_POST['adress'], $_POST['city'], $_POST['province'], $_POST['country'])) {
		if(!empty($_POST['name']) && !empty($_POST['adress']) && !empty($_POST['city']) && !empty($_POST['province']) && !empty($_POST['country'])) {
					$name = $helper->validateString($_POST['name']);
					$adress = $helper->validateString($_POST['adress']);
					$city = $helper->validateString($_POST['city']);
					$province = $helper->validateString($_POST['province']);
					$country = $helper->validateString($_POST['country']);

					if($helper->isValidWarehouse($integer)) {
							if($warehouse->create ($name, $adress, $city, $province, $country)) {
								$success = "Warehouse is updated successfully.";
							} else {
								$error = "An error occurred. Please try again.";
							}
					} else {
						$error = "Cannot add warehouse.";
					}
            } else {
                $error = "Please complete all required fields.";
            }
        }
	}

// Update warehouse
if(isset($_POST['edit_warehouse'])) {
	if(isset($_POST['name'], $_POST['adress'], $_POST['city'], $_POST['province'], $_POST['country'])) {
		if(!empty($_POST['name']) && !empty($_POST['adress']) && !empty($_POST['city']) && !empty($_POST['province']) && !empty($_POST['country'])) {
			if($helper->isValidEmail($_POST['email'])) {
					$name = $helper->validateString($_POST['name']);
					$adress = $helper->validateString($_POST['adress']);
					$city = $helper->validateString($_POST['city']);
					$province = $helper->validateString($_POST['province']);
					$country = $helper->validateString($_POST['country']);

					if($helper->isValidWarehouse($id)) {
							if($warehouse->create ($name, $adress, $city, $province, $country)) {
								$success = "Warehouse is added successfully.";
							} else {
								$error = "An error occurred. Please try again.";
							}
					} else {
						$error = "Cannot update warehouse.";
					}
            } else {
                $error = "Please complete all required fields.";
            }
        }
	}
}
// Delete warehouse

$warehouses = $warehouse->getAll();
?>