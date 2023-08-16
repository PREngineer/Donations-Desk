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
          
          <p class="subtitle-paragraph">Your Non For Profit Organization will not appear in our listing until you provide 
            the required information to participate in Donations Desk.</p>
          <p class="subtitle-paragraph">The following documentation/information has been determined to be missing 
            from your Organization\'s Profile:</p><font color="red">
';

          if($documents['organization-name'] == '')
          {
              echo '* Organization Name<br>';
          }
          if($documents['physical-address'] == '')
          {
              echo '* Physical Address<br>';
          }
          if($documents['postal-address'] == '')
          {
              echo '* Postal Address<br>';
          }
          if($documents['municipality'] == '')
          {
              echo '* Municipality<br>';
          }
          if($documents['zip'] == '')
          {
              echo '* Zip Code<br>';
          }
          if($documents['inc-date'] == '0000-00-00')
          {
              echo '* Incorporation Date<br>';
          }
          if($documents['essn'] == '')
          {
              echo '* Employer Social Security Number (ESSN)<br>';
          }
          if($documents['category'] == '')
          {
              echo '* Category<br>';
          }
          if($documents['contact-first'] == '')
          {
              echo '* Contact\'s First Name<br>';
          }
          if($documents['contact-last'] == '')
          {
              echo '* Contact\'s Last Name<br>';
          }
          if($documents['phone'] == '')
          {
              echo '* Telephone Number<br>';
          }
          if($documents['vision'] == '')
          {
              echo '* Organizational Vision<br>';
          }
          if($documents['mission'] == '')
          {
              echo '* Organizational Mission<br>';
          }
          if($documents['services'] == '')
          {
              echo '* Services Provided<br>';
          }
          if($documents['target'] == '')
          {
              echo '* Target Population<br>';
          }
          if($documents['impact'] == '')
          {
              echo '* Population Impact<br>';
          }
          if($documents['good-standing'] == '/donationsdesk/uploads/documents/0.pdf')
          {
              echo '* Good Standing Document<br>';
          }
          if($documents['state-inscription'] == '/donationsdesk/uploads/documents/0.pdf')
          {
              echo '* Dpt. Of State Inscription Document<br>';
          }
          if($documents['contact-email'] == '')
          {
              echo '* Contact E-mail<br>';
          }
echo '
          </font><br>
          <p class="subtitle-paragraph">Please, make sure you fill out the information or provide the requested documents.  Once
            the information has been submitted successfully you can come back to this page and submit a request for activation 
            by clicking on the activation link that will appear.</p>
          
';
        }
        // Nothing missing
        else
        {
          // Organization is not active and no GET received
          if( !NFPO_active($user_data['username']) && !isset($_GET['activate']) )
          {
              echo '<p class="subtitle-paragraph">Your Organization\'s information is up to date.  You can activate it by clicking here:</p>
              <a href="user-nfpo-activate.php?activate=1">ACTIVATE!</a>';
          }
          // Process Activation
          if( $_GET['activate'] == '1' && !NFPO_active($user_data['username']) )
          {
              // Activate the NFPO
              activate_NFPO($user_data['username']);
              echo 'Your NFPO is now active.  <br>Now you can create Campaigns and your Organization will appear in the listing.';
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