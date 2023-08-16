<?php

  /*
  Calls the function that retrieves the data
  */
  $fetched_data = nfpo_data($user_data['username'], 'username', 'pic2');

?>

<!-- Part 7: OFFICIAL DOCUMENTATION -->

<table>
<tbody>

  <form class="login-form" enctype="multipart/form-data" action="/donationsdesk/uploads/upload-picture.php" method="POST">

      <!-- Hidden values for DB insertion -->
      <input class="w-input" name="user" type="hidden" value="<?php echo $fetched_data['username']; ?>">
      <input class="w-input" name="db-field" type="hidden" value="pic2">
      <input class="w-input" name="doc" type="hidden" value="3">

      <tr>
        <td colspan="2">
          <h2>Foto #2 actual es:</h2>
          <br><br>
          <img src="<?php echo $fetched_data['pic2'];?>" height="400" width="400">
          <br><br>
        </td>
      </tr>
      
      <tr>
        <th>Foto</th>
        <td>
          <input class="w-input" name="MAX_FILE_SIZE" type="hidden" value="2097152">
          <div>
            <input class="w-input" name="file" type="file">
          </div>
        </td>
      </tr>
          
      <tr>
        <td colspan="2" align="right">
         <input class="w-button" type="submit" value="Subir">
        </td>
      </tr>
      

  </form>

</tbody>
</table>