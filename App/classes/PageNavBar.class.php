<?php

class PageNavBar
{
  //------------------------- Attributes -------------------------
  public $content = null;
    
  //------------------------- Operations -------------------------
  
  /**
   * __construct
   *
   * @return void
   */
  public function __construct()
  {}
  
  /**
   * Spanish - Returns the Spanish values
   *
   * @return array
   */
  private function Spanish()
  {
    return array('campaigns' => 'Campañas', 'nfpos' => 'Organizaciones', 'resources' => 'Recursos', 
                 'account' => 'Mi Cuenta', 'login' => 'Iniciar Sesión', 'logout' => 'Cerrar Sesión');
  }

  /**
   * English - Returns the English values
   *
   * @return array()
   */
  private function English()
  {
    return array('campaigns' => 'Campaigns', 'nfpos' => 'Organizations', 'resources' => 'Resources', 
                 'account' => 'My Account', 'login' => 'Log in', 'logout' => 'Log Out');
  }

  /**
   * Display - Returns the HTML of the NavBar
   *
   * @return string NavBar
   */
  public function Display()
  {
    // Get the appropriate language
    if( $_SESSION['language'] == 'es' ) {
      $translations = $this->Spanish();
    }
    else{
      $translations = $this->English();
    }

    $this->content .= '
    <header class="header-section">

      <div class="w-container">
        <div class="w-row">
          
          <div class="w-col w-col-3">
            <img class="header-logo" src="images/Donations Desk Logo.png" alt="Donation&apos;s Desk Logo" width="200">
          </div>
    
          <div class="w-col w-col-9">
            <div class="w-nav" data-collapse="medium" data-animation="default" data-duration="400" data-contain="1">
              <div class="w-container menu-bar">
                <nav class="w-nav-menu" role="navigation">
                  <a class="w-nav-link" href="index.php">' . $translations['campaigns'] . '</a>
                  <a class="w-nav-link" href="index.php?display=NFPOs">' . $translations['nfpos'] . '</a>
                  <a class="w-nav-link" href="index.php?display=Resources">' . $translations['resources'] . '</a>';
                  
                  if( isset($_SESSION['user_id']) )
                  {
                    $this->content .= '<a class="w-nav-link" href="index.php?display=MyAccount">' . $translations['account'] . '</a>
                    <a class="w-nav-link" href="index.php?display=LogOut">' . $translations['logout'] . '</a>';
                  }
                  else
                  {
                    $this->content .= '<a class="w-nav-link" href="index.php?display=Login">' . $translations['login'] . '</a>';
                  }
                  
    $this->content .= '
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
    ';

    return $this->content;
  }

}

?>