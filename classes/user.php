<?php

//file_put_contents('log.txt',$log);

/**
 * User class
 * 
 * handles user registration, login, logout
 * constructor requires an active database connection
 */


// TO DO:
// To prevent session hijacking through cross site scripting (XSS) you should always filter 
// 		and escape all user supplied values before printing them to screen. 

// apply htmlentites() to anything that you are outputting from a user's input 
//		(this includes the session data you are returning to pre-fill the form input values):

// ssl, https



class User
{
    private $db;
    private $username;
    //protected $user_id;
    //protected $password; 
    //protected $first_name;
    //protected $last_name;

    private $is_logged_in = false;	

	// Errors
    private $is_errors = false;			// error flag

	// registration errors
	private $missing_reg_field = false;
	private $password_mismatch = false;
	private $user_exists = false;
	private $invalid_chars = false;
	
	// login errors
	private $missing_login_field = false;
	private $wrong_credentials = false;



	/**
	 * constructor
 	 */
	public function __construct(PDO $db) 
	{
		$this->db = $db;	

		// Check to see if user has existing session
		if (isset($_SESSION["user_name"])) { 	
			$this->is_logged_in = true;			
		}

		// If logout button was clicked, logout user
		if (isset($_POST["logout"])) {
			$this->logout();
		}

	  	// If a login form was submitted, try to login user
		elseif (isset($_POST["login"])) {
			$this->login();		
		}

		elseif (isset($_POST["register"])) {
			$this->register();
		}

    }



	/**
	 * registration function
	 *
	 * Uses: $_POST['username'], $_POST['password'], 
	 *	 	 $_POST['confirm'], $_POST['submit'], 
	 * 		 $_POST['fname'], $_POST['lname']
 	 */
	public function register() 
	{
		// If the form was just submitted
		if (isset($_POST["register"])) {

			// Check to see if all fields have been posted
			if (empty($_POST["fname"]) ||
				empty($_POST["lname"]) ||
				empty($_POST["username"]) ||
				empty($_POST["password"]) ||
				empty($_POST["confirm"]) ){	

				$this->is_errors = true;
				$this->missing_reg_field = true;				
			}
		
			// Check to see that passwords match
			elseif ($_POST['password'] !== $_POST['confirm']) {
				$this->is_errors = true;
				$this->password_mismatch = true;			
			}

		     // Check for illegal chars in the username/password
       		elseif (!preg_match('/^[a-zA-Z\d]{1,}$/i', $_POST['username']) ||
	       			!preg_match('/^[a-zA-Z\d]{1,}$/i', $_POST['username']) ) {
				$this->is_errors = true;
				$this->invalid_chars = true;
	        }

			// Posted data is good, continue...
			else {
				// Check to see if username already exists
				if ($this->is_username_taken($_POST["username"]) == true) {				

					$this->is_errors = true;
					$this->user_exists = true;			

				} else {
								
					// Create hash of password using PHP 5.5's password_hash();
					// salt is created as part of the hash
					$user_pass_hash = password_hash($_POST["password"], PASSWORD_DEFAULT);

					$stmt = $this->db->prepare("INSERT INTO users 
							(user_name, user_fname, user_lname, user_pass) VALUES (?,?,?,?)");
					$stmt->execute(
						array($_POST["username"], 
							  $_POST["fname"], 
							  $_POST["lname"], 
							  $user_pass_hash));				
				}
			}		
		}	    
		// Else, form not submitted, so no action taken
	}  
	


	/**
	 * login function
	 * Uses: $_POST['username'], $_POST['password'], $_POST['login']
 	 */
 	private function login()  
    {      
		// Check to see if user already logged in
		if (isset($_SESSION["user_name"])) { 	
			$this->is_logged_in = true;
		}

		// If the login form was just submitted
		elseif (isset($_POST["login"])) {
			$this->login_from_post();
		}	    
    }



    /**
     * login using data from post
     */
	private function login_from_post()  
    {      
	    // Check for all required post data 
		if (empty($_POST["username"]) || empty($_POST["password"])) {
			$this->is_errors = true;
			$this->missing_login_field = true;				
		} 

		// If user entered both username and password, query for username
		else {
			$stmt = $this->db->prepare("SELECT user_name, user_fname, user_lname, user_pass FROM users WHERE user_name=?");
			$stmt->execute(array($_POST["username"]));
			$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

			if (count($rows) == 1) {
				// The specified username was found in the database

				$result_row = $rows[0];

				// Verify password
				if (password_verify($_POST["password"], $result_row['user_pass'])) {				
					// Login was successful!

					$this->is_logged_in = true;			

					// Store the username in the session array
					$_SESSION["user_name"] = $result_row['user_name'];

				}
				else {
					// Incorrect password
					$this->is_errors = true;
					$this->wrong_credentials = true;
				} 			

			} else {
				// User doesnt exist
				$this->is_errors = true;
				$this->wrong_credentials = true;
			}
		}
    }



	/**
	 * logout function
	 *
	 * triggered when $_POST['logout'] is set
 	 */
	private function logout()
    {  
		session_unset();
		session_destroy();
		$this->is_logged_in = false;
	}



    /**
     * query database for $username to see if it exists
     * @return boolean indicating whether $username exists
     */
	private function is_username_taken($username)
	{
		// Create prepared statement and bind parameters
		$stmt = $this->db->prepare("SELECT user_name, user_pass FROM users WHERE user_name = ?");

		// Execute prepared statement
		$stmt->execute(array($username));

		// Fetch results
		$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

		// If result is returned, username already exists
		if (count($rows) > 0) {
			return true;
		} else {
			file_put_contents('log.txt',0);
			return false;
		}
	}



    /**
     * return current state of the error flag
     * @return boolean error flag
     */
    public function isError()
    {
        return $this->is_errors;
    }



    /**
     * return current state of the password mismatch flag
     * @return boolean password mismatch flag
     */
    public function isPasswordMismatch()
    {
        return $this->password_mismatch;
    }



    /**
     * return current state of the password flag
     * @return boolean password flag
     */
    public function isWrongCredentials()
    {
        return $this->wrong_credentials;
    }



    /**
     * return current state of the missing registration field flag
     * @return boolean missing registration field flag
     */
    public function isMissingRegField()
    {
        return $this->missing_reg_field;
    }
    

    /**
     * return current state of the missing login field flag
     * @return boolean missing login field flag
     */
    public function isMissingLoginField()
    {
        return $this->missing_login_field;
    }
    

    /**
     * return current state of the user exists flag
     * @return boolean user exists flag
     */
	public function userExists()  
    {
		return $this->user_exists;
    }  


    /**
     * return current state of the logged in flag
     * @return boolean logged in flag
     */
	public function isLoggedIn()  
    {
		return $this->is_logged_in;
    }  


    /**
     * return current state of the invalid chars flag
     * @return boolean invalid chars flag
     */
	public function invalidChars()  
    {
		return $this->invalid_chars;
    }  


    /**
     * return user's username
     * @return string user's username
     */
	public function getUsername()  
    {
    	if ($this->is_logged_in == true)
			return htmlentities($_SESSION['user_name']);
		else
			return "";
    }  


}