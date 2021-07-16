<?php
include 'config.php';
session_start();
//Get the MAC addresses of AP and user
if (isset($_GET["id"])) {
    $_SESSION["id"] = $_GET["id"];
}

if (isset($_GET["ap"])) {
    $_SESSION["ap"] = $_GET["ap"];
}

if (!isset($_SESSION["id"])) {
    $_SESSION["id"] = '';
}
if (!isset($_SESSION["ap"])) {
    $_SESSION["ap"] = '';
}
if (!isset($_SESSION["url"])) {
    $_SESSION["url"] = '';
}



 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <title>SyncSpot Tests</title>
  <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <link rel="stylesheet" href="css/test-style.css">
  <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
  <link rel="icon" href="favicon.ico" type="image/x-icon">
</head>

<body>
  <h1>SyncSpot Tests</h1>
  <h5>
    <span class="grey italic">This test console is displayed because somebody set "test_screen" => true in the config file.</span><br />
    <span style="color:<?php echo ($config['unifi-api']['controller']['debug'])?'green':'red'; ?>">Unifi Controller API debug messages are currently <span style="font-size:12pt;"><?php echo ($config['unifi-api']['controller']['debug'])?'on':'off'; ?></span></span>
    <span class="grey italic"> set $config['unifi-api']['controller']['debug'] = <?php echo ($config['unifi-api']['controller']['debug'])?'false to turn off':'true to turn on'; ?>.</span><br />
    <span style="color:<?php echo ($config['sync']['unifi-helper']['debug'])?'green':'red'; ?>">SyncSpot debug messages are currently <span style="font-size:12pt;"><?php echo ($config['sync']['unifi-helper']['debug'])?'on':'off'; ?></span></span>
    <span class="grey italic"> set $config['sync']['unifi-helper']['debug'] = <?php echo ($config['sync']['unifi-helper']['debug'])?'false to turn off':'true to turn on'; ?>.</span><br />
  </h5>

  <?php

  if (isset($_GET["id"])) {
      $_SESSION["id"] = $_GET["id"];
  }
  if (isset($_GET["ap"])) {
      $_SESSION["ap"] = $_GET["ap"];
  }
  if (isset($_GET["url"])) {
      $_SESSION["url"] = $_GET["url"];
  }

  if ($config['sync']['unifi-helper']['debug']) {
      ?>
          PHP $_GET:<br />
          <pre>
          <?php print_r($_GET); ?>
          </pre>
          <br /><br />
          PHP $_Session:<br />
          <pre>
          <?php print_r($_SESSION); ?>
          </pre>
          <br /><br />

  <?php
  }


  ?>
  <div class="flex-heading-container">
    <div class="flex-heading-item" style="background-color:#549949;">General Tests</div>
  </div>
  <div class="flex-container" style="background-color:#549949;">
    <div class="flex-item">
      <button type="button" name="btnControllerLogin" onclick="controller_login();">Unifi Controller Login</button>
      <div class="description">
        Test API connection to Unifi Controller
      </div>
    </div>
    <div class="flex-item">
      <button type="button" name="btnKillSessionAndReload" onclick="kill_session_and_reload();">Kill PHP Session & Reload</button>
      <div class="description">
        Kills this browser's PHP session and reloads this web page
      </div>
    </div>
  </div>

  <div class="wrapper">
    <div class="flex-heading-container">
      <div class="flex-heading-item" style="background-color:#4dcfb2;">Device Authorization</div>
    </div>
    <div class="flex-container" style="background-color:#4dcfb2;">

      <div class="flex-item">
        <button type="button" name="button" onclick="authorize_guest();">Authorize Client</button>
        <button type="button" name="button" onclick="authorize_guest_then_redirect();">... & Redirect</button>
        <button type="button" name="button" onclick="authorize_guest_then_success();">Success landing page</button>
        <button type="button" name="button" onclick="authorize_guest_then_success_then_redirect();">... & Redirect</button>
        <div class="description">
          Grant internet access to a specific Wi-Fi connected device. You can also simulate a redirect on successful authorization.
        </div>
        <div class="requirements">
          Requires "Client MAC"
        </div>
        <div class="requirements">
          "AP MAC" optional
        </div>


        <div class="form-item">
          <label for="success_url">Success URL</label> <input type="text" name="success_url" id="success_url" value="success.php">
          <button type="button" name="btnSESSION_success_url" onclick="document.getElementById('success_url').value='<?php echo $_SESSION['url']; ?>';">Session</button>
          <button type="button" name="btnSYNCSPOT_success_url" onclick="document.getElementById('success_url').value='success.php'">SyncSpot</button>
          <button type="button" name="btnGOOGLE_success_url" onclick="document.getElementById('success_url').value='https://www.google.com/search?q=my+ip'">Google</button>
        </div>
        <div class="form-item">
          <label for="redirect_url">Redirect URL</label> <input type="text" name="redirect_url" id="redirect_url" value="<?php echo $_SESSION['url']; ?>">
          <button type="button" name="btnSESSION_redirect_url" onclick="document.getElementById('redirect_url').value='<?php echo $_SESSION['url']; ?>';">Session</button>
          <button type="button" name="btnGOOGLE_redirect_url" onclick="document.getElementById('redirect_url').value='https://www.google.com/search?q=my+ip'">Google</button>
        </div>
        <div class="form-item">
          <label for="authorize_guest_mac">Client MAC</label> <input type="text" name="authorize_guest_mac" id="authorize_guest_mac" value="<?php echo $_SESSION['id']; ?>">
          <button type="button" name="btnSESSION_authorize_guest_mac" onclick="document.getElementById('authorize_guest_mac').value='<?php echo $_SESSION['id']; ?>';">Session</button>
          <button type="button" name="btnRND_authorize_guest_mac" onclick="document.getElementById('authorize_guest_mac').value=generate_random_mac();">Random</button>
        </div>
        <div class="form-item">
          <label for="authorize_guest_ap_mac">AP MAC</label> <input type="text" name="authorize_guest_ap_mac" id="authorize_guest_ap_mac" value="<?php echo $_SESSION['ap']; ?>">
          <button type="button" name="btnSESSION_authorize_guest_ap_mac" onclick="document.getElementById('authorize_guest_ap_mac').value='<?php echo $_SESSION['ap']; ?>';">Session</button>
          <button type="button" name="btnRND_authorize_guest_ap_mac" onclick="document.getElementById('authorize_guest_ap_mac').value=generate_random_mac();">Random</button>
        </div>
      </div>
      <div class="flex-item">
        <button type="button" name="button" onclick="unauthorize_guest();">Revoke Client Access</button>
        <div class="description">
          Make connected device lose internet authorization (after a few seconds)
        </div>
        <div class="requirements">
          Requires "Client MAC"
        </div>
        <div class="form-item">
          <label for="unauthorize_guest_mac">Client MAC</label> <input type="text" name="unauthorize_guest_mac" id="unauthorize_guest_mac" value="<?php echo $_SESSION['id']; ?>">
          <button type="button" name="btnSESSION_unauthorize_guest_mac" onclick="document.getElementById('unauthorize_guest_mac').value='<?php echo $_SESSION['id']; ?>';">Session</button>
          <button type="button" name="btnRND_unauthorize_guest_mac" onclick="document.getElementById('unauthorize_guest_mac').value=generate_random_mac();">Random</button>
        </div>
      </div>
      <div class="flex-item">
        <button type="button" name="button" onclick="reconnect_guest();">Reconnect Client</button>
        <div class="requirements">
          Requires "Client MAC"
        </div>
      </div>
    </div>
  </div>

  <h4>Debugging note:
    <br />All API requests to a Unifi Controller first establish a connection with the "login" call followed by the specific request.
    <br /> - e.g. To authorize a client device, first "login" and then "authorize_guest" is called.
  </h4>

  <div class="output" id="output">
    Output:
  </div>
  <script type="text/javascript">
    var controller_login = function() {
      fetch('tests/controller_login.php')
        .then(response => response.text())
        .then(data => display_output(data))
    };
    var authorize_guest = function() {
      var client_mac = document.getElementById("authorize_guest_mac").value;
      var ap_mac = document.getElementById("authorize_guest_ap_mac").value;
      fetch('tests/authorize_guest.php?mac=' + client_mac + "&ap=" + ap_mac)
        .then(response => response.text())
        .then(data => display_output(data))
    };

    var authorize_guest_then_redirect = function() {
      var client_mac = document.getElementById("authorize_guest_mac").value;
      var ap_mac = document.getElementById("authorize_guest_ap_mac").value;
      var url = document.getElementById("redirect_url").value;
      fetch('tests/authorize_guest.php?mac=' + client_mac + "&ap=" + ap_mac)
        .then(response => response.text())
        .then(data => display_output(data))
        .then(()=>{window.location = url;})
    };


    var authorize_guest_then_success = function() {
      var client_mac = document.getElementById("authorize_guest_mac").value;
      var ap_mac = document.getElementById("authorize_guest_ap_mac").value;
      var success_url = document.getElementById("success_url").value;
      fetch('tests/authorize_guest.php?mac=' + client_mac + "&ap=" + ap_mac)
        .then(response => response.text())
        .then(data => display_output(data))
        .then(()=>{window.location = success_url;})
    };

    var authorize_guest_then_success_then_redirect = function() {
      var client_mac = document.getElementById("authorize_guest_mac").value;
      var ap_mac = document.getElementById("authorize_guest_ap_mac").value;
      var success_url = document.getElementById("success_url").value;
      var redirect_url = document.getElementById("redirect_url").value;
      fetch('tests/authorize_guest.php?mac=' + client_mac + "&ap=" + ap_mac)
        .then(response => response.text())
        .then(data => display_output(data))
        .then(()=>{window.location = success_url+'?redirect='+redirect_url;})
    };



    var unauthorize_guest = function() {
      var client_mac = document.getElementById("unauthorize_guest_mac").value;
      fetch('tests/unauthorize_guest.php?mac=' + client_mac)
        .then(response => response.text())
        .then(data => display_output(data))
    };

    function display_output(output) {
      document.getElementById("output").innerHTML = "<span style='color:#00c000;'>Output:</span><br /><br />" + output;
    }

    var generate_random_mac = function(){
      return "XX:XX:XX:XX:XX:XX".replace(/X/g, function() {
        return "0123456789ABCDEF".charAt(Math.floor(Math.random() * 16))
      });
    }

    var kill_session_and_reload = function(){
      fetch('kill_session.php')
        .then(response => response.text())
        .then(setTimeout(function(){ window.location.reload(); }, 1000))
    }
  </script>
</body>

</html>
