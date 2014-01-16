<?php

/* 
 * should be included at the top of every page
 * does the following: 
 * 	- starts (resumes) a session
 *  - defines database constants
 * 	- opens a new connection to the database
 * 	- checks the php version and includes the password compatibility library if necessary
 * 	  or stops the script's execution if PHP < 5.3.7
 *
 */


// Turn on all errors
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(-1);

// help prevent session fixation
ini_set('session.cookie_httponly',1);
ini_set('session.use_only_cookies',1);	// don't store SIDs in URLs
//ini_set('session.cookie_secure',1);	// turn this on if SSL cert


// Start/resume session
session_start();

// Required configuration files/libraries
require_once("config/db.php");
require_once("classes/user.php");

// Check php version; password hashing compatibility library requires PHP >= 5.3.7
// If PHP < 5.3.7, website won't work
if (version_compare(PHP_VERSION, '5.3.7', '<')) {
	exit("PHP >= 5.3.7 is required");
}

// PHP password hashing API requires PHP >= 5.5
// If 5.3.7 <= PHP < 5.5, use password_compat library (https://github.com/ircmaxell/password_compat)
elseif (version_compare(PHP_VERSION, '5.5.0', '<')) {
	require_once("libraries/password.php");
}

