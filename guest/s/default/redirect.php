<?php
/*
This file is to protect the UX...
When a user submits a form that makes a POST request,
and then presses the back button on their mobile phone it will
normally show an error about form resubmission.

In order to prevent this from happening, we need to make sure ther referer
wasn't a form submit with POST variables. To do this, we use this file as a
"proxy", save the POST variables to the session, and redirect without post
variables.

As long as we use this file (instructions below), a user can do whatever and it
won't break the back / forward page navigation functionality.

It works as follows:
1. User submits form with POST request to this file, including $_POST["redirect_to"]
which should be the required target page.
2. This file writes the $_POST variable to $_SESSION["_POST"]
2. This file writes $_POST["redirect_to"] to $_SESSION["redirect_to"]
3. This file does a HTML meta refresh to this same page (without POST params...)
4. This file does a HTML meta refresh to the redirect page ($_SESSION["redirect_to"])
5. The redirected target can access the POST variables from $_SESSION["_POST"]

*/

session_start();
if (!empty($_GET) || !empty($_POST)) {
    $_SESSION['_GET'] = $_GET;
    $_SESSION['_POST'] = $_POST;
    if (isset($_POST['redirect_to'])) {
        $_SESSION['redirect_to'] = $_POST['redirect_to'];
        // First redirect - load this page again without a POST...
        ?>
          <!DOCTYPE html>
          <html lang="en" dir="ltr">
            <head>
              <meta charset="utf-8">
              <meta http-equiv="refresh" content="0;URL='redirect.php'" />
              <title>Loading...</title>
            </head>
            <body>
            </body>
          </html>
<?php
      exit;
    }
}
if (!isset($_SESSION['redirect_to'])) {
    die('$_SESSION["redirect_to"] is not set');
}

// First redirect - this actually takes the user where they want to be
?>
<!-- Second redirect -->
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="refresh" content="0;URL='<?php echo $_SESSION["redirect_to"]; ?>'" />
    <title>Loading...</title>
  </head>
  <body>
  </body>
</html>
