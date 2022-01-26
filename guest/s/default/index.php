<?php
include 'config.php';
include 'url-params.php'; // contains url_params() function that is used help prevent caching
include 'device-auto-login.php'; // contains attempt_auto_logon() function

if ($config['debug_test_screen']) {
    require __DIR__ . '\tests.php';
    exit;
}
// print_r($_GET);
if (!isset($_SESSION)) {
    session_start();
}

//Get the MAC addresses of AP and user
if (isset($_GET["id"])) {
    $_SESSION["id"] = $_GET["id"];
}

if (isset($_GET["ap"])) {
    $_SESSION["ap"] = $_GET["ap"];
}
if (isset($_GET["url"])) {
    $_SESSION["url"] = $_GET["url"];
}
if (isset($_GET["t"])) {
    $_SESSION["t"] = $_GET["t"];
}
if (isset($_GET["ssid"])) {
    $_SESSION["ssid"] = $_GET["ssid"];
}

$result = attempt_auto_login();
if ($result) {
    die('device is logged in, so redirect to "logged in" screen');
    // device is logged in, so redirect to "logged in" screen
    // (where they can press "continue browsing" or redirect original requested site, or forced landing page)
}


  // $user = getUserByLoginAndPassword();
  // if ($user['id']) {
  //     // user has just logged in, so redirect to "logged in" screen
  //     die('device is logged in, so redirect to "logged in" screen');
  // }

  // unable to auto-login, so show login screen
die('show login screen');

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>SyncSpot - Welcome</title>
        <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <link rel="stylesheet" href="css/style.css<?php url_params(); ?>">
        <link rel="stylesheet" href="css/normalize.css<?php url_params(); ?>">
        <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
        <link rel="icon" href="favicon.ico" type="image/x-icon">
    </head>
    <body>
  		<p>
        <div class="center-contents">
          <h1>Welcome to SyncSpot</h1>
        </div>
        <div class="center-contents">
          <h3>Sign in to use the Internet:</h3>
        </div>
        <br>
        <div class="center-contents">
      		<form method="post" action="redirect.php">
            <input type="hidden" name="action" value="index.php">
            <label for="username">Username, Email or Phone: </label>
            <br>
      			<input type="text" class="text-large" name="username" placeholder="Enter username" autocomplete="username">
            <br>
            <br>

            <label for="password">Password: </label>
            <br>
      			<!-- <input type="password" name="password" placeholder="Insert New Password" autocomplete="new-password"> -->
            <input type="password" class="text-large" name="password" placeholder="Enter password" autocomplete="current-password">
            <br>
            <br>
            <div style="text-align:right;">
              <a href="forgot-password.php">Forgot password?</a>
            </div>
            <br>

            <br>
      			<input type="submit" class="button-large" value="Sign In">
      		</form>
        </div>
        <div class="center-contents">
            <p>New user? <a href="register.php">Create account</a></p>

        </div>
      </p>
      <br><br><br><br><br><br>
      <div class="center-contents">
          <form action="redirect.php" method="post">
            <input type="hidden" name="redirect_to" value="index.php">
            <input type="submit" value="🔄 Reload Page">
          </form>
          <form action="redirect.php" method="post">
            <input type="hidden" name="redirect_to" value="manage-site.php">
            <input type="submit" value="🛠️ Manage Site">
          </form>
      </div>
      <a href="https://www.payfast.co.za/" target="_blank">Payfast</a>
      <!-- <button type="button" name="btnReload" onclick="reload();">🎨 Customize</button> -->
    </body>
</html>
