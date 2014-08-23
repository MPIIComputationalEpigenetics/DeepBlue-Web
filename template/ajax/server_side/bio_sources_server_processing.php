<?php

/**
*   DeepBlue Epigenomic Data Server
*   Copyright (c) 2014 Max Planck Institute for Computer Science.
*   All rights reserved.
*
*   File : bio_sources_server_processing.php
*
*   Felipe Albrecht <felipe.albrecht@mpi-inf.mpg.de>
*   Umidjon Urunov <umidjon.urunov@mpi-inf.mpg.de>
*
*   Created : 21-08-2014
*/

/* DeepBlue Configuration */
require_once("../../lib/lib.php");

/* include IXR Library for RPC-XML */
require_once("../../lib/deepblue.IXR_Library.php");

ini_set('memory_limit', '-1');

$client = new IXR_Client($url);

if(!$client->query("list_bio_sources", $user_key)){
    die('An error occurred - '.$client->getErrorCode().":".$client->getErrorMessage());
}
else{
    $biosourceList[] = $client->getResponse();
}

$bioSourceIds = array();

foreach ($biosourceList[0][1] as $bioSource) {
        $bioSourceIds[] = $bioSource[0];
}

if(!$client->query("info", $bioSourceIds, $user_key)){
    die('An error occurred - '.$client->getErrorCode().":".$client->getErrorMessage());
}
else{
    $infoList[] = $client->getResponse();
}

/* Ordering and generating json file for Datatables */

$orderedDataStr = array();


foreach($infoList[0][1] as $orderedData){
    $tempArr = array();

    $tempArr[] = !isset($orderedData['_id']) ? "" : $orderedData['_id'];
    $tempArr[] = !isset($orderedData['name']) ? "" : $orderedData['name'];
    $tempArr[] = !isset($orderedData['description']) ? "" : $orderedData['description'];

    $tempBioStr = "";
    foreach ($orderedData['extra_metadata'] as $bioKey => $bioValue) {
        $tempBioStr .= '<b>'.$bioKey.'</b> : '.$bioValue.'<br/>';
    }
    $tempArr[] = $tempBioStr;

    $orderedDataStr[] = $tempArr;
}

echo json_encode(array('data' => $orderedDataStr));

?>