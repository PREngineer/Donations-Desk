<!-- Drop down menu for sorting -->
  Filter by: 
  <form method="POST" enctype="form-data" action="">
    <select name="sort-by">
        <option value="ALL">SHOW ALL</option>
        <option value="Agricultural">Agricultural</option>
        <option value="Animal">Animal</option>
        <option value="Arts & Culture">Arts & Culture</option>
        <option value="Children">Children</option>
        <option value="Climate Change">Climate Change</option>
        <option value="Disaster Relief">Disaster Relief</option>
        <option value="Economic Development">Economic Development</option>
        <option value="Education">Education</option>
        <option value="Environment">Environment</option>
        <option value="Federal">Federal</option>
        <option value="Health">Health</option>
        <option value="Human Rights">Human Rights</option>
        <option value="Humanitarian Help">Humanitarian Help</option>
        <option value="Labor">Labor</option>
        <option value="Literacy">Literacy</option>
        <option value="Political">Political</option>
        <option value="Religious">Religious</option>
        <option value="Scientific">Scientific</option>
        <option value="Social & Recreational">Social & Recreational</option>
        <option value="Sports">Sports</option>
        <option value="Technology">Technology</option>
        <option value="Veteran">Veteran</option>
        <option value="Women & Girls">Women & Girls</option>
    </select>
    <!-- Search box -->
    OR Search the Campaign details:
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
          <td width="50">
            <b>Action</b>
          </td>
          <td width="100">
            <b>Account</b>
          </td>
          <td width="100">
            <b>Goal</b>
          </td>
          <td width="100">
            <b>End Date</b>
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
      echo $num . " result(s) for your search: '" . $string ."'";
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
        <a href="admin-manage-campaign.php?edit=1&id=' . $id . '">Edit</a>
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