<?php

function url_params()
{
    global $config;
    $url_params = "";
    $url_params .= "?v=" . $config['version'];
    $url_params .= "&t=".time();
    echo $url_params;
}
