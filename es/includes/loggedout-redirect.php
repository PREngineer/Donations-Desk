<?php

// If the user is not logged in
if(!logged_in())
{
	// Redirect to Log in Page
	header('Location: login.php');
	exit();
}

?>