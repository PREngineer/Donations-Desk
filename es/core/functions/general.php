<?php

	// THIS FILE HOUSES GENERAL FUNCTIONS

	/* 
		Function that protects admin pages
		- Redirects users to myaccount if not an admin
		@Action - Redirect to My Account Page
	*/
	function admin_protect()
	{
		if ( logged_in() === false || $user_data['role'] == '0')
		{
			header ('Location: myaccount.php');
			exit();
		}
	}

	/* 
		Function that prevents SQL Injection
		- Used to make sure no SQL Injection is used against the DB.
		@Param - Reference to the Array
		@Action - Cleans an Array from SQL Injection
	*/
	function array_sanitize(&$item)
	{
		$item = mysql_real_escape_string($item);
	}

	/*
		Function that returns the current page's URL
		- Used in the change of language
		@Return - Returns the full HTTP PATH for the current page
	*/
	
	function curPageURL()
	{
	 $pageURL = 'http';
	 if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
	 $pageURL .= "://";
	 if ($_SERVER["SERVER_PORT"] != "80") {
	  $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
	 } else {
	  $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
	 }
	 return $pageURL;
	}

	/* 
		Prints the Errors from an Array
		- Used to print the Errors Array
		@Param - An Array
		@Return - A String with all the Errors, formatted as HTML List
	*/
	function output_errors($errors)
	{
		// Print the errors
		return '<ul><li>' . implode('</li><li>', $errors) . '</li></ul>';
	}

	/* 
		Function that protects access to user pages
		- Used to redirect users to login if not logged in
		@Action - Redirects to the Login page
	*/
	function protect()
	{
		if ( logged_in() === false )
		{
			header ('Location: login.php');
			exit();
		}
	}

	/* 
		Cleans a string from SQL Injection
		- Used to make sure no SQL Injection is used against the DB.
		@Param - A String
		@Return - The Sanitized string (Prevent SQL Injection)
	*/
	function sanitize($data)
	{
		return mysql_real_escape_string($data);
	}

?>