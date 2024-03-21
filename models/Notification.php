<?php
class Notification
{
	private $_cn;

    public function __construct($cn)
    {
        $this->_cn = $cn;
    }

    public function notify($user_id, $type, $description) 
    {
    	$stmt = $this->_cn->prepare("INSERT INTO `notifications`(`user_id`, `date_notification`, `type`, `description`) VALUES (:user_id, NOW(), :type, :description)");
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->bindParam(':type', $type, PDO::PARAM_STR);
        $stmt->bindParam(':description', $description, PDO::PARAM_STR);

        if ($stmt->execute()) {
            return true;
        }
    }

    public function getNotification ($user_id) {
    	$stmt = $this->_cn->prepare("SELECT * FROM `notifications` WHERE `user_id` = :user_id AND `status` = 1");
    	$stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);

		if ($stmt->execute()) {
			return $stmt;
		}
    }

    public function closeNotification ($id) {
    	$stmt = $this->_cn->prepare("UPDATE `notifications` SET `status` = 0 WHERE `id` = :id");
    	$stmt->bindParam(':id', $id, PDO::PARAM_INT);
    	
		if ($stmt->execute()) {
			return true;
		}
    }

}
?>