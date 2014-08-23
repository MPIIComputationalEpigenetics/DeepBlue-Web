<?php

/**
*   DeepBlue Epigenomic Data Server
*   Copyright (c) 2014 Max Planck Institute for Computer Science.
*   All rights reserved.
*
*   File : annotations_server_processing.php
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

/* Collecting genome ids into array */

$genomeIds = array();

foreach($genomeList[0][1] as $genomes){
    $genomeIds[] = $genomes[1];
}

/* Getting annotation list from the server  */
$annotations = array();

if(!$client->query("list_annotations", $genomeIds, $user_key)){
    die('An error occurred - '.$client->getErrorCode().":".$client->getErrorMessage());
}
else{
    $annotations[] = $client->getResponse();
}

/* Collecting annotation ids into array */
$annotationsIds = array();

foreach($annotations[0][1] as $annotationVal){
    $annotationsIds[] = $annotationVal[0];
}

if(!$client->query("info", $annotationsIds, $user_key)){
    die('An error occurred - '.$client->getErrorCode().":".$client->getErrorMessage());
}
else{
    $infoList[] = $client->getResponse();
}

$orderedDataStr = array();
$tempArr = array();
$tempAnStr = "";

foreach($infoList[0][1] as $value_2){

    $tempArr[] = $value_2['_id'];
    $tempArr[] = $value_2['name'];
    $tempArr[] = $value_2['genome'];
    $tempArr[] = $value_2['description'];

    $tempAnStr.= "<div class='format-small'><b>Format : </b>".$value_2['format']."</div><br/>";

    if(isset($value_2['extra_metadata'])){
        foreach ($value_2['extra_metadata'] as $key_3 => $value_3) {
            $tempAnStr .= "<div class='format-small'><b>".$key_3."</b> : ".$value_3."</div><br/>";
        }
    }

    $tempArr[] = $tempAnStr;

    array_push($orderedDataStr, $tempArr);
    $tempArr = array();
    $tempAnStr = "";
}

echo json_encode(array('data' => $orderedDataStr));

?>