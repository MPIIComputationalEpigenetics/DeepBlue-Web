<?php

/**
*   DeepBlue Epigenomic Data Server
*   Copyright (c) 2014 Max Planck Institute for Computer Science.
*   All rights reserved.
*
*   File : select_regions_server_processing.php
*
*   Felipe Albrecht <felipe.albrecht@mpi-inf.mpg.de>
*
*   Created : 23-09-2014
*/

/* DeepBlue Configuration */
require_once("../../lib/lib.php");

/* include IXR Library for RPC-XML */
require_once("../../lib/deepblue.IXR_Library.php");
$client = new IXR_Client($url);

/* DeepBlue Class */
require_once("../../lib/deepblue.functions.php");
$deepBlueObj = new Deepblue();

if ((!isset($_REQUEST)) || !isset($_REQUEST["experiments_names"])) {
	return;
}

$experiments_names = $_REQUEST["experiments_names"];

// TODO: Remove hardcoded genome
// TODO: Remove hardcoded "0" and substitute to NULL (but server has to understand that)
// TODO: Remove hardcoded PHP_INT_MAX and substitute to NULL (but server has to understand that)
if (!$client->query("select_regions", $experiments_names, "hg19", "", "", "", "", "", 0, PHP_INT_MAX, $user_key)) {
    die('An error occurred - '.$client->getErrorCode().":".$client->getErrorMessage());
}
else{
    $result[] = $client->getResponse();
}

$query_id = $result[0][1];
echo json_encode(array('query_id' => $query_id));
?>