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

session_start();

/* DeepBlue Configuration */
require_once("../../lib/server_settings.php");
require_once("../../lib/error.php");
require_once("../../lib/process_requests.php");

/* include IXR Library for RPC-XML */
require_once("../../lib/deepblue.IXR_Library.php");
$client = new IXR_Client(get_server());

$request_user_key = $_SESSION['key'];

if (isset($_GET["_id"])) {
    $request_id = $_GET["_id"];

    $cache_chromosomes = array();
   	$cache_queries = array();

	$request_info = build_request_info($request_id, $request_user_key);
    echo json_encode($request_info);
}