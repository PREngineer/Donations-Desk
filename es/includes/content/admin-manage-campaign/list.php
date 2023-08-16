<!-- Drop down menu for sorting -->
  Filter by: 
  <form method="POST" enctype="form-data" action="">
    <select name="sort-by">
        <option value="ALL">SHOW ALL</option>
        <option value="Agricultural">Agricultural</option>
        <option value="Animal">Animal</option>
        <option value="Arts & Culture">Arte y Cultura</option>
        <option value="Children">Niños</option>
        <option value="Climate Change">Cambio Climático</option>
        <option value="Disaster Relief">Ayuda en Desastres</option>
        <option value="Economic Development">Desarrollo Económico</option>
        <option value="Education">Educación</option>
        <option value="Environment">Ambiente</option>
        <option value="Federal">Federal</option>
        <option value="Health">Salud</option>
        <option value="Human Rights">Derechos Humanos</option>
        <option value="Humanitarian Help">Ayuda Humanitaria</option>
        <option value="Labor">Labor/Empleo</option>
        <option value="Literacy">Literacy</option>
        <option value="Political">Política</option>
        <option value="Religious">Religiosa</option>
        <option value="Scientific">Científica</option>
        <option value="Social & Recreational">Social y Recreacional</option>
        <option value="Sports">Deportes</option>
        <option value="Technology">Tecnología</option>
        <option value="Veteran">Veteranos</option>
        <option value="Women & Girls">Mujeres y Niñas</option>
    </select>
    <!-- Search box -->
    O Buscar por detalles de la Campaña:
    <input type="text" placeholder="Buscar por..." name="string" value="">
    <!-- GO! button -->
    <input type="submit" value="Go!">
  </form>

  <br>

    <!-- Table Displaying all NFPOs-->
    <table>
    <tbody>
    <center>
  
        <tr>
          <td width="50">
            <b>#</b>
          </td>
          <td width="50">
            <b>Acción</b>
          </td>
          <td width="100">
            <b>Cuenta</b>
          </td>
          <td width="100">
            <b>Meta</b>
          </td>
          <td width="100">
            <b>Finalización</b>
          </td>
          <td width="200">
            <b>Info</b>
          </td>
        </tr>

<?php
  // If page was just loaded (nothing was posted)
  if(empty($_POST) === true)
  { // Display by name
    $result = admin_display_all_campaigns();
    $num = admin_campaign_count();
  }
  // If page has posted
  else
  {
    // And a Search string was passed
    if(empty($_POST) === false && empty($_POST['string']) === false)
    {
      // Display the results of the search
      $string = mysql_real_escape_string($_POST['string']);
      $result = admin_campaign_search($string);
      $num = admin_campaign_search_count($string);
      // Show the results message
      echo $num . " resultado(s) para su búsqueda: '" . $string ."'";
    }
    // If nothing was searched but filtering was applied
    else
      {
        // Sort accordingly
        $result = admin_campaign_filter($_POST['sort-by']);
        $num = admin_campaign_filter_count($_POST['sort-by']);
      }
  }

  $i = 0;
  // Go over every result and display on the table.
  while ($i < $num) 
  {
    $id = mysql_result($result, $i, "id");
    $field1 = mysql_result($result, $i, "username");
    $field2 = mysql_result($result, $i, "goal");
    $field3 = mysql_result($result, $i, "end");
    $field4 = mysql_result($result, $i, "info");

    // Make the Name a link to the details page
    echo '

    <tr class="nfpoblock">
    
      <td width="50"> 
        ' . ($i + 1) . '
      </td>

      <td width="50"> 
        <a href="admin-manage-campaign.php?edit=1&id=' . $id . '">Editar</a>
      </td>

      <td width="100"> 
        ' . $field1  . '
      </td>
    
      <td width="100"> 
        ' . $field2  . '
      </td>

      <td width="100"> 
        ' . $field3  . '
      </td>

      <td width="200"> 
        ' . $field4  . '
      </td>
      
    </tr>

    ';

    $i++;
  }

?>

    </tbody>
    </center>
  </table>