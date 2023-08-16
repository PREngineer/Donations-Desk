<?php

// ESTABLISH DB CONNECTION

//Error message
$error_message = 'Sorry, DB connection error.  Please refresh the page.';

//MySQL Connection Parameters
// HOSTNAME, USERNAME, PASSWORD
// if there's a connection problem, it wil show the error message
mysql_connect('localhost', 'asesore3_ddesk', 'JMPS#AfC14') or die($error_message);

//Name of the Database to connect to
mysql_select_db('asesore3_donationsdesk');

// Set the Charset
mysql_query("SET NAMES 'utf8'");

// Establish which fields are required
$required_fields = array('info', 'goal', 'end', 'category', 'paypal');

//If a required field was not provided
// Check all the values provided in the post
foreach($_POST as $key=>$value)
{
  // If any of the required fields are not provided
  if( (empty($value) && in_array($key, $required_fields) === true) || count($_POST['category']) < 1 )
  {
    // Redirect with error
    header('Location: ../en/user-create-campaign.php?e4=1');

    // And quit the script
    exit();
  }
}

// Check the Date Format
// Get every part of the date
list($y,$m,$d) = explode('-', $_POST['end']);

// Check the date is filled properly
if(checkdate($m, $d, $y) == false)
{
    echo '<br>Month: ' .$m . ' Day: ' . $d . ' Year: ' . $y;
    
    // Redirect with error
    header('Location: ../en/user-create-campaign.php?e5=1');

    // And quit the script
    exit();
}

// Check if the e-mail has the right form
if(filter_var($_POST['paypal'], FILTER_VALIDATE_EMAIL) === false)
{
    // Redirect with error
    header('Location: ../en/user-create-campaign.php?e6=1');

    // And quit the script
    exit();
}

// Set the Upload Directory
// Go back one folder from EN, then go into uploads/logos
define("UPLOAD_DIR", "../uploads/campaign-logos/");

// If no file was sent just register the information
if($_FILES['file']['error'] == 4)
{
    // Save Path to DB
        $username   = $_POST['user'];

        $info       = $_POST['info'];
        $end        = $_POST['end'];
        $goal       = $_POST['goal'];
        $category   = implode(',', $_POST['category']);
        $paypal     = $_POST['paypal'];

        // Actual MySQL Query that Updates the information
        mysql_query("INSERT into `Campaigns` (`username`, `info`, `end`, `goal`, `category`, `paypal`) VALUES ('$username', '$info', '$end', '$goal', '$category', '$paypal')");

        // Redirect to Success Message
        $address = '../en/user-create-campaign.php?success=true';
        header('Location: ' . $address);
        exit();
}

// If a file was sent
else 
{
	// Set it as myFile variable
    $myFile = $_FILES['file'];
 	
 	//If the file didn't upload
    if ($myFile["error"] !== UPLOAD_ERR_OK) 
    {
    	// Redirect with error
        header('Location: ../en/user-create-campaign.php?e1=1&goal=' . $_POST['goal'] . '&info=' . $_POST['info'] . '&end=' . $_POST['end'] . '&category=' . $_POST['category'] . '&paypal=' . $_POST['paypal']);

        // And quit the script
        exit();
    }
 	
    // Check file size
    // Max Allowed for logo 1 MB (size is also in bytes)
    if($myFile['size'] > 1048576) 
    {
        // Redirect with error
        header('Location: ../en/user-create-campaign.php?e1=1&goal=' . $_POST['goal'] . '&info=' . $_POST['info'] . '&end=' . $_POST['end'] . '&category=' . $_POST['category'] . '&paypal=' . $_POST['paypal']);

        exit();
    }

    // Make sure the extension is ok
    // verify the file is a GIF, JPEG, or PNG
	$fileType = exif_imagetype($_FILES["file"]["tmp_name"]);
	// Only gif, jpg, png and bmp are allowed
	$allowed = array(IMAGETYPE_GIF, IMAGETYPE_JPEG, IMAGETYPE_PNG, IMAGETYPE_BMP);
	// If the file is not one of those types
	if (!in_array($fileType, $allowed)) 
	{
    	// Redirect with error
        header('Location: ../en/user-create-campaign.php?e2=1&goal=' . $_POST['goal'] . '&info=' . $_POST['info'] . '&end=' . $_POST['end'] . '&category=' . $_POST['category'] . '&paypal=' . $_POST['paypal']);

    	exit();
    }

    // Make sure the filename is Safe
    // Substitute any characters that are not Uppercase or Lowercase letters or numbers with '_'
    $name = preg_replace("/[^A-Z0-9._-]/i", "_", $myFile["name"]);
 
    // Make sure I don't overwrite an existing file
    // If a file with that name exists, it will append a '-' followed by a number
    $i = 0;
    $parts = pathinfo($name);

    // While there exists a file with that name
    while (file_exists(UPLOAD_DIR . $name)) 
    {
    	// Increase the number appended and check again
        $i++;
        $name = $parts["filename"] . "-" . $i . "." . $parts["extension"];
    }
 
    // Move file from temporary directory to the actual directory with the chosen name
    $success = move_uploaded_file($myFile["tmp_name"], UPLOAD_DIR . $name);

    // If an error occurred, display a message.
    if ($success == false) 
    { 
        // Redirect with error
        header('Location: ../en/user-create-campaign.php?e3=1&goal=' . $_POST['goal'] . '&info=' . $_POST['info'] . '&end=' . $_POST['end'] . '&category=' . $_POST['category'] . '&paypal=' . $_POST['paypal']);

        exit();
    }

 	// IF NO ERRORS OCCURRED
    else
    {
        
        $path = '/donationsdesk/uploads/campaign-logos/' . $name;

        // Save Path to DB
        $username   = $_POST['user'];

        $info       = $_POST['info'];
        $end        = $_POST['end'];
        $goal       = $_POST['goal'];
        $category   = implode(',', $_POST['category']);
        $paypal     = $_POST['paypal'];

        // Actual MySQL Query that Updates the information
        mysql_query("INSERT into `Campaigns` (`username`, `info`, `end`, `goal`, `category`, `campaign-logo`, `paypal`) VALUES ('$username', '$info', '$end', '$goal', '$category', '$path', '$paypal')");

        // Set proper permissions on the new file
        chmod(UPLOAD_DIR . $name, 0644);

        // Redirect to Success Message
        $address = '../en/user-create-campaign.php?success=true';
        header('Location: ' . $address);
        exit();
    }

}

?>