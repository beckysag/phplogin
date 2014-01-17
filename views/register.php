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

		<?php

		// If registration failed, determine what the error is
		if ( $user1->isError() == true ) {

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

		?>

		<div><h2>Register</h2></div>

		<form method="post" class="forms" novalidate>
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
