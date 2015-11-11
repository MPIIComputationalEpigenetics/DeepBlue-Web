<?php

/**
*   DeepBlue Epigenomic Data Server
*   Copyright (c) 2014 Max Planck Institute for Computer Science.
*   All rights reserved.
*
*   File : remove_server_processing.php
*
*   Felipe Albrecht <felipe.albrecht@mpi-inf.mpg.de>
*   Obaro Odiete <s8obodie@stud.uni-saarland.de>
*
*   Created : 08-09-2015
*/

/* DeepBlue Configuration */
require_once("../../lib/lib.php");
require_once("../../lib/error.php");
require_once("../../lib/deepblue.IXR_Library.php");
require_once("../../lib/server_settings.php");

if (isset($_GET) && isset($_GET["id"])) {
    $id = $_GET["id"];

	$client = new IXR_Client(get_server());
	if(!$client->query("remove", $id, $user_key)){
		die('An error occurred - '.$client->getErrorCode().":".$client->getErrorMessage());
	}

	$response = $client->getResponse();
	check_error($response);

	echo json_encode(['data' => $response[1]]);
}