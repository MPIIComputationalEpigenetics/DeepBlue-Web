<?php

/**
*   DeepBlue Epigenomic Data Server
*   Copyright (c) 2014 Max Planck Institute for Computer Science.
*   All rights reserved.
*
*   File : list_in_use.php
*
*   Felipe Albrecht <felipe.albrecht@mpi-inf.mpg.de>
*   Obaro Odiete <s8obodie@stud.uni-saarland.de>
*
*   Created : 08-02-2015
*/

/* DeepBlue Configuration */
require_once("../../lib/lib.php");
require_once("../../lib/server_settings.php");
require_once("../../lib/deepblue.IXR_Library.php");
require_once("../../lib/error.php");


if (isset($_GET) && isset($_GET["request"])) {
    $vocabularies = $_GET["request"];
} else {
	$vocabularies = ["projects","epigenetic_marks", "biosources", "techniques", "genomes"];
}

$client = new IXR_Client(get_server());
$listInUse = [];

if(!$client->query("faceting_experiments", "", "", "", "", "", "", "", $user_key)){
	die('An error occurred - '.$client->getErrorCode().":".$client->getErrorMessage());
}

$response = $client->getResponse();
check_error($response);

$data = array();
foreach ($vocabularies as $vocabulary) {
	$data[$vocabulary] = array();
	$data[$vocabulary]['alp'] = $response[1][$vocabulary];
	$data[$vocabulary]['amt'] = $response[1][$vocabulary];

	usort($data[$vocabulary]['alp'], function($a, $b) {
		return strcasecmp($a[1], $b[1]);
	});

	usort($data[$vocabulary]['amt'], function($a, $b) {
		return $a[2] > $b[2];
	});
}

echo json_encode(array($data));
?>