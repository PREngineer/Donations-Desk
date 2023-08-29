<?php

class Register extends Page
{
  
  //------------------------- Attributes -------------------------
  private $db      = null;
  public $content  = '';
  public $pageTitle = 'Register';
  public $title    = "Donations Desk - Register";
  public $keywords = "Donations Desk, register";
  
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
      $this->pageTitle = "Registrarse";
    }
    else{
      $this->pageTitle = "Register";
    }
    parent::__construct();
  }

  /**
   * This function escapes special characters that are a problem due to SQL injection
   */
  public function sanitize( $string )
  {
    $string = str_replace('\\', '\\\\', $string);
    $string = str_replace("'", "\'", $string);
    $string = str_replace('"', '\"', $string);
    $string = str_replace("\0", '\0', $string);
    $string = str_replace(chr(8), '\b', $string);
    $string = str_replace("\n", '\n', $string);
    $string = str_replace("\r", '\r', $string);
    $string = str_replace("\t", '\t', $string);
    $string = str_replace(chr(26), '\Z', $string);
    // $string = str_replace("%", "\%", $string);
    $string = str_replace("_", "\_", $string);
    return $string;
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
   * register_user - Performs the user registration
   * 
   * @param string
   * 
   * @return bool
   */
  private function register_user( $register_user_data ){
    // Hash the password with MD5 and re-assign its value to the array
		$register_user_data['password'] = MD5($register_user_data['password']);
		// Part of the query that contains the fields to change in the DB, ex. `username`, `password`
		$fields = '`' . implode('`, `', array_keys($register_user_data)) . '`';
		// Part of the query that contains the values to be added
		$data = '\'' . implode('\', \'', $register_user_data) . '\'';

    // Execute the query
    $this->db->query_DB("INSERT INTO `Accounts` ($fields) VALUES ($data)");

    //$check = $this->user_exists( $register_user_data['username'] );

    if( true ){
      // Send Activation E-mail
      $emails = new Emails();
      $check = $emails->Register( $register_user_data['email'] );
      
      if( $check )
      {
        return True;
      }
      else
      {
        return False;
      }
    }
    else{
      return false;
    }
  }
  
  /**
   * user_exists - Checks whether a username provided exists in the database.
   * 
   * @param string
   * 
   * @return bool
   */
  private function user_exists( $username ){
    // Check if the username & password combination exists
    $check = $this->db->query_DB("SELECT COUNT(username) AS Count
                                  FROM Accounts
                                  WHERE username = '" . $username . "'");
    
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

    // If the Username or Password is empty
    if(empty($_POST['username']) === true || empty($_POST['password']) === true)
    {
      // Set error message
      if( $_SESSION['language'] == 'es' ){
        $_SESSION['error'] = 'Debes proveer ambos: usuario y contraseña.';
      }
      else{
        $_SESSION['error'] = 'You need to enter both: a username and a password.';
      }
      return false;
    }
    // If the username exists
    else if( $this->user_exists($_POST['username'] ) )
    {
      // Set error message
      if( $_SESSION['language'] == 'es' ){
        $_SESSION['error'] = 'Este nombre de usuario ya existe en el sistema.  Por favor, escoja otro.';
      }
      else{
        $_SESSION['error'] = 'This username already exists in the system.  Please pick another one.';
      }
      return false;
    }
    // If the e-mail provided is not valid
    else if( !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) )
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
    // Check if the username has spaces
    else if( preg_match("/\\s/", $_POST['username'] ) )
    {
      // Set error message
      if( $_SESSION['language'] == 'es' ){
        $_SESSION['error'] = 'Su nombre de usuario no debe tener espacios.';
      }
      else{
        $_SESSION['error'] = 'Your username must not have any spaces.';
      }
      return false;
    }
    // Check if the password is >= 6 characters
    else if( strlen($_POST['password']) < 6 )
    {
      // Set error message
      if( $_SESSION['language'] == 'es' ){
        $_SESSION['error'] = 'Su contraseña debe tener al menos 6 caracteres.';
      }
      else{
        $_SESSION['error'] = 'Your password must be at least 6 characters long.';
      }
      return false;
    }
    // Check if the password is entered correctly in both places
    if( $_POST['password'] !== $_POST['password-again'] )
    {
      // Set error message
      if( $_SESSION['language'] == 'es' ){
        $_SESSION['error'] = 'La contraseña no es igual en ambos campos.';
      }
      else{
        $_SESSION['error'] = 'The passwords provided do not match.';
      }
      return false;
    }
    // Check if the e-mail is already in use
    if( $this->email_exists($_POST['email']) === true )
    {
      // Set error message
      if( $_SESSION['language'] == 'es' ){
        $_SESSION['error'] = 'Lo sentimos, el correo electrónico \'' . $_POST['email'] . '\' ya está registrado.';
      }
      else{
        $_SESSION['error'] = 'Sorry, the email \'' . $_POST['email'] . '\' is already registered.';
      }
      return false;
    }
    // Information provided is OK
    else
    {
      // Establish which fields are required
      $required_fields = array('username', 'password', 'password-again', 'email', 'first-name', 'last-name');
      
      // Check all the values provided in the post
      foreach($_POST as $key=>$value)
      {
        // If any of the required fields is not provided
        if( empty($value) && in_array($key, $required_fields) )
        {
          // Set error message
          if( $_SESSION['language'] == 'es' ){
            $_SESSION['error'] = 'Faltaron campos requeridos (*)';
          }
          else{
            $_SESSION['error'] = 'Required fields (*) missing';
          }
          return false;
        }
      }

      return true;
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
    // To track whether to show the form or the success message
    $success = false;

    // Handle data
    if( isset( $_POST['username'] ) )
    {
      // If validations were successful
      if( $this->validatePOST( $_POST ) ){
        // Prepare user data
        $register_user_data = array(
          'username'      => $this->sanitize( $_POST['username'] ),
          'password'      => $this->sanitize( $_POST['password'] ),
          'first-name'    => $this->sanitize( $_POST['first-name'] ),
          'last-name'     => $this->sanitize( $_POST['last-name'] ),
          'email'         => $this->sanitize( $_POST['email'] ),
          // A combination of the Username + the Timestamp in Microseconds
          'email_code'    => MD5( $_POST['username'] + microtime() ) );

        // Register the Account
        if( $this->register_user( $register_user_data ) ){
          $success = true;
        }
      }
      // If post was not valid
      else{

      }
    }
    
    // If we are using Spanish
    if( $_SESSION['language'] == 'es' ) {
      $translation = array(
        '1' => 'Información de Cuenta',
        '2' => 'Esta información se utilizará para manejar tu cuenta y para contactarte.',
        '3' => 'Usuario:',
        '4' => 'Entre su usuario',
        '5' => 'Contraseña:',
        '6' => 'Entre su contraseña',
        '7' => 'Confirmación de contraseña:',
        '8' => 'Entre su contraseña de nuevo',
        '9' => 'Correo electrónico',
        '10' => 'Entre su correo electrónico',
        '11' => 'Nombre',
        '12' => 'Entre su nombre',
        '13' => 'Apellido(s)',
        '14' => 'Entre su(s) appelido(s)',
        '15' => 'Registrar',
      );
    }
    else{
      $translation = array(
        '1' => 'Account Information',
        '2' => 'This information is used to manage your account and for contact purposes.',
        '3' => 'Username:',
        '4' => 'Enter your username',
        '5' => 'Password:',
        '6' => 'Enter your password',
        '7' => 'Password Check:',
        '8' => 'Enter your password again',
        '9' => 'E-mail:',
        '10' => 'Enter your e-mail address',
        '11' => 'First Name:',
        '12' => 'Enter your First Name',
        '13' => 'Last Name:',
        '14' => 'Enter your Last Name',
        '15' => 'Register',
      );
    }

    // Set the page header
    $this->content .= '
    <!-- Actual Content -->
    <section class="content-section">

      <!-- Is inside a container -->
      <div class="w-container">
    ';
    
    if( $success ){
      // If we are using Spanish
      if( $_SESSION['language'] == 'es' ) {
        $this->content .= '
        <center><font color="green"><p>¡Tu registración fue exitosa!</p>
        <p>Pero, tu cuenta todavía no está activa.</p>
        <p>Por favor, revisa tu correo electrónico para seguir las instrucciones de activación.</p>
        <p>Verifica tu folder de Basura/Spam si no lo ves.</p></font>
        <p><a href="index.php?display=Login">Presiona aquí para iniciar sesión.</a></p></center></div></div>
        ';
      }
      else{
        $this->content .= '
        <center><font color="green"><p>Your registration was successful!</p>
        <p>However, your account is NOT active yet.</p>
        <p>Please, check your e-mail for activation instructions.</p>
        <p>Check your Junk/Spam Folder if you don\'t see it.</p></font>
        <p><a href="index.php?display=Login">Click here to Log In</a></p></center></div></div>
        ';
      }
    }
    else{
    $this->content .= '
        <!-- ACTUAL FORM -->
        <!-- PART 1: ACCOUNT INFORMATION -->
      
        <form class="login-form" enctype="multipart/form-data" method="POST"><center>
      
        <table>
      
        <tbody>
      
          <tr>
            <td colspan="2">
              <h2>' . $translation['1'] . '</h2>
              <p>' . $translation['2'] . '<hr></p>
            </td>
          </tr>
        
          <tr>
            <th class="required">' . $translation['3'] . ' *</th>
            <td>
              <input class="w-input" type="text" placeholder="' . $translation['4'] . '" name="username" value="';
                  
                  if( isset($_POST['username']) ){
                    $this->content .= $_POST['username'];
                  }
                  
      $this->content .= '">
            </td>
          </tr>
      
          <tr>
            <th class="required">' . $translation['5'] . ' *</th>
            <td>
              <input class="w-input" type="password" placeholder="' . $translation['6'] . '" name="password" value="';
              
                  if( isset($_POST['password']) ){
                    $this->content .= $_POST['password']; 
                  }
                  
                  $this->content .= '">
            </td>
          </tr>
      
          <tr>
            <th class="required">' . $translation['7'] . ' *</th>
            <td>
              <input class="w-input" type="password" placeholder="' . $translation['8'] . '" name="password-again" value="';
                  
                  if( isset($_POST['password-again']) ){
                    $this->content .= $_POST['password-again'];
                  }
                  
      $this->content .= '">
            </td>
          </tr>
      
          <tr>
            <th class="required">' . $translation['9'] . ' *</th>
            <td>
              <input class="w-input" type="text" placeholder="' . $translation['10'] . '" name="email" value="';
                  
                  if( isset($_POST['email']) ){
                    $this->content .= $_POST['email'];
                  }
                  
      $this->content .= '">
            </td>
          </tr>
      
          <tr>
            <th class="required">' . $translation['11'] . ' *</th>
            <td>
              <input class="w-input" type="text" placeholder="' . $translation['12'] . '" name="first-name" value="';
                  
                  if( isset($_POST['first-name']) ){
                    $this->content .= $_POST['first-name'];
                  }
                  
      $this->content .= '">
            </td>
          </tr>
      
          <tr>
            <th class="required">' . $translation['13'] . ' *</th>
            <td>
              <input class="w-input" type="text" placeholder="' . $translation['14'] . '" name="last-name" value="';
                  
                  if( isset($_POST['last-name']) ){
                    $this->content .= $_POST['last-name'];
                  }
                  
      $this->content .= '">
            </td>
          </tr>

          <tr>
            <td colspan="2" align="right">
            <input class="w-button" type="submit" value="' . $translation['15'] . '">
            </td>
          </tr>
        </tbody>
      
        </table>
      
        <br>
        <!-- Print an error message if necessary -->
        <font color="red">' . $_SESSION['error'];
    
        // Clear the error after showing it
        $_SESSION['error'] = '';
    }

    $this->content .= '
        </font>
        </center>
        </form>

      </div>

    </section>
    ';

    parent::Display();
  }

}

?>