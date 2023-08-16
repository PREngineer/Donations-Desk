<h4> Hello, Visitor!</h4><br>

<div class="w-form">
  
  <h2>Login</h2>
  
  <form class="login-form" action="process-login.php" method="POST">
    <label for="username">Username:</label>
    <input class="w-input" type="text" placeholder="Enter your username" name="username">
    <label for="password">Password:</label>
    <input class="w-input" type="password" placeholder="Enter your password" name="password">
    <input class="w-button" type="submit" value="Log in">  
    <a href="register.php"><input class="w-button" type="button" value="Register"></a>
    <br>
  </form>
  <a href="register.php">Register</a><br>
  <a href="forgot-password.php">Forgot my Password</a>
  <br>
  
  <br>
  <!-- Print an error message if necessary -->
  <font color="red"><?php print_r($_SESSION['error']); ?></font>
</div>