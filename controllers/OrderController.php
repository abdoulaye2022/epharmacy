<?php
require_once("Controller.php");

$error = "";
$success = "";

// Create new order
if(isset($_POST['btn_new_order'])) {
	if($cart->newCart($_SESSION['id'])) {
		header("location: new_order.php");
	} else {
		$error = "An error occurred. Please try again.";
	}
}

// Add product to cart
if(isset($_POST['btn_add_to_cart'])) {
	if(isset($_POST['cart_id'], $_POST['product_id'], $_POST['quantity'])) {
		if(!empty($_POST['cart_id']) && !empty($_POST['product_id']) && !empty($_POST['quantity'])) {
			$cart_id = $helper->validateInteger($_POST['cart_id']);
			$product_id = $helper->validateInteger($_POST['product_id']);
			$quantity = $helper->validateInteger($_POST['quantity']);

			$pro = $product->getPrice($product_id);
			$fetch = $pro->fetch(PDO::FETCH_ASSOC);
			$total = $quantity * $fetch['price'];

			if($cartProduct->add($cart_id, $product_id, $quantity, $total)) {
				header("location: new_order.php");
			} else {
				$error = "An error occurred. Please try again.";
			}
		} else {
			$error = "Quantity must be a positive number.";
		}
	}
}

// Remove product from cart
if(isset($_POST['btn_remove_to_cart'])) {
	if(isset($_POST['cart_id'], $_POST['product_id'])) {
		if(!empty($_POST['cart_id']) && !empty($_POST['product_id'])) {
			$cart_id = $helper->validateInteger($_POST['cart_id']);
			$product_id = $helper->validateInteger($_POST['product_id']);

			if($cartProduct->remove($cart_id, $product_id)) {
				if($_SERVER['REQUEST_URI'] == "/epharmacy/checkout.php")
					header("location: checkout.php");
				else
					header("location: new_order.php");
			} else {
				$error = "An error occurred. Please try again.";
			}
		} else {
			$error = "An error occurred. Please try again.";
		}
	}
}

// Update product from cart
if(isset($_POST['btn_update_to_cart'])) {
	if(isset($_POST['cart_id'], $_POST['product_id'], $_POST['quantity'], $_POST['price'])) {
		if(!empty($_POST['cart_id']) && !empty($_POST['product_id']) && !empty($_POST['quantity']) && !empty($_POST['price'])) {
			$cart_id = $helper->validateInteger($_POST['cart_id']);
			$product_id = $helper->validateInteger($_POST['product_id']);
			$quantity = $helper->validateInteger($_POST['quantity']);
			$price = $helper->validateInteger($_POST['price']);

			$total = (float)$price * $quantity;
			$tax = $total * 0.15;

			if($cartProduct->update($cart_id, $product_id, $quantity, $total, $tax)) {
				if($_SERVER['REQUEST_URI'] == "/epharmacy/checkout.php")
					header("location: checkout.php");
				else
					header("location: new_order.php");
			} else {
				$error = "An error occurred. Please try again.";
			}
		} else {
			$error = "An error occurred. Please try again.";
		}
	}
}

// Pay now
if(isset($_POST['pay_now'])) {
	if(isset($_POST['card_number'], $_POST['card_holder'], $_POST['expiry_month'], $_POST['expiry_year'], $_POST['cvc'], $_POST['total'])) {
		if(!empty($_POST['card_number']) && !empty($_POST['card_holder']) && !empty($_POST['expiry_month']) && !empty($_POST['expiry_year']) && !empty($_POST['cvc']) && !empty($_POST['total'])) {
			$card_number = $helper->validateString($_POST['card_number']);
			$card_holder = $helper->validateString($_POST['card_holder']);
			$expiry_month = $helper->validateString($_POST['expiry_month']);
			$expiry_year = $helper->validateString($_POST['expiry_year']);
			$cvc = $helper->validateString($_POST['cvc']);
			$total = $helper->validateString($_POST['total']);

			$order_date = date('Y-m-d H:i:s');

			if($order->create ($_SESSION['id'], $order_date, $total, 0, 0)) {
				$cart->closeCart($_SESSION['cart_id'], 0);

				header("location: new_order.php");
			} else {
				$error = "An error occurred. Please try again.";
			}
		}
	}
}

// Search
if(isset($_POST['btn_search'])) {
	if(isset($_POST['search'], $_POST['sort'])) {
		 $search = $helper->validateString($_POST['search']);
		 $sort = $helper->validateString($_POST['sort']);

		 if($product->getAllByFilter($search, $sort)) {
		 	$products = $product->getAllByFilter($search, $sort);
		 }
	}
}

$products = $product->getAll();	
$orders = $order->getOrdersByCustomerId($_SESSION['id']);

?>