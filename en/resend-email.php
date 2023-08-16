<?php

include 'core/functions/users.php';

//Error message
$error_message = 'Sorry, DB connection error.  Please refresh the page.';

//MySQL Connection Parameters
// HOSTNAME, USERNAME, PASSWORD
// if there's a connection problem, it wil show the error message
mysql_connect('localhost', 'asesore3_ddesk', 'JMPS#AfC14') or die($error_message);

//Name of the Database to connect to
mysql_select_db('asesore3_donationsdesk');

// Set the Charset
mysql_query("SET NAMES 'utf8'");

send_activation_email($_GET['username']);

header('Location: myaccount.php');
exit();

?>