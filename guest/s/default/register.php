<?php
include 'config.php';
include 'url-params.php'; // contains url_params() function that is used help prevent caching...

session_start();

$error = false;
$error_msg = '';
echo '_SESSION<br><pre>';
print_r($_SESSION);
echo '</pre><br><br>_POST<br>';
print_r($_POST);
echo '<br><br>_GET<br>';
print_r($_GET);
// exit;

if (isset($_POST['submit'])) {
    $response = json_decode(include("api/user/register/index.php"), true);
    // print_r($response);

    if (isset($response['error'])) {
        $error = true;
        $error_msg = $response['errorMsg'];
        echo 'Unable to register: ';
        echo $error_msg;
    }


    if (isset($response['registered'])) {
        header("Location: login.php");
    }
}

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
          <h3>Create your account:</h3>
        </div>
        <br>
        <div class="center-contents">
          <form action="redirect.php" method="post">
            <input type="hidden" name="redirect_to" value="register.php">
            <input type="hidden" name="action" value="register">
            <input type="hidden" name="submit" value="">


            <label for="username">Username:</label>
            <br>
      			<input type="text" class="text-large" name="username" placeholder="e.g. student123" autocomplete="username" required>
            <br>
            <br>

            <label for="username">Email Address:</label>
            <br>
      			<input type="email" class="text-large" name="email" placeholder="e.g. student123@uwc.ac.za" autocomplete="email" required>
            <br>
            <br>

            <label for="phone">Phone Number:</label>
            <br>
            <input type="tel" class="text-large" name="phone" placeholder="e.g. 011-222-3344" autocomplete="tel" required>
      			<br>
            <br>

            <label for="password">Password: </label>
            <br>
      			<input type="password" class="text-large" name="password" minlength="8" placeholder="At least 8 characters" autocomplete="new-password" required>
            <br>
            <br>

            <label for="password">Confirm Password: </label>
            <br>
      			<input type="password" class="text-large" name="confirm_password" minlength="8" placeholder="At least 8 characters" autocomplete="new-password" required>
            <br>
            <br>


            <br>

            <br>
      			<input type="submit" class="button-large" value="Register">
      		</form>
        </div>
      </p>
      <br><br><br><br><br><br>
      <div class="center-contents">
          <form action="redirect.php" method="post">
            <input type="hidden" name="redirect_to" value="register.php">
            <input type="submit" value="🔄 Reload Page">
          </form>
      </div>
    </body>
</html>
<!--

<label for="phone">Phone Number: </label>
<br>
<input type="phone" name="phone" placeholder="Insert phone number" autocomplete="tel" value="<?php echo isset($_POST['phone'])?$_POST['phone']:'';?>">
<br>
<br>

<label for="email">Email Address: </label>
<br>
<input type="text" name="email" placeholder="Enter email address" autocomplete="email" value="<?php echo isset($_POST['email'])?$_POST['email']:'';?>">
<br>
<br>

<label for="password">Password: </label>
<br>

<input type="password" name="password" placeholder="Enter password" autocomplete="current-password">
<br>
<br>

<input type="checkbox" name="accept_terms" value="" autocomplete="off">Accept
<a href="#">Terms & Conditions</a>
<br>
<br>

<input type="submit" value="Register">
<br>
<br>
<i><a href="#">POPI Stuff</a></i>


 -->
