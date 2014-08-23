<?php

/**
*   DeepBlue Epigenomic Data Server
*   Copyright (c) 2014 Max Planck Institute for Computer Science.
*   All rights reserved.
*
*   File : projects_server_processing.php
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

if(!$client->query("list_projects", $user_key)){
    $projectList[] = 'An error occured - '.$client->getErrorCode()." : ".$client->getErrorMessage();
}
else{
    $client->query("list_projects", $user_key);
    $projectList[] = $client->getResponse();
}

/* Collecting projects ids into array */
$projectIds = array();

foreach ($projectList[0][1] as $project) {
    $projectIds[] = $project[0];
}

/* Getting info data about projects */

$client->query("info", $projectIds, $user_key);
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