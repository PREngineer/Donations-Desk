<!-- Drop down menu for sorting -->
  Organize por: 
    <form method="POST" enctype="form-data" action="">
    <select name="sort-by">
        <option value="username">Usuario</option>
        <option value="email">E-mail</option>
        <option value="first-name">Nombre</option>
        <option value="last-name">Apellido</option>
    </select>
    <!-- Search box -->
    o busque por Usuario:
    <input type="text" placeholder="Buscar ..." name="string" value="">
  <!-- GO! button -->
  <input type="submit" value="Go!">
  </form>

  <br>

    <!-- Table Displaying all NFPOs-->
    <table>
    <tbody>
    <center>
  
        <tr>
        <td width="100">
        <b>Usuario</b>
        </td>
        <td width="300">
        <b>E-mail</b>
        </td>
        <td width="100">
        <b>Nombre</b>
        </td>
        <td width="100">
        <b>Apellido</b>
        </td>
        <td width="100">
        <b>Rol</b>
        </td>
        <td width="100">
        <b>Activo</b>
        </td>
        </tr>

<?php
  // If page was just loaded (nothing was posted)
  if(empty($_POST) === true)
  { // Display by name
    $result = display_all_accounts('username');
    $num = accounts_count();
  }
  // If page has posted
  else
  {
    // And a Search string was passed
    if(empty($_POST) === false && empty($_POST['string']) === false)
    {
      // Display the results of the search
      $string = mysql_real_escape_string($_POST['string']);
      $result = account_search($string);
      $num = account_search_count($string);
      // Show the results message
      echo $num . " resultado(s) para su búsqueda: '" . $string ."'";
    }
    // If nothing was searched but sorting was applied
    else
      {
        // Sort accordingly
        $result = display_all_accounts($_POST['sort-by']);
        $num = accounts_count();
      }
  }

  $i = 0;
  // Go over every result and display on the table.
  while ($i < $num) 
  {
    $id = mysql_result($result,$i,"id");
    $field1 = mysql_result($result,$i,"username");
    $field2 = mysql_result($result,$i,"email");
    $field3 = mysql_result($result,$i,"first-name");
    $field4 = mysql_result($result,$i,"last-name");
    $field5 = mysql_result($result,$i,"role");
    $field6 = mysql_result($result,$i,"active");

    // Make the Name a link to the details page
    echo '
    <tr class="nfpoblock">
      <td width="100">
        <a href="admin-manage-accounts.php?edit=1&id=';
        echo $id;
    echo '">
        <b>
        ';
        echo $field1;
    
    echo '  </b></a>
      </td>
      <td width="300">
      ';
        echo $field2; 
    
    echo '
      </td>
      <td width="100">
      ';
        echo $field3;
    
    echo '
      </td>
      <td width="100">
      ';
        echo $field4;
    
    echo '
      </td>
      <td width="100">
      ';
      if($field5 == '1')
      {
        echo 'Admin';
      }
      else
      {
        echo 'User';
      }
    echo '
      </td>
      <td width="100">
      ';
      if($field6 == '1')
      {
        echo 'Activo';
      }
      else
      {
        echo 'Inactivo';
      }
    echo '
      </td>
    </tr>
    ';

    $i++;
  }

?>

    </tbody>
    </center>
  </table>