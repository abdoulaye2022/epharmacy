<?php
class Company
{
	private $_cn;

    public function __construct($cn)
    {
        $this->_cn = $cn;
    }

    public function create($name, $phone, $email, $adress, $city, $province, $country, $postal_code, $image) {
    	$stmt = $this->_cn->prepare("INSERT INTO `companies`(`name`, `phone`, `email`, `adress`, `city`, `province`, `country`, `postal_code`, `image`) VALUES (:name, :phone, :email, :adress, :city, :province, :country, :postal_code, :image)");

         $stmt->bindParam(':name', $name, PDO::PARAM_STR);
         $stmt->bindParam(':phone', $phone, PDO::PARAM_STR);
         $stmt->bindParam(':email', $email, PDO::PARAM_STR);
         $stmt->bindParam(':adress', $adress, PDO::PARAM_STR);
         $stmt->bindParam(':city', $city, PDO::PARAM_STR);
         $stmt->bindParam(':province', $province, PDO::PARAM_STR);
         $stmt->bindParam(':country', $country, PDO::PARAM_STR);
         $stmt->bindParam(':postal_code', $postal_code, PDO::PARAM_STR);
         $stmt->bindParam(':image', $image, PDO::PARAM_STR);

        if ($stmt->execute()) {
            return true;
        }
    }

    public function getCompany ($company_id) {
        $stmt = $this->_cn->prepare("SELECT * FROM `companies` WHERE `id` = :company_id");
        $stmt->bindParam(':company_id', $company_id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return $stmt;
        }
    }
}