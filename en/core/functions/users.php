<?php

	// THIS FILE HOUSES USER RELATED FUNCTIONS

	/* 
		Function that activates an account
		- Used to set active in the DB
		@Param - Two Strings
		@Return - Boolean (T or F) if activated
	*/
	function activate($email, $email_code)
	{
		// Do not allow SQL injections
		$email 		= mysql_real_escape_string($email);
		$email_code	= mysql_real_escape_string($email_code);

		// If the information exists for a user that is NOT active
		if( mysql_result( mysql_query("SELECT COUNT(`id`) FROM `Accounts` WHERE `email` = '$email' AND `email_code` = '$email_code' AND `active` = 0"), 0) == 1)
		{
			// Activate that user
			mysql_query("UPDATE `Accounts` SET `active` = 1 WHERE `email` = '$email'");
			return true;
		}
		// If not, just say it didn't activate
		else
		{
			return false;
		}
	}

	/* 
		Function that activates an account
		- Used to set active in the DB
		@Param - Two Strings
		@Return - Boolean (T or F) if activated
	*/
	function activate_NFPO($username)
	{
		mysql_query("UPDATE `OSFL` SET `active` = 1 WHERE `username` = '$username'");
	}


	/*
		Checks whether the provided registration e-mail is already in the System
		- Used in the Registration Page
		@Param - A String
		@Return - Boolean (T or F) if exists
	*/
	// Function used to validate the e-mail exists in the DB
	function email_exists($email)
	{
		// Sanitize the email
		$email = sanitize($email);
		// Check how many users are return that match that email
		$query = mysql_query("SELECT COUNT(`id`) FROM `Accounts` WHERE `email` = '$email'");

		// If the e-mail is found return true
		// If not, return false
		return (mysql_result($query, 0) == 1) ? true : false;
	}

	/*
		Function that sends credentials
		- Used to send the credentials to the users
		@Param - A String
	*/
	function forgot_password($email)
	{
		// Retrieve the user's information
		$query = "SELECT * FROM `Accounts` WHERE `email` = '$email'";
		$result = mysql_fetch_assoc( mysql_query($query), 0 );

		// Change password
		$pass = substr(str_shuffle(abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ),0, 1) . 
				substr(str_shuffle(aBcEeFgHiJkLmNoPqRstUvWxYz0123456789),0, 8);

		mysql_query("UPDATE `Accounts` SET `password` = '" . MD5($pass) . "' WHERE `email` = '$email'");

		// Send the activation e-mail to the registered user
		$emailto = $result['email'];

		$toname = $result['first-name'];

		$emailfrom = 'noreply@domain.com';

		$fromname = 'Donations Desk';

		$subject = 'Credentials | Credenciales';

		$messagebody = "
		Hello " . $result['first-name'] . ",
	
		Since you've forgotten your password, we have changed it.  You can change it once you log in.
		Your credentials are:
		Username: " . $result['username'] . "
		Password: " . $pass . "
		Sincerely,
		Donations Desk

		---------------------------------------------------------

		Hola " . $result['first-name'] . ",
		
		Como has olvidado tu contraseña, la hemos cambiado.  Puedes cambiarla una vez entres.
		Tus credenciales son:
		Usuario: " . $result['username'] . "
		Contrasena: " . $pass . "
		Sinceramente,
		Donations Desk";

		$headers = 
			'Return-Path: ' . $emailfrom . "\r\n" . 
			'From: ' . $fromname . ' <' . $emailfrom . '>' . "\r\n" . 
			'X-Priority: 3' . "\r\n" . 
			'X-Mailer: PHP ' . phpversion() .  "\r\n" . 
			'Reply-To: ' . $fromname . ' <' . $emailfrom . '>' . "\r\n" .
			'MIME-Version: 1.0' . "\r\n" . 
			'Content-Transfer-Encoding: 8bit' . "\r\n" . 
			'Content-Type: text/plain; charset=UTF-8' . "\r\n";

		$params = '-f ' . $emailfrom;

		$test = mail($emailto, $subject, $messagebody, $headers, $params);
	}

	/*
		Function that checks if the user has a NFPO already registered
		- Used in My Account to display the Create NFPO or Edit NFPO Menu options
		@Param - A String
		@Return - Boolean (T or F) if exists
	*/
	function hasNFPO($username)
	{
		// Check if user has a NFPO in the DB
		$query = mysql_query("SELECT COUNT(`id`) FROM `OSFL` WHERE `username` = '$username'");

		// If a NFPO is found return true
		// If not, return false
		return (mysql_result($query, 0) == 1) ? true : false;
	}

	/*
		Function that checks if the user SESSION is active
		- Used all over the place
		@Return - Boolean (T or F) if logged in
	*/
	function logged_in()
	{
		return (isset($_SESSION['user_id'])) ? true : false;
	}

	/*
		Function that validates if the user information is correct to initiate SESSION
		- User in the Login Page
		@Param - Two Strings
		@Return - Boolean (T or F) if correct
	*/
	function login($username, $password)
	{
		// Get the user ID
		$user_id = user_id_from_username($username);

		// Sanitize the username & password
		$username = sanitize($username);
		$password = sanitize($password);
		// Encrypt password with MD5
		$password = MD5($password);

		// Count if the username & password combination exists
		$query = mysql_query("SELECT COUNT(`id`) FROM `Accounts` WHERE `username` = '$username' AND `password` = '$password'");	

		// Return the id if it exists,
		// return false if it doesn't
		return (mysql_result($query, 0) == 1) ? $user_id : false;
	}

	/*
		Function that checks whether the NFPO is active in the System
		- Used in the My Account page to determine whether to show Campaign options or to show the Activate NFPO option
		@Param - A String
		@Return - Boolean (T or F) if active
	*/
	function NFPO_active($username)
	{
		// Check if the username has an active NFPO
		$query = mysql_query("SELECT COUNT(`id`) FROM `OSFL` WHERE `username` = '$username' AND `active` = 1");	

		// Return the true if it exists,
		// return false if it doesn't
		return (mysql_result($query, 0) == 1) ? true : false;
	}

	/*
		Function used to retrieve the user's NFPO data
		- Used in the Edit NFPO Links in My Account
		@Param - A String
		@Return - An Array that contains all the information, no index, organized by DB field name
	*/
	function nfpo_data($username)
	{
		$data = array();
		
		$func_num_args = func_num_args();
		$func_get_args = func_get_args();

		if($func_num_args > 1)
		{
			unset($func_get_args[0]);

			$fields = '`' . implode('`, `', $func_get_args) . '`';

			$query = "SELECT $fields FROM `OSFL` WHERE `username` = '$username'";

			$data = mysql_fetch_assoc(mysql_query($query));

			return $data;
		}
	}

	/*
		Function that checks whether an NFPO exists in the System
		- Used in the Create NFPO page inside My Account
		@Param - A String
		@Return - Boolean (T or F) if exists
	*/
	function organization_exists($name)
	{
		// Sanitize the email
		$name = sanitize($name);
		// Check how many users are return that match that email
		$query = mysql_query("SELECT COUNT(`id`) FROM `OSFL` WHERE `organization-name` = '$name'");

		// If the organization name is found return true
		// If not, return false
		return (mysql_result($query, 0) == 1) ? true : false;
	}

	/*
		Function that registers the NFPO data in the DB
		- Used in the Create NFPO page in My Account
		@Param - The result of a Query (An Array with all the information, no index, associated by Field Name)
	*/
	function register_nfpo($nfpo_data)
	{
		// Sanitize all the elements of the array
		array_walk($nfpo_data, 'array_sanitize');
		// Part of the query that contains the fields to add in the DB
		$fields = '`' . implode('`, `', array_keys($nfpo_data)) . '`';
		// Part of the query that contains the values to be added
		$data = '\'' . implode('\', \'', $nfpo_data) . '\'';

		// Actual MySQL Query
		mysql_query("INSERT INTO `OSFL` ($fields) VALUES ($data)");
	}

	/*
		Function that registers the user data in the DB
		- Used in the Register Page
		@Param - An Array with all the information, no index, associated by Field Name
		@Action - This function also calls the function that sends the Activation e-mail to the user's provided e-mail.
	*/
	function register_user($register_user_data)
	{
		// Sanitize all the elements of the array
		array_walk($register_user_data, 'array_sanitize');
		// Hash the password with MD5 and re-assign its value to the array
		$register_user_data['password'] = MD5($register_user_data['password']);
		// Part of the query that contains the fields to change in the DB, ex. `username`, `password`
		$fields = '`' . implode('`, `', array_keys($register_user_data)) . '`';
		// Part of the query that contains the values to be added, ex. 'Administrator', '24werasrwe45w4arasd'
		$data = '\'' . implode('\', \'', $register_user_data) . '\'';

		// Actual MySQL Query
		mysql_query("INSERT INTO `Accounts` ($fields) VALUES ($data)");

		// Send Activation E-mail
		$emailto = $register_user_data['email'];

		$toname = $register_user_data['first-name'];

		$emailfrom = 'noreply@domain.com';

		$fromname = 'Donations Desk';

		$subject = 'Activate your Account | Activa tu Cuenta';

		$messagebody = "
		Hello " . $register_user_data['first-name'] . ",
		
		Welcome to Donations Desk!		
		To be able to use our services you need to activate your account.
		Click the following link to activate your account [or copy and paste it to your browser's address bar]:
		http://asesoresfinancierospr.org/donationsdesk/en/activate.php?email=" . $register_user_data['email'] . "&email_code=" . $register_user_data['email_code'] . "
		Sincerely,
		Donations Desk

		---------------------------------------------------------
		
		Hola " . $register_user_data['first-name'] . ",

		Bienvenid@ a Donations Desk!
		Para poder hacer uso de nuestros servicios necesitas activar tu cuenta.
		Toca el enlace [o cópialo en tu navegador] para activar tu cuenta:
		http://asesoresfinancierospr.org/donationsdesk/es/activate.php?email=" . $register_user_data['email'] . "&email_code=" . $register_user_data['email_code'] . "
		Sinceramente,
		Donations Desk";

		$headers = 
			'Return-Path: ' . $emailfrom . "\r\n" . 
			'From: ' . $fromname . ' <' . $emailfrom . '>' . "\r\n" . 
			'X-Priority: 3' . "\r\n" . 
			'X-Mailer: PHP ' . phpversion() .  "\r\n" . 
			'Reply-To: ' . $fromname . ' <' . $emailfrom . '>' . "\r\n" .
			'MIME-Version: 1.0' . "\r\n" . 
			'Content-Transfer-Encoding: 8bit' . "\r\n" . 
			'Content-Type: text/plain; charset=UTF-8' . "\r\n";

		$params = '-f ' . $emailfrom;

		$test = mail($emailto, $subject, $messagebody, $headers, $params);
	}

	/*
		Function that sends the activation link to the e-mail
		- Used after registration of the user is completed or activation request is made
		@Param - A String
		@Action - Redirects to Confirmation Page.
	*/
	function send_activation_email($username)
	{
		// Retrieve user information
		$info = mysql_fetch_assoc( mysql_query("SELECT `email`, `first-name`, `email_code` from Accounts WHERE username = '$username'"), 0 );

		// Send the activation e-mail to the registered user
		$emailto = $info['email'];

		$toname = $info['first-name'];

		$emailfrom = 'noreply@domain.com';

		$fromname = 'Donations Desk';

		$subject = 'Activate your Account | Activa tu Cuenta';

		$messagebody = "
		Hello " . $info['first-name'] . ",
		
		Welcome to Donations Desk!		
		To be able to use our services you need to activate your account.
		Click the following link to activate your account [or copy and paste it to your browser's address bar]:
		http://asesoresfinancierospr.org/donationsdesk/en/activate.php?email=" . $info['email'] . "&email_code=" . $info['email_code'] . "
		Sincerely,
		Donations Desk

		---------------------------------------------------------
		
		Hola " . $info['first-name'] . ",

		Bienvenid@ a Donations Desk!
		Para poder hacer uso de nuestros servicios necesitas activar tu cuenta.
		Toca el enlace [o cópialo en tu navegador] para activar tu cuenta:
		http://asesoresfinancierospr.org/donationsdesk/es/activate.php?email=" . $info['email'] . "&email_code=" . $info['email_code'] . "
		Sinceramente,
		Donations Desk";

		$headers = 
			'Return-Path: ' . $emailfrom . "\r\n" . 
			'From: ' . $fromname . ' <' . $emailfrom . '>' . "\r\n" . 
			'X-Priority: 3' . "\r\n" . 
			'X-Mailer: PHP ' . phpversion() .  "\r\n" . 
			'Reply-To: ' . $fromname . ' <' . $emailfrom . '>' . "\r\n" .
			'MIME-Version: 1.0' . "\r\n" . 
			'Content-Transfer-Encoding: 8bit' . "\r\n" . 
			'Content-Type: text/plain; charset=UTF-8' . "\r\n";

		$params = '-f ' . $emailfrom;

		$test = mail($emailto, $subject, $messagebody, $headers, $params);
	}

	/*
		Function that stores the Donation information in the DB
		- Used in the User Donation Info Page
		@Param - An Associative Array with the information
	*/
	function update_donation_info($data)
	{
		// Sanitize all the elements of the array
		array_walk($data, 'array_sanitize');
		
		$username = $data['username'];
		
		$bank = $data['bank-account'];
		$paypal  = $data['paypal'];
		
		// Actual MySQL Query that Updates the information
		mysql_query("UPDATE `OSFL` SET  `bank-account` = '$bank', `paypal` = '$paypal' WHERE `username` = '$username'");
	}

	/*
		Function that stores the Basic NFPO information in the DB
		- Used in the Basic NFPO Info Page
		@Param - An Associative Array with the information
	*/
	function update_NFPO_basic($data)
	{
		// Sanitize all the elements of the array
		array_walk($data, 'array_sanitize');

		$username 		= $data['username'];
		$name 			= $data['organization-name'];
		$physical 		= $data['physical-address'];
		$postal 		= $data['postal-address'];
		$municipality 	= $data['municipality'];
		$zip 			= $data['zip'];
		$inc 			= $data['inc-date'];
		$foundations 	= $data['foundations'];
		$category 		= $data['category'];
		$essn 			= $data['essn'];

		// Actual MySQL Query that Updates the information
		mysql_query("UPDATE `OSFL` SET `organization-name` = '$name', `physical-address` = '$physical', `postal-address` = '$postal', `municipality` = '$municipality', `zip` = '$zip', `inc-date` = '$inc', `foundations` = '$foundations', `category` = '$category', `essn` = '$essn' WHERE `username` = '$username'");
	}

	/*
		Function that stores the NFPO Purpose information in the DB
		- Used in the Purpose Info Page
		@Param - An Associative Array with the information
	*/
	function update_purpose_info($data)
	{
		// Sanitize all the elements of the array
		array_walk($data, 'array_sanitize');
		
		$username = $data['username'];
		
		$vision = $data['vision'];
		$mission = $data['mission'];
		$services = $data['services'];
		$projections = $data['projections'];
		$target = $data['target'];
		$impact = $data['impact'];

		// Actual MySQL Query that Updates the information
		mysql_query("UPDATE `OSFL` SET  `vision` = '$vision', `mission` = '$mission', `services` = '$services', `projections` = '$projections', `target` = '$target', `impact` = '$impact' WHERE `username` = '$username'");
	}

	/*
		Function that stores the Representative information in the DB
		- Used in the Representative Info Page
		@Param - An Associative Array with the information
	*/
	function update_rep_info($data)
	{
		// Sanitize all the elements of the array
		array_walk($data, 'array_sanitize');
		
		$username = $data['username'];
		
		$first = $data['contact-first'];
		$last  = $data['contact-last'];
		$email = $data['contact-email'];
		$phone = $data['phone'];

		// Actual MySQL Query that Updates the information
		mysql_query("UPDATE `OSFL` SET  `contact-first` = '$first', `contact-last` = '$last', `contact-email` = '$email', `phone` = '$phone' WHERE `username` = '$username'");
	}

	/*
		Function that stores the Social Media information in the DB
		- Used in the Social Media Info Page
		@Param - An Associative Array with the information
	*/
	function update_social_info($data)
	{
		// Sanitize all the elements of the array
		array_walk($data, 'array_sanitize');
		
		$username = $data['username'];
		
		$website = $data['website'];
		$youtube = $data['youtube'];
		$facebook = $data['facebook'];
		$google = $data['google'];
		$twitter = $data['twitter'];
		$gps = $data['gps'];

		// Actual MySQL Query that Updates the information
		mysql_query("UPDATE `OSFL` SET  `website` = '$website', `facebook` = '$facebook', `youtube` = '$youtube', `google` = '$google', `twitter` = '$twitter', `gps` = '$gps' WHERE `username` = '$username'");
	}

	/*
		Function that stores the Account information in the DB
		- Used in the User Acount Settings Page
		@Param - An Associative Array with the information
	*/
	function update_user_account($id, $update_user_data)
	{
		// Check if password was NOT submitted
		if(sizeof($update_user_data) == 3)
		{
			// Sanitize all the elements of the array
			array_walk($update_user_data, 'array_sanitize');
			
			$id = (int) $id;
			
			$mail = $update_user_data['email'];
			$first = $update_user_data['first-name'];
			$last = $update_user_data['last-name'];

			// Actual MySQL Query that Updates the information
			mysql_query("UPDATE `Accounts` SET  `email` = '$mail', `first-name` = '$first', `last-name` = '$last' WHERE `id` = $id");			
		}
		else
		{
			// Sanitize all the elements of the array
			array_walk($update_user_data, 'array_sanitize');

			// Hash the password with MD5 and re-assign its value to the array
			$update_user_data['password'] = MD5($update_user_data['password']);
			
			$id = (int) $id;
			
			$pass = $update_user_data['password'];
			$mail = $update_user_data['email'];
			$first = $update_user_data['first-name'];
			$last = $update_user_data['last-name'];

			// Actual MySQL Query that Updates the information
			mysql_query("UPDATE `Accounts` SET  `password` = '$pass', `email` = '$mail', `first-name` = '$first', `last-name` = '$last' WHERE `id` = $id");
		}
	}

	/*
		Function that checks whether the user is active
		- Used in the Login Page
		@Param - A String
		@Return - Boolean (T or F) if active
	*/
	function user_active($username)
	{
		// Sanitize the Username
		$username = sanitize($username);
		// Check how many users are return that match that username
		$query = mysql_query("SELECT COUNT(`id`) FROM `Accounts` WHERE `username` = '$username' AND `active` = 1");

		// If the user is found and active return true
		// If not, return false
		return (mysql_result($query, 0) == 1) ? true : false;
	}

	/* 
		Retrieve all the Data for ONE Campaign 
		- The campaign is clicked from the list presented to the user in the EDIT CAMPAIGNS Page
		@Param - A number
		@Return - An associative Array containing all the Campaign Details
	*/
	function user_campaign_data($id)
	{
		// Create an empty array
		$data = array();
		// Get the information for that NFPO
		$query = "SELECT * FROM `Campaigns` WHERE `id` = $id";
		// Fill the array
		$data = mysql_fetch_assoc(mysql_query($query));
		// Return the details
		return $data;
	}

	/* 
		Retrieve the information for ALL the Campaigns belonging to a user
		- It is used to display a list of Campaigns in the MANAGE CAMPAIGNS (user-campaigns.php) Page
		@Param - A String
		@Return - The result of a Query
	*/
	function user_campaigns_data($username)
	{
		// The query that displays the Campaigns for the user in the DB
		$query = mysql_query("SELECT `id`, `campaign-logo`, `goal`, `donated`, `end`, `info`, `category`, `paypal` from `Campaigns` WHERE `username` = '$username' ORDER BY `end` ASC");

		// Returns all the Campaigns
		return $query;
	}

	/*
		Function that returns the User's Data
		- Used in every page that retrieves information related to the User
		@Param - A number
		@Returns - An Associative Array containing all the information
	*/
	function user_data($user_id)
	{
		$data = array();
		$user_id = (int) $user_id;

		$func_num_args = func_num_args();
		$func_get_args = func_get_args();

		if($func_num_args > 1)
		{
			unset($func_get_args[0]);

			$fields = '`' . implode('`, `', $func_get_args) . '`';

			$query = "SELECT $fields FROM `Accounts` WHERE `id` = '$user_id'";

			$data = mysql_fetch_assoc(mysql_query($query));

			return $data;
		}
	}

	/*
		Function that checks whether the username is already taken
		- Used in the Registration Page
		@Param - A String
		@Return - Boolean (T or F) if exists
	*/
	function user_exists($username)
	{
		// Sanitize the Username
		$username = sanitize($username);
		// Check how many users are return that match that username
		$query = mysql_query("SELECT COUNT(`id`) FROM `Accounts` WHERE `username` = '$username'");

		// If the user is found return true
		// If not, return false
		return (mysql_result($query, 0) == 1) ? true : false;
	}

	/*
		Function that retrieves the user id from the username
		- Used to retrieve information based on the ID instead of the name
		@Param - A String
		@Return - The User ID
	*/
	function user_id_from_username($username)
	{
		// Sanitize the username
		$username = sanitize($username);
		// Query to get the ID number
		$query = mysql_query("SELECT `id` FROM `Accounts` WHERE `username` = '$username'");

		// Return id value
		return mysql_result($query, 0);
	}

?>