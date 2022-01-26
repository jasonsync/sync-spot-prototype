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
        <title>SyncSpot - Manage</title>
        <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <link rel="stylesheet" href="css/style.css<?php url_params(); ?>">
        <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
        <link rel="icon" href="favicon.ico" type="image/x-icon">
    </head>
    <body>
  		<p>
        <div class="center-contents">
          <h1>Site Management</h1>
        </div>
        <div class="center-contents">
          <h3>Customize Portal:</h3>
        </div>
        <div class="center-contents">
          - something
          <br>- something else
          <br>- another thing
        </div>
        <div class="center-contents">
          <h3>Site Settings:</h3>
        </div>
        <div class="center-contents">
          - something
          <br>- something else
          <br>- another thing
        </div>
      </p>
      <div class="center-contents">
    		<form method="post" action="login.php">
          <input type="hidden" name="submit" value="">
          <!-- <fieldset>
            <legend>Select sign-in method</legend>

            <input type="radio" id="login-method-username" name="login-method" value="username">
            <label for="login-method-username">Username</label>
      			<input type="text" name="username" autocomplete="username">
            <br>
            <input type="radio" id="login-method-email" name="login-method" value="email">
            <label for="login-method-email">Email Address</label>
      			<input type="text" name="email" autocomplete="email" disabled="disabled">
            <br>
            <input type="radio" id="login-method-phone" name="login-method" value="phone">
            <label for="login-method-phone">Phone number</label>
      			<input type="text" name="phone" autocomplete="phone_number" disabled="disabled">
          </fieldset> -->
          <br>


          <br>
          <br>

    			<input type="submit" value="Update">
    		</form>
      </div>
      <br><br><br>
      <br><br><br>
      <br><br>
      <div class="center-contents">
          <form action="redirect.php" method="post">
            <input type="hidden" name="redirect_to" value="manage-site.php">
            <input type="submit" value="🔄 Reload Page">
          </form>
          <form action="redirect.php" method="post">
            <input type="hidden" name="redirect_to" value="index.php">
            <input type="submit" value="🚪 Log Out">
          </form>
      </div>
      <!-- <button type="button" name="btnReload" onclick="reload();">🎨 Customize</button> -->
    </body>
    <script type="text/javascript">
      var reload = function (){
        window.location.reload();
      };
    </script>
</html>
