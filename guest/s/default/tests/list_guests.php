<?php
header('Content-Type: application/json');
require_once '../UnifiHelper.php';
include '../config.php';

$within = 7860;
if (isset($_GET['within']) && $_GET['within']) {
    $within = $_GET['within'];
}

$SyncUnifiHelper = new SyncSpot\UnifiHelper($config);
$response = $SyncUnifiHelper->list_guests($within);

echo json_encode($response);
