<section class="content-section">
  <!-- Is inside a container -->
  <div class="w-container">
    <!-- With 1 columns -->
    <div class="w-row">

<?php
$show = 1;
  // If the POST has information
  if(empty($_POST) === false)
  {
    // Establish which fields are required
    $required_fields = array('r1', 'r2', 'r3', 'r4', 'r5', 'r6', 'r7', 'email');
    
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
      // Check if the e-mail already voted
      if(mysql_result(mysql_query("SELECT COUNT(`email`) FROM `ratings` WHERE `id` = " . $_GET['id'] . " AND `email` = " . $_POST['email']), 0) > 0)
      {
        // Display the appropriate message
        $errors[] = 'Lo sentimos, usted ya evaluó la Organización.';
      }
      // Check if the e-mail has the right form
      if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) === false)
      {
        // Display the appropriate message
        $errors[] = 'Se requiere un e-mail válido.';
      }
    }
  }

  // If the post is not empty and there are no errors
  if(empty($_POST) === false && empty($errors) === true)
  {
    // Save the user data in array
    mysql_query("INSERT INTO `ratings` (`id`, `name`, `email`, `r1`,`r2`,`r3`,`r4`,`r5`,`r6`,`r7`) 
                  VALUES('".$_GET['id']."','".$_POST['name']."','".$_POST['email']."','".$_POST['r1']."','".
      $_POST['r2']."','".$_POST['r3']."','".$_POST['r4']."','".$_POST['r5']."','".$_POST['r6']."','".$_POST['r7']."')");

    echo '<center><font color="green"><p>Gracias por evaluar a ésta Organización.</p></font>';

    echo '<center><font color="green"><p>En 5 segundos se le redirigirá a la página de la Organización
    Si no es así, presione <a href="nfpo-details.php?id=' . $_GET['id'] . '">aquí</a>.</p></font>';

    $show = 0;

    echo '<meta http-equiv="refresh" content="5;url=nfpo-details.php?id=' . $_GET['id'] . '">';

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

  if($show)
  {
?>

  <!-- ACTUAL FORM -->

  <table>

  <tbody>

  <form class="login-form" enctype="multipart/form-data" action="" method="POST">

    <tr>
      <th class="required">Nombre: [*]</th>
      <td>
        <input class="w-input" type="text" placeholder="Enter your name" name="name" value="<?php print_r($_POST['name']);?>">
      </td>
    </tr>

    <tr>
      <th class="required">E-mail: [*]</th>
      <td>
        <input class="w-input" type="text" placeholder="Enter your e-mail address" name="email" value="<?php print_r($_POST['email']);?>">
      </td>
    </tr>

    <tr>
      <th class="required">Atmósfera: [*]</th>
      <td>
        <select name="r1">
          <option value="5" <?php if($_POST['r1'] == '5') echo 'selected="selected"';?>>Excellent</option>
          <option value="4" <?php if($_POST['r1'] == '4') echo 'selected="selected"';?>>Good</option>
          <option value="3" <?php if($_POST['r1'] == '3') echo 'selected="selected"';?>>Average</option>
          <option value="2" <?php if($_POST['r1'] == '2') echo 'selected="selected"';?>>Bad</option>
          <option value="1" <?php if($_POST['r1'] == '1') echo 'selected="selected"';?>>Horrible</option>
        </select>
      </td>
    </tr>

        <tr>
      <th class="required">Atención: [*]</th>
      <td>
        <select name="r2">
          <option value="5" <?php if($_POST['r2'] == '5') echo 'selected="selected"';?>>Excellent</option>
          <option value="4" <?php if($_POST['r2'] == '4') echo 'selected="selected"';?>>Good</option>
          <option value="3" <?php if($_POST['r2'] == '3') echo 'selected="selected"';?>>Average</option>
          <option value="2" <?php if($_POST['r2'] == '2') echo 'selected="selected"';?>>Bad</option>
          <option value="1" <?php if($_POST['r2'] == '1') echo 'selected="selected"';?>>Horrible</option>
        </select>
      </td>
    </tr>

        <tr>
      <th class="required">Costo: [*]</th>
      <td>
        <select name="r3">
          <option value="5" <?php if($_POST['r3'] == '5') echo 'selected="selected"';?>>Excellent</option>
          <option value="4" <?php if($_POST['r3'] == '4') echo 'selected="selected"';?>>Good</option>
          <option value="3" <?php if($_POST['r3'] == '3') echo 'selected="selected"';?>>Average</option>
          <option value="2" <?php if($_POST['r3'] == '2') echo 'selected="selected"';?>>Bad</option>
          <option value="1" <?php if($_POST['r3'] == '1') echo 'selected="selected"';?>>Horrible</option>
        </select>
      </td>
    </tr>

        <tr>
      <th class="required">Localización: [*]</th>
      <td>
        <select name="r4">
          <option value="5" <?php if($_POST['r4'] == '5') echo 'selected="selected"';?>>Excellent</option>
          <option value="4" <?php if($_POST['r4'] == '4') echo 'selected="selected"';?>>Good</option>
          <option value="3" <?php if($_POST['r4'] == '3') echo 'selected="selected"';?>>Average</option>
          <option value="2" <?php if($_POST['r4'] == '2') echo 'selected="selected"';?>>Bad</option>
          <option value="1" <?php if($_POST['r4'] == '1') echo 'selected="selected"';?>>Horrible</option>
        </select>
      </td>
    </tr>

        <tr>
      <th class="required">Organización: [*]</th>
      <td>
        <select name="r5">
          <option value="5" <?php if($_POST['r5'] == '5') echo 'selected="selected"';?>>Excellent</option>
          <option value="4" <?php if($_POST['r5'] == '4') echo 'selected="selected"';?>>Good</option>
          <option value="3" <?php if($_POST['r5'] == '3') echo 'selected="selected"';?>>Average</option>
          <option value="2" <?php if($_POST['r5'] == '2') echo 'selected="selected"';?>>Bad</option>
          <option value="1" <?php if($_POST['r5'] == '1') echo 'selected="selected"';?>>Horrible</option>
        </select>
      </td>
    </tr>

        <tr>
      <th class="required">Calidad de Servicio: [*]</th>
      <td>
        <select name="r6">
          <option value="5" <?php if($_POST['r6'] == '5') echo 'selected="selected"';?>>Excellent</option>
          <option value="4" <?php if($_POST['r6'] == '4') echo 'selected="selected"';?>>Good</option>
          <option value="3" <?php if($_POST['r6'] == '3') echo 'selected="selected"';?>>Average</option>
          <option value="2" <?php if($_POST['r6'] == '2') echo 'selected="selected"';?>>Bad</option>
          <option value="1" <?php if($_POST['r6'] == '1') echo 'selected="selected"';?>>Horrible</option>
        </select>
      </td>
    </tr>

        <tr>
      <th class="required">Rapidez: [*]</th>
      <td>
        <select name="r7">
          <option value="5" <?php if($_POST['r7'] == '5') echo 'selected="selected"';?>>Excellent</option>
          <option value="4" <?php if($_POST['r7'] == '4') echo 'selected="selected"';?>>Good</option>
          <option value="3" <?php if($_POST['r7'] == '3') echo 'selected="selected"';?>>Average</option>
          <option value="2" <?php if($_POST['r7'] == '2') echo 'selected="selected"';?>>Bad</option>
          <option value="1" <?php if($_POST['r7'] == '1') echo 'selected="selected"';?>>Horrible</option>
        </select>
      </td>
    </tr>

  </tbody>

  <tbody>
    <tr>
      <td colspan="2" align="right">
       <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
       <input class="w-button" type="submit" value="¡Evaluar!">
      </td>
    </tr>
  </tbody>

  </form>

  </table>

<?php } ?>

    </div>

  </div>

</section>