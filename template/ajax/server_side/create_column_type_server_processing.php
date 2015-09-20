<?php

/**
*   DeepBlue Epigenomic Data Server
*   Copyright (c) 2014 Max Planck Institute for Computer Science.
*   All rights reserved.
*
*   File : create_column_type_server_processing.php
*
*   Felipe Albrecht <felipe.albrecht@mpi-inf.mpg.de>
*	Obaro Odiete <s8obodie@stud.uni-saarland.de>
*
*   Created : 11-09-2015
*/

/* DeepBlue Configuration */
require_once("../../lib/lib.php");
require_once("../../lib/deepblue.IXR_Library.php");
require_once("../../lib/server_settings.php");

if ((!isset($_GET)) || !isset($_GET["name"]) || !isset($_GET["type"])) {
    return;
}

$name = $_GET['name'];
$type = $_GET['type'];

$desc = '';
if (isset($_GET["description"])) {
    $desc = $_GET['description'];
}

if (isset($_GET["min"])) {
    $min = floatval($_GET['min']);
}

if (isset($_GET["max"])) {
    $max = floatval($_GET['max']);
}

if (isset($_GET["code"])) {
    $code = $_GET['code'];
}

if (isset($_GET["category"]) && $_GET["category"] != "") {
    $items = explode(',', $_GET['category']);
}

$form = '';
if ($type == 'String' || $type == 'Integer' || $type == 'Double') {
    $form = 'Simple';
}
else {
    $form = $type;
}
$client = new IXR_Client(get_server());

switch ($form) {
    case 'Simple':
        if(!$client->query("create_column_type_simple", $name, $desc, strtolower($type), $user_key)){
            die('An error occurred - '.$client->getErrorCode().":".$client->getErrorMessage());
        }
        $response = $client->getResponse();        
        break;
    case 'Range':
        if(!$client->query("create_column_type_range", $name, $desc, $min, $max, $user_key)){
            die('An error occurred - '.$client->getErrorCode().":".$client->getErrorMessage());
        }
        $response = $client->getResponse();        
        break;
    case 'Category':
        if(!$client->query("create_column_type_category", $name, $desc, $items, $user_key)){
            die('An error occurred - '.$client->getErrorCode().":".$client->getErrorMessage());
        }
        $response = $client->getResponse();        
        break;
    case 'Calculated':
        if(!$client->query("create_column_type_calculated", $name, $desc, $code, $user_key)){
            die('An error occurred - '.$client->getErrorCode().":".$client->getErrorMessage());
        }
        $response = $client->getResponse();
        break;
    default:
        $response = ['error', 'Unknown column type'];
}

echo json_encode(['data' => $response]);