<?php 

require_once "../services/init.php";
include_once "../services/auth.php";

$db = new Init();


if (isset($_POST["login"])) {
	session_start();
    $user_obj = new Auth($db);
    $username = htmlspecialchars($_POST["username"]);
    $pass = htmlspecialchars($_POST["password"]);
    $ans = htmlspecialchars($_POST["ans"]);
    $code = htmlspecialchars($_SESSION["rand_code"]);
    // $captcha = htmlspecialchars($_POST["captch"]);
    $msg= $user_obj->login($username, $pass, $ans, $code);
    
    echo json_encode($msg);
} 

