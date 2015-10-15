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
require_once("../../lib/server_settings.php");

/* include IXR Library for RPC-XML */
require_once("../../lib/deepblue.IXR_Library.php");
$client = new IXR_Client(get_server());

if (!isset($_GET["experiments_ids"])) {
    return;
}

if (!isset($_GET["columns"])) {
    $format = 'CHROMOSOME,START,END';
}
else {
    $format = $_GET['columns'];
}

if (!isset($_GET["annotation_names"])) {
    $annotation_names = [];
}
else {
    $annotation_names = $_GET["annotation_names"];
}

if (!isset($_GET["chromosome"])) {
    $chromosome = [];
}
else {
    $chromosome = $_GET["chromosome"];
}

$experiments_ids = $_GET["experiments_ids"];
$genome = "";
$allgenomes = $_GET["allgenomes"];
$epigenetic_mark = "";
$sample_id = "";
$technique = "";
$project = "";

$start = $_GET["start"];
if (!is_numeric($start)) {
    $start = 0;
}
$start = (int)$start;

$end = $_GET["end"];
if (!is_numeric($end)) {
    $end = PHP_INT_MAX;
}
$end = (int)$end;

if (!$client->query("select_regions", $experiments_ids, $genome, $epigenetic_mark, $sample_id, $technique, $project,
    $chromosome, $start, $end, $user_key)) {
    die('An error occurred - '.$client->getErrorCode().":".$client->getErrorMessage());
}

$result[] = $client->getResponse();
if ($result[0][0] == "error") {
    echo json_encode($result[0]);
    die();
}

$query_ida = $result[0][1];
$query_id = $query_ida;

$result = [];
$annlen = count($annotation_names);

if ($annlen > 0) {
    // select annotations
    if (!$client->query("select_annotations", $annotation_names, $allgenomes, $chromosome, $start, $end, $user_key)) {
        die('An error occurred - '.$client->getErrorCode().":".$client->getErrorMessage());
    }

    $result[] = $client->getResponse();
    if ($result[0][0] == "error") {
        echo json_encode($result[0]);
        die();
    }

    $query_idb = $result[0][1];
    $result = [];

    if (!$client->query("intersection", $query_ida, $query_idb, $user_key)) {
        die('An error occurred - '.$client->getErrorCode().":".$client->getErrorMessage());
    }

    $result[] = $client->getResponse();
    if ($result[0][0] == "error") {
        echo json_encode($result[0]);
        die();
    }
    $query_id = $result[0][1];
    $result = [];
}

if (!$client->query("get_regions", $query_id, $format, $user_key)) {
    die('An error occurred - '.$client->getErrorCode().":".$client->getErrorMessage());
}

$result[] = $client->getResponse();
if ($result[0][0] == "error") {
    echo json_encode($result[0]);
    die();
}
$request_id = $result[0][1];

echo json_encode(array('request_id' => $request_id));