<?php

  /*
  Calls the function that retrieves the data
  */
  $fetched_data = admin_nfpo_data($_GET['id'], 'username', 'contact-first', 'contact-last', 'contact-email', 'phone');

  // If the POST has information
  if(empty($_POST) === false)
  {

    // If there are no errors
    if(empty($errors) === true)
    {
      // Check if the e-mail has the right form
      if(filter_var($_POST['contact-email'], FILTER_VALIDATE_EMAIL) === false && $_POST['contact-email'] !== '')
      {
        // Display the appropriate message
        $errors[] = 'Se requiere un e-mail correcto.';
      }
    }
  }

  // If the post is not empty and there are no errors
  if(empty($_POST) === false && empty($errors) === true)
  {
    // Save the nfpo data in array
    $nfpo_data = array(
        'username'            => $fetched_data['username'],
        'contact-first'       => $_POST['contact-first'],
        'contact-last'        => $_POST['contact-last'],
        'contact-email'       => $_POST['contact-email'],
        'phone'               => $_POST['phone'],
      );

    // Add the info to the the NFPO entry in DB
    update_rep_info($nfpo_data);

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
      Sections:
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

<!-- Part 3: REPRESENTATIVE INFORMATION -->
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
          <th>Nombre de Contacto [*]</th>
          <td>
            <input class="w-input" name="contact-first" type="text" value="<?php if( empty($_POST) === true ) print_r($fetched_data['contact-first']); else print_r($_POST['contact-first']); ?>" placeholder="Juan">
          </td>
        </tr>

        <tr>
          <th>Apellido de Contacto [*]</th>
          <td>
            <input class="w-input" name="contact-last" type="text" value="<?php if( empty($_POST) === true ) print_r($fetched_data['contact-last']); else print_r($_POST['contact-last']); ?>" placeholder="Del Pueblo">
          </td>
        </tr>

        <tr>
          <th>Teléfono [*]</th>
          <td>
            <input class="w-input" name="phone" type="text" value="<?php if( empty($_POST) === true ) print_r($fetched_data['phone']); else print_r($_POST['phone']); ?>" placeholder="111-222-3333">
          </td>
        </tr>

        <tr>
          <th>E-mail de Contacto [*]</th>
          <td>
            <input class="w-input" name="contact-email" type="text" value="<?php if( empty($_POST) === true ) print_r($fetched_data['contact-email']); else print_r($_POST['contact-email']); ?>" placeholder="Entre su e-mail">
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