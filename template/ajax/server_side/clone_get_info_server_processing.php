<?php

/**
*   DeepBlue Epigenomic Data Server
*   Copyright (c) 2014 Max Planck Institute for Computer Science.
*   All rights reserved.
*
*   File : search_get_info_serve_processing.php
*
*   Felipe Albrecht <felipe.albrecht@mpi-inf.mpg.de>
*   Obaro Odiete <s8obodie@stud.uni-saarland.de>
*
*   Created : 28-12-2014
*/

/* DeepBlue Configuration */
require_once("../../lib/lib.php");

/* include IXR Library for RPC-XML */
require_once("../../lib/deepblue.IXR_Library.php");
$client = new IXR_Client($url);

if ((!isset($_GET)) || !isset($_GET["getId"])) {
	return;
}

$getId = $_GET["getId"];

/* retrieve experiment information */
if(!$client->query("info", $getId, $user_key)){
    die('An error occurred - '.$client->getErrorCode().":".$client->getErrorMessage());
}
else{
    $infoList[] = $client->getResponse();
}

$result = array();

$experiment = $infoList[0][1][0];
$info['id'] = $experiment['_id'];
$info['experiment'] = $experiment['name'];
$info['genome'] = $experiment['genome'];
$info['epigenetic_mark'] = $experiment['epigenetic_mark'];
$info['sample'] = $experiment['sample_id']." (".$experiment['sample_info']['biosource_name'].")";
$info['technique'] = $experiment['technique'];
$info['project'] = $experiment['project'];
$info['description'] = $experiment['description'];
$info['Columns'] = $experiment['columns'];
$info['Extra Metadata'] = $experiment['extra_metadata'];

$result['info'] = $info;

echo json_encode(array('data' => $result));
?>