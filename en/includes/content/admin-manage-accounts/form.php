<?php

  // If the POST has information
  if(empty($_POST) === false)
  {
    // Establish which fields are required
    $required_fields = array('username', 'email');
    
    // Check all the values provided in the post
    foreach($_POST as $key=>$value)
    {
      // If any of the required fields are not provided
      if( (empty($value) && in_array($key, $required_fields) === true) )
      {
        // Make an error that says it.
        $errors[] = 'Fields marked with an asterisk are required.';
        break 1;
      }
    }

    // If there are no errors
    if(empty($errors) === true)
    {
      // Check if the new password entered and is >= 6 characters
      if(strlen($_POST['password']) < 6 && $_POST['password'] !== '')
      {
        // Display the appropriate message
        $errors[] = 'Your new password must be at least 6 characters long.';
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
    if($_POST['password'] == '')
    {
      $update_user_data = array(
          'username'      => $_POST['username'],
          'first-name'    => $_POST['first-name'],
          'last-name'     => $_POST['last-name'],
          'email'         => $_POST['email'],
          'role'          => $_POST['role'],
          'active'        => $_POST['active']
      );
    }
    else
    {
      $update_user_data = array(
          'username'      => $_POST['username'],
          'password'      => $_POST['password'],
          'first-name'    => $_POST['first-name'],
          'last-name'     => $_POST['last-name'],
          'email'         => $_POST['email'],
          'role'          => $_POST['role'],
          'active'        => $_POST['active']
      );
    }

    // Change the Account Information
    update_account($_GET['id'], $update_user_data);
    
    // Show success message
    echo '<center><font color="green"><p>Update Successful!</p>
        <p>Account Information has been updated.</p></font></center>
        ';
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

  // Fetch current data for the Account
  $current_data = fetch_current_data($_GET['id']);

?>

</font>

  <!-- ACTUAL FORM -->

  <table>

  <tbody>

  <form class="login-form" enctype="multipart/form-data" action="" method="POST">
    <hr>
    <tr>
      <td colspan="2">
      </td>
    </tr>

    <tr>
      <th class="required">Username: </th>
      <td>
        <input class="w-input" type="text" placeholder="Enter username" name="username" 
        value="<?php print_r($current_data['username']);?>">
      </td>
    </tr>

   <tr>
      <th class="required">Password: [*]</th>
      <td>
        <input class="w-input" type="password" placeholder="Enter password" name="password" value="">
      </td>
    </tr>

    <tr>
      <th class="required">E-mail: </th>
      <td>
        <input class="w-input" type="text" placeholder="Enter e-mail address" name="email" value="<?php print_r($current_data['email']);?>">
      </td>
    </tr>

    <tr>
      <th>First Name: </th>
      <td>
        <input class="w-input" type="text" placeholder="Enter First Name" name="first-name" value="<?php print_r($current_data['first-name']);?>">
      </td>
    </tr>

    <tr>
      <th>Last Name: </th>
      <td>
        <input class="w-input" type="text" placeholder="Enter Last Name" name="last-name" value="<?php print_r($current_data['last-name']);?>">
      </td>
    </tr>

    <tr>
      <th class="required">Permissions: </th>
      <td>
    <input type="radio" name="role" <?php if($current_data['role'] == '1') {echo 'checked ';}?> value="1">Admin
    <input type="radio" name="role" <?php if($current_data['role'] == '0') {echo 'checked ';}?> value="0">User
      </td>
    </tr>

    <tr>
      <th class="required">Activation Status: </th>
      <td>
    <input type="radio" name="active" <?php if($current_data['active'] == '1') {echo 'checked ';}?> value="1">Active
    <input type="radio" name="active" <?php if($current_data['active'] == '0') {echo 'checked ';}?> value="0">Inactive
    <br>
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