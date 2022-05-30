<?php 
$message = "you have successfully registered";
$to = "promisedeco24@gmail.com";
$subject = "Registration";

// include_once "../services/init.php";
include_once "../services/utilities.php";

$db = new Init();
$mail = new Utilities($db);

$msg = $mail->getuser("elexis");

echo $msg["email"];