<?php
// ob_start();
include('backbones/includes/global.php');
session_start();
?>
<html>
  <head>
    <title><?php echo $siteName ?> - Login</title>
    <!-- CSS Styles -->
    <link href="css/login-style.css" type="text/css" rel="stylesheet" media="screen" />
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Ubuntu:400,700italic,700,500italic,500,400italic,300,300italic' rel='stylesheet' type='text/css'>
    <!-- Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  </head>
  <body>
    <div id="header">
      <div class="companyName">
        <a href="login.php">AZ<div class="secondPartName">Gems Admin Login Panel</div></a>
      </div>
    </div>
  <?php if(isset($_SESSION['error'])) :
    unset($_SESSION['error']);?>
    <div id="error">
      <h3>The username and password combination was incorrect.</h3>
    </div>
  <?php endif; ?>
    <div id="loginBox">
      <form action="backbones/login-verification.php" method="post">
        <div class="formText">
          <br /><br /><br />
          <label for="username">Username:</label>
          <br />
          <input type="text" id="username" name="username">
          <br />
          <label for="password">Password:</label>
          <br />
          <input type="password" id="password" name="password">
        </div>
        <input type="submit" name="submit" value="Submit" />
      </form>
    </div>
  </body>
</html>
