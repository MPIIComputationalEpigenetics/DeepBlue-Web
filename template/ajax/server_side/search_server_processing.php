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


// /* include init file */
// require_once("../inc/init.php");

/* DeepBlue Configuration */
require_once("../../lib/lib.php");

/* include IXR Library for RPC-XML */
require_once("../../lib/deepblue.IXR_Library.php");
$client = new IXR_Client($url);

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
else{
    $searchList[] = $client->getResponse();
}

$items_ids = array();
foreach($searchList[0][1] as $item){
    $items_ids[] = $item[0];
}

$sizeOfItemIds = sizeof($items_ids);

if(!$client->query("info", $items_ids, $user_key)){
    die('An error occurred - '.$client->getErrorCode().":".$client->getErrorMessage());
}
else{
    $infoList[] = $client->getResponse();
}


if ($infoList[0][0] == "error" || !isset($infoList[0][1])) {
    echo json_encode(array('data' => array()));
    return;
}

if($sizeOfItemIds == 1){
    $deepBlueObj->searchResultToJson($infoList[0]);
    //print_r($deepBlueObj->searchResultToJson($infoList[0]));
}
else{
    $deepBlueObj->searchResultToJson($infoList[0][1]);
    //print_r($deepBlueObj->searchResultToJson($infoList[0][1]));
}



?>