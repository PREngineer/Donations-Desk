<!-- Section -->
<section class="content-section">
  <!-- Container -->
  <div class="w-container">
    <!-- Row -->
    <div class="w-row">
      
      <!-- Column #1 (2/3 of page width) - Content -->
      <div class="w-col w-col-9">
        
        <!-- PASSWORD RETRIEVAL FORM -->
<?php

  // If the POST has information
  if(empty($_POST) === false)
  {
    // Establish which fields are required
    $required_fields = array('email');
    
    // Check all the values provided in the post
    foreach($_POST as $key=>$value)
    {
      // If any of the required fields are not provided
      if(empty($value) && in_array($key, $required_fields) === true)
      {
        // Make an error that says it.
        $errors[] = '[*] = Campos Requeridos';
        break 1;
      }
    }
    // If there are no errors
    if(empty($errors) === true)
    {
      // Check if the e-mail is already in use
      if(email_exists($_POST['email']) === false)
      {
        // Display the appropriate message
        $errors[] = 'El e-mail provisto no está registrado.';
      }
      // Check if the e-mail has the right form
      if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) === false)
      {
        // Display the appropriate message
        $errors[] = 'Se requiere un e-mail válido.';
      }
    }
  }

  // ************************************************ //
  // *** FOR SOME REASON IT DIDN'T WORK LIKE THIS *** //
  // *** HAD TO POST DIRECTLY TO A PAGE THAT      *** //
  // *** CALLS THE FUNCTION THAT SENDS THE MAIL   **  //
  // ************************************************ //

  // If the post is not empty and there are no errors
  if(empty($_POST) === false && empty($errors) === true)
  {
    //Send e-mail
    forgot_password($_POST['email']);

    echo '<center><font color="green">
    <p>Sus credenciales han sido enviadas a su correo electrónico.</p>
    <p>Recuerde revisar el correo basura.</p>
    </center>
    ';
  }

  // If the post is not empty and there are no errors
  // if($_GET['success'] == '1')
  // {
  //   echo '<center><font color="green">
  //   <p>Your credentials have been sent to your e-mail.</p>
  //   <p>Remember to check your junk folder.</p>
  //   </center>
  //   ';
  // }

  // If there are errors
  else if(empty($errors) === false)
  {
    echo '<!-- DISPLAY ANY POSSIBLE ERRORS -->';
    echo '<font color="red">';
    echo '<br>ERRORES!<br>';
    // Display the errors
    echo output_errors($errors); 
    echo '</font>';
  }
  ?>

</font>

  <!-- ACTUAL FORM -->
  <!-- PART 1: ACCOUNT INFORMATION -->

  <table>

  <tbody>

  <!-- <form class="login-form" enctype="multipart/form-data" action="reset-password.php" method="POST"> -->
  <form class="login-form" enctype="multipart/form-data" action="" method="POST">

    <tr>
      <td colspan="2">
        <hr>
        <h2>Recuperar Credenciales</h2>
      </td>
    </tr>

    <tr>
      <th class="required">E-mail: [*]</th>
      <td>
        <input class="w-input" type="text" placeholder="Entre su e-mail" name="email" value="<?php print_r($register_user_data['email']);?>">
      </td>
    </tr>

  </tbody>

  <tbody>
    <tr>
      <td colspan="2" align="right">
       <input class="w-button" type="submit" value="Retrieve Credentials">
      </td>
    </tr>
  </tbody>

  </form>

  </table>

      </div>

      <!-- Column #2 (1/2 of page width) - Sub-Menu -->
      <div class="w-col w-col-3">
      <?php include'includes/widgets/logged-in-menu.php'; ?>
      </div>

    </div>

  </div>

</section>