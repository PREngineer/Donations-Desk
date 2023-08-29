<?php

class Emails
{
  //------------------------- Attributes -------------------------
  // To gather data
  private $db = null;

  // To setup the connectivity
  private $smtpHosts          = null;
  private $smtpUsername       = null;
  private $smtpPassword       = null;
  private $smtpPort           = null;
  private $smtpSenderName     = null;
  private $smtpSenderEmail    = null;
  private $smtpEncryption     = null;
  private $smtpAuthentication = null;
  
  // E-mail contents
  private $recipient      = null;
  private $recipientName  = null;
  private $subject        = null;
  private $htmlBody       = null;
  private $plainBody      = null;

  // Administrator e-mails go to this address
  private $adminEmail = null;

  //------------------------- Operations -------------------------

  /**
   * __construct
   *
   * @return void
   */
  public function __construct()
  {
    // Read the settings file
    // Read the settings file
    if( file_exists ('settings.php') ){
      require 'settings.php';
    }
    if( file_exists ('/config/settings.php') ){
      require '/config/settings.php';
    }  

    // Instantiate the Database
    $this->db = new Database();

    // Set the SMTP variables
    $this->smtpHosts          = $SMTPHOSTS;
    $this->smtpUsername       = $SMTPUSER;
    $this->smtpPassword       = $SMTPPASS;
    $this->smtpEncryption     = $SMTPENC;
    $this->smtpPort           = $SMTPPORT;
    $this->smtpSenderName     = $SMTPFROMNAME;
    $this->smtpSenderEmail    = $SMTPFROMEMAIL;
    $this->smtpAuthentication = $SMTPAUTHENTICATION;

    // Set the admin e-mail
    $this->adminEmail = $ADMINEMAIL;
  }

  /**
   * Send - Execute the action of sending the e-mail message.
   * @param none
   * 
   * @return bool
   */
  private function Send(){
    // Create an instance of the PHPMailer
    $mail = new PHPMailer();

    // Set mailer to use SMTP
    $mail->isSMTP();

    // Specify main and backup SMTP servers
    $mail->Host = $this->smtpHosts;

    // Enable SMTP authentication
    $mail->SMTPAuth = $this->smtpAuthentication;

    // SMTP username
    $mail->Username = $this->smtpUsername;

    // SMTP password
    $mail->Password = $this->smtpPassword;

    // If using TLS encryption
    if( $this->smtpEncryption == 1 )
    {
      $mail->SMTPSecure = 'tls';
    }
    // If using SSL encryption
    else if( $this->smtpEncryption == 2 )
    {
      $mail->SMTPSecure = 'ssl';
    }

    // TCP port to connect to
    $mail->Port = $this->smtpPort;

    // Set Sender  =>  user@domain.com, UserName
    $mail->setFrom( $this->smtpSenderEmail, $this->smtpSenderName );

    // Add a recipient  =>  user@domain.com, Recipient's Name
    $mail->addAddress( $this->recipient, $this->recipientName );

    // Set email format to HTML
    $mail->isHTML(true);

    // Set the subject of the e-mail
    $mail->Subject = $this->subject;
    
    // Set the HTML body of the e-mail
    $mail->Body    = $this->htmlBody;
    
    // Set the plain text (alternate) body of the e-mail
    $mail->AltBody = $this->plainBody;

    // Attempt to send
    if( !$mail->send() )
    {
      //echo 'Error: ' . $mail->ErrorInfo ;
      return $mail->ErrorInfo;
    }
    else
    {
      //echo 'Success!';
      return True;
    }
  }

  /**
   * ForgotPassword - Sends an e-mail with temporary credentials to accounts which have lost their password.
   * 
   * @param string email, newPassword
   * 
   * @return bool
   */
  public function ForgotPassword( $email, $newPassword ){
    // Set the e-mail variable
    $this->recipient = $email;

    // Set the e-mail Subject
    if( $_SESSION['language'] == 'es' )
    {
      $this->subject = "Donations Desk - Olvidé mi Contraseña";
    }
    else{
      $this->subject = "Donations Desk - Forgot my Password";
    }

    // Get the person's name from the database
    $data = $this->db->query_DB("SELECT `username`,`first-name`,`last-name`
                                 FROM Accounts
                                 WHERE `email` = '" . $email . "' ")[0];
    // Set the name variable
    $this->recipientName = $data['first-name'] + " " + $data['last-name'];

    // Set the html body of the e-mail
    if( $_SESSION['language'] == 'es' )
    {
      $this->htmlBody = "
      <center>
        <img src='https://" . $_SERVER['HTTP_HOST'] . "/images/Donations%20Desk%20Logo.png' height='150' width='150' alt='Donations Desk Logo'/>
      </center>
      <hr>
      <p>Hola " . $this->recipientName . ",</p>
      <p>
      Como nos has dicho que has olvidado tu contraseña, la hemos cambiado.  Puedes cambiarla por otra mas fácil de recordar una vez entres a la plataforma.
      Tus credenciales temporeras son:
      </p>
      <p>
      Usuario: " . $data['username'] . "<br>
      Contraseña: " . $newPassword . "
      </p>
      <p>
      Sinceramente,
      </p>
      <p>
      Donations Desk
      </p>";
    }
    else
    {
      $this->htmlBody = "
      <center>
        <img src='https://" . $_SERVER['HTTP_HOST'] . "/images/Donations%20Desk%20Logo.png' height='150' width='150' alt='Donations Desk Logo'/>
      </center>
      <hr>
      <p>Hello " . $this->recipientName . ",</p>
      <p>
      Since you've told us that you have forgotten your password, we have changed it.  You can change it to something more memorable once you log in.
      Your temporary credentials are:
      </p>
      <p>
      Username: " . $data['username'] . "<br>
      Password: " . $newPassword . "
      </p>
      <p>
      Sincerely,
      </p>
      <p>
      Donations Desk
      </p>";
    }

    // Set the plain text body of the e-mail
    if( $_SESSION['language'] == 'es' )
    {
      $this->plainBody = "Hola " . $this->recipientName . ",
	
      Como nos has dicho que has olvidado tu contraseña, la hemos cambiado.  Puedes cambiarla por otra mas fácil de recordar una vez entres a la plataforma.
      Tus credenciales temporeras son:
      Usuario: " . $data['username'] . "
      Contraseña: " . $newPassword . "

      Sinceramente,

      Donations Desk";
    }
    else
    {
      $this->plainBody = "Hello " . $this->recipientName . ",
	
      Since you've told us that you have forgotten your password, we have changed it.  You can change it to something more memorable once you log in.
      Your temporary credentials are:
      Username: " . $data['username'] . "
      Password: " . $newPassword . "

      Sincerely,

      Donations Desk";
    }

    // Send the e-mail
    return $this->Send();
  }

  /**
   * Register - Sends an e-mail after registration to validate the account.
   * 
   * @param string email
   * 
   * @return bool
   */
  public function Register( $email ){
    // Set the e-mail variable
    $this->recipient = $email;

    // Set the e-mail Subject
    if( $_SESSION['language'] == 'es' )
    {
      $this->subject = "Donations Desk - Confirmar Registración";
    }
    else{
      $this->subject = "Donations Desk - Confirm Registration";
    }

    // Get the person's name from the database
    $data = $this->db->query_DB("SELECT `first-name`,`last-name`,`email_code`
                                 FROM Accounts
                                 WHERE `email` = '" . $email . "' ")[0];
    // Set the name variable
    $this->recipientName = $data['first-name'] + " " + $data['last-name'];

    // Set the html body of the e-mail
    if( $_SESSION['language'] == 'es' )
    {
      $this->htmlBody = "
      <center>
        <img src='https://" . $_SERVER['HTTP_HOST'] . "/images/Donations%20Desk%20Logo.png' height='150' width='150' alt='Donations Desk Logo'/>
      </center>
      <hr>
      <p>Hola " . $this->recipientName . ",
      <p>
      Bienvenid@ a Donations Desk!
      </p>
      <p>
      Para poder utilizar nuestros servicios, debes activar tu cuenta.
      </p>
      <p>
      Haz click en el siguiente enlace para activar tu cuenta [o copia y pégalo en tu navegador]:
      </p>
      https://" . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'] ."?email=" . $email . "&email_code=" . $data['email_code'] . "
      </p>
      <p>
      Sinceramente,
      </p>
      <p>
      Donations Desk
      </p>";
    }
    else
    {
      $this->htmlBody = "
      <center>
        <img src='https://" . $_SERVER['HTTP_HOST'] . "/images/Donations%20Desk%20Logo.png' height='150' width='150' alt='Donations Desk Logo'/>
      </center>
      <hr>
      <p>Hello " . $this->recipientName . ",
      <p>
      Welcome to Donations Desk!
      </p>
      <p>
      To be able to use our services, you need to activate your account.
      </p>
      <p>
      Click the following link to activate your account [or copy and paste it to your browser's address bar]:
      </p>
      https://" . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'] ."?email=" . $email . "&email_code=" . $data['email_code'] . "
      </p>
      <p>
      Sincerely,
      </p>
      <p>
      Donations Desk
      </p>";
    }

    // Set the plain text body of the e-mail
    if( $_SESSION['language'] == 'es' )
    {
      $this->plainBody = "Hola " . $this->recipientName . ",
      
      Bienvenid@ a Donations Desk!

      Para poder utilizar nuestros servicios, debes activar tu cuenta.

      Haz click en el siguiente enlace para activar tu cuenta [o copia y pégalo en tu navegador]:

      https://" . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'] ."?email=" . $email . "&email_code=" . $data['email_code'] . "

      Sinceramente,
      
      Donations Desk";
    }
    else
    {
      $this->plainBody = "Hello " . $this->recipientName . ",
      
      Welcome to Donations Desk!

      To be able to use our services, you need to activate your account.

      Click the following link to activate your account [or copy and paste it to your browser's address bar]:

      https://" . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'] ."?email=" . $email . "&email_code=" . $data['email_code'] . "

      Sincerely,

      Donations Desk";
    }

    // Send the e-mail
    return $this->Send();
  }

  /**
   * TransactionConfirmed - Sends an e-mail after a transaction is confirmed.
   * 
   * @param array data
   * 
   * @return bool
   */
  public function TransactionConfirmed( $data ){
    // Set the e-mail variable
    $this->recipient = $this->adminEmail;

    // Set the e-mail Subject
    if( $_SESSION['language'] == 'es' )
    {
      $this->subject = "Donations Desk - Notificación de Pago Instantáneo - Confirmada";
    }
    else{
      $this->subject = "Donations Desk - Instant Payment Notification - Confirmed";
    }

    // Set the html body of the e-mail
    if( $_SESSION['language'] == 'es' )
    {
      $this->htmlBody = "
      <center>
        <img src='https://" . $_SERVER['HTTP_HOST'] . "/images/Donations%20Desk%20Logo.png' height='150' width='150' alt='Donations Desk Logo'/>
      </center>
      <hr>
      <p>Una notificación de pago instantáneo fue confirmada por PayPal.</p>
      <p>De: "    . $data['payer_email'] . "</p> 
      <p>Fecha: " . date('m/d/Y') . "</p> 
      <p>Hora: "  . date('g:i A') . "</p>
      <p>Detalles: </p>";

      $transaction_type = explode( '.', $data['item_number'] );
      
      $this->htmlBody .= "
      <p>ID de Organización: " . $transaction_type[0] . " " . $transaction_type[1] . "</p>
      <p>Cantidad: "           . $data['payment_gross'] . "</p>
      <p>Fecha: "              . date("Y-m-d") . "</p>
      <p>Correo del Pagador: " . $data['payer_email'] . "</p>
      <p>Nombre del Pagador: " . $data['first_name'] . $data['last_name'] . "</p>
      <p>ID de Transacción: "  . $data['txn_id'] . "</p>
      <p>Receptor: "           . $data['receiver_email'] . "</p>";
    }
    else
    {
      $this->htmlBody = "
      <center>
        <img src='https://" . $_SERVER['HTTP_HOST'] . "/images/Donations%20Desk%20Logo.png' height='150' width='150' alt='Donations Desk Logo'/>
      </center>
      <hr>
      <p>An instant payment notification was confirmed by PayPal.</p>
      <p>From: " . $data['payer_email'] . "</p> 
      <p>Date: " . date('m/d/Y') . "</p> 
      <p>Time: " . date('g:i A') . "</p>
      <p>Details: </p>";

      $transaction_type = explode( '.', $data['item_number'] );
      
      $this->htmlBody .= "
      <p>Organization ID: " . $transaction_type[0] . " " . $transaction_type[1] . "</p>
      <p>Amount: "          . $data['payment_gross'] . "</p>
      <p>Date: "            . date("Y-m-d") . "</p>
      <p>Payer E-mail: "    . $data['payer_email'] . "</p>
      <p>Payer Name: "      . $data['first_name'] . $data['last_name'] . "</p>
      <p>Transaction ID: "  . $data['txn_id'] . "</p>
      <p>Receiver: "        . $data['receiver_email'] . "</p>";
    }

    // Set the plain text body of the e-mail
    if( $_SESSION['language'] == 'es' )
    {
      $this->plainBody = "Una notificación de pago instantáneo fue confirmada por PayPal.

      De: "    . $data['payer_email'] . " 
      Fecha: " . date('m/d/Y') . " 
      Hora: "  . date('g:i A') . "
      Detalles: ";

      $transaction_type = explode( '.', $data['item_number'] );
      
      $this->plainBody .= "
      ID de Organización: " . $transaction_type[0] . " " . $transaction_type[1] . "
      Cantidad: "           . $data['payment_gross'] . "
      Fecha: "              . date("Y-m-d") . "
      Correo del Pagador: " . $data['payer_email'] . "
      Nombre del Pagador: " . $data['first_name'] . $data['last_name'] . "
      ID de Transacción: "  . $data['txn_id'] . "
      Receptor: "           . $data['receiver_email'];
    }
    else
    {
      $this->plainBody = "An instant payment notification was confirmed by PayPal.

      From: " . $data['payer_email'] . " 
      Date: " . date('m/d/Y') . " 
      Time: " . date('g:i A') . "
      Details: ";

      $transaction_type = explode( '.', $data['item_number'] );
      
      $this->plainBody .= "
      Organization ID: " . $transaction_type[0] . " " . $transaction_type[1] . "
      Amount: "          . $data['payment_gross'] . "
      Date: "            . date("Y-m-d") . "
      Payer E-mail: "    . $data['payer_email'] . "
      Payer Name: "      . $data['first_name'] . $data['last_name'] . "
      Transaction ID: "  . $data['txn_id'] . "
      Receiver: "        . $data['receiver_email'];
    }

    // Send the e-mail
    return $this->Send();
  }
}

?>