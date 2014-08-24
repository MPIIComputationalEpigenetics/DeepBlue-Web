<?php

/**
*   DeepBlue Epigenomic Data Server
*   Copyright (c) 2014 Max Planck Institute for Computer Science.
*   All rights reserved.
*
*   File : search_server_processing.php
*
*   Felipe Albrecht <felipe.albrecht@mpi-inf.mpg.de>
*
*   Created : 24-04-2014
*/

/* DeepBlue Configuration */
require_once("../../lib/lib.php");

/* include IXR Library for RPC-XML */
require_once("../../lib/deepblue.IXR_Library.php");

$client = new IXR_Client($url);

if ((!isset($_GET)) || !isset($_GET["text"])) {
	return;
}

$words = $_GET["text"];

if (isset($_GET["types"])) {
	$types = $_GET["types"];
} else {
	$types = "";
}

if(!$client->query("search", $words, $types, $user_key)){
    die('An error occurred - '.$client->getErrorCode().":".$client->getErrorMessage());
}
else{
    $searchList[] = $client->getResponse();
}

$orderedDataStr = array();
$tempArr = array();

foreach ($searchList[0][1] as $val_1) {
	$tempArr = array();
    $tempArr[] = $val_1[0];
    $tempArr[] = $val_1[1];
    $tempArr[] = $val_1[2];

    array_push($orderedDataStr, $tempArr);
}

echo json_encode(array('data' => $orderedDataStr));

?>