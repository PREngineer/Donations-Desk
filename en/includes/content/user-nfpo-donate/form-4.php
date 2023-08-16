<?php 
  
  /*
  Calls the function that retrieves the data
  */
  $fetched_data = nfpo_data($user_data['username'], 'paypal', 'bank-account');

  // If the POST has information
  if(empty($_POST) === false)
  {
    // If there are no errors
    if(empty($errors) === true)
    {
      // Check if the e-mail has the right form
      if( empty($_POST['paypal']) === false && filter_var($_POST['paypal'], FILTER_VALIDATE_EMAIL) === false )
      {
        // Display the appropriate message
        $errors[] = 'A valid PayPal address is required.';
      }
    }
  }

  // If the post is not empty and there are no errors
  if(empty($_POST) === false && empty($errors) === true)
  {

    // Save the nfpo data in array
    $nfpo_data = array(
        'username'            => $user_data['username'],
        'bank-account'        => $_POST['bank-account'],
        'paypal'              => $_POST['paypal']
      );

    // Add the info to the the NFPO entry in DB
    update_donation_info($nfpo_data);

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
    echo '<center><font color="green"><p>Information Updated!</p>
          <p>Continue to the next information required: </p></font>
          <p><a href="user-nfpo-purpose.php">By Clicking Here!</a></p></center>';
  }

?>


<!-- PART 4: DONATION INFORMATION -->
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
          <th>Bank Account</th>
            <td>
              <textarea class="w-input" name="bank-account" rows="2" cols="98" placeholder="Enter Bank Name & Account Number"><?php if( empty($_POST) === true ) print_r($fetched_data['bank-account']); else print_r($_POST['bank-account']); ?></textarea>
            </td>
        </tr>

        <tr>
          <th>Paypal</th>
            <td>
              <input class="w-input" name="paypal" type="text" value="<?php if( empty($_POST) === true ) print_r($fetched_data['paypal']); else print_r($_POST['paypal']); ?>" placeholder="Enter PayPal E-mail">
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