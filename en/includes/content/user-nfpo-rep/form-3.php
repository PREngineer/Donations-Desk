<?php

  /*
  Calls the function that retrieves the data
  */
  $fetched_data = nfpo_data($user_data['username'], 'username', 'contact-first', 'contact-last', 'contact-email', 'phone');

  // If the POST has information
  if(empty($_POST) === false)
  {
    // Establish which fields are required
    $required_fields = array('contact-first', 'contact-last', 'phone', 'contact-email');
    
    // Check all the values provided in the post
    foreach($_POST as $key=>$value)
    {
      // If any of the required fields are not provided
      if(empty($value) && in_array($key, $required_fields) === true)
      {
        // Make an error that says it.
        $errors[] = 'Fields marked with an asterisk are required.';
        break 1;
      }
    }

    // If there are no errors
    if(empty($errors) === true)
    {
      // Check if the e-mail has the right form
      if(filter_var($_POST['contact-email'], FILTER_VALIDATE_EMAIL) === false)
      {
        // Display the appropriate message
        $errors[] = 'A valid e-mail address is required.';
      }
    }
  }

  // If the post is not empty and there are no errors
  if(empty($_POST) === false && empty($errors) === true)
  {
    // Save the nfpo data in array
    $nfpo_data = array(
        'username'            => $user_data['username'],
        'contact-first'       => $_POST['contact-first'],
        'contact-last'        => $_POST['contact-last'],
        'contact-email'       => $_POST['contact-email'],
        'phone'               => $_POST['phone'],
      );

    // Add the info to the the NFPO entry in DB
    update_rep_info($nfpo_data);

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
        <p><a href="user-nfpo-donate.php">By Clicking Here!</a></p></center>';
}
?>

<!-- Part 3: REPRESENTATIVE INFORMATION -->
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
          <th class="required">Contact First Name [*]</th>
          <td>
            <input class="w-input" name="contact-first" type="text" value="<?php if( empty($_POST) === true || $_POST['contact-first'] == '' ) print_r($fetched_data['contact-first']); else print_r($_POST['contact-first']); ?>" placeholder="John">
          </td>
        </tr>

        <tr>
          <th class="required">Contact Last Name [*]</th>
          <td>
            <input class="w-input" name="contact-last" type="text" value="<?php if( empty($_POST) === true || $_POST['contact-last'] == '' ) print_r($fetched_data['contact-last']); else print_r($_POST['contact-last']); ?>" placeholder="Doe">
          </td>
        </tr>

        <tr>
          <th class="required">Phone [*]</th>
          <td>
            <input class="w-input" name="phone" type="text" value="<?php if( empty($_POST) === true || $_POST['phone'] == '' ) print_r($fetched_data['phone']); else print_r($_POST['phone']); ?>" placeholder="111-222-3333">
          </td>
        </tr>

        <tr>
          <th class="required">Contact Email [*]</th>
          <td>
            <input class="w-input" name="contact-email" type="text" value="<?php if( empty($_POST) === true || $_POST['contact-email'] == '' ) print_r($fetched_data['contact-email']); else print_r($_POST['contact-email']); ?>" placeholder="Enter that person's e-mail">
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