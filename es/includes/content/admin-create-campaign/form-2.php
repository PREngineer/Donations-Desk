<?php

// DISPLAY THE ERROR MESSAGES IF APPROPRIATE

echo 'Por favor espere mientras se completa la carga de documentos una vez presione SOMETER.  Puede aparentar no responder pero está trabajando.<br>';

// If an error while Uploading happened
if($_GET['e1'] == '1')
{
  echo '<font color="red">Ocurrió un error al subir el Logo.  Por favor, intente denuevo.
        <br> Possibles errores:
        <br> El archivo excede el Tamaño Máximo (1MB)
        <br> Se interrumpió la carga.</font>';
}

// If Invalid Logo/Picture Extension
if($_GET['e2'] == '1')
{
  echo '<font color="red">Extensión de Logo Inválida.  Sólo se permiten archivos: JPG, GIF, PNG y BMP</font>';
}

// If Not Successful
if($_GET['e3'] == '1')
{
  echo '<font color="red">¡No se logró subir el archivo!  Por favor, intente denuevo.</font>';
}

// Missing required fields
if($_GET['e4'] == '1')
{
  echo '<font color="red">¡Los campos marcados con [*] son requeridos!</font>';
}

// Invalid Date Format
if($_GET['e5'] == '1')
{
  echo '<font color="red">¡Formato de fecha inválido!  Use el formato recomendado.</font>';
}

// Invalid e-mail format
if($_GET['e6'] == '1')
{
  echo '<font color="red"><p>¡Formato de e-mail es inválido!</p></font>';
}

// DISPLAY THE SUCCESS MESSAGES IF APPROPRIATE

// If Logo Upload was OK and information saved in DB
if($_GET['success'] == true)
{
  echo '<center><font color="green"><p>¡Campaña Creada!</p></font>';
}

?>

  <!-- Part 4: NFPO INFORMATION -->

  <table>
  <tbody>

      <form class="login-form" enctype="multipart/form-data" action="../uploads/admin-create-campaign.php" method="POST">

        <tbody>
          <tr>
            <td colspan="2">
              <hr>
            </td>
          </tr>

           <tr>
            <th class="required">Usuario [*]</th>
            <td>
              <input class="w-input" name="username" type="text" value="<?php if( empty($_GET) === false ) { print_r($_GET['username']); } ?>" placeholder="Entre el Usuario">
            </td>
          </tr>

          <tr>
            <th>Logo</th>
            <td>
              <input class="w-input" name="MAX_FILE_SIZE" type="hidden" value="1048576">
              <div>
                <input class="w-input" name="file" type="file">
              </div>
            </td>
          </tr>

          <tr>
            <th class="required">Cantidad Meta [*]</th>
            <td>
              <input class="w-input" name="goal" type="text" value="<?php if( empty($_GET) === false ) { print_r($_GET['goal']); } ?>" placeholder="Ej: 7250.75  (Sin $)">
            </td>
          </tr>

          <tr>
            <th class="required">Descripción (Info) [*]</th>
            <td>
              <textarea class="w-input" name="info" maxlength="250" rows="2" placeholder="Entre información sobre la campaña. (Proposito, quien se beneficia)  MAX 250 Caracteres"><?php if( empty($_GET) === false ) { print_r($_GET['info']); } ?></textarea>
            </td>
          </tr>

          <tr>
            <th class="required">Dirección de PayPal [*]</th>
            <td>
              <input class="w-input" name="paypal" type="text" value="<?php if( empty($_GET) === false ) { print_r($_GET['paypal']); } ?>" placeholder="Entre Dirección de PayPal">
            </td>
          </tr>

          <tr>
            <th class="required">Fecha de Finalización [*] <br>FORMATO: YYYY-MM-DD</th>
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
              <input name="category[]" type="checkbox" value="Art & Culture"      <?php if( in_array("Art & Culture", $_GET['category']) ) echo ' checked = "checked"'; ?> >Arte y Culture
              <input name="category[]" type="checkbox" value="Children"           <?php if( in_array("Children", $_GET['category']) ) echo ' checked = "checked"'; ?> >Niños
              <input name="category[]" type="checkbox" value="Climate Change"     <?php if( in_array("Climate Change", $_GET['category']) ) echo ' checked = "checked"'; ?> >Cambio Climático
              <br>
              <input name="category[]" type="checkbox" value="Disaster Relief"    <?php if( in_array("Disaster Relief", $_GET['category']) ) echo ' checked = "checked"'; ?> >Ayuda para Desastres
              <input name="category[]" type="checkbox" value="Economic Development" <?php if( in_array("Economic Development", $_GET['category']) ) echo ' checked = "checked"'; ?> >Desarrollo Económico
              <input name="category[]" type="checkbox" value="Education"          <?php if( in_array("Education", $_GET['category']) ) echo ' checked = "checked"'; ?> >Educación
              <input name="category[]" type="checkbox" value="Environment"        <?php if( in_array("Environment", $_GET['category']) ) echo ' checked = "checked"'; ?> >Ambiente
              <br>
              <input name="category[]" type="checkbox" value="Federal"            <?php if( in_array("Federal", $_GET['category']) ) echo ' checked = "checked"'; ?> >Federal
              <input name="category[]" type="checkbox" value="Health"             <?php if( in_array("Health", $_GET['category']) ) echo ' checked = "checked"'; ?> >Salud
              <input name="category[]" type="checkbox" value="Humanitarian Help"  <?php if( in_array("Humanitarian Help", $_GET['category']) ) echo ' checked = "checked"'; ?> >Ayuda Humanitaria
              <input name="category[]" type="checkbox" value="Human Rights"       <?php if( in_array("Human Rights", $_GET['category']) ) echo ' checked = "checked"'; ?> >Derechos Humanos
              <input name="category[]" type="checkbox" value="Labor"              <?php if( in_array("Labor", $_GET['category']) ) echo ' checked = "checked"'; ?> >Labor/Empleo
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
              <input name="category[]" type="checkbox" value="Women & Girls"      <?php if( in_array("Women & Girls", $_GET['category']) ) echo ' checked = "checked"'; ?> >Mujeres y Niñas
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