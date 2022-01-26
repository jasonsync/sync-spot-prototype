<?php
include 'config.php';
include 'url-params.php'; // contains url_params() function that is used help prevent caching...

// print_r($_GET);
session_start();
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>SyncSpot - Forgot Password</title>
        <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <link rel="stylesheet" href="css/style.css<?php url_params(); ?>">
        <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
        <link rel="icon" href="favicon.ico" type="image/x-icon">
    </head>
    <body>
  		<p>
        <div class="center-contents">
          <h1>Welcome to SyncSpot</h1>
        </div>
        <div class="center-contents">
          <h3>Forgot password?</h3>
        </div>
        <div class="center-contents">
      		<form method="post" action="reset-password.php">
            <input type="hidden" name="submit" value="">
            <br>


            <label for="email">Email Address: </label>
            <br>
      			<input type="text" class="text-large"  name="email" placeholder="Enter email address" autocomplete="email">
            <br>
            <br>

            <input type="submit" class="button-large" value="Reset password...">

      		</form>
        </div>
      </p>
      <br><br><br><br><br><br>
      <div class="center-contents">
          <form action="redirect.php" method="post">
            <input type="hidden" name="redirect_to" value="login-help.php">
            <input type="submit" value="🔄 Reload Page">
          </form>
          <form action="redirect.php" method="post">
            <input type="hidden" name="redirect_to" value="index.php">
            <input type="submit" value="🚪 Back">
          </form>
      </div>
      <!-- <button type="button" name="btnReload" onclick="reload();">🎨 Customize</button> -->
    </body>
</html>
