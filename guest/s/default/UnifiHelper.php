<?php
namespace SyncSpot;

require __DIR__ . '/vendor/autoload.php';
// require __DIR__ . '/vendor/art-of-wifi/unifi-api-client/src/Client.php';
session_start();

/**
 *
 */
class UnifiHelper
{
    private $unifi_connection;
    private $config_controller;
    private $config_helper;
    private $debug;

    public function __construct($config)
    {
        $this->config_controller = $config['unifi-api']['controller'];
        $this->config_helper = $config['sync']['unifi-helper'];
        $this->debug = $this->config_helper['debug'];

        // if "dev_mode" == false, turn off all debug messages:
        if (!$config['dev_mode']) {
            $this->debug = false;
            $this->config_controller['debug'] = false;
        }

        $this->unifi_connection = new \UniFi_API\Client($this->config_controller['username'], $this->config_controller['password'], $this->config_controller['url'], $this->config_controller['site_id'], $this->config_controller['version']);
        $this->unifi_connection->set_debug($this->config_controller['debug']);
    }

    public function login()
    {
        if ($this->debug) {
            echo '--- debug ---  UnifiHelper initialised<br />';
            echo '--- debug ---  UnifiHelper unifi_connection->login()<br />';
            echo "<pre>";

            $loginresults     = $this->unifi_connection->login();

            print_r($loginresults);
            echo "</pre>";
            echo '<br /><br />';
        } else {
            // suppress warnings
            $loginresults = @$this->unifi_connection->login();
            return $loginresults;
        }
    }

    public function list_sessions()
    {
        $result = $this->unifi_connection->list_guests();
        if ($this->debug) {
            echo '--- debug UnifiHelper->list_sessions(): --- <br />';
            echo "<pre>";
            print_r($result);
            echo "</pre>";
            echo '<br /><br />';
        }
    }

    public function authorize_guest($mac, $ap)
    {
        $this->login();
        if ($this->debug) {
            echo '--- debug ---  UnifiHelper initialised<br />';
            echo '--- debug ---  UnifiHelper unifi_connection->authorize_guest($mac="'.$mac.'",$ap="'.$ap.'")<br />';
            echo "<pre>";

            $result = $this->unifi_connection->authorize_guest($mac, $this->config_controller['duration'], $up = null, $down = null, $MBytes = null, $ap);

            print_r($result);
            echo "</pre>";
            echo '<br /><br />';
        } else {
            // suppress warnings
            $result = @$this->unifi_connection->authorize_guest($mac, $this->config_controller['duration'], $up = null, $down = null, $MBytes = null, $ap);
            return $result;
        }
    }

    public function unauthorize_guest($mac)
    {
        $this->login();
        if ($this->debug) {
            echo '--- debug ---  UnifiHelper initialised<br />';
            echo '--- debug ---  UnifiHelper unifi_connection->unauthorize_guest($mac="'.$mac.'")<br />';
            echo "<pre>";

            $result = $this->unifi_connection->unauthorize_guest($mac);

            print_r($result);
            echo "</pre>";
            echo '<br /><br />';
        } else {
            // suppress warnings
            $result = @$this->unifi_connection->unauthorize_guest($mac);
            return $result;
        }
    }

    public function reconnect_guest($mac)
    {
        if ($this->debug) {
            echo '--- debug ---  UnifiHelper initialised<br />';
            echo '--- debug ---  UnifiHelper unifi_connection->reconnect_sta($mac="'.$mac.'")<br />';
            echo "<pre>";

            $result = $this->unifi_connection->reconnect_sta($mac);

            print_r($result);
            echo "</pre>";
            echo '<br /><br />';
        } else {
            // suppress warnings
            $result = @$this->unifi_connection->reconnect_sta();
            return $result;
        }
    }

    public function list_clients()
    {
        $result = $this->unifi_connection->list_clients();
        echo('list_clients(): ');
        echo('<br />');
        echo "<pre>";

        print_r($result);
        echo "</pre>";
    }
}


/*
$unifi_connection =

$set_debug_mode   = $unifi_connection->set_debug($controller['debug']);
$loginresults     = $unifi_connection->login();




list_sessions();
*/
//User will be authorized at this point; their name and email address can be saved to some database now
