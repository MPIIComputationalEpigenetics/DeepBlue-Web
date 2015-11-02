<?php

/**
*   DeepBlue Epigenomic Data Server
*   Copyright (c) 2014 Max Planck Institute for Computer Science.
*   All rights reserved.
*
*   File : count_server_processing.php
*
*   Felipe Albrecht <felipe.albrecht@mpi-inf.mpg.de>
*   Obaro Odiete <s8obodie@stud.uni-saarland.de>
*
*   Created : 11-09-2015
*/

/* DeepBlue Configuration */
require_once("../../lib/lib.php");
require_once("../../lib/server_settings.php");
require_once("../../lib/deepblue.IXR_Library.php");
require_once("../../lib/error.php");


if (isset($_GET) && isset($_GET["request"])) {
    $request[] = $_GET["request"];
} else {
	return;
}

$client = new IXR_Client(get_server());

foreach ($request[0] as $vocab) {
	if(!$client->query("list_in_use", $vocab, $user_key)){
		die('An error occurred - '.$client->getErrorCode().":".$client->getErrorMessage());
	}
	$response = $client->getResponse();
    check_error($response);

    $counts[] = count($response[1]);
}
echo json_encode($counts);
?>