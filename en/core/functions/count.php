<?php

	// THIS FILE HOUSES COUNTING RELATED FUNCTIONS

	//********************************* ALL OPERATIONS RELATED TO COUNTING CAMPAIGNS *********************************//

	/* 
		Gets the amount of active Campaigns
		- Used to display the amount of Campaigns in the active-count widget at the top-right corner of all pages.
		@Return - The number of Campaigns
	*/
	function campaign_count()
	{
		// The query that counts how many active Campaigns we have in our DB
		$query = mysql_query("SELECT COUNT(`id`) from `Campaigns` WHERE `end` > CURRENT_DATE");

		// Returns the number (row #0 since it will only be one result in the query)
		return mysql_result($query, 0);
	}

	/* 
		Gets the amount of active Campaigns that match a category
		- Used to display the Campaigns that belong to a Category in INDEX
		@Param - A String
		@Return - The number of Campaigns
	*/
	function campaign_count_by_category($category)
	{
		// The query that displays the Campaigns in the DB
		$query = mysql_query("SELECT COUNT(`id`) from `Campaigns` WHERE `category` = '$category' AND `end` > CURRENT_DATE");

		// Returns all the NFPOs
		return mysql_result($query, 0);
	}

	/* 
		Gets the amount of active Campaigns whose info match the search string
		- Used to display the Campaigns whose info matches the search in INDEX
		@Param - A String
		@Return - The number of Campaigns
	*/
	function campaign_count_search($string)
	{
		// Get the information from DB
		$query = mysql_query("SELECT COUNT(`id`) FROM `Campaigns` WHERE `info` LIKE '%" . $string . "%' AND `end` > CURRENT_DATE");

		return mysql_result($query, 0);
	}

	/* 
		Gets the amount of active Campaigns that belong to a specific user
		- Used to display the Campaigns that belong to a User in the Manage Campaigns Page
		@Param - A String
		@Return - The number of Campaigns
	*/
	function user_campaign_count($username)
	{
		// The query that counts how many active users we have in our DB
		$query = mysql_query("SELECT COUNT(`id`) from `Campaigns` WHERE `end` > CURRENT_DATE AND `username` = '$username'");

		// Returns the number (row #0 since it will only be one result in the query)
		return mysql_result($query, 0);
	}

	//********************************* ALL OPERATIONS RELATED TO COUNTING NFPOs *********************************//

	/* 
		Gets the amount of active NFPOs
		- Used to display the amount of NFPOs in the active-count widget at the top-right corner of all pages.
		@Return - The number of NFPOs
	*/
	function nfpo_count()
	{
		// The query that counts how many OSFL we have in our DB
		$query = mysql_query("SELECT COUNT(`id`) from `OSFL` WHERE `active` = 1");

		// Returns the number (row #0 since it will only be one result in the query)
		return mysql_result($query, 0);
	}

	/* 
		Gets the amount of NFPOs that match the search criteria (name)
		- Used to display the amount of NFPOs in the that match a specific name
		@Param - A String
		@Return - The number of NFPOs
	*/
	function nfpo_search_count($search)
	{
		// Search the DB for that entry
		$query = mysql_query("SELECT count(`id`) FROM `OSFL` WHERE `organization-name` LIKE '%" . $search . "%' AND `active` = 1");
		// Return results
		return mysql_result($query, 0);
	}


	//********************************* ALL OPERATIONS RELATED TO COUNTING FOR ADMINS *********************************//
	

	/* 
		Gets the amount of accounts registered
		- Used to display the accounts in the Manage Accounts Page
		@Return - The number of Accounts
	*/
	function accounts_count()
	{
		// The query that counts how many Accounts we have in our DB
		$query = mysql_query("SELECT COUNT(`id`) from `Accounts`");

		// Returns the number (row #0 since it will only be one result in the query)
		return mysql_result($query, 0);
	}

	/* 
		Gets the amount of ACCOUNTS that match the search criteria (username)
		- Used to display the amount of Accounts in the DB that match a specific name
		@Param - A String
		@Return - The number of Accounts
	*/
	function account_search_count($search)
	{
		// Search the DB for that entry
		$query = mysql_query("SELECT count(`id`) FROM `Accounts` WHERE `username` LIKE '%" . $search . "%'");
		// Return results
		return mysql_result($query, 0);
	}

	/* 
		Gets the amount of campaigns registered
		- Used to display the campaigns in the Manage Campaigns Page
		@Return - The number of NFPOs
	*/
	function admin_campaign_count()
	{
		// The query that counts how many OSFL we have in our DB
		$query = mysql_query("SELECT COUNT(`id`) from `Campaigns`");

		// Returns the number (row #0 since it will only be one result in the query)
		return mysql_result($query, 0);
	}

	/* 
		Gets the amount of Campaigns that match the filter criteria (category)
		- Used to display the amount of Campaigns in the DB that match a specific category
		@Param - A String
		@Return - The number of NFPOs
	*/
	function admin_campaign_filter_count($search)
	{
		// Search the DB for that entry
		$query = mysql_query("SELECT count(`id`) FROM `Campaigns` WHERE `category` LIKE '%" . $search . "%'");
		// Return results
		return mysql_result($query, 0);
	}

	/* 
		Gets the amount of Campaigns that match the search criteria (name)
		- Used to display the amount of Campaigns in the DB that match a specific info
		@Param - A String
		@Return - The number of NFPOs
	*/
	function admin_campaign_search_count($search)
	{
		// Search the DB for that entry
		$query = mysql_query("SELECT count(`id`) FROM `Campaigns` WHERE `info` LIKE '%" . $search . "%'");
		// Return results
		return mysql_result($query, 0);
	}

	/* 
		Gets the amount of nfpos registered
		- Used to display the nfpos in the Manage NFPOs Page
		@Return - The number of NFPOs
	*/
	function admin_nfpo_count()
	{
		// The query that counts how many OSFL we have in our DB
		$query = mysql_query("SELECT COUNT(`id`) from `OSFL`");

		// Returns the number (row #0 since it will only be one result in the query)
		return mysql_result($query, 0);
	}

	/* 
		Gets the amount of NFPOs that match the search criteria (name)
		- Used to display the amount of NFPOs in the DB that match a specific name
		@Param - A String
		@Return - The number of NFPOs
	*/
	function admin_nfpo_search_count($search)
	{
		// Search the DB for that entry
		$query = mysql_query("SELECT count(`id`) FROM `OSFL` WHERE `organization-name` LIKE '%" . $search . "%'");
		// Return results
		return mysql_result($query, 0);
	}

?>