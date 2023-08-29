<?php

class Resources extends Page
{
  
  //------------------------- Attributes -------------------------
  private $db = null;

  public $content = '';
  public $pageTitle = "Resources";
  public $title = "Donations Desk - Resources";
  public $keywords = "Donations Desk, Resources";
  
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
      $this->pageTitle = "Recursos";
    }
    else{
      $this->pageTitle = "Resources";
    }
    parent::__construct();
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
    // If we are using Spanish
    if( $_SESSION['language'] == 'es' ) {
      $translation = array(
        '1' => 'Para usar los recursos de la página, navegue utilizando en sub-menú provisto.',
        '2' => 'Preguntas Frecuentes',
        '3' => 'Centro de Ayuda',
        '4' => 'Acerca de Nosotros',
        '5' => 'Contáctenos',
      );
    }
    else{
      $translation = array(
        '1' => 'To use the Website\'s resources navigate with the provided sub-menu.',
        '2' => 'F.A.Q.',
        '3' => 'Help Center',
        '4' => 'About Us',
        '5' => 'Contact Us',
      );
    }

    $this->content .= '
    <!-- Actual Content -->
    <section class="content-section">
      <!-- Is inside a container -->
      <div class="w-container">
        <!-- With 2 columns -->
        <div class="w-row">

          <!-- Column #1 (2/3 of page width) - Content -->
          <div class="w-col w-col-9">
            <p class="subtitle-paragraph">' . $translation[1] . '</p>
          </div>
          
          <!-- Column #2 (1/3 of page width) - Sub-Menu -->';
        
          // Add the Resources Menu
          $menu = new WidgetResourcesMenu();
          $this->content .= $menu->Display();
      
          $this->content .= '
          
        </div>

      </div>

    </section>
    ';

    parent::Display();
  }

}

?>