<?php

class Help extends Page
{
  
  //------------------------- Attributes -------------------------
  private $db = null;

  public $content = '';
  public $pageTitle = "Help";
  public $title = "Donations Desk - Help";
  public $keywords = "Donations Desk, Help";
  
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
      $this->pageTitle = "Ayuda";
    }
    else{
      $this->pageTitle = "Help";
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
    $this->content .= '
    <!-- Actual Content -->
    <section class="content-section">
      <!-- Is inside a container -->
      <div class="w-container">
        <!-- With 2 columns -->
        <div class="w-row">

        <!-- Column #1 (2/3 of page width) - Content -->
        <div class="w-col w-col-9">';

    if( $_SESSION['language'] == 'es' )
    {
      $this->content .= '
          <p>
          Aquí encontrará algunos documentos que le ayudarán a entender como funciona este sitio web y la aplicación Androide, como instalarla y
          como navegarlos.
          </p>
          
          <p>
            <a href="manuals/APK-Instalacion.pdf" target="_blank">Instalación del APK</a> - Manual de Instalación de la Aplicación Androide.
          </p>

          <p>
            <a href="manuals/Mobile.pdf" target="_blank">Manual de App Androide</a> - Le enseña a entender la aplicación y como navegarla.
          </p>

          <p>
            <a href="manuals/WebManualVisitor.pdf" target="_blank">Manual Web - Visitante</a> - Le enseña a entender el sitio web y como navegarlo y usar sus características.
          </p>

          <p>
            <a href="manuals/WebManualNFPO.pdf" target="_blank">Manual Web - OSFL</a> - Le enseña a entender el sitio web y como navegarlo y usar sus características.
          </p>
      
          <p>
            <a href="manuals/WebManualAdmin.pdf" target="_blank">Manual Web - Administrador</a> - Le enseña a entender el sitio web y como navegarlo y usar sus características.
          </p>
      ';
    }
    else
    {
      $this->content .= '
          <p>
          Here are a few documents that will help you understand how this Website and our Android App work, how to install and 
          how to Navigate them.
          </p>
          
          <p>
            <a href="manuals/APK-Installation.pdf" target="_blank">APK Installation</a> - Android Application 
            Installation Manual.
          </p>

          <p>
            <a href="manuals/Mobile.pdf" target="_blank">Android App Manual</a> - Helps you understand the app and 
            how to navigate it.
          </p>

          <p>
            <a href="manuals/WebManualVisitor.pdf" target="_blank">Web Manual - Visitor</a> - Helps you understand the Website and how to navigate 
            it and used its features.
          </p>

          <p>
            <a href="manuals/WebManualNFPO.pdf" target="_blank">Web Manual - NFPO</a> - Helps you understand the Website and how to navigate 
            it and used its features.
          </p>

          <p>
            <a href="manuals/WebManualAdmin.pdf" target="_blank">Web Manual - Administrator</a> - Helps you understand the Website and how to navigate 
            it and used its features.
          </p>
      ';
    }

    $this->content .= '
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