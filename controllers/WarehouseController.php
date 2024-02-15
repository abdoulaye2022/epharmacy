<?php
require_once("Controller.php");

$error = "";
$success = "";

// Add warehouse
if(isset($_POST['add_warehouse'])) {
	if(isset($_POST['name'], $_POST['adress'], $_POST['city'], $_POST['province'], $_POST['country'])) {
		if(!empty($_POST['name'])) {
					$name = $helper->validateString($_POST['name']);
					$adress = $helper->validateString($_POST['adress']);
					$city = $helper->validateString($_POST['city']);
					$province = $helper->validateString($_POST['province']);
					$country = $helper->validateString($_POST['country']);

					if($warehouse->create($name, $adress, $city, $province, $country)) {
						$success = "Warehouse is updated successfully.";
					} else {
						$error = "An error occurred. Please try again.";
					}
            } else {
                $error = "Please complete all required fields.";
            }
        }
	}

// Update warehouse
if(isset($_POST['edit_warehouse'])) {
	if(isset($_POST['id'], $_POST['name'], $_POST['adress'], $_POST['city'], $_POST['province'], $_POST['country'])) {
		if(!empty($_POST['id']) && !empty($_POST['name'])) {
			$id =  $helper->validateInteger($_POST['id']);
			$name = $helper->validateString($_POST['name']);
			$adress = $helper->validateString($_POST['adress']);
			$city = $helper->validateString($_POST['city']);
			$province = $helper->validateString($_POST['province']);
			$country = $helper->validateString($_POST['country']);

			if($warehouse->update($id, $name, $adress, $city, $province, $country)) {
				$success = "Warehouse is updated successfully.";
			} else {
				$error = "An error occurred. Please try again.";
			} 
        } else {
            $error = "Please complete all required fields.";
        }
	}
}
// Delete warehouse
// Delete warehouse
if(isset($_POST['delete_warehouse'])) {
    if(isset($_POST['id']) && !empty($_POST['id'])) {
        // Retrieve and validate warehouse ID
        $id = $helper->validateInteger($_POST['id']);

        // Call the deleteWarehouse method passing the ID
        if($warehouse->deleteWarehouse($id)) {
            $success = "Warehouse has been deleted successfully.";
        } else {
            $error = "An error occurred. Please try again.";
        } 
    } else {
        $error = "Please provide a valid warehouse ID.";
    }
}



$warehouses = $warehouse->getAll();
?>