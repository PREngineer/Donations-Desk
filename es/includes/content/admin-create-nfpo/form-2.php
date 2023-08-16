<?php

  // If the POST has information
  if(empty($_POST) === false)
  {
    // Establish which fields are required
    $required_fields = array('username', 'organization-name');
    
    // Check all the values provided in the post
    foreach($_POST as $key=>$value)
    {
      // If any of the required fields are not provided
      if( (empty($value) && in_array($key, $required_fields) === true) )
      {
        // Make an error that says it.
        $errors[] = 'Campos marcados con [*] son requeridos.';
        break 1;
      }
    }
    
    // If there are no errors, check for possible errors
    if(empty($errors) === true)
    {
      // Get every part of the date
      list($y,$m,$d) = explode('-', $_POST['inc-date']);
      // Check the date is filled properly
      if(checkdate($m, $d, $y) == false && $_POST['inc-date'] !== '')
      {
        echo '<br>Month: ' .$m . ' Day: ' . $d . ' Year: ' . $y;
        // Display the appropriate message
        $errors[] = 'Formato de Fecha de Incorporación es incorrecto, debe ser: yyyy-mm-dd';
      }

      // Check the Organization Name is not already registered when creating a new entry
      if( organization_exists($_POST['organization-name']) === true )
      {
        $errors[] = 'Ese nombre de Organización ya está registrado.';
      }

    }

  }

  // If the post is not empty and there are no errors
  if(empty($_POST) === false && empty($errors) === true)
  {
    // Save the nfpo data in array
    $nfpo_data = array(
        'username'            => $_POST['username'],
        'organization-name'   => $_POST['organization-name'],
        'physical-address'    => $_POST['physical-address'],
        'postal-address'      => $_POST['postal-address'],
        'municipality'        => $_POST['municipality'],
        'zip'                 => $_POST['zip'],
        'inc-date'            => $_POST['inc-date'],
        'foundations'         => implode(",", $_POST['foundations']),
        'category'            => implode(",", $_POST['category'])
      );

    // Create the NFPO entry in DB
    register_nfpo($nfpo_data);

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
  echo '<center><font color="green"><p>¡Organización Creada!</p></font>';
}
?>

  <!-- Part 4: NFPO INFORMATION -->

  <table>
  <tbody>

      <form class="login-form" enctype="multipart/form-data" action="" method="POST">

        <tbody>
          <tr>
            <td colspan="2">
              <hr>
              <h2>Información Básica</h2>            
            </td>
          </tr>

          <tr>
            <th class="required">Usuario [*]</th>
            <td>
              <input class="w-input" name="username" type="text" value="<?php print_r($_POST['username']); ?>" placeholder="Entre Usuario">
            </td>
          </tr>

          <tr>
            <th class="required">Nombre de Organización [*]</th>
            <td>
              <input class="w-input" name="organization-name" type="text" value="<?php print_r($_POST['organization-name']); ?>" placeholder="Entre el Nombre de la Organización">
            </td>
          </tr>

          <tr>
            <th class="required">Dirección Física [*]</th>
            <td>
              <textarea class="w-input" name="physical-address" rows="2" placeholder="Entre la Dirección Física"><?php print_r($_POST['physical-address']); ?></textarea>
            </td>
          </tr>

          <tr>
            <th class="required">Dirección Postal [*]</th>
            <td>
              <textarea class="w-input" name="postal-address" rows="2" placeholder="Entre la Dirección Postal"><?php print_r($_POST['postal-address']); ?></textarea>
            </td>
          </tr>

          <tr>
            <th class="required">Pueblo [*]</th>
            <td>
              <select name="municipality" size="1">
                <option value=""              <?php if( empty($_POST) === true ) {if ($fetched_data['municipality'] == '')             echo ' selected = "selected"';} else{if($_POST['municipality'] == '') echo ' selected = "selected"';} ?> >Seleccione Pueblo</option>
                <option value="Adjuntas"      <?php if( empty($_POST) === true ) {if ($fetched_data['municipality'] == 'Adjuntas')     echo ' selected = "selected"';} else{if($_POST['municipality'] == 'Adjuntas') echo ' selected = "selected"';} ?> >Adjuntas</option>
                <option value="Aguada"        <?php if( empty($_POST) === true ) {if ($fetched_data['municipality'] == 'Aguada')       echo ' selected = "selected"';} else{if($_POST['municipality'] == 'Aguada') echo ' selected = "selected"';} ?> >Aguada</option>
                <option value="Aguadilla"     <?php if( empty($_POST) === true ) {if ($fetched_data['municipality'] == 'Aguadilla')    echo ' selected = "selected"';} else{if($_POST['municipality'] == 'Aguadilla') echo ' selected = "selected"';} ?> >Aguadilla</option>
                <option value="Aguas Buenas"  <?php if( empty($_POST) === true ) {if ($fetched_data['municipality'] == 'Aguas Buenas') echo ' selected = "selected"';} else{if($_POST['municipality'] == 'Aguas Buenas') echo ' selected = "selected"';} ?> >Aguas Buenas</option>
                <option value="Aibonito"      <?php if( empty($_POST) === true ) {if ($fetched_data['municipality'] == 'Aibonito')     echo ' selected = "selected"';} else{if($_POST['municipality'] == 'Aibonito') echo ' selected = "selected"';} ?> >Aibonito</option>
                <option value="Añasco"        <?php if( empty($_POST) === true ) {if ($fetched_data['municipality'] == 'Añasco')       echo ' selected = "selected"';} else{if($_POST['municipality'] == 'Añasco') echo ' selected = "selected"';} ?> >Añasco</option>
                <option value="Arecibo"       <?php if( empty($_POST) === true ) {if ($fetched_data['municipality'] == 'Arecibo')      echo ' selected = "selected"';} else{if($_POST['municipality'] == 'Arecibo') echo ' selected = "selected"';} ?> >Arecibo</option>
                <option value="Arroyo"        <?php if( empty($_POST) === true ) {if ($fetched_data['municipality'] == 'Arroyo')       echo ' selected = "selected"';} else{if($_POST['municipality'] == 'Arroyo') echo ' selected = "selected"';} ?> >Arroyo</option>
                <option value="Barceloneta"   <?php if( empty($_POST) === true ) {if ($fetched_data['municipality'] == 'Barceloneta')  echo ' selected = "selected"';} else{if($_POST['municipality'] == 'Barceloneta') echo ' selected = "selected"';} ?> >Barceloneta</option>
                <option value="Barranquitas"  <?php if( empty($_POST) === true ) {if ($fetched_data['municipality'] == 'Barranquitas') echo ' selected = "selected"';} else{if($_POST['municipality'] == 'Barranquitas') echo ' selected = "selected"';} ?> >Barranquitas</option>
                <option value="Bayamón"       <?php if( empty($_POST) === true ) {if ($fetched_data['municipality'] == 'Bayamón')      echo ' selected = "selected"';} else{if($_POST['municipality'] == 'Bayamón') echo ' selected = "selected"';} ?> >Bayamón</option>
                <option value="Cabo Rojo"     <?php if( empty($_POST) === true ) {if ($fetched_data['municipality'] == 'Cabo Rojo')    echo ' selected = "selected"';} else{if($_POST['municipality'] == 'Cabo Rojo') echo ' selected = "selected"';} ?> >Cabo Rojo</option>
                <option value="Caguas"        <?php if( empty($_POST) === true ) {if ($fetched_data['municipality'] == 'Caguas')       echo ' selected = "selected"';} else{if($_POST['municipality'] == 'Caguas') echo ' selected = "selected"';} ?> >Caguas</option>
                <option value="Camuy"         <?php if( empty($_POST) === true ) {if ($fetched_data['municipality'] == 'Camuy')        echo ' selected = "selected"';} else{if($_POST['municipality'] == 'Camuy') echo ' selected = "selected"';} ?> >Camuy</option>
                <option value="Canóvanas"     <?php if( empty($_POST) === true ) {if ($fetched_data['municipality'] == 'Canóvanas')    echo ' selected = "selected"';} else{if($_POST['municipality'] == 'Canóvanas') echo ' selected = "selected"';} ?> >Canóvanas</option>
                <option value="Carolina"      <?php if( empty($_POST) === true ) {if ($fetched_data['municipality'] == 'Carolina')     echo ' selected = "selected"';} else{if($_POST['municipality'] == 'Carolina') echo ' selected = "selected"';} ?> >Carolina</option>
                <option value="Cataño"        <?php if( empty($_POST) === true ) {if ($fetched_data['municipality'] == 'Cataño')       echo ' selected = "selected"';} else{if($_POST['municipality'] == 'Cataño') echo ' selected = "selected"';} ?> >Cataño</option>
                <option value="Cayey"         <?php if( empty($_POST) === true ) {if ($fetched_data['municipality'] == 'Cayey')        echo ' selected = "selected"';} else{if($_POST['municipality'] == 'Cayey') echo ' selected = "selected"';} ?> >Cayey</option>
                <option value="Ceiba"         <?php if( empty($_POST) === true ) {if ($fetched_data['municipality'] == 'Ceiba')        echo ' selected = "selected"';} else{if($_POST['municipality'] == 'Ceiba') echo ' selected = "selected"';} ?> >Ceiba</option>
                <option value="Ciales"        <?php if( empty($_POST) === true ) {if ($fetched_data['municipality'] == 'Ciales')       echo ' selected = "selected"';} else{if($_POST['municipality'] == 'Ciales') echo ' selected = "selected"';} ?> >Ciales</option>
                <option value="Cidra"         <?php if( empty($_POST) === true ) {if ($fetched_data['municipality'] == 'Cidra')        echo ' selected = "selected"';} else{if($_POST['municipality'] == 'Cidra') echo ' selected = "selected"';} ?> >Cidra</option>
                <option value="Coamo"         <?php if( empty($_POST) === true ) {if ($fetched_data['municipality'] == 'Coamo')        echo ' selected = "selected"';} else{if($_POST['municipality'] == 'Coamo') echo ' selected = "selected"';} ?> >Coamo</option>
                <option value="Comerío"       <?php if( empty($_POST) === true ) {if ($fetched_data['municipality'] == 'Comerío')      echo ' selected = "selected"';} else{if($_POST['municipality'] == 'Comerío') echo ' selected = "selected"';} ?> >Comerío</option>
                <option value="Corozal"       <?php if( empty($_POST) === true ) {if ($fetched_data['municipality'] == 'Corozal')      echo ' selected = "selected"';} else{if($_POST['municipality'] == 'Corozal') echo ' selected = "selected"';} ?> >Corozal</option>
                <option value="Culebra"       <?php if( empty($_POST) === true ) {if ($fetched_data['municipality'] == 'Culebra')      echo ' selected = "selected"';} else{if($_POST['municipality'] == 'Culebra') echo ' selected = "selected"';} ?> >Culebra</option>
                <option value="Dorado"        <?php if( empty($_POST) === true ) {if ($fetched_data['municipality'] == 'Dorado')       echo ' selected = "selected"';} else{if($_POST['municipality'] == 'Dorado') echo ' selected = "selected"';} ?> >Dorado</option>
                <option value="Fajardo"       <?php if( empty($_POST) === true ) {if ($fetched_data['municipality'] == 'Fajardo')      echo ' selected = "selected"';} else{if($_POST['municipality'] == 'Fajardo') echo ' selected = "selected"';} ?> >Fajardo</option>
                <option value="Florida"       <?php if( empty($_POST) === true ) {if ($fetched_data['municipality'] == 'Florida')      echo ' selected = "selected"';} else{if($_POST['municipality'] == 'Florida') echo ' selected = "selected"';} ?> >Florida</option>
                <option value="Guánica"       <?php if( empty($_POST) === true ) {if ($fetched_data['municipality'] == 'Guánica')      echo ' selected = "selected"';} else{if($_POST['municipality'] == 'Guánica') echo ' selected = "selected"';} ?> >Guánica</option>
                <option value="Guayama"       <?php if( empty($_POST) === true ) {if ($fetched_data['municipality'] == 'Guayama')      echo ' selected = "selected"';} else{if($_POST['municipality'] == 'Guayama') echo ' selected = "selected"';} ?> >Guayama</option>
                <option value="Guayanilla"    <?php if( empty($_POST) === true ) {if ($fetched_data['municipality'] == 'Guayanilla')   echo ' selected = "selected"';} else{if($_POST['municipality'] == 'Guayanilla') echo ' selected = "selected"';} ?> >Guayanilla</option>
                <option value="Guaynabo"      <?php if( empty($_POST) === true ) {if ($fetched_data['municipality'] == 'Guaynabo')     echo ' selected = "selected"';} else{if($_POST['municipality'] == 'Guaynabo') echo ' selected = "selected"';} ?> >Guaynabo</option>
                <option value="Gurabo"        <?php if( empty($_POST) === true ) {if ($fetched_data['municipality'] == 'Gurabo')       echo ' selected = "selected"';} else{if($_POST['municipality'] == 'Gurabo') echo ' selected = "selected"';} ?> >Gurabo</option>
                <option value="Hatillo"       <?php if( empty($_POST) === true ) {if ($fetched_data['municipality'] == 'Hatillo')      echo ' selected = "selected"';} else{if($_POST['municipality'] == 'Hatillo') echo ' selected = "selected"';} ?> >Hatillo</option>
                <option value="Hormigueros"   <?php if( empty($_POST) === true ) {if ($fetched_data['municipality'] == 'Hormigueros')  echo ' selected = "selected"';} else{if($_POST['municipality'] == 'Hormigueros') echo ' selected = "selected"';} ?> >Hormigueros</option>
                <option value="Humacao"       <?php if( empty($_POST) === true ) {if ($fetched_data['municipality'] == 'Humacao')      echo ' selected = "selected"';} else{if($_POST['municipality'] == 'Humacao') echo ' selected = "selected"';} ?> >Humacao</option>
                <option value="Isabela"       <?php if( empty($_POST) === true ) {if ($fetched_data['municipality'] == 'Isabela')      echo ' selected = "selected"';} else{if($_POST['municipality'] == 'Isabela') echo ' selected = "selected"';} ?> >Isabela</option>
                <option value="Jayuya"        <?php if( empty($_POST) === true ) {if ($fetched_data['municipality'] == 'Jayuya')       echo ' selected = "selected"';} else{if($_POST['municipality'] == 'Jayuya') echo ' selected = "selected"';} ?> >Jayuya</option>
                <option value="Juana Díaz"    <?php if( empty($_POST) === true ) {if ($fetched_data['municipality'] == 'Juana Díaz')   echo ' selected = "selected"';} else{if($_POST['municipality'] == 'Juana Díaz') echo ' selected = "selected"';} ?> >Juana Díaz</option>
                <option value="Juncos"        <?php if( empty($_POST) === true ) {if ($fetched_data['municipality'] == 'Juncos')       echo ' selected = "selected"';} else{if($_POST['municipality'] == 'Juncos') echo ' selected = "selected"';} ?> >Juncos</option>
                <option value="Lajas"         <?php if( empty($_POST) === true ) {if ($fetched_data['municipality'] == 'Lajas')        echo ' selected = "selected"';} else{if($_POST['municipality'] == 'Lajas') echo ' selected = "selected"';} ?> >Lajas</option>
                <option value="Lares"         <?php if( empty($_POST) === true ) {if ($fetched_data['municipality'] == 'Lares')        echo ' selected = "selected"';} else{if($_POST['municipality'] == 'Lares') echo ' selected = "selected"';} ?> >Lares</option>
                <option value="Las Marías"    <?php if( empty($_POST) === true ) {if ($fetched_data['municipality'] == 'Las Marías')   echo ' selected = "selected"';} else{if($_POST['municipality'] == 'Las Marías') echo ' selected = "selected"';} ?> >Las Marías</option>
                <option value="Las Piedras"   <?php if( empty($_POST) === true ) {if ($fetched_data['municipality'] == 'Las Piedras')  echo ' selected = "selected"';} else{if($_POST['municipality'] == 'Las Piedras') echo ' selected = "selected"';} ?> >Las Piedras</option>
                <option value="Loíza"         <?php if( empty($_POST) === true ) {if ($fetched_data['municipality'] == 'Loíza')        echo ' selected = "selected"';} else{if($_POST['municipality'] == 'Loíza') echo ' selected = "selected"';} ?> >Loíza</option>
                <option value="Luquillo"      <?php if( empty($_POST) === true ) {if ($fetched_data['municipality'] == 'Luquillo')     echo ' selected = "selected"';} else{if($_POST['municipality'] == 'Luquillo') echo ' selected = "selected"';} ?> >Luquillo</option>
                <option value="Manatí"        <?php if( empty($_POST) === true ) {if ($fetched_data['municipality'] == 'Manatí')       echo ' selected = "selected"';} else{if($_POST['municipality'] == 'Manatí') echo ' selected = "selected"';} ?> >Manatí</option>
                <option value="Maricao"       <?php if( empty($_POST) === true ) {if ($fetched_data['municipality'] == 'Maricao')      echo ' selected = "selected"';} else{if($_POST['municipality'] == 'Maricao') echo ' selected = "selected"';} ?> >Maricao</option>
                <option value="Maunabo"       <?php if( empty($_POST) === true ) {if ($fetched_data['municipality'] == 'Maunabo')      echo ' selected = "selected"';} else{if($_POST['municipality'] == 'Maunabo') echo ' selected = "selected"';} ?> >Maunabo</option>
                <option value="Mayagüez"      <?php if( empty($_POST) === true ) {if ($fetched_data['municipality'] == 'Mayagüez')     echo ' selected = "selected"';} else{if($_POST['municipality'] == 'Mayagüez') echo ' selected = "selected"';} ?> >Mayagüez</option>
                <option value="Moca"          <?php if( empty($_POST) === true ) {if ($fetched_data['municipality'] == 'Moca')         echo ' selected = "selected"';} else{if($_POST['municipality'] == 'Moca') echo ' selected = "selected"';} ?> >Moca</option>
                <option value="Morovis"       <?php if( empty($_POST) === true ) {if ($fetched_data['municipality'] == 'Morovis')      echo ' selected = "selected"';} else{if($_POST['municipality'] == 'Morovis') echo ' selected = "selected"';} ?> >Morovis</option>
                <option value="Naguabo"       <?php if( empty($_POST) === true ) {if ($fetched_data['municipality'] == 'Naguabo')      echo ' selected = "selected"';} else{if($_POST['municipality'] == 'Naguabo') echo ' selected = "selected"';} ?> >Naguabo</option>
                <option value="Naranjito"     <?php if( empty($_POST) === true ) {if ($fetched_data['municipality'] == 'Naranjito')    echo ' selected = "selected"';} else{if($_POST['municipality'] == 'Naranjito') echo ' selected = "selected"';} ?> >Naranjito</option>
                <option value="Orocovis"      <?php if( empty($_POST) === true ) {if ($fetched_data['municipality'] == 'Orocovis')     echo ' selected = "selected"';} else{if($_POST['municipality'] == 'Orocovis') echo ' selected = "selected"';} ?> >Orocovis</option>
                <option value="Patillas"      <?php if( empty($_POST) === true ) {if ($fetched_data['municipality'] == 'Patillas')     echo ' selected = "selected"';} else{if($_POST['municipality'] == 'Patillas') echo ' selected = "selected"';} ?> >Patillas</option>
                <option value="Peñuelas"      <?php if( empty($_POST) === true ) {if ($fetched_data['municipality'] == 'Peñuelas')     echo ' selected = "selected"';} else{if($_POST['municipality'] == 'Peñuelas') echo ' selected = "selected"';} ?> >Peñuelas</option>
                <option value="Ponce"         <?php if( empty($_POST) === true ) {if ($fetched_data['municipality'] == 'Ponce')        echo ' selected = "selected"';} else{if($_POST['municipality'] == 'Ponce') echo ' selected = "selected"';} ?> >Ponce</option>
                <option value="Quebradillas"  <?php if( empty($_POST) === true ) {if ($fetched_data['municipality'] == 'Quebradillas') echo ' selected = "selected"';} else{if($_POST['municipality'] == 'Quebradillas') echo ' selected = "selected"';} ?> >Quebradillas</option>
                <option value="Rincón"        <?php if( empty($_POST) === true ) {if ($fetched_data['municipality'] == 'Rincón')       echo ' selected = "selected"';} else{if($_POST['municipality'] == 'Rincón') echo ' selected = "selected"';} ?> >Rincón</option>
                <option value="Río Grande"    <?php if( empty($_POST) === true ) {if ($fetched_data['municipality'] == 'Río Grande')   echo ' selected = "selected"';} else{if($_POST['municipality'] == 'Río Grande') echo ' selected = "selected"';} ?> >Río Grande</option>
                <option value="Sabana Grande" <?php if( empty($_POST) === true ) {if ($fetched_data['municipality'] == 'Sabana Grande') echo ' selected = "selected"';} else{if($_POST['municipality'] == 'Sabana Grande') echo ' selected = "selected"';} ?> >Sabana Grande</option>
                <option value="Salinas"       <?php if( empty($_POST) === true ) {if ($fetched_data['municipality'] == 'Salinas')      echo ' selected = "selected"';} else{if($_POST['municipality'] == 'Salinas') echo ' selected = "selected"';} ?> >Salinas</option>
                <option value="San Germán"    <?php if( empty($_POST) === true ) {if ($fetched_data['municipality'] == 'San Germán')   echo ' selected = "selected"';} else{if($_POST['municipality'] == 'San Germán') echo ' selected = "selected"';} ?> >San Germán</option>
                <option value="San Juan"      <?php if( empty($_POST) === true ) {if ($fetched_data['municipality'] == 'San Juan')     echo ' selected = "selected"';} else{if($_POST['municipality'] == 'San Juan') echo ' selected = "selected"';} ?> >San Juan</option>
                <option value="San Lorenzo"   <?php if( empty($_POST) === true ) {if ($fetched_data['municipality'] == 'San Lorenzo')  echo ' selected = "selected"';} else{if($_POST['municipality'] == 'San Lorenzo') echo ' selected = "selected"';} ?> >San Lorenzo</option>
                <option value="San Sebastián" <?php if( empty($_POST) === true ) {if ($fetched_data['municipality'] == 'San Sebastián') echo ' selected = "selected"';} else{if($_POST['municipality'] == 'San Sebastián') echo ' selected = "selected"';} ?> >San Sebastián</option>
                <option value="Santa Isabel"  <?php if( empty($_POST) === true ) {if ($fetched_data['municipality'] == 'Santa Isabel') echo ' selected = "selected"';} else{if($_POST['municipality'] == 'Santa Isabel') echo ' selected = "selected"';} ?> >Santa Isabel</option>
                <option value="Toa Alta"      <?php if( empty($_POST) === true ) {if ($fetched_data['municipality'] == 'Toa Alta')     echo ' selected = "selected"';} else{if($_POST['municipality'] == 'Toa Alta') echo ' selected = "selected"';} ?> >Toa Alta</option>
                <option value="Toa Baja"      <?php if( empty($_POST) === true ) {if ($fetched_data['municipality'] == 'Toa Baja')     echo ' selected = "selected"';} else{if($_POST['municipality'] == 'Toa Baja') echo ' selected = "selected"';} ?> >Toa Baja</option>
                <option value="Trujillo Alto" <?php if( empty($_POST) === true ) {if ($fetched_data['municipality'] == 'Trujillo Alto') echo ' selected = "selected"';} else{if($_POST['municipality'] == 'Trujillo Alto') echo ' selected = "selected"';} ?> >Trujillo Alto</option>
                <option value="Utuado"        <?php if( empty($_POST) === true ) {if ($fetched_data['municipality'] == 'Utuado')       echo ' selected = "selected"';} else{if($_POST['municipality'] == 'Utuado') echo ' selected = "selected"';} ?> >Utuado</option>
                <option value="Vega Alta"     <?php if( empty($_POST) === true ) {if ($fetched_data['municipality'] == 'Vega Alta')    echo ' selected = "selected"';} else{if($_POST['municipality'] == 'Vega Alta') echo ' selected = "selected"';} ?> >Vega Alta</option>
                <option value="Vega Baja"     <?php if( empty($_POST) === true ) {if ($fetched_data['municipality'] == 'Vega Baja')    echo ' selected = "selected"';} else{if($_POST['municipality'] == 'Vega Baja') echo ' selected = "selected"';} ?> >Vega Baja</option>
                <option value="Vieques"       <?php if( empty($_POST) === true ) {if ($fetched_data['municipality'] == 'Vieques')      echo ' selected = "selected"';} else{if($_POST['municipality'] == 'Vieques') echo ' selected = "selected"';} ?> >Vieques</option>
                <option value="Villalba"      <?php if( empty($_POST) === true ) {if ($fetched_data['municipality'] == 'Villalba')     echo ' selected = "selected"';} else{if($_POST['municipality'] == 'Villalba') echo ' selected = "selected"';} ?> >Villalba</option>
                <option value="Yabucoa"       <?php if( empty($_POST) === true ) {if ($fetched_data['municipality'] == 'Yabucoa')      echo ' selected = "selected"';} else{if($_POST['municipality'] == 'Yabucoa') echo ' selected = "selected"';} ?> >Yabucoa</option>
                <option value="Yauco"         <?php if( empty($_POST) === true ) {if ($fetched_data['municipality'] == 'Yauco')        echo ' selected = "selected"';} else{if($_POST['municipality'] == 'Yauco') echo ' selected = "selected"';} ?> >Yauco</option>
              </select>
            </td>
          </tr>

          <tr>
            <th class="required">Zip Code [*]</th>
            <td>
              <input class="w-input" name="zip" type="text" value="<?php if( empty($_POST) === true ) {print_r($fetched_data['zip']);} else{print_r($_POST['zip']);} ?>" placeholder="Entre ZipCode">
            </td>
          </tr>

          <tr>
            <th class="required">Fecha de Incorporación [*]</th>
            <td>
              <input class="w-input" name="inc-date" type="date" value="<?php if( empty($_POST) === true ) {print_r($fetched_data['inc-date']);} else{print_r($_POST['inc-date']);} ?>" placeholder="yyyy-mm-dd">
            </td>
          </tr>

          <tr>
            <th>Auspiciadores</th>
            <td>
            <div class="block">
              <br>
              <input name="foundations[]" type="checkbox" value="Fundación Banco Popular" <?php if( empty($_POST) === true ) {if( in_array("Fundación Banco Popular", $fetched_data['foundations']) ) echo ' checked = "checked"';} else{if( in_array("Fundación Banco Popular", $_POST['foundations']) ) echo ' checked = "checked"';} ?> >
              Fundación Banco Popular
              <input name="foundations[]" type="checkbox" value="Fundación Angel Ramos" <?php if( empty($_POST) === true ) {if( in_array("Fundación Angel Ramos", $fetched_data['foundations']) ) echo ' checked = "checked"';} else{if( in_array("Fundación Angel Ramos", $_POST['foundations']) ) echo ' checked = "checked"';} ?> >
              Fundación Angel Ramos
              <input name="foundations[]" type="checkbox" value="Fondos Unidos" <?php if( empty($_POST) === true ) {if( in_array("Fondos Unidos", $fetched_data['foundations']) ) echo ' checked = "checked"';} else{if( in_array("Fondos Unidos", $_POST['foundations']) ) echo ' checked = "checked"';} ?> >
              Fondos Unidos
              <br>
            </div>
            </td>
          </tr>

          <tr>
            <th class="required">Categoría [*]</th>
            <td>
            <div class="block">
              <br>
              <input name="category[]" type="checkbox" value="Agricultural"       <?php if( empty($_POST) === true ) {if( in_array("Agricultural", $fetched_data['category']) ) echo ' checked = "checked"';} else{if( in_array("Agricultural", $_POST['category']) ) echo ' checked = "checked"';} ?> >
              Agricultural
              <input name="category[]" type="checkbox" value="Animal"             <?php if( empty($_POST) === true ) {if( in_array("Animal", $fetched_data['category']) ) echo ' checked = "checked"';} else{if( in_array("Animal", $_POST['category']) ) echo ' checked = "checked"';} ?> >
              Animal
              <input name="category[]" type="checkbox" value="Art & Culture"      <?php if( empty($_POST) === true ) {if( in_array("Art & Culture", $fetched_data['category']) ) echo ' checked = "checked"';} else{if( in_array("Art & Culture", $_POST['category']) ) echo ' checked = "checked"';} ?> >
              Arte y Culture
              <input name="category[]" type="checkbox" value="Children"           <?php if( empty($_POST) === true ) {if( in_array("Children", $fetched_data['category']) ) echo ' checked = "checked"';} else{if( in_array("Children", $_POST['category']) ) echo ' checked = "checked"';} ?> >
              Niños
              <input name="category[]" type="checkbox" value="Climate Change"     <?php if( empty($_POST) === true ) {if( in_array("Climate Change", $fetched_data['category']) ) echo ' checked = "checked"';} else{if( in_array("Climate Change", $_POST['category']) ) echo ' checked = "checked"';} ?> >
              Cambio Climático
              <br>
              <input name="category[]" type="checkbox" value="Disaster Relief"    <?php if( empty($_POST) === true ) {if( in_array("Disaster Relief", $fetched_data['category']) ) echo ' checked = "checked"';} else{if( in_array("Disaster Relief", $_POST['category']) ) echo ' checked = "checked"';} ?> >
              Ayuda de Desastres
              <input name="category[]" type="checkbox" value="Economic Development" <?php if( empty($_POST) === true ) {if( in_array("Economic Development", $fetched_data['category']) ) echo ' checked = "checked"';} else{if( in_array("Economic Development", $_POST['category']) ) echo ' checked = "checked"';} ?> >
              Desarrollo Económico
              <input name="category[]" type="checkbox" value="Education"          <?php if( empty($_POST) === true ) {if( in_array("Education", $fetched_data['category']) ) echo ' checked = "checked"';} else{if( in_array("Education", $_POST['category']) ) echo ' checked = "checked"';} ?> >
              Educación
              <input name="category[]" type="checkbox" value="Environment"        <?php if( empty($_POST) === true ) {if( in_array("Environment", $fetched_data['category']) ) echo ' checked = "checked"';} else{if( in_array("Environment", $_POST['category']) ) echo ' checked = "checked"';} ?> >
              Ambiente
              <br>
              <input name="category[]" type="checkbox" value="Federal"            <?php if( empty($_POST) === true ) {if( in_array("Federal", $fetched_data['category']) ) echo ' checked = "checked"';} else{if( in_array("Federal", $_POST['category']) ) echo ' checked = "checked"';} ?> >
              Federal
              <input name="category[]" type="checkbox" value="Health"             <?php if( empty($_POST) === true ) {if( in_array("Health", $fetched_data['category']) ) echo ' checked = "checked"';} else{if( in_array("Health", $_POST['category']) ) echo ' checked = "checked"';} ?> >
              Salud
              <input name="category[]" type="checkbox" value="Humanitarian Help"  <?php if( empty($_POST) === true ) {if( in_array("Humanitarian Help", $fetched_data['category']) ) echo ' checked = "checked"';} else{if( in_array("Humanitarian Help", $_POST['category']) ) echo ' checked = "checked"';} ?> >
              Ayuda Humanitaria
              <input name="category[]" type="checkbox" value="Human Rights"       <?php if( empty($_POST) === true ) {if( in_array("Human Rights", $fetched_data['category']) ) echo ' checked = "checked"';} else{if( in_array("Human Rights", $_POST['category']) ) echo ' checked = "checked"';} ?> >
              Derechos Humanos
              <input name="category[]" type="checkbox" value="Labor"              <?php if( empty($_POST) === true ) {if( in_array("Labor", $fetched_data['category']) ) echo ' checked = "checked"';} else{if( in_array("Labor", $_POST['category']) ) echo ' checked = "checked"';} ?> >
              Labor/Empleo
              <br>
              <input name="category[]" type="checkbox" value="Literacy"           <?php if( empty($_POST) === true ) {if( in_array("Literacy", $fetched_data['category']) ) echo ' checked = "checked"';} else{if( in_array("Literacy", $_POST['category']) ) echo ' checked = "checked"';} ?> >
              Alfabetización
              <input name="category[]" type="checkbox" value="Political"          <?php if( empty($_POST) === true ) {if( in_array("Political", $fetched_data['category']) ) echo ' checked = "checked"';} else{if( in_array("Political", $_POST['category']) ) echo ' checked = "checked"';} ?> >
              Política
              <input name="category[]" type="checkbox" value="Scientific"         <?php if( empty($_POST) === true ) {if( in_array("Scientific", $fetched_data['category']) ) echo ' checked = "checked"';} else{if( in_array("Scientific", $_POST['category']) ) echo ' checked = "checked"';} ?> >
              Científica
              <input name="category[]" type="checkbox" value="Social & Recreational" <?php if( empty($_POST) === true ) {if( in_array("Social & Recreational", $fetched_data['category']) ) echo ' checked = "checked"';} else{if( in_array("Social & Recreational", $_POST['category']) ) echo ' checked = "checked"';} ?> >
              Social y Recreacional
              <input name="category[]" type="checkbox" value="Religious"          <?php if( empty($_POST) === true ) {if( in_array("Religious", $fetched_data['category']) ) echo ' checked = "checked"';} else{if( in_array("Religious", $_POST['category']) ) echo ' checked = "checked"';} ?> >
              Religiosa
              <br>
              <input name="category[]" type="checkbox" value="Sports"             <?php if( empty($_POST) === true ) {if( in_array("Sports", $fetched_data['category']) ) echo ' checked = "checked"';} else{if( in_array("Sports", $_POST['category']) ) echo ' checked = "checked"';} ?> >
              Deportes
              <input name="category[]" type="checkbox" value="Technology"         <?php if( empty($_POST) === true ) {if( in_array("Technology", $fetched_data['category']) ) echo ' checked = "checked"';} else{if( in_array("Technology", $_POST['category']) ) echo ' checked = "checked"';} ?> >
              Tecnología
              <input name="category[]" type="checkbox" value="Veteran"            <?php if( empty($_POST) === true ) {if( in_array("Veteran", $fetched_data['category']) ) echo ' checked = "checked"';} else{if( in_array("Veteran", $_POST['category']) ) echo ' checked = "checked"';} ?> >
              Veteranos
              <input name="category[]" type="checkbox" value="Women & Girls"      <?php if( empty($_POST) === true ) {if( in_array("Women & Girls", $fetched_data['category']) ) echo ' checked = "checked"';} else{if( in_array("Women & Girls", $_POST['category']) ) echo ' checked = "checked"';} ?> >
              Mujeres y Niñas
              <br>
            </div>
            </td>
          </tr>
        </tbody>

        <tbody>
          <tr>
            <td colspan="2" align="right">
             <input class="w-button" type="submit" value="Save Changes!">
            </td>
          </tr>
        </tbody>

      </form>

  </tbody>
  </table>