<?php

/**
*   DeepBlue Epigenomic Data Server
*   Copyright (c) 2014 Max Planck Institute for Computer Science.
*   All rights reserved.
*
*   File : column_types_server_processing.php
*
*   Felipe Albrecht <felipe.albrecht@mpi-inf.mpg.de>
*   Umidjon Urunov <umidjon.urunov@mpi-inf.mpg.de>
*
*   Created : 21-08-2014
*/

/* DeepBlue Configuration */
require_once("../../lib/lib.php");

//include IXR Library for RPC-XML
require_once("../../lib/deepblue.IXR_Library.php");

$client = new IXR_Client($url);

if(!$client->query("list_column_types", $user_key)){
    $columnList[] = 'An error occured - '.$client->getErrorCode()." : ".$client->getErrorMessage();
}
else{
    $client->query("list_column_types", $user_key);
    $columnList[] = $client->getResponse();
}

/* Ordering and generating json file for Datatables */

$orderedDataStr = array();
$tempArr = array();

foreach($columnList[0][1] as $orderedData){

    $splitIntoArrays[] = explode(" ", $orderedData[1]);

    foreach ($splitIntoArrays as $val_1) {

        $tempArr[] = $orderedData[0];
        $tempArr[] = str_replace("'", "", $val_1[3]);
        $tempArr[] = str_replace("'", "", $val_1[8]);

        array_push($orderedDataStr, $tempArr);
        $tempArr = array();
    }

    $splitIntoArrays = array();
}

echo json_encode(array('data' => $orderedDataStr));

?>