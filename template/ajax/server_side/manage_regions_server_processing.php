<?php

/**
*   DeepBlue Epigenomic Data Server
*   Copyright (c) 2014 Max Planck Institute for Computer Science.
*   All rights reserved.
*
*   File : manage_regions_server_processing.php
*
*   Felipe Albrecht <felipe.albrecht@mpi-inf.mpg.de>
*	Obaro Odiete <s8obodie@stud.uni-saarland.de>
*
*   Created : 10-15-2015
*/

/* manage region requests including, selecting regions, selecting annotations intersection and get_regions	*/

ini_set('memory_limit', '-1');
ini_set('max_execution_time', 300); //300 seconds = 5 minutes

/* DeepBlue Configuration */
require_once("../../lib/lib.php");
require_once("../../lib/error.php");
require_once("../../lib/server_settings.php");

/* include IXR Library for RPC-XML */
require_once("../../lib/deepblue.IXR_Library.php");
$client = new IXR_Client(get_server());

if (!isset($_POST["experiments_ids"])) {
    return;
}

if (!isset($_POST["columns"])) {
    $format = 'CHROMOSOME,START,END';
}
else {
    $format = $_POST['columns'];
}

if (!isset($_POST["annotation_names"])) {
    $annotation_names = [];
}
else {
    $annotation_names = $_POST["annotation_names"];
}

if (!isset($_POST["chromosome"])) {
    $chromosome = [];
}
else {
    $chromosome = $_POST["chromosome"];
}

$experiments_ids = $_POST["experiments_ids"];
$genome = "";
$allgenomes = $_POST["allgenomes"];
$epigenetic_mark = "";
$sample_id = "";
$technique = "";
$project = "";

$start = $_POST["start"];
if (!is_numeric($start)) {
    $start = 0;
}
$start = (int)$start;

$end = $_POST["end"];
if (!is_numeric($end)) {
    $end = PHP_INT_MAX;
}
$end = (int)$end;

if (!$client->query("select_regions", $experiments_ids, $genome, $epigenetic_mark, $sample_id, $technique, $project,
    $chromosome, $start, $end, $user_key)) {
    die('An error occurred - '.$client->getErrorCode().":".$client->getErrorMessage());
}

$result = $client->getResponse();
check_error($result);

$query_ida = $result[1];
$query_id = $query_ida;

$annlen = count($annotation_names);

if ($annlen > 0) {
    if (count($allgenomes) > 1) {
        die("Please, when filtering by annotation select all experiments data sets from one genome.");
    }

    if (count($allgenomes) == 0) {
        die("Please, inform at least one genome.");
    }

    // select annotations
    if (!$client->query("select_annotations", $annotation_names, $allgenomes[0], $chromosome, $start, $end, $user_key)) {
        die('An error occurred - '.$client->getErrorCode().":".$client->getErrorMessage());
    }

    $result = $client->getResponse();
    check_error($result);

    $query_idb = $result[1];

    if (!$client->query("intersection", $query_ida, $query_idb, $user_key)) {
        die('An error occurred - '.$client->getErrorCode().":".$client->getErrorMessage());
    }

    $result = $client->getResponse();
    check_error($result);

    $query_id = $result[1];
}

if (!$client->query("get_regions", $query_id, $format, $user_key)) {
    die('An error occurred - '.$client->getErrorCode().":".$client->getErrorMessage());
}

$result = $client->getResponse();
check_error($result);

$request_id = $result[1];

echo json_encode(array('request_id' => $request_id));