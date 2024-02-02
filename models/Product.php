<?php
class Products
{
    private $_cn;

    public function __construct($cn)
    {
        $this->_cn = $cn;
    }

    public function getAll()
    {
        return $this->_cn->query("SELECT name, description, quantity, supplier_id, warehouse_id FROM products");
    }

    public function create($name, $description, $quantity, $supplier_id, $warehouse_id)
    {
        $stmt = $this->_cn->prepare("INSERT INTO `products`(`name`, `description`, `quantity`, `supplier_id`, `warehouse_id`) VALUES(:name, :description, :quantity, :supplier_id, :warehouse_id)");

        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':quantity', $quantity);
        $stmt->bindParam(':supplier_id', $supplier_id);
        $stmt->bindParam(':warehouse_id', $warehouse_id);

        if ($stmt->execute()) {
            return true;
        }
    }

    public function update($id, $name, $description, $quantity, $supplier_id, $warehouse_id)
    {
        $stmt = $this->_cn->prepare("UPDATE `products` SET `name`=:name, `description`=:description, `quantity`=:quantity, `supplier_id`=:supplier_id, `warehouse_id`=:warehouse_id WHERE `id`=:id");

        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':quantity', $quantity);
        $stmt->bindParam(':supplier_id', $supplier_id);
        $stmt->bindParam(':warehouse_id', $warehouse_id);
        $stmt->bindParam(':id', $id);

        if ($stmt->execute()) {
            return true;
        }
    }

    public function updateProduct($id, $name, $description, $quantity, $supplier_id, $warehouse_id)
    {
        $stmt = $this->_cn->prepare("UPDATE `products` SET `name`=:name, `description`=:description, `quantity`=:quantity, `supplier_id`=:supplier_id, `warehouse_id`=:warehouse_id WHERE `id`=:id");

        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':quantity', $quantity);
        $stmt->bindParam(':supplier_id', $supplier_id);
        $stmt->bindParam(':warehouse_id', $warehouse_id);
        $stmt->bindParam(':id', $id);

        if ($stmt->execute()) {
            return true;
        }
    }

    public function nameExist($name)
    {
        $stmt = $this->_cn->prepare("SELECT `name` FROM `products` WHERE `name` = :name");
        $stmt->bindParam(':name', $name);
        if ($stmt->execute()) {
            if ($stmt->rowCount() > 0) {
                return true;
            }
        }
        return false;
    }

	public function updateImages ($id, $image) {
		$stmt = $this->_cn->prepare("UPDATE `products` SET `image`=:image WHERE `id`=:id");
		$stmt->bindParam(':id', $id);
		$stmt->bindParam(':image', $image);

		if ($stmt->execute()) {
		    return true;
		}
	}

}
?>