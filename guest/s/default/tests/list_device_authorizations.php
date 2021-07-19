<?php
require_once '../UnifiHelper.php';
include '../config.php';
header('Content-Type: application/json');

$start = null;
$end = null;

if (isset($_GET['start'])) {
    $start = $_GET['start'];
}
if (isset($_GET['end'])) {
    $end = $_GET['end'];
}

$SyncUnifiHelper = new SyncSpot\UnifiHelper($config);
$response = $SyncUnifiHelper->list_device_authorizations($start, $end);
print_r($response);
