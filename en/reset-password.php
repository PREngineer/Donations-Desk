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

forgot_password($_POST['email']);

header('Location: forgot-password.php?success=1');
exit();


/* ATTEMPT # 2 - Directly */

// Retrieve the user's information
// $query = "SELECT * FROM `Accounts` WHERE `email` = '" . $_POST['email'] . "'";
// $result = mysql_fetch_assoc( mysql_query($query) );

// echo $query . '<br>';

// echo $_POST['email'];

// // Change password
// $pass = substr(str_shuffle(abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ),0, 1) . 
// 		substr(str_shuffle(aBcEeFgHiJkLmNoPqRstUvWxYz0123456789),0, 8);

// mysql_query("UPDATE `Accounts` SET `password` = '" . MD5($pass) . "' WHERE `email` = '$email'");

// // Send the activation e-mail to the registered user
// mail($result['email'], 'Credentials | Credenciales', 

// "Hello " . $result['first-name'] . ",

// \nSince you've forgotten your password, we have changed it.  You can change it once you log in.

// \nYour credentials are:

// \nUsername: " . $result['username'] . "

// \nPassword: " . $result['password'] . "

// \nSincerely,

// \nDonations Desk

// \n---------------------------------------------------------

// \nHola " . $result['first-name'] . ",

// \nComo has olvidado tu contrasena, la hemos cambiado.  Puedes cambiarla una vez entres.

// \nTus credenciales son:

// \nUsuario: " . $result['username'] . "

// \nContrasena: " . $result['password'] . "

// \nSinceramente,

// \nDonations Desk",

// 'From: noreply@donationsdesk.org');

?>