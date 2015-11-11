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
*   Created : 24-08-2014
*/

/* DeepBlue Configuration */
require_once("../../lib/lib.php");
require_once("../../lib/server_settings.php");
require_once("../../lib/deepblue.IXR_Library.php");
require_once("../../lib/error.php");

$client = new IXR_Client(get_server());

/* DeepBlue Class */
require_once("../../lib/deepblue.functions.php");
$deepBlueObj = new Deepblue();

if ((!isset($_GET)) || !isset($_GET["text"]) || !isset($_GET["types"])) {
	return;
}

$words = $_GET["text"];

/* Replacing plus to quotes */
$words = $deepBlueObj->plusToQuotes($words);

if($_GET["types"] != ""){
    $types = str_replace(' ', '_', strtolower($_GET["types"]));
}
else{
    $types = "";
}

if(!$client->query("search", $words, $types, $user_key)){
    die('An error occurred - '.$client->getErrorCode().":".$client->getErrorMessage());
}
$searchList[] = $client->getResponse();
check_error($searchList[0]);

$items_ids = array();
foreach($searchList[0][1] as $item){
    $items_ids[] = $item[0];
}

$sizeOfItemIds = sizeof($items_ids);

if(!$client->query("info", $items_ids, $user_key)){
    die('An error occurred - '.$client->getErrorCode().":".$client->getErrorMessage());
}
$infoList = $client->getResponse();
check_error($infoList);

$deepBlueObj->searchResultToJson($infoList[1]);

?>