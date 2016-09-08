<?php

/**
*   DeepBlue Epigenomic Data Server
*   Copyright (c) 2016 Max Planck Institute for Computer Science.
*   All rights reserved.
*
*   File : expeirment_set_info.php
*
*   Felipe Albrecht <felipe.albrecht@mpi-inf.mpg.de>
*
*   Created : 08-09-2016
*/

ini_set('memory_limit', '-1');
ini_set('max_execution_time', 300); //300 seconds = 5 minutes

session_start();

/* DeepBlue Configuration */
require_once("../../lib/server_settings.php");
require_once("../../lib/error.php");
require_once("../../lib/process_requests.php");

/* include IXR Library for RPC-XML */
require_once("../../lib/deepblue.IXR_Library.php");
$client = new IXR_Client(get_server());

$user_key = $_SESSION['user_key'];

if (isset($_GET["_id"])) {
    $experiment_set_id = $_GET["_id"];

    $cache_chromosomes = array();
   	$cache_queries = array();


	$client = new IXR_Client(get_server());

	$cache_chromosomes = array();
	$cache_queries = array();

	if(!$client->query("info", $experiment_set_id, $user_key)){
		die('An error occurred - '.$client->getErrorCode().":".$client->getErrorMessage());
	}
	$requests_response = $client->getResponse();
	check_error($requests_response);
	$response = $requests_response[1];
    echo json_encode($response);
}