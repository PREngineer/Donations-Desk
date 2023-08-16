<?php

  /*
  Calls the function that retrieves the data
  */
  $fetched_data = nfpo_data($user_data['username'], 'vision', 'mission', 'target', 'impact', 'projections', 'services');

  // Separate all the entries into an array
  $fetched_data['target'] = explode(",", $fetched_data['target']);

  // If the POST has information
  if(empty($_POST) === false)
  {
    // Establish which fields are required
    $required_fields = array('vision', 'mission', 'services', 'target', 'impact');
    
    // Check all the values provided in the post
    foreach($_POST as $key=>$value)
    {
      // If any of the required fields are not provided
      if( (empty($value) && in_array($key, $required_fields) === true ) || count($_POST['target']) < 1)
      {
        // Make an error that says it.
        $errors[] = 'Campos marcados con [*] son requeridos.';
        break 1;
      }
    }
  }

  // If the post is not empty and there are no errors
  if(empty($_POST) === false && empty($errors) === true)
  {
    // Save the nfpo data in array
    $nfpo_data = array(
        'username'            => $user_data['username'],

        'vision'              => $_POST['vision'],
        'mission'             => $_POST['mission'],
        'services'            => $_POST['services'],
        'projections'         => $_POST['projections'],
        'target'              => implode(",", $_POST['target']),
        'impact'              => $_POST['impact']
      );

    // Update the NFPO in DB
      update_purpose_info($nfpo_data);

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
      echo '<center><font color="green"><p>¡Cambios guardados!</p>
            <p>Continúe para la próxima información: </p></font>
            <p><a href="user-nfpo-social.php">¡Haciendo click aquí!</a></p></center>';
    }
?>

<!-- Part 5: PURPOSE INFORMATION -->

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
          <th class="required">Visión [*]</th>
          <td>
            <textarea class="w-input" name="vision" rows="2" cols="40" placeholder="Escriba la Visión"><?php if( empty($_POST) === true ) print_r($fetched_data['vision']); else print_r($_POST['vision']); ?></textarea>
          </td>
        </tr>
          
        <tr>
          <th class="required">Misión [*]</th>
          <td>
            <textarea class="w-input" name="mission" rows="2" cols="40" placeholder="Escriba la Misión"><?php if( empty($_POST) === true ) print_r($fetched_data['mission']); else print_r($_POST['mission']); ?></textarea>
          </td>
        </tr>
        
        <tr>
          <th class="required">Servicios Provistos [*]</th>
          <td>
            <textarea class="w-input" name="services" rows="2" cols="40" placeholder="Haga una lista de los servicios provistos"><?php if( empty($_POST) === true ) print_r($fetched_data['services']); else print_r($_POST['services']); ?></textarea>
          </td>
        </tr>
        
        <tr>
          <th>Proyecciones a largo plazo</th>
          <td>
            <textarea class="w-input" name="projections" rows="2" cols="40" placeholder="Escriba las proyecciones"><?php if( empty($_POST) === true ) print_r($fetched_data['projections']); else print_r($_POST['projections']); ?></textarea>
          </td>
        </tr>
              
        <tr>
          <th class="required">Población servida[*]</th>
          <td >
            <div class="block">
            <input name="target[]" type="checkbox" value="Children"         <?php if( empty($_POST) === true ) { if( in_array("Children", $fetched_data['target']) ) echo ' checked = "checked"';} else { if( in_array("Children", $_POST['target']) ) echo ' checked = "checked"';} ?>/>
            Niños
            <input name="target[]" type="checkbox" value="Youth"            <?php if( empty($_POST) === true ) { if( in_array("Youth", $fetched_data['target']) ) echo ' checked = "checked"';} else { if( in_array("Youth", $_POST['target']) ) echo ' checked = "checked"';} ?>/>
            Jóvenes
            <input name="target[]" type="checkbox" value="Old"              <?php if( empty($_POST) === true ) { if( in_array("Old", $fetched_data['target']) ) echo ' checked = "checked"';} else { if( in_array("Old", $_POST['target']) ) echo ' checked = "checked"';} ?>/>
            Viejos
            <input name="target[]" type="checkbox" value="Men"              <?php if( empty($_POST) === true ) { if( in_array("Men", $fetched_data['target']) ) echo ' checked = "checked"';} else { if( in_array("Men", $_POST['target']) ) echo ' checked = "checked"';} ?>/>
            Hombres
            <input name="target[]" type="checkbox" value="Women"            <?php if( empty($_POST) === true ) { if( in_array("Women", $fetched_data['target']) ) echo ' checked = "checked"';} else { if( in_array("Women", $_POST['target']) ) echo ' checked = "checked"';} ?>/>
            Mujeres
            <input name="target[]" type="checkbox" value="Animals"          <?php if( empty($_POST) === true ) { if( in_array("Animals", $fetched_data['target']) ) echo ' checked = "checked"';} else { if( in_array("Animals", $_POST['target']) ) echo ' checked = "checked"';} ?>/>
            Animales
            <input name="target[]" type="checkbox" value="Communities"      <?php if( empty($_POST) === true ) { if( in_array("Communities", $fetched_data['target']) ) echo ' checked = "checked"';} else { if( in_array("Communities", $_POST['target']) ) echo ' checked = "checked"';} ?>/>
            Comunidades
            <br>
            <input name="target[]" type="checkbox" value="Micro-enterprises" <?php if( empty($_POST) === true ) { if( in_array("Micro-enterprises", $fetched_data['target']) ) echo ' checked = "checked"';} else { if( in_array("Micro-enterprises", $_POST['target']) ) echo ' checked = "checked"';} ?>/>
            Micro-empresas
            </div>
          </td>
        </tr>
              
        <tr>
          <th class="required">Impacto poblacional [*]</th>
          <td>
            <select size="1" name="impact">
            <option value="" <?php if( empty($_POST) === true ) { if ($fetched_data['impact'] == '')    echo ' selected = "selected"'; } else { if($_POST['impact'] == '') echo ' selected = "selected"';} ?> ></option>
            <option value="1-10" <?php if( empty($_POST) === true ) { if ($fetched_data['impact'] == '1-10')    echo ' selected = "selected"'; } else { if($_POST['impact'] == '1-10') echo ' selected = "selected"'; } ?> >1-10</option>
            <option value="11-20" <?php if( empty($_POST) === true ) { if ($fetched_data['impact'] == '11-20')    echo ' selected = "selected"'; } else { if($_POST['impact'] == '11-20') echo ' selected = "selected"'; } ?> >11-20</option>
            <option value="21-30" <?php if( empty($_POST) === true ) { if ($fetched_data['impact'] == '21-30')    echo ' selected = "selected"'; } else { if($_POST['impact'] == '21-30') echo ' selected = "selected"'; } ?> >21-30</option>
            <option value="31-40" <?php if( empty($_POST) === true ) { if ($fetched_data['impact'] == '31-40')    echo ' selected = "selected"'; } else { if($_POST['impact'] == '31-40') echo ' selected = "selected"'; } ?> >31-40</option>
            <option value="41-50" <?php if( empty($_POST) === true ) { if ($fetched_data['impact'] == '41-50')    echo ' selected = "selected"'; } else { if($_POST['impact'] == '41-50') echo ' selected = "selected"'; } ?> >41-50</option>
            <option value="51-60" <?php if( empty($_POST) === true ) { if ($fetched_data['impact'] == '51-60')    echo ' selected = "selected"'; } else { if($_POST['impact'] == '51-60') echo ' selected = "selected"'; } ?> >51-60</option>
            <option value="61-70" <?php if( empty($_POST) === true ) { if ($fetched_data['impact'] == '61-70')    echo ' selected = "selected"'; } else { if($_POST['impact'] == '61-70') echo ' selected = "selected"'; } ?> >61-70</option>
            <option value="71-80" <?php if( empty($_POST) === true ) { if ($fetched_data['impact'] == '71-80')    echo ' selected = "selected"'; } else { if($_POST['impact'] == '71-80') echo ' selected = "selected"'; } ?> >71-80</option>
            <option value="81-90" <?php if( empty($_POST) === true ) { if ($fetched_data['impact'] == '81-90')    echo ' selected = "selected"'; } else { if($_POST['impact'] == '81-90') echo ' selected = "selected"'; } ?> >81-90</option>
            <option value="91-100" <?php if( empty($_POST) === true ) { if ($fetched_data['impact'] == '91-100')    echo ' selected = "selected"'; } else { if($_POST['impact'] == '91-100') echo ' selected = "selected"'; } ?> >91-100</option>
            <option value="101-110" <?php if( empty($_POST) === true ) { if ($fetched_data['impact'] == '101-110')    echo ' selected = "selected"'; } else { if($_POST['impact'] == '101-110') echo ' selected = "selected"'; } ?> >101-110</option>
            <option value="111-120" <?php if( empty($_POST) === true ) { if ($fetched_data['impact'] == '111-120')    echo ' selected = "selected"'; } else { if($_POST['impact'] == '111-120') echo ' selected = "selected"'; } ?> >111-120</option>
            <option value="121-130" <?php if( empty($_POST) === true ) { if ($fetched_data['impact'] == '121-130')    echo ' selected = "selected"'; } else { if($_POST['impact'] == '121-130') echo ' selected = "selected"'; } ?> >121-130</option>
            <option value="131-140" <?php if( empty($_POST) === true ) { if ($fetched_data['impact'] == '131-140')    echo ' selected = "selected"'; } else { if($_POST['impact'] == '131-140') echo ' selected = "selected"'; } ?> >131-140</option>
            <option value="141-150" <?php if( empty($_POST) === true ) { if ($fetched_data['impact'] == '141-150')    echo ' selected = "selected"'; } else { if($_POST['impact'] == '141-150') echo ' selected = "selected"'; } ?> >141-150</option>
            <option value="151-160" <?php if( empty($_POST) === true ) { if ($fetched_data['impact'] == '151-160')    echo ' selected = "selected"'; } else { if($_POST['impact'] == '151-160') echo ' selected = "selected"'; } ?> >151-160</option>
            <option value="161-170" <?php if( empty($_POST) === true ) { if ($fetched_data['impact'] == '161-170')    echo ' selected = "selected"'; } else { if($_POST['impact'] == '161-170') echo ' selected = "selected"'; } ?> >161-170</option>
            <option value="171-180" <?php if( empty($_POST) === true ) { if ($fetched_data['impact'] == '171-180')    echo ' selected = "selected"'; } else { if($_POST['impact'] == '171-180') echo ' selected = "selected"'; } ?> >171-180</option>
            <option value="181-190" <?php if( empty($_POST) === true ) { if ($fetched_data['impact'] == '181-190')    echo ' selected = "selected"'; } else { if($_POST['impact'] == '181-190') echo ' selected = "selected"'; } ?> >181-190</option>
            <option value="191-200" <?php if( empty($_POST) === true ) { if ($fetched_data['impact'] == '191-200')    echo ' selected = "selected"'; } else { if($_POST['impact'] == '191-200') echo ' selected = "selected"'; } ?> >191-200</option>
            <option value="201-210" <?php if( empty($_POST) === true ) { if ($fetched_data['impact'] == '201-210')    echo ' selected = "selected"'; } else { if($_POST['impact'] == '201-210') echo ' selected = "selected"'; } ?> >201-210</option>
            <option value="211-220" <?php if( empty($_POST) === true ) { if ($fetched_data['impact'] == '211-220')    echo ' selected = "selected"'; } else { if($_POST['impact'] == '211-220') echo ' selected = "selected"'; } ?> >211-220</option>
            <option value="221-230" <?php if( empty($_POST) === true ) { if ($fetched_data['impact'] == '221-230')    echo ' selected = "selected"'; } else { if($_POST['impact'] == '221-230') echo ' selected = "selected"'; } ?> >221-230</option>
            <option value="231-240" <?php if( empty($_POST) === true ) { if ($fetched_data['impact'] == '231-240')    echo ' selected = "selected"'; } else { if($_POST['impact'] == '231-240') echo ' selected = "selected"'; } ?> >231-240</option>
            <option value="241-250" <?php if( empty($_POST) === true ) { if ($fetched_data['impact'] == '241-250')    echo ' selected = "selected"'; } else { if($_POST['impact'] == '241-250') echo ' selected = "selected"'; } ?> >241-250</option>
            <option value="251-260" <?php if( empty($_POST) === true ) { if ($fetched_data['impact'] == '251-260')    echo ' selected = "selected"'; } else { if($_POST['impact'] == '251-260') echo ' selected = "selected"'; } ?> >251-260</option>
            <option value="261-270" <?php if( empty($_POST) === true ) { if ($fetched_data['impact'] == '261-270')    echo ' selected = "selected"'; } else { if($_POST['impact'] == '261-270') echo ' selected = "selected"'; } ?> >261-270</option>
            <option value="271-280" <?php if( empty($_POST) === true ) { if ($fetched_data['impact'] == '271-280')    echo ' selected = "selected"'; } else { if($_POST['impact'] == '271-280') echo ' selected = "selected"'; } ?> >271-280</option>
            <option value="281-290" <?php if( empty($_POST) === true ) { if ($fetched_data['impact'] == '281-290')    echo ' selected = "selected"'; } else { if($_POST['impact'] == '281-290') echo ' selected = "selected"'; } ?> >281-290</option>
            <option value="291-300" <?php if( empty($_POST) === true ) { if ($fetched_data['impact'] == '291-300')    echo ' selected = "selected"'; } else { if($_POST['impact'] == '291-300') echo ' selected = "selected"'; } ?> >291-300</option>
            <option value="301-310" <?php if( empty($_POST) === true ) { if ($fetched_data['impact'] == '301-310')    echo ' selected = "selected"'; } else { if($_POST['impact'] == '301-310') echo ' selected = "selected"'; } ?> >301-310</option>
            <option value="311-320" <?php if( empty($_POST) === true ) { if ($fetched_data['impact'] == '311-320')    echo ' selected = "selected"'; } else { if($_POST['impact'] == '311-320') echo ' selected = "selected"'; } ?> >311-320</option>
            <option value="321-330" <?php if( empty($_POST) === true ) { if ($fetched_data['impact'] == '321-330')    echo ' selected = "selected"'; } else { if($_POST['impact'] == '321-330') echo ' selected = "selected"'; } ?> >321-330</option>
            <option value="331-340" <?php if( empty($_POST) === true ) { if ($fetched_data['impact'] == '331-340')    echo ' selected = "selected"'; } else { if($_POST['impact'] == '331-340') echo ' selected = "selected"'; } ?> >331-340</option>
            <option value="341-350" <?php if( empty($_POST) === true ) { if ($fetched_data['impact'] == '341-350')    echo ' selected = "selected"'; } else { if($_POST['impact'] == '341-350') echo ' selected = "selected"'; } ?> >341-350</option>
            <option value="351-360" <?php if( empty($_POST) === true ) { if ($fetched_data['impact'] == '351-360')    echo ' selected = "selected"'; } else { if($_POST['impact'] == '351-360') echo ' selected = "selected"'; } ?> >351-360</option>
            <option value="361-370" <?php if( empty($_POST) === true ) { if ($fetched_data['impact'] == '361-370')    echo ' selected = "selected"'; } else { if($_POST['impact'] == '361-370') echo ' selected = "selected"'; } ?> >361-370</option>
            <option value="371-380" <?php if( empty($_POST) === true ) { if ($fetched_data['impact'] == '371-380')    echo ' selected = "selected"'; } else { if($_POST['impact'] == '371-380') echo ' selected = "selected"'; } ?> >371-380</option>
            <option value="381-390" <?php if( empty($_POST) === true ) { if ($fetched_data['impact'] == '381-390')    echo ' selected = "selected"'; } else { if($_POST['impact'] == '381-390') echo ' selected = "selected"'; } ?> >381-390</option>
            <option value="391-400" <?php if( empty($_POST) === true ) { if ($fetched_data['impact'] == '391-400')    echo ' selected = "selected"'; } else { if($_POST['impact'] == '391-400') echo ' selected = "selected"'; } ?> >391-400</option>
            <option value="401-410" <?php if( empty($_POST) === true ) { if ($fetched_data['impact'] == '401-410')    echo ' selected = "selected"'; } else { if($_POST['impact'] == '401-410') echo ' selected = "selected"'; } ?> >401-410</option>
            <option value="411-420" <?php if( empty($_POST) === true ) { if ($fetched_data['impact'] == '411-420')    echo ' selected = "selected"'; } else { if($_POST['impact'] == '411-420') echo ' selected = "selected"'; } ?> >411-420</option>
            <option value="421-430" <?php if( empty($_POST) === true ) { if ($fetched_data['impact'] == '421-430')    echo ' selected = "selected"'; } else { if($_POST['impact'] == '421-430') echo ' selected = "selected"'; } ?> >421-430</option>
            <option value="431-440" <?php if( empty($_POST) === true ) { if ($fetched_data['impact'] == '431-440')    echo ' selected = "selected"'; } else { if($_POST['impact'] == '431-440') echo ' selected = "selected"'; } ?> >431-440</option>
            <option value="441-450" <?php if( empty($_POST) === true ) { if ($fetched_data['impact'] == '441-450')    echo ' selected = "selected"'; } else { if($_POST['impact'] == '441-450') echo ' selected = "selected"'; } ?> >441-450</option>
            <option value="451-460" <?php if( empty($_POST) === true ) { if ($fetched_data['impact'] == '451-460')    echo ' selected = "selected"'; } else { if($_POST['impact'] == '451-460') echo ' selected = "selected"'; } ?> >451-460</option>
            <option value="461-470" <?php if( empty($_POST) === true ) { if ($fetched_data['impact'] == '461-470')    echo ' selected = "selected"'; } else { if($_POST['impact'] == '461-470') echo ' selected = "selected"'; } ?> >461-470</option>
            <option value="471-480" <?php if( empty($_POST) === true ) { if ($fetched_data['impact'] == '471-480')    echo ' selected = "selected"'; } else { if($_POST['impact'] == '471-480') echo ' selected = "selected"'; } ?> >471-480</option>
            <option value="481-490" <?php if( empty($_POST) === true ) { if ($fetched_data['impact'] == '481-490')    echo ' selected = "selected"'; } else { if($_POST['impact'] == '481-490') echo ' selected = "selected"'; } ?> >481-490</option>
            <option value="491-500" <?php if( empty($_POST) === true ) { if ($fetched_data['impact'] == '491-500')    echo ' selected = "selected"'; } else { if($_POST['impact'] == '491-500') echo ' selected = "selected"'; } ?> >491-500</option>
            <option value="501-510" <?php if( empty($_POST) === true ) { if ($fetched_data['impact'] == '501-510')    echo ' selected = "selected"'; } else { if($_POST['impact'] == '501-510') echo ' selected = "selected"'; } ?> >501-510</option>
            <option value="511-520" <?php if( empty($_POST) === true ) { if ($fetched_data['impact'] == '511-520')    echo ' selected = "selected"'; } else { if($_POST['impact'] == '511-520') echo ' selected = "selected"'; } ?> >511-520</option>
            <option value="521-530" <?php if( empty($_POST) === true ) { if ($fetched_data['impact'] == '521-530')    echo ' selected = "selected"'; } else { if($_POST['impact'] == '521-530') echo ' selected = "selected"'; } ?> >521-530</option>
            <option value="531-540" <?php if( empty($_POST) === true ) { if ($fetched_data['impact'] == '531-540')    echo ' selected = "selected"'; } else { if($_POST['impact'] == '531-540') echo ' selected = "selected"'; } ?> >531-540</option>
            <option value="541-550" <?php if( empty($_POST) === true ) { if ($fetched_data['impact'] == '541-550')    echo ' selected = "selected"'; } else { if($_POST['impact'] == '541-550') echo ' selected = "selected"'; } ?> >541-550</option>
            <option value="551-560" <?php if( empty($_POST) === true ) { if ($fetched_data['impact'] == '551-560')    echo ' selected = "selected"'; } else { if($_POST['impact'] == '551-560') echo ' selected = "selected"'; } ?> >551-560</option>
            <option value="561-570" <?php if( empty($_POST) === true ) { if ($fetched_data['impact'] == '561-570')    echo ' selected = "selected"'; } else { if($_POST['impact'] == '561-570') echo ' selected = "selected"'; } ?> >561-570</option>
            <option value="571-580" <?php if( empty($_POST) === true ) { if ($fetched_data['impact'] == '571-580')    echo ' selected = "selected"'; } else { if($_POST['impact'] == '571-580') echo ' selected = "selected"'; } ?> >571-580</option>
            <option value="581-590" <?php if( empty($_POST) === true ) { if ($fetched_data['impact'] == '581-590')    echo ' selected = "selected"'; } else { if($_POST['impact'] == '581-590') echo ' selected = "selected"'; } ?> >581-590</option>
            <option value="591-600" <?php if( empty($_POST) === true ) { if ($fetched_data['impact'] == '591-600')    echo ' selected = "selected"'; } else { if($_POST['impact'] == '591-600') echo ' selected = "selected"'; } ?> >591-600</option>
            <option value="601-610" <?php if( empty($_POST) === true ) { if ($fetched_data['impact'] == '601-610')    echo ' selected = "selected"'; } else { if($_POST['impact'] == '601-610') echo ' selected = "selected"'; } ?> >601-610</option>
            <option value="611-620" <?php if( empty($_POST) === true ) { if ($fetched_data['impact'] == '611-620')    echo ' selected = "selected"'; } else { if($_POST['impact'] == '611-620') echo ' selected = "selected"'; } ?> >611-620</option>
            <option value="621-630" <?php if( empty($_POST) === true ) { if ($fetched_data['impact'] == '621-630')    echo ' selected = "selected"'; } else { if($_POST['impact'] == '621-630') echo ' selected = "selected"'; } ?> >621-630</option>
            <option value="631-640" <?php if( empty($_POST) === true ) { if ($fetched_data['impact'] == '631-640')    echo ' selected = "selected"'; } else { if($_POST['impact'] == '631-640') echo ' selected = "selected"'; } ?> >631-640</option>
            <option value="641-650" <?php if( empty($_POST) === true ) { if ($fetched_data['impact'] == '641-650')    echo ' selected = "selected"'; } else { if($_POST['impact'] == '641-650') echo ' selected = "selected"'; } ?> >641-650</option>
            <option value="651-660" <?php if( empty($_POST) === true ) { if ($fetched_data['impact'] == '651-660')    echo ' selected = "selected"'; } else { if($_POST['impact'] == '651-660') echo ' selected = "selected"'; } ?> >651-660</option>
            <option value="661-670" <?php if( empty($_POST) === true ) { if ($fetched_data['impact'] == '661-670')    echo ' selected = "selected"'; } else { if($_POST['impact'] == '661-670') echo ' selected = "selected"'; } ?> >661-670</option>
            <option value="671-680" <?php if( empty($_POST) === true ) { if ($fetched_data['impact'] == '671-680')    echo ' selected = "selected"'; } else { if($_POST['impact'] == '671-680') echo ' selected = "selected"'; } ?> >671-680</option>
            <option value="681-690" <?php if( empty($_POST) === true ) { if ($fetched_data['impact'] == '681-690')    echo ' selected = "selected"'; } else { if($_POST['impact'] == '681-690') echo ' selected = "selected"'; } ?> >681-690</option>
            <option value="691-700" <?php if( empty($_POST) === true ) { if ($fetched_data['impact'] == '691-700')    echo ' selected = "selected"'; } else { if($_POST['impact'] == '691-700') echo ' selected = "selected"'; } ?> >691-700</option>
            <option value="701-710" <?php if( empty($_POST) === true ) { if ($fetched_data['impact'] == '701-710')    echo ' selected = "selected"'; } else { if($_POST['impact'] == '701-710') echo ' selected = "selected"'; } ?> >701-710</option>
            <option value="711-720" <?php if( empty($_POST) === true ) { if ($fetched_data['impact'] == '711-720')    echo ' selected = "selected"'; } else { if($_POST['impact'] == '711-720') echo ' selected = "selected"'; } ?> >711-720</option>
            <option value="721-730" <?php if( empty($_POST) === true ) { if ($fetched_data['impact'] == '721-730')    echo ' selected = "selected"'; } else { if($_POST['impact'] == '721-730') echo ' selected = "selected"'; } ?> >721-730</option>
            <option value="731-740" <?php if( empty($_POST) === true ) { if ($fetched_data['impact'] == '731-740')    echo ' selected = "selected"'; } else { if($_POST['impact'] == '731-740') echo ' selected = "selected"'; } ?> >731-740</option>
            <option value="741-750" <?php if( empty($_POST) === true ) { if ($fetched_data['impact'] == '741-750')    echo ' selected = "selected"'; } else { if($_POST['impact'] == '741-750') echo ' selected = "selected"'; } ?> >741-750</option>
            <option value="751-760" <?php if( empty($_POST) === true ) { if ($fetched_data['impact'] == '751-760')    echo ' selected = "selected"'; } else { if($_POST['impact'] == '751-760') echo ' selected = "selected"'; } ?> >751-760</option>
            <option value="761-770" <?php if( empty($_POST) === true ) { if ($fetched_data['impact'] == '761-770')    echo ' selected = "selected"'; } else { if($_POST['impact'] == '761-770') echo ' selected = "selected"'; } ?> >761-770</option>
            <option value="771-780" <?php if( empty($_POST) === true ) { if ($fetched_data['impact'] == '771-780')    echo ' selected = "selected"'; } else { if($_POST['impact'] == '771-780') echo ' selected = "selected"'; } ?> >771-780</option>
            <option value="781-790" <?php if( empty($_POST) === true ) { if ($fetched_data['impact'] == '781-790')    echo ' selected = "selected"'; } else { if($_POST['impact'] == '781-790') echo ' selected = "selected"'; } ?> >781-790</option>
            <option value="791-800" <?php if( empty($_POST) === true ) { if ($fetched_data['impact'] == '791-800')    echo ' selected = "selected"'; } else { if($_POST['impact'] == '791-800') echo ' selected = "selected"'; } ?> >791-800</option>
            <option value="801-810" <?php if( empty($_POST) === true ) { if ($fetched_data['impact'] == '801-810')    echo ' selected = "selected"'; } else { if($_POST['impact'] == '801-810') echo ' selected = "selected"'; } ?> >801-810</option>
            <option value="811-820" <?php if( empty($_POST) === true ) { if ($fetched_data['impact'] == '811-820')    echo ' selected = "selected"'; } else { if($_POST['impact'] == '811-820') echo ' selected = "selected"'; } ?> >811-820</option>
            <option value="821-830" <?php if( empty($_POST) === true ) { if ($fetched_data['impact'] == '821-830')    echo ' selected = "selected"'; } else { if($_POST['impact'] == '821-830') echo ' selected = "selected"'; } ?> >821-830</option>
            <option value="831-840" <?php if( empty($_POST) === true ) { if ($fetched_data['impact'] == '831-840')    echo ' selected = "selected"'; } else { if($_POST['impact'] == '831-840') echo ' selected = "selected"'; } ?> >831-840</option>
            <option value="841-850" <?php if( empty($_POST) === true ) { if ($fetched_data['impact'] == '841-850')    echo ' selected = "selected"'; } else { if($_POST['impact'] == '841-850') echo ' selected = "selected"'; } ?> >841-850</option>
            <option value="851-860" <?php if( empty($_POST) === true ) { if ($fetched_data['impact'] == '851-860')    echo ' selected = "selected"'; } else { if($_POST['impact'] == '851-860') echo ' selected = "selected"'; } ?> >851-860</option>
            <option value="861-870" <?php if( empty($_POST) === true ) { if ($fetched_data['impact'] == '861-870')    echo ' selected = "selected"'; } else { if($_POST['impact'] == '861-870') echo ' selected = "selected"'; } ?> >861-870</option>
            <option value="871-880" <?php if( empty($_POST) === true ) { if ($fetched_data['impact'] == '871-880')    echo ' selected = "selected"'; } else { if($_POST['impact'] == '871-880') echo ' selected = "selected"'; } ?> >871-880</option>
            <option value="881-890" <?php if( empty($_POST) === true ) { if ($fetched_data['impact'] == '881-890')    echo ' selected = "selected"'; } else { if($_POST['impact'] == '881-890') echo ' selected = "selected"'; } ?> >881-890</option>
            <option value="891-900" <?php if( empty($_POST) === true ) { if ($fetched_data['impact'] == '891-900')    echo ' selected = "selected"'; } else { if($_POST['impact'] == '891-900') echo ' selected = "selected"'; } ?> >891-900</option>
            <option value="901-910" <?php if( empty($_POST) === true ) { if ($fetched_data['impact'] == '901-910')    echo ' selected = "selected"'; } else { if($_POST['impact'] == '901-910') echo ' selected = "selected"'; } ?> >901-910</option>
            <option value="911-920" <?php if( empty($_POST) === true ) { if ($fetched_data['impact'] == '911-920')    echo ' selected = "selected"'; } else { if($_POST['impact'] == '911-920') echo ' selected = "selected"'; } ?> >911-920</option>
            <option value="921-930" <?php if( empty($_POST) === true ) { if ($fetched_data['impact'] == '921-930')    echo ' selected = "selected"'; } else { if($_POST['impact'] == '921-930') echo ' selected = "selected"'; } ?> >921-930</option>
            <option value="931-940" <?php if( empty($_POST) === true ) { if ($fetched_data['impact'] == '931-940')    echo ' selected = "selected"'; } else { if($_POST['impact'] == '931-940') echo ' selected = "selected"'; } ?> >931-940</option>
            <option value="941-950" <?php if( empty($_POST) === true ) { if ($fetched_data['impact'] == '941-950')    echo ' selected = "selected"'; } else { if($_POST['impact'] == '941-950') echo ' selected = "selected"'; } ?> >941-950</option>
            <option value="951-960" <?php if( empty($_POST) === true ) { if ($fetched_data['impact'] == '951-960')    echo ' selected = "selected"'; } else { if($_POST['impact'] == '951-960') echo ' selected = "selected"'; } ?> >951-960</option>
            <option value="961-970" <?php if( empty($_POST) === true ) { if ($fetched_data['impact'] == '961-970')    echo ' selected = "selected"'; } else { if($_POST['impact'] == '961-970') echo ' selected = "selected"'; } ?> >961-970</option>
            <option value="971-980" <?php if( empty($_POST) === true ) { if ($fetched_data['impact'] == '971-980')    echo ' selected = "selected"'; } else { if($_POST['impact'] == '971-980') echo ' selected = "selected"'; } ?> >971-980</option>
            <option value="981-990" <?php if( empty($_POST) === true ) { if ($fetched_data['impact'] == '981-990')    echo ' selected = "selected"'; } else { if($_POST['impact'] == '981-990') echo ' selected = "selected"'; } ?> >981-990</option>
            <option value="991-1000" <?php if( empty($_POST) === true ) { if ($fetched_data['impact'] == '991-1000')    echo ' selected = "selected"'; } else { if($_POST['impact'] == '991-1000') echo ' selected = "selected"'; } ?> >991-1000</option>
            <option value="1001-1500" <?php if( empty($_POST) === true ) { if ($fetched_data['impact'] == '1001-1500')    echo ' selected = "selected"'; } else { if($_POST['impact'] == '1001-1500') echo ' selected = "selected"'; } ?> >1001-1500</option>
            <option value="1501-2000" <?php if( empty($_POST) === true ) { if ($fetched_data['impact'] == '1501-2000')    echo ' selected = "selected"'; } else { if($_POST['impact'] == '1501-2000') echo ' selected = "selected"'; } ?> >1501-2000</option>
            <option value="2001-2500" <?php if( empty($_POST) === true ) { if ($fetched_data['impact'] == '2001-2500')    echo ' selected = "selected"'; } else { if($_POST['impact'] == '2001-2500') echo ' selected = "selected"'; } ?> >2001-2500</option>
            <option value="2501-3000" <?php if( empty($_POST) === true ) { if ($fetched_data['impact'] == '2501-3000')    echo ' selected = "selected"'; } else { if($_POST['impact'] == '2501-3000') echo ' selected = "selected"'; } ?> >2501-3000</option>
            <option value="3001-3500" <?php if( empty($_POST) === true ) { if ($fetched_data['impact'] == '3001-3500')    echo ' selected = "selected"'; } else { if($_POST['impact'] == '3001-3500') echo ' selected = "selected"'; } ?> >3001-3500</option>
            <option value="3501-4000" <?php if( empty($_POST) === true ) { if ($fetched_data['impact'] == '3501-4000')    echo ' selected = "selected"'; } else { if($_POST['impact'] == '3501-4000') echo ' selected = "selected"'; } ?> >3501-4000</option>
            <option value="4001-4500" <?php if( empty($_POST) === true ) { if ($fetched_data['impact'] == '4001-4500')    echo ' selected = "selected"'; } else { if($_POST['impact'] == '4001-4500') echo ' selected = "selected"'; } ?> >4001-4500</option>
            <option value="4501-5000" <?php if( empty($_POST) === true ) { if ($fetched_data['impact'] == '4501-5000')    echo ' selected = "selected"'; } else { if($_POST['impact'] == '4501-5000') echo ' selected = "selected"'; } ?> >4501-5000</option>
            <option value="5001-5500" <?php if( empty($_POST) === true ) { if ($fetched_data['impact'] == '5001-5500')    echo ' selected = "selected"'; } else { if($_POST['impact'] == '5001-5500') echo ' selected = "selected"'; } ?> >5001-5500</option>
            <option value="5501-6000" <?php if( empty($_POST) === true ) { if ($fetched_data['impact'] == '5501-6000')    echo ' selected = "selected"'; } else { if($_POST['impact'] == '5501-6000') echo ' selected = "selected"'; } ?> >5501-6000</option>
            <option value="6001-6500" <?php if( empty($_POST) === true ) { if ($fetched_data['impact'] == '6001-6500')    echo ' selected = "selected"'; } else { if($_POST['impact'] == '6001-6500') echo ' selected = "selected"'; } ?> >6001-6500</option>
            <option value="6501-7000" <?php if( empty($_POST) === true ) { if ($fetched_data['impact'] == '6501-7000')    echo ' selected = "selected"'; } else { if($_POST['impact'] == '6501-7000') echo ' selected = "selected"'; } ?> >6501-7000</option>
            <option value="7001-7500" <?php if( empty($_POST) === true ) { if ($fetched_data['impact'] == '7001-7500')    echo ' selected = "selected"'; } else { if($_POST['impact'] == '7001-7500') echo ' selected = "selected"'; } ?> >7001-7500</option>
            <option value="7501-8000" <?php if( empty($_POST) === true ) { if ($fetched_data['impact'] == '7501-8000')    echo ' selected = "selected"'; } else { if($_POST['impact'] == '7501-8000') echo ' selected = "selected"'; } ?> >7501-8000</option>
            <option value="8001-8500" <?php if( empty($_POST) === true ) { if ($fetched_data['impact'] == '8001-8500')    echo ' selected = "selected"'; } else { if($_POST['impact'] == '8001-8500') echo ' selected = "selected"'; } ?> >8001-8500</option>
            <option value="8501-9000" <?php if( empty($_POST) === true ) { if ($fetched_data['impact'] == '8501-9000')    echo ' selected = "selected"'; } else { if($_POST['impact'] == '8501-9000') echo ' selected = "selected"'; } ?> >8501-9000</option>
            <option value="9001-9500" <?php if( empty($_POST) === true ) { if ($fetched_data['impact'] == '9001-9500')    echo ' selected = "selected"'; } else { if($_POST['impact'] == '9001-9500') echo ' selected = "selected"'; } ?> >9001-9500</option>
            <option value="9501-10000" <?php if( empty($_POST) === true ) { if ($fetched_data['impact'] == '9501-10000')    echo ' selected = "selected"'; } else { if($_POST['impact'] == '9501-10000') echo ' selected = "selected"'; } ?> >9501-10000</option>
            <option value="10001-10500" <?php if( empty($_POST) === true ) { if ($fetched_data['impact'] == '10001-10500')    echo ' selected = "selected"'; } else { if($_POST['impact'] == '10001-10500') echo ' selected = "selected"'; } ?> >10001-10500</option>
            <option value="10501-11000" <?php if( empty($_POST) === true ) { if ($fetched_data['impact'] == '10501-11000')    echo ' selected = "selected"'; } else { if($_POST['impact'] == '10501-11000') echo ' selected = "selected"'; } ?> >10501-11000</option>
            <option value="11001-11500" <?php if( empty($_POST) === true ) { if ($fetched_data['impact'] == '11001-11500')    echo ' selected = "selected"'; } else { if($_POST['impact'] == '11001-11500') echo ' selected = "selected"'; } ?> >11001-11500</option>
            <option value="11501-12000" <?php if( empty($_POST) === true ) { if ($fetched_data['impact'] == '11501-12000')    echo ' selected = "selected"'; } else { if($_POST['impact'] == '11501-12000') echo ' selected = "selected"'; } ?> >11501-12000</option>
            <option value="12001-12500" <?php if( empty($_POST) === true ) { if ($fetched_data['impact'] == '12001-12500')    echo ' selected = "selected"'; } else { if($_POST['impact'] == '12001-12500') echo ' selected = "selected"'; } ?> >12001-12500</option>
            <option value="12501-13000" <?php if( empty($_POST) === true ) { if ($fetched_data['impact'] == '12501-13000')    echo ' selected = "selected"'; } else { if($_POST['impact'] == '12501-13000') echo ' selected = "selected"'; } ?> >12501-13000</option>
            <option value="13001-13500" <?php if( empty($_POST) === true ) { if ($fetched_data['impact'] == '13001-13500')    echo ' selected = "selected"'; } else { if($_POST['impact'] == '13001-13500') echo ' selected = "selected"'; } ?> >13001-13500</option>
            <option value="13501-14000" <?php if( empty($_POST) === true ) { if ($fetched_data['impact'] == '13501-14000')    echo ' selected = "selected"'; } else { if($_POST['impact'] == '13501-14000') echo ' selected = "selected"'; } ?> >13501-14000</option>
            <option value="14001-14500" <?php if( empty($_POST) === true ) { if ($fetched_data['impact'] == '14001-14500')    echo ' selected = "selected"'; } else { if($_POST['impact'] == '14001-14500') echo ' selected = "selected"'; } ?> >14001-14500</option>
            <option value="14501-15000" <?php if( empty($_POST) === true ) { if ($fetched_data['impact'] == '14501-15000')    echo ' selected = "selected"'; } else { if($_POST['impact'] == '14501-15000') echo ' selected = "selected"'; } ?> >14501-15000</option>
            <option value="15001-15500" <?php if( empty($_POST) === true ) { if ($fetched_data['impact'] == '15001-15500')    echo ' selected = "selected"'; } else { if($_POST['impact'] == '15001-15500') echo ' selected = "selected"'; } ?> >15001-15500</option>
            <option value="15501-16000" <?php if( empty($_POST) === true ) { if ($fetched_data['impact'] == '15501-16000')    echo ' selected = "selected"'; } else { if($_POST['impact'] == '15501-16000') echo ' selected = "selected"'; } ?> >15501-16000</option>
            <option value="16001-16500" <?php if( empty($_POST) === true ) { if ($fetched_data['impact'] == '16001-16500')    echo ' selected = "selected"'; } else { if($_POST['impact'] == '16001-16500') echo ' selected = "selected"'; } ?> >16001-16500</option>
            <option value="16501-17000" <?php if( empty($_POST) === true ) { if ($fetched_data['impact'] == '16501-17000')    echo ' selected = "selected"'; } else { if($_POST['impact'] == '16501-17000') echo ' selected = "selected"'; } ?> >16501-17000</option>
            <option value="17001-17500" <?php if( empty($_POST) === true ) { if ($fetched_data['impact'] == '17001-17500')    echo ' selected = "selected"'; } else { if($_POST['impact'] == '17001-17500') echo ' selected = "selected"'; } ?> >17001-17500</option>
            <option value="17501-18000" <?php if( empty($_POST) === true ) { if ($fetched_data['impact'] == '17501-18000')    echo ' selected = "selected"'; } else { if($_POST['impact'] == '17501-18000') echo ' selected = "selected"'; } ?> >17501-18000</option>
            <option value="18001-18500" <?php if( empty($_POST) === true ) { if ($fetched_data['impact'] == '18001-18500')    echo ' selected = "selected"'; } else { if($_POST['impact'] == '18001-18500') echo ' selected = "selected"'; } ?> >18001-18500</option>
            <option value="18501-19000" <?php if( empty($_POST) === true ) { if ($fetched_data['impact'] == '18501-19000')    echo ' selected = "selected"'; } else { if($_POST['impact'] == '18501-19000') echo ' selected = "selected"'; } ?> >18501-19000</option>
            <option value="19001-19500" <?php if( empty($_POST) === true ) { if ($fetched_data['impact'] == '19001-19500')    echo ' selected = "selected"'; } else { if($_POST['impact'] == '19001-19500') echo ' selected = "selected"'; } ?> >19001-19500</option>
            <option value="19501-20000" <?php if( empty($_POST) === true ) { if ($fetched_data['impact'] == '19501-20000')    echo ' selected = "selected"'; } else { if($_POST['impact'] == '19501-20000') echo ' selected = "selected"'; } ?> >19501-20000</option>
            </select>
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