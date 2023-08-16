<!-- Actual Content -->
<section class="content-section">
  <!-- Is inside a container -->
  <div class="w-container">
    <!-- With 2 columns -->
    <div class="w-row">
      <!-- Column #1 (2/3 of page width) - Content -->
      <div class="w-col w-col-9">
        <?php

        if($_GET['edit'] == '1')
        {
          include 'includes/content/admin-manage-nfpo/form-1.php';
        }
        if($_GET['edit'] == '2')
        {
          include 'includes/content/admin-manage-nfpo/form-2.php';
        }
        if($_GET['edit'] == '3')
        {
          include 'includes/content/admin-manage-nfpo/form-3.php';
        }
        if($_GET['edit'] == '4')
        {
          include 'includes/content/admin-manage-nfpo/form-4.php';
        }
        if($_GET['edit'] == '5')
        {
          include 'includes/content/admin-manage-nfpo/form-5.php';
        }
        if($_GET['edit'] == '6')
        {
          include 'includes/content/admin-manage-nfpo/form-6.php';
        }
        if($_GET['list'] == '1')
        {
          include 'includes/content/admin-manage-nfpo/list.php';
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