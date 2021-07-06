<?php

require __DIR__ . '/vendor/autoload.php';
include 'config.php';
session_start();

if(!isset($_SESSION["id"])){
  die('undefined: $_SESSION["id"]');
  exit;
}
if(!isset($_SESSION["ap"])){
  die('undefined: $_SESSION["ap"]');
  exit;
}
$mac = $_SESSION["id"];
$ap = $_SESSION["ap"];
$password = $_POST['password'];
$email = $_POST['email'];


$unifi_connection = new UniFi_API\Client($controller['username'], $controller['password'], $controller['url'], $controller['site_id'], $controller['version']);
$set_debug_mode   = $unifi_connection->set_debug($controller['debug']);
$loginresults     = $unifi_connection->login();

$auth_result = $unifi_connection->authorize_guest($mac, $duration, $up = null, $down = null, $MBytes = null, $ap);
echo('$auth_result: ');
echo('<br />');
print_r($auth_result);
//User will be authorized at this point; their name and email address can be saved to some database now
?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>WiFi Portal</title>
        <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
		<meta http-equiv="refresh" content="5;url=https://www.google.com/" />
    </head>
    <body>
            <p>You're online! <br>
            Thanks for visiting us!</p>
    </body>
</html>
