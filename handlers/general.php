<?php 
// include_once "../services/auth.php";
include_once "../services/utilities.php";
include_once "../services/withdraw.php";
$db = new Init();
$obj2 = new Utilities($db);
$obj = new Withdraw($obj2);
if (isset($_POST["withdraw"])) {
	session_start();

    $user = htmlspecialchars($_POST["user"]);
    $addr = htmlspecialchars($_POST["addr"]);
    $amount = htmlspecialchars($_POST["amount"]);
    $coin = htmlspecialchars($_POST["coin"]);


    $msg = $obj->withdrawer($user, $addr, $coin, $amount);
    echo json_encode($msg);

} 