<?php 
  
  /*
  Calls the function that retrieves the data
  */
  $fetched_data = admin_nfpo_data($_GET['id'], 'username', 'paypal', 'bank-account');

  // If the POST has information
  if(empty($_POST) === false)
  {
    // If there are no errors
    if(empty($errors) === true)
    {
      // Check if the e-mail has the right form
      if( filter_var($_POST['paypal'], FILTER_VALIDATE_EMAIL) === false  && $_POST['paypal'] !== '' )
      {
        // Display the appropriate message
        $errors[] = 'Se requiere una dirección válida de PayPal.';
      }
    }
  }

  // If the post is not empty and there are no errors
  if(empty($_POST) === false && empty($errors) === true)
  {

    // Save the nfpo data in array
    $nfpo_data = array(
        'username'            => $fetched_data['username'],
        'bank-account'        => $_POST['bank-account'],
        'paypal'              => $_POST['paypal']
      );

    // Add the info to the the NFPO entry in DB
    update_donation_info($nfpo_data);

    // Enable Success Message
    $success = true;
  }

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

  // If the Registration went through
  if($success === true)
  {
    echo '<center><font color="green"><p>¡Información Actualizada!</p></font></center>';
  }

?>

<!-- Browsing menu -->
<table border="1">
  <tbody>
    <th align="left" colspan="6">
      Secciones:
    </th>

    <tr>
      <td width="150">
        <a href="admin-manage-nfpo.php?edit=1&id=<?php echo $_GET['id']?>">Básico</a>
      </td>
      <td width="150">
        <a href="admin-manage-nfpo.php?edit=2&id=<?php echo $_GET['id']?>">Representante</a>
      </td>
      <td width="150">
        <a href="admin-manage-nfpo.php?edit=3&id=<?php echo $_GET['id']?>">Donación</a>
      </td>
      <td width="150">
        <a href="admin-manage-nfpo.php?edit=4&id=<?php echo $_GET['id']?>">Propósito</a>
      </td>
      <td width="150">
        <a href="admin-manage-nfpo.php?edit=5&id=<?php echo $_GET['id']?>">Social Media</a>
      </td>
      <td width="150">
        <a href="admin-manage-nfpo.php?edit=6&id=<?php echo $_GET['id']?>">Documentos</a>
      </td>
    </tr>
  </tbody>
</table>
<!-- Browsing menu -->

<!-- PART 4: DONATION INFORMATION -->
<table>
<tbody>

    <form class="login-form" enctype="multipart/form-data" action="" method="POST">
      
      <tbody>
        <tr>
          <td colspan="2">
            <hr>
          </td>
        </tr>

        <tr>
          <th>Cuenta de Banco</th>
            <td>
              <textarea class="w-input" name="bank-account" rows="2" cols="98" placeholder="Entre Banco y Número de Cuenta"><?php 
              if( empty($_POST) === true ) print_r($fetched_data['bank-account']); else print_r($_POST['bank-account']); ?></textarea>
            </td>
        </tr>

        <tr>
          <th>Paypal</th>
            <td>
              <input class="w-input" name="paypal" type="text" value="<?php if( empty($_POST) === true ) print_r($fetched_data['paypal']); 
              else print_r($_POST['paypal']); ?>" placeholder="Entre e-mail de PayPal">
            </td>
        </tr>

      </tbody>

      <tbody>
        <tr>
          <td colspan="2" align="right">
           <input class="w-button" type="submit" value="Continue">
          </td>
        </tr>
      </tbody>

    </form>

</tbody>
</table>