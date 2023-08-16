<?php

  /*
  Calls the function that retrieves the data
  */
  $fetched_data = admin_nfpo_data($_GET['id'], 'username', 'website', 'youtube', 'facebook', 'google', 'gps', 'twitter');

  // If the post is not empty and there are no errors
  if(empty($_POST) === false && empty($errors) === true)
  {
    // Save the nfpo data in array
    $nfpo_data = array(
        'username'            => $fetched_data['username'],

        'website'             => $_POST['website'],
        'youtube'             => $_POST['youtube'],
        'facebook'            => $_POST['facebook'],
        'google'              => $_POST['google'],
        'gps'                 => $_POST['gps'],
        'twitter'             => $_POST['twitter'],
      );

    // Update the NFPO in DB
    update_social_info($nfpo_data);

    // Enable Success Message
    $success = true;
  }
  // If there are errors
  else if(empty($errors) === false)
  {
    echo '<!-- DISPLAY ANY POSSIBLE ERRORS -->';
    echo '<font color="red">';
    echo '<br>ERRORS!<br>';
    // Display the errors
    echo output_errors($errors); 
    echo '</font>';
  }

    // If the Registration went through
    if($success === true)
    {
      echo '<center><font color="green"><p>Changes were saved!</p></font></center>';
    }

?>

<!-- Browsing menu -->
<table border="1">
  <tbody>
    <th align="left" colspan="6">
      Sections:
    </th>

    <tr>
      <td width="150">
        <a href="admin-manage-nfpo.php?edit=1&id=<?php echo $_GET['id']?>">Basic</a>
      </td>
      <td width="150">
        <a href="admin-manage-nfpo.php?edit=2&id=<?php echo $_GET['id']?>">Representative</a>
      </td>
      <td width="150">
        <a href="admin-manage-nfpo.php?edit=3&id=<?php echo $_GET['id']?>">Donations</a>
      </td>
      <td width="150">
        <a href="admin-manage-nfpo.php?edit=4&id=<?php echo $_GET['id']?>">Purpose</a>
      </td>
      <td width="150">
        <a href="admin-manage-nfpo.php?edit=5&id=<?php echo $_GET['id']?>">Social Media</a>
      </td>
      <td width="150">
        <a href="admin-manage-nfpo.php?edit=6&id=<?php echo $_GET['id']?>">Documents</a>
      </td>
    </tr>
  </tbody>
</table>
<!-- Browsing menu -->

<!-- Part 6: SOCIAL INFORMATION -->

<p><font color="red">Make sure you follow the suggested format for GPS Coordinates!</font></p>

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
         <th>Website Address</th>
          <td>
            <input class="w-input" name="website" placeholder="(URL)" type="url" value="<?php if( empty($_POST) === true ) print_r($fetched_data['website']); else print_r($_POST['website']); ?>" />
          </td>
        </tr>
        
        <tr>
          <th>YouTube Channel/Video Link</th>
          <td>
            <div>
              <input class="w-input" name="youtube" placeholder="(URL)" type="url" value="<?php if( empty($_POST) === true ) print_r($fetched_data['youtube']); else print_r($_POST['youtube']); ?>" /></div>
          </td>
        </tr>
        
        <tr>
          <th>Google</th>
          <td>
            <div>
              <input class="w-input" name="google" placeholder="(URL)" type="url" value="<?php if( empty($_POST) === true ) print_r($fetched_data['google']); else print_r($_POST['google']); ?>" />
          </td>
        </tr>
        
        <tr>
          <th>Google Maps GPS Coordinates</th>
          <td>
            <div>
              <input class="w-input" name="gps" placeholder="18.422896,-66.07026" type="url" value="<?php if( empty($_POST) === true ) print_r($fetched_data['gps']); else print_r($_POST['gps']); ?>" />
          </td>
        </tr>

        <tr>
          <th>Facebook</th>
          <td>
            <div>
              <input class="w-input" name="facebook" placeholder="(URL)" type="url" value="<?php if( empty($_POST) === true ) print_r($fetched_data['facebook']); else print_r($_POST['facebook']); ?>" />
          </td>
        </tr>
        
        <tr>
          <th>Twitter</th>
          <td>
            <div>
              <input class="w-input" name="twitter" placeholder="(URL)" type="url" value="<?php if( empty($_POST) === true ) print_r($fetched_data['twitter']); else print_r($_POST['twitter']); ?>" />
          </td>
        </tr>

      </tbody>

            <tbody>
              <tr>
                <td colspan="2" align="right">
                 <input class="w-button" type="submit" value="Continue">
                </td>
              </tr>
            </tbody>

    </form>

</tbody>
</table>