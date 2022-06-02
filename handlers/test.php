<?php 

include_once "../services/utilities.php";
include_once "../services/withdraw.php";
include_once "../services/Transfer.php";

$db = new Init();
$obj2 = new Utilities($db);
// $obj = new Withdraw($obj2);
$obj = new Transfer($obj2);

$msg = $obj->approve("elexis", 1661816652, "elex");

print_r($msg);