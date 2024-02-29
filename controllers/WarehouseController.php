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
if(isset($_POST['id']) && isset($_POST['id'])) {
    $warehouse_ids = $_POST['id'];

    foreach ($warehouse_ids as $id) {
        // Validate each ID
        $id = $helper->validateInteger($id);

        // Delete the warehouse
        if(!$warehouse->deleteWarehouse($id)) {
            // If deletion fails for any warehouse, set an error message
            $error = "An error occurred while deleting warehouse with ID: $id. Please try again.";
            // Optionally, you can break the loop here if you want to stop deleting further warehouses upon encountering an error.
        }
    }

    // If all warehouses are deleted successfully, set a success message
    $success = "Selected warehouses have been deleted successfully.";
}



$warehouses = $warehouse->getAll();
?>