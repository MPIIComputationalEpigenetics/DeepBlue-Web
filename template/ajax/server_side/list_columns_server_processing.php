<?php

/**
*   DeepBlue Epigenomic Data Server
*   Copyright (c) 2014 Max Planck Institute for Computer Science.
*   All rights reserved.
*
*   File : list_columns_server_processing.php
*
*   Felipe Albrecht <felipe.albrecht@mpi-inf.mpg.de>
*	Obaro Odiete <s8obodie@stud.uni-saarland.de>
*
*   Created : 05-01-2015
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

/* retrieve columns data of selected experiments*/

$data['common'] = [];
$data['calculated'] = [];
$data['optional'] = [];
$data['experiment'] = [];

if (!isset($_GET["ids"])) {
    echo json_encode($data);
    return;
}

$getIds = $_GET["ids"];
$format = [];
$experiment = [];

for ($i = 0; $i < count($getIds); $i++) {
    if(!$client->query("info", $getIds[$i], $user_key)){
        die('An error occurred - '.$client->getErrorCode().":".$client->getErrorMessage());
    }
    $infoList = $client->getResponse();
    check_error($infoList);

    $columns = $infoList[1][0]['columns'];
    $length = count($columns);

    for ($j = 0; $j < $length; $j++) {
        $column_name = $columns[$j]['name'];
        if (array_key_exists($column_name, $format)) {
            $format[$column_name] = $format[$column_name] + 1;
            $experiment[$column_name] = $experiment[$column_name].'; '.$getIds[$i];
        }
        else {
            $format[$column_name] = 1;
            $experiment[$column_name] = $getIds[$i];
        }
    }
}

if(!$client->query("list_column_types", $user_key)){
    die('An error occurred - '.$client->getErrorCode().":".$client->getErrorMessage());
}

$colList = $client->getResponse();
check_error($colList);

$type = 'calculated';
foreach ($colList[1] as $column) {

    $colID = $column[0];

    /* retrieve column details */
    if(!$client->query("info", $colID, $user_key)){
        die('An error occurred - '.$client->getErrorCode().":".$client->getErrorMessage());
    }
    else {
        $colDetail = $client->getResponse();
        check_error($colDetail);

        if ($colDetail[1][0]['column_type'] == $type) {
            $colName = $colDetail[1][0]['name'];
            $colCode = $colDetail[1][0]['code'];
            $temp = [$colCode, $colName];
            $data['calculated'][] = $temp;
        }
    }
}

$common_count = max(array_values($format));
$common_format = array_keys($format, $common_count);
$optional_format = array_values(array_diff(array_keys($format), $common_format));

$data['common'] = $common_format;
$data['optional'] = $optional_format;
$data['experiment'] = $experiment;

echo json_encode($data);