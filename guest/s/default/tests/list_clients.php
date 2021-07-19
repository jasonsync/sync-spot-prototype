<?php
require_once '../UnifiHelper.php';
include '../config.php';

$mac = null;
if (isset($_GET['mac'])) {
    $mac = $_GET['mac'];
}

$SyncUnifiHelper = new SyncSpot\UnifiHelper($config);
$response = $SyncUnifiHelper->list_clients($mac);
print_r ($response);
