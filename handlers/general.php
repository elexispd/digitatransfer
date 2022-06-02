<?php 
// include_once "../services/auth.php";
include_once "../services/utilities.php";
include_once "../services/withdraw.php";
include_once "../services/Transfer.php";
$db = new Init();
$obj2 = new Utilities($db);
$obj = new Withdraw($obj2);
$obj = new Transfer($obj2);
session_start();
if (isset($_POST["withdraw"])) {
	$user = htmlspecialchars($_POST["user"]);
    $addr = htmlspecialchars($_POST["addr"]);
    $amount = htmlspecialchars($_POST["amount"]);
    $coin = htmlspecialchars($_POST["coin"]);

    $msg = $obj->withdrawer($user, $addr, $coin, $amount);
    echo json_encode($msg);

} 

if (isset($_POST["transfer"])) {

    $user = htmlspecialchars($_POST["sender"]);
    $receiver = htmlspecialchars($_POST["receiver"]);
    $amount = htmlspecialchars($_POST["amount"]);
    $desc = htmlspecialchars($_POST["desc"]);

    $msg = $obj->makeTransfer($user, $receiver, $amount, $desc);
    echo json_encode($msg);

} 