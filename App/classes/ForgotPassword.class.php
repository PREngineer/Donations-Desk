<?php

class ForgotPassword extends Page
{
  
  //------------------------- Attributes -------------------------
  private $db = null;

  public $content = '';
  public $pageTitle = "Forgot Password";
  public $title = "Donations Desk - Forgot Password";
  public $keywords = "Donations Desk, Forgot Password";
  
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
      $this->pageTitle = "Olvidé Mi Contraseña";
    }
    else{
      $this->pageTitle = "Forgot Password";
    }
    parent::__construct();
  }

  /**
   * email_exists - Checks whether an e-mail provided exists in the database.
   * 
   * @param string
   * 
   * @return bool
   */
  private function email_exists( $email ){
    // Check if the username & password combination exists
    $check = $this->db->query_DB("SELECT COUNT(email) AS Count
                                  FROM Accounts
                                  WHERE email = '" . $email . "'");
    
    if( $check[0]['Count'] == 1 )
    {
      return True;
    }
    else
    {
      return False;
    }
  }

  /**
   * forgot_password - Resets the password and notifies via e-mail.
   * 
   * @param string
   * 
   * @return bool
   */
  private function forgot_password( $email ){
    // Get the current user information
    $data = $this->db->query_DB("SELECT * FROM `Accounts` WHERE `email` = '$email'")[0];
    
    // Generate new password
		$pass = substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'),0, 1) . 
            substr(str_shuffle('aBcEeFgHiJkLmNoPqRstUvWxYz0123456789'),0, 8);

    // Check if the username & password combination exists
    $check = $this->db->query_DB("UPDATE `Accounts` SET `password` = '" . MD5($pass) . "' WHERE `email` = '$email'");

    // Send the activation e-mail to the registered user
		$emails = new Emails();
    $check = $emails->ForgotPassword( $email, $pass );
    
    if( $check )
    {
      return True;
    }
    else
    {
      return False;
    }
  }

  /**
   * validatePOST - Takes control of the action once the form is posted.
   *
   * @param  mixed $posted
   *
   * @return void
   */
  private function validatePOST( $posted )
  {
    /** 
     * Validations 
    */

    // If the e-mail provided is not valid
    if( !filter_var($posted['email'], FILTER_VALIDATE_EMAIL) )
    {
      // Set error message
      if( $_SESSION['language'] == 'es' ){
        $_SESSION['error'] = 'El correo electrónico provisto no es válido.';
      }
      else{
        $_SESSION['error'] = 'The e-mail provided is not valid.';
      }
      return false;
    }
    // Check if the e-mail is already in use
    if( !$this->email_exists($posted['email']) === true )
    {
      // Set error message
      if( $_SESSION['language'] == 'es' ){
        $_SESSION['error'] = 'Lo sentimos, el correo electrónico \'' . $posted['email'] . '\' no está registrado.';
      }
      else{
        $_SESSION['error'] = 'Sorry, the email \'' . $posted['email'] . '\' is not registered.';
      }
      return false;
    }
    // Information provided is OK
    else
    {
      // Reset password and send e-mail
      $result = $this->forgot_password( $posted['email'] );

      if( $result )
      {
        $_SESSION['error'] = '';
        return true;
      }
      else
      {
        return false;
      }
    }
  }

  /**
   * Display - Displays the full page
   *
   * @param  mixed $filter
   *
   * @return void
   */
  public function Display()
  {
    // To show a message after successful submission
    $success = false;

    // When form is submitted
    if( isset( $_POST['email'] ) ){
      $success = $this->validatePOST( $_POST );
    }

    // If we are using Spanish
    if( $_SESSION['language'] == 'es' ) {
      $translation = array(
        '1' => 'Recibir Credenciales Temporeras',
        '2' => 'Una nueva contraseña será creada y enviada por correo electrónico.  Puedes cambiarla luego de que inicies sesión.',
        '3' => 'Correo electrónico:',
        '4' => 'Entre su correo electrónico',
        '5' => 'Recibir Credenciales Temporeras',
      );
    }
    else{
      $translation = array(
        '1' => 'Retrieve Temporary Credentials',
        '2' => 'A new password will be created and mailed to you.  You can change it after login in.',
        '3' => 'E-mail:',
        '4' => 'Enter your e-mail address',
        '5' => 'Retrieve Temporary Credentials',
      );
    }

    $this->content .= '
    <!-- Section -->
    <section class="content-section">
      <!-- Container -->
      <div class="w-container">
        <!-- Row -->
        <div class="w-row">';
          
    // If form was submitted and successful, show a message
    if( $success ){
      // If we are using Spanish
      if( $_SESSION['language'] == 'es' ) {
        $this->content .= '
        <center><font color="green"><p>¡Correo enviado!</p>
        <p>Un correo electrónico ha sido enviado con una contraseña temporera.</p>
        <p>Verifica tu folder de Basura/Spam si no lo ves.</p></font></center></div></div>
        ';
      }
      else{
        $this->content .= '
        <center><font color="green"><p>E-mail sent!</p>
        <p>An e-mail with your temporary credentials has been sent.</p>
        <p>Check your Junk/Spam Folder if you don\'t see it.</p></font></p></font></center></div></div>
        ';
      }
    }
    else{
      $this->content .= '
          <!-- PASSWORD RETRIEVAL FORM -->
          <center>
          <table>

          <tbody>

          <form class="login-form" enctype="multipart/form-data" method="POST">

            <tr>
              <td colspan="2">
                <h4>' . $translation[1] . '</h4>
                <p>' . $translation[2] . '</p>
              </td>
            </tr>

            <tr>
              <th class="required">' . $translation[3] . ' *</th>
              <td>
                <input class="w-input" type="text" placeholder="' . $translation[4] . '" name="email" value="">
              </td>
            </tr>

          </tbody>

          <tbody>
            <tr>
              <td colspan="2" align="right">
              <input class="w-button" type="submit" value="' . $translation[5] . '">
              </td>
            </tr>
          </tbody>

          </form>

          </table>

          <!-- Print an error message if necessary -->
          <br>
          <font color="red">' . $_SESSION['error'] .'</font>

          </center>
        </div>

      </div>

    </section>
    ';

    // Clear the error after showing it
    $_SESSION['error'] = '';
    }
    
    parent::Display();
  }

}

?>