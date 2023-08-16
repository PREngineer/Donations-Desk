<?php

// Set up DB connection
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

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN">
<html>

<head>

  <!-- DEVELOPER INFORMATION 
  
  Website Design & Implementation by Jorge Pabon from WebJMPS (Joined Multi-Portability Solutions)
  Contact Us at: webjmps@outlook.com or pianistapr@hotmail.com

  -->

  <!-- Site METADATA -->

  <meta http-equiv="Content-type" content="text/html; charset=utf-8"/>
  <meta name="description" content="This website helps participating Non-For Profit Organizations to get funding.">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="generator" content="Webflow">

  <!-- Site CSS Stylesheets -->

  <link rel="stylesheet" type="text/css" href="../css/normalize.css">
  <link rel="stylesheet" type="text/css" href="../css/webflow.css">
  <link rel="stylesheet" type="text/css" href="../css/donations-desk.webflow.css">

  <!-- Site Scripts used -->

  <script type-"text/javascript" src="../js/webfont.js"></script>
  <script>
    WebFont.load({
      google: {
        families: ["Great Vibes:400","Droid Sans:400,700"]
      }
    });
  </script>
  <script type="text/javascript" src="../js/modernizr.js"></script>

  <!-- Site FAV Icon (if any)

  <link rel="shortcut icon" type="image/x-icon" href="https://daks2k3a4ib2z.cloudfront.net/placeholder/favicon.ico">

  -->

</head>

<body>

<header class="header-section">
  <div class="w-container">
    <div class="w-row">
      
      <div class="w-col w-col-3">
         <img class="header-logo" src="/donationsdesk/images/Donations Desk Logo.png" alt="Donations Desk Logo" width="200">
      </div>

      <div class="w-col w-col-9">
        <div class="w-nav" data-collapse="medium" data-animation="default" data-duration="400" data-contain="1">
          <div class="w-container menu-bar">
              <a class="w-nav-brand" href="#"></a>
              <nav class="w-nav-menu" role="../navigation">
                <a class="w-nav-link" href="../index.php">Campaigns</a>
                <a class="w-nav-link" href="../non-for-profit-organizations.php">Non-For Profit Organizations</a>
                <a class="w-nav-link" href="../resources.php">Resources</a>
                <?php 
                if($user_data['active'] == 1)
                {
                  echo '<a class="w-nav-link" href="../myaccount.php">My Account</a>';
                }
                else
                {
                  echo '<a class="w-nav-link" href="../login.php">Login</a>';
                }
                ?>
              </nav>
              <!-- LOW RESOLUTION MENU BUTTON -->
              <div class="w-nav-button">
                 <div class="w-icon-nav-menu">
                 </div>
              </div>
          </div>
        </div>
      </div>

    </div>

      <!-- COLOR BARS AT THE BOTTOM OF THE HEADER -->
      <!-- wraps each bar -->
    <div id="bar-wrapper"> 
         <!-- bars from left to right -->
         <div id="orange-bar"><br/></div>
         <div id="green-bar"><br/></div>
         <div id="gray-bar"><br/></div>
         <div id="orange-bar"><br/></div>
    </div>
    <!-- END OF COLOR BARS AT THE BOTTOM OF THE HEADER -->

  </div>
</header>




<!-- Title Section -->
<section>
<div>
  <!-- Is inside a container -->
  <div class="w-container">
    <!-- With 1 row and 3 columns -->
    <div class="w-row title-section">

      <!-- Column #1 (1/3 page width) -->
      <div class="w-col w-col-3">
        
      </div>
      
      <!-- Column #2 (1/3 of page width) -->
      <div class="w-col w-col-6">
        <h1>PayPal Transaction</h1>
      </div>

      <!-- Column #3 (1/3 of page width) -->
      <div class="w-col w-col-3 block">
        <!-- Language Selector -->
        <?php include 'includes/widgets/language.php';?>
        <!-- Site Stats -->
        <?php include 'includes/widgets/active-count.php';?>
      </div>

    </div>

  </div>
  
</div>
</section>
<!-- Title Section -->


<!-- Actual Content -->
<section class="content-section">
  <!-- Is inside a container -->
  <div class="w-container">
    <!-- With 2 columns -->
    <div class="w-row">
      <!-- Column #1 (2/3 of page width) - Content -->
      <div class="w-col w-col-9">



<?php

/*  PHP Paypal IPN Integration Class Demonstration File
 *  4.16.2005 - Micah Carrick, email@micahcarrick.com
 *
 *  This file demonstrates the usage of paypal.class.php, a class designed  
 *  to aid in the interfacing between your website, paypal, and the instant
 *  payment notification (IPN) interface.  This single file serves as 4 
 *  virtual pages depending on the "action" varialble passed in the URL. It's
 *  the processing page which processes form data being submitted to paypal, it
 *  is the page paypal returns a user to upon success, it's the page paypal
 *  returns a user to upon canceling an order, and finally, it's the page that
 *  handles the IPN request from Paypal.
 *
 *  I tried to comment this file, aswell as the acutall class file, as well as
 *  I possibly could.  Please email me with questions, comments, and suggestions.
 *  See the header of paypal.class.php for additional resources and information.
*/

                                          // Setup class
// include the class file
require_once('paypal.class.php');  
// initiate an instance of the class
$p = new paypal_class;             

// testing paypal url
$p->paypal_url = 'https://www.sandbox.paypal.com/cgi-bin/webscr';   

// PayPal URL
//$p->paypal_url = 'https://www.paypal.com/cgi-bin/webscr';
            
// setup a variable for this script (ie: 'http://www.micahcarrick.com/paypal.php')
$this_script = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];

// if there is not action variable, set the default action of 'process'
if (empty($_GET['action'])) $_GET['action'] = 'process';  

switch ($_GET['action']) 
{
    
   case 'process':      // Process an order...

      // There should be no output at this point.  To process the POST data,
      // the submit_paypal_post() function will output all the HTML tags which
      // contains a FORM which is submited instantaneously using the BODY onload
      // attribute.  In other words, don't echo or printf anything when you're
      // going to be calling the submit_paypal_post() function.
 
      // This is where you would have your form validation and all that jazz.
      // You would take your POST vars and load them into the class like below,
      // only using the POST values instead of constant string expressions.
 
      // For example, after ensuring all the POST variables from your custom
      // order form are valid, you might have:
      //
      // $p->add_field('first_name', $_POST['first_name']);
      // $p->add_field('last_name', $_POST['last_name']);
      
      $p->add_field('business', $_GET['email']);
      $p->add_field('return', $this_script.'?action=success');
      $p->add_field('cancel_return', $this_script.'?action=cancel');
      $p->add_field('notify_url', $this_script.'?action=ipn');
   
   if($_GET['type'] == 'NFPO')
   {
      $p->add_field('item_name', 'Donations Desk - NFPO Donation');
   }
   if($_GET['type'] == 'Campaign')
   {
      $p->add_field('item_name', 'Donations Desk - Campaign Donation');
   }

      $p->add_field('item_number', $_GET['item_number']);
      $p->add_field('rm', '2');
      // Lenguaje
      $p->add_field('lc', 'US');
      $p->add_field('no_note', '0');
      $p->add_field('currency_code', 'USD');
      $p->add_field('cmd', '_donations');
      
      $p->submit_paypal_post(); // submit the fields to paypal
      //$p->dump_fields();      // for debugging, output a table of all the fields
      break;
      
   case 'success':      // Order was successful...
   
      // This is where you would probably want to thank the user for their order
      // or what have you.  The order information at this point is in POST 
      // variables.  However, you don't want to "process" the order until you
      // get validation from the IPN.  That's where you would have the code to
      // email an admin, update the database with payment status, activate a
      // membership, etc.  

      // For this example, we'll just email ourselves ALL the data.
      $subject = 'Instant Payment Notification - Received Payment';
      $to = 'iortiz@asesoresfinancierospr.org';    //  your email
      $body =  "An instant payment notification was successfully received\n";
      $body .= "from ".$_POST['payer_email']." on ".date('m/d/Y');
      $body .= " at ".date('g:i A')."\n\nDetails:\n\n";
      $body .= "Organization ID: ".$transaction_type[0]." ".$transaction_type[1]."\n";
      $body .= "Amount: ".$_POST['payment_gross']."\n";
      $body .= "Date: ".date("Y-m-d")."\n";
      $body .= "Payer E-mail: ".$_POST['payer_email']."\n";
      $body .= "Payer Name: ".$_POST['first_name'].$_POST['last_name']."\n";
      $body .= "Transaction ID: ".$_POST['txn_id']."\n";
      $body .= "Receiver: ".$_POST['receiver_email']."\n";
      
      // mail($to, $subject, $body);
 
      $transaction_type = explode('.', $_POST['item_number']);

      // Save Donation to NFPO Donation Table if applies
      if($transaction_type[0] == 'NFPO')
      {
        if(mysql_result(mysql_query("SELECT COUNT(`org-id`) FROM `osfl-donations` WHERE `transaction-id` = '".$_POST['txn_id']."'"), 0) == 0)
        {
          $query = "INSERT INTO `osfl-donations` (`org-id`, `amount`, `date`, `donor-email`, `donor-name`, `transaction-id`, `receiver`) 
          VALUES ('" . 
             $transaction_type[1] . "', '" . $_POST['payment_gross'] . "', '" . date("Y-m-d") . "', '" . $_POST['payer_email'] . 
             "', '" . $_POST['first_name'] . " " . $_POST['last_name'] . "', '" . $_POST['txn_id'] . "', '" . 
             $_POST['receiver_email'] . "')";
          mysql_query($query);
        }
      }
      
      // Save Donation to Campaign Donation Table if applies
      if($transaction_type[0] == 'Campaign')
      { 
        if(mysql_result(mysql_query("SELECT COUNT(`camp-id`) FROM `campaign-donations` WHERE `transaction-id` = '".$_POST['txn_id']."'"), 0) == 0)
        {     
          $query = "INSERT INTO `campaign-donations` (`camp-id`, `amount`, `date`, `donor-email`, `donor-name`, `transaction-id`, `receiver`) 
          VALUES ('" . 
             $transaction_type[1] . "', '" . $_POST['payment_gross'] . "', '" . date("Y-m-d") . "', '" . $_POST['payer_email'] . 
             "', '" . $_POST['first_name'] . " " . $_POST['last_name'] . "', '" . $_POST['txn_id'] . "', '" . 
             $_POST['receiver_email'] . "')";
          
          mysql_query($query);

         $donated = mysql_result( mysql_query("SELECT DISTINCT SUM(amount) FROM `campaign-donations` WHERE `camp-id` = '" . $transaction_type[1] . "'"), 0 );
         mysql_query("UPDATE `Campaigns` SET `donated` = '" . $donated . "' WHERE `id` = '" . $transaction_type[1] . "'");
       }
      }

      echo "
         <h3>Thank you for your donation.</h3>
         <br>
         You will be receiving a confirmation e-mail from PayPal in a short time.
         <br>
         You can now close this window.
         <br><br>";
      
      // You could also simply re-direct them to another page, or your own 
      // order status page which presents the user with the status of their
      // order based on a database (which can be modified with the IPN code 
      // below).
      
      break;
      
   case 'cancel':       // Order was canceled...

      // The order was canceled before being completed.
 
      echo "
         <h3>The transaction was canceled.</h3>";
      
      break;
      
   case 'ipn':          // Paypal is calling page for IPN validation...
   
      // It's important to remember that paypal calls this script.  There
      // is no output here.  This is where you validate the IPN data and if it's
      // valid, UPDATE YOUR DATABASE to signify that the user has payed.  If
      // you try and use an echo or printf function here it's not going to do you
      // a bit of good.  This is on the "backend".  That is why, by default, the
      // class logs all IPN data to a text file.
      
      if ($p->validate_ipn()) 
      {
          
         // Payment has been recieved and IPN is verified.  This is where you
         // update your database to activate or process the order, or setup
         // the database with the user's order details, email an administrator,
         // etc.  You can access a slew of information via the ipn_data() array.
  
         // Check the paypal documentation for specifics on what information
         // is available in the IPN POST variables.  Basically, all the POST vars
         // which paypal sends, which we send back for validation, are now stored
         // in the ipn_data() array.
      }
      break;
}     

?>

      </div>

      <!-- Column #2 (1/3 of page width) - Sub-Menu -->
      <div class="w-col w-col-3">
      </div>

    </div>

  </div>

</section>

 <!-- The Footer Section -->
<footer>
  <!-- Is inside a container -->
  <div class="w-container">
    <!-- With 1 row that has 3 columns-->
    <div class="w-row footer-section">

      <!-- COLOR BARS AT THE BOTTOM OF THE HEADER -->
      <!-- wraps each bar -->
      <div id="footer-bar-wrapper"> 
        <!-- bars from left to right -->
        <div id="orange-bar"><br/></div>
        <div id="green-bar"><br/></div>
        <div id="gray-bar"><br/></div>
        <div id="orange-bar"><br/></div>
      </div>
      <!-- END OF COLOR BARS AT THE BOTTOM OF THE HEADER -->

      <!-- Column #1 (1/4 of page width) -->
      <div class="w-col w-col-3">
      </div>
      
      <!-- Column #2 (1/2 of page width) -->
      <div class="w-col w-col-6">
        <!-- Copyright Info -->
        <div class="copyright">Donations Desk
          <br>© Copyright 2014 
<?php 
          if(date('Y') > 2014)
          {
            echo ' - ' . date('Y');
          }
?>
          <br>Asesores Financieros Comunitarios
        </div>
      </div>

      <!-- Column #3 (1/4 of page width) - Social Media Links -->
      <div class="w-col w-col-3">
      <!-- Has one inner row with 3 columns equally spaced -->
        <div class="w-row">
          <?php include '../includes/widgets/social-media.php'; ?>
        </div>

      </div>

    </div>

  </div>
</footer>

</body>
</html>