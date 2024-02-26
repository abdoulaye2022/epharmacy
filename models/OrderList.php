<?php
class OrderList
{
    private $_cn;

    public function __construct($cn)
    {
        $this->_cn = $cn;
    }

    public function getOrdersByUserId($user_id)
    {
        $stmt = $this->_cn->prepare("SELECT * FROM orders WHERE user_id = :user_id");
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}
?>
