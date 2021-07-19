<?php
require_once '../UnifiHelper.php';
include '../config.php';

$SyncUnifiHelper = new SyncSpot\UnifiHelper($config);
$response = $SyncUnifiHelper->list_guests();
echo ($response);
