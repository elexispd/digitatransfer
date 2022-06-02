<?php 

/**
 Instead of using inheritance i used Dependecy injection
 * the class "Transfer" is depending on the class Utilities for some functionalities.
 * the utilities is instantianted on the handler the the object is passed to Withdraw via constructor
 * the object being passed contains the db connection and other method -  in fact everything in the class
 * the technique is to extract details in the object - details like db connection (property) etc; 
**/

class Transfer {
	private Utilities $utilities;
    private $db;

    function __construct(Utilities $utilities) {
        $this->utilities = $utilities; // assigns all everything to the property
        $this->db = $utilities->db; // assigns only the db connection
    }   

    public function makeTransfer ($sender, $recipient, $amount, $label = NULL) {
    	if (empty($recipient) || empty($amount)) {
    		 $this->utilities->message(0, "All fields are required");
    	} else {
    		$sql = "SELECT * FROM wallet_tb WHERE  username = ?";
            $stmt = $this->db->run($sql, [$sender]);
            $result = $stmt->fetch();
            $balance = $result["balance"];
            $transact_id = rand(1000, 9999999) + time();
  			$created_on = date("d-m-Y H:i:s", time());

            if ($balance > 0) {
            	$sql2 = "INSERT INTO transfer (from_user, to_user,transact_id,transact_amt,time_stamp,label) VALUES (?,?,?,?,?,?)";
            	$stmt2 = $this->db->run($sql2, [$sender,$recipient,$transact_id,$amount,$created_on,$label]);
            	if ($stmt2->rowCount() > 0) {
            		$c_balance = $this->utilities->updateBalance($sender, $amount, "minus");
                    $this->utilities->message(1, "Your transfer is pending. We will get back to you shortly.");

                    $user = $this->utilities->getUser($sender); // fetches uses details. this method is found in Utilities class

                    $full_name = $user["first_name"]." ".$user["last_name"];
                    $this->debitMail($user["email"] ,$full_name, $recipient,$amount,$transact_id, $c_balance); 
                    $slug = "transfer:pending";
                    $desc = "{$sender} : transfered {$amount} to {$recipient}";
                    $created_on = date("m-d-Y H:i:s", time());
                    $this->utilities->logs($sender, $transact_id, $desc, $amount, $slug, $created_on);
            	}
            } else {
                    $this->utilities->message(0, "insufficient balance");
            }
    	}
    	return $this->utilities->msg;
    }

    private function debitMail ($to, $name, $recipient, $amt, $tID, $bal) {
        $amt=number_format($amt,"2");
        $balance = number_format($bal, "2");
         $message = "
                    Hello <b>$name</b>,<br><br>
                    Your transfer of &euro;$amt to {$recipient} is currently under review. We will get back to you shortly. Thank you! <br><br>
                    Transaction ID: #$tID  <br>
                    Recipient: $recipient
                    <br>
                    Total balance = &euro;$balance
                    <br><br>

                    Warm regards. <br>
                    Digitatransfer<br>.
                    ";
        $subject = "Transfer request";
        $this->utilities->sendMail($to, $subject, $message);
    }

    public function confirmMail ($to, $name, $recipient, $amt) {
        $amt=number_format($amt,"2");
        // $balance = number_format($bal, "2");
         $message = "
                    Hello <b>$name</b>,<br><br>
                    Your Transfer of &euro;$amt to {$recipient} has been approved. <br><br>
                    Thank you! for choosing us

                    Warm regards. <br>
                    Digitatransfer<br>.
                    ";
        $subject = "Transfer Approved";
        $this->utilities->sendMail($to, $subject, $message);
    }

    private function creditMail ($from, $name, $to, $amt, $bal) {
        $amt=number_format($amt,"2");
        $balance = number_format($bal, "2");
         $message = "
                    Hello <b>$name</b>,<br><br>
                    Your Account has been credited with {$amt}. Thank you! <br><br>
                    Sender: $from
                    <br>
                    Total balance = &euro;$balance
                    <br><br>

                    Warm regards. <br>
                    Digitatransfer<br>.
                    ";
        $subject = "Credit Alert";
        $this->utilities->sendMail($to, $subject, $message);
    }

    public function getTransfers () {
        $sql = "SELECT * FROM transfer WHERE transact_status = ?";
        $stmt = $this->db->run($sql, [0]);
        $num = $stmt->rowCount();
        if ($num > 0) {
            return $stmt->fetchAll();
        }
    }

    public function approve ($from, $tran_id, $recipient) {
        $sql = "SELECT * FROM transfer WHERE from_user = ? AND transact_id = ?";
        $stmt = $this->db->run($sql, [$from, $tran_id]);
        $result = $stmt->fetch();
        $amount = $result["transact_amt"];

        $sender = $this->utilities->getUser($from); // fetches uses details. this method is found in Utilities class
        $senderEmail = $sender["email"];
        $senderName = $sender["first_name"]. " ".$sender["last_name"];

        $receiver = $this->utilities->getUser($recipient);
        $receiverEmail = $receiver["email"];
        $receiverName = $receiver["first_name"]. " ".$receiver["last_name"];

        if ($stmt->rowCount() > 0) {
            $sql2 = "UPDATE transfer SET transact_status = ? WHERE from_user = ? AND transact_id = ?";
            $stmt2 = $this->db->run($sql2, [1, $from, $tran_id]);
            $num = $stmt2->rowCount();
            if ($num > 0) {
                $senderDesc = "Transfer request was approved";
                $senderSlug = "Transfer:Approved";
                $created_on = date("d-m-Y H:i:s", time());
                $this->utilities->message(1, "Transfer has been approved");
                $this->confirmMail($senderEmail, $senderName, $receiverName, $amount);
                $this->utilities->logs($from, $tran_id, $senderDesc, $amount, $senderSlug, $created_on);
                
                $updated = $this->utilities->updateBalance($recipient, $amount, "add");
            	
            	if ($updated) {
            		$receiverDesc = "Your account has been credited";
	                $receiverSlug = "Credit:Approved";
	                $this->creditMail($senderName, $receiverName, $receiverEmail, $amount, $updated);
	                $this->utilities->logs($result["to_user"], $tran_id, $receiverDesc, $amount, $receiverSlug, $created_on);
	                $this->utilities->message(0, "Transfer has been approved");
            	} else {
            		$this->utilities->message(0, "no transfer found");
            	}
                
            } else {
                 $this->utilities->message(0, "Transfer is approved already");
            }
        } else {
            $this->utilities->message(0, "no record available");
        }

        return  $this->utilities->msg;
    }
}