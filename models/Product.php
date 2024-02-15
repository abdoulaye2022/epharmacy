<?php
class Product
{
    private $_cn;

    public function __construct($cn)
    {
        $this->_cn = $cn;
    }

    public function getAll()
    {
        return $this->_cn->query("SELECT products.*, suppliers.name AS supplier_name, warehouses.name AS warehouse_name FROM products INNER JOIN suppliers ON suppliers.id = products.supplier_id INNER JOIN warehouses ON warehouses.id = products.warehouse_id");
    }

    public function create($name, $description, $code_product, $supplier_id, $warehouse_id, $image)
    {
        $stmt = $this->_cn->prepare("INSERT INTO `products`(`name`, `description`, `code_product`, `supplier_id`, `warehouse_id`, `image`) VALUES(:name, :description, :code_product, :supplier_id, :warehouse_id, :image)");

        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':description', $description, PDO::PARAM_STR);
        $stmt->bindParam(':code_product', $code_product, PDO::PARAM_STR);
        $stmt->bindParam(':supplier_id', $supplier_id, PDO::PARAM_INT);
        $stmt->bindParam(':warehouse_id', $warehouse_id, PDO::PARAM_INT);
        $stmt->bindParam(':image', $image,  PDO::PARAM_STR);

        if ($stmt->execute()) {
            return true;
        }
    }

    public function update($id, $name, $description, $code_product, $supplier_id, $warehouse_id, $image)
    {
        $stmt = $this->_cn->prepare("UPDATE `products` SET `name`=:name, `description`=:description, `code_product`=:code_product, `supplier_id`=:supplier_id, `warehouse_id`=:warehouse_id, `image`=:image WHERE `id`=:id");

        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':description', $description, PDO::PARAM_STR);
        $stmt->bindParam(':code_product', $code_product, PDO::PARAM_STR);
        $stmt->bindParam(':supplier_id', $supplier_id, PDO::PARAM_INT);
        $stmt->bindParam(':warehouse_id', $warehouse_id, PDO::PARAM_INT);
        $stmt->bindParam(':image', $image, PDO::PARAM_STR);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return true;
        }
    }

    public function codeProductExist ($code_product, $id=null) {
        if($id==null) {
            $stmt = $this->_cn->prepare("SELECT `code_product` FROM `products` WHERE `code_product` = :code_product");
            $stmt->bindParam(':code_product', $code_product);
        } else {
             $stmt = $this->_cn->prepare("SELECT `code_product` FROM `products` WHERE `code_product` = :code_product AND `id` != :id");
            $stmt->bindParam(':code_product', $code_product);
            $stmt->bindParam(':id', $id);
        }
       
        if ($stmt->execute()) {
            if($stmt->rowCount() > 0) {
                return true;
            }
        }
    }

    public function getAllProductNotInOfStock ($stock_id) {
        $stmt = $this->_cn->prepare("SELECT * FROM `products` WHERE `id` NOT IN (SELECT `product_id` FROM `stock_product` WHERE `stock_id` = :stock_id)");
        $stmt->bindParam(':stock_id', $stock_id);

        if ($stmt->execute()) {
            return $stmt;
        }
    }
}
?>