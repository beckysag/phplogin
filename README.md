#PHP Login

A simple object-oriented PHP login script

Uses the PHP 5.5 secure hashing API, which uses the bcrypt algorithm and an automatically generated salt. 

##Requirements
* PHP 5.3.7+
* MySQL 5.5+
* PDO enabled
* MySQL database with a users table as defined below (database name and other constants are defined in `config/db.php`)

##Creating the database

Create the following table in the database defined in `config/db.php`:

`CREATE TABLE` \``users`\` `(` <br/>
&nbsp;&nbsp;&nbsp;&nbsp;
`` `user_id` `` `int(255) NOT NULL AUTO_INCREMENT,`<br/>
&nbsp;&nbsp;&nbsp;&nbsp;
`` `user_name` `` `varchar(64) NOT NULL,`<br/>
&nbsp;&nbsp;&nbsp;&nbsp;
`` `user_fname` `` `varchar(64) NOT NULL,`<br/>
&nbsp;&nbsp;&nbsp;&nbsp;
`` `user_lname` `` `varchar(64) NOT NULL,`<br/>
&nbsp;&nbsp;&nbsp;&nbsp;
`` `user_pass` `` `varchar(255) NOT NULL,`<br/>
&nbsp;&nbsp;&nbsp;&nbsp;
`PRIMARY KEY (` `` `user_id` `` `),`<br/>
&nbsp;&nbsp;&nbsp;&nbsp;
`UNIQUE KEY` `` `user_name` `` `(` `` `user_name` `` `)`<br/>
`) ENGINE=InnoDB DEFAULT CHARSET=latin1;`


##Directory Structure
    
    /
	    /classes
    	    user.php			-- handles user registration/login/logout
	    /config
        	db.php				-- defines db constants and opens connection
	    /css
			style.css	  	  	-- basic styling
		/libraries
			password.php		-- password compatibility library
		/views
			loggedin.php		-- displayed upon user login
			login.php			-- login form
		index.php
		init.php			-- includes configuration settings
		register.php		-- user registration page


##Use Cases
The User class (`classes/user.php`) handles four general scenarios:

1. User with an active session on the server returns to the website
2. User attempts to log in
3. User attempts to register a new account
4. User logs out

It first looks for an existing session and then looks at posted data to determine if a user attempted to register/login/logout. 

##Usage

###1. Include `init.php` at the top of each page:

* starts (or resumes) a session
* defines database constants
* opens a new connection to the database
* checks the php version and includes the password compatibility library if necessary or stops the script's execution if PHP < 5.3.7
* any other configuration settings should go here


###2. Instantiate a `User` object


###3. Submit a form with a submit button with a name in {}




