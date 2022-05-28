<?php 

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require '../../handlers/vendor/autoload.php';

class Utilities {
	private $db;
	private $msg = [];

	function __construct ($db) {
		$this->db = $db;
	}

	public function getUser ($user) {
		$sql = "SELECT * FROM user_tb WHERE username = ?";
		$stmt = $this->db->run($sql, [$user]);
		$result = $stmt->fetch();
		return $result;
	}

	public function sendMail ($to, $subject, $messgae) {
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

                $mail->setFrom('promisedeco24@gmail.com', 'DigitaTranser');
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

	public function logs ($user, $tran_id, $desc, $tran_amt, $slug) {
		$created_on = date("m-d-Y H:i:s", time());
		$sql = "INSERT INTO tlogs (username, transaction_id, description, transaction_amt, slug, _time_) VALUES (?,?,?,?,?,?)";
		$stmt = $this->db->run($sql, [$user, $tran_id, $desc, $tran_amt, $slug, $created_on]);
		return true;
	}

	public function updateBalance ($tran_id, $user, $amt, $key) {
		$sql = "SELECT * FROM wallet_tb WHERE $tran_id = ? AND $user = ?";
		$stmt = $this->db->run($sql, [$tran_id, $user]);
		$result = $stmt->fetch();
		$balance = $result["balance"];
		$c_balance = 0;
		switch ($key) {
            case 'add':
                $c_balance = $balance + $amt;
                break;
            case 'minus':
                $c_balance = $balance - $amt;
                break;
            case 'mul':
                $c_balance = $balance * $amt;
                break;
            default:
                # code...
                break;
        }
        $sql2 = "UPDATE wallet_tb SET balance = ? WHERE transaction_id = ? AND username = ?";
        $stmt2 = $this->db->run($sql, [$c_balance, $tran_id, $user]);
	}

	protected function message($key, $value){
        $this->msg["status"] = $key;
        $this->msg["message"] = $value;
    }

}