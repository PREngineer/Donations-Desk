<?php

class Login extends Page
{
  
  //------------------------- Attributes -------------------------
  private $db = null;

  public $content = '';
  public $pageTitle = "Login";
  public $title = "Donations Desk - Login";
  public $keywords = "Donations Desk, login";
  
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
      $this->pageTitle = "Iniciar Sesión";
    }
    else{
      $this->pageTitle = "Login";
    }
    parent::__construct();
  }

  /**
   * getUserID - Retrieves the UserID number.
   *
   * @param string $username
   *
   * @return void
   */
  private function getUserID( $username )
  {
    // Check if the username & password combination exists
    $check = $this->db->query_DB("SELECT id
                                  FROM Accounts
                                  WHERE username = '" . $posted['username'] . "'");
    
    return $check[0]['id'];
  }

  /**
   * handlePOST - Takes control of the action once the form is posted.
   *
   * @param  mixed $posted
   *
   * @return void
   */
  private function handlePOST( $posted )
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
    }
    // If the username doesn't exists
    else if( !$this->user_exists($_POST['username'] ) )
    {
      // Set error message
      if( $_SESSION['language'] == 'es' ){
        $_SESSION['error'] = 'Información inválida.  Por favor, regístrese.';
      }
      else{
        $_SESSION['error'] = 'Invalid Information. Please register.';
      }
    }
    // If the account is not active yet
    else if( !$this->user_active($_POST['username']) )
    {
      // Set error message
      if( $_SESSION['language'] == 'es' ){
        $_SESSION['error'] = 'Tu cuenta no ha sido activada todavía.  
        Las instrucciones deben estar en tu correo electrónico.<br><a href="resend-email.php?username=' . $_POST['username'] . '">Re-enviar correo de activación</a>';
      }
      else{
        $_SESSION['error'] = 'Your account has not been activated yet.  
        Check your e-mail for activation instructions.<br><a href="resend-email.php?username=' . $_POST['username'] . '">Resend activation e-mail</a>';
      }
    }
    // Information provided
    else
    {
      $success = $this->login( $posted );
      
      if( $success )
      {
        // Set the User Session, session has the user id number, username, role, and name
        $this->setupCookie( $posted['username'] );
        
        // Redirect user to MyAccount
        header('Location: index.php?display=MyAccount');
      }
      else
      {
        $_SESSION['error'] = 'The combination provided is incorrect.';
      }
    }
  }

  /**
   * login - Handles the login validation when using in App authentication.
   *
   * @param  mixed $posted
   *
   * @return void
   */
  private function login( $posted )
  {
    // Encrypt password with MD5->SHA1->SHA256
    $password = MD5( $posted['password'] );

    // Check if the username & password combination exists
    $check = $this->db->query_DB("SELECT COUNT(username) AS Count
                                  FROM Accounts
                                  WHERE username = '" . $posted['username'] . "'
                                  AND password   = '" . $password           . "'");
    
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
   * setupCookie - Create the cookie for this session.
   *
   * @param  mixed $data
   *
   * @return void
   */
  private function setupCookie( $username )
  {
    // Get the user's details
    $check = $this->db->query_DB("SELECT *
                                  FROM Accounts
                                  WHERE username = '" . $username . "'")[0];

    // Initialize the session
    if( !isset( $_SESSION ) )
    {
      session_start();
    }
    
    $_SESSION['user_id']    = $check['id'];
    $_SESSION['userName']   = $check['username'];
    $_SESSION['userRole']   = $check['role'];
    $_SESSION['fname']      = $check['first-name'];
    $_SESSION['lname']      = $check['last-name'];

    // Extend cookie life time
    // A month in seconds = 30 days * 24 hours * 60 mins * 60 secs
    $cookieLifetime = 30 * 24 * 60 * 60;
    setcookie("Donations Desk", session_id(), time() + $cookieLifetime);

    return True;
  }

  /**
   * user_active - Checks whether a username provided is active.
   * 
   * @param string
   * 
   * @return bool
   */
  private function user_active( $username ){
    // Check if the username & password combination exists
    $check = $this->db->query_DB("SELECT active
                                  FROM Accounts
                                  WHERE username = '" . $username . "'");
    
    if( $check[0]['active'] == 1 )
    {
      return True;
    }
    else
    {
      return False;
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
   * Display - Displays the full page
   *
   * @param  mixed $filter
   *
   * @return void
   */
  public function Display()
  {
    // Handle data and give feedback
    if( isset( $_POST['username'] ) )
    {
      $this->handlePOST( $_POST );
    }

    // If we are using Spanish
    if( $_SESSION['language'] == 'es' ) {
      $translation = array(
        '1' => 'Esta Sección es solamente para Organizaciones Sin Fines de Lucro',
        '2' => 'Dentro de Mi Cuenta puedes:',
        '3' => 'Manejar la información de tu cuenta',
        '4' => 'Manejar la información de tu Organización Sin Fines de Lucro',
        '5' => 'Manejar las campañas de tu Organización Sin Fines de Lucro',
        '6' => 'Debes registrar tu Organización Sin Fines de Lucro antes de poder utilizar estas funciones.',
        '7' => '¡Hola, Visitante!',
        '8' => 'Usuario',
        '9' => 'Contraseña',
        '10' => 'Iniciar Sesión',
        '11' => 'Registrarse',
        '12' => 'Olvidé mi contraseña',
      );
    }
    else{
      $translation = array(
        '1' => 'This Section is only for Non-For Profit Organizations',
        '2' => 'Within My Account you can:',
        '3' => 'Manage your Account Information',
        '4' => 'Manage your Non-For Profit Organization\'s information',
        '5' => 'Manage your Non-For Profit Organization\'s campaigns',
        '6' => 'You must register your Non-For Profit Organization before you can use these features.',
        '7' => 'Hello, Visitor!',
        '8' => 'Username',
        '9' => 'Password',
        '10' => 'Log in',
        '11' => 'Register',
        '12' => 'Forgot Password',
      );
    }

    $this->content .= '
    <!-- Section -->
    <section class="content-section">
      <!--  -->
      <div class="w-container">
        <!--  -->
        <div class="w-row">

          <!-- Column #1 (2/3 of page width) - Content -->
          <div class="w-col w-col-9">
            <h4><font color="red">' . $translation['1'] . '</font></h4><br>
            <p>' . $translation['2'] . '</p>
            <ul class="unordered-list">
              <li>' . $translation['3'] . '</li>
              <li>' . $translation['4'] . '</li>
              <li>' . $translation['5'] . '</li>
            </ul>
            <p>' . $translation['6'] . '</p>
          </div>

          <!-- Column #2 (1/3 of page width) - Login Form -->
          <div class="w-col w-col-3">

          <h4>' . $translation['7'] . '</h4><br>

          <div class="w-form">
            
            <form class="login-form" method="POST">
              <label for="username">' . $translation['8'] . '</label>
              <input class="w-input" type="text" placeholder="Enter your username" name="username">
              <label for="password">' . $translation['9'] . '</label>
              <input class="w-input" type="password" placeholder="Enter your password" name="password">
              <input class="w-button" type="submit" value="' . $translation['10'] . '">
              <br>
            </form>
            <a href="index.php?display=Register">' . $translation['11'] . '</a><br>
            <a href="index.php?display=ForgotPassword">' . $translation['12'] . '</a>
            <br>
            
            <br>
            <!-- Print an error message if necessary -->
            <font color="red">' . $_SESSION['error'] . '
            </font>
          </div>

          </div>

        </div>

      </div>

    </section>
    ';

    // Clear the error after showing it
    $_SESSION['error'] = '';

    parent::Display();
  }

}

?>