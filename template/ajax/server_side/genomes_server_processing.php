<?php

/**
*   DeepBlue Epigenomic Data Server
*   Copyright (c) 2014 Max Planck Institute for Computer Science.
*   All rights reserved.
*
*   File : genomes_server_processing.php
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

if(!$client->query("list_genomes", $user_key)){
    die('An error occurred - '.$client->getErrorCode().":".$client->getErrorMessage());
}
else{
    $genomeList[] = $client->getResponse();
}

$genomeIds = array();

foreach ($genomeList[0][1] as $genomes) {
    $genomeIds[] = $genomes[0];
}


if(!$client->query("info", $genomeIds, $user_key)){
    die('An error occurred - '.$client->getErrorCode().":".$client->getErrorMessage());
}
else{
    $infoList[] = $client->getResponse();
}

/* Ordering and generating json file for Datatables */

$orderedDataStr = array();
$tempArr = array();

foreach($infoList[0][1] as $genome){
    $tempArr[] = $genome['_id'];
    $tempArr[] = $genome['name'];
    $tempArr[] = $genome['description'];
    array_push($orderedDataStr, $tempArr);
    $tempArr = array();
}

echo json_encode(array('data' => $orderedDataStr));

?>