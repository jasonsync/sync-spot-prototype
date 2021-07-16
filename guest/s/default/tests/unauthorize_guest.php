<?php
require_once '../UnifiHelper.php';
include '../config.php';
header('Content-Type: application/json');

if (!isset($_GET['mac'])) {
    die('"mac" get parameter not set');
}

$SyncUnifiHelper = new SyncSpot\UnifiHelper($config);
$response = $SyncUnifiHelper->unauthorize_guest("b4:1a:1d:a4:8e:28");

echo($response);
