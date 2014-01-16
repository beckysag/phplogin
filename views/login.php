<!DOCTYPE html>
<html>
	<head>
	<title>Login</title>
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
		// If login failed, determine what the error is
		// isError() only returns true if login was attempted and failed
		if ( $user1->isError() == true ) {

			// if isMissingLoginField()
			if ( $user1->isMissingLoginField() ) {
				echo "All fields are required<br>";
			}

			// else if isWrongCredentials()
			elseif ( $user1->isWrongCredentials() ) {
				echo "Incorrect username/password combination<br>";
			}
		}
		?>

		<div>
			<h2>Login Form</h2>
		</div>

		<form class="forms" method="post" action="<?php echo $_SERVER['PHP_SELF']?>" novalidate>
		
			<ul>
				<li>
					<label for="username">Username</label>
					<input type="text" id="username" name="username" required>
				</li>

				<li>
					<label for="password">Password</label>
					<input type="password" id="password" name="password" required>
				</li>

				<li>
					<input type="submit" name="login" value="Login">
				</li>
			</ul>
		</form>
	
		<a href="register.php">Register</a>

    </div>
</body>
</html>
