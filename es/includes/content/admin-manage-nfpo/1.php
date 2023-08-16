<?php

  /*
  Calls the function that retrieves the data
  */
  $fetched_data = admin_nfpo_data($_GET['id'], 'username', 'logo');

?>

<!-- Part 7: OFFICIAL DOCUMENTATION -->

<table>
<tbody>

  <form class="login-form" enctype="multipart/form-data" action="/donationsdesk/uploads/admin-upload-logo.php" method="POST">

      <!-- Hidden values for DB insertion -->
      <input class="w-input" name="user" type="hidden" value="<?php echo $fetched_data['username']; ?>">
      <input class="w-input" name="db-field" type="hidden" value="logo">
      <input class="w-input" name="doc" type="hidden" value="1">
      <input class="w-input" name="id" type="hidden" value="<?php echo $_GET['id']; ?>">

      <tr>
        <td colspan="2">
          <h2>El Logo corriente es:</h2>
          <br><br>
          <img src="<?php echo $fetched_data['logo'];?>" height="250" width="250">
          <br><br>
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
        <td colspan="2" align="right">
         <input class="w-button" type="submit" value="Upload">
        </td>
      </tr>
      

  </form>

</tbody>
</table>