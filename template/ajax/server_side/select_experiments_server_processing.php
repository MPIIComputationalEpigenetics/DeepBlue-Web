<?php

/**
*   DeepBlue Epigenomic Data Server
*   Copyright (c) 2014 Max Planck Institute for Computer Science.
*   All rights reserved.
*
*   File : select_experiments_server_processing.php
*
*   Felipe Albrecht <felipe.albrecht@mpi-inf.mpg.de>
*	Obaro Odiete <s8obodie@stud.uni-saarland.de>
*
*   Created : 22-05-2015
*/

ini_set('memory_limit', '-1');
ini_set('max_execution_time', 300); //300 seconds = 5 minutes

/* DeepBlue Configuration */
require_once("../../lib/lib.php");
require_once("../../lib/error.php");
require_once("../../lib/server_settings.php");

/* include IXR Library for RPC-XML */
require_once("../../lib/deepblue.IXR_Library.php");
$client = new IXR_Client(get_server());

if (!isset($_GET["experiments_ids"])) {
    return;
}
$experiments_ids = $_GET["experiments_ids"];

if (!isset($_GET["chromosome"])) {
    $chromosome = [];
}
else {
    $chromosome = $_GET["chromosome"];
}

$start = 0;
if (isset($_GET["start"])) {
    $start = $_GET["start"];
    if (!is_numeric($start)) {
        $start = 0;
    }
}
$start = (int)$start;

$end = PHP_INT_MAX;
if (isset($_GET["end"])) {
    $end = $_GET["end"];
    if (!is_numeric($end)) {
        $end = PHP_INT_MAX;
    }
}
$end = (int)$end;

if (!$client->query("select_experiments", $experiments_ids, $chromosome, $start, $end, $user_key)) {
    die('An error occurred - '.$client->getErrorCode().":".$client->getErrorMessage());
}

$result = $client->getResponse();
check_error($result);

$query_id = $result[1];
echo json_encode(array('query_id' => $query_id));