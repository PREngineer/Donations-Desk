<?php

//Error message
$error_message = 'Sorry, DB connection error.  Please refresh the page.';

//MySQL Connection Parameters
// HOSTNAME, USERNAME, PASSWORD
// if there's a connection problem, it wil show the error message
mysql_connect('<host ip>', '<user name>', '<password>') or die($error_message);

//Name of the Database to connect to
mysql_select_db('<db name>');

// Set the Charset
mysql_query("SET NAMES 'utf8'");

?>