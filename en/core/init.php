<?php

session_start();

// Call the php with the connection parameters
require 'core/database/connect.php';

// Call the php with the user functions
require 'core/functions/users.php';

// Call the php with the admin functions
require 'core/functions/admin.php';

// Call the php with the general functions
require 'core/functions/general.php';

// Call the php with the display functions
require 'core/functions/display.php';

// Call the php with the count functions
require 'core/functions/count.php';

// If the error variable doesn't exist, create it NULL
if(array_key_exists('error', $_SESSION) === false)
{
	$_SESSION['error'];
}

// If the session's user_id variable doesn't exist, create it NULL
if(array_key_exists('error', $_SESSION) === false)
{
	$_SESSION['user_id'];
}

// If the session's registration error variables doesn't exist, create it empty
if(array_key_exists('errors', $GLOBALS) === false)
{
	$errors = array();
}

// If the user-registration-data doesn't exist, create it empty
if(array_key_exists('register_user_data', $GLOBALS) === false)
{
	$register_user_data;
}

// To get logged user data and its NFPO
if(logged_in())
{
	//COULD BE IMPLEMENTED IF WANTED - Just uncomment this function and follow instructions.
	/* 	This function automatically logs out the user if the user has been banned from the website
		To perform the banning a field in the Accounts table has to be created named 'banned' and
		set to '1' on that specific account.  Field has to be of type 'int'
		IMPORTANT: FOR THIS TO WORK, THE 'banned' FIELD MUST ALSO BE ADDED TO THE 'user_data' 
		FUNCTION BELOW!!!
		The System will automatically log the person out and display a message to that user below
		the login form.
	*/
/*	if($user_data['banned'] != 0)
	{
		$_SESSION['error'] = 'Unfortunately, you have been banned from Donations Desk.  
								Contact us if you think it was a mistake.';
		session_destroy();
		header('Location: login.php');
		exit();
	}
*/

	// Pass the Session user id to the function
	$session_user_id = $_SESSION['user_id'];

	/* Calls the function that retrieves the data, function is in core/functions/users.php

	   IMPORTANT: 	The fields that are surrounded by ' ' are the fields of the database query.
	   SO MAKE SURE TO WRITE IT EXACTLY AS IT IS IN THE MYSQL DATABASE!!!

	   				You can (add more)/(remove) Database fields from the parameters to retrieve their info from the Database
	   				Examples: 
	   				user_data($session_user_id, 'id', 'active', role', 'username', 'password', 'first-name', 'last-name')
	   				user_data($session_user_id, 'id', 'active', 'role', 'username', 'password', 'first-name', 'last-name', 'email', 'sex')

	   NOTE FOR USE:

	   Whenever you want to display any of the fields obtained here, you just have to call the specific
	   field (in any page that has the init.php file included) like this:
	   		$echo $user_data['FIELD_NAME']
	   Examples: 	
	   		$echo $user_data['id']
	   		$echo $user_data['username']
	   		$echo $user_data['first-name']
	*/
	$user_data = user_data($session_user_id, 'id', 'active', 'role', 'username', 'password', 'first-name', 'last-name', 'email');

}


?>