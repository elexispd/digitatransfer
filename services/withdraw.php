<?php 

/**
 the following are from the extented class
 1. getuser()
 2. sendMail()
 3. logs()
 4. updateBalance()
 5. message()
 6. msg
 */
include_once "utilities.php";

class Withdraw extends Utilities {
    private $db;

    function __construct($db) {
        $this->db = $db;
    }   

    public function withdrawer ($transact_id, $username, $addr, $coin, $amount) {
        $sql = "SELECT * FROM wallet_tb WHERE transact_id = ? AND $username = ?";
        $stmt = $this->db->run($sql, [$transact_id, $username, $addr, $coin, $amount]);
        $result = $stmt->fetch();
        $balance = $result["balance"];
        $transact_id = $result["transact_id"];
        if
    }

}