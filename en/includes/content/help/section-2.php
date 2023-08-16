<!-- Section -->
<section class="content-section">
  <!-- Container -->
  <div class="w-container">
    <!-- Row -->
    <div class="w-row">
      
      <!-- Column #1 (2/3 of page width) - Content -->
      <div class="w-col w-col-9">
        
        <p>
          Here are a few documents that will help you understand how this Website and our Android App work, how to install and 
          how to Navigate them.
        </p>
        
        <p>
          <a href="/donationsdesk/manuals/APK-Installation.pdf" target="_blank">APK Installation</a> - Android Application 
          Installation Manual.
        </p>

        <p>
          <a href="/donationsdesk/manuals/Mobile.pdf" target="_blank">Android App Manual</a> - Helps you understand the app and 
          how to navigate it.
        </p>

        <p>
          <a href="" target="_blank">Web Manual - Visitor</a> - Helps you understand the Website and how to navigate 
          it and used its features.
        </p>

  <?php 
  // If a User is logged in, show the following menu
  if( logged_in() && $user_data['role'] == 0 )
  {
  ?>
        <p>
          <a href="/donationsdesk/manuals/WebManualNFPO.pdf" target="_blank">Web Manual - NFPO</a> - Helps you understand the Website and how to navigate 
          it and used its features.
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
          <a href="/donationsdesk/manuals/WebManualAdmin.pdf" target="_blank">Web Manual - Administrator</a> - Helps you understand the Website and how to navigate 
          it and used its features.
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