<?php
	
	// THIS FILE HOUSES DISPLAY RELATED FUNCTIONS

	//********************************* ALL OPERATIONS RELATED TO DISPLAYING CAMPAIGNS IN THE INDEX *********************************//
	
	/* 
		Gets all the information for ALL CAMPAIGNS
		- Used to display them in the INDEX Page when no filtering is done
		@Return - A query's output
	*/
	function campaign_display_all()
	{
		// The query that displays the Campaigns in the DB
		$query = mysql_query("SELECT `id`, `campaign-logo`,  `username`, `goal`, `donated`, `end`, `info`, `category`, `paypal` 
			from `Campaigns` 
			WHERE `end` > CURRENT_DATE 
			ORDER BY `end` ASC");

		// Returns all the NFPOs
		return $query;
	}

	/* 
		Gets all the information for ALL CAMPAIGNS that belong to a specific category
		- Used to display them in the INDEX Page when a filter by Category is applied
		@Param - A String
		@Return - A query's output
	*/
	function campaign_display_by_category($category)
	{
		// The query that displays the Campaigns in the DB
		$query = mysql_query("SELECT `id`, `campaign-logo`, `username`, `goal`, `donated`, `end`, `info`, `category`, `paypal` 
			from `Campaigns` 
			WHERE `category` = '$category' 
			AND `end` > CURRENT_DATE 
			ORDER BY `end` ASC");

		// Returns all the NFPOs
		return $query;
	}

	/* 
		Gets the information for all Campaigns search that match the search info criteria
		- Used in the Index Page when search is used
		@Param - A String
		@Return - A query's output
	*/

	function campaign_search($string)
	{
		// Create an empty array
		$data = array();
		// Get the information from DB
		$query = "SELECT `id`, `campaign-logo`,  `username`, `goal`, `donated`, `end`, `info`, `category`, `paypal` 
		FROM `Campaigns` 
		WHERE `info` LIKE '%" . $string . "%' 
		AND `end` > CURRENT_DATE 
		ORDER BY `end` ASC";
		// Fill the array
		$data = mysql_query($query);
		// Return it
		return $data;
	}

	//********************************* ALL OPERATIONS RELATED TO DISPLAYING NFPOs IN THE NFPO Page *********************************//

	/* 
		Gets all the information for the NFPO that was clicked (in the list)
		- Used to display a specific Organization's Profile
		@Param - An int
		@Return - An Array containing all the information from the resulting SQL row, elements identified by Field Name instead of Index
	*/
	function nfpo_details($id)
	{
		// Create an empty array
		$data = array();
		// Get the information for that NFPO
		$query = "SELECT * FROM `OSFL` WHERE `id` = $id";
		// Fill the array
		$data = mysql_fetch_assoc(mysql_query($query));
		// Return the details
		return $data;
	}

	/* 
		Gets all the information for ALL NFPOs
		- Used to display ALL NFPOs in the NFPO Page
		@Param - A String
		@Return - A query's output
	*/
	function nfpo_display_all($sortby)
	{
		// The query that displays the NFPOs in the DB
		$query = mysql_query("SELECT `id`, `organization-name`, `logo`, `municipality`, `category`, `inc-date`, `target`, `impact`, 
			`foundations`, `rating` 
			from `OSFL` 
			WHERE `active` = 1 
			ORDER BY `$sortby` ASC, `organization-name` ASC");

		// Returns all the NFPOs
		return $query;
	}

	/* 
		Gets all the information for all the NFPOs whose name contain the entered filter text
		- Used to filter Organizations by name in the NFPO Page
		@Param - A String
		@Return - A query's output
	*/
	function nfpo_search($string)
	{
		// Create an empty array
		$data = array();
		// Get the information from DB
		$query = "SELECT `id`, `organization-name`, `logo`, `municipality`, `category`, `inc-date`, `target`, `impact`, `foundations`, `rating` 
		FROM `OSFL` 
		WHERE `organization-name` LIKE '%" . $string . "%' 
		AND `active` = 1";
		// Fill the array
		$data = mysql_query($query);
		// Return it
		return $data;
	}

?>