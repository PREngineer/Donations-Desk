<?php

class NFPODetails extends Page
{
  
  //------------------------- Attributes -------------------------
  private $db = null;

  public $content = '';
  public $pageTitle = "Non For Profit Details";
  public $title = "Donations Desk - Non For Profit Details";
  public $keywords = "Donations Desk, Non For Profit Details";
  
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
      $this->pageTitle = "Detalles de Organización Sin Fines de Lucro";
    }
    else{
      $this->pageTitle = "Non For Profit Details";
    }
    parent::__construct();
  }

  /**
   * get_ratings - Returns the amount of ratings given to this NFPO.
   * 
   * @param int
   * 
   * @return array
   */
  public function get_ratings( $id ){
    return $this->db->query_DB("SELECT COUNT(`r1`) as total, SUM(`r1`) as r1, SUM(`r2`) as r2, SUM(`r3`) as r3, 
                                SUM(`r4`) as r4, SUM(`r5`) as r5, SUM(`r6`) as r6, SUM(`r7`) as r7 
                                FROM `ratings` 
                                WHERE `id` = " . $id)[0];
  }

  /**
   * nfpo_details - Returns the data of the specified NFPO.
   * 
   * @param int
   * 
   * @return array
   */
  public function nfpo_details( $id ){
    return $this->db->query_DB("SELECT * 
                                FROM `OSFL` 
                                WHERE `id` = $id")[0];
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
    // Get the NFPO's details
    $nfpodetails = $this->nfpo_details( $_GET['id'] );
    // Get this NFPO's ratings
    $values = $this->get_ratings( $_GET['id'] );
    // Multiply the total of entries by 5 maximum stars
    $total = $values['total'] * 5;
    // If no ratings
    if( $total == 0 ){
      $total = 1;
    }
    // Calculate the ratings
    $r1 = round( ( ($values['r1'] / $total) * 5), 0);
    $r2 = round( ( ($values['r2'] / $total) * 5), 0);
    $r3 = round( ( ($values['r3'] / $total) * 5), 0);
    $r4 = round( ( ($values['r4'] / $total) * 5), 0);
    $r5 = round( ( ($values['r5'] / $total) * 5), 0);
    $r6 = round( ( ($values['r6'] / $total) * 5), 0);
    $r7 = round( ( ($values['r7'] / $total) * 5), 0);

    // Translations
    if( $_SESSION['language'] == 'es' )
    {
      $translation = array(
        '1' => 'Comparte ésta página:',
        '2' => 'Comparte nuestras redes:',
        '3' => 'Fundada:',
        '4' => 'Evaluaciones',
        '5' => '¡Evaluar!',
        '6' => 'Atmósfera:',
        '7' => 'Atención:',
        '8' => 'Costo:',
        '9' => 'Localización:',
        '10' => 'Organización:',
        '11' => 'Calidad de Servicio:',
        '12' => 'Rapidez:',
        '13' => 'Donde Donar',
        '14' => 'Presiona el botón para donar ahora utilizando PayPal.',
        '15' => 'O dona utilizando su cuenta de banco:',
        '16' => 'Persona Contacto',
        '17' => 'Esta persona puede contestar cualquier duda que tengas.',
        '18' => 'Nombre:',
        '19' => 'Teléfono:',
        '20' => 'Correo Electrónico:',
        '21' => 'Escríbanos a:',
        '22' => 'Acerca de Nuestra Organización',
        '23' => 'Estamos categorizados como:',
        '24' => 'Proveemos los siguientes servicios:',
        '25' => 'Nuestro público impactado es:',
        '26' => 'Cumplimos con los estándares y recibimos apoyo económico de:',
        '27' => 'Nuestro Propósito',
        '28' => 'Nuestra Misión:',
        '29' => 'Nuestra Visión:',
        '30' => 'Proyecciones a Largo Plazo:',
        '31' => 'Documentación Oficial',
        '32' => 'Esta documentación prueba que la Organización está legalmente establecida.  También, provee información al público de las finanzas de la misma.',
        '33' => 'Seguro Social Patronal:',
        '34' => 'Buen Estado',
        '35' => 'Incripción del Departamento de Estado',
        '36' => 'Formulario Federal Financiero 990',
        '37' => 'Auditoría',
        '38' => 'Excepción Estatal',
        '39' => 'Excepción Federal',
        '40' => 'Nuestra Localización y Facilidades',
        '41' => 'Nuestra Dirección Física:',
        '42' => 'Mapa de Google:',
      );
    }
    else
    {
      $translation = array(
        '1' => 'Share this page:',
        '2' => 'Share out Social Media:',
        '3' => 'Incorporated:',
        '4' => 'Ratings',
        '5' => 'Rate!',
        '6' => 'Atmosphere:',
        '7' => 'Attention:',
        '8' => 'Cost:',
        '9' => 'Locale:',
        '10' => 'Organization:',
        '11' => 'Quality of Service:',
        '12' => 'Quickness:',
        '13' => 'Where to Donate',
        '14' => 'Press the button below to donate using PayPal.',
        '15' => 'Or donate using their bank account:',
        '16' => 'Contact Person',
        '17' => 'This person can answer any question you may have.',
        '18' => 'Name:',
        '19' => 'Telephone:',
        '20' => 'E-mail:',
        '21' => 'Write to us here:',
        '22' => 'About Our Organization',
        '23' => 'We are categorized as:',
        '24' => 'We provide the following services:',
        '25' => 'We impact the following public:',
        '26' => 'We comply with all standards and receive economic support from:',
        '27' => 'Our Purpose',
        '28' => 'Our Mission:',
        '29' => 'Our Vision:',
        '30' => 'Long Term Projections:',
        '31' => 'Official Documentation',
        '32' => 'This documentation proves that the Organization is legitimate.  It also serves to inform the public about its finances.',
        '33' => 'Employer Social Security:',
        '34' => 'Good Standing',
        '35' => 'Department Of State Registration',
        '36' => '990 Federal Financial Form',
        '37' => 'Audit',
        '38' => 'State Exemption',
        '39' => 'Federal Exemption',
        '40' => 'Our Location and Facilities',
        '41' => 'Our Physical Address:',
        '42' => 'Google Maps:',
      );
    }

    $this->content .= '
      <!-- Actual Content -->
      <section class="content-section">
        <!-- Is inside a container -->
        <div class="w-container">

          <!-- First Table - Socials, NFPO Name, NFPO Incorporation, NFPO Ratings -->
          <table align="center" style="width:100%">
            <tbody>

            <!-- Sharing headers -->
            <tr>
              <th align="center">
              ' . $translation[1] . '
              </th>
              <th align="center">
              ' . $translation[2] . '
              </th>
            </tr>

            <!-- Social Media Links -->
            <tr>
              <!-- SOCIAL MEDIA BUTTONS of this page -->
              <td style="text-align: center; vertical-align: middle;">
                <!-- FB Like Page -->
                <div class="fb-like" data-href="' . curPageURL() . '" data-layout="button" data-action="like" data-show-faces="true" data-share="true"></div>

                <!-- Twitter API connection and widget -->
                <a href="https://twitter.com/share" style="display: inline-flex !important;" class="twitter-share-button" data-url="' . curPageURL() . '" data-text="Check out this Organization">Tweet</a>
                <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?\'http\':\'https\';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+\'://platform.twitter.com/widgets.js\';fjs.parentNode.insertBefore(js,fjs);}}(document, \'script\', \'twitter-wjs\');</script>
              </td>
              
              <!-- SOCIAL MEDIA BUTTONS - Show them if provided -->
              <td style="text-align: center; vertical-align: middle;">';
                 
    // If facebook provided
    if( $nfpodetails['facebook'] != '' )
    {
      $this->content .= '
                <!-- FB Like Page -->
                <div class="fb-like" data-href="' . $nfpodetails['facebook'] . '" data-layout="button" data-action="like" data-show-faces="true" data-share="true"></div>';
    }
    // If twitter provided
    if( $nfpodetails['twitter'] != '' )
    {
      $this->content .= '
                <!-- Twitter API connection and widget -->
                <a href="https://twitter.com/share" style="display: inline-flex !important;" class="twitter-share-button" data-url=" ' . $nfpodetails['twitter'] . '" data-text="Check out this Organization">Tweet</a>
                <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?\'http\':\'https\';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+\'://platform.twitter.com/widgets.js\';fjs.parentNode.insertBefore(js,fjs);}}(document, \'script\', \'twitter-wjs\');</script>';
    }
    // If youtube provided
    if( $nfpodetails['youtube'] != '' )
    {
      $this->content .= '
                <!-- Youtube and Website links -->
                <a href="' . $nfpodetails['youtube'] . '" style="display: inline-flex !important;" target="_blank"><img src="../images/youtube.png"></a>';
    }
    // If website provided
    if( $nfpodetails['website'] != '' )
    {
      $this->content .= '
                <!-- Website Link -->
                <a href="' . $nfpodetails['website'] . '" style="display: inline-flex !important;" target="_blank"><img src="../images/website.png"></a>
              </td>
            </tr>';
    }
    

    $this->content .= '
            <!-- Name, Logo, Incorporation -->
            <tr>
              <!-- Logo, Name & Incorporation Date -->
              <td colspan="2" align="center" class="block">
                <!-- Logo Image -->
                <img src="' . $nfpodetails['logo'] . '" height="250"><br>
                <!-- Organization Name -->
                <b>' . $nfpodetails['organization-name'] . '</b><br><br>
                <!-- Incorporation Date -->
                <b>' . $translation[3] . '</b> ' . $nfpodetails['inc-date'] . '
              </td>
            </tr>

            </tbody>
          </table>
          <br>
          <hr>
          <!-- Second Table - Ratings -->
          <table align="center" style="width:100%">
            <tbody>
  
            <tr>
              <th colspan="2">
              ' . $translation[4] . ' | <a href="index.php?display=RateNFPO&id=' . $_GET['id'] . '">' . $translation[5] . '</a>
                <hr>
              </th>
            </tr>

            <tr>
              <td align="right" style="width:50%">
              ' . $translation[6] . '
              </td>
              <td>';
                        
    if( $r1 == 0 ){
      $this->content .= "N/A";
    }
    else{
      $i=0;
      while( $i < $r1 )
      {
        $this->content .= '<img src="../images/star.ico" width="15" height="15">';
        $i++;
      }
    }

    $this->content .= '
              </td>
            </tr>

            <tr>
              <td align="right" style="width:50%">
              ' . $translation[7] . '
              </td>
              <td>';
                        
    if( $r2 == 0 ){
      $this->content .= "N/A";
    }
    else{
      $i=0;
      while($i < $r2)
      {
        $this->content .= '<img src="../images/star.ico" width="15" height="15">';
        $i++;
      }
    }

    $this->content .= '
              </td>
            </tr>
            
            <tr>
              <td align="right" style="width:50%">
              ' . $translation[8] . '
              </td>
              <td>';
                        
    if( $r3 == 0 ){
      $this->content .= "N/A";
    }
    else{
      $i=0;
      while($i < $r3)
      {
        $this->content .= '<img src="../images/star.ico" width="15" height="15">';
        $i++;
      }
    }

    $this->content .= '
              </td>
            </tr>
            
            <tr>
              <td align="right" style="width:50%">
              ' . $translation[9] . '
              </td>
              <td>';
                        
    if( $r4 == 0 ){
      $this->content .= "N/A";
    }
    else{
      $i=0;
      while($i < $r4)
      {
        $this->content .= '<img src="../images/star.ico" width="15" height="15">';
        $i++;
      }
    }
                        
    $this->content .= '
              </td>
            </tr>
            
            <tr>
              <td align="right" style="width:50%">
              ' . $translation[10] . '
              </td>
              <td>';
                        
    if( $r5 == 0 ){
      $this->content .= "N/A";
    }
    else{
      $i=0;
      while($i < $r5)
      {
        $this->content .= '<img src="../images/star.ico" width="15" height="15">';
        $i++;
      }
    }
                        
    $this->content .= '
              </td>
            </tr>
            
            <tr>
              <td align="right" style="width:50%">
              ' . $translation[11] . '
              </td>
              <td>';
                        
    if( $r6 == 0 ){
      $this->content .= "N/A";
    }
    else{
      $i=0;
      while($i < $r6)
      {
        $this->content .= '<img src="../images/star.ico" width="15" height="15">';
        $i++;
      }
    }

    $this->content .= '
              </td>
            </tr>
            
            <tr>
              <td align="right" style="width:50%">
              ' . $translation[12] . '
              </td>
              <td>';
                        
    if( $r7 == 0 ){
      $this->content .= "N/A";
    }
    else{
      $i=0;
      while($i < $r7)
      {
        $this->content .= '<img src="../images/star.ico" width="15" height="15">';
        $i++;
      }
    }

    $this->content .= '
              </td>
            </tr>

            </tbody>
          </table>
          
          <br>

          <!-- Third Table - How to donate -->
          <table align="center" style="width:100%">
            <tbody>

              <!-- DONATION INFORMATION -->        
              <tr> 
                <td colspan="2" align="center" class="block">
                  <h2>' . $translation[13] . '</h2>
                </td>
              </tr>

              <tr>    	
                <td align="center" width="50%">
                  <br>' . $translation[14] . '
                </td>                

                <td align="center" width="50%">
                  <br>' . $translation[15] . '
                </td>
              </tr>

              <tr>
                <td align="center" >

                  <!-- PayPal Button -->';
                  
                  if($nfpodetails['paypal'] == NULL)
                  { 
                    $this->content .= '<br>N/A';
                  }
                  else
                  {
                    $this->content .= '
                    <a href="donate.php?action=process&email=' . $nfpodetails['paypal'] . '&type=NFPO&item_number=NFPO.' . $_GET['id'] . '">
                      <img src="images/paypal-donate.png" alt="PayPal - The safer, easier way to pay online!">
                    </a>
                    ';
                  }
              
    $this->content .= '
                </td>
                <td align="center" >
                  ';
                  
    if( $nfpodetails['bank-account'] == NULL )
    {
        $this->content .= 'N/A';
    }
    else
    {
      $this->content .= $nfpodetails['bank-account'];
    }
    
    $this->content .= '
                </td>
              </tr>
              
              </tbody>
            </table>
        
            <br>
        
            <!-- Fourth Table - Contact Info -->
            <table align="center" style="width:100%">
              <tbody>

              <tr>
                <td colspan="2" align="center" class="block">
                  <h2>' . $translation[16] . '</h2>
                  <p>' . $translation[17] . '</p>
                </td>
              </tr>

              <tr>
                <td align="center">
                  <br><b>' . $translation[18] . '</b> ' . $nfpodetails['contact-first'] . " " . $nfpodetails['contact-last'] . '<br>
                  <b>' . $translation[19] . '</b> ' . $nfpodetails['phone'] . '<br>
                  <b>' . $translation[20] . '</b> <a href="mailto:' . $nfpodetails['contact-email'] . '">' . $nfpodetails['contact-email'] . '</a>
                </td>
                
                <td align="center">
                  <br><b>' . $translation[21] . '</b><br>
                  ' . $nfpodetails['postal-address'] . '<br>
                  ' . $nfpodetails['municipality'] . ', PR ' . $nfpodetails['zip'] .'
                </td>
              </tr>
            
              </tbody>
              </table>
          
              <br>
          
              <!-- Fifth Table - Organization Info -->
              <table align="center" style="width:100%">
                <tbody>
  
                <tr>
                <td colspan="2" align="center" class="block">
                  <h2>' . $translation[22] . '</h2>
                </td>
              </tr>

              <tr>
                <td align="center">
                  <br><b>' . $translation[23] . '</b> <br>
                  ' . $nfpodetails['category'] . '
                </td>

                <td align="center">
                  <br><b>' . $translation[24] . '</b><br>
                    ' . $nfpodetails['services'] . '<br>
                  <b>' . $translation[25] . '</b><br> ' . $nfpodetails['impact'] . ' ' . $nfpodetails['target'] . '<br>
                </td>
              </tr>

              <tr>
                <td colspan="2" align="center">
                <br>';

                // If there are supporters
                if( $nfpodetails['foundations'] != '' ){
                  $this->content .= '<b>' . $translation[26] . '</b><br>';
                }
                  
                  // Display Supporter logos
                  $fundaciones = explode( ",", $nfpodetails['foundations'] );

                  // If has Popular
                  if( in_array('Fundación Banco Popular', $fundaciones) )
                  {
                    $this->content .= '<img src="badges/BP.png">&nbsp;&nbsp;';
                  }

                  // If has Fondos Unidos
                  if( in_array('Fondos Unidos', $fundaciones) )
                  {
                    $this->content .= '<img src="badges/FU.png">&nbsp;&nbsp;';
                  }

                  // If has Angel Ramos
                  if( in_array('Fundación Angel Ramos', $fundaciones) )
                  {
                    $this->content .= '<img src="badges/AR.png">&nbsp;&nbsp;';
                  }

                  if( strlen($nfpodetails['foundations']) < 0 )
                  {
                    $this->content .= 'None registered.';
                  }

    $this->content .= '
                </td>
              </tr>

              </tbody>
              </table>
          
              <br>
          
              <!-- Sixth Table - Mission and Vision -->
              <table align="center" style="width:100%">
                <tbody>
  
                <tr>
                <td colspan="3" align="center" class="block">
                  <h2>' . $translation[27] . '</h2>
                </td>
              </tr>

              <tr>
                <td align="center" width="45%">
                  <br><b>' . $translation[28] . '</b><br><br>
                  ' . $nfpodetails['mission'] . '<br>
                </td>
                <td width="10%"></td>
                <td align="center" width="45%">
                  <br><b>' . $translation[29] . '</b><br><br>
                  ' . $nfpodetails['vision'] . '<br>
                </td>
              </tr>

              <tr>
                <td colspan="3" align="center">
                  <br><b>' . $translation[30] . '</b><br><br>
                  ' . $nfpodetails['projections'] . '<br>
                </td>
              </tr>

            </tbody>
          </table>
      
          <br>
      
          <!-- Seventh Table - Official Documentation -->
          <table align="center" style="width:100%">
            <tbody>
  
              <tr>
                <td colspan="2" align="center" class="block">
                  <h2>' . $translation[31] . '</h2>
                  <p>' . $translation[32] . '</p>
                </td>
              </tr>

              <tr>
                  <td colspan="2" align="center">
                    <br><b>' . $translation[33] . '</b> ' . $nfpodetails['essn'] . '<br><br>
                  </td>
              </tr>

              <tr>
                <td align="center">
                  <a href="' . $nfpodetails['good-standing'] . '">' . $translation[34] . '</a><br>

                  <br>
                  <a href="' . $nfpodetails['state-inscription'] . '">' . $translation[35] . '</a><br>

                  <br>
                  <a href="' . $nfpodetails['990'] . '">' . $translation[36] . '</a><br>
                </td>

                <td align="center">
                  <a href="' . $nfpodetails['audit'] . '">' . $translation[37] . '</a><br>

                  <br>
                  <a href="' . $nfpodetails['state-exemption'] . '">' . $translation[38] . '</a><br>

                  <br>
                  <a href="' . $nfpodetails['federal-exemption'] . '">' . $translation[39] . '</a>
                </td>
              </tr>

            </tbody>
          </table>
      
          <br><br>
      
          <!-- Seventh Table - Official Documentation -->
          <table align="center" style="width:100%">
            <tbody>

            <tr>
                <td align="center" class="block">
                  <h2>' . $translation[40] . '</h2>
                </td>
              </tr>

              <tr>
                <td align="center">
                  <br><b>' . $translation[41] . '</b><br><br>
                  ' . $nfpodetails['physical-address'] . '<br>
                  ' . $nfpodetails['municipality'] . ', PR ' . $nfpodetails['zip'] . '<br><br>
                </td>
              </tr>

            <tr>
                <td colspan="2" align="center">
                  <!-- IMAGE SLIDER -->
                  <div class="banner">
                  <div id="sliderFrame">
                          <div id="slider">
                            <img src="' . $nfpodetails['pic1'] . '" width="600" height="400" alt="Our Facilities" />
                            <img src="' . $nfpodetails['pic2'] . '" width="600" height="400" alt="Our Facilities" />
                            <img src="' . $nfpodetails['pic3'] . '" width="600" height="400" alt="Our Facilities" />
                          </div>
                          <div id="htmlcaption" style="display: none;">
                              <em>Nuestras Facilidades</em>
                          </div>
                      </div>
                  </div>
                  <!-- IMAGE SLIDER -->
                </td>
            </tr>

            <tr>
              <td colspan="2" align="center">
                <!-- Google Maps Addon -->';
                
    if( $nfpodetails['gps'] == NULL )
    {}
    else
    {
      $this->content .= '
        <br><b>' . $translation[42] . '</b><br><br>
            <iframe height="400" width="700" style="border: 0px solid #000000"
            src="http://maps.google.com/?q=' . $nfpodetails["gps"] . '&z=16&output=embed&hl=en&t=h"></iframe>
        ';
    }

    $this->content .= '                  
                </td>
            </tr>            

          </tbody>
        </table>
      </div>

      <!-- FACEBOOK COMMENTS -->';
      
      $URL = curPageURL();
      
    $this->content .= '
      <center>
      <div class="fb-comments" align="center" data-href="' . $URL . '" data-numposts="10" data-colorscheme="light"></div>
      </center>

    </section>
    ';

    parent::Display();
  }

}

?>