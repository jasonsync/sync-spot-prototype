<?php
header('Content-Type: application/json');
require_once '../UnifiHelper.php';
include '../config.php';

if (!isset($_GET['mac'])) {
    die('"mac" get parameter not set');
}

$SyncUnifiHelper = new SyncSpot\UnifiHelper($config);
$response = $SyncUnifiHelper->unauthorize_device($_GET['mac']);

echo json_encode($response);
