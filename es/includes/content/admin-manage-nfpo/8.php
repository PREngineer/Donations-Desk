<?php

  /*
  Calls the function that retrieves the data
  */
  $fetched_data = admin_nfpo_data($_GET['id'], 'username', 'audit');

?>

<!-- Part 7: OFFICIAL DOCUMENTATION -->

<table>
<tbody>

  <form class="login-form" enctype="multipart/form-data" action="/donationsdesk/uploads/admin-upload-pdf.php" method="POST">

      <!-- Hidden values for DB insertion -->
      <input class="w-input" name="user" type="hidden" value="<?php echo $fetched_data['username']; ?>">
      <input class="w-input" name="db-field" type="hidden" value="audit">
      <input class="w-input" name="doc" type="hidden" value="8">
      <input class="w-input" name="id" type="hidden" value="<?php echo $_GET['id']; ?>">

      <tr>
        <td colspan="2">
          <h2>Documento Audit actual:</h2>
          <br><br>
          <iframe src="http://docs.google.com/gview?url=http://asesoresfinancierospr.org/<?php echo $fetched_data['audit']; ?>&embedded=true" style="width:700px; height:400px;" frameborder="0"></iframe>
          <br><br>
        </td>
      </tr>
      
      </th>
        <td>
          <input class="w-input" name="MAX_FILE_SIZE" type="hidden" value="5242880">
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