<?php 
//include "init.php";
// include "init.php";
/* use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;*/

/**
* 
*/
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require '../handlers/vendor/autoload.php';
class Betatransfer {
	private $msg = [];
	/*this constructor will return database connection which would be passed during the class initialization*/
	function __construct($db) {
		$this->db = $db;
	}

    /*------------------referal section------------------*/
   public function add_referral ($adder, $referred) {
        $created_on = date("Y-m-d H:i:s", time());
        if (!empty($adder)) {
            $sql = "SELECT * FROM user_tb WHERE username = ?";
            $stmt =  $this->db->run($sql, [$adder]);
            if ($stmt->rowCount() > 0) {
               $sql2 = "INSERT INTO referrals (referred_by, referred, reg_on) VALUES (?,?,?)";
               $stmt2 = $stmt = $this->db->run($sql, [$adder, $referred, $created_on]);
            }
        }
   }
   // add bonus to the person who refered
   public function referral_profit ($adder, $referred, $amount) {
        $percent = 10/100;
        $profit = $percent * $amount;
        $on = date("Y-m-d H:i:s", time());
        $sql = "SELECT * FROM referrals WHERE referred = ?";
        $stmt = $this->db->run($sql, [$referred]);
        $result = $stmt->fetch();
        $user = $result["referred_by"];
        $label = "Referral Bonus From ".$referred;
        $sql2 = "INSERT INTO commission_tb (username,from_ref, invest_amt,earning_amt,time_stamp,earning_Label) VALUES (?,?,?,?,?,?)";
        $stmt2 = $this->db->run($sql2, [$user,$referred, $amount,$profit,$on,$label]);
        if ($stmt2->rowCount() > 0) {
            $this->update_balance($adder, $profit, 'add');
            $user_a = $this->get_users($adder);
            $this->referral_mail($user_a["email"], $user_a["first_name"]. " ". $user_a["last_name"], $profit, $referred);
            $this->tLogs($user, "You have earned 10% from referral commission from $referred","Referral:earning", $profit );
        }
   }

   public function referral_mail ($mail, $name, $amt, $by) {
        $amt=number_format($amt,"2");
        $message = "
                    Hello <b>$name</b>,<br><br>
                    You have been credited with &euro;$amt from your referrer - $by.
                    <br><br>

                    Warm regards. <br>
                    Betatransfer<br>.
                    ";
        $subject = "Referrer Bonus";
        $this->sendMail($to, $subject, $message);
   }
   //total amount gotten from referrals
   public function network_paid ($user) {
        try {
            $sql = "SELECT SUM(earning_amt) AS total_net FROM commission_tb WHERE username = ? ";
            $stmt = $this->db->run($sql, [$user]);
            $result = $stmt->fetch();
            $default = 00.00;
            return number_format($result["total_net"], 2);
            
        } catch (Exception $e) {
            echo $e->getMesage();
        }
   }

   /*--------------------withdrawer section--------------------------*/
   public function withdraw_fund ($id, $addr, $coin, $amount) {
    $sql = "SELECT  * FROM wallet_tb WHERE transact_id = ?";
        $stmt = $this->db->run($sql, [$id]);
        $result = $stmt->fetch();
        $balance = $result["balance"];
        $username = $result["username"];
        $transact_id = rand(1000, 9000) + time();
        $on = date("Y-m-d H:i:s", time());
        if ($balance >= $amount) {
            $sql2 = "INSERT INTO withdraw_tb (username,transact_id,transact_amt,sendToWallet,wallet_balance,time_stamp) VALUES (?,?,?,?,?,?)";
            $stmt2 = $this->db->run($sql2, [$username,$transact_id,$amount,$addr,$balance,$on]);
            if ($stmt2->rowCount() > 0) {
                $this->update_balance($id, $amount, "minus");
                $this->message(1, "Your withdrawal request is received and will be attended to shortly.");
                // select user
                $use = $this->get_user($username);
                $full_name = $use["first_name"]." ".$use["last_name"];
                $this->withdraw_email('promisedeco24@gmail.com',$full_name, $addr, $coin,$amount,$result["transact_id"] );
            }
        } else {
            $this->message(0, "insufficient balance");
        }
        return $this->msg;
   }

   public function withdraw_email ($to, $name, $addr, $coin, $amt, $tID) {
        $amt=number_format($amt,"2");
         $message = "
                    Hello <b>$name</b>,<br><br>
                    Your request to withdraw &euro;$amt from your account is under review. We will get back to you shortly. Thank you! <br><br>
                    Transaction ID: #$tID  <br><br>
                    Coin: $coin <br><br>
                    Address: $addr
                    <br><br>

                    Warm regards. <br>
                    Betatransfer<br>.
                    ";
        $subject = "Withdraw request";
        $this->sendMail($to, $subject, $message);
    }
   
   /*-----------------------transfer section----------------------------------*/
   public function transfer_fund () {}

   /*-----------------------GET SEGMENT------------------------------------*/

   /*-----------------------------for worrking with users------------------*/
   public function get_users ($user) {
        $sql = "SELECT * FROM user_tb WHERE username = ?";
        $stmt = $this->db->run($sql,[$user]);
        $result = $stmt->fetch();
        return $result;
   }

   public function get_balance () {}

   public function get_network_paid () {}

   public function get_network () {}

   public function get_transfer () {}

   public function get_history() {}



   /*----------------------mail section---------------------------------*/
   public function send_mail ($to,$subject, $message) {

                $mail = new PHPMailer(true);
                 
            try {
                //Server settings
                // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
                $mail->isSMTP();                                            //Send using SMTP
                $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
                $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                $mail->Username   = 'promisedeco24@gmail.com';                     //SMTP username
                $mail->Password   = 'hdmrdrvawbgyuvmc';                               //SMTP password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
                $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

                //Recipients

                $mail->setFrom('promisedeco24@gmail.com', 'Betatransfer');
                $mail->addAddress($to, '');     //Add a recipient
             
                $msg = "<html>
                <head><meta http-equiv='Content-Type' content='text/html; charset=utf-8'>
                    <meta name='viewport' content='width=device-width'>
                    
                    <title>Thanks for Choosing Luxemcapital</title>
                    <style>
                    
                    @media only screen and (max-width: 620px) {
                    table[class=body] h1 {
                        font-size: 28px !important;
                        margin-bottom: 10px !important;
                    }
                    table[class=body] p,
                            table[class=body] ul,
                            table[class=body] ol,
                            table[class=body] td,
                            table[class=body] span,
                            table[class=body] a {
                        font-size: 16px !important;
                    }
                    table[class=body] .wrapper,
                            table[class=body] .article {
                        padding: 10px !important;
                    }
                    table[class=body] .content {
                        padding: 0 !important;
                    }
                    table[class=body] .container {
                        padding: 0 !important;
                        width: 100% !important;
                    }
                    table[class=body] .main {
                        border-left-width: 0 !important;
                        border-radius: 0 !important;
                        border-right-width: 0 !important;
                    }
                    table[class=body] .btn table {
                        width: 100% !important;
                    }
                    table[class=body] .btn a {
                        width: 100% !important;
                    }
                    table[class=body] .img-responsive {
                        height: auto !important;
                        max-width: 100% !important;
                        width: auto !important;
                    }
                    }

                    
                    @media all {
                    .ExternalClass {
                        width: 100%;
                    }
                    .ExternalClass,
                            .ExternalClass p,
                            .ExternalClass span,
                            .ExternalClass font,
                            .ExternalClass td,
                            .ExternalClass div {
                        line-height: 100%;
                    }
                    .apple-link a {
                        color: inherit !important;
                        font-family: inherit !important;
                        font-size: inherit !important;
                        font-weight: inherit !important;
                        line-height: inherit !important;
                        text-decoration: none !important;
                    }
                    #MessageViewBody a {
                        color: inherit;
                        text-decoration: none;
                        font-size: inherit;
                        font-family: inherit;
                        font-weight: inherit;
                        line-height: inherit;
                    }
                    .btn-primary table td:hover {
                        background-color: #34495e !important;
                    }
                    .btn-primary a:hover {
                        background-color: #34495e !important;
                        border-color: #34495e !important;
                    }
                    }
                    </style>
                </head>
                <body class='' style='background-color: #f6f6f6; font-family: sans-serif; -webkit-font-smoothing: antialiased; font-size: 14px; line-height: 1.4; margin: 0; padding: 0; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;'>
                    <table border='0' cellpadding='0' cellspacing='0' class='body' style='border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%; background-color: #f6f6f6;'>
                    
                    <tr>
                        <td style='font-family: sans-serif; font-size: 14px; vertical-align: top;'>&nbsp;</td>
                        <td class='container' style='font-family: sans-serif; font-size: 14px; vertical-align: top; display: block; Margin: 0 auto; max-width: 580px; padding: 10px; width: 580px;'>
                        <div class='content' style='box-sizing: border-box; display: block; Margin: 0 auto; max-width: 580px; padding: 10px;'>

                            <img src='https://luxemcapital.com/images/logo_Mail.png' style='float:left;'><p align='center'>A real gateway for serious traders...</p>
                           
                            <table class='main' style='border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%; background: #ffffff; border-radius: 3px;'>

                            
                            
                            <tr>
                                <td class='wrapper' style='font-family: sans-serif; font-size: 14px; vertical-align: top; box-sizing: border-box; padding: 20px;'>
                                <table border='0' cellpadding='0' cellspacing='0' style='border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%;'>
                                

                                <tr>
                                    <td style='font-family: sans-serif; font-size: 15px; vertical-align: top;'>
                                       
                                        <p style='font-family: sans-serif; font-size: 15px; font-weight: normal; margin: 0; Margin-bottom: 15px;'>
                                           $message 
                                        </p>

                                        <table border='0' cellpadding='0' cellspacing='0' class='btn btn-primary' style='border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%; box-sizing: border-box;'>
                                        <tbody>
                                            <tr>
                                            <td align='left' style='font-family: sans-serif; font-size: 14px; vertical-align: top; padding-bottom: 15px;'>
                                                <table border='0' cellpadding='0' cellspacing='0' style='border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: auto;'>
                                                <tbody>
                                                    
                                                
                                                </tbody>
                                                </table>
                                            </td>
                                            </tr>
                                        </tbody>
                                        </table>
                                        
                                    </td>
                                    
                                    
                                    </tr>
                                    
                                </table>
                                </td>
                            </tr>

                            
                            </table>

                            
                            <div class='footer' style='clear: both; Margin-top: 10px; text-align: center; width: 100%;'>
                            <table border='0' cellpadding='0' cellspacing='0' style='border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%;'>
                                <tr>
                                <td class='content-block' style='font-family: sans-serif; vertical-align: top; padding-bottom: 10px; padding-top: 10px; font-size: 12px; color: #999999; text-align: center;'>
                                    <span class='apple-link' style='color: #999999; font-size: 12px; text-align: center;'>If you don't recognize this transaction, please immediately contact User Support <br>
                                        on support@Betatransfer.com <br><br>
                                        
                                        Your user ID and password, are confidential and should never be disclosed to anyone.</span>
                                    
                                </td>
                                </tr>
                                <tr>
                                <td class='content-block powered-by' style='font-family: sans-serif; vertical-align: top; padding-bottom: 10px; padding-top: 10px; font-size: 12px; color: #999999; text-align: center;'>
                                     <a href='https://Betatransfer.com' style='color: #999999; font-size: 12px; text-align: center; text-decoration: none;'>Betatransfer</a> system generated mail.
                                
                                </td>
                                </tr>
                            </table>
                            </div>
                            
                        </div>
                        </td>
                        <td style='font-family: sans-serif; font-size: 14px; vertical-align: top;'>&nbsp;</td>
                        <p>&nbsp;</p>
                        
                    </tr>
                    </table>
                </body>
                </html>
                ";

               
                $mail->isHTML(true);     
                $body = $msg;                             //Set email format to HTML
                $mail->Subject =$subject;
                $mail->Body    = $body;
                $mail->AltBody = strip_tags($body);

                $mail->send();
                echo 'Message has been sent';
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
   }

    
   public function mail_structure ($from, $fromname, $to, $subject, $message) {
         $mail = new PHPMailer(TRUE);
                $mail->Host = 'stmt.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'promisedeco24@gmail.com';
                $mail->Password = 'hdmrdrvawbgyuvmc';
                //From email address and name
                $mail->From = $from;
 
                //To address and name
                $mail->addAddress($to);
                $mail->Port       = 465;
                //$mail->addAddress("recepient1@example.com"); //Recipient name is optional

                //Address to which recipient will reply
                $mail->addReplyTo("promisedeco24@gmail.com", "No Reply");

                //CC and BCC
                //$mail->addCC("cc@example.com");
                //$mail->addBCC("bcc@example.com");

                //Send HTML or Plain Text email
                $mail->isHTML(true);

                $mail->Subject = $subject;
                $mail->Body = "
                <html>
                <head><meta http-equiv='Content-Type' content='text/html; charset=utf-8'>
                    <meta name='viewport' content='width=device-width'>
                    
                    <title>Thanks for Choosing Luxemcapital</title>
                    <style>
                    
                    @media only screen and (max-width: 620px) {
                    table[class=body] h1 {
                        font-size: 28px !important;
                        margin-bottom: 10px !important;
                    }
                    table[class=body] p,
                            table[class=body] ul,
                            table[class=body] ol,
                            table[class=body] td,
                            table[class=body] span,
                            table[class=body] a {
                        font-size: 16px !important;
                    }
                    table[class=body] .wrapper,
                            table[class=body] .article {
                        padding: 10px !important;
                    }
                    table[class=body] .content {
                        padding: 0 !important;
                    }
                    table[class=body] .container {
                        padding: 0 !important;
                        width: 100% !important;
                    }
                    table[class=body] .main {
                        border-left-width: 0 !important;
                        border-radius: 0 !important;
                        border-right-width: 0 !important;
                    }
                    table[class=body] .btn table {
                        width: 100% !important;
                    }
                    table[class=body] .btn a {
                        width: 100% !important;
                    }
                    table[class=body] .img-responsive {
                        height: auto !important;
                        max-width: 100% !important;
                        width: auto !important;
                    }
                    }

                    
                    @media all {
                    .ExternalClass {
                        width: 100%;
                    }
                    .ExternalClass,
                            .ExternalClass p,
                            .ExternalClass span,
                            .ExternalClass font,
                            .ExternalClass td,
                            .ExternalClass div {
                        line-height: 100%;
                    }
                    .apple-link a {
                        color: inherit !important;
                        font-family: inherit !important;
                        font-size: inherit !important;
                        font-weight: inherit !important;
                        line-height: inherit !important;
                        text-decoration: none !important;
                    }
                    #MessageViewBody a {
                        color: inherit;
                        text-decoration: none;
                        font-size: inherit;
                        font-family: inherit;
                        font-weight: inherit;
                        line-height: inherit;
                    }
                    .btn-primary table td:hover {
                        background-color: #34495e !important;
                    }
                    .btn-primary a:hover {
                        background-color: #34495e !important;
                        border-color: #34495e !important;
                    }
                    }
                    </style>
                </head>
                <body class='' style='background-color: #f6f6f6; font-family: sans-serif; -webkit-font-smoothing: antialiased; font-size: 14px; line-height: 1.4; margin: 0; padding: 0; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;'>
                    <table border='0' cellpadding='0' cellspacing='0' class='body' style='border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%; background-color: #f6f6f6;'>
                    
                    <tr>
                        <td style='font-family: sans-serif; font-size: 14px; vertical-align: top;'>&nbsp;</td>
                        <td class='container' style='font-family: sans-serif; font-size: 14px; vertical-align: top; display: block; Margin: 0 auto; max-width: 580px; padding: 10px; width: 580px;'>
                        <div class='content' style='box-sizing: border-box; display: block; Margin: 0 auto; max-width: 580px; padding: 10px;'>

                            <img src='https://luxemcapital.com/images/logo_Mail.png' style='float:left;'><p align='center'>A real gateway for serious traders...</p>
                           
                            <table class='main' style='border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%; background: #ffffff; border-radius: 3px;'>

                            
                            
                            <tr>
                                <td class='wrapper' style='font-family: sans-serif; font-size: 14px; vertical-align: top; box-sizing: border-box; padding: 20px;'>
                                <table border='0' cellpadding='0' cellspacing='0' style='border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%;'>
                                

                                <tr>
                                    <td style='font-family: sans-serif; font-size: 15px; vertical-align: top;'>
                                       
                                        <p style='font-family: sans-serif; font-size: 15px; font-weight: normal; margin: 0; Margin-bottom: 15px;'>
                                           $message
                                        </p>

                                        <table border='0' cellpadding='0' cellspacing='0' class='btn btn-primary' style='border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%; box-sizing: border-box;'>
                                        <tbody>
                                            <tr>
                                            <td align='left' style='font-family: sans-serif; font-size: 14px; vertical-align: top; padding-bottom: 15px;'>
                                                <table border='0' cellpadding='0' cellspacing='0' style='border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: auto;'>
                                                <tbody>
                                                    
                                                
                                                </tbody>
                                                </table>
                                            </td>
                                            </tr>
                                        </tbody>
                                        </table>
                                        
                                    </td>
                                    
                                    
                                    </tr>
                                    
                                </table>
                                </td>
                            </tr>

                            
                            </table>

                            
                            <div class='footer' style='clear: both; Margin-top: 10px; text-align: center; width: 100%;'>
                            <table border='0' cellpadding='0' cellspacing='0' style='border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%;'>
                                <tr>
                                <td class='content-block' style='font-family: sans-serif; vertical-align: top; padding-bottom: 10px; padding-top: 10px; font-size: 12px; color: #999999; text-align: center;'>
                                    <span class='apple-link' style='color: #999999; font-size: 12px; text-align: center;'>If you don't recognize this transaction, please immediately contact User Support <br>
                                        on support@luxemcapital.com <br><br>
                                        
                                        Your user ID and password, are confidential and should never be disclosed to anyone.</span>
                                    
                                </td>
                                </tr>
                                <tr>
                                <td class='content-block powered-by' style='font-family: sans-serif; vertical-align: top; padding-bottom: 10px; padding-top: 10px; font-size: 12px; color: #999999; text-align: center;'>
                                     <a href='https://luxemcapital.com' style='color: #999999; font-size: 12px; text-align: center; text-decoration: none;'>luxemcapital</a> system generated mail.
                                
                                </td>
                                </tr>
                            </table>
                            </div>
                            
                        </div>
                        </td>
                        <td style='font-family: sans-serif; font-size: 14px; vertical-align: top;'>&nbsp;</td>
                        <p>&nbsp;</p>
                        
                    </tr>
                    </table>
                </body>
                </html>
                ";
                //$mail->AltBody = "This is the plain text version of the email content";

                if(!$mail->send()) 
                {
                    return false;
                } 
                else 
                {
                    return true;
                }
   }















   function tLogs($tID, $descri_,$slug,$amt){
        //Update Logs
        $time_= date("Y-m-d H:i:s", time());
        $sql = ("INSERT INTO _tlogs (tID,descrip_,slug_,_time_,transact_amt) VALUES (?,?,?,?,?)");
        $stmt-$this->db->run($sql,[$tID,$descri_,$slug,$time_,$amt]);       
    }



	/*---------------wallet functions----------*/
	public function update_balance ($id, $amount, $key) {
		$sql2 = "SELECT * FROM wallet_tb WHERE transact_id = ?";
		$stmt2 = $this->db->run($sql2, [$id]);
		$result = $stmt2->fetch();
		$balance = $result["temp_balance"];
		$c_balance = 0;
		switch ($key) {
			case 'add':
				$c_balance = $balance + $amount;
				break;
			case 'minus':
				$c_balance = $balance - $amount;
				break;
			case 'mul':
				$c_balance = $balance * $amount;
				break;
			default:
				# code...
				break;
		}
		$sql = "UPDATE wallet_tb SET balance = ? WHERE transact_id = ?";
		$stmt = $this->db->run($sql, [$c_balance,$id]);
	}

	/*
	OBJECTIVE: this method adds all messages returned into msg property as an associative array
	Steps:
	1. passes 2 parameters - key and actual value
	2. sets key parameter as the key of msg property and value as the value of the key passed;

	*/

	protected function message($key, $value){
		$this->msg["status"] = $key;
		$this->msg["message"] = $value;
	}
}