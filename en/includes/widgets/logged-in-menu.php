<!-- Greeting -->
<h4> Hello, 
<?php 
	// If the user exists, put user's first name
	if(user_exists($user_data['username']))
	{
		echo $user_data['first-name']; 
	}
	// Display Visitor if it doesn't exist
	else
	{
		echo 'Visitor'; 	
	}
?>
!</h4>

<br>

	<?php 
	// If a User is logged in, show the following menu
	if( logged_in() && $user_data['role'] == 0 )
	{
	?>
		<a class="w-nav-link-right" href="user-account-info.php">Account Settings</a><br><br>
		My NFPO:<br>

	<?php
		// If the NFPO already exists, provide all the options
		if( hasNFPO($user_data['username']) === true )
		{
	?>
			<a class="w-nav-link-right" href="user-nfpo-basic.php">Basic Information</a><br>
			<a class="w-nav-link-right" href="user-nfpo-rep.php">Representative Information</a><br>
			<a class="w-nav-link-right" href="user-nfpo-donate.php">Donation Information</a><br>
			<a class="w-nav-link-right" href="user-nfpo-purpose.php">Purpose Information</a><br>
			<a class="w-nav-link-right" href="user-nfpo-social.php">Social Media Information</a><br>
			<a class="w-nav-link-right" href="user-nfpo-documents.php">Official Documentation</a><br><br>
	<?php
		}
		// If the Organization hasn't been created, just provide creation option
		else
		{
	?>
			<a class="w-nav-link-right" href="user-nfpo-basic.php">Create my NFPO</a><br>
	<?php
		}
	?>

		My Campaigns:<br>
		<?php
			// If the NFPO is active
			// Allow creation of Campaigns
			if(NFPO_active($user_data['username']) === true)
			{
				echo '
					<a class="w-nav-link-right" href="user-create-campaign.php">Create a Campaign</a><br>
					<a class="w-nav-link-right" href="user-campaigns.php">Manage Campaigns</a><br><br>
				';
			}
			// If inactive, do not allow , send to activate NFPO
			else
			{
				echo '<font color="red"><a class="w-nav-link-right" href="user-nfpo-activate.php">Activate</a></font><br>';
			}
		?>
		<a class="w-nav-link-right" href="logout.php">Log out</a><br>
		
	<?php
	}

	// If an Admin is logged in, show the following menu
	if( logged_in() && $user_data['role'] == 1 )
	{
	?>
		ACCOUNTS:<br>
		<a class="w-nav-link-right" href="register.php">Create New Account</a><br>
		<a class="w-nav-link-right" href="admin-manage-accounts.php">Manage Accounts</a><br><br>
		
		NFPOs:<br>
		<a class="w-nav-link-right" href="admin-create-nfpo.php">Create a NFPO</a><br>
		<a class="w-nav-link-right" href="admin-manage-nfpo.php?list=1">Manage NFPOs</a><br><br>
		
		CAMPAIGNS:<br>
		<a class="w-nav-link-right" href="admin-create-campaign.php">Create a Campaign</a><br>
		<a class="w-nav-link-right" href="admin-manage-campaign.php?list=1">Manage Campaigns</a><br><br>

		FB Admins:<br>
		<a class="w-nav-link-right" href="fb-admin.php">Manage Admins</a><br><br>

		REPORTS:<br>
		<a class="w-nav-link-right" href="reports.php">View Reports</a><br><br>

		<a class="w-nav-link-right" href="logout.php">Log out</a><br>
	<?php

	}
	?>