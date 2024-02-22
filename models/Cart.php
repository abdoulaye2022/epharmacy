<?php
class Cart
{
	private $_cn;

    public function __construct($cn)
    {
        $this->_cn = $cn;
    }

    public function getCart($user_id) {
    	$stmt = $this->_cn->prepare("SELECT * FROM `carts` WHERE `user_id` = :user_id AND `actif` = 1");
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return $stmt;
        }
    }

    public function newCart ($user_id) {
    	$stmt = $this->_cn->prepare("INSERT INTO `carts`(`user_id`, `actif`) VALUES (:user_id, 1)");
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);

        if ($stmt->execute()) {
        	$_SESSION['cart_id'] = $this->_cn->lastInsertId();
            return true;
        }
    }

     public function closeCart($cart_id, $actif) {
        $stmt = $this->_cn->prepare("UPDATE `carts` SET `actif` = :actif WHERE `id` = :cart_id");
        $stmt->bindParam(':actif', $actif, PDO::PARAM_INT);
        $stmt->bindParam(':cart_id', $cart_id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return $stmt;
        }
    }
}
?>