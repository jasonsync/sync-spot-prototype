<?php
header('Content-Type: application/json');
require_once '../UnifiHelper.php';
include '../config.php';

$mac = null;
if (isset($_GET['mac'])) {
    $mac = $_GET['mac'];
}

$SyncUnifiHelper = new SyncSpot\UnifiHelper($config);
$response = $SyncUnifiHelper->list_clients($mac);

echo json_encode($response);
