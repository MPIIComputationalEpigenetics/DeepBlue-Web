<?php

/**
*   DeepBlue Epigenomic Data Server
*   Copyright (c) 2014 Max Planck Institute for Computer Science.
*   All rights reserved.
*
*   File : list_chromosomes_server_processing.php
*
*   Felipe Albrecht <felipe.albrecht@mpi-inf.mpg.de>
*	Obaro Odiete <s8obodie@stud.uni-saarland.de>
*
*   Created : 10-15-2015
*/

ini_set('memory_limit', '-1');
ini_set('max_execution_time', 300); //300 seconds = 5 minutes

/* DeepBlue Configuration */
require_once("../../lib/lib.php");
require_once("../../lib/error.php");
require_once("../../lib/server_settings.php");

/* include IXR Library for RPC-XML */
require_once("../../lib/deepblue.IXR_Library.php");
$client = new IXR_Client(get_server());

$data['chromosome'] = [];
$data['genomes'] = [];
$data['annotations'] = [];
$data['annotations_id'] = [];

/* process genomes, chromosomes and annotations attributes of the selected experiments */
if (!isset($_GET["ids"])) {
    echo json_encode($data);
    return;
}
$getIds = $_GET["ids"];

$genomes = [];
for ($i = 0; $i < count($getIds); $i++) {
    if(!$client->query("info", $getIds[$i], $user_key)){
        die('An error occurred - '.$client->getErrorCode().":".$client->getErrorMessage());
    }
    $infoList = $client->getResponse();
    check_error($infoList);

    $genome = $infoList[1][0]['genome'];
    if (!in_array($genome, $genomes)) {
        $genomes[] = $genome;
    }
}

$length = count($genomes);
$data['genomes'] = $genomes;

for ($j = 0; $j < $length; $j++) {
    // get chromosomes matching genome
    if(!$client->query("chromosomes", $genomes[$j], $user_key)){
        die('An error occurred - '.$client->getErrorCode().":".$client->getErrorMessage());
    }
    $result = $client->getResponse();
    check_error($result);

    $chrlen = count($result[1]);
    for ($k = 0; $k < $chrlen; $k++) {
        $chr = $result[1][$k][0];
        if (!in_array($chr, $data['chromosome'])) {
            $data['chromosome'][] = $chr;
        }
    }

    // get annotations matching genome
    if(!$client->query("list_annotations", $genomes[$j], $user_key)){
        die('An error occurred - '.$client->getErrorCode().":".$client->getErrorMessage());
    }
    $result = $client->getResponse();
    check_error($result);

    $annlen = count($result[1]);
    for ($k = 0; $k < $annlen; $k++) {
        $ann_id = $result[1][$k][0];
        if (!in_array($ann_id, $data['annotations'])) {
            $ann = $result[1][$k][1];
            $data['annotations'][] = $ann;
            $data['annotations_id'][] = $ann_id;
        }
    }
    //var_dump($annots);
    $result = '';
}
echo json_encode($data);
