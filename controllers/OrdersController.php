<?php
require_once("Controller.php");

$error = "";
$success = "";

// Add product
if (isset($_POST['add_product'])) {
    if (isset($_POST['name'], $_POST['description'], $_POST['code_product'], $_POST['supplier_id'], $_POST['warehouse_id'], $_FILES['product_img'])) {
        if (!empty($_POST['name']) && !empty($_POST['code_product']) && !empty($_POST['supplier_id']) && !empty($_POST['warehouse_id'])) {
            $name = $helper->validateString($_POST['name']);
            $description = $helper->validateString($_POST['description']);
            $code_product = $helper->validateString($_POST['code_product']);
            $supplier_id = $helper->validateString($_POST['supplier_id']);
            $warehouse_id = $helper->validateString($_POST['warehouse_id']);

            $fileName = null;

            if(!$product->codeProductExist($code_product)) {
                if($_FILES['product_img']['error'] === UPLOAD_ERR_OK) {
                    if(isset($_FILES['product_img']) && $_FILES['product_img']['error'] === UPLOAD_ERR_OK){
                        // Informations sur le fichier t�l�charg�
                        $fileName = $_FILES['product_img']['name'];
                        $fileSize = $_FILES['product_img']['size'];
                        $fileType = $_FILES['product_img']['type'];
                        $fileTmpName = $_FILES['product_img']['tmp_name'];

                        $uploadDir = 'assets/images/products/';

                        $uploadPath = $uploadDir . $fileName;

                        if($_FILES['product_img']['error'] != UPLOAD_ERR_NO_FILE) {
                            if(move_uploaded_file($fileTmpName, $uploadPath)){
                                
                            } else {
                                $error = "Image download error, please try again.";
                            }
                        }
                    } else {
                        $error = "Image download error, please try again.";
                    }
                }

                if ($product->create($name, $description, $code_product, $supplier_id, $warehouse_id, $fileName)) {
                    $success = "Product was added successfully.";
                } else {
                    $error = "An error occurred. Please try again.";
                }
            } else {
                 $error = "The product code already exists.";
            }
        } else {
            $error = "Please complete all required fields.";
        }
    }
} 

// Update product
if (isset($_POST['edit_product'])) {
    if (isset($_POST['name'], $_POST['description'], $_POST['code_product'], $_POST['supplier_id'], $_POST['warehouse_id'], $_FILES['product_img'], $_POST['id'])) {
        if (!empty($_POST['name']) && !empty($_POST['code_product']) && !empty($_POST['supplier_id']) && !empty($_POST['warehouse_id']) && !empty($_POST['id'])) {
            $id = $helper->validateInteger($_POST['id']);
            $name = $helper->validateString($_POST['name']);
            $description = $helper->validateString($_POST['description']);
            $code_product = $helper->validateString($_POST['code_product']);
            $supplier_id = $helper->validateString($_POST['supplier_id']);
            $warehouse_id = $helper->validateString($_POST['warehouse_id']);

            $fileName = null;

             if(!$product->codeProductExist($code_product, $id)) {
                if($_FILES['product_img']['error'] === UPLOAD_ERR_OK) {
                    if(isset($_FILES['product_img']) && $_FILES['product_img']['error'] === UPLOAD_ERR_OK){
                        // Informations sur le fichier t�l�charg�
                        $fileName = $_FILES['product_img']['name'];
                        $fileSize = $_FILES['product_img']['size'];
                        $fileType = $_FILES['product_img']['type'];
                        $fileTmpName = $_FILES['product_img']['tmp_name'];

                        $uploadDir = 'assets/images/products/';

                        $uploadPath = $uploadDir . $fileName;

                        if($_FILES['product_img']['error'] != UPLOAD_ERR_NO_FILE) {
                            if(move_uploaded_file($fileTmpName, $uploadPath)){
                                
                            } else {
                                $error = "Image download error, please try again.";
                            }
                        }
                    } else {
                        $error = "Image download error, please try again.";
                    }
                }

                if ($product->update($id, $name, $description, $code_product, $supplier_id, $warehouse_id, $fileName)) {
                    $success = "Product was updated successfully.";
                } else {
                    $error = "An error occurred. Please try again.";
                }
            } else {
                 $error = "The product code already exists.";
            }
        } else {
            $error = "Please complete all required fields.";
        }
    }
}

$products = $product->getAll();
?>
