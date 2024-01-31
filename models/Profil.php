<?php
class Profil
{
	private $_cn;
	
	public function __construct($cn)
	{
		$this->_cn = $cn;
	}

	public function getAll ()
	{
		return $this->_cn->query("SELECT * FROM roles");
	}
}