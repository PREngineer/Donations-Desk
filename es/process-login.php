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
		$_SESSION['error'] = 'Tiene que proveer tanto el usuario como la contraseña.';
		
		// Redirect user to Login
		header('Location: login.php');
		exit();
	}
	// If the username doesn't exists
	else if(user_exists($username) === false)
	{
		// Set error message
		$_SESSION['error'] = 'Información inválida. Por favor, regístrese.';
		
		// Redirect user to Login
		header('Location: login.php');
		exit();
	}
	// If the account is not active yet
	else if(user_active($username) === false)
	{
		// Set error message
		$_SESSION['error'] = 'Su cuenta no ha sido activada todavía.  Verifique su e-mail y siga las instrucciones.<br><a href="resend-email.php?username=' . $username . '">¡Reenviar e-mail de activación!</a>';

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
			$_SESSION['error'] = 'Combinación de Usuario y Contraseña inválidas.';
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