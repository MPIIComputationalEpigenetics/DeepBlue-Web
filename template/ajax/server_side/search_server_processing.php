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


if ((!isset($_GET)) || !isset($_GET["text"]) || !isset($_GET["types"])) {
	return;
}

$words = $_GET["text"];
if($_GET["types"] != ""){
    $types = str_replace(' ', '_', strtolower($_GET["types"]));
}
else{
    $types = "";
}

//isset($_GET["types"]) ? $types = $_GET["types"] : $types = "";

// if (isset($_GET["types"])) {
// 	$types = $_GET["types"];
// } else {
// 	$types = "";
// }

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

if(!$client->query("info", $items_ids, $user_key)){
    die('An error occurred - '.$client->getErrorCode().":".$client->getErrorMessage());
}
else{
    $infoList = $client->getResponse();
}

$orderedDataStr = array();
$tempArr = array();

foreach ($infoList[1] as $val_1) {

    $tempArr[] = $val_1["_id"];
    isset($val_1["name"]) ? $tempArr[] = $val_1["name"] : $tempArr[] = "";
    isset($val_1["genome"]) ? $tempArr[] = "<i class='fa fa-star txt-color-yellow'></i> ".$val_1["genome"] : $tempArr[] = "";
    $tempArr[] = "<i class='fa fa-star txt-color-yellow'></i> ".$val_1["type"];
    isset($val_1["description"]) ? $tempArr[] = $val_1["description"] : $tempArr[] = "";

    array_push($orderedDataStr, $tempArr);
    $tempArr = array();

}

echo json_encode(array('data' => $orderedDataStr));

?>