<?php

/*
  Calls the function that retrieves the data
  */
  $fetched_data = user_campaign_data($_GET['id']);
  // Separate into array
  $fetched_data['category'] = explode(",", $fetched_data['category']);

echo 'Por favor espere mientras se carga el archivo al presionar SOMETER.  Puede parecer que no hace nada pero no es así.<br>';

// DISPLAY THE ERROR MESSAGES IF APPROPRIATE

// If an error while Uploading happened
if($_GET['e1'] == '1')
{
  echo '<font color="red">Ocurrió un error al subir el Logo.  Por favor, intente denuevo.
        <br> Possibles errores:
        <br> Tamaño Máximo Excedido (1MB)
        <br> Se interrumpió la carga.</font>';
}

// If Invalid Logo/Picture Extension
if($_GET['e2'] == '1')
{
  echo '<font color="red">Extensión de Logo Inválida.  Archivos permitidos: JPG, GIF, PNG y BMP</font>';
}

// If Not Successful
if($_GET['e3'] == '1')
{
  echo '<font color="red">No se logró cargar el archivo!  Por favor, intente denuevo.</font>';
}

// Missing required fields
if($_GET['e4'] == '1')
{
  echo '<font color="red">¡Los campos marcados con [*] son requeridos!</font>';
}

// DISPLAY THE SUCCESS MESSAGES IF APPROPRIATE

// If Logo Upload was OK and information saved in DB
if($_GET['success'] == true)
{
  echo '<center><font color="green"><p>¡La Campaña fué actualizada!</p></font>';
}

// Invalid Date
if($_GET['e5'] == '1')
{
  echo '<font color="red">Formato de fecha inválido!  Use el formato recomendado.</font>';
}

// Invalid e-mail format
if($_GET['e6'] == '1')
{
  echo '<font color="red"><p>¡Formato de e-mail inválido!</p></font>';
}

?>

  <!-- CAMPAIGN INFORMATION -->

  <table>
  <tbody>

      <form class="login-form" enctype="multipart/form-data" action="../uploads/admin-edit-campaign.php" method="POST">

        <!-- Hidden values for DB insertion -->
        <input class="w-input" name="id" type="hidden" value="<?php echo $_GET['id']; ?>">

        <tbody>
          <tr>
            <td colspan="2">
              <hr>
            </td>
          </tr>

          <tr>
            <th>Logo</th>
            <td>
              <img src="<?php echo $fetched_data['campaign-logo']; ?>" height="200" width="200"><br>
              <input class="w-input" name="MAX_FILE_SIZE" type="hidden" value="1048576">
              <div>
                <input class="w-input" name="file" type="file">
              </div>
            </td>
          </tr>

          <tr>
            <th class="required">Meta a recolectar [*]</th>
            <td>
              <input class="w-input" name="goal" type="text" value="<?php if( empty($_GET['goal']) === false ) { print_r($_GET['goal']); } else { print_r($fetched_data['goal']); } ?>" placeholder="Ej: 7250.75  (Sin $)">
            </td>
          </tr>

          <tr>
            <th class="required">Descripción (Info) [*]</th>
            <td>
              <textarea class="w-input" name="info" maxlength="250" rows="2" placeholder="Entre información de la campaña. (Propósito, quien se beneficia)  MAX 250 Caracteres"><?php if( empty($_GET['info']) === false ) { print_r($_GET['info']); } else { print_r($fetched_data['info']); } ?></textarea>
            </td>
          </tr>

          <tr>
            <th class="required">Dirección de PayPal [*]</th>
            <td>
              <input class="w-input" name="paypal" type="text" value="<?php if( empty($_GET['paypal']) === false ) { print_r($_GET['paypal']); } else { print_r($fetched_data['paypal']); } ?>" placeholder="Enter dirección de PayPal">
            </td>
          </tr>

          <tr>
            <th class="required">Fecha de Finalización [*] <br>FORMATO YYYY-MM-DD</th>
            <td>
              <input class="w-input" name="end" type="date" value="<?php if( empty($_GET['end']) === false ) { print_r($_GET['end']); } else { print_r($fetched_data['end']); } ?>" placeholder="yyyy-mm-dd">
            </td>
          </tr>

          <tr>
            <th class="required">Categoría [*]</th>
            <td>
            <div class="block">
              <br>
              <input name="category[]" type="checkbox" value="Agricultural"       <?php if( in_array("Agricultural", $fetched_data['category']) ) { echo ' checked = "checked"'; } ?> >Agricultural
              <input name="category[]" type="checkbox" value="Animal"             <?php if( in_array("Animal", $fetched_data['category']) ) { echo ' checked = "checked"'; }  ?> >Animal
              <input name="category[]" type="checkbox" value="Art & Culture"      <?php if( in_array("Art & Culture", $fetched_data['category']) ) { echo ' checked = "checked"'; } ?> >Arte y Cultura
              <input name="category[]" type="checkbox" value="Children"           <?php if( in_array("Children", $fetched_data['category']) ) { echo ' checked = "checked"'; } ?> >Niños
              <input name="category[]" type="checkbox" value="Climate Change"     <?php if( in_array("Climate Change", $fetched_data['category']) ) { echo ' checked = "checked"'; } ?> >Cambio Climatológico
              <br>
              <input name="category[]" type="checkbox" value="Disaster Relief"    <?php if( in_array("Disaster Relief", $fetched_data['category']) ) { echo ' checked = "checked"'; } ?> >Ayuda de Desastres
              <input name="category[]" type="checkbox" value="Economic Development" <?php if( in_array("Economic Development", $fetched_data['category']) ) { echo ' checked = "checked"'; } ?> >Desarrollo Económico
              <input name="category[]" type="checkbox" value="Education"          <?php if( in_array("Education", $fetched_data['category']) ) { echo ' checked = "checked"'; } ?> >Educación
              <input name="category[]" type="checkbox" value="Environment"        <?php if( in_array("Environment", $fetched_data['category']) ) { echo ' checked = "checked"'; } ?> >Ambiente
              <br>
              <input name="category[]" type="checkbox" value="Federal"            <?php if( in_array("Federal", $fetched_data['category']) ) { echo ' checked = "checked"'; } ?> >Federal
              <input name="category[]" type="checkbox" value="Health"             <?php if( in_array("Health", $fetched_data['category']) ) { echo ' checked = "checked"'; } ?> >Salud
              <input name="category[]" type="checkbox" value="Humanitarian Help"  <?php if( in_array("Humanitarian Help", $fetched_data['category']) ) { echo ' checked = "checked"'; } ?> >Ayuda Humanitaria
              <input name="category[]" type="checkbox" value="Human Rights"       <?php if( in_array("Human Rights", $fetched_data['category']) ) { echo ' checked = "checked"'; } ?> >Derechos Humanos
              <input name="category[]" type="checkbox" value="Labor"              <?php if( in_array("Labor", $fetched_data['category']) ) { echo ' checked = "checked"'; } ?> >Labor/Empleo
              <br>
              <input name="category[]" type="checkbox" value="Literacy"           <?php if( in_array("Literacy", $fetched_data['category']) ) { echo ' checked = "checked"'; } ?> >Alfabetización
              <input name="category[]" type="checkbox" value="Political"          <?php if( in_array("Political", $fetched_data['category']) ) { echo ' checked = "checked"'; } ?> >Política
              <input name="category[]" type="checkbox" value="Scientific"         <?php if( in_array("Scientific", $fetched_data['category']) ) { echo ' checked = "checked"'; } ?> >Científica
              <input name="category[]" type="checkbox" value="Social & Recreational" <?php if( in_array("Social & Recreational", $fetched_data['category']) ) { echo ' checked = "checked"'; } ?> >Social y Recreacional
              <input name="category[]" type="checkbox" value="Religious"          <?php if( in_array("Religious", $fetched_data['category']) ) { echo ' checked = "checked"'; } ?> >Religiosa
              <br>
              <input name="category[]" type="checkbox" value="Sports"             <?php if( in_array("Sports", $fetched_data['category']) ) { echo ' checked = "checked"'; } ?> >Deportes
              <input name="category[]" type="checkbox" value="Technology"         <?php if( in_array("Technology", $fetched_data['category']) ) { echo ' checked = "checked"'; } ?> >Tecnología
              <input name="category[]" type="checkbox" value="Veteran"            <?php if( in_array("Veteran", $fetched_data['category']) ) { echo ' checked = "checked"'; } ?> >Veteranos
              <input name="category[]" type="checkbox" value="Women & Girls"      <?php if( in_array("Women & Girls", $fetched_data['category']) ) { echo ' checked = "checked"'; } ?> >Mujeres y niñas
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