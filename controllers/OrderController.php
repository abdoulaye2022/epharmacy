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

			if($order->create ($_SESSION['id'], $order_date, $total, 0, 0, $_SESSION['cart_id'])) {
				$cart->closeCart($_SESSION['cart_id'], 0);
				$_SESSION['cart_id'] = 0;

				$usersAdministration = $user->getAdministrationUsers();
				while ($u= $usersAdministration->fetch(PDO::FETCH_ASSOC)) {
					$notification->notify($u['id'], "Order", "You have a new order placed.");
				}

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
		if(!empty($_POST['search']) && !empty($_POST['sort'])) {
			$search = $helper->validateString($_POST['search']);
			$sort = $helper->validateString($_POST['sort']);

			if($product->getAllByFilter($search, $sort)) {
			 	$products = $product->getAllByFilter($search, $sort);
			}
		}
	}
}

if(isset($_POST['btn_soutract'])) {
	if(isset($_POST['quantity'], $_POST['product_id'], $_POST['stock_id'], $_POST['cart_id'])) {
		if(!empty($_POST['quantity']) && !empty($_POST['product_id']) && !empty($_POST['stock_id'])) {
			$quantity = $helper->validateInteger($_POST['quantity']);
			$product_id = $helper->validateInteger($_POST['product_id']);
			$stock_id = $helper->validateInteger($_POST['stock_id']);
			$cart_id = $helper->validateInteger($_POST['cart_id']);

			$stock_pro = $stockProduct->checkAvailableProduct($stock_id, $product_id, $quantity);

			if($stock_pro->rowCount()) {
				$qtys = $stockProduct->getQuantity($stock_id, $product_id);
				$qty = $qtys->fetch(PDO::FETCH_ASSOC);


				$qtysr = $cartProduct->getQuantity($cart_id, $product_id);
				$qtyr = $qtysr->fetch(PDO::FETCH_ASSOC);

				$q = 0;
				$qr = 0;

				//echo "QT en stock : " . $qty['quantity'] . " <br/> QT demande : " . $quantity . " <br/>QT du panier : " . ((int)$qtyr['quantity'] - (int)$qtyr['quantity_remainder']); die;

				if((int)$qty['quantity'] >= (int)$quantity && (int)$qtyr['quantity'] > (int)$qtyr['quantity_remainder'] && ((int)$qtyr['quantity'] - (int)$qtyr['quantity_remainder']) >= (int)$quantity) {
					$q = (int)$qty['quantity'] - (int)$quantity;
					$qr = (int)$qtyr['quantity_remainder'] + (int)$quantity;

					// echo $q . " <=> " . $qr; die;

					if($stockProduct->soustractFromStock($stock_id, $product_id, $q) && $cartProduct->updateQuantityReminder($cart_id, $product_id, $qr)) {
							$success = "Quantity is subtracted from stock successfully.";
					} else {
						$error = "An error occurred. Please try again.";
					}
				} else {
					$error = "The quantity must be greater than the quantity to subtract.";
				}				
			} else {
				$error = "The quantity in stock is insufficient.";
			}
		} else {
			$error = "Please complete all required fields.";
		}
	}
}

if(isset($_POST['approuved']))
{
	if(isset($_POST['order_id']) && !empty($_POST['order_id'])) {
		$order_id = $helper->validateInteger($_POST['order_id']);

		if($order->doneOrder($order_id)) {
			$customers = $order->getOrderCustomer($order_id);
			$fetch = $customers->fetch(PDO::FETCH_ASSOC);
			$notification->notify($fetch['customer_id'], "Order", "Your order has been processed.");

			$accounting->create($order_id, $fetch['customer_id']);

			$success = "This order has been successfully approved.";
		} else {
			$error = "An error occurred. Please try again.";
		}
	}
}

$products = $product->getAll();	

if(isset($_SESSION['role_id']) && $_SESSION['role_id'] == 3) {
	$orders = $order->getOrdersByCustomerId($_SESSION['id']);
} else {
	$orders = $order->getAllOrders();
}

if(isset($_GET['order_id'])) {
	$intval = intval($_GET['order_id']);
	$products_order = $order->getOrderProducts($intval);

	if(isset($_GET['product_id'])) {
		$intval2 = intval($_GET['product_id']);
		$products_stock = $stockProduct->getStocksProducs($intval2);
	}
}
?>