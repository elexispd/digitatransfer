<?php 

class Utilities {
	private $db;

	function __construct ($db) {
		$this->db = $db;
	}

	public function getUser ($user) {
		$sql = "SELECT * FROM user_tb WHERE username = ?";
		$stmt = $this->db->run($sql, [$user]);
		$result = $stmt->fetch();
		return $result;
	}
}