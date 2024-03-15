<?php
class Statistic
{
    private $_cn;

    public function __construct($cn)
    {
        $this->_cn = $cn;
    }

    public function getAll()
    {
        return $this->_cn->query("SELECT users.*, roles.name FROM users LEFT JOIN roles ON roles.id = users.role_id");
    }

    public function getTotalCustomers()
    {
        $stmt = $this->_cn->prepare("SELECT * FROM `users` WHERE `actif` = 1 AND `role_id` = 3");
        if ($stmt->execute()) {
            return $stmt;
        }
    }

    public function updateName($id, $firstname, $lastname)
{
    $stmt = $this->_cn->prepare("UPDATE `users` SET `firstname`=:firstname, `lastname`=:lastname WHERE `id`=:id");

    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':firstname', $firstname);
    $stmt->bindParam(':lastname', $lastname);

    if ($stmt->execute()) {
        return true;
    } else {
        return false;
    }
}


public function getAllCustomers()
{
    $stmt = $this->_cn->prepare("SELECT CONCAT(firstname, ' ', lastname) AS full_name FROM users WHERE role_id = 3 AND actif = 1");
    if ($stmt->execute()) {
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    } else {
        return false;
    }
}

    
}
?>