<?php

/**
 * This file checks if the user has a session and protects pages from 
 * unauthorized use.
 */

require_once 'init.php';

/**
 * This file will load the appropriate class depending on the request type.
 */

require_once 'autoloader.php';

// Grab the page in URL
//$parts = explode("/", $_SERVER["REQUEST_URI"]);
//print_r($parts);

// Show message if system has not been setup
if( !file_exists ('settings.php') && !file_exists ('/config/settings.php') ){
    echo '
    <h1>The \'settings.php\' file has not been found.</h1>
    <p>This means that the system is not yet configured.  Please follow these instructions to connect the application to the database and to the SMTP server:</p>
    <p>If running within a container, create the settings.php file in the /config directory.</p>
    <p>If running any other way, please create the settings.php file in the root of the web server\'s application directory.</p>

    <p>The settings.php file should look like this:</p>
    <pre>
      /*------------------------------------------------------------------------
         Database connection information
        ------------------------------------------------------------------------

        ------------------------------------------------------------------------
         DBUSER:          Specify the database user name
        ------------------------------------------------------------------------
         DBPASS:          Specify the database password
        ------------------------------------------------------------------------
         DBNAME:          Specify the name of the database
        ------------------------------------------------------------------------
         DBHOST:          Specify the database host URL or IP
        ------------------------------------------------------------------------
           FQDN:          db.domain.com
           IP:            10.0.0.10
        ------------------------------------------------------------------------
         DBPORT:          Specify the database port
        ------------------------------------------------------------------------
           MySQL:         3306
           SQLite:        N/A
        ------------------------------------------------------------------------
         DBTYPE:          Specify which type of database to use
        ------------------------------------------------------------------------
           Options:       MySQL | SQLite
        ------------------------------------------------------------------------*/

      $DBUSER = "username";
      $DBPASS = "password";
      $DBNAME = "name";
      $DBHOST = "10.0.0.10";
      $DBPORT = "3306";
      $DBTYPE = "MySQL";

      /*------------------------------------------------------------------------
         Mail (SMTP) connection settings and credentials
        ------------------------------------------------------------------------

        ------------------------------------------------------------------------
         SMTP Hosts:     Specify the SMTP servers to use to send the e-mails.
                         The first one is the default, additionals are backups.
        ------------------------------------------------------------------------
           Single:       smtp.gmail.com
           Multiple:     smtp.gmail.com;mail.mydomain.com
        ------------------------------------------------------------------------
         Authentication: Use a user/pass to authenticate to the SMTP Server?
        ------------------------------------------------------------------------
                         [True / False]
        ------------------------------------------------------------------------
         Encryption:     If using encryption or not
        ------------------------------------------------------------------------
                         [0 = none, 1 = tls, 2 = ssl]
        ------------------------------------------------------------------------
         Port:           Specify the SMTP port to use
        ------------------------------------------------------------------------
                         [25 = standard, 587 = tls, 465 = ssl]
        ------------------------------------------------------------------------
         From E-mail:    Specify the reply-to e-mail.
        ------------------------------------------------------------------------
                         event.manager@mycompany.com
        ------------------------------------------------------------------------
         From Name:      Specify the reply to name.
        ------------------------------------------------------------------------
                         Event Manager
        ------------------------------------------------------------------------*/

      $SMTPHOSTS          = "smtp.domain.com";
      $SMTPAUTHENTICATION = true;
      $SMTPUSER           = "username";
      $SMTPPASS           = "password";
      $SMTPPORT           = 25;
      $SMTPENC            = 0;
      $SMTPFROMEMAIL      = "donations.desk@mydomain.com";
      $SMTPFROMNAME       = "Donations Desk";

      /*------------------------------------------------------------------------
         Admin E-mail:   The e-mail that will receive system notifications.
        ------------------------------------------------------------------------*/
      $ADMINEMAIL = "user@domain.com";
    </pre>
    ';

    exit;
}

/****************
    Top Pages
****************/

// Handle Campaigns
if( !isset( $_GET['display'] ) || $_GET['display'] === 'Campaigns' )
{
    $page = new Campaigns();
    $page->Display();
}
// Handle Organizations
else if( isset( $_GET['display'] ) && $_GET['display'] === 'NFPOs' )
{
    $page = new NFPOs();
    $page->Display();
}
// Handle Resources
else if( isset( $_GET['display'] ) && $_GET['display'] === 'Resources' )
{
    $page = new Resources();
    $page->Display();
}
// Handle Login
else if( isset( $_GET['display'] ) && $_GET['display'] === 'Login' )
{
    $page = new Login();
    $page->Display();
}
// Handle Logout
else if( isset( $_GET['display'] ) && $_GET['display'] === 'LogOut' )
{
  unset( $_SESSION );
  session_destroy();

  echo '
    <script>
      window.location = "index.php";
    </script>
  ';
}

/****************
    Admin Pages
****************/



/****************
    Public Pages
****************/

// Handle About Us
else if( isset( $_GET['display'] ) && $_GET['display'] === 'AboutUs' )
{
    $page = new AboutUs();
    $page->Display();
}
// Handle Contact Us
else if( isset( $_GET['display'] ) && $_GET['display'] === 'ContactUs' )
{
    $page = new ContactUs();
    $page->Display();
}
// Handle F.A.Q.
else if( isset( $_GET['display'] ) && $_GET['display'] === 'FAQs' )
{
    $page = new FAQs();
    $page->Display();
}
// Handle Help
else if( isset( $_GET['display'] ) && $_GET['display'] === 'Help' )
{
    $page = new Help();
    $page->Display();
}
// Handle Forgot Password
else if( isset( $_GET['display'] ) && $_GET['display'] === 'ForgotPassword' )
{
    $page = new ForgotPassword();
    $page->Display();
}
// Handle NFPO Details
else if( isset( $_GET['display'] ) && $_GET['display'] === 'NFPODetails' )
{
    $page = new NFPODetails();
    $page->Display();
}
// Handle Register
else if( isset( $_GET['display'] ) && $_GET['display'] === 'Register' )
{
    $page = new Register();
    $page->Display();
}
// Non-Existing Page Objects
else{
    $page = new Page();
    $page->Display();
}

?>
