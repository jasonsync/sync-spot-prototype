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

    private $stacktrace_enabled;
    private $stacktrace;
    private $laststacktime;

    public function __construct($config)
    {
        $this->config_controller = $config['unifi-api']['controller'];
        $this->stacktrace_enabled = $config['stacktrace_enabled'];
        $this->laststacktime = false;
        $this->unifi_connection = new \UniFi_API\Client($this->config_controller['username'], $this->config_controller['password'], $this->config_controller['url'], $this->config_controller['site_id'], $this->config_controller['version']);
        $this->unifi_connection->set_debug($this->config_controller['debug']);
    }
    /**
     * [stacktrace builds stacktrace for debugging purposes]
     * @param  String $step          What step in the trace, e.g. "call", "response", "...". Optional
     * @param  String $callee_fn_name Record of callee function. Required
     * @param  Array $arguments       function arguments. Optional
     * @param  Array $response        function's response. Optional
     * @return Void
     */
    private function stacktrace($step = 'call', $callee_fn_name, $arguments=null, $response = null)
    {
        /* if stacktrace is enabled, add this function call and response to the stacktrace */
        if ($this->stacktrace_enabled == true) {
            $trace = [];
            $trace['step'] = $step;
            $trace['method'] = $callee_fn_name;
            $trace['arguments'] = $arguments;
            $trace['response'] = $response;
            $trace['ns_since_last_trace'] = 0;

            $this_trace_time = hrtime(true);
            if ($this->laststacktime) {
                $trace['ns_since_last_trace'] = $this_trace_time-$this->laststacktime;
            }
            $this->laststacktime = $this_trace_time;
            $this->stacktrace[] = $trace;
        }
    }

    /**
     * [handle_response returns response with stacktrace]
     * @param  String $callee_fn_name Name of initiator function / method
     * @param  Array $response       response
     * @return Array                 Array containing stacktrace Array and response
     */
    private function handle_response($callee_fn_name, $response)
    {
        $return = [];
        /* if stacktrace is enabled, add this function call to the stacktrace*/
        if ($this->stacktrace_enabled == true) {
            $return['stacktrace'] = $this->stacktrace;
        }
        $return['response'] = $response;
        return $return;
    }

    public function login()
    {
        $this->stacktrace('call', __FUNCTION__, null, null); // continue stack trace
        $response = $this->unifi_connection->login();  // call API and get response
        $return =  $this->handle_response(__FUNCTION__, $response);  // make return variable consisting of current stack trace + response
        $this->stacktrace('response', __FUNCTION__, null, $response);  // continue stack trace (this is only necessary if we are calling this function from within another parent function)
        return $return;
    }

    //stat_sta_sessions_latest

    public function authorize_device($mac, $ap)
    {
        // login is needed
        $this->login();

        // continue stack trace
        $this->stacktrace('call', __FUNCTION__, array('$mac'=>$mac,'$ap'=>$ap), null);

        // call API and get response
        $response = $this->unifi_connection->authorize_guest($mac, $this->config_controller['duration'], $up = null, $down = null, $MBytes = null, $ap);

        // make return variable consisting of current stack trace + response
        $return =  $this->handle_response(__FUNCTION__, $response);

        // continue stack trace (this is only necessary if we are calling this function from within another parent function)
        $this->stacktrace('response', __FUNCTION__, array('$mac'=>$mac,'$ap'=>$ap), $response);

        // return variable consisting of current stack trace + response
        return $return;
    }

    public function unauthorize_device($mac)
    {
        // login is needed
        $this->login();

        // continue stack trace
        $this->stacktrace('call', __FUNCTION__, array('$mac'=>$mac), null);

        // call API and get response
        $response = $this->unifi_connection->unauthorize_guest($mac);

        // make return variable consisting of current stack trace + response
        $return =  $this->handle_response(__FUNCTION__, $response);

        // continue stack trace (this is only necessary if we are calling this function from within another parent function)
        $this->stacktrace('response', __FUNCTION__, array('$mac'=>$mac), $response);

        // return variable consisting of current stack trace + response
        return $return;
    }

    public function reconnect_device($mac)
    {
        // login is needed
        $this->login();

        // continue stack trace
        $this->stacktrace('call', __FUNCTION__, array('$mac'=>$mac), null);

        // call API and get response
        $response = $this->unifi_connection->reconnect_sta($mac);

        // make return variable consisting of current stack trace + response
        $return =  $this->handle_response(__FUNCTION__, $response);

        // continue stack trace (this is only necessary if we are calling this function from within another parent function)
        $this->stacktrace('response', __FUNCTION__, array('$mac'=>$mac), $response);

        // return variable consisting of current stack trace + response
        return $return;
    }

    // lists sessions
    public function list_guests($within)
    {
        // login is needed
        $this->login();

        // continue stack trace
        $this->stacktrace('call', __FUNCTION__, array('$within'=>$within), null);

        // call API and get response
        $response = $this->unifi_connection->list_guests($within);

        // make return variable consisting of current stack trace + response
        $return =  $this->handle_response(__FUNCTION__, $response);

        // continue stack trace (this is only necessary if we are calling this function from within another parent function)
        $this->stacktrace('response', __FUNCTION__, array('$within'=>$within), $response);

        // return variable consisting of current stack trace + response
        return $return;
    }

    public function list_clients($mac = null)
    {

        // login is needed
        $this->login();

        // continue stack trace
        $this->stacktrace('call', __FUNCTION__, array('$mac'=>$mac), null);

        // call API and get response
        $response = $this->unifi_connection->list_clients($mac);

        // make return variable consisting of current stack trace + response
        $return =  $this->handle_response(__FUNCTION__, $response);

        // continue stack trace (this is only necessary if we are calling this function from within another parent function)
        $this->stacktrace('response', __FUNCTION__, array('$mac'=>$mac), $response);

        // return variable consisting of current stack trace + response
        return $return;
    }

    public function list_users()
    {
        // login is needed
        $this->login();

        // continue stack trace
        $this->stacktrace('call', __FUNCTION__, null, null);

        // call API and get response
        $response = $this->unifi_connection->list_users();

        // make return variable consisting of current stack trace + response
        $return =  $this->handle_response(__FUNCTION__, $response);

        // continue stack trace (this is only necessary if we are calling this function from within another parent function)
        $this->stacktrace('response', __FUNCTION__, null, $response);

        // return variable consisting of current stack trace + response
        return $return;
    }


}


/*
$unifi_connection =

$set_debug_mode   = $unifi_connection->set_debug($controller['debug']);
$loginresults     = $unifi_connection->login();




list_sessions();
*/
//User will be authorized at this point; their name and email address can be saved to some database now
