<?php
class StockProduct
{
	private $_cn;

    public function __construct ($cn) {
        $this->_cn = $cn;
    }

    public function create ($stock_id, $product_id, $quantity) {
    	$stmt = $this->_cn->prepare("INSERT INTO `stock_product`(`stock_id`, `product_id`, `quantity`) VALUES (:stock_id, :product_id, :quantity)");

		$stmt->bindParam(':stock_id', $stock_id, PDO::PARAM_INT);
		$stmt->bindParam(':product_id', $product_id, PDO::PARAM_INT);
		$stmt->bindParam(':quantity', $quantity, PDO::PARAM_INT);

		 if ($stmt->execute()) {
            return true;
        }
    }

    public function getAll ($stock_id) {
    	$stmt = $this->_cn->prepare("
    		SELECT stock_product.*, stocks.name AS stock_name, products.name AS product_name FROM stock_product 
    		INNER JOIN stocks ON stocks.id = stock_product.stock_id
    		INNER JOIN products ON products.id = stock_product.product_id
    		WHERE stock_id = :stock_id
    	");

    	$stmt->bindParam(':stock_id', $stock_id, PDO::PARAM_INT);

    	if ($stmt->execute()) {
            return $stmt;
        }
    }

    public function delete ($stock_id, $product_id) {
        $stmt = $this->_cn->prepare("DELETE FROM `stock_product` WHERE `stock_id` = :stock_id AND `product_id` = :product_id");

        $stmt->bindParam(':stock_id', $stock_id, PDO::PARAM_INT);
        $stmt->bindParam(':product_id', $product_id, PDO::PARAM_INT);

         if ($stmt->execute()) {
            return true;
        }
    }

    public function update ($stock_id, $product_id, $quantity) {
        $stmt = $this->_cn->prepare("UPDATE `stock_product` SET `quantity` = :quantity WHERE `stock_id` = :stock_id AND `product_id` = :product_id");

        $stmt->bindParam(':quantity', $quantity, PDO::PARAM_INT);
        $stmt->bindParam(':stock_id', $stock_id, PDO::PARAM_INT);
        $stmt->bindParam(':product_id', $product_id, PDO::PARAM_INT);

         if ($stmt->execute()) {
            return true;
        }
    }
}
?>