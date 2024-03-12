<?php
class CartProduct
{
	private $_cn;

    public function __construct($cn)
    {
        $this->_cn = $cn;
    }

    public function add ($cart_id, $product_id, $quantity, $total) {
    	$stmt = $this->_cn->prepare("INSERT INTO `cart_product`(`cart_id`, `product_id`, `quantity`, `total`) VALUES (:cart_id, :product_id, :quantity, :total)");
        $stmt->bindParam(':cart_id', $cart_id, PDO::PARAM_INT);
        $stmt->bindParam(':product_id', $product_id, PDO::PARAM_INT);
        $stmt->bindParam(':quantity', $quantity, PDO::PARAM_INT);
        $stmt->bindParam(':total', $total, PDO::PARAM_STR);

        if ($stmt->execute()) {
            return true;
        }
    }

    public function productExist ($cart_id, $product_id) {
    	$stmt = $this->_cn->prepare("SELECT * FROM `cart_product` WHERE `cart_id`=:cart_id AND `product_id`=:product_id");
        $stmt->bindParam(':cart_id', $cart_id, PDO::PARAM_INT);
        $stmt->bindParam(':product_id', $product_id, PDO::PARAM_INT);

        if ($stmt->execute()) {
        	if($stmt->rowCount())
            	return true;
            else
            	return false;
        }
    }

    public function remove ($cart_id, $product_id) {
    	$stmt = $this->_cn->prepare("DELETE FROM `cart_product` WHERE `cart_id`=:cart_id AND `product_id`=:product_id");
        $stmt->bindParam(':cart_id', $cart_id, PDO::PARAM_INT);
        $stmt->bindParam(':product_id', $product_id, PDO::PARAM_INT);

        if ($stmt->execute()) {
        	return true;
        }
    }

    public function update ($cart_id, $product_id, $quantity, $total, $tax) {
        $stmt = $this->_cn->prepare("UPDATE `cart_product` SET `quantity` = :quantity, `total`=:total, `tax`=:tax WHERE `cart_id`=:cart_id AND `product_id`=:product_id");
        $stmt->bindParam(':quantity', $quantity, PDO::PARAM_INT);
        $stmt->bindParam(':total', $total, PDO::PARAM_INT);
        $stmt->bindParam(':tax', $tax, PDO::PARAM_STR);
        $stmt->bindParam(':cart_id', $cart_id, PDO::PARAM_INT);
        $stmt->bindParam(':product_id', $product_id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return true;
        }
    }

    public function countCartProduct ($cart_id) {
    	$stmt = $this->_cn->prepare("SELECT * FROM `cart_product` WHERE `cart_id`=:cart_id");
        $stmt->bindParam(':cart_id', $cart_id, PDO::PARAM_INT);

        if ($stmt->execute()) {
        	return $stmt;
        }
    }

    public function getAll ($cart_id) {
        $stmt = $this->_cn->prepare("SELECT `cp`.`cart_id`, `cp`.`product_id`, `cp`.`quantity`, `cp`.`total`, `p`.`name`, `p`.`price`, `p`.`image`, `p`.`description` FROM `cart_product` `cp` 
            INNER JOIN `products` `p` ON `p`.`id`=`cp`.`product_id`
            WHERE `cp`.`cart_id`=:cart_id"
        );
        $stmt->bindParam(':cart_id', $cart_id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return $stmt;
        }
    }

    public function getTotalAmount ($cart_id) {
        $stmt = $this->_cn->prepare("SELECT SUM(`total`) AS `total` FROM `cart_product` WHERE `cart_id`=:cart_id");
        $stmt->bindParam(':cart_id', $cart_id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return $stmt;
        }
    }

    public function updateQuantityReminder ($cart_id, $product_id, $quantity_remainder) {
        $stmt = $this->_cn->prepare("
            UPDATE `cart_product` SET `quantity_remainder` = :quantity_remainder
            WHERE `cart_id` = :cart_id AND `product_id` = :product_id;
        ");

        $stmt->bindParam(':quantity_remainder', $quantity_remainder, PDO::PARAM_INT);
        $stmt->bindParam(':cart_id', $cart_id, PDO::PARAM_INT);
        $stmt->bindParam(':product_id', $product_id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return true;
        }
    }

    public function getQuantity ($cart_id, $product_id) {
        $stmt = $this->_cn->prepare("
            SELECT * FROM `cart_product` 
            WHERE `cart_id` = :cart_id AND `product_id` = :product_id;
        ");

        $stmt->bindParam(':cart_id', $cart_id, PDO::PARAM_INT);
        $stmt->bindParam(':product_id', $product_id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return $stmt;
        }
    }
}
?>