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
		if ($user1->isLoggedIn() == true) {
			echo "Welcome " . $user1->getUsername() . "!<br>";	
		}
		?>


		<form method="post">
			<input type="submit" name="logout" value="logout">
		</form>	

    </div>
</body>
</html>
