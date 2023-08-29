<?php

class WidgetLanguageChange
{
  
  //------------------------- Attributes -------------------------
  public $content = "";
  
  //------------------------- Operations -------------------------
  
  /**
   * __construct
   *
   * @return void
   */
  public function __construct()
  {

  }

  /**
   * Display - Shows the actual widget
   *
   * @return void
   */
  public function Display()
  {
    // If we are using Spanish
    if( $_SESSION['language'] == 'es' ) {
      $this->content .= '
      <center>
        <a href="index.php?lang=en"><img src="images/es.png" alt="Switch to English" title="Switch to English" height="50" width="50"></a>
      </center>
      ';
    }
    // If we are using English
    else{
      $this->content = '
      <center>
        <a href="index.php?lang=es"><img src="images/en.png" alt="Cambiar a Español" title="Cambiar a Español" height="50" width="50"></a>
      </center>
      ';
    }

    return $this->content;
  }
}

?>

