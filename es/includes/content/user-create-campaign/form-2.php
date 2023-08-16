<?php

// DISPLAY THE ERROR MESSAGES IF APPROPRIATE

echo 'Por favor espere en lo que el archivo se carga.  Aunque parezca no responder, si lo está haciendo.<br>';

// If an error while Uploading happened
if($_GET['e1'] == '1')
{
  echo '<font color="red">Un error sucedió al subir el Logo.  Por favor, intente denuevo.
        <br> Posibles errores:
        <br> El Archivo excede tamaño máximo (1MB)
        <br> La carga se interrumpió.</font>';
}

// If Invalid Logo/Picture Extension
if($_GET['e2'] == '1')
{
  echo '<font color="red">Extensión Inválida.  Tipos permitidos: JPG, GIF, PNG y BMP</font>';
}

// If Not Successful
if($_GET['e3'] == '1')
{
  echo '<font color="red">¡La subida no se logró!  Por favor trate denuevo.</font>';
}

// Missing required fields
if($_GET['e4'] == '1')
{
  echo '<font color="red">¡Campos con [*] son requeridos!</font>';
}

// Invalid Date Format
if($_GET['e5'] == '1')
{
  echo '<font color="red">¡Formato de Fecha Inválido!  Use el formato recomendado.</font>';
}

// Invalid e-mail format
if($_GET['e6'] == '1')
{
  echo '<font color="red"><p>Formato de E-mail inválido!</p></font>';
}

// DISPLAY THE SUCCESS MESSAGES IF APPROPRIATE

// If Logo Upload was OK and information saved in DB
if($_GET['success'] == true)
{
  echo '<center><font color="green"><p>¡Campaña creada!</p></font>';
}

?>

  <!-- Part 4: NFPO INFORMATION -->

  <table>
  <tbody>

      <form class="login-form" enctype="multipart/form-data" action="../uploads/create-campaign.php" method="POST">

        <!-- Hidden values for DB insertion -->
        <input class="w-input" name="user" type="hidden" value="<?php echo $user_data['username']; ?>">

        <tbody>
          <tr>
            <td colspan="2">
              <hr>
            </td>
          </tr>

          <tr>
            <th>Logo de Campaña</th>
            <td>
              <input class="w-input" name="MAX_FILE_SIZE" type="hidden" value="1048576">
              <div>
                <input class="w-input" name="file" type="file">
              </div>
            </td>
          </tr>

          <tr>
            <th class="required">Meta [*]</th>
            <td>
              <input class="w-input" name="goal" type="text" value="<?php if( empty($_GET) === false ) { print_r($_GET['goal']); } ?>" placeholder="Ex: 7250.75  (NO $ SIGN)">
            </td>
          </tr>

          <tr>
            <th class="required">Descripción (Info) [*]</th>
            <td>
              <textarea class="w-input" name="info" maxlength="250" rows="2" placeholder="Enter information about this campaign. (Purpose, who benefits from it)  MAX 250 Characters"><?php if( empty($_GET) === false ) { print_r($_GET['info']); } ?></textarea>
            </td>
          </tr>

          <tr>
            <th class="required">Dirección de PayPal [*]</th>
            <td>
              <input class="w-input" name="paypal" type="text" value="<?php if( empty($_GET) === false ) { print_r($_GET['paypal']); } ?>" placeholder="Enter PayPal Address">
            </td>
          </tr>

          <tr>
            <th class="required">Fecha de Finalización [*] <br>FORMATO YYYY-MM-DD</th>
            <td>
              <input class="w-input" name="end" type="date" value="<?php if( empty($_GET) === false ) { print_r($_GET['end']); } ?>" placeholder="yyyy-mm-dd">
            </td>
          </tr>

          <tr>
            <th class="required">Categoría [*]</th>
            <td>
            <div class="block">
              <br>
              <input name="category[]" type="checkbox" value="Agricultural"       <?php if( in_array("Agricultural", $_GET['category']) ) echo ' checked = "checked"'; ?> >Agricultural
              <input name="category[]" type="checkbox" value="Animal"             <?php if( in_array("Animal", $_GET['category']) ) echo ' checked = "checked"'; ?> >Animal
              <input name="category[]" type="checkbox" value="Art & Culture"      <?php if( in_array("Art & Culture", $_GET['category']) ) echo ' checked = "checked"'; ?> >Arte y Cultura
              <input name="category[]" type="checkbox" value="Children"           <?php if( in_array("Children", $_GET['category']) ) echo ' checked = "checked"'; ?> >Niños
              <input name="category[]" type="checkbox" value="Climate Change"     <?php if( in_array("Climate Change", $_GET['category']) ) echo ' checked = "checked"'; ?> >Cambio Climático
              <br>
              <input name="category[]" type="checkbox" value="Disaster Relief"    <?php if( in_array("Disaster Relief", $_GET['category']) ) echo ' checked = "checked"'; ?> >Ayuda de Desastre
              <input name="category[]" type="checkbox" value="Economic Development" <?php if( in_array("Economic Development", $_GET['category']) ) echo ' checked = "checked"'; ?> >Desarrollo Económico
              <input name="category[]" type="checkbox" value="Education"          <?php if( in_array("Education", $_GET['category']) ) echo ' checked = "checked"'; ?> >Educación
              <input name="category[]" type="checkbox" value="Environment"        <?php if( in_array("Environment", $_GET['category']) ) echo ' checked = "checked"'; ?> >Ambiente
              <br>
              <input name="category[]" type="checkbox" value="Federal"            <?php if( in_array("Federal", $_GET['category']) ) echo ' checked = "checked"'; ?> >Federal
              <input name="category[]" type="checkbox" value="Health"             <?php if( in_array("Health", $_GET['category']) ) echo ' checked = "checked"'; ?> >Salud
              <input name="category[]" type="checkbox" value="Humanitarian Help"  <?php if( in_array("Humanitarian Help", $_GET['category']) ) echo ' checked = "checked"'; ?> >Ayuda Humanitaria
              <input name="category[]" type="checkbox" value="Human Rights"       <?php if( in_array("Human Rights", $_GET['category']) ) echo ' checked = "checked"'; ?> >Derechos Humanos
              <input name="category[]" type="checkbox" value="Labor"              <?php if( in_array("Labor", $_GET['category']) ) echo ' checked = "checked"'; ?> >Labor
              <br>
              <input name="category[]" type="checkbox" value="Literacy"           <?php if( in_array("Literacy", $_GET['category']) ) echo ' checked = "checked"'; ?> >Alfabetización
              <input name="category[]" type="checkbox" value="Political"          <?php if( in_array("Political", $_GET['category']) ) echo ' checked = "checked"'; ?> >Política
              <input name="category[]" type="checkbox" value="Scientific"         <?php if( in_array("Scientific", $_GET['category']) ) echo ' checked = "checked"'; ?> >Científica
              <input name="category[]" type="checkbox" value="Social & Recreational" <?php if( in_array("Social & Recreational", $_GET['category']) ) echo ' checked = "checked"'; ?> >Social y Recreacional
              <input name="category[]" type="checkbox" value="Religious"          <?php if( in_array("Religious", $_GET['category']) ) echo ' checked = "checked"'; ?> >Religiosa
              <br>
              <input name="category[]" type="checkbox" value="Sports"             <?php if( in_array("Sports", $_GET['category']) ) echo ' checked = "checked"'; ?> >Deportes
              <input name="category[]" type="checkbox" value="Technology"         <?php if( in_array("Technology", $_GET['category']) ) echo ' checked = "checked"'; ?> >Tecnología
              <input name="category[]" type="checkbox" value="Veteran"            <?php if( in_array("Veteran", $_GET['category']) ) echo ' checked = "checked"'; ?> >Veteranos
              <input name="category[]" type="checkbox" value="Women & Girls"      <?php if( in_array("Women & Girls", $_GET['category']) ) echo ' checked = "checked"'; ?> >Mujeres y niñas
              <br>
            </div>
            </td>
          </tr>
        </tbody>

        <tbody>
          <tr>
            <td colspan="2" align="right">
             <input class="w-button" type="submit" value="¡Crear!">
            </td>
          </tr>
        </tbody>

      </form>

  </tbody>
  </table>