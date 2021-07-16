<?php
require_once '../UnifiHelper.php';
include '../config.php';
header('Content-Type: application/json');

$SyncUnifiHelper = new SyncSpot\UnifiHelper($config);
$response = $SyncUnifiHelper->login();
echo ($response);
