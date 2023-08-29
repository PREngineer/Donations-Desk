<?php

class ContactUS extends Page
{
  
  //------------------------- Attributes -------------------------
  private $db = null;

  public $content = '';
  public $pageTitle = "Contact Us";
  public $title = "Donations Desk - Contact Us";
  public $keywords = "Donations Desk, Contact Us";
  
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
      $this->pageTitle = "Contáctanos";
    }
    else{
      $this->pageTitle = "Contact Us";
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

        <!-- Column #1 (1/3 of page width) - Content -->
        <div class="w-col w-col-5 block">';

    if( $_SESSION['language'] == 'es' )
    {
      $this->content .= '
          <!-- Google Maps Location -->
          <h3>Nuestra Localización:</h3>
          <div id="map">
            <iframe width=\'300\' height=\'400\' style=\'border: 0px solid #000000\' 
            src=\'http://maps.google.com/?q=18.422896,-66.07026&z=16&output=embed&hl=en&t=h\'></iframe>
          </div>
        </div>

        <!-- Column #2 (1/3 of page width) - Content -->
        <div class="w-col w-col-4">
          <!-- Contact Information -->
          <div>
          <h3>Nuestro Número de Teléfono:</h3>

          <p><strong>Oficina Administrativa:</strong>
            <br/>787.455.9133<br/>
            <br/><strong>Via Fax:</strong>
            <br/>787.455.9134</p>
          </div>

          <div>
          <h3>Via E-mail:</h3>
          <br/><strong><a href="mailto:info@afc.pr?Subject=Contact%20-%20Donations%20Desk" target="_top">info@afc.pr</a></strong>
          </div>

          <div>
          <h3>Dirección Física:</h3>
          <br/><strong>Anexo Fundación Ángel Ramos
          <br/>Ave. FD Roosevelt #383
          <br/>San Juan, PR 00918</strong>
          </div>

          <div>
          <h3>Dirección Postal:</h3>
          <br/><strong>PO BOX 192726
          <br/>San Juan PR 00919-2726</strong>
          </div>
      ';
    }
    else
    {
      $this->content .= '
          <!-- Google Maps Location -->
          <h3>Our Location:</h3>
          <div id="map">
            <iframe width=\'300\' height=\'400\' style=\'border: 0px solid #000000\' 
            src=\'http://maps.google.com/?q=18.422896,-66.07026&z=16&output=embed&hl=en&t=h\'></iframe>
          </div>
        </div>

        <!-- Column #2 (1/3 of page width) - Content -->
        <div class="w-col w-col-4">
          <!-- Contact Information -->
          <div>
          <h3>Our Telephone Number:</h3>

          <p><strong>Administrative Office:</strong>
            <br/>787.455.9133<br/>
            <br/><strong>Via Fax:</strong>
            <br/>787.455.9134</p>
          </div>

          <div>
          <h3>Via E-mail:</h3>
          <br/><strong><a href="mailto:info@afc.pr?Subject=Contact%20-%20Donations%20Desk" target="_top">info@afc.pr</a></strong>
          </div>

          <div>
          <h3>Physical Address:</h3>
          <br/><strong>Anexo Fundación Ángel Ramos
          <br/>Ave. FD Roosevelt #383
          <br/>San Juan, PR 00918</strong>
          </div>

          <div>
          <h3>Postal Address:</h3>
          <br/><strong>PO BOX 192726
          <br/>San Juan PR 00919-2726</strong>
          </div>
      ';
    }

    $this->content .= '
        </div>
          
        <!-- Column #3 (1/3 of page width) - Sub-Menu -->';
        
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