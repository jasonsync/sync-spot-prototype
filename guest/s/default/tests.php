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
    <span class="grey italic">This test console is displayed because somebody set "debug_test_screen" => true in the config file.</span><br />
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

  ?>
  <div id="section_debug_settings" class="flex-section hide-contents">
    <div class="flex-heading-container">
      <div class="flex-heading-item" style="background-color:#9c8561;">
        <div>Debug Settings</div>
        <div class="btn-show" onclick="show_section('section_debug_settings')">+ SHOW</div>
        <div class="btn-hide" onclick="hide_section('section_debug_settings')">- HIDE</div>
      </div>
    </div>
    <div class="flex-container" style="background-color:#9c8561;">
      <div class="flex-item">
        <div class="description">
          <div class="larger">
            Unifi Controller API messages
          </div>
          <br/>
          <span class="grey italic">Disable in production</span>
          <br/>
          <br/>
          <span class="bold" style="font-size:12pt;color:<?php echo ($config['unifi-api']['controller']['debug'])?'green':'red'; ?>"><?php echo ($config['unifi-api']['controller']['debug'])?'Enabled':'Disabled'; ?></span>
          <br/>
          <br/>
          <span class="grey italic"> set $config['unifi-api']['controller']['debug'] = <?php echo ($config['unifi-api']['controller']['debug'])?'false to disable':'true to enable'; ?>.</span>
        </div>
      </div>
      <div class="flex-item">
        <div class="description">
          <div class="larger">
            SyncSpot stack trace messages
          </div>
          <br/>
          <span class="grey italic">Shows stack trace in API response</span>
          <br/>
          <br/>
          <span class="bold" style="font-size:12pt;color:<?php echo ($config['stacktrace_enabled'])?'green':'red'; ?>"><?php echo ($config['stacktrace_enabled'])?'Enabled':'Disabled'; ?></span>
          <br/>
          <br/>
          <span class="grey italic"> set $config['stacktrace_enabled'] = <?php echo ($config['stacktrace_enabled'])?'false to disable':'true to enable'; ?>.</span>
        </div>
      </div>
      <div class="flex-item">
        <div class="description">
          <div class="larger">
            Log debug messages to console
          </div>
          <br/>
          <br/>
          <span class="bold" style="font-size:12pt;color:<?php echo ($config['debug_console_log'])?'green':'red'; ?>"><?php echo ($config['debug_console_log'])?'Enabled':'Disabled'; ?></span>
          <br/>
          <br/>
          <span class="grey italic"> set $config['debug_console_log'] = <?php echo ($config['debug_console_log'])?'false to disable':'true to enable'; ?>.</span>
        </div>
      </div>
      <div class="flex-item">
        <div class="description">
          <div class="larger">
            Display PHP variables
          </div>
          <br/>
          <br/>
          <span class="bold" style="font-size:12pt;color:<?php echo ($config['debug_display_php_vars'])?'green':'red'; ?>"><?php echo ($config['debug_display_php_vars'])?'Enabled':'Disabled'; ?></span>
          <br/>
          <br/>
          <span class="grey italic"> set $config['debug_display_php_vars'] = <?php echo ($config['debug_display_php_vars'])?'false to disable':'true to enable'; ?>.</span>
        </div>
      </div>


    </div>
  </div>
  <!-- SECTION -->
<?php if ($config['debug_display_php_vars']) { ?>

  <div id="section_debug_variables" class="flex-section hide-contents">
    <div class="flex-heading-container">
      <div class="flex-heading-item" style="background-color:#9c8561;">
        <div>PHP Variables</div>
        <div class="btn-show" onclick="show_section('section_debug_variables')">+ SHOW</div>
        <div class="btn-hide" onclick="hide_section('section_debug_variables')">- HIDE</div>
      </div>
    </div>
    <div class="flex-container" style="background-color:#9c8561;">
      <div class="flex-item">
        <div class="description">
          PHP $_SESSION variable:
          <pre><?php print_r($_SESSION); ?></pre>
        </div>
      </div>
      <div class="flex-item">
        <div class="description">
          PHP $_GET variable (this webpage's URL parameters):
          <pre><?php print_r($_GET); ?></pre>
        </div>
      </div>
    </div>
  </div>
<?php } ?>

  <div id="section_general_tests" class="flex-section hide-contents">
    <div class="flex-heading-container">
      <div class="flex-heading-item" style="background-color:#e69821;">
        <div>General Tests</div>
        <div class="btn-show" onclick="show_section('section_general_tests')">+ SHOW</div>
        <div class="btn-hide" onclick="hide_section('section_general_tests')">- HIDE</div>
      </div>
    </div>
    <div class="flex-container" style="background-color:#e69821;">
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
      <div class="flex-item">
        <button type="button" name="btnReload" onclick="reload();">♻ Refresh</button>
        <div class="description">
          Reloads this web page
        </div>
      </div>
    </div>
  </div>

  <div id="section_device_authorization" class="flex-section">
    <div class="flex-heading-container">
      <div class="flex-heading-item" style="background-color:#4dcfb2;">
        <div>Device Authorization</div>
        <div class="btn-show" onclick="show_section('section_device_authorization')">+ SHOW</div>
        <div class="btn-hide" onclick="hide_section('section_device_authorization')">- HIDE</div>
      </div>
    </div>
    <div class="flex-container" style="background-color:#4dcfb2;">

<!-- AUTHORIZE DEVICE -->
      <div class="flex-item">
        <button type="button" name="button" onclick="authorize_device();">Authorize Device</button>
        <div class="description">
          Grant internet access to a specific Wi-Fi connected device.
          <div class="description italic grey">
            You can also simulate a redirect on successful authorization in THIS browser.
          </div>
        </div>
        <div class="required"> = REQUIRED</div>
        <div class="form-item">
          <label for="authorize_device_mac">Device MAC<span class="required"></span></label> <input type="text" name="authorize_device_mac" id="authorize_device_mac" value="<?php echo $_SESSION['id']; ?>" placeholder="Required">
          <button type="button" name="btnSESSION_authorize_device_mac" onclick="document.getElementById('authorize_device_mac').value='<?php echo $_SESSION['id']; ?>';">⏱</button>
          <button type="button" name="btnRND_authorize_device_mac" onclick="document.getElementById('authorize_device_mac').value=generate_random_mac();">🎲</button>
        </div>
        <div class="form-item">
          <label for="authorize_device_ap_mac">AP MAC</label> <input type="text" name="authorize_device_ap_mac" id="authorize_device_ap_mac" value="<?php echo $_SESSION['ap']; ?>">
          <button type="button" name="btnSESSION_authorize_device_ap_mac" onclick="document.getElementById('authorize_device_ap_mac').value='<?php echo $_SESSION['ap']; ?>';">⏱</button>
          <button type="button" name="btnRND_authorize_device_ap_mac" onclick="document.getElementById('authorize_device_ap_mac').value=generate_random_mac();">🎲</button>
        </div>
        <hr>
        <div class="form-item">
          <label for="cbx_success" class="wide">Enable Success Page</label><input type="checkbox" name="cbx_success" id="cbx_success" value="success" onchange="set_state_success()" autocomplete="off">
        </div>
        <div class="form-item hidden" id="div_form-item_success">
          <div class="description">
            Simulate a redirect to a success landing page on successful authorization in THIS browser.
          </div>
          <br />
          <label for="success_url">Success URL</label> <input type="text" name="success_url" id="success_url" value="success.php">
          <button type="button" name="btnSESSION_success_url" onclick="document.getElementById('success_url').value='<?php echo $_SESSION['url']; ?>';">⏱</button>
          <button type="button" name="btnSYNCSPOT_success_url" onclick="document.getElementById('success_url').value='success.php'">SyncSpot</button>
          <button type="button" name="btnGOOGLE_success_url" onclick="document.getElementById('success_url').value='https://www.google.com/search?q=my+ip'">Google</button>
        </div>
        <hr>
        <div class="form-item">
          <label for="cbx_redirect" class="wide">Enable Redirect</label><input type="checkbox" name="cbx_redirect" id="cbx_redirect" value="redirect" onchange="set_state_redirect()" autocomplete="off">
        </div>
        <div class="form-item hidden" id="div_form-item_redirect">
          <div class="description">
            Simulate a redirect on successful authorization in THIS browser.
            <div class="description italic grey">
              If both "success page" AND "redirect page" are enabled, then success page will be shown first with a timer, followed by the redirect
            </div>
          </div>
          <br />
          <label for="redirect_url">Redirect URL</label> <input type="text" name="redirect_url" id="redirect_url" value="https://www.google.com/search?q=my+ip">
          <button type="button" name="btnSESSION_redirect_url" onclick="document.getElementById('redirect_url').value='<?php echo $_SESSION['url']; ?>';">⏱</button>
          <button type="button" name="btnGOOGLE_redirect_url" onclick="document.getElementById('redirect_url').value='https://www.google.com/search?q=my+ip'">Google</button>
        </div>
      </div>
<!-- RECONNECT DEVICE -->
      <div class="flex-item">
        <button type="button" name="button" onclick="reconnect_device();">Reconnect Device</button>
        <div class="description">
          Make AP drop device connection.
          <div class="description italic grey">
            Note: some devices won't indicate they are disconnected immediately.
          </div>
        </div>
        <div class="required"> = REQUIRED</div>
        <div class="form-item">
          <label for="reconnect_device_mac">Device MAC<span class="required"></span></label> <input type="text" name="reconnect_device_mac" id="reconnect_device_mac" value="<?php echo $_SESSION['id']; ?>" placeholder="Required">
          <button type="button" name="btnSESSION_reconnect_device_mac" onclick="document.getElementById('reconnect_device_mac').value='<?php echo $_SESSION['id']; ?>';">⏱</button>
          <button type="button" name="btnRND_reconnect_device_mac" onclick="document.getElementById('reconnect_device_mac').value=generate_random_mac();">🎲</button>
        </div>
      </div>
<!-- REVOKE DEVICE ACCESS -->
      <div class="flex-item">
        <button type="button" name="button" onclick="unauthorize_device();">Revoke Device Access</button>
        <div class="description">
          Make connected device lose internet authorization
          <div class="description italic grey">
            Note: Sometimes only happens after several seconds
          </div>
        </div>
        <div class="required"> = REQUIRED</div>
        <div class="form-item">
          <label for="unauthorize_device_mac">Device MAC<span class="required"></span></label> <input type="text" name="unauthorize_device_mac" id="unauthorize_device_mac" value="<?php echo $_SESSION['id']; ?>" placeholder="Required">
          <button type="button" name="btnSESSION_unauthorize_device_mac" onclick="document.getElementById('unauthorize_device_mac').value='<?php echo $_SESSION['id']; ?>';">⏱</button>
          <button type="button" name="btnRND_unauthorize_device_mac" onclick="document.getElementById('unauthorize_device_mac').value=generate_random_mac();">🎲</button>
        </div>
      </div>
<!-- LIST CLIENTS -->
      <div class="flex-item">
        <button type="button" name="button" onclick="list_clients();">List Connected Clients</button>
        <div class="description">
          List all online clients. You can filter by MAC address.
        </div>
        <div class="form-item">
          <label for="list_clients_mac">Device MAC</label> <input type="text" name="list_clients_mac" id="list_clients_mac" value="" placeholder="Optional">
          <button type="button" name="btnALL_list_clients_mac" onclick="document.getElementById('list_clients_mac').value='';">All</button>
          <button type="button" name="btnSESSION_list_clients_mac" onclick="document.getElementById('list_clients_mac').value='<?php echo $_SESSION['id']; ?>';">⏱</button>
        </div>
      </div>
<!-- LIST GUESTS  -->
      <div class="flex-item">
        <button type="button" name="button" onclick="list_guests();">List Authentications</button>
        <div class="description">
          List all past & present client authentications within the last "x" hours.
          <div class="grey italic">AKA "Guests" according to Unifi</div>
        </div>
        <div class="form-item">
          <label for="list_guests_within">Within the last</label> <input type="text" name="list_guests_within" id="list_guests_within" value="" placeholder="defaults to a week"> Hours
        </div>
      </div>
<!-- LIST USERS  -->
      <div class="flex-item">
        <button type="button" name="button" onclick="list_users();">List Known Clients</button>
        <div class="description">
          List all known client devices
        </div>
      </div>

    </div>
  </div>

  <div id="section_user_tests" class="flex-section hide-contents">
    <div class="flex-heading-container">
      <div class="flex-heading-item" style="background-color:#49cd73;">
        <div>User Tests</div>
        <div class="btn-show" onclick="show_section('section_user_tests')">+ SHOW</div>
        <div class="btn-hide" onclick="hide_section('section_user_tests')">- HIDE</div>
      </div>
    </div>
    <div class="flex-container" style="background-color:#49cd73;">
      TODO
    </div>
  </div>

  <div class="output" id="output_fetch_response">
    Response:
  </div>

  <div class="output" id="output_fetch_stacktrace">
    Stack Trace:
  </div>

  <div class="output" id="output_fetch_raw">
    Raw Response:
  </div>


  <h4>Debugging note:
    <br />With every interaction with the Unifi Controller at least 2 API requests are made:
    <br / > - The first API call "login" will establish a connection, proceeded by the specific request.
    <br /> - e.g. To authorize a device device, first "login" and then "authorize_device" is called.
  </h4>

  <script type="text/javascript">
window.debug_console_log = false;
<?php if ($config['debug_console_log']) { ?>
  window.debug_console_log = true;
  <?php } ?>

    var sync = {
      "redirect_enabled":false,
      "success_enabled":false
    }

    var controller_login = function() {
      fetch('tests/controller_login.php')
        .then(response => response.text())
        .then(data => display_output(data))
    };

    /* AUTHORIZATION */
    var authorize_device = function() {
      var device_mac = document.getElementById("authorize_device_mac").value;
      var ap_mac = document.getElementById("authorize_device_ap_mac").value;
      process_call('tests/authorize_device.php?mac=' + device_mac + "&ap=" + ap_mac)
        .then(()=>{ handle_success_and_redirect(); })
    };

    function handle_success_and_redirect(){
      var success_url = document.getElementById("success_url").value;
      var redirect_url = document.getElementById("redirect_url").value;

      if(sync.success_enabled && sync.redirect_enabled){
        window.location = success_url+'?redirect='+redirect_url;
        return;
      }
      if(sync.redirect_enabled){
        window.location = redirect_url;
        return;
      }
      if(sync.success_enabled){
        window.location = success_url;
        return;
      }
    }

    // var authorize_device_then_redirect = function() {
    //   var device_mac = document.getElementById("authorize_device_mac").value;
    //   var ap_mac = document.getElementById("authorize_device_ap_mac").value;
    //   var url = document.getElementById("redirect_url").value;
    //   fetch('tests/authorize_device.php?mac=' + device_mac + "&ap=" + ap_mac)
    //     .then(response => response.text())
    //     .then(data => display_output(data))
    //     .then(()=>{window.location = url;})
    // };
    // var authorize_device_then_success = function() {
    //   var device_mac = document.getElementById("authorize_device_mac").value;
    //   var ap_mac = document.getElementById("authorize_device_ap_mac").value;
    //   var success_url = document.getElementById("success_url").value;
    //   fetch('tests/authorize_device.php?mac=' + device_mac + "&ap=" + ap_mac)
    //     .then(response => response.text())
    //     .then(data => display_output(data))
    //     .then(()=>{window.location = success_url;})
    // };
    // var authorize_device_then_success_then_redirect = function() {
    //   var device_mac = document.getElementById("authorize_device_mac").value;
    //   var ap_mac = document.getElementById("authorize_device_ap_mac").value;
    //   var success_url = document.getElementById("success_url").value;
    //   var redirect_url = document.getElementById("redirect_url").value;
    //   process_call('tests/authorize_device.php?mac=' + device_mac + "&ap=" + ap_mac)
    //     .then(()=>{window.location = success_url+'?redirect='+redirect_url;})
    // };
    var unauthorize_device = function() {
      var device_mac = document.getElementById("unauthorize_device_mac").value;
      process_call('tests/unauthorize_device.php?mac=' + device_mac);
    };
    var reconnect_device = function() {
      var device_mac = document.getElementById("reconnect_device_mac").value;
      process_call('tests/reconnect_device.php?mac=' + device_mac);
    };



    /* LISTS */
    var list_device_authorizations = function() {
      //  var device_mac = document.getElementById("list_device_authorizations").value;
      var unix_start = Date.now() - 604800000;
      var unix_end = Date.now();

      process_call('tests/list_device_authorizations.php?start=' + unix_start + '&end=' + unix_end);
    };

    var list_clients = function(){
      var device_mac = document.getElementById("list_clients_mac").value;
      process_call('tests/list_clients.php?mac=' + device_mac);
    }

    var list_guests = function() {
      var list_guests_within = document.getElementById("list_guests_within").value;
      process_call('tests/list_guests.php?within=' + list_guests_within);
    };

    var list_users = function() {
      process_call('tests/list_users.php');
    };

    function process_call(url){
      return fetch(url)
        .then(response => response.text())
        .then(data => display_output(data))
    }

    function set_state_redirect(){
      var el = document.getElementById("div_form-item_redirect");
      var checkbox = document.getElementById("cbx_redirect");
      if(checkbox.checked){
        sync.redirect_enabled = true;
        el.classList.remove("hidden");
      } else {
        sync.redirect_enabled = false;
        el.classList.add("hidden");
      }
    }

    function set_state_success(){
      var el = document.getElementById("div_form-item_success");
      var checkbox = document.getElementById("cbx_success");
      if(checkbox.checked){
        sync.success_enabled = true;
        el.classList.remove("hidden");
      } else {
        sync.success_enabled = false;
        el.classList.add("hidden");
      }
    }

    function show_section(elementId){
      document.getElementById(elementId).classList.remove("hide-contents");
    }
    function hide_section(elementId){
      document.getElementById(elementId).classList.add("hide-contents");
    }

    function display_output(output) {
      try {
        output = JSON.parse(output);
      } catch (e) {

      }

      if(window.debug_console_log){
        console.log(output);
      }

      if(output.response == undefined){ // in case it is returned not as json
        document.getElementById("output_fetch_raw").innerHTML = "<span style='color:#00c000;'>Output (Raw):</span><br /><br />" + output;
        return;
      }

      document.getElementById("output_fetch_raw").innerHTML = "<span style='color:#00c000;'>Output (Raw):</span><br /><pre>" + JSON.stringify(output,null,2) + "</pre>";

      document.getElementById("output_fetch_response").innerHTML = "<span style='color:#00c000;'>Response:</span><br /><pre>" + JSON.stringify(output.response,null,2) + "</pre>";
      var stacktrace = "";
      for (var i = 0; i < output.stacktrace.length; i++) {
        stacktrace += "step "+ i + ":<br /><pre>" + JSON.stringify(output.stacktrace[i],null,2) + '</pre><br />';
      }
      document.getElementById("output_fetch_stacktrace").innerHTML = "<span style='color:#00c000;'>Stack Trace:</span><br /><br />" + stacktrace;
    }

    var generate_random_mac = function(){
      return "XX:XX:XX:XX:XX:XX".replace(/X/g, function() {
        return "0123456789ABCDEF".charAt(Math.floor(Math.random() * 16))
      });
    };

    var kill_session_and_reload = function(){
      fetch('kill_session.php')
        .then(setTimeout(function(){ window.location.reload(); }, 1000))
    };

    var reload = function (){
      window.location.reload();
    };

  </script>
</body>

</html>
