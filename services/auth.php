
<?php 

/**
* 
*/

class Auth{

	// general properpies
	private $username;
	private $email;
	private $password;
	private $c_password;
	private $first_name;
	private $last_name;
	private $dob;
	private $address1;
	private $address2;
	private $city;
	private $state;
	private $code;
	private $country;
	private $phone;
	private $is_company;
	private $document;
	private $document_number;
	private $bill_address;
	private $bill_country;
	private $bill_code;
	private $bill_province;
	private $bill_city;
	private $msg;

	/*this constructor will return database connection which would be passed during the class initialization*/
	function __construct($db){
		$this->db = $db;
	}

	/*-------------registration--------------*/
	public function register($first,$last,$email,$pass,$cpass,$dob,$addr1,$addr2,$city,$state,$code,$country,$phone,$username,$is_company,$document,$document_number,$bill_address,$bill_country,$bill_code,$bill_province,$bill_city) {
		  // params is a placeholder for posts and not ...param in the real sense
         // remember to convert posts to array for the run method
         // let's call this array values
		$this->first_name = $first;
		$this->last_name = $last;
		$this->email = $email;
		$this->password = $pass;
		$this->c_password = $cpass;
		$this->dob = $dob;
		$this->address1 = $addr1;
		$this->address2 = $addr2;
		$this->city = $city;
		$this->state = $state;
		$this->code = $code;
		$this->country = $country;
		$this->phone = $phone;
		$this->username = $username;
		$this->is_company = $is_company;
		$this->document = $document;
		$this->document_number = $document_number;
		$this->bill_address = $bill_address;
		$this->bill_country = $bill_country;
		$this->bill_code = $bill_code;
		$this->bill_province = $bill_province;
		$this->bill_city = $bill_city;

		$this->username();
		$this->first_name();
		$this->last_name();
		$this->email();
		$this->password();
		$this->dob();
		$this->address1();
		$this->city();
		$this->state();
		$this->phone();
		$this->country();
		$this->others();
		$this->billing();

		if (empty($this->msg)) {
			$values1 = [$this->username,$this->email];
	        $sql = "SELECT * FROM user_tb WHERE username = ? OR email = ?";
	        $stmt = $this->db->run($sql, $values1);
	        if ($stmt->rowCount() >= 1) {
	            $this->message("failed", "username or email already exist");
	        } else {
	            // again, params is just a placeholder. i don't remember table column and properties names
	            $encrpt = password_hash($this->password, PASSWORD_DEFAULT);
	            // pass encrpt as the password. And this variable is still part of params
	            $values = [$this->first_name,$this->last_name, $this->email, $encrpt, $this->dob, $this->address1, $this->address2, $this->city, $this->state, $this->code, $this->country, $this->phone, $this->username, $this->is_company, $this->document, $this->document_number, $this->bill_address, $this->bill_country, $this->bill_code, $this->bill_city];

	            $sql = "INSERT INTO user_tb (first_name,last_name, email, password, dob, user_address1, user_address2, user_city, user_state, user_zip, user_country, user_phone, username, is_company, doc_type, doc_number, bill_addr, bill_country, bill_code, bill_city) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
	            $stmt = $this->db->run($sql, $values);
	            $num_change = $stmt->rowCount();
	            if ($num_change > 0) {
	                $this->message("success", "Registration is success");
	                /*this will create the users wallet account*/
	                $transact_id = time() + rand(1000, 9000);
	                $sq = "INSERT INTO wallet_tb (username,transact_id,balance) VALUES (?,?,?)";
	                $values2 = [$this->username, $transact_id,0];
	                $stt = $this->db->run($sq, $values2);
	            } else {
	                $this->message("failed", "Something went wrong. Try again!");
	            }  
	        }
		} 
		
		

        
        return $this->msg;
	}

	/*-------------login-------------------*/
	public function login ($user_email, $password,$input, $captcha) {
		if(empty($user_email) || empty($password)) {
			$this->message(0, "All fields are required");
		}
		 else if(empty($captcha)) {
			$this->message(0, "Enter Captcha");
		} 
		else if($input != $captcha) {
			$this->message(0, "Wrong answer");
		} 
		else {
			$sql = "SELECT * FROM user_tb WHERE username = ? OR email = ?";
			$value = [$user_email, $user_email];
			$stmt = $this->db->run($sql, $value);
			if ($stmt->rowCount() >= 1 ) {
				$result = $stmt->fetch();
				$dehash = password_verify($password, $result["password"]);
				if ($dehash) {
					// session_start();
					$_SESSION["rand_code"]  = $captcha;
					$_SESSION["user"] = $result["username"];
					$this->message(1, "login successful");;
				} else {
					 $this->message(0, "password is wrong");
				}
			} else {
				 $this->message(0, "invalid login details");
			}	
		}

		return $this->msg;
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

	/*-----------------The methods below are for validation of both registration and login----------*/

	// Registration validation comes first

	public function first_name () {
		if (empty($this->first_name)){
			$this->message("failed", "first name field is required");
		} else if(!preg_match("/^[a-zA-Z]*$/", $this->first_name)) {
			$this->message("failed", "first name field requires only letters");
		}
	}
	public function last_name () {
		if (empty($this->last_name)){
			$this->message("failed", "last name field is required");
		} else if(!preg_match("/^[a-zA-Z]*$/", $this->last_name)) {
			$this->message("failed", "last name field requires only letters");
		}
	}
	public function email () {
		if (empty($this->email)) {
			$this->message("failed", "empty email");
		} elseif (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
			$this->message("failed", "invalid email");
		}
	}
	public function password (){
		if($this->c_password != $this->password) {
			$this->message("failed", "Passwords do not match");
		}
	}

	public function address1 () {
        if (empty($this->address1)) {
            $this->message("failed", "address 1 field is empty");
        } 
     }
     public function country () {
        if (empty($this->country)) {
            $this->message("failed", "country field is empty");
        } 
     }
     public function dob () {
        if (empty($this->dob)) {
            $this->message("failed", "date of birth field is empty");
        } 
     }
     public function city () {
        if (empty($this->city)) {
            $this->message("failed", "city field is empty");
        } elseif (!preg_match("/^[a-zA-Z]*$/", $this->city)) {
            $this->message("failed", "city field requires only letters");
        }
     }
     public function state () {
        if (empty($this->state)) {
            $this->message("failed", "state field is empty");
        } elseif (!preg_match("/^[a-zA-Z ]*$/", $this->state)) {
            $this->message("failed", "state field requires only letters");
        }
     }
     public function phone () {
        if (empty($this->phone)) {
            $this->message("failed", "phone field is empty");
        } elseif (!preg_match("/^[0-9+-]*$/", $this->phone)) {
            $this->message("failed", "invalid phone number");
        }
     }

    public function others () {
    	if (empty($this->is_company) || empty($this->document_number) || empty($this->document)) {
    	$this->message("failed", "All fields are required");
    }
    }
     public function billing () {
         if (empty($this->bill_city) || empty($this->bill_address) || empty($this->bill_address) || empty($this->bill_country) || empty($this->bill_code) ) {
            $this->message("failed", "billing fields are required");
         }
     }
	public function username () {
		if (empty($this->username)){
			$this->message("failed", "username field is required");
		} else if(!preg_match("/^[a-zA-Z]*$/", $this->username)) {
			$this->message("failed", "username field requires only letters");
		}
	}


}