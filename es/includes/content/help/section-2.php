<!-- Section -->
<section class="content-section">
  <!-- Container -->
  <div class="w-container">
    <!-- Row -->
    <div class="w-row">
      
      <!-- Column #1 (2/3 of page width) - Content -->
      <div class="w-col w-col-9">
        
        <p>
          Aquí encontrará algunos documentos que le ayudarán a entender como funciona este sitio web y la aplicación Androide, como instalarla y
          como navegarlos.
        </p>
        
        <p>
          <a href="/donationsdesk/manuals/APK-Instalacion.pdf" target="_blank">Instalación del APK</a> - Manual de Instalación de la Aplicación Androide.
        </p>

        <p>
          <a href="/donationsdesk/manuals/Mobile.pdf" target="_blank">Manual de App Androide</a> - Le enseña a entender la aplicación y como navegarla.
        </p>

        <p>
          <a href="/donationsdesk/manuals/WebManualVisitor.pdf" target="_blank">Manual Web - Visitante</a> - Le enseña a entender el sitio web y como navegarlo y usar sus características.
        </p>

  <?php 
  // If a User is logged in, show the following menu
  if( logged_in() && $user_data['role'] == 0 )
  {
  ?>
        <p>
          <a href="/donationsdesk/manuals/WebManualNFPO.pdf" target="_blank">Manual Web - OSFL</a> - Le enseña a entender el sitio web y como navegarlo y usar sus características.
        </p>
  <?php 
  }
  ?>

  <?php 
  // If a User is logged in, show the following menu
  if( logged_in() && $user_data['role'] == 1 )
  {
  ?>
        <p>
          <a href="/donationsdesk/manuals/WebManualAdmin.pdf" target="_blank">Manual Web - Administrador</a> - Le enseña a entender el sitio web y como navegarlo y usar sus características.
        </p>
  <?php 
  }
  ?>
  
      </div>

      <!-- Column #2 (1/3 of page width) - Sub-Menu -->
      <div class="w-col w-col-3">
      <?php include'includes/widgets/resources-menu.php'; ?>
      </div>

    </div>

  </div>

</section>