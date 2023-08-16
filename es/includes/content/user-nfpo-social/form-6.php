<?php

  /*
  Calls the function that retrieves the data
  */
  $fetched_data = nfpo_data($user_data['username'], 'website', 'youtube', 'facebook', 'google', 'gps', 'twitter');

  // If the post is not empty and there are no errors
  if(empty($_POST) === false && empty($errors) === true)
  {
    // Save the nfpo data in array
    $nfpo_data = array(
        'username'            => $user_data['username'],

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
    echo '<br>ERRORES!<br>';
    // Display the errors
    echo output_errors($errors); 
    echo '</font>';
  }

    // If the Registration went through
    if($success === true)
    {
      echo '<center><font color="green"><p>¡Cambios guardados!</p>
            <p>Continúe a la próxima información: </p></font>
            <p><a href="user-nfpo-documents.php">¡Haciendo click aquí!</a></p></center>';
    }

?>

<!-- Part 6: SOCIAL INFORMATION -->

<p><font color="red">¡Asegúrese de seguir el formato correcto para las Coordenadas GPS!</font></p>

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
         <th>Dirección de página Web</th>
          <td>
            <input class="w-input" name="website" placeholder="(URL)" type="url" value="<?php if( empty($_POST) === true || $_POST['website'] == '' ) print_r($fetched_data['website']); else print_r($_POST['website']); ?>" />
          </td>
        </tr>
        
        <tr>
          <th>Canal de YouTube / Enlace de Video</th>
          <td>
            <div>
              <input class="w-input" name="youtube" placeholder="(URL)" type="url" value="<?php if( empty($_POST) === true || $_POST['youtube'] == '' ) print_r($fetched_data['youtube']); else print_r($_POST['youtube']); ?>" /></div>
          </td>
        </tr>
        
        <tr>
          <th>Google</th>
          <td>
            <div>
              <input class="w-input" name="google" placeholder="(URL)" type="url" value="<?php if( empty($_POST) === true || $_POST['google'] == '' ) print_r($fetched_data['google']); else print_r($_POST['google']); ?>" />
          </td>
        </tr>
        
        <tr>
          <th>Coordenadas GPS de Google Maps</th>
          <td>
            <div>
              <input class="w-input" name="gps" placeholder="18.422896,-66.07026" type="text" value="<?php if( empty($_POST) === true || $_POST['gps'] == '' ) print_r($fetched_data['gps']); else print_r($_POST['gps']); ?>" />
          </td>
        </tr>

        <tr>
          <th>Facebook</th>
          <td>
            <div>
              <input class="w-input" name="facebook" placeholder="(URL)" type="url" value="<?php if( empty($_POST) === true || $_POST['facebook'] == '' ) print_r($fetched_data['facebook']); else print_r($_POST['facebook']); ?>" />
          </td>
        </tr>
        
        <tr>
          <th>Twitter</th>
          <td>
            <div>
              <input class="w-input" name="twitter" placeholder="(URL)" type="url" value="<?php if( empty($_POST) === true || $_POST['twitter'] == '' ) print_r($fetched_data['twitter']); else print_r($_POST['twitter']); ?>" />
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