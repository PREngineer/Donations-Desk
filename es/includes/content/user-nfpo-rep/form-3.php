<?php

  /*
  Calls the function that retrieves the data
  */
  $fetched_data = nfpo_data($user_data['username'], 'username', 'contact-first', 'contact-last', 'contact-email', 'phone');

  // If the POST has information
  if(empty($_POST) === false)
  {
    // Establish which fields are required
    $required_fields = array('contact-first', 'contact-last', 'phone', 'contact-email');
    
    // Check all the values provided in the post
    foreach($_POST as $key=>$value)
    {
      // If any of the required fields are not provided
      if(empty($value) && in_array($key, $required_fields) === true)
      {
        // Make an error that says it.
        $errors[] = 'Campos marcados con [*] son requeridos.';
        break 1;
      }
    }

    // If there are no errors
    if(empty($errors) === true)
    {
      // Check if the e-mail has the right form
      if(filter_var($_POST['contact-email'], FILTER_VALIDATE_EMAIL) === false)
      {
        // Display the appropriate message
        $errors[] = 'Se require una dirección de e-mail válida';
      }
    }
  }

  // If the post is not empty and there are no errors
  if(empty($_POST) === false && empty($errors) === true)
  {
    // Save the nfpo data in array
    $nfpo_data = array(
        'username'            => $user_data['username'],
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
  echo '<center><font color="green"><p>¡Información Actualizada!</p>
        <p>Continúe a la próxima información: </p></font>
        <p><a href="user-nfpo-donate.php">¡Haciendo click aquí!</a></p></center>';
}
?>

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
          <th class="required">Primer Nombre del Contacto [*]</th>
          <td>
            <input class="w-input" name="contact-first" type="text" value="<?php if( empty($_POST) === true || $_POST['contact-first'] == '' ) print_r($fetched_data['contact-first']); else print_r($_POST['contact-first']); ?>" placeholder="Juan">
          </td>
        </tr>

        <tr>
          <th class="required">Apellidos del Contacto [*]</th>
          <td>
            <input class="w-input" name="contact-last" type="text" value="<?php if( empty($_POST) === true || $_POST['contact-last'] == '' ) print_r($fetched_data['contact-last']); else print_r($_POST['contact-last']); ?>" placeholder="Del Pueblo">
          </td>
        </tr>

        <tr>
          <th class="required">Teléfono del Contacto [*]</th>
          <td>
            <input class="w-input" name="phone" type="text" value="<?php if( empty($_POST) === true || $_POST['phone'] == '' ) print_r($fetched_data['phone']); else print_r($_POST['phone']); ?>" placeholder="111-222-3333">
          </td>
        </tr>

        <tr>
          <th class="required">E-mail del Contacto [*]</th>
          <td>
            <input class="w-input" name="contact-email" type="text" value="<?php if( empty($_POST) === true || $_POST['contact-email'] == '' ) print_r($fetched_data['contact-email']); else print_r($_POST['contact-email']); ?>" placeholder="Ponga el e-mail de las persona">
          </td>
        </tr>
      </tbody>

      <tbody>
        <tr>
          <td colspan="2" align="right">
           <input class="w-button" type="submit" value="Continuar">
          </td>
        </tr>
      </tbody>

    </form>

</tbody>
</table>