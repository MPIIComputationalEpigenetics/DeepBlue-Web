<?php

/**
*   DeepBlue Epigenomic Data Server
*   Copyright (c) 2014 Max Planck Institute for Computer Science.
*   All rights reserved.
*
*   File : get_request_data_server_processing.php
*
*   Felipe Albrecht <felipe.albrecht@mpi-inf.mpg.de>
*   Obaro Odiete <s8obodie@stud.uni-saarland.de>
*
*   Created : 11-09-2015
*/

session_start();

/* DeepBlue Configuration */
require_once("../../lib/server_settings.php");
require_once("../../lib/deepblue.IXR_Library.php");
require_once("../../lib/error.php");

if (isset($_GET["_id"])) {
    $rid = $_GET["_id"];
} else {
	echo json_encode(['error', 'RequestId not specified']);
	return;
}

if (isset($_SESSION['user_key'])) {
	$request_user_key = $_SESSION['user_key'];
}
else {
	$request_user_key = $_SESSION['key'];
}

$client = new IXR_Client(get_server());

if(!$client->query("get_request_data", $rid, $request_user_key)){
	die('An error occurred - '.$client->getErrorCode().":".$client->getErrorMessage());
}
$response = $client->getResponse();
check_error($response);

echo json_encode($response);
?>