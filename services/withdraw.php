<?php 

/**
 Instead of using inheritance i used Dependecy injection
 * the class "Withdraw" is depending on the class Utilities for some functionalities.
 * the utilities is instantianted on the handler the the object is passed to Withdraw via constructor
 * the object being passed contains the db connection and other method -  in fact everything in the class
 * the technique is to extract details in the object - details like db connection (property) etc; 
**/

class Withdraw {
    private Utilities $utilities;
    private $db;

    function __construct(Utilities $utilities) {
        // $this->db = $db; // methods in the current class uses the property;
        // parent::__construct($db); // this runs the contruct of the other class;
        $this->utilities = $utilities; // assigns all everything to the property
        $this->db = $utilities->db; // assigns only the db connection

    }   


    public function withdrawer ($username, $addr, $coin, $amount) {
        if (empty($username) || empty($amount)) {
            $this->utilities->message(0, "All fields are required");
        } else {
            $sql = "SELECT * FROM wallet_tb WHERE  username = ?";
            $stmt = $this->db->run($sql, [$username]);
            $result = $stmt->fetch();
            $balance = $result["balance"];
            $transact_id = rand(1000, 9999999) + time();

            if ($balance > $amount) {
                $on = date("d-m-Y H:i:s", time());
                $sql2 = "INSERT INTO withdraw_tb (username, transact_id, transact_amt, sendToWallet, coin, time_stamp) VALUES (?,?,?,?,?,?)";
                $stmt2 = $this->db->run($sql2, [$username, $transact_id, $amount, $addr, $coin, $on]);
                if ($stmt2->rowCount() > 0) {
                    $c_balance = $this->utilities->updateBalance($username, $amount, "minus");
                    $this->utilities->message(1, "Your withdrawal request has been received and will be attended to shortly.");

                    $user = $this->utilities->getUser($username); // fetches uses details. this method is found in Utilities class

                    $full_name = $user["first_name"]." ".$user["last_name"];
                    $this->debitMail($user["email"] ,$full_name, $addr, $coin,$amount,$transact_id, $c_balance); 
                    $slug = "request:sent";
                    $desc = "withdraw request has been sent";
                    $created_on = date("m-d-Y H:i:s", time());
                    $this->utilities->logs($username, $transact_id, $desc, $amount, $slug, $created_on);
                } 
            } else {
                    $this->utilities->message(0, "insufficient balance");
            }
        }

        return $this->utilities->msg;
    }

    private function debitMail ($to, $name, $addr, $coin, $amt, $tID, $bal) {
        $amt=number_format($amt,"2");
        $balance = number_format($bal, "2");
         $message = "
                    Hello <b>$name</b>,<br><br>
                    Your request to withdraw &euro;$amt from your account is under review. We will get back to you shortly. Thank you! <br><br>
                    Transaction ID: #$tID  <br>
                    Coin: $coin <br>
                    Address: $addr
                    <br>
                    Total balance = &euro;$balance
                    <br><br>

                    Warm regards. <br>
                    Digitatransfer<br>.
                    ";
        $subject = "Withdraw request";
        $this->utilities->sendMail($to, $subject, $message);
    }

    public function confirmedMail ($to, $name, $amt, $bal) {
        $amt=number_format($amt,"2");
        $balance = number_format($bal, "2");
         $message = "
                    Hello <b>$name</b>,<br><br>
                    Your request to withdraw &euro;$amt has been approved. <br><br>
                    Total balance = &euro;$balance
                    <br><br>
                    Thank you! for choosing us

                    Warm regards. <br>
                    Digitatransfer<br>.
                    ";
        $subject = "Withdraw Approved";
        $this->utilities->sendMail($to, $subject, $message);
    }

    public function getWithdraws () {
        $sql = "SELECT * FROM withdraw_tb WHERE transact_status = ?";
        $stmt = $this->db->run($sql, [0]);
        $num = $stmt->rowCount();
        if ($num > 0) {
            return $stmt->fetchAll();
        }
    }

    public function approve ($user, $tran_id) {
        $sql = "SELECT * FROM withdraw_tb WHERE username = ? AND transact_id = ?";
        $stmt = $this->db->run($sql, [$user, $tran_id]);
        $result = $stmt->fetch();
        $amount = $result["transact_amt"];

        $c_balance = $this->utilities->updateBalance($user, $amount, "add");

        $toUser = $this->utilities->getUser($user); // fetches uses details. this method is found in Utilities class
        $to = $toUser["email"];
        $name = $toUser["first_name"]. " ".$toUser["last_name"];

        if ($stmt->rowCount() > 0) {
            $sql2 = "UPDATE withdraw_tb SET transact_status = ? WHERE username = ? AND transact_id = ?";
            $stmt2 = $this->db->run($sql2, [1, $user, $tran_id]);
            $num = $stmt->rowCount();
            if ($num > 0) {
                $desc = "Withdrawal request has been approved";
                $slug = "withdraw:Approved";
                $created_on = date("d-m-Y H:i:s", time());
                $this->utilities->message(1, "withdrawal has been approved");
                $this->confirmedMail($to, $name, $amount, $c_balance);
                $this->utilities->logs($user, $tran_id, $desc, $amount, $slug, $created_on);
                $this->utilities->message(0, "withdrawal has been approved");
            } else {
                 $this->utilities->message(0, "Something went wrong");
            }
        } else {
            $this->utilities->message(0, "no record available");
        }
        return  $this->utilities->msg;
    }

}