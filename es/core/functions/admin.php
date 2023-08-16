<?php

	// THIS FILE HOUSES ADMINISTRATOR FUNCTIONS

	/* 
		Gets all the information for all the Accounts whose username contain the entered filter text
		- Used to filter Accounts by username in the Manage Accounts Page
		@Param - A String
		@Return - A query's output
	*/
	function account_search($string)
	{
		// Create an empty array
		$data = array();
		// Get the information from DB
		$query = "SELECT * FROM `Accounts` WHERE `username` LIKE '%" . $string . "%'";
		// Fill the array
		$data = mysql_query($query);
		// Return it
		return $data;
	}

	/* 
		Gets all the information for all the Campaigns whose category contain the entered filter text
		- Used to filter Campaigns by category in the Manage Campaigns Page
		@Param - A String
		@Return - A query's output
	*/
	function admin_campaign_filter($string)
	{
		// Create an empty array
		$data = array();
		// Get the information from DB
		$query = "SELECT * FROM `Campaigns` WHERE `category` LIKE '%" . $string . "%'";
		// Fill the array
		$data = mysql_query($query);
		// Return it
		return $data;
	}

	/* 
		Gets all the information for all the Campaigns whose info contain the entered filter text
		- Used to filter Campaigns by info in the Manage Campaigns Page
		@Param - A String
		@Return - A query's output
	*/
	function admin_campaign_search($string)
	{
		// Create an empty array
		$data = array();
		// Get the information from DB
		$query = "SELECT * FROM `Campaigns` WHERE `info` LIKE '%" . $string . "%'";
		// Fill the array
		$data = mysql_query($query);
		// Return it
		return $data;
	}

	/* 
		Gets all the information for ALL Campaigns
		- Used to display ALL Campaigns in the Manage Campaigns Page
		@Param - A String
		@Return - A query's output
	*/
	function admin_display_all_campaigns()
	{
		// The query that displays the NFPOs in the DB
		$query = mysql_query("SELECT * from `Campaigns` ORDER BY `end` ASC");

		// Returns all the NFPOs
		return $query;
	}

	/* 
		Gets all the information for ALL NFPOs
		- Used to display ALL NFPOs in the Manage NFPO Page
		@Param - A String
		@Return - A query's output
	*/
	function admin_display_all_nfpo($sortby)
	{
		// The query that displays the NFPOs in the DB
		$query = mysql_query("SELECT * from `OSFL` ORDER BY `$sortby` ASC, `organization-name` ASC");

		// Returns all the NFPOs
		return $query;
	}

	/*
		Function used to retrieve the NFPO data
		- Used in the Manage NFPO Page
		@Param - A String
		@Return - An Array that contains all the information, no index, organized by DB field name
	*/
	function admin_nfpo_data($id)
	{
		$data = array();
		
		$func_num_args = func_num_args();
		$func_get_args = func_get_args();

		if($func_num_args > 1)
		{
			unset($func_get_args[0]);

			$fields = '`' . implode('`, `', $func_get_args) . '`';

			$query = "SELECT $fields FROM `OSFL` WHERE `id` = '$id'";

			$data = mysql_fetch_assoc(mysql_query($query));

			return $data;
		}
	}

	/* 
		Gets all the information for all the NFPOs whose name contain the entered filter text
		- Used to filter NFPOs by name in the Manage NFPOs Page
		@Param - A String
		@Return - A query's output
	*/
	function admin_nfpo_search($string)
	{
		// Create an empty array
		$data = array();
		// Get the information from DB
		$query = "SELECT * FROM `OSFL` WHERE `organization-name` LIKE '%" . $string . "%'";
		// Fill the array
		$data = mysql_query($query);
		// Return it
		return $data;
	}

	/* 
		Gets all the information for ALL ACCOUNTS
		- Used to display ALL Accounts in the Manage Accounts Page
		@Param - A String
		@Return - A query's output
	*/
	function display_all_accounts($sortby)
	{
		// The query that displays the NFPOs in the DB
		$query = mysql_query("SELECT * FROM `Accounts` ORDER BY `$sortby` ASC, `username` ASC");

		// Returns all the NFPOs
		return $query;
	}

	/*
		Function that retrieves the current Account information from the DB
		- Used in the Admin Manage Accounts Page
		@Param - An Associative Array with the information
	*/
	function fetch_current_data($id)
	{
		return mysql_fetch_assoc( mysql_query("SELECT * FROM `Accounts` WHERE `id` = '$id'") );
	}

	/*
		Function that stores the Account information in the DB
		- Used in the Admin Manage Accounts Page
		@Param - An Associative Array with the information
	*/
	function update_account($id, $update_user_data)
	{
		// Sanitize all the elements of the array
		array_walk($update_user_data, 'array_sanitize');

		if(sizeof($update_user_data) == 6)
		{
			$id = (int) $id;
			
			$username = $update_user_data['username'];
			$mail = $update_user_data['email'];
			$first = $update_user_data['first-name'];
			$last = $update_user_data['last-name'];
			$role = $update_user_data['role'];
			$active = $update_user_data['active'];

			// Actual MySQL Query that Updates the information
			mysql_query("UPDATE `Accounts` SET  `username` = '$username', `email` = '$mail', `first-name` = '$first', `last-name` = '$last', 
				`role` = '$role', `active` = '$active' WHERE `id` = $id");
		}
		else
		{
			// Hash the password with MD5 and re-assign its value to the array
			$update_user_data['password'] = MD5($update_user_data['password']);
			
			$id = (int) $id;
			
			$username = $update_user_data['username'];
			$pass = $update_user_data['password'];
			$mail = $update_user_data['email'];
			$first = $update_user_data['first-name'];
			$last = $update_user_data['last-name'];
			$role = $update_user_data['role'];
			$active = $update_user_data['active'];

			// Actual MySQL Query that Updates the information
			mysql_query("UPDATE `Accounts` SET  `username` = '$username', `password` = '$pass', `email` = '$mail', `first-name` = '$first', 
				`last-name` = '$last', `role` = '$role', `active` = '$active' WHERE `id` = $id");
		}
	}

	/*
		Function that stores the Basic NFPO information in the DB
		- Used in the Basic NFPO Info Page (Admin)
		@Param - An Associative Array with the information
	*/
	function update_NFPO_basic_admin($data)
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
		$active			= $data['active'];

		// Actual MySQL Query that Updates the information
		mysql_query("UPDATE `OSFL` SET `organization-name` = '$name', `physical-address` = '$physical', `postal-address` = '$postal', 
			`municipality` = '$municipality', `zip` = '$zip', `inc-date` = '$inc', `foundations` = '$foundations', 
			`category` = '$category', `active` = '$active', `essn` = '$essn' WHERE `username` = '$username'");
	}
	

?>