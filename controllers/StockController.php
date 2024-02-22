<?php
require_once("Controller.php");

$error = "";
$success = "";

if(isset($_POST['add_stock'])) {
	if(isset($_POST['name'], $_POST['expiration_date'])) {
		if(!empty($_POST['name']) && !empty($_POST['expiration_date'])) {
			if($helper->validerDate($_POST['expiration_date'], 'Y-m-d')) {
				if($_POST['expiration_date'] > date('Y-m-d')) {
					$expiration_date = $helper->validateString($_POST['expiration_date'], 'Y-m-d');
					$name = $helper->validateString($_POST['name']);

					if($stock->create($name, $expiration_date)) {
						$success = "Stock was added successfully.";
					} else {
						$error = "An error occurred. Please try again.";
					}
				} else {
					$error = "Expiration date must be in the future.";
				}
			} else {
				$error = "Expiration date is invalid.";
			}
		} else {
			$error = "Please complete all required fields.";
		}
	}
}

if(isset($_POST['update_btn'])) {
	if(isset($_POST['id'], $_POST['name'], $_POST['expiration_date'])) {
		if(!empty($_POST['name']) && !empty($_POST['expiration_date'])) {
			if($helper->validerDate($_POST['expiration_date'], 'Y-m-d')) {
				$expiration_date = $helper->validateString($_POST['expiration_date'], 'Y-m-d');
				$name = $helper->validateString($_POST['name']);
				$id = $helper->validateInteger($_POST['id']);

				if($stock->update($name, $expiration_date, $id)) {
					$success = "Stock was added successfully.";
				} else {
					$error = "An error occurred. Please try again.";
				}
			} else {
				$error = "Expiration date is invalid.";
			}
		} else {
			$error = "Please complete all required fields.";
		}
	}
}

if(isset($_POST['add_product'])) {
	if(isset($_POST['stock_id'], $_POST['product_id'], $_POST['quantity'])) {
		if(!empty($_POST['stock_id']) && !empty($_POST['product_id']) && !empty($_POST['quantity'])) {
			$stock_id = $helper->validateInteger($_POST['stock_id']);
			$product_id = $helper->validateInteger($_POST['product_id']);
			$quantity = $helper->validateInteger($_POST['quantity']);

			if($stockProduct->create($stock_id, $product_id, $quantity)) {
				$success = "Product was added successfully.";
			} else {
				$error = "An error occurred. Please try again.";
			}
		} else {
			$error = "Please complete all required fields.";
		}
	}
}

if(isset($_POST['remove_product_btn'])) {
	if(isset($_POST['stock_id'], $_POST['product_id'])) {
		if(!empty($_POST['stock_id']) && !empty($_POST['product_id'])) {
			$stock_id = $helper->validateInteger($_POST['stock_id']);
			$product_id = $helper->validateInteger($_POST['product_id']);

			if($stockProduct->delete($stock_id, $product_id)) {
				$success = "Product was deleted from stock successfully.";
			} else {
				$error = "An error occurred. Please try again.";
			}
		} else {
			$error = "Please complete all required fields.";
		}
	}
}

if(isset($_POST['update_product'])) {
	if(isset($_POST['stock_id'], $_POST['product_id'], $_POST['quantity'])) {
		if(!empty($_POST['stock_id']) && !empty($_POST['product_id']) && !empty($_POST['quantity'])) {
			$stock_id = $helper->validateInteger($_POST['stock_id']);
			$product_id = $helper->validateInteger($_POST['product_id']);
			$quantity = $helper->validateInteger($_POST['quantity']);

			if($stockProduct->update($stock_id, $product_id, $quantity)) {
				$success = "Product was updated successfully.";
			} else {
				$error = "An error occurred. Please try again.";
			}
		} else {
			$error = "Please complete all required fields.";
		}
	}
}

$stocks = $stock->getAll();
?>