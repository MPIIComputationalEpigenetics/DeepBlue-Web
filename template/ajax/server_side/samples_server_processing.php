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
*   File : samples_server_processing.php
*
*/

/* include IXR Library for RPC-XML */
require_once("../../lib/deepblue.IXR_Library.php");

/* Including URL for server and USER Key  */
require_once("../../lib/lib.php");

/* Getting data from the server */

$client = new IXR_Client($url);

if(!$client->query("list_bio_sources", $user_key)){
    $bioSourceList[] = 'An error occured - '.$client->getErrorCode()." : ".$client->getErrorMessage();
}
else{
    $client->query("list_bio_sources", $user_key);
    $bioSourceList[] = $client->getResponse();
}

foreach($bioSourceList[0][1] as $bioSourceName){
    $bioNames[] = $bioSourceName[1];
}

$client->query("list_samples", $bioNames, (object) null, $user_key);
$sampleList[] = $client->getResponse();

/* Collecting epigenetic mark ids into array */
$sampleIds = array();

foreach ($sampleList[0][1] as $samples) {
    $sampleIds[] = $samples[0];
}

/* Getting info data about epigenetc marks */

$client->query("info", $sampleIds, $user_key);
$infoList[] = $client->getResponse();

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