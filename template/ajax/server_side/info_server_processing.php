<?php

/**
*   DeepBlue Epigenomic Data Server
*   Copyright (c) 2014 Max Planck Institute for Computer Science.
*   All rights reserved.
*
*   File : info_server_processing.php
*
*   Felipe Albrecht <felipe.albrecht@mpi-inf.mpg.de>
*   Obaro Odiete <s8obodie@stud.uni-saarland.de>
*
*   Created : 08-08-2015
*/

/* DeepBlue Configuration */
require_once("../../lib/lib.php");
require_once("../../lib/server_settings.php");
require_once("../../lib/deepblue.IXR_Library.php");

$client = new IXR_Client(get_server());

/* DeepBlue Class */
require_once("../../lib/deepblue.functions.php");
$deepBlueObj = new Deepblue();

if (isset($_GET) && isset($_GET["id"])) {
    $id = $_GET["id"];

    $client = new IXR_Client(get_server());
	if(!$client->query("info", $id, $user_key)){
		die('An error occurred - '.$client->getErrorCode().":".$client->getErrorMessage());
	}

	$response = $client->getResponse();

	if ($response[0] == 'error') {
		echo json_encode(['data' => $response]);
        die();
	}

	$deepBlueObj->searchResultToJson($response[1]);
}