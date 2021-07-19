<?php
require_once '../UnifiHelper.php';
include '../config.php';
header('Content-Type: application/json');

if (!isset($_GET['mac'])) {
    die('"mac" get parameter not set');
}

$SyncUnifiHelper = new SyncSpot\UnifiHelper($config);
$response = $SyncUnifiHelper->unauthorize_device($_GET['mac']);

echo($response);
