<!-- Actual Content -->
<section class="content-section">
  <!-- Is inside a container -->
  <div class="w-container">
    <!-- With 2 columns -->
    <div class="w-row">

      <!-- Column #1 (2/3 of page width) - Content -->
      <div class="w-col w-col-9">

<?php

      // Retrieve the names of the fields that are missing
      $documents = nfpo_data($user_data['username'], 'organization-name', 'physical-address', 'postal-address', 'municipality', 
        'zip', 'inc-date', 'essn', 'category', 'contact-first', 'contact-last', 'contact-email', 'phone', 'vision', 'mission', 
        'services', 'target', 'impact', 'good-standing', 'state-inscription');

        // If missing information
        if( $documents['organization-name'] == '' ||  $documents['physical-address'] == '' || $documents['postal-address'] == '' 
          || $documents['municipality'] == '' || $documents['zip'] == '' || $documents['inc-date'] == '0000-00-00' || $documents['essn'] == '' 
          || $documents['category'] == '' || $documents['contact-first'] == '' || $documents['contact-last'] == '' || $documents['phone'] == ''
          || $documents['vision'] == '' || $documents['mission'] == '' || $documents['services'] == '' || $documents['target'] == '' 
          || $documents['impact'] == '' || $documents['good-standing'] == '/donationsdesk/uploads/documents/0.pdf'
          || $documents['state-inscription'] == '/donationsdesk/uploads/documents/0.pdf' || $documents['contact-email'] == '' )
        {
echo '
          
          <p class="subtitle-paragraph">Su Organización no aparecerá en nuestro sistema hasta que provea 
            la siguiente información que es requisito.</p>
          <p class="subtitle-paragraph">Se ha determinado que le falta proveer la siguiente información 
            para el perfil de su Organización:</p><font color="red">
';

          if($documents['organization-name'] == '')
          {
              echo '* Nombre de la Organización<br>';
          }
          if($documents['physical-address'] == '')
          {
              echo '* Dirección Física<br>';
          }
          if($documents['postal-address'] == '')
          {
              echo '* Dirección Postal<br>';
          }
          if($documents['municipality'] == '')
          {
              echo '* Pueblo<br>';
          }
          if($documents['zip'] == '')
          {
              echo '* Zip Code<br>';
          }
          if($documents['inc-date'] == '0000-00-00')
          {
              echo '* Fecha de Incorporación<br>';
          }
          if($documents['essn'] == '')
          {
              echo '* Seguro Social Patronal (ESSN)<br>';
          }
          if($documents['category'] == '')
          {
              echo '* Categoría<br>';
          }
          if($documents['contact-first'] == '')
          {
              echo '* Nombre del Contacto<br>';
          }
          if($documents['contact-last'] == '')
          {
              echo '* Apellido(s) del Contacto<br>';
          }
          if($documents['phone'] == '')
          {
              echo '* Teléfono<br>';
          }
          if($documents['vision'] == '')
          {
              echo '* Visión Organizacional<br>';
          }
          if($documents['mission'] == '')
          {
              echo '* Misión Organizacional<br>';
          }
          if($documents['services'] == '')
          {
              echo '* Servicios Provistos<br>';
          }
          if($documents['target'] == '')
          {
              echo '* Población a la que sirven<br>';
          }
          if($documents['impact'] == '')
          {
              echo '* Impacto Poblacional<br>';
          }
          if($documents['good-standing'] == '/donationsdesk/uploads/documents/0.pdf')
          {
              echo '* Documento Good Standing<br>';
          }
          if($documents['state-inscription'] == '/donationsdesk/uploads/documents/0.pdf')
          {
              echo '* Documento de Inscripció con el Dpt. de Estado<br>';
          }
          if($documents['contact-email'] == '')
          {
              echo '* E-mail de Contacto<br>';
          }
echo '
          </font><br>
          <p class="subtitle-paragraph">Por favor, asegúrese de llenar la información y proveer los documentos requeridos.  Una vez
            la información se haya sometido puede volver aquí para solicitar la activación de su Organización 
            al hacer click en un enlace que le aparecerá.</p>
          
';
        }
        // Nothing missing
        else
        {
          // Organization is not active and no GET received
          if( !NFPO_active($user_data['username']) && !isset($_GET['activate']) )
          {
              echo '<p class="subtitle-paragraph">Su Organización está al día.  Actívela presionando aquí:</p>
              <a href="user-nfpo-activate.php?activate=1">ACTIVAR!</a>';
          }
          // Process Activation
          if( $_GET['activate'] == '1' && !NFPO_active($user_data['username']) )
          {
              // Activate the NFPO
              activate_NFPO($user_data['username']);
              echo 'Su Organización ha sido activada.  <br>Ahora puede crear Campañas y aparecerá en nuestro listado.';
          }
        } 
?>
      </div>
      
      <!-- Column #2 (1/3 of page width) - Sub-Menu -->
      <div class="w-col w-col-3">
      <?php include'includes/widgets/logged-in-menu.php'; ?>
      </div>

    </div>

  </div>

</section>