<?php

class AboutUS extends Page
{
  
  //------------------------- Attributes -------------------------
  private $db = null;

  public $content = '';
  public $pageTitle = "About Us";
  public $title = "Donations Desk - About Us";
  public $keywords = "Donations Desk, About Us";
  
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
      $this->pageTitle = "Acerca de Nosotros";
    }
    else{
      $this->pageTitle = "About Us";
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
          <h2>Asesores Financieros Comunitarios</h2>

          <h3>Mission</h3>
          <div>
          <p>
          Provee a las Organizaciones sin fines de lucro de la comunidad en Puerto Rico las herramientas para
          manejarse correctamente, provee entrenamiento y servicios de consultoría en las áreas de contabilidad,
          administración y cumplimiento, a través de nuestro grupo de voluntarios, CPA, estudiantes de universidad y
          profesionales.
          </p>
          </div>


          <h3>Visión</h3>
          <div>
          <p>
          Lograr la sustentabilidad económica de organizaciones sin fines de lucro
          para mejorar nuestra calidad de vida.
          </p>
          </div>


          <h3>Equipo de Trabajo</h3>
          <div>
          <p>
          Conozca nuestro equipo:
          </p>
          <ul>
            <li>Sonia Carrasquillo</li>
            <li>Ismael Ortíz</li>
            <li>Linda de Jesús</li>
          </ul>
          </div>
      ';
    }
    else
    {
      $this->content .= '
        <h2>Asesores Financieros Comunitarios</h2>

        <h3>Mission</h3>
        <div>
        <p>
        Empowering non-profit community-based organizations of Puerto Rico to achieve 
        sound management, providing training and consulting services 
        in areas of accounting, administration and compliance, 
        through our team of volunteers, CPA, professionals and 
        college students.
        </p>
        </div>


        <h3>Vision</h3>
        <div>
        <p>
        Achieving economic 
        sustainability of non-profit 
        organizations to improve our quality of life.
        </p>
        </div>


        <h3>Staff</h3>
        <div>
        <p>
        Meet our team:
        </p>
        <ul>
          <li>Sonia Carrasquillo</li>
          <li>Ismael Ortíz</li>
          <li>Linda de Jesús</li>
        </ul>
        </div>
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