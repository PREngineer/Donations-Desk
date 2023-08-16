<?php

  // If the POST has information
  if(empty($_POST) === false)
  {
    // Establish which fields are required
    $required_fields = array('username', 'password', 'password-again', 'email', 'first-name', 'last-name');
    
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
      // Check if the user already exists
      if(user_exists($_POST['username']) === true)
      {
        // Display the appropriate message
        $errors[] = 'Sorry, the username \'' . $_POST['username'] . '\' is already taken.';
      }
      // Check if the username has spaces
      if(preg_match("/\\s/", $_POST['username']) == true)
      {
        // Display the appropriate message
        $errors[] = 'Your username must not have any spaces.';
      }
      // Check if the password is >= 6 characters
      if(strlen($_POST['password']) < 6)
      {
        // Display the appropriate message
        $errors[] = 'Your password must be at least 6 characters long.';
      }
      // Check if the password is entered correctly in both places
      if($_POST['password'] !== $_POST['password-again'])
      {
        // Display the appropriate message
        $errors[] = 'Your passwords do not match.';
      }
      // Check if the e-mail is already in use
      if(email_exists($_POST['email']) === true)
      {
        // Display the appropriate message
        $errors[] = 'Sorry, the email \'' . $_POST['email'] . '\' is already registered.';
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
    // Save the user data in array
    $register_user_data = array(
        'username'      => $_POST['username'],
        'password'      => $_POST['password'],
        'first-name'    => $_POST['first-name'],
        'last-name'     => $_POST['last-name'],
        'email'         => $_POST['email'],
        // A combination of the Username + the Timestamp in Microseconds
        'email_code'    => MD5( $_POST['username'] + microtime() ) );

    // Register the Account
    register_user($register_user_data);

    echo '<center><font color="green"><p>Your registration was successful!</p>
        <p>However, your account is NOT active.</p>
        <p>Please, check your e-mail for activation instructions.</p>
        <p>Check your Junk/Spam Folder if you don\'t see it.</p></font>
        <p><a href="login.php">Click here to Log In</a></p></center></div></div>
        ';

    include 'includes/footer.php';        

    // Redirect to confirmation
    header('Location: register.php?success=true');
    exit();
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
if(isset($_GET['success']) && $_GET['success'] == 'true')
{
  echo '<center><font color="green"><p>Your registration was successful!</p>
        <p>However, your account is NOT active.</p>
        <p>Please, check your e-mail for activation instructions.</p>
        <p>Check your Junk/Spam Folder if you don\'t see it.</p></font>
        <p><a href="login.php">Click here to Log In</a></p></center>
        ';
}
// If there are errors or hasn't been submitted
else
{
  ?>
  <!-- ACTUAL FORM -->
  <!-- PART 1: ACCOUNT INFORMATION -->

  <table>

  <tbody>

  <form class="login-form" enctype="multipart/form-data" action="" method="POST">

    <tr>
      <td colspan="2">
        <hr>
        <h2>Account Information</h2>
        <p>This information is used to manage your account and for contact purposes.</p>
      </td>
    </tr>

    <tr>
      <th class="required">Username: [*]</th>
      <td>
        <input class="w-input" type="text" placeholder="Enter your username" name="username" value="<?php print_r($_POST['username']);?>">
      </td>
    </tr>

    <tr>
      <th class="required">Password: [*]</th>
      <td>
        <input class="w-input" type="password" placeholder="Enter your password" name="password" value="<?php print_r($_POST['password']);?>">
      </td>
    </tr>

    <tr>
      <th class="required">Password Check: [*]</th>
      <td>
        <input class="w-input" type="password" placeholder="Enter your password again" name="password-again" value="<?php print_r($_POST['password']);?>">
      </td>
    </tr>

    <tr>
      <th class="required">E-mail: [*]</th>
      <td>
        <input class="w-input" type="text" placeholder="Enter your e-mail address" name="email" value="<?php print_r($_POST['email']);?>">
      </td>
    </tr>

    <tr>
      <th class="required">First Name: [*]</th>
      <td>
        <input class="w-input" type="text" placeholder="Enter your First Name" name="first-name" value="<?php print_r($_POST['first-name']);?>">
      </td>
    </tr>

    <tr>
      <th class="required">Last Name: [*]</th>
      <td>
        <input class="w-input" type="text" placeholder="Enter your Last Name" name="last-name" value="<?php print_r($_POST['last-name']);?>">
      </td>
    </tr>

  </tbody>

  <tbody>
    <tr>
      <td colspan="2" align="right">
       <input class="w-button" type="submit" value="Register">
      </td>
    </tr>
  </tbody>

  </form>

  </table>

<?php } ?>