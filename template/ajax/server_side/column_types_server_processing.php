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

/* include IXR Library for RPC-XML */
require_once("../../lib/deepblue.IXR_Library.php");

$client = new IXR_Client($url);


if(!$client->query("list_column_types", $user_key)){
    die('An error occurred - '.$client->getErrorCode().":".$client->getErrorMessage());
}
else{
    $columnList[] = $client->getResponse();
}

/* Collecting epigenetic mark ids into array */
$columnIds = array();

foreach ($columnList[0][1] as $column) {
    $columnIds[] = $column[0];
}

/* Getting info data about epigenetc marks */

if(!$client->query("info", $columnIds, $user_key)){
    die('An error occurred - '.$client->getErrorCode().":".$client->getErrorMessage());
}
else{
    $infoList[] = $client->getResponse();
}

/* Ordering and generating json file for Datatables */

$orderedDataStr = array();

foreach($infoList[0][1] as $column_info){

    //print_r($column_info);

    $tempArr = array();
    $tempArr[] = $column_info['name'];
    $tempArr[] = $column_info['column_type'];
    $tempArr[] = $column_info['default_value'];
    if ($column_info['column_type'] == "category") {
        $tempArr[] = "Acceptable values: " . $column_info['values'];
    } else if ($column_info['column_type'] == "range") {
        $tempArr[] = $column_info['minimum'] . " - " . $column_info['maximum'];
    } else {
        $tempArr[] = "";
    }

    array_push($orderedDataStr, $tempArr);
}

echo json_encode(array('data' => $orderedDataStr));

?>