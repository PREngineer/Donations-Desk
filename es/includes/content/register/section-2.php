<!-- Actual Content -->
<section class="content-section">
  <!-- Is inside a container -->
  <div class="w-container">
    <!-- With 2 columns -->
    <div class="w-row">
      <!-- Column #1 (2/3 of page width) - Content -->
      <div class="w-col w-col-9">
        
        <?php
          // Add the First Part of the Form (Account)
          include 'includes/content/register/form-1.php';
        ?>

      </div>
      
      <!-- Column #2 (1/3 of page width) - Sub-Menu -->
      <div class="w-col w-col-3">
        <!-- No links -->
        <?php include 'includes/widgets/logged-in-menu.php'; ?>
      </div>

    </div>

  </div>

</section>