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
// Go back one folder from EN, then go into uploads/pictures
define("UPLOAD_DIR", "../uploads/pictures/");

// If a file was sent
if (!empty($_FILES['file'])) 
{
    // Set it as myFile variable
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
    // Max Allowed for logo 2 MB (size is also in bytes)
    if($myFile['size'] > 2097152) 
    {
        // Redirect with error
        header('Location: /donationsdesk/en/user-nfpo-documents.php?e5=1&doc=' . $_POST['doc']);

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
        header('Location: /donationsdesk/en/user-nfpo-documents.php?e3=1&doc=' . $_POST['doc']);

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
        $address = '/donationsdesk/en/user-nfpo-documents.php?e4=1&doc=' . $_POST['doc'];
        // Redirect with error
        header('Location: ' . $address);

        exit();
    }

    else
    {
        // IF NO ERRORS OCCURRED

        $path = '/donationsdesk/uploads/pictures/' . $name;

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