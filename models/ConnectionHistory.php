<?php
class ConnectionHistory
{
	private $_cn;

    public function __construct ($cn) {
        $this->_cn = $cn;
    }

    public function login($user_id, $login_date, $logout_date, $onsite_time) {
    	$stmt = $this->_cn->prepare("INSERT INTO `connection_history`(`login_date`, `logout_date`, `onsite_time`, `user_id`) VALUES(:login_date, :logout_date, :onsite_time, :user_id)");

        $stmt->bindParam(':login_date', $login_date);
        $stmt->bindParam(':logout_date', $logout_date);
        $stmt->bindParam(':onsite_time', $onsite_time);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();

        if($stmt->rowCount() > 0) {
            return $this->_cn->lastInsertId();;
        }
    }

    public function getAll () {
    	return $this->_cn->query("SELECT connection_history.*, users.firstname, users.lastname FROM connection_history INNER JOIN users ON users.id = connection_history.user_id ORDER BY connection_history.login_date DESC");
    }

    public function logout($logout_date, $onsite_time, $id) {
    	$stmt = $this->_cn->prepare("UPDATE `connection_history` SET `logout_date` = :logout_date , `onsite_time` = :onsite_time WHERE `id` = :id");

        $stmt->bindParam(':logout_date', $logout_date, PDO::PARAM_STR);
        $stmt->bindParam(':onsite_time', $onsite_time, PDO::PARAM_STR);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        if($stmt->rowCount() > 0) {
            return true;
        }
    }
}
?>