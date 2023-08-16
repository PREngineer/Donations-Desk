<!DOCTYPE html>

<!-- Include the HEAD that is in a separate PHP file-->
<!-- The HEAD includes all the documents related to styling of the webpage -->
<?php include 'includes/head.php'; ?>

<body>

<!-- Include the HEADER -->
<!-- The HEADER includes the menu at the top of every page -->
<?php include 'includes/content/header.php';

// Success message
if( isset($_GET['success']) === true && empty($_GET['success']) === true )
{
	echo '
			<font color="green">
			<center>
			<h2>
			Su cuenta ha sido activada exitosamente!<br><br>
			Haga click aquí para hacer <a href="logout.php">Log In.</a>
			</h2>
			</center>
			</font>
		';
} 
// If the e-mail and code exist
else if( isset($_GET['email'], $_GET['email_code']) === true )
{
	// Make sure there are no spaces in the beginning or end
	$email 		= trim($_GET['email']);
	$email_code = trim($_GET['email_code']);

	// If the e-mail is not in the DB
	if(email_exists($email) === false)
	{
		// Create an error for that
		$errors[] = "¡Su e-mail no está registrado!";
	}
	// If the combination is not correct
	else if(activate($email, $email_code) === false)
	{
		// Create an error for that
		$errors[] = "¡Su enlace de activación no es válido!";
	}
	// If there are errors
	if(empty($errors) === false)
	{
		echo '

			<font color="red">
			<center>
			<h2>
			Ups... ¡Ha ocurrido un error!<br>
		';

		// Display the errors
		echo output_errors($errors);

		echo '
			</h2>
			</center>
			</font>
		';
	}
	// If there are no errors, reload to display the Success message.
	else
	{
		header('Location: activate.php?success');
		exit();
	}
}
// If the link doesn't contain the information necessary redirect to Campaigns
else
{
	header('Location: index.php');
	exit();
}

?>

<!-- Include the FOOTER -->
<!-- The FOOTER includes the Copyright at the bottom of every page -->
<?php include 'includes/footer.php'; ?>

<!-- Include the SCRIPTS -->
<!-- The SCRIPTS includes the links to necessary scripts to display the page properly -->
<?php include 'includes/scripts.php'; ?>
</body>
</html>