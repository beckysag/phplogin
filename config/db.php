<?php


if ( $_SERVER['DOCUMENT_ROOT'] == '/home/rebecc82/public_html' ) { // if live

	$db_host = "localhost";
	$db_user = "rebecc82_admin";	
	$db_pass = 'S4Db?sa;o(Lo';
	$db_name = "rebecc82_db_users";	

} elseif ( $_SERVER['DOCUMENT_ROOT'] == '/Users/rsagalyn/projects/phplogin' ) { // if local

	$db_host = "localhost";
	$db_user = "root";	
	$db_pass = "root";	
	$db_name = "db_users";	

}




// create a database connection
try {
	$db = new PDO('mysql:host=' . $db_host . ';dbname=' . $db_name, $db_user, $db_pass);
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
	echo "Error!: " . $e->getMessage(); 
}
