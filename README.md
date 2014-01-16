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
`/`
<br>&nbsp;&nbsp;&nbsp;&nbsp;
`/classes`
<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
`index.php`
<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
`init.php`

<br>&nbsp;&nbsp;&nbsp;&nbsp;
`/config`
<br>&nbsp;&nbsp;&nbsp;&nbsp;
`/css`
<br>&nbsp;&nbsp;&nbsp;&nbsp;
`/libraries` 
<br>&nbsp;&nbsp;&nbsp;&nbsp;
`/sessions` 
<br>&nbsp;&nbsp;&nbsp;&nbsp;
`index.php`
<br>&nbsp;&nbsp;&nbsp;&nbsp;
`init.php`


##Use Cases

1. If a session exists, remember the user
2. 

##Design Decisions
* Passwords are hashed + salted



