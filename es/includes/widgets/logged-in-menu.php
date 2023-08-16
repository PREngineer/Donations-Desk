<!-- Greeting -->
<h4> ¡Hola, 
<?php 
	// If the user exists, put user's first name
	if(user_exists($user_data['username']))
	{
		echo $user_data['first-name']; 
	}
	// Display Visitor if it doesn't exist
	else
	{
		echo 'Visitante'; 	
	}
?>
!</h4>

<br>

	<?php 
	// If a User is logged in, show the following menu
	if( logged_in() && $user_data['role'] == 0 )
	{
	?>
		<a class="w-nav-link-right" href="user-account-info.php">Configuración de Cuenta</a><br><br>
		Mi OSFL:<br>

	<?php
		// If the NFPO already exists, provide all the options
		if( hasNFPO($user_data['username']) === true )
		{
	?>
			<a class="w-nav-link-right" href="user-nfpo-basic.php">Información Básica</a><br>
			<a class="w-nav-link-right" href="user-nfpo-rep.php">Información de Representante</a><br>
			<a class="w-nav-link-right" href="user-nfpo-donate.php">Información de Donación</a><br>
			<a class="w-nav-link-right" href="user-nfpo-purpose.php">Información de Propósito</a><br>
			<a class="w-nav-link-right" href="user-nfpo-social.php">Información de Redes Sociales</a><br>
			<a class="w-nav-link-right" href="user-nfpo-documents.php">Documentos Oficiales</a><br><br>
	<?php
		}
		// If the Organization hasn't been created, just provide creation option
		else
		{
	?>
			<a class="w-nav-link-right" href="user-nfpo-basic.php">Crear my OSFL</a><br>
	<?php
		}
	?>

		Mis Campañas:<br>
		<?php
			// If the NFPO is active
			// Allow creation of Campaigns
			if(NFPO_active($user_data['username']) === true)
			{
				echo '
					<a class="w-nav-link-right" href="user-create-campaign.php">Crear una Campaña</a><br>
					<a class="w-nav-link-right" href="user-campaigns.php">Manejar mis Campañas</a><br><br>
				';
			}
			// If inactive, do not allow , send to activate NFPO
			else
			{
				echo '<font color="red"><a class="w-nav-link-right" href="user-nfpo-activate.php">Activar</a></font><br>';
			}
		?>
		<a class="w-nav-link-right" href="logout.php">Log out</a><br>
		
	<?php
	}

	// If an Admin is logged in, show the following menu
	if( logged_in() && $user_data['role'] == 1 )
	{
	?>
		CUENTAS:<br>
		<a class="w-nav-link-right" href="register.php">Crear nueva cuenta</a><br>
		<a class="w-nav-link-right" href="admin-manage-accounts.php">Manejar cuentas</a><br><br>
		
		OSFLs:<br>
		<a class="w-nav-link-right" href="admin-create-nfpo.php">Crear una OSFL</a><br>
		<a class="w-nav-link-right" href="admin-manage-nfpo.php?list=1">Manejar OSFLs</a><br><br>
		
		CAMPAÑAS:<br>
		<a class="w-nav-link-right" href="admin-create-campaign.php">Crear una Campaña</a><br>
		<a class="w-nav-link-right" href="admin-manage-campaign.php?list=1">Manejar Campañas</a><br><br>

		ADMINS DE FB:<br>
		<a class="w-nav-link-right" href="fb-admin.php">Manejar Admins</a><br><br>

		REPORTES:<br>
		<a class="w-nav-link-right" href="reports.php">Ver Reportes</a><br><br>

		<a class="w-nav-link-right" href="logout.php">Log out</a><br>
	<?php

	}
	?>