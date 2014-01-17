<?php	

require_once("init.php");

// create new user object
$user1 = new User($db);

// If the form was just submitted
if (isset($_POST["register"])) {
	
	// If registration is sucessful
	if ( $user1->isError() == false ) {
		echo "Account successfully created. <a href='index.php'>Return to login.</a>";
	}
	else {
		include ('views/register.php');	
	}
}

// Otherwise display registration form
else {
	include ('views/register.php');
}
