<?php
class Accounting
{
	private $_cn;

    public function __construct($cn)
    {
        $this->_cn = $cn;
    }

    public function create ($order_id, $customer_id) {
    	$smtp = $stmt = $this->_cn->prepare("INSERT INTO `accountings`(`order_id`, `customer_id`, `date_created`) VALUES (:order_id, :customer_id, NOW())");
    	$stmt->bindParam(':order_id', $order_id, PDO::PARAM_INT);
    	$stmt->bindParam(':customer_id', $customer_id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return $stmt;
        }
    }

    public function getAll() {
    	$smtp = $stmt = $this->_cn->prepare("SELECT `users`.`firstname`, `users`.`lastname`, `orders`.`total_amount`, `accountings`.`date_created`, `accountings`.`id` FROM `accountings` INNER JOIN `users` ON `users`.`id` = `accountings`.`customer_id` INNER JOIN `orders` ON `orders`.`id` = `accountings`.`order_id`");

    	if ($stmt->execute()) {
            return $stmt;
        }
    }

    public function getAllCustomerAccountings($customer_id) {
    	$smtp = $stmt = $this->_cn->prepare("SELECT `users`.`firstname`, `users`.`lastname`, `orders`.`total_amount`, `accountings`.`date_created`, `accountings`.`id` FROM `accountings` INNER JOIN `users` ON `users`.`id` = `accountings`.`customer_id` INNER JOIN `orders` ON `orders`.`id` = `accountings`.`order_id` WHERE `accountings`.`customer_id` = :customer_id");
    	$stmt->bindParam(':customer_id', $customer_id, PDO::PARAM_INT);

    	if ($stmt->execute()) {
            return $stmt;
        }
    }

    public function getBill($id) {
    	$smtp = $stmt = $this->_cn->prepare("SELECT `users`.`firstname`, `users`.`lastname`, `users`.`adress`, `users`.`city`, `users`.`province`, `users`.`country`, `users`.`postal_code`, `orders`.`total_amount`, `accountings`.`date_created`, `accountings`.`id`, `orders`.`cart_id` FROM `accountings` INNER JOIN `users` ON `users`.`id` = `accountings`.`customer_id` INNER JOIN `orders` ON `orders`.`id` = `accountings`.`order_id` WHERE `accountings`.`id` = :id");
    	$stmt->bindParam(':id', $id, PDO::PARAM_INT);

    	if ($stmt->execute()) {
            return $stmt;
        }
    }
}
?>