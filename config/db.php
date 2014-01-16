<?php

$db_host = "localhost";
$db_user = "root";	
$db_pass = "root";	
$db_name = "db_users";	


// create a database connection
try {
	$db = new PDO('mysql:host=' . $db_host . ';dbname=' . $db_name, $db_user, $db_pass);
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
	echo "Error!: " . $e->getMessage(); 
}
