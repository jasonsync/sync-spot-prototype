<?php
require_once '../UnifiHelper.php';
include '../config.php';

if (!isset($_GET['mac'])) {
    die('"mac" get parameter not set');
}
$mac = $_GET['mac'];
if (!isset($_GET['ap'])) {
    $ap = null;
} else {
    $ap = $_GET['ap'];
}

$SyncUnifiHelper = new SyncSpot\UnifiHelper($config);
$response = $SyncUnifiHelper->authorize_device($mac, $ap);

header('Content-Type: application/json');
echo json_encode($response);
