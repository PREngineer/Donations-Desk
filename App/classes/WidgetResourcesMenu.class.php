<?php

class WidgetResourcesMenu
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
      $translation = array(
        '1' => 'Preguntas Frecuentes',
        '2' => 'Centro de Ayuda',
        '3' => 'Acerca de Nosotros',
        '4' => 'Contáctenos',
      );
    }
    else{
      $translation = array(
        '1' => 'F.A.Q.',
        '2' => 'Help Center',
        '3' => 'About Us',
        '4' => 'Contact Us',
      );
    }

    $this->content = '
    <div class="w-col w-col-3">
      <a class="w-nav-link" href="index.php?display=FAQs">' . $translation[1] . '</a><br>
      <a class="w-nav-link" href="index.php?display=Help">' . $translation[2] . '</a><br>
      <a class="w-nav-link" href="index.php?display=AboutUs">' . $translation[3] . '</a><br>
      <a class="w-nav-link" href="index.php?display=ContactUs">' . $translation[4] . '</a>
    </div>
    ';

    return $this->content;
  }

}