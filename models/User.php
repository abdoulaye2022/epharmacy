<?php
class User
{
	private $_cn;
	
	public function __construct($cn)
	{
		$this->_cn = $cn;
	}

	public function getAll () {
		return $this->_cn->query("SELECT users.*, roles.name FROM users LEFT JOIN roles ON roles.id = users.role_id");
	}

	public function create ($firstname, $lastname, $designation, $adress, $city, $province, $country, $postal_code, $phone, $email, $password, $role_id) {
		$stmt = $this->_cn->prepare("INSERT INTO `users`(`firstname`, `lastname`, `designation`, `adress`, `city`, `province`, `country`, `postal_code`, `phone`, `email`, `password`, `actif`, `role_id`) VALUES(:firstname, :lastname, :designation, :adress, :city, :province, :country, :postal_code, :phone, :email, :password, 1, :role_id)");

		$stmt->bindParam(':firstname', $firstname);
		$stmt->bindParam(':lastname', $lastname);
		$stmt->bindParam(':designation', $designation);
		$stmt->bindParam(':adress', $adress);
		$stmt->bindParam(':city', $city);
		$stmt->bindParam(':province', $province);
		$stmt->bindParam(':country', $country);
		$stmt->bindParam(':postal_code', $postal_code);
		$stmt->bindParam(':phone', $phone);
		$stmt->bindParam(':email', $email);
		$stmt->bindParam(':password', $password);
		$stmt->bindParam(':role_id', $role_id);

		if ($stmt->execute()) {
		    return true;
		}
	}

	public function update ($id, $firstname, $lastname, $designation, $adress, $city, $province, $country, $postal_code, $phone, $password, $role_id) {
		$stmt = $this->_cn->prepare("UPDATE `users` SET `firstname`=:firstname,`lastname`=:lastname,`designation`=:designation,`adress`=:adress,`city`=:city,`province`=:province, `country`=:country, `postal_code`=:postal_code,`phone`=:phone, `password` = :password, `role_id` =:role_id WHERE `id`=:id");

		$stmt->bindParam(':firstname', $firstname);
		$stmt->bindParam(':lastname', $lastname);
		$stmt->bindParam(':designation', $designation);
		$stmt->bindParam(':adress', $adress);
		$stmt->bindParam(':city', $city);
		$stmt->bindParam(':province', $province);
		$stmt->bindParam(':country', $country);
		$stmt->bindParam(':postal_code', $postal_code);
		$stmt->bindParam(':phone', $phone);
		$stmt->bindParam(':password', $password);
		$stmt->bindParam(':role_id', $role_id);
		$stmt->bindParam(':id', $id);

		if ($stmt->execute()) {
		    return true;
		}
	}

	public function updateProfil ($id, $firstname, $lastname, $designation, $adress, $city, $province, $country, $postal_code, $phone) {
		$stmt = $this->_cn->prepare("UPDATE `users` SET `firstname`=:firstname,`lastname`=:lastname,`designation`=:designation,`adress`=:adress,`city`=:city,`province`=:province, `country`=:country, `postal_code`=:postal_code,`phone`=:phone WHERE `id`=:id");

		$stmt->bindParam(':firstname', $firstname);
		$stmt->bindParam(':lastname', $lastname);
		$stmt->bindParam(':designation', $designation);
		$stmt->bindParam(':adress', $adress);
		$stmt->bindParam(':city', $city);
		$stmt->bindParam(':province', $province);
		$stmt->bindParam(':country', $country);
		$stmt->bindParam(':postal_code', $postal_code);
		$stmt->bindParam(':phone', $phone);
		$stmt->bindParam(':id', $id);

		if ($stmt->execute()) {
		    return true;
		}
	}

	public function emailExist ($email) {
		$stmt = $this->_cn->prepare("SELECT `email` FROM `users` WHERE `email` = :email");
		$stmt->bindParam(':email', $email);
		if ($stmt->execute()) {
			if($stmt->rowCount() > 0) {
				return true;
			}
		}
	}

	public function blockUserAccount ($id, $block) {
		$stmt = $this->_cn->prepare("UPDATE `users` SET `actif` = :block WHERE `id` = :id");
		$stmt->bindParam(':block', $block);
		$stmt->bindParam(':id', $id);
		if ($stmt->execute()) {
			if($stmt->rowCount() > 0) {
				return true;
			}
		}
	}

	public function updatePassword ($id, $password) {
		$stmt = $this->_cn->prepare("UPDATE `users` SET `password`=:password WHERE `id`=:id");
		$stmt->bindParam(':id', $id);
		$stmt->bindParam(':password', $password);

		if ($stmt->execute()) {
		    return true;
		}
	}

	public function updateImages ($id, $image) {
		$stmt = $this->_cn->prepare("UPDATE `users` SET `image`=:image WHERE `id`=:id");
		$stmt->bindParam(':id', $id);
		$stmt->bindParam(':image', $image);

		if ($stmt->execute()) {
		    return true;
		}
	}

	public function getTotalCustomers () {
		$stmt = $this->_cn->prepare("SELECT * FROM `users` WHERE `actif` = 1 AND `role_id` = 3");
		if ($stmt->execute()) {
			return $stmt;
		}
	}

}
?>