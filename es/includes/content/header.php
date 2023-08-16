<header class="header-section">
  <div class="w-container">
    <div class="w-row">
      
      <div class="w-col w-col-3">
        <img class="header-logo" src="/donationsdesk/images/Donations Desk Logo.png" alt="Donation&apos;s Desk Logo" width="200">
      </div>

      <div class="w-col w-col-9">
        <div class="w-nav" data-collapse="medium" data-animation="default" data-duration="400" data-contain="1">
          <div class="w-container menu-bar">
            <a class="w-nav-brand" href="#"></a>
            <nav class="w-nav-menu" role="navigation">
              <a class="w-nav-link" href="index.php">Campañas</a>
              <a class="w-nav-link" href="non-for-profit-organizations.php">Organizaciones Sin Fines de Lucro</a>
              <a class="w-nav-link" href="resources.php">Recursos</a>
              <?php 
              if($user_data['active'] == 1)
              {
                echo '<a class="w-nav-link" href="myaccount.php">Mi Cuenta</a>';
              }
              else
              {
                echo '<a class="w-nav-link" href="login.php">Login</a>';
              }
              ?>
            </nav>
            <!-- LOW RESOLUTION MENU BUTTON -->
            <div class="w-nav-button">
              <div class="w-icon-nav-menu">
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>

    <!-- COLOR BARS AT THE BOTTOM OF THE HEADER -->
    <!-- wraps each bar -->
    <div id="bar-wrapper"> 
    <!-- bars from left to right -->
    <div id="orange-bar"><br/></div>
    <div id="green-bar"><br/></div>
    <div id="gray-bar"><br/></div>
    <div id="orange-bar"><br/></div>
    </div>
    <!-- END OF COLOR BARS AT THE BOTTOM OF THE HEADER -->

  </div>
</header>