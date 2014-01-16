<?php

require_once("init.php");

// Create new user object, resume session if user has one already
// If the form was just submitted, login will be attempted
$user1 = new User($db);

?>


<?php
if ($user1->isLoggedIn() == true) {
	// show main content
	include ("views/loggedin.php");
}

else {
	// show login form
	include ("views/login.php");
}
?>
