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


// Set the Upload Directory
define("UPLOAD_DIR", "../uploads/documents/");

// If a file was sent
if (!empty($_FILES['file'])) 
{
	// Set it was myFile variable
    $myFile = $_FILES['file'];
 	
 	//If the file didn't upload
    if ($myFile["error"] !== UPLOAD_ERR_OK) 
    {
    	// Redirect with error
        header('Location: /donationsdesk/en/user-nfpo-documents.php?e1=1&doc=' . $_POST['doc']);

        // And quit the script
        exit();
    }
 	
    // Check file size
    // Max Allowed for logo 5 MB (size is also in bytes)
    if($myFile['size'] > 5242880) 
    {
        // Redirect with error
        header('Location: /donationsdesk/en/user-nfpo-documents.php?e6=1&doc=' . $_POST['doc']);

        exit();
    }

    // Make sure the extension is ok
    // verify the file is a PDF
	//$mime = "application/pdf; charset=binary";
	// Unix check for the extension
	//exec("file -bi " . $_FILES["file"]["tmp_name"], $out);
	// If the file is not a PDF
	//if ($out[0] != $mime) 
	if($_FILES['file']['type'] != 'application/pdf')
    {
    	// Redirect with error
        header('Location: /donationsdesk/en/user-nfpo-documents.php?e7=1&doc=' . $_POST['doc']);

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
        header('Location: /donationsdesk/en/user-nfpo-documents.php?e4=1&doc=' . $_POST['doc']);

        exit();
    }
 	
    // IF NO ERRORS OCCURRED
    else
    {
        $path = '/donationsdesk/uploads/documents/' . $name;

        echo 'Path is: ' . $path . '<br>User is: ' . $username . '<br>Field is:' . $field . '<br>Doc is:' . $_POST['doc'];

        // Save Path to DB
        $username  = $_POST['user'];
        $field     = $_POST['db-field'];

        // Actual MySQL Query that Updates the information
        mysql_query("UPDATE `OSFL` SET  `$field` = '$path' WHERE `username` = '$username'");

        // Set proper permissions on the new file
        chmod(UPLOAD_DIR . $name, 0644);

        // Redirect to Success Message
        $address = '/donationsdesk/en/user-nfpo-documents.php?success=true&doc=' . $_POST['doc'];
        header('Location: ' . $address);
        exit();
    }
}

?>