<?php

class FAQs extends Page
{
  
  //------------------------- Attributes -------------------------
  private $db = null;

  public $content = '';
  public $pageTitle = "Frequently Asked Questions";
  public $title = "Donations Desk - Frequently Asked Questions";
  public $keywords = "Donations Desk, Frequently Asked Questions";
  
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
      $this->pageTitle = "Preguntas Frecuentes";
    }
    else{
      $this->pageTitle = "Frequently Asked Questions";
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
          <h3>Preguntas Generales</h3>

          <b>¿Qué es Donations Desk?</b><br>
          
          Donations Desk es una plataforma la cuál permite a las personas donar a asociaciones sin fines de lucro certificadas. En Donations Desk estas organizaciones también crean actividades de recaudación de fondos para necesidades en específico.<br><br>
          
          <b>¿Quién está detrás Donations Desk?</b><br>
          
          El equipo que está detrás de Donations Desk está compuesto por <a href="https://afc.pr/historia/" target="_blank">Asesores Financieros Comunitarios</a>.<br><br>
          
          
          <h3>Sobre las Organizaciones</h3>
          
          <b>¿Están todas las asociaciones certificadas?</b><br>
          
          Sí. Es requerido que todas las organizaciones estén certificadas primero antes de estar listadas en Donations Desk. También es requerido estar certificada para recibir donaciones.<br><br>
          
          <b>¿Cómo encuentro una actividad de recaudación de fondos ó cómo encuentro una organizacion?</b><br>
          
          Para encontrar cualquiera de estas, busque el icono en la parte derecha superior de la página.<br><br>
          
          <b>¿Por qué no puedo encontrar la organización que estoy buscando?</b><br>
          
          Hay requisitos que toda organización debe cumplir para poder estar activa en la plataforma. También si la organización no está listada puede que dicha organización no ha cumplido con estos requisitos o simplemente la organización todavía no conoce sobre Donations Desk. Si usted conoce alguna organización sin fines de lucro, por favor déjele saber sobre nuestra plataforma o contáctenos.<br><br>
          
          
          <h3>Preguntas de Recaudación de Fondos</h3>
          
          <b>¿Qué es una campaña de recaudación de fondos?</b><br>
          
          Las campañas de recaudación son actividades específicas que las organizaciones crean para recaudar fondos para un propósito en específico.<br><br>
          
          <b>¿Por qué hay un tiempo o fecha en las actividades de recaudación de fondos?</b><br>
          
          Las organizaciones crean una duración para recaudar la cual consideran es suficiente tiempo para poder recaudar el dinero que necesitan. Luego que llega la fecha que se provee, no se pueden hacer donaciones.<br><br>
          
          <b>¿Quién es responsable por completar las campañas?</b><br>
          
          La organización que creó la campaña es completamente responsable de las donaciones. Donations Desk no tiene responsabilidad sobre el dinero que estas organizaciones reciben por este portal ya que Donations Desk ó Asesores Financieros Comunitarios no maneja ninguna donación.<br><br>
          
          <b>¿Qué sucede si se recauda menos del dinero esperado y no se llega a la meta establecida?</b><br>
          
          Si la meta no es alcanzada, la organización retendrá el dinero donado. Cada campaña es importante y el dinero recaudado será de mucha ayuda.<br><br>
          
          
          <h3>Requisitos para Donar</h3>
          
          <b>¿Qué necesito para hacer una donación?</b><br>
          
          Se necesita activar una cuenta de Pay-Pal para donar.<br><br>
          
          <b>¿Cómo creo una cuenta de Pay-Pal?</b><br>
          
          Crear una cuenta en Pay-Pal es fácil. Sólo visite la <a href="http://www.paypal.com">página web</a> de PayPal y siga las instrucciones.<br><br>
          
          <b>¿Por qué necesito crear una cuenta de Pay-Pal?</b><br>
          
          Cuando creas una cuenta en Pay-Pal, la transacción efectuada es segura. Usted también puede tener detalles de las transacciones efectuadas disponibles en esta cuenta.<br><br>
          
          
          <h3>Preguntas sobre Donaciones</h3>
          
          <b>¿A dónde va mi donación?</b><br>
          
          El dinero donado llega directamente a la organización sin fines de lucro que usted escogió donar.<br><br>
          
          <b>¿Cómo mi donación ayuda?</b><br>
          
          Las donaciones ayudan a organizaciones sin fines de lucro a cumplir su misión, a sobrevivir, a ayudar a comunidades a resolver problemas y dan al ciudadano una voz.<br><br>
          
          <b>¿Cuál es el costo de donar o recibir donaciones?</b><br>
          
          No hay costo para hacer donaciones ni recibir donaciones de donantes.<br><br>
          
          <b>¿Es mi donación segura?</b><br>
          
          Sí. Donations Desk usa Pay-Pal para manejar las donaciones. Pay-Pal provee un método seguro para enviar y recibir dinero.<br><br>
          
          <b>¿Cómo la organización recibe el dinero que se dona?</b><br>
          
          Luego de que un usuario ha donado usando Pay-Pal, el dinero es enviado directamente a la asociación por medio de Pay-Pal. Cada organización tiene una cuenta de Pay-Pal confirmada la cual es utilizada para recibir dinero y retirarlo. Al hacer una donación, las organizaciones reciben un correo electrónico confirmando que una donación fue realizada.<br><br>
          
          <b>¿Cuándo una organización recibe el dinero?</b><br>
          
          La organización recibirá confirmación de la donación tan pronto se complete la donación por medio de Pay-Pal. Todas las donaciones son procesadas al momento pero puede tomar de 2-3 días en que los fondos estén disponibles. El dinero es acreditado en la cuenta de la asociación para su uso y para ser retirado.<br><br>
          
          <b>¿Mi donación se puede deducir?</b><br>
          
          Sí. Las donaciones a organizaciones sin fines de lucro que cualifiquen bajo el IRS se pueden deducir. Siempre guarde todos los recibos de cada donación efectuada.
      ';
    }
    else
    {
      $this->content .= '
          <h3>Overview</h3>

          <b>What is Donations Desk?</b><br>

          Donations Desk is a website and mobile application platform which allows people to donate to certified non-for-profit organizations.
          In Donations Desk, these organizations also create fundraising activities to raise money.<br><br>

          <b>What is a NFPO?</b><br>

          Donations Desk can use this acronym to refer to a non-for-profit organization.<br><br>

          <b>Who is behind Donations Desk?</b><br>

          The team behind Donations Desk is composed by Asesores Financieros Comunitarios. Find more about Asesores Financieros Comunitarios by <a href="https://afc.pr/historia/" target="_blank">clicking here</a>.<br>

          <h3>About the Organizations</h3>

          <b>Are all the Non-For-Profit Organizations certified?</b><br>

          Yes. There is a requirement for all non-for-profit organizations to be certified first to be listed at Donations Desk and therefore receive donations.<br><br>

          <b>How do I find a fundraising or non-for-profit organization?</b><br>

          To find a fundraiser or organization, use the menu bar in the upper right corner of the website/application.  There is a link for each category.  Once inside the specific section, you will be able to search the listings.<br><br>

          <b>Why can\'t I find the non-for-profit organization I am looking for?</b><br>

          There are requirements that all non-for-profit organizations need to meet to be able to be active in our website. If the organization is not listed, either, they didn\'t meet the requirements or the organization doesn\'t know about Donations Desk. If you know any non-for-profit organization that might not know about us, please let them know about our website or contact us.<br><br>

          <h3>Fundraising Activity Questions</h3>

          <b>What is a fundraiser campaign?</b><br>

          Fundraiser campaings are specific activities that non-for-profit organizations create to raise money for a specific or special purpose.<br><br>

          <b>Why is there a time frame for the fundraiser campaigns?</b><br>

          Non-for-profit organizations create a time frame in which they consider there is enough time to raise the donations they need. After the time frame is reached no donations can be made or received.<br><br>

          <b>Who is responsible for completing a fundraiser campaign project as promised?</b><br>

          The non-for-profit that created the campaign is fully responsible for the donations and the active campaign. Donations Desk does not manage the money received by the organizations and does not manage campaigns.<br><br>

          <b>What happens if a fundraiser campaign goal is not achieved?</b><br>

          Fundraiser campaings are directly created and managed by the non-for-profit organization that created the campaign. Donations Desk does not create or manage fundraising campaigns on its own.<br><br>

          <b>What happens if a fundraiser campaign goal is not achieved?</b><br>

          If a fundraiser campaign goal is not achieved, the non-for-profit organization will keep the money. Any campaign is important and the money will be used wisely.<br><br>

          <h3>Requirements to Donate</h3>

          <b>Do I need an account to make a donation?</b><br>

          Yes. You need an active Pay-Pal account to donate.<br><br>

          <b>How I do create a Pay-Pal account?</b><br>

          Creating a Pay-Pal account is easy. Just visit Pay-Pal\'s <a href="http://www.paypal.com" target="_blank">webpage</a> and follow the instructions.<br><br>

          <b>Why do I need to create a Pay-Pal account?</b><br>

          When you create a Pay-Pal account, the money transaction you manage is <b><i>secure</i></b>. You can also have history of transactions available at this account.<br><br>

          <h3>Donation Questions</h3>

          <b>Where does my money go?</b><br>

          The money goes to the organization you donate.<br><br>

          <b>How does my donation help?</b><br>

          Donations help non-for-profit organizations to meet their mission, to survive, to help communities to solve problems, and give citizens a voice.<br><br>

          <b>Are there any fees?</b><br>

          There is no fee for donating or creating a fundraising event.<br><br>

          <b>Is my donation secure?</b><br>

          Yes. Donations Desk uses Pay-Pal to manage donations. Pay-Pal is proved to be a secure method to send and receive money.<br><br>

          <b>How the non-for-profit organizations get the donated money?</b><br>

          After a user has donated using Pay-Pal, the money is sent to the non-for-profit\'s Pay-Pal accounts. They will also receive an email letting the organization know they received a donation.<br><br>

          <b>When does the non-for-profit organization gets the money?</b><br>

          The organization will get the money as soon as the donation is completed by Pay-Pal. The money is credited to their account for further use and withdrawal.<br><br>

          <b>Is my donation tax-deductible?</b><br>

          Yes. Donations to non-for-profit organizations are qualified by the IRS are deductible. To deduct any donation save the receipts.';
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