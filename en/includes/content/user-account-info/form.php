<?php

  //default
  $success = false;

  // If the POST has information
  if(empty($_POST) === false)
  {
    // Establish which fields are required
    $required_fields = array('password', 'email');
    
    // Check all the values provided in the post
    foreach($_POST as $key=>$value)
    {
      // If any of the required fields are not provided
      if(empty($value) && in_array($key, $required_fields) === true)
      {
        // Make an error that says it.
        $errors[] = '[*] = Required Fields';
        break 1;
      }
    }

    // If there are no errors
    if(empty($errors) === true)
    {
      // Check if the current password is correct
      if($user_data['password'] !== MD5($_POST['password']) )
      {
       // Display the appropriate message
        $errors[] = 'Your current password is incorrect.'; 
      }
      // Check if the new password is entered and is >= 6 characters
      if(strlen($_POST['new-password']) < 6 && $_POST['new-password'] !== "")
      {
        // Display the appropriate message
        $errors[] = 'Your new password must be at least 6 characters long.';
      }
      // Check if the new password is entered correctly in both places
      if($_POST['new-password'] !== $_POST['new-password-2'] && ($_POST['new-password'] !== "" || $_POST['new-password-2'] !== "") )
      {
        // Display the appropriate message
        $errors[] = 'Your new password does not match the validation.';
      }
      // Check if the e-mail has the right form
      if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) === false)
      {
        // Display the appropriate message
        $errors[] = 'A valid e-mail address is required.';
      }
    }
  }

  // If the post is not empty and there are no errors
  if(empty($_POST) === false && empty($errors) === true)
  {
    // If the password is not going to be changed
    if($_POST['new-password'] === '')
    {
      // Save the user data in an array
      $update_user_data = array(
          'first-name'    => $_POST['first-name'],
          'last-name'     => $_POST['last-name'],
          'email'         => $_POST['email']
        );
    }
    // If the password is going to be changed
    else
    {
      $update_user_data = array(
          'password'      => $_POST['new-password'],
          'first-name'    => $_POST['first-name'],
          'last-name'     => $_POST['last-name'],
          'email'         => $_POST['email']
        );
    }

    // Change the Account Information
    update_user_account($user_data['id'], $update_user_data);
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
  ?>

</font>

<?php 
// If the Registration went through
if($success == true)
{
  echo '<center><font color="green"><p>Update Successful!</p>
        <p>Your Account Information has been updated.</p></font>
        ';
}
// If there are errors or hasn't been submitted
else
{
  ?>

  <!-- ACTUAL FORM -->

  <table>

  <tbody>

  <form class="login-form" enctype="multipart/form-data" action="" method="POST">

    <tr>
      <td colspan="2">
        <p>You need to provide your current password to be able to change the allowed fields.</p>
        <p>Your Username cannot be changed.</p>
        <p>Your Password will only be changed if you type a new password.</p>
        <hr>
      </td>
    </tr>

    <tr>
      <th>Username: </th>
      <td>
        <input class="w-input" type="text" placeholder="Enter your username" readonly="true" name="username" value="<?php print_r($user_data['username']);?>">
      </td>
    </tr>

    <tr>
      <th>New Password: </th>
      <td>
        <input class="w-input" type="password" placeholder="Enter your new password" name="new-password">
      </td>
    </tr>

    <tr>
      <th>Validate New Password: </th>
      <td>
        <input class="w-input" type="password" placeholder="Enter your new password" name="new-password-2">
      </td>
    </tr>

    <tr>
      <th class="required">Current Password: [*]</th>
      <td>
        <input class="w-input" type="password" placeholder="Enter your current password" name="password">
      </td>
    </tr>

    <tr>
      <th class="required">E-mail: </th>
      <td>
        <input class="w-input" type="text" placeholder="Enter your e-mail address" name="email" value="<?php print_r($user_data['email']);?>">
      </td>
    </tr>

    <tr>
      <th>First Name: </th>
      <td>
        <input class="w-input" type="text" placeholder="Enter your First Name" name="first-name" value="<?php print_r($user_data['first-name']);?>">
      </td>
    </tr>

    <tr>
      <th>Last Name: </th>
      <td>
        <input class="w-input" type="text" placeholder="Enter your Last Name" name="last-name" value="<?php print_r($user_data['last-name']);?>">
      </td>
    </tr>

  </tbody>

  <tbody>
    <tr>
      <td colspan="2" align="right">
       <input class="w-button" type="submit" value="Save Changes">
      </td>
    </tr>
  </tbody>

  </form>

  </table>

<?php } ?>