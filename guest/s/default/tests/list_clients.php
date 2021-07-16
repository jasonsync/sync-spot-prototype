<?php
require_once '../UnifiHelper.php';
include '../config.php';

$SyncUnifiHelper = new SyncSpot\UnifiHelper($config);
$SyncUnifiHelper->list_clients();
// $SyncUnifiHelper->
