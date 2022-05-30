<?php 

// require_once "../services/init.php";
include_once "../services/auth.php";
include_once "../services/withdraw.php";

$db = new Init();
$user_obj = new Auth($db);


if (isset($_POST["login"])) {
    $username = htmlspecialchars($_POST["username"]);
    $pass = htmlspecialchars($_POST["password"]);
    $captcha = htmlspecialchars($_POST["captch"]);
    $msg= $user_obj->login($username, $pass, $captcha);
    
    json_decode($msg);
} 


if (isset($_POST["register"])) {
	$user_obj = new Auth($db);
    $withdrawObj = new Withdraw($db);

    $first = htmlspecialchars($_POST["name"]);
    $last = htmlspecialchars($_POST["l_name"]);
    $email = htmlspecialchars($_POST["email"]);
    $city = htmlspecialchars($_POST["city"]);
    $country = htmlspecialchars($_POST["country"]);
    $code = htmlspecialchars($_POST["zip"]);
    $dob = htmlspecialchars($_POST["dob"]);
    $state = htmlspecialchars($_POST["prov"]);
    $username = htmlspecialchars($_POST["username"]);
    $phone = htmlspecialchars($_POST["phone"]);
    $province = htmlspecialchars($_POST["prov"]);
    $bill_addr = htmlspecialchars($_POST["bill_addr"]);
    $bill_code = htmlspecialchars($_POST["bill_code"]);
    $bill_state = htmlspecialchars($_POST["bill_prov"]);
    $bill_country = htmlspecialchars($_POST["bill_country"]);
    $bill_city = htmlspecialchars($_POST["bill_city"]);
    $doc_num = htmlspecialchars($_POST["doc_numb"]);
    $document = htmlspecialchars($_POST["document"]);
    $pass = $_POST["password"];
    $pass2 = $_POST["c_password"];
    $company = htmlspecialchars($_POST["company"]);
    $addr1 = htmlspecialchars($_POST["addr1"]);
    $addr2 = htmlspecialchars($_POST["addr2"]);
    $ref = htmlspecialchars($_POST["referral"]);

    $msg= $user_obj->register ($first, $last, $email, $pass, $pass2, $dob, $addr1, $addr2,$city, $province, $code, $country,$phone,$username,$company,$document,$doc_num, $bill_addr, $bill_country, $bill_code, $bill_state, $bill_city);
       echo json_encode($msg);
       // $user_obj2->add_referral($ref, $username);
} 
