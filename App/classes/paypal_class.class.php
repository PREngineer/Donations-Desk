<?php

/*******************************************************************************
 *                      PHP Paypal IPN Integration Class
 *******************************************************************************
 *      Author:     Micah Carrick
 *      Email:      email@micahcarrick.com
 *      Website:    http://www.micahcarrick.com
 *
 *      File:       paypal.class.php
 *      Version:    1.00
 *      Copyright:  (c) 2005 - Micah Carrick 
 *                  You are free to use, distribute, and modify this software 
 *                  under the terms of the GNU General Public License.  See the
 *                  included license.txt file.
 *      
 *******************************************************************************
 *  VERION HISTORY:
 *  
 *      v1.0.0 [04.16.2005] - Initial Version
 *
 *******************************************************************************
 *  DESCRIPTION:
 *
 *      This file provides a neat and simple method to interface with PayPal and
 *      the PayPal Instant Payment Notification (IPN) interface.  This file is
 *      NOT intended to make the PayPal integration "plug 'n' play". It still
 *      requires the developer (that should be you) to understand the PayPal
 *      process and know the variables you want/need to pass to PayPal to
 *      achieve what you want.  
 *
 *      This class handles the submission of an order to PayPal as well as the
 *      processing of an Instant Payment Notification.
 *  
 *      This code is based on that of the php-toolkit from PayPal.  I've taken
 *      the basic principles and put it into a class, so that it is a little
 *      easier -at least for me- to use.  The php-toolkit can be downloaded from
 *      http://sourceforge.net/projects/paypal.
 *      
 *      To submit an order to PayPal, have your order form POST to a file with:
 *
 *          $p = new paypal_class;
 *          $p->add_field('business', 'somebody@domain.com');
 *          $p->add_field('first_name', $_POST['first_name']);
 *          ... (add all your fields in the same manor)
 *          $p->submit_paypal_post();
 *
 *      To process an IPN, have your IPN processing file contain:
 *
 *          $p = new paypal_class;
 *          if( $p->validate_ipn() ) {
 *             ... (IPN is verified.  Details are in the ipn_data() array)
 *          }
 *          else{
 *             ... validation failed in this case
 *          }
 *
 *      In case you are new to PayPal, here is some information to help you:
 *
 *      1. Download and read the Merchant User Manual and Integration Guide from
 *         http://www.paypal.com/en_US/pdf/integration_guide.pdf.  This gives 
 *         you all the information you need including the fields you can pass to
 *         PayPal (using add_field() with this class) as well as all the fields
 *         that are returned in an IPN post (stored in the ipn_data() array in
 *         this class).  It also diagrams the entire transaction process.
 *
 *      2. Create a "sandbox" account for a buyer and a seller.  This is just
 *         a test account(s) that allows you to test your site from both the 
 *         seller and buyer perspective.  The instructions for this are available
 *         at https://developer.paypal.com/ as well as a great forum where you
 *         can ask all your PayPal integration questions.  Make sure you follow
 *         all the directions in setting up a sandbox test environment, including
 *         the addition of fake bank accounts and credit cards.
 * 
 *******************************************************************************
*/

class paypal_class {
   
   /**
    * Attributes
    */

   // Holds the last error encountered
   var $last_error;
   // bool: Log IPN results to text file? (true/false)
   var $ipn_log;
   // Filename of the IPN log
   var $ipn_log_file;
   // Holds the IPN response from PayPal
   var $ipn_response;
   // Array: Contains the POST values for IPN
   var $ipn_data = array();
   // Array: Holds the fields to submit to PayPal
   var $fields = array();
   
   /**
    * Methods
    */

   /** 
    * Constructor.  Called when class is created.
    */
   function paypal_class() {
       
      $this->paypal_url = 'https://www.paypal.com/cgi-bin/webscr';
      $this->last_error = '';
      $this->ipn_log = false;
      $this->ipn_log_file = 'ipn_log.txt';
      $this->ipn_response = '';
      
      // Populate the $fields array with a few default values.
      // See the PayPal documentation for a list of fields and their data types.
      // These default values can be overwritten by the calling script.

      // Return method = POST
      $this->add_field('rm','2');
      $this->add_field('cmd','_xclick'); 
      
   }
   
   /**
    * Setter.  Adds a key=>value pair to the fields array, which is all the
    * information that will be sent to PayPal in a POST.  Existing values
    * are overwritten.
    */
   function add_field($field, $value) {
      $this->fields["$field"] = $value;
   }

   /**
    * Submission.  This function generates an entire HTML page with a hidden form
    * that contains all the elemnts that are submitted to PayPal using the BODY's
    * onLoad attribute.  Done like that so that you can validate your information
    * before submitting to PayPal.
    * The user will briefly see a message on the screen that reads: "Please wait,
    * your order is being processed..." and then immediately is redirected to
    * PayPal.
    */
   function submit_paypal_post() { 
      $response = '
         <div>
      ';
      
      if( $_SESSION['language'] == 'en' )
      {
         $response = '<center><h3>Please wait, we are transferring you to PayPal...</h3></center>';
      }
      else{
         $response = '<center><h3>Por favor espere, le estamos transfiriendo a PayPal...</h3></center>';
      }
      
      $response .= '
            <form method="post" id="form" name="form" action="' . $this->paypal_url . '">';

      foreach ($this->fields as $name => $value) {
         $response .= '
               <input type="hidden" name="' . $name . '" value="' . $value .'">';
      }
 
      $response .= '
            </form>
         </div>

         <script>
         window.onload=function(){ 
            var counter = 3;
            var interval = setInterval(function() {
                counter--;
                $("#seconds").text(counter);
                if (counter == 0) {
                    redirect();
                    clearInterval(interval);
                }
            }, 1000);
        
        };
        
        function redirect() {
            document.getElementById("form").submit();
        }
         </script>';

      return $response;
   }
   
   /**
    * Validation.  This function validates the transaction with PayPal.
    */
   function validate_ipn() {

      // Parse the PayPal URL to use
      $url_parsed = parse_url($this->paypal_url);        

      // Generate the post string from the _POST vars as well as load the
      // _POST vars into an arry so that we can play with them from the 
      // calling script.
      $post_string = '';
      foreach ($_POST as $field=>$value) { 
         // Add to ipn_data array
         $this->ipn_data["$field"] = $value;
         // Add to the POST string (some1=value1&some2=value2...)
         $post_string .= $field . '=' . urlencode($value) . '&';
      }
      // Append ipn command
      $post_string.="cmd=_notify-validate";

      // Open the connection to PayPal
      $fp = fsockopen($url_parsed[host],"80",$err_num,$err_str,30); 
      // Could not open the connection.  If loggin is on, the error message
      // will be in the log.
      if (!$fp) {
         $this->last_error = "fsockopen error no. $errnum: $errstr";
         $this->log_ipn_results(false);       
         return false;         
      }
      // Connection was opened
      else {  
         // Post the data back to PayPal
         fputs($fp, "POST $url_parsed[path] HTTP/1.1\r\n"); 
         fputs($fp, "Host: $url_parsed[host]\r\n"); 
         fputs($fp, "Content-type: application/x-www-form-urlencoded\r\n"); 
         fputs($fp, "Content-length: ".strlen($post_string)."\r\n"); 
         fputs($fp, "Connection: close\r\n\r\n"); 
         fputs($fp, $post_string . "\r\n\r\n"); 

         // Loop through the response from the server and append to variable
         while(!feof($fp)) { 
            $this->ipn_response .= fgets($fp, 1024); 
         } 

         // Close connection
         fclose($fp);
      }
      
      // Valid IPN transaction.
      if ( eregi("VERIFIED",$this->ipn_response) ) {
         $this->log_ipn_results(true);
         return true;         
      } 
      // Invalid IPN transaction.  Check the log for details.
      else {
         $this->last_error = 'IPN Validation Failed.';
         $this->log_ipn_results(false);   
         return false;         
      }      
   }
   
   /**
    * Write to logs
    */
   function log_ipn_results($success) {
      // If logging is turned off, do nothing
      if ( !$this->ipn_log ){ 
         return;
      }
      
      // Timestamp
      $text = '['.date('m/d/Y g:i A').'] - '; 
      
      // Success or failure being logged?
      if ($success) {
         $text .= "SUCCESS!\n";
      }
      else {
         $text .= 'FAIL: ' . $this->last_error . "\n";
      }
      
      // Log the POST variables
      $text .= "IPN POST Vars from Paypal:\n";
      foreach ($this->ipn_data as $key=>$value) {
         $text .= "$key=$value, ";
      }
 
      // Log the response from the PayPal server
      $text .= "\nIPN Response from Paypal Server:\n " . $this->ipn_response;
      
      // Write to log
      $fp=fopen($this->ipn_log_file,'a');
      fwrite($fp, $text . "\n\n");
      fclose($fp);
   }

   /**
    * Helper function to debug.  This function will output all the field and value
    * pairs that are currently defined in teh instance of the class using the
    * add_field() function.
    */
   function dump_fields() {
      $response = '<h3>paypal_class->dump_fields() Output:</h3>
            <table width=\"95%\" border=\"1\" cellpadding=\"2\" cellspacing=\"0\">
            <tr>
               <td bgcolor=\"black\"><b><font color=\"white\">Field Name</font></b></td>
               <td bgcolor=\"black\"><b><font color=\"white\">Value</font></b></td>
            </tr>';
      
      ksort($this->fields);
      foreach ($this->fields as $key => $value) {
         $response .= "<tr><td>$key</td><td>" . urldecode($value) . '&nbsp;</td></tr>';
      }
 
      $response .= '</table><br>';

      return $response;
   }
}         

?>