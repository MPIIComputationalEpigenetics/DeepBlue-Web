<?php

/**
*   DeepBlue Epigenomic Data Server
*   Copyright (c) 2014 Max Planck Institute for Computer Science.
*   All rights reserved.
*
*   File : samples_server_processing.php
*
*   Felipe Albrecht <felipe.albrecht@mpi-inf.mpg.de>
*   Umidjon Urunov <umidjon.urunov@mpi-inf.mpg.de>
*
*   Created : 21-08-2014
*/

/* DeepBlue Configuration */
require_once("../../lib/lib.php");
require_once("../../lib/server_settings.php");
require_once("../../lib/deepblue.IXR_Library.php");

$client = new IXR_Client(get_server());

if (isset($_GET) && isset($_GET["biosources"])) {
    $bioNames[] = $_GET["biosources"];
} 
else {
    if(!$client->query("list_biosources", (Object)Null, $user_key)) {
        die('An error occurred - '.$client->getErrorCode().":".$client->getErrorMessage());
    }
    $bioSourceList[] = $client->getResponse();
    if ($bioSourceList[0][0] == 'error') {
        echo json_encode(['data' => $bioSourceList[0]]);
        die();
    }

    foreach($bioSourceList[0][1] as $bioSourceName) {
        $bioNames[] = $bioSourceName[1];
    }
}

if(!$client->query("list_samples", $bioNames, (object) null, $user_key)){
    die('An error occurred - '.$client->getErrorCode().":".$client->getErrorMessage());
}
$sampleList[] = $client->getResponse();
if ($sampleList[0][0] == 'error') {
    echo json_encode(['data' => $sampleList[0]]);
    die();
}

$sampleIds = array();
foreach ($sampleList[0][1] as $samples) {
    $sampleIds[] = $samples[0];
}

if(!$client->query("info", $sampleIds, $user_key)){
    die('An error occurred - '.$client->getErrorCode().":".$client->getErrorMessage());
}

$infoList[] = $client->getResponse();
if ($infoList[0][0] == 'error') {
    echo json_encode(['data' => $infoList[0]]);
    die();
}

$orderedDataStr = array();
$tempArr = array();
$tempStr = "";

foreach ($infoList[0][1] as $val_1) {
    $tempArr[] = $val_1['_id'];
    $tempArr[] = $val_1['biosource_name'];

    foreach ($val_1 as $key => $value) {
        if ($key == "_id" || $key == 'biosource_name' || $key == 'user' || $key == 'type') {
            continue;
        }
        $tempStr .= '<b>'.$key.'</b> : '.$val_1[$key].'<br/>';
    }

    $tempArr[] = $tempStr;

    array_push($orderedDataStr, $tempArr);
    $tempArr = array();
    $tempStr = "";

}
echo json_encode(array('data' => $orderedDataStr));