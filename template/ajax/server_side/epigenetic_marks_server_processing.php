<?php

/**
*   DeepBlue Epigenomic Data Server
*   Copyright (c) 2014 Max Planck Institute for Computer Science.
*   All rights reserved.
*
*   File : epigenetic_marks_server_processing.php
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

if(!$client->query("list_epigenetic_marks", $user_key)){
    $emList[] = 'An error occured - '.$client->getErrorCode()." : ".$client->getErrorMessage();
}
else{
    $client->query("list_epigenetic_marks", $user_key);
    $emList[] = $client->getResponse();
}

/* Collecting epigenetic mark ids into array */
$epigeneticMarkIds = array();

foreach ($emList[0][1] as $epigeneticMark) {
    $epigeneticMarkIds[] = $epigeneticMark[0];
}

/* Getting info data about epigenetc marks */

$client->query("info", $epigeneticMarkIds, $user_key);
$infoList[] = $client->getResponse();

/* Ordering and generating json file for Datatables */

$orderedDataStr = array();
$tempArr = array();

foreach($infoList[0][1] as $orderedData){

    $tempArr[] = $orderedData['_id'];
    $tempArr[] = $orderedData['name'];
    $tempArr[] = $orderedData['description'];

    array_push($orderedDataStr, $tempArr);

    $tempArr = array();
}

echo json_encode(array('data' => $orderedDataStr));

?>