<?php
require_once("Controller.php");

$error = "";
$success = "";

// Add product
if (isset($_POST['add_product'])) {
    if (isset($_POST['name'], $_POST['description'], $_POST['quantity'], $_POST['supplier_id'], $_POST['warehouse_id'])) {
        if (!empty($_POST['name']) && !empty($_POST['description']) && !empty($_POST['quantity']) && !empty($_POST['supplier_id']) && !empty($_POST['warehouse_id'])) {
            $name = $helper->validateString($_POST['name']);
            $description = $helper->validateString($_POST['description']);
            $quantity = $helper->validateString($_POST['quantity']);
            $supplier_id = $helper->validateString($_POST['supplier_id']);
            $warehouse_id = $helper->validateString($_POST['warehouse_id']);

            // TODO: Add product logic here
            if ($helper->isValidProduct($role_id)) {
                if (!$product->nameExist($email)) {
                    if ($product->create($name, $description, $quantity, $supplier_id, $warehouse_id)) {
                        $success = "Product is added successfully.";
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
            $error = "Please complete all required fields.";
        }
    } else {
        $error = "E-mail is invalid.";
    }
} else {
    $error = "Please complete all required fields.";
}

// Update product
if (isset($_POST['edit_product'])) {
    if (isset($_POST['id'], $_POST['name'], $_POST['description'], $_POST['quantity'], $_POST['supplier_id'], $_POST['warehouse_id'])) {
        if (!empty($_POST['id']) && !empty($_POST['name']) && !empty($_POST['description']) && !empty($_POST['quantity']) && !empty($_POST['supplier_id']) && !empty($_POST['warehouse_id'])) {
            $id = $helper->validateInteger($_POST['id']);
            $name = $helper->validateString($_POST['name']);
            $description = $helper->validateString($_POST['description']);
            $quantity = $helper->validateString($_POST['quantity']);
            $supplier_id = $helper->validateString($_POST['supplier_id']);
            $warehouse_id = $helper->validateString($_POST['warehouse_id']);

            if ($helper->isValidProduct($role_id)) {
                if ($product->update($id, $name, $description, $quantity, $supplier_id, $warehouse_id)) {
                    $success = "Product is updated successfully.";
                } else {
                    $error = "An error occurred. Please try again.";
                }
            } else {
                $error = "Product is invalid.";
            }
        } else {
            $error = "Must fill all required fields.";
        }
    } else {
        $error = "Please complete all required fields.";
    }
}

$products = $product->getAll();
?>
