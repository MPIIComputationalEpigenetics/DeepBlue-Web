<?php

/**
*   DeepBlue Epigenomic Data Server
*   Copyright (c) 2016 Max Planck Institute for Computer Science.
*   All rights reserved.
*
*   File : create_expeirment_set.php
*
*   Felipe Albrecht <felipe.albrecht@mpi-inf.mpg.de>
*
*   Created : 09-09-2016
*/

ini_set('memory_limit', '-1');
ini_set('max_execution_time', 300); //300 seconds = 5 minutes

session_start();

/* DeepBlue Configuration */
require_once("../../lib/server_settings.php");
require_once("../../lib/error.php");

/* include IXR Library for RPC-XML */
require_once("../../lib/deepblue.IXR_Library.php");
$client = new IXR_Client(get_server());

$user_key = $_SESSION['user_key'];

$set_name = "";
$description = "";
$experiment_names = "";

if (isset($_POST["set_name"])) {
    $set_name = $_POST["set_name"];
}

if (isset($_POST["description"])) {
    $description = $_POST["description"];
}

if (isset($_POST["experiment_names"])) {
    $experiment_names = $_POST["experiment_names"];
}

$client = new IXR_Client(get_server());

if(!$client->query("create_experiments_set", $set_name, $description, TRUE, $experiment_names, $user_key)){
		die('An error occurred - '.$client->getErrorCode().":".$client->getErrorMessage());
}

$requests_response = $client->getResponse();
check_error($requests_response);
echo json_encode($requests_response);