<?php
class Order
{
	private $_cn;

    public function __construct($cn)
    {
        $this->_cn = $cn;
    }

    public function create ($customer_id, $order_date, $total_amount, $status, $user_id, $cart_id) {
        $stmt = $this->_cn->prepare("INSERT INTO `orders`(`customer_id`, `order_date`, `total_amount`, `status`, `user_id`, `cart_id`) VALUES (:customer_id, :order_date, :total_amount, :status, :user_id, :cart_id)");
        $stmt->bindParam(':customer_id', $customer_id, PDO::PARAM_INT);
        $stmt->bindParam(':order_date', $order_date, PDO::PARAM_STR);
        $stmt->bindParam(':total_amount', $total_amount, PDO::PARAM_STR);
        $stmt->bindParam(':status', $status, PDO::PARAM_INT);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->bindParam(':cart_id', $cart_id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return true;
        }
    }
    public function getOrdersByDateRange($start_date, $end_date)
    {
        try {
            $query = "SELECT * FROM orders WHERE order_date BETWEEN :start_date AND :end_date";
            $stmt = $this->_cn->prepare($query);
            $stmt->bindParam(':start_date', $start_date);
            $stmt->bindParam(':end_date', $end_date);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Log or handle the exception
            error_log("Error fetching orders by date range: " . $e->getMessage());
            return false;
        }
    }
        public function getOrdersByCustomerId($customer_id)
    {
        $stmt = $this->_cn->prepare("SELECT * FROM orders WHERE customer_id = :customer_id");
        $stmt->bindParam(':customer_id', $customer_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getTotalCustomerOrders($customer_id)
    {
        $stmt = $this->_cn->prepare("SELECT * FROM orders WHERE customer_id = :customer_id AND status = 0");
        $stmt->bindParam(':customer_id', $customer_id, PDO::PARAM_INT);
        $stmt->execute();

        if ($stmt->execute()) {
            return $stmt;
        }
    }

    public function getTotalInProgressOrders()
    {
        $stmt = $this->_cn->prepare("SELECT * FROM orders WHERE status = 0");

        if ($stmt->execute()) {
            return $stmt;
        }
    }

    public function getAllOrders()
    {
        $stmt = $this->_cn->prepare("SELECT * FROM orders");

        if ($stmt->execute()) {
            return $stmt;
        }
    }

    public function getOrderProducts($cart_id)
    {
        $stmt = $this->_cn->prepare("SELECT `products`.*, `cart_product`.`quantity`, `cart_product`.`quantity_remainder`, `cart_product`.`cart_id` FROM `cart_product` INNER JOIN `products` ON `products`.`id` = `cart_product`.`product_id` WHERE `cart_product`.`cart_id` = :cart_id");
        $stmt->bindParam(':cart_id', $cart_id, PDO::PARAM_INT);
        $stmt->execute();

        if ($stmt->execute()) {
            return $stmt;
        }
    }

    public function doneOrder($order_id) {
        $stmt = $this->_cn->prepare("UPDATE `orders` SET `status` = 1 WHERE `id` = :order_id");
        $stmt->bindParam(':order_id', $order_id, PDO::PARAM_INT);
        $stmt->execute();

        if ($stmt->execute()) {
            return true;
        }
    }

    public function getOrderCustomer ($order_id) {
        $stmt = $this->_cn->prepare("SELECT * FROM `orders` WHERE `id` = :order_id");
        $stmt->bindParam(':order_id', $order_id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return $stmt;
        }
    }

}

?>