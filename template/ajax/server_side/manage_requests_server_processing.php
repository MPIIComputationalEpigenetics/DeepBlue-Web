<?php

/**
*   DeepBlue Epigenomic Data Server
*   Copyright (c) 2014 Max Planck Institute for Computer Science.
*   All rights reserved.
*
*   File : manage_requests_server_processing.php
*
*   Felipe Albrecht <felipe.albrecht@mpi-inf.mpg.de>
*	Obaro Odiete <s8obodie@stud.uni-saarland.de>
*
*   Created : 05-01-2015
*/

ini_set('memory_limit', '-1');
ini_set('max_execution_time', 300); //300 seconds = 5 minutes

/* DeepBlue Configuration */
require_once("../../lib/lib.php");
require_once("../../lib/server_settings.php");
require_once("../../lib/error.php");
require_once("../../lib/process_requests.php");

/* include IXR Library for RPC-XML */
require_once("../../lib/deepblue.IXR_Library.php");
$client = new IXR_Client(get_server());

/* list all request for the request manager*/
$request_state = '';
if (isset($_GET["filter"])) {
	$request_state = $_GET["filter"];
}

$request_scope = 'user';
if (isset($_GET["scope"])) {
	$request_scope = $_GET["scope"];
}

$local_requests = [];
if (isset($_GET["local_requests"])) {
	$local_requests = $_GET["local_requests"];
}

if ($request_scope == 'user') {
	if (!$client->query("list_requests", $request_state, $user_key)) {
		die('An error occurred - ' . $client->getErrorCode() . ":" . $client->getErrorMessage());
	}

	$response = $client->getResponse();
	check_error($response);

	$user_requests = $response[1];
}
else {
	$user_requests = $local_requests;
}

$requests_ids = array();

foreach ($user_requests as $user_request) {
	$requests_ids[] = $user_request[0];
}

$request_table = build_request_info($requests_ids, $user_key);
echo json_encode(array('data' => $request_table));