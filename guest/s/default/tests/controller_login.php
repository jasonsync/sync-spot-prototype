<?php
require_once '../UnifiHelper.php';
include '../config.php';
$SyncUnifiHelper = new SyncSpot\UnifiHelper($config);
$response = $SyncUnifiHelper->login();

header('Content-Type: application/json');
echo json_encode($response);
