<?php

/**
*   DeepBlue Epigenomic Data Server
*   Copyright (c) 2014 Max Planck Institute for Computer Science.
*   All rights reserved.
*
*   File : list_experiments_server_processing.php
*
*   Felipe Albrecht <felipe.albrecht@mpi-inf.mpg.de>
*
*   Created : 20-10-2014
*/

/* DeepBlue Configuration */
require_once("../../lib/lib.php");
require_once("../../lib/server_settings.php");
require_once("../../lib/deepblue.IXR_Library.php");
require_once("../../lib/error.php");

if (isset($_GET) && isset($_GET["genomes"])) {
    $genomes[] = $_GET["genomes"];
} else {
	$genomes = "";
}

if (isset($_GET) && isset($_GET["epigenetic_marks"])) {
    $epigenetic_marks[] = $_GET["epigenetic_marks"];
} else {
	$epigenetic_marks = "";
}


if (isset($_GET) && isset($_GET["samples"])) {
    $samples[] = $_GET["samples"];
} else {
	$samples = "";
}

if (isset($_GET) && isset($_GET["techniques"])) {
    $techniques[] = $_GET["technique"];
} else {
	$techniques = "";
}

if (isset($_GET) && isset($_GET["projects"])) {
    $projects[] = $_GET["projects"];
} else {
	$projects = "";
}

$type = "";
$biosource = "";

$client = new IXR_Client(get_server());
if(!$client->query("list_experiments", $genomes, $type, $epigenetic_marks, $biosource, $samples, $techniques, $projects, $user_key)){
	die('An error occurred - '.$client->getErrorCode().":".$client->getErrorMessage());
}

$experimentsList = $client->getResponse();
check_error($experimentsList);

$experiment_ids = array();
foreach($experimentsList[1] as $experiment){
	$experiment_ids[] = $experiment[0];
}

if(!$client->query("info", $experiment_ids, $user_key)){
	die('An error occurred - '.$client->getErrorCode().":".$client->getErrorMessage());
}
$infoList = $client->getResponse();
check_error($infoList);

$orderedDataStr = array();
foreach($infoList[1] as $metadata) {
   	$tempArr = array();

	$tempArr[] = $metadata['_id'];
	$tempArr[] = $metadata['name'];
    $tempArr[] = $metadata['data_type'];
	$tempArr[] = $metadata['description'];
	$tempArr[] = $metadata['genome'];
	$tempArr[] = $metadata['epigenetic_mark'];
	$tempArr[] = $metadata['sample_info']['biosource_name'];
	$tempArr[] = $metadata['sample_id'];
	$tempArr[] = $metadata['technique'];
	$tempArr[] = $metadata['project'];
	$tempArr[] = "-"; // metadata

    array_push($orderedDataStr, $tempArr);
}

echo json_encode(array('data' => $orderedDataStr));
?>