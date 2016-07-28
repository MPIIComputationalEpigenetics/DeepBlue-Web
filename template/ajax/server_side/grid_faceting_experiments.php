<?php

/**
*   DeepBlue Epigenomic Data Server
*   Copyright (c) 2014 Max Planck Institute for Computer Science.
*   All rights reserved.
*
*   File : grid_faceting_experiments.php
*
*   Felipe Albrecht <felipe.albrecht@mpi-inf.mpg.de>
*   Obaro Odiete <s8obodie@stud.uni-saarland.de>
*
*   Created : 28-07-2016
*/

/* DeepBlue Configuration */
require_once("../../lib/lib.php");
require_once("../../lib/server_settings.php");
require_once("../../lib/deepblue.IXR_Library.php");
require_once("../../lib/error.php");

$filters = array();
if (isset($_GET) && isset($_GET["request"])) {
    $filters = $_GET["request"];

} else if (isset($_POST) && isset($_POST["request"])) {
    $filters = $_POST["request"];
}

$collection = array();

array_key_exists("experiment-project", $filters) ? $collection["projects"] = $filters["experiment-project"] : $collection["projects"] = "";
array_key_exists("experiment-genome", $filters) ? $collection["genomes"] = $filters["experiment-genome"] : $collection["genomes"] = "";
array_key_exists("experiment-technique", $filters) ? $collection["techniques"] = $filters["experiment-technique"] : $collection["techniques"] = "";
array_key_exists("experiment-epigenetic_mark", $filters) ? $collection["epigenetic_marks"] = $filters["experiment-epigenetic_mark"] : $collection["epigenetic_marks"] = "";
array_key_exists("experiment-biosource", $filters) ? $collection["biosources"] = $filters["experiment-biosource"] : $collection["biosources"] = "";
array_key_exists("experiment-datatype", $filters) ? $collection["types"] = $filters["experiment-datatype"] : $collection["types"] = "";
array_key_exists("experiment-sample", $filters) ? $collection["samples"] = $filters["experiment-sample"] : $collection["samples"] = "";

$client = new IXR_Client(get_server());
$listInUse = [];

$data = array();
$vocabularies = ["projects","epigenetic_marks", "biosources", "techniques", "genomes", "samples", "types"];
foreach ($vocabularies as $vocabulary) {
	$data[$vocabulary] = array();

	$temp = $collection[$vocabulary];
	$collection[$vocabulary] = "";

	if(!$client->query("collection_experiments_count", $vocabulary, $collection["genomes"], $collection["types"],
		$collection["epigenetic_marks"], $collection["biosources"], $collection["samples"], $collection["techniques"], $collection["projects"], $user_key)){
		die('An error occurred - '.$client->getErrorCode().":".$client->getErrorMessage());
	}
	$response = $client->getResponse();
	check_error($response);

	$response_temp = $response[1];
	$data[$vocabulary]['alp'] = $response_temp;

	usort($data[$vocabulary]['alp'], function($a, $b) {
		return strcasecmp($a[1], $b[1]);
	});

	if ($vocabulary != "samples") {
		$data[$vocabulary]['amt'] = $response_temp;
		usort($data[$vocabulary]['amt'], function($a, $b) {
			return $a[2] > $b[2];
		});
	}

	$collection[$vocabulary] = $temp;
}

echo json_encode(array($data));
?>