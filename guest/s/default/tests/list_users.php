<?php
header('Content-Type: application/json');
require_once '../UnifiHelper.php';
include '../config.php';


$SyncUnifiHelper = new SyncSpot\UnifiHelper($config);
$response = $SyncUnifiHelper->list_users();

echo json_encode($response);
