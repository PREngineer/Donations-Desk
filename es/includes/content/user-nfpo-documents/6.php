<?php

  /*
  Calls the function that retrieves the data
  */
  $fetched_data = nfpo_data($user_data['username'], 'username', 'state-inscription');

?>

<!-- Part 7: OFFICIAL DOCUMENTATION -->

<table>
<tbody>

  <form class="login-form" enctype="multipart/form-data" action="/donationsdesk/uploads/upload-pdf.php" method="POST">

      <!-- Hidden values for DB insertion -->
      <input class="w-input" name="user" type="hidden" value="<?php echo $fetched_data['username']; ?>">
      <input class="w-input" name="db-field" type="hidden" value="state-inscription">
      <input class="w-input" name="doc" type="hidden" value="6">

      <tr>
        <td colspan="2">
          <h2>Documento de Inscripción con el Dpto. de Estado actual es:</h2>
          <br><br>
          <iframe src="http://docs.google.com/gview?url=http://webjmps.byethost16.com<?php echo $fetched_data['state-inscription']; ?>&embedded=true" style="width:700px; height:400px;" frameborder="0"></iframe>
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
         <input class="w-button" type="submit" value="Subir">
        </td>
      </tr>
      

  </form>

</tbody>
</table>