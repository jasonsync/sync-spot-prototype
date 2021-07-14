<?php

session_start();

//Get the MAC addresses of AP and user
if (isset($_GET["id"])) {
    $_SESSION["id"] = $_GET["id"];
    echo '$_SESSION["id"]:';
    echo '<br />';
    echo $_SESSION["id"];
    echo '<br />';
    echo '<br />';
}

if (isset($_GET["ap"])) {
    $_SESSION["ap"] = $_GET["ap"];
    echo '$_SESSION["ap"]:';
    echo '<br />';
    echo $_SESSION["ap"];
    echo '<br />';
    echo '<br />';
}

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>Hotspot Login</title>
        <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
  		<p>
        Welcome!
        <br>
        <br>
  		  Please login to use the Wi-Fi
      </p>

  		<form method="post" action="connecting.php">

        <!-- <label for="Name">Name: </label>
        <br>
  			<input type="text" name="name" placeholder="Insert Name" autocomplete="name">
        <br>
        <br>

        <label for="phone">Phone Number: </label>
        <br>
  			<input type="phone" name="" placeholder="Insert Phone Number" autocomplete="tel">
        <br>
        <br> -->

        <label for="email">Email: </label>
        <br>
  			<input type="email" name="email" placeholder="Enter Email" autocomplete="email">
        <br>
        <br>

        <label for="password">Password: </label>
        <br>
  			<!-- <input type="password" name="password" placeholder="Insert New Password" autocomplete="new-password"> -->
        <input type="password" name="password" placeholder="Enter Password" autocomplete="current-password">
        <br>
        <br>

  			<input type="submit" value="Log in">
  		</form>
    </body>
</html>
