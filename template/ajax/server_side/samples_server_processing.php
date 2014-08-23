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


error_reporting(E_ALL);
ini_set('display_errors', 1);

/* DeepBlue Configuration */
require_once("../../lib/lib.php");

/* include IXR Library for RPC-XML */
require_once("../../lib/deepblue.IXR_Library.php");

$client = new IXR_Client($url);

if(!$client->query("list_bio_sources", $user_key)){
    die('An error occurred - '.$client->getErrorCode().":".$client->getErrorMessage());
}
else{ $bioSourceList[] = $client->getResponse(); }

foreach($bioSourceList[0][1] as $bioSourceName){
    $bioNames[] = $bioSourceName[1];
}

if(!$client->query("list_samples", $bioNames, (object) null, $user_key)){
    die('An error occurred - '.$client->getErrorCode().":".$client->getErrorMessage());
}
else{ $sampleList[] = $client->getResponse(); }

/* Collecting epigenetic mark ids into array */
$sampleIds = array();

foreach ($sampleList[0][1] as $samples) {
    $sampleIds[] = $samples[0];
}

/* Getting info data about epigenetc marks */

if(!$client->query("info", $sampleIds, $user_key)){
    die('An error occurred - '.$client->getErrorCode().":".$client->getErrorMessage());
}
else{ $infoList[] = $client->getResponse(); }

$orderedDataStr = array();
$tempArr = array();
$tempStr = "";

foreach ($infoList[0][1] as $val_1) {

    $tempArr[] = $val_1['_id'];
    $tempArr[] = $val_1['bio_source_name'];
    $tempArr[] = $val_1['description'];

    foreach ($val_1 as $key => $value) {
        if ($key == "_id" || $key == 'bio_source_name' || $key == 'description' || $key == 'user') {
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