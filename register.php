<?php	

require_once("init.php");

$user1 = new User($db);

// If the form was just submitted
if (isset($_POST["register"])) {

  	// If the form was submitted - try to register user
	$user1->register();

	
	// If registration is sucessful
	if ( $user1->isError() == false ) {
		echo "Account successfully created. <a href='index.php'>Return to login.</a>";
	}	

	// If failed, determine what the error is
	else {
		// if isMissingRegField()
		if ( $user1->isMissingRegField() ) {
			echo "All fields are required";
		}
		
		// else if isPasswordMismatch()
		elseif ( $user1->isPasswordMismatch() ) {
			echo "Passwords don't match";		
		}

		// else if userExists()
		elseif ( $user1->userExists() ) {
			echo "Username is already taken";		
		}

		// else if invalidChars()
		elseif ( $user1->invalidChars() ) {
			echo "Invalid characters";		
		}

	}
}
?>



<!DOCTYPE html>
<html>
	<head>
	<title>Register</title>
	<meta charset="utf-8">
	<link href="css/style.css" rel="stylesheet" type="text/css">	
	<script src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
	<script>
	$(document).ready(function(){	
		$('.forms label').wrap('<div>');
	})	
	</script>	
</head>

<body>
	<div class="container">	

		<div><h2>Register</h2></div>

		<form method="post" class="forms" action="<?php echo $_SERVER['PHP_SELF']?>" novalidate>
			<ul>
				<li>
					<label for="fname">First Name</label>
					<input type="text" id="fname" name="fname" required>
				</li>

				<li>
					<label for="lname">Last Name</label>
					<input type="text" id="lname" name="lname" required>
				</li>

				<li>
					<label for="username">Username</label>
					<input type="text" id="username" name="username" required>
				</li>

				<li>
					<label for="password">Password</label>
					<input type="password" id="password" name="password" required>
				</li>

				<li>
					<label for="confirm">Confirm Password</label>
					<input type="password" id="confirm" name="confirm" required>
				</li>

				<li>
					<input type="submit" name="register" value="Submit">
				</li>
			</ul>
		</form>		

		<a href="index.php">Back to login</a>
    </div>
</body>
</html>
