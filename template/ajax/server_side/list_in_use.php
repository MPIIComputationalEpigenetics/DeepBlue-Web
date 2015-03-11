<?php

/**
*   DeepBlue Epigenomic Data Server
*   Copyright (c) 2014 Max Planck Institute for Computer Science.
*   All rights reserved.
*
*   File : list_in_use.php
*
*   Felipe Albrecht <felipe.albrecht@mpi-inf.mpg.de>
*   Obaro Odiete <s8obodie@stud.uni-saarland.de>
*
*   Created : 08-02-2015
*/

/* DeepBlue Configuration */
require_once("../../lib/lib.php");
require_once("../../lib/deepblue.IXR_Library.php");

if (isset($_GET) && isset($_GET["request"])) {
    $request[] = $_GET["request"];
} else {
	return;
}

$client = new IXR_Client($url);

foreach ($request[0] as $vocab) {
	if(!$client->query("list_in_use", $vocab, $user_key)){
		die('An error occurred - '.$client->getErrorCode().":".$client->getErrorMessage());
	}
	$response = $client->getResponse();
	
	usort($response[1], function($a, $b) {
		return strcasecmp($a[1], $b[1]);
	});
	
	$listInUse[$vocab] = $response[1];
}
echo json_encode(array($listInUse));
?>