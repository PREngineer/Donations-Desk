<!-- Drop down menu for sorting -->
  Sort by: 
    <form method="POST" enctype="form-data" action="">
    <select name="sort-by">
        <option value="organization-name">Organization Name</option>
        <option value="username">Account</option>
        <option value="active">Active</option>
        <option value="municipality">Municipality</option>
        <option value="category">Category</option>
        <option value="inc-date">Incorporation Date</option>
        <option value="target">Target Population</option>
        <option value="impact">Population Impact</option>
        <option value="foundations">Foundations</option>
        <option value="rating">Rating</option>
    </select>
    <!-- Search box -->
    OR Search by Organization Name:
    <input type="text" placeholder="Search for..." name="string" value="">
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
          <td width="350">
            <b>Name</b>
          </td>
          <td width="100">
            <b>Account</b>
          </td>
          <td width="100">
            <b>Basic</b>
          </td>
          <td width="100">
            <b>Rep</b>
          </td>
          <td width="100">
            <b>Donation</b>
          </td>
          <td width="100">
            <b>Purpose</b>
          </td>
          <td width="100">
            <b>Social</b>
          </td>
          <td width="100">
            <b>Docs</b>
          </td>
          <td width="100">
            <b>Active</b>
          </td>
        </tr>

<?php
  // If page was just loaded (nothing was posted)
  if(empty($_POST) === true)
  { // Display by name
    $result = admin_display_all_nfpo('organization-name');
    $num = admin_nfpo_count();
  }
  // If page has posted
  else
  {
    // And a Search string was passed
    if(empty($_POST) === false && empty($_POST['string']) === false)
    {
      // Display the results of the search
      $string = mysql_real_escape_string($_POST['string']);
      $result = admin_nfpo_search($string);
      $num = admin_nfpo_search_count($string);
      // Show the results message
      echo $num . " result(s) for your search: '" . $string ."'";
    }
    // If nothing was searched but sorting was applied
    else
      {
        // Sort accordingly
        $result = admin_display_all_nfpo($_POST['sort-by']);
        $num = admin_nfpo_count();
      }
  }

  $i = 0;
  // Go over every result and display on the table.
  while ($i < $num) 
  {
    $id = mysql_result($result, $i, "id");
    $field1 = mysql_result($result, $i, "organization-name");
    $field2 = mysql_result($result, $i, "username");
    $field3 = mysql_result($result, $i, "active");

    // Make the Name a link to the details page
    echo '

    <tr class="nfpoblock">
    
      <td width="50"> 
        ' . ($i + 1) . '
      </td>

      <td width="200"> 
        ' . $field1  . '
      </td>
    
      <td width="100"> 
        ' . $field2  . '
      </td>

      <td width="100"> 
        <a href="admin-manage-nfpo.php?edit=1&id=' . $id . '">Edit</a>
      </td>

      <td width="100"> 
        <a href="admin-manage-nfpo.php?edit=2&id=' . $id . '">Edit</a>
      </td>

      <td width="100"> 
        <a href="admin-manage-nfpo.php?edit=3&id=' . $id . '">Edit</a>
      </td>

      <td width="100"> 
        <a href="admin-manage-nfpo.php?edit=4&id=' . $id . '">Edit</a>
      </td>

      <td width="100"> 
        <a href="admin-manage-nfpo.php?edit=5&id=' . $id . '">Edit</a>
      </td>

      <td width="100"> 
        <a href="admin-manage-nfpo.php?edit=6&id=' . $id . '">Edit</a>
      </td>

      <td width="100">

    ';

        if($field3 == '1')
        {
          echo 'Yes';
        } 
        else
        {
          echo 'No';
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