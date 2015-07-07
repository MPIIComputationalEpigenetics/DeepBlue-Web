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

/* include IXR Library for RPC-XML */
require_once("../../lib/deepblue.IXR_Library.php");

$client = new IXR_Client($url);

if (isset($_GET) && isset($_GET["biosources"])) {
    $bioNames[] = $_GET["biosources"];
} else {
    if(!$client->query("list_biosources", (Object)Null, $user_key)) {
        die('An error occurred - '.$client->getErrorCode().":".$client->getErrorMessage());
    }
    else {
        $bioSourceList[] = $client->getResponse();
        foreach($bioSourceList[0][1] as $bioSourceName) {
            $bioNames[] = $bioSourceName[1];
        }
    }
}

if(!$client->query("list_samples", $bioNames, (object) null, $user_key)){
    die('An error occurred - '.$client->getErrorCode().":".$client->getErrorMessage());
}
else{
    $sampleList[] = $client->getResponse();
}

$sampleIds = array();

foreach ($sampleList[0][1] as $samples) {
    $sampleIds[] = $samples[0];
}

if(!$client->query("info", $sampleIds, $user_key)){
    die('An error occurred - '.$client->getErrorCode().":".$client->getErrorMessage());
}
else{
    $infoList[] = $client->getResponse();
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

?>