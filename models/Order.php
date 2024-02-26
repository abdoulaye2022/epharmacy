<?php
class Order
{
	private $_cn;

    public function __construct($cn)
    {
        $this->_cn = $cn;
    }

    public function create ($customer_id, $order_date, $total_amount, $status, $user_id) {
        $stmt = $this->_cn->prepare("INSERT INTO `orders`(`customer_id`, `order_date`, `total_amount`, `status`, `user_id`) VALUES (:customer_id, :order_date, :total_amount, :status, :user_id)");
        $stmt->bindParam(':customer_id', $customer_id, PDO::PARAM_INT);
        $stmt->bindParam(':order_date', $order_date, PDO::PARAM_STR);
        $stmt->bindParam(':total_amount', $total_amount, PDO::PARAM_STR);
        $stmt->bindParam(':status', $status, PDO::PARAM_INT);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return true;
        }
        if ($stmt->execute()) {
            if($stmt->rowCount() > 0) {
                return true;
            }
        }
    }
}

?>