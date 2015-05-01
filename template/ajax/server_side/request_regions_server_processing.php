<?php

/**
*   DeepBlue Epigenomic Data Server
*   Copyright (c) 2014 Max Planck Institute for Computer Science.
*   All rights reserved.
*
*   File : request_regions_server_processing.php
*
*   Felipe Albrecht <felipe.albrecht@mpi-inf.mpg.de>
*	Obaro Odiete <s8obodie@stud.uni-saarland.de>
*
*   Created : 05-01-2015
*/

/* DeepBlue Configuration */
require_once("../../lib/lib.php");

/* include IXR Library for RPC-XML */
require_once("../../lib/deepblue.IXR_Library.php");
$client = new IXR_Client($url);

/* DeepBlue Class */
require_once("../../lib/deepblue.functions.php");
$deepBlueObj = new Deepblue();

if ((!isset($_REQUEST)) || !isset($_REQUEST["experiments_ids"])) {
	return;
}

$experiments_ids = $_REQUEST["experiments_ids"];
$genome = "";
$epigenetic_mark = "";
$sample_id = "";
$technique = "";
$project = "";
$chromosome ="";
$start = 0;
$end = PHP_INT_MAX;
$format = 'CHROMOSOME,START,END';

if (!$client->query("select_regions", $experiments_ids, $genome, $epigenetic_mark, $sample_id, $technique, $project, $chromosome, $start, $end, $user_key)) {
    die('An error occurred - '.$client->getErrorCode().":".$client->getErrorMessage());
}
else{
	$result[] = $client->getResponse();
	$query_id = $result[0][1];
	$result = [];
	
	if (!$client->query("get_regions", $query_id, $format, $user_key)) {
    	die('An error occurred - '.$client->getErrorCode().":".$client->getErrorMessage());
	}
	else{
		$result[] = $client->getResponse();
	}
}

$request_id = $result[0][1];
echo json_encode(array('request_id' => $request_id));
?>