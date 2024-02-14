<?php
class Stock
{
	private $_cn;

    public function __construct ($cn) {
        $this->_cn = $cn;
    }

    public function getAll ()
	{
		return $this->_cn->query("SELECT * FROM stocks");
	}

	public function create ($name, $expire_date) {
		$stmt = $this->_cn->prepare("INSERT INTO `stocks`(`name`, `expire_date`) VALUES (:name, :expire_date)");

		$stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':expire_date', $expire_date,  PDO::PARAM_STR);

        if ($stmt->execute()) {
            return true;
        }
	}

	public function update ($name, $expire_date, $id) {
		$stmt = $this->_cn->prepare("UPDATE `stocks` SET `name`= :name,`expire_date`= :expire_date WHERE `id` = :id");

		$stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':expire_date', $expire_date,  PDO::PARAM_STR);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return true;
        }
	}
}
?>