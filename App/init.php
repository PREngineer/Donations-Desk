<?php

// Initialize the session
session_start();

// If the error variable doesn't exist, create it NULL
if( !isset($_SESSION['error']) )
{
	$_SESSION['error'] = '';
}

// If the session's language variable doesn't exist, create it with Spanish as default
if( !isset($_SESSION['language']) )
{
	$_SESSION['language'] = 'es';
}

// Change the language of the page if selected
if( isset($_GET['lang']) )
{
	if( $_GET['lang'] == 'es') {
		$_SESSION['language'] = 'es';
	}
	else{
		$_SESSION['language'] = 'en';
	}
	
	echo '
    <script>
      window.location = "index.php";
    </script>
  	';
}

// If the session's registration error variables doesn't exist, create it empty
if( !isset($_GLOBALS['language']) )
{
	$errors = array();
}

// If the user-registration-data doesn't exist, create it empty
if( !isset($_GLOBALS['register_user_data']) )
{
	$register_user_data = array();
}

/*
  Function that checks if the user SESSION is active
  - Used all over the place
  @Return - Boolean (T or F) if logged in
*/
function isLoggedIn()
{
  	return ( $_SESSION['userID'] !== NULL ) ? true : false;
}

/*
	Function that returns the current page's URL
	- Used in the change of language
	@Return - Returns the full HTTP PATH for the current page
*/	
function curPageURL()
{
	$pageURL = 'http';

	if ($_SERVER['SERVER_PORT'] === '443') { $pageURL .= "s"; }
	
  	$pageURL .= "://";
	
  	if ($_SERVER["SERVER_PORT"] != "80") { $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"]; } 
  	else { $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"]; }

	return $pageURL;
}

?>
