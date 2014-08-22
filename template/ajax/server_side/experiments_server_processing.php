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
*   File : experiments_server_processing.php
*
*/


//include IXR Library for RPC-XML
require_once("../../lib/deepblue.IXR_Library.php");

/* Including URL for server and USER Key  */
require_once("../../lib/lib.php");

error_reporting(E_ALL);
ini_set('display_errors', 1);

/* Checking these parametrs exist or not */
!isset($genomF) ? $genomF = "" : $genomF;
!isset($emF) ? $emF = "" : $emF;

$client = new IXR_Client($url);

if(!$client->query("list_experiments", $genomF, $emF, "", "", "", $user_key)){
    $experimentList = 'An error occured - '.$client->getErrorCode()." : ".$client->getErrorMessage();
}
else{
    $client->query("list_experiments", $genomF, $emF, "", "", "", $user_key);
    $experimentList[] = $client->getResponse();
}

$experiment_ids = array();

foreach($experimentList[0][1] as $experiment){
    $experiment_ids[] = $experiment[0];
}

$client->query("info", $experiment_ids, $user_key);
$infoList = $client->getResponse();

$orderedDataStr = array();
$tempArr = array();
$tempExpStr = "";


foreach($infoList[1] as $metadata) {

    $tempArr[] = "<input type='checkbox' name='' value=''>";
    $tempArr[] = $metadata['_id'];
    $tempArr[] = $metadata['name'];
    $tempArr[] = $metadata['description'];

    $tempArr[] = $metadata['genome'];
    $tempArr[] = $metadata['epigenetic_mark'];
    $tempArr[] = $metadata['sample_id'];
    $tempArr[] = $metadata['technique'];
    $tempArr[] = $metadata['project'];

    foreach ($metadata as $others_metadata_key => $others_metadata_value) {
        if ($others_metadata_key != '_id' && $others_metadata_key != 'name' && $others_metadata_key != 'genome' &&
        $others_metadata_key != 'epigenetic_mark' && $others_metadata_key != 'sample_id' &&
        $others_metadata_key != 'description' && $others_metadata_key != 'type' &&
        $others_metadata_key != 'done' && $others_metadata_key != 'client_address' && $others_metadata_key != 'format' &&
        $others_metadata_key != 'upload_end' && $others_metadata_key != 'upload_start' && $others_metadata_key != 'extra_metadata' &&
        $others_metadata_key != 'technique' && $others_metadata_key != 'project' && $others_metadata_key != 'user'){

            $tempExpStr .= '<b>'.$others_metadata_key.'</b> : '.$others_metadata_value.'<br/>';
        }
    }


    foreach ($metadata['extra_metadata'] as $extra_metadata_key => $extra_metadata_value) {
        $tempExpStr .= '<b>'.$extra_metadata_key.'</b> : '.$extra_metadata_value.'<br/>';
    }

    $tempArr[] = $tempExpStr;
    array_push($orderedDataStr, $tempArr);

    $tempArr = array();
    $tempExpStr = "";
}

/* Generating JSON file from $tempArray final output */

echo json_encode(array('data' => $orderedDataStr));


?>