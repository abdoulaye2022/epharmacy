<?php
class Warehouse
{
	private $_cn;
	
	public function __construct($cn)
	{
		$this->_cn = $cn;
	}

	public function getAll () {
		return $this->_cn->query("SELECT warehouses.* FROM warehouses");
	}

	public function create ($name, $adress, $city, $province, $country) {
		$stmt = $this->_cn->prepare("INSERT INTO `ware`(`name`, `adresss`, `city`, `province`, `country`) VALUES(:name, :adress, :city, :province, :country)");

		$stmt->bindParam(':name', $name);
		$stmt->bindParam(':province', $adress);
		$stmt->bindParam(':city', $city);
		$stmt->bindParam(':province', $province);
		$stmt->bindParam(':country', $country);

		if ($stmt->execute()) {
		    return true;
		}
	}

	public function update ($id, $name, $adress, $city, $province, $country) {
		$stmt = $this->_cn->prepare("UPDATE `warehouses` SET `name`=:name,`adress`=:adress,`city`=:city,`province`=:province,`country`=:country WHERE `id`=:id");

		$stmt->bindParam(':name', $name);
		$stmt->bindParam(':adress', $adress);
		$stmt->bindParam(':city', $city);
		$stmt->bindParam(':province', $province);
		$stmt->bindParam(':country', $country);
		$stmt->bindParam(':id', $id);

		if ($stmt->execute()) {
		    return true;
		}
	}

	public function updateWarehouse ($id, $name, $adress, $city, $province, $country) {
		$stmt = $this->_cn->prepare("UPDATE `warehouses` SET `name`=:name,`adress`=:adress,`city`=:city,`province`=:province,`country`=:country WHERE `id`=:id");

		$stmt->bindParam(':name', $name);
		$stmt->bindParam(':adress', $adress);
		$stmt->bindParam(':city', $city);
		$stmt->bindParam(':province', $province);
		$stmt->bindParam(':country', $country);
		$stmt->bindParam(':id', $id);

		if ($stmt->execute()) {
		    return true;
		}
	}

	public function deleteWarehouse($id) {
		$stmt = $this->_cn->prepare("DELETE FROM `warehouses` WHERE `id` = :id");
		$stmt->bindParam(':id', $id, PDO::PARAM_INT);
	
		if ($stmt->execute()) {
			return true;
		} else {
			return false;
		}
	}
	

	public function updateImages ($id, $image) {
		$stmt = $this->_cn->prepare("UPDATE `warehouses` SET `image`=:image WHERE `id`=:id");
		$stmt->bindParam(':id', $id);
		$stmt->bindParam(':image', $image);

		if ($stmt->execute()) {
		    return true;
		}
	}

}
?>