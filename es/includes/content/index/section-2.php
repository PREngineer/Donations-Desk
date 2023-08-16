<!-- The Campaigns Section -->
<section>
	<!-- Is inside a container -->
<div class="w-container">
	<!-- That has 1 row and 3 equally spaced columns (1/3 of page width each) -->
  <div class="w-row">
    
    <!-- Drop down menu for sorting -->
    Filtrar por: 
      <form method="POST" enctype="form-data" action="index.php">
      <select name="update">
          <option value="ALL">TODO</option>
          <option value="Agricultural">Agricultural</option>
          <option value="Animal">Animal</option>
          <option value="Arts & Culture">Arte y Cultura</option>
          <option value="Children">Niños</option>
          <option value="Climate Change">Cambio Climático</option>
          <option value="Disaster Relief">Ayuda de Desastres</option>
          <option value="Economic Development">Desarrollo Económico</option>
          <option value="Education">Educación</option>
          <option value="Environment">Ambiente</option>
          <option value="Federal">Federal</option>
          <option value="Health">Salud</option>
          <option value="Human Rights">Derechos Humanos</option>
          <option value="Humanitarian Help">Ayuda Humanitaria</option>
          <option value="Labor">Labor/Empleo</option>
          <option value="Literacy">Alfabetización</option>
          <option value="Political">Política</option>
          <option value="Religious">Religioss</option>
          <option value="Scientific">Científica</option>
          <option value="Social & Recreational">Social y Recreacional</option>
          <option value="Sports">Deportes</option>
          <option value="Technology">Tecnología</option>
          <option value="Veteran">Veteranos</option>
          <option value="Women & Girls">Mujeres y niñas</option>
      </select>
      <!-- Search box -->
      O busque por detalles de la Campaña:
      <input type="text" placeholder="Buscar ..." name="string" value="">
    <!-- GO! button -->
    <input type="submit" value="Go!">
    </form>

    <br>

  	<?php
      // If page was just loaded (nothing was posted) OR SHOW ALL was selected AND nothing was searched
      if(empty($_POST) === true || ($_POST['update'] == "ALL" && empty($_POST['string']) ) )
      { // Display by name
        $result = campaign_display_all();
        $num = campaign_count();
      }
      // If page has posted
      else
      {
        // And a Search string was passed
        if(empty($_POST) === false && empty($_POST['string']) === false)
        {
          // Display the results of the search
          $string = mysql_real_escape_string($_POST['string']);
          $result = campaign_search($string);
          $num = campaign_count_search($string);
          // Show the results message
          echo $num . " resultado(s) para su búsqueda: '" . $string ."' <br>";
        }
        // If nothing was searched but sorting was applied
        else
          {
            // Sort accordingly
            $result = campaign_display_by_category($_POST['update']);
            $num = campaign_count_by_category($_POST['update']);
          }
      }

      $i = 0;
      // Go over every result and display on the table.
      while ($i < $num) 
      {
        // Get everything for the Campaign
        $id = mysql_result($result, $i, "id");
        $logo = mysql_result($result, $i, "campaign-logo");
        $username = mysql_result($result, $i, "username");
        $goal = mysql_result($result, $i, "goal");
        $donated = mysql_result($result, $i, "donated");
        $info = mysql_result($result, $i, "info");
        $end = mysql_result($result, $i, "end");
        $category = mysql_result($result, $i, "category");
        $paypal = mysql_result($result, $i, "paypal");

        $percent = (int) ( ($donated/$goal) * 100 );
        // Max percent is 100
        if($percent > 100)
        {
          $percent = 100;
        }
        // Scale multiplier
        $scale = 2;
        
        // Insert a Campaign Block
        echo '<div class="w-col w-col-4 campaignblock" width="200" height="400" overflow="hidden"><center>';
        echo '<img src="';
          echo $logo;
          echo '" width="100" height="100"><br>';
        echo '<b>Detalles de la Campaña:</b><br>' . $info . '<br>';
        
        // The progress bar inside every block
        echo '
          <div class="percentbar" align="left" style="width:200px;">
            <div class="percentage" align="left" style="width:
            ';
            echo $percent * $scale;
            echo 'px;">';
            echo '
            </div>
          </div>
        ';
        // Display Amount
        echo '$' . $donated . '    /    $' . $goal . '     =    ' . $percent . '%<br>';
        
        echo '<b>Finalización:</b> ' . $end;
        echo '<br>
          <a href="pp-processing/paypal.php?email=' . $paypal . '&type=Campaign&item_number=Campaign.' . $id . '">
            <img src="../images/paypal-donate.png" alt="PayPal - The safer, easier way to pay online!"></a>
          ';
        echo '<br><b>Categoría:</b><br> ' . $category;
        echo '</center></div>';

        $i++;
      }

?>

  </div>

</div>

</section>