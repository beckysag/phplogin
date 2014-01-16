<?php

// Do i need an ssl cert???
//ini_set('session.cookie_secure',1);
ini_set('session.cookie_httponly',1);
ini_set('session.use_only_cookies',1);

// start/resume session
session_start();

// Required configuration files go here
require_once("config/config.php");
require_once("config/db.php");
require_once("classes/user.php");


// Check php version; password hashing compatibility library requires PHP >= 5.3.7
// If PHP < 5.3.7, website won't work
if (version_compare(PHP_VERSION, '5.3.7', '<')) {
	exit("PHP >= 5.3.7 is required");
}

// PHP hashing API requires PHP >= 5.5
// If 5.3.7 <= PHP < 5.5, use password_compat library 
// https://github.com/ircmaxell/password_compat
elseif (version_compare(PHP_VERSION, '5.5.0', '<')) {
	require_once("libraries/password.php");
}

