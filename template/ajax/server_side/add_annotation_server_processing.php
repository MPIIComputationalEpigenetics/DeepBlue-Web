<?php

/**
*   DeepBlue Epigenomic Data Server
*   Copyright (c) 2014 Max Planck Institute for Computer Science.
*   All rights reserved.
*
*   File : add_annotation_server_processing.php
*
*   Felipe Albrecht <felipe.albrecht@mpi-inf.mpg.de>
*	Obaro Odiete <s8obodie@stud.uni-saarland.de>
*
*   Created : 06-08-2015
*/

/* DeepBlue Configuration */
require_once("../../lib/lib.php");
require_once("../../lib/deepblue.IXR_Library.php");
require_once("../../lib/server_settings.php");

if ((!isset($_GET)) || !isset($_GET["name"]) || !isset($_GET["genome"]) || !isset($_GET["data"])) {
    return;
}

$name = $_GET['name'];
$genome = $_GET['genome'];
$data = $_GET['data'];

$desc = '';
if (isset($_GET["description"])) {
    $desc = $_GET['description'];
}

$metadata = (Object) null;
if (isset($_GET["metadata"])) {
    $metadata = $_GET['metadata'];
}

$format = '';
if (isset($_GET["format"])) {
    $format = $_GET['format'];
}

$client = new IXR_Client(get_server());
if(!$client->query("add_annotation", $name, $genome, $desc, $data, $format, $metadata, $user_key)){
	die('An error occurred - '.$client->getErrorCode().":".$client->getErrorMessage());
}

$response = $client->getResponse();
echo json_encode(['data' => $response]);