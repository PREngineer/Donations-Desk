<!-- The Footer Section -->
<footer>
  <!-- Is inside a container -->
  <div class="w-container">
    <!-- With 1 row that has 3 columns-->
    <div class="w-row footer-section">

      <!-- COLOR BARS AT THE BOTTOM OF THE HEADER -->
      <!-- wraps each bar -->
      <div id="footer-bar-wrapper"> 
      <!-- bars from left to right -->
      <div id="orange-bar"><br/></div>
      <div id="green-bar"><br/></div>
      <div id="gray-bar"><br/></div>
      <div id="orange-bar"><br/></div>
      </div>
      <!-- END OF COLOR BARS AT THE BOTTOM OF THE HEADER -->

      <!-- Column #1 (1/4 of page width) -->
      <div class="w-col w-col-3">
      </div>
      
      <!-- Column #2 (1/2 of page width) -->
      <div class="w-col w-col-6">
        <!-- Copyright Info -->
        <div class="copyright">Donations Desk
          <br>© Copyright 2014 
<?php 
          if(date('Y') > 2014)
          {
            echo ' - ' . date('Y');
          }
?>
          <br>Asesores Financieros Comunitarios</div>
      </div>

      <!-- Column #3 (1/4 of page width) - Social Media Links -->
      <div class="w-col w-col-3">
        <!-- Has one inner row with 3 columns equally spaced -->
        <div class="w-row">
          <?php include 'includes/widgets/social-media.php'; ?>
        </div>

      </div>

    </div>

  </div>
</footer>