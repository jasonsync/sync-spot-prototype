<?php

require __DIR__ . '/vendor/autoload.php';
require_once 'SyncSpotAPIHelper.php';
 include 'config.php';
 if (!isset($_SESSION)) {
     session_start();
 }

$SyncSpotAPIHelper = new \SyncSpot\SyncSpotAPIHelper();

function attempt_auto_login()
{
    global $config;
    $mac = $_SESSION["id"]; // Unifi Guest Device MAC Address
    $ap = $_SESSION["ap"]; // Unifi Authenticating Access Point
    $url = $_SESSION["url"]; // Unifi Intercepted guest requested URL


    // 1. look in SyncSpot.devices if device has active package (get user_devices_packages combination from database)
    // 1.1 - ... If device has active package: update PHP session vars and do network authentication (RADIUS/Unifi)
    // not logged in, check for user_id...

    //



    $unifi_connection = new UniFi_API\Client($config['unifi-api']['controller']['username'], $config['unifi-api']['controller']['password'], $config['unifi-api']['controller']['url'], $config['unifi-api']['controller']['site_id'], $config['unifi-api']['controller']['version']);
    $set_debug_mode   = $unifi_connection->set_debug($config['unifi-api']['controller']['debug']);
    $loginresults     = $unifi_connection->login();

    // TODO: implement bandwidth control
    $duration = 15;//null;
    $auth_result = $unifi_connection->authorize_guest($mac, $duration, $up = null, $down = null, $MBytes = null, $ap);

    return($auth_result);
    //User will be authorized at this point; their name and email address can be saved to some database now
}
