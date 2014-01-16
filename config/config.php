<?php

// Turn on all errors
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(-1);

// set session save path
ini_set('session.gc_probability', 1);
session_save_path ('/Users/rsagalyn/Dropbox/htdocs/timetracker/sessions');
//ini_set('session.save_path',realpath(dirname($_SERVER['DOCUMENT_ROOT']) . '/htdocs/timetracker/sessions'));



// any other configuration details go here...
