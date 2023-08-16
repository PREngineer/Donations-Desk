<?php

// Include connection settings, etc.
include 'includes/head.php';

// If posted
if(empty($_POST) === false)
{
	// Get the posted username and save it to variable
	$username = $_POST['username'];
	// Get the posted password and save it to variable
	$password = $_POST['password'];

	// If the Username or Password is empty
	if(empty($username) === true || empty($password) === true)
	{
		// Set error message
		$_SESSION['error'] = 'You need to enter both: a username and a password.';
		
		// Redirect user to Login
		header('Location: login.php');
		exit();
	}
	// If the username doesn't exists
	else if(user_exists($username) === false)
	{
		// Set error message
		$_SESSION['error'] = 'Invalid Information. Please register.';
		
		// Redirect user to Login
		header('Location: login.php');
		exit();
	}
	// If the account is not active yet
	else if(user_active($username) === false)
	{
		// Set error message
		$_SESSION['error'] = 'Your account has not been activated yet.  Check your e-mail for activation instructions.<br><a href="resend-email.php?username=' . $username . '">Resend Activation e-mail!</a>';

		// Redirect
		header('Location: login.php');
		exit();
	}
	// 
	else
	{
		// Check that the user/password combination is correct
		$login = login($username, $password);
		// If it is not correct
		if($login === false)
		{
			// Set error message
			$_SESSION['error'] = 'Username/Password combination is incorrect.';
			// Redirect user to Login
			header('Location: login.php');
			exit();
		}
		// If it is correct
		else
		{
			// Set the User Session, session has the user id number, username, password and role
			$_SESSION['user_id'] = $login;
			$_SESSION['error'] = '';
			
			// Redirect user to MyAccount
			header('Location: myaccount.php');
			exit();
		}
	}

}

?>