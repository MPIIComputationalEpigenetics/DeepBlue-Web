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
*   File : techniques_server_processing.php
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

if(!$client->query("list_techniques", $user_key)){
    die('An error occurred - '.$client->getErrorCode().":".$client->getErrorMessage());
}
else{ $techList[] = $client->getResponse(); }

/* Collecting epigenetic mark ids into array */
$techniquesIds = array();

foreach ($techList[0][1] as $techniques) {
    $techniquesIds[] = $techniques[0];
}

/* Getting info data about epigenetc marks */

if(!$client->query("info", $techniquesIds, $user_key)){
    die('An error occurred - '.$client->getErrorCode().":".$client->getErrorMessage());
}
else{ $infoList[] = $client->getResponse(); }

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