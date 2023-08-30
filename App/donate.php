<?php

require_once 'init.php';
require_once 'autoloader.php';

class Donate extends Page
{
  
  //------------------------- Attributes -------------------------
  private $db = null;

  public $content = '';
  public $pageTitle = "Donation";
  public $title = "Donations Desk - Donation";
  public $keywords = "Donations Desk, Donation";

  // Create an instance of the PayPal class
  //private $p = new paypal_class;
  
  //------------------------- Operations -------------------------
  
  /**
   * __construct
   *
   * @return void
   */
  public function __construct()
  {
    $this->db = new Database();
    
    // Get the appropriate language
    if( $_SESSION['language'] == 'es' ) {
      $this->pageTitle = "Donación";
    }
    else{
      $this->pageTitle = "Donation";
    }

    parent::__construct();
  }

  /**
   * Process - Displays the processing page
   *
   * @param  mixed $filter
   *
   * @return void
   */
  public function Process()
  {
    // Create an instance of the PayPal class
    $p = new paypal_class;
    
    // Specify the URL to use, PROD or Sandbox
    $p->paypal_url = 'https://www.sandbox.paypal.com/cgi-bin/webscr';
    //$p->paypal_url = 'https://www.paypal.com/cgi-bin/webscr';

    // Define the URL of this page
    $this_script = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];

    $p->add_field('business', $_GET['email']);
    $p->add_field('return', $this_script.'?action=success');
    $p->add_field('cancel_return', $this_script.'?action=cancel');
    $p->add_field('notify_url', $this_script.'?action=ipn');
  
    // If donation is for an NFPO
    if( $_GET['type'] == 'NFPO' )
    {
        if( $_SESSION['language'] == 'en' ){
          $p->add_field('item_name', 'Donations Desk - NFPO Donation');
        }
        else{
          $p->add_field('item_name', 'Donations Desk - Donación OSFL');
        }
    }
    // If donation is for a Campaign
    if( $_GET['type'] == 'Campaign' )
    {
        if( $_SESSION['language'] == 'en' ){
          $p->add_field('item_name', 'Donations Desk - Campaign Donation');
        }
        else{
          $p->add_field('item_name', 'Donations Desk - Donación a Campaña');
        }
    }

    $p->add_field('item_number', $_GET['item_number']);
    $p->add_field('rm', '2');
    // Lenguaje
    $p->add_field('lc', 'US');
    $p->add_field('no_note', '0');
    $p->add_field('currency_code', 'USD');
    $p->add_field('cmd', '_donations');
    
    // For debugging, outputs a table of all the fields
    //$this->content .= $p->dump_fields();
    
    // Submit to data to PayPal
    $this->content .= $p->submit_paypal_post();

    parent::Display();
  }

  /**
   * Success - Displays the Success page
   *
   * @param  mixed $filter
   *
   * @return void
   */
  public function Success()
  {
    if( $_SESSION['language'] == 'en' ){
      $this->content .= '
      <div class="w-container">
        <h3>Thank you for your donation.</h3>
        <br>
        You will be receiving a confirmation e-mail from PayPal in a short time.
        <br>
        PayPal should process your transaction and let us know if it was successful later.  Once we can
        validate that it was, we will process your order.
        <br>
        You can now close this window.
      </div>';
    }
    else{
      $this->content .= '
      <div class="w-container">
        <h3>Gracias por tu donación.</h3>
        <br>
        Pronto recibirás un correo electrónico de confirmación de PayPal.
        <br>
        PayPal debe procesar tu transacción y dejarnos saber si fue exitosa luego.  Una vez podamos
        validar que así fue, procesaremos tu orden.
        <br>
        Puedes cerrar esta ventana.
      </div>';
    }

    parent::Display();
  }

  /**
   * Cancel - Displays the Cancelled page
   *
   * @param  mixed $filter
   *
   * @return void
   */
  public function Cancel()
  {
    if( $_SESSION['language'] == 'en' ){
      $this->content .= '
      <div class="w-container">
        <h3>The transaction was cancelled.</h3>
        <br>
        Nothing was charged to your PayPal account.
        <br>
        If this was an accident, you can start the donation process again.
      </div>';
    }
    else{
      $this->content .= '
      <div class="w-container">
        <h3>La transacción fue cancelada.</h3>
        <br>
        No se cargó nada a tu cuenta de PayPal.
        <br>
        Si fue un error, puedes comenzar de nuevo el proceso de donación.
      </div>';
    }

    parent::Display();
  }

  /**
   * IPN - Runs the IPN confirmation
   *
   * @param  mixed $filter
   *
   * @return void
   */
  public function IPN()
  {
    // Email ourselves the data.
    $subject = 'Instant Payment Notification - Payment Received';
    $to      = 'pianistapr@hotmail.com';
    $body    =  "An instant payment notification was successfully received\n";
    $body   .= "from ".$_POST['payer_email']." on ".date('m/d/Y');
    $body   .= " at ".date('g:i A');
    $body   .= "\n\nDetails:\n\n";
    $transaction_type = explode('.', $_POST['item_number']);
    $body   .= "Organization ID: ".$transaction_type[0]." ".$transaction_type[1]."\n";
    $body   .= "Amount: ".$_POST['payment_gross']."\n";
    $body   .= "Date: ".date("Y-m-d")."\n";
    $body   .= "Payer E-mail: ".$_POST['payer_email']."\n";
    $body   .= "Payer Name: ".$_POST['first_name'].$_POST['last_name']."\n";
    $body   .= "Transaction ID: ".$_POST['txn_id']."\n";
    $body   .= "Receiver: ".$_POST['receiver_email']."\n";
    
    mail($to, $subject, $body);

    // Create an instance of the PayPal class
    $p = new paypal_class;
    
    // Specify the URL to use, PROD or Sandbox
    $p->paypal_url = 'https://www.sandbox.paypal.com/cgi-bin/webscr';
    //$p->paypal_url = 'https://www.paypal.com/cgi-bin/webscr';

    // Confirm everything was OK with PayPal
    $result = $p->validate_ipn();

    // Save Donation to DB here
    if( $result ){

      /**
       * Identify if Campaign donation or NFPO based on the Item Number recorded
       * After exploding:
       *  0. NFPO/Campaign
       *  1. ID
       */
      
      $transaction_type = explode('.', $_POST['item_number']);

      // Save Donation to NFPO Donation Table if applies
      if( $transaction_type[0] == 'NFPO' )
      {
        // Check this transaction was not registered before
        $count = $this->db->query_DB("SELECT COUNT(`org-id`) AS count 
                                      FROM `osfl-donations` 
                                      WHERE `transaction-id` = '" . $_POST['txn_id'] . "'")[0]['count'];
        // If not registered before
        if( $count == 0 )
        {
          $this->db->query_DB("INSERT INTO `osfl-donations` (`org-id`, `amount`, `date`, `donor-email`, `donor-name`, `transaction-id`, `receiver`) 
                               VALUES ('" . $transaction_type[1] . "', '" . $_POST['payment_gross'] . "', '" . date("Y-m-d") . "', '" . $_POST['payer_email'] . 
                                   "', '" . $_POST['first_name'] . " " . $_POST['last_name'] . "', '" . $_POST['txn_id'] . "', '" . $_POST['receiver_email'] . "')");
        }
      }      
      
      // Save Donation to Campaign Donation Table if applies
      if( $transaction_type[0] == 'Campaign' )
      { 
        // Check this transaction was not registered before
        $count = $this->db->query_DB("SELECT COUNT(`camp-id`) AS count 
                                      FROM `Campaign-Donations` 
                                      WHERE `transaction-id` = '".$_POST['txn_id']."'")[0]['count'];

        if( $count == 0 )
        {     
          $this->db->query_DB("INSERT INTO `Campaign-Donations` (`camp-id`, `amount`, `date`, `donor-email`, `donor-name`, `transaction-id`, `receiver`) 
                               VALUES ('" . $transaction_type[1] . "', '" . $_POST['payment_gross'] . "', '" . date("Y-m-d") . "', '" . $_POST['payer_email'] . 
                                   "', '" . $_POST['first_name'] . " " . $_POST['last_name'] . "', '" . $_POST['txn_id'] . "', '" . $_POST['receiver_email'] . "')");
          
          // Get current amount of donations to the campaign
          $donated = $this->db->query_DB("SELECT DISTINCT SUM(amount) AS amount
                                          FROM `Campaign-Donations` 
                                          WHERE `camp-id` = '" . $transaction_type[1] . "'")[0]['amount'];

          // Update donated amount on campaign
          $this->db->query_DB("UPDATE `Campaigns` SET `donated` = '" . $donated . "' WHERE `id` = '" . $transaction_type[1] . "'");
       }
      }

      $this->content .= '
        <div class="w-container">
          <h3>PayPal validated.</h3>
        </div>';

      parent::Display();
    }
    else{
      $this->content .= '
        <div class="w-container">
          <h3>PayPal NOT validated.</h3>
        </div>';

      parent::Display();
    }
  }

}

  // Create an instance of the Donate class
  $d = new Donate();

  if( $_GET['action'] == 'process' ){
    $d->Process();
  }
  if( $_GET['action'] == 'success' ){
    $d->Success();
  }
  if( $_GET['action'] == 'cancel' ){
    $d->Cancel();
  }
  if( $_GET['action'] == 'ipn' ){
    $d->IPN();
  }

?>