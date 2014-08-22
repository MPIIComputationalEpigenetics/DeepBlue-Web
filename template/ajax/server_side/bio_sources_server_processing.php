<?php

/**
*   DeepBlue Epigenomic Data Server
*   Copyright (c) 2014 Max Planck Institute for Computer Science.
*   All rights reserved.
*
*   Authors :
*
*   Felipe Albrecht <felipe.albrecht@mpi-inf.mpg.de>
*   Umidjon Urunov <umidjon.urunov@mpi-inf.mpg.de>
*
*   Created : 21-08-2014
*
*   ================================================
*
*   File : bio_sources_server_processing.php
*
*/

error_reporting(E_ALL);
ini_set('display_errors', 1);

//include IXR Library for RPC-XML
require_once("../../lib/deepblue.IXR_Library.php");

/* Including URL for server and USER Key  */
require_once("../../lib/lib.php");

/* Getting data from the server */

$client = new IXR_Client($url);

if(!$client->query("list_bio_sources", $user_key)){
    $biosourceList[] = 'An error occured - '.$client->getErrorCode()." : ".$client->getErrorMessage();
}
else{
    $client->query("list_bio_sources", $user_key);
    $biosourceList[] = $client->getResponse();
}

$bioSourceIds = array();

foreach ($biosourceList[0][1] as $bioSource) {
        $bioSourceIds[] = $bioSource[0];
}

$client->query("info", $bioSourceIds, $user_key);
$infoList[] = $client->getResponse();

/* Ordering and generating json file for Datatables */

$orderedDataStr = array();
$tempArr = array();
$tempBioStr = "";

foreach($infoList[0][1] as $orderedData){

    $tempArr[] = !isset($orderedData['_id']) ? "" : $orderedData['_id'];
    $tempArr[] = !isset($orderedData['name']) ? "" : $orderedData['name'];
    $tempArr[] = !isset($orderedData['description']) ? "" : $orderedData['description'];


    foreach ($orderedData['extra_metadata'] as $bioKey => $bioValue) {
        $tempBioStr .= '<b>'.$bioKey.'</b> : '.$bioValue.'<br/>';
    }

    $tempArr[] = $tempBioStr;

    array_push($orderedDataStr, $tempArr);
    $tempArr = array();
    $tempBioStr = "";
}

echo json_encode(array('data' => $orderedDataStr));

?>