<?php

/**
*   DeepBlue Epigenomic Data Server
*   Copyright (c) 2014 Max Planck Institute for Computer Science.
*   All rights reserved.
*
*   File : faceting_experiments.php
*
*   Felipe Albrecht <felipe.albrecht@mpi-inf.mpg.de>
*   Obaro Odiete <s8obodie@stud.uni-saarland.de>
*
*   Created : 09-01-2016
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

array_key_exists("experiment-project", $filters) ? $project = $filters["experiment-project"] : $project = "";
array_key_exists("experiment-genome", $filters) ? $genome = $filters["experiment-genome"] : $genome = "";
array_key_exists("experiment-technique", $filters) ? $technique = $filters["experiment-technique"] : $technique = "";
array_key_exists("experiment-epigenetic_mark", $filters) ? $epigenetic_mark = $filters["experiment-epigenetic_mark"] : $epigenetic_mark = "";
array_key_exists("experiment-biosource", $filters) ? $biosource = $filters["experiment-biosource"] : $biosource = "";
array_key_exists("experiment-datatype", $filters) ? $type = $filters["experiment-datatype"] : $type = "";
array_key_exists("experiment-sample", $filters) ? $sample = $filters["experiment-sample"] : $sample = "";

$client = new IXR_Client(get_server());
$listInUse = [];

if(!$client->query("faceting_experiments", $genome, $type, $epigenetic_mark, $biosource, $sample, $technique, $project, $user_key)){
	die('An error occurred - '.$client->getErrorCode().":".$client->getErrorMessage());
}

$response = $client->getResponse();
check_error($response);

$data = array();
$vocabularies = ["projects","epigenetic_marks", "biosources", "techniques", "genomes", "samples", "types"];
foreach ($vocabularies as $vocabulary) {
	$data[$vocabulary] = array();
	$data[$vocabulary]['alp'] = $response[1][$vocabulary];

	usort($data[$vocabulary]['alp'], function($a, $b) {
		return strcasecmp($a[1], $b[1]);
	});

	if ($vocabulary != "samples") {
		$data[$vocabulary]['amt'] = $response[1][$vocabulary];
		usort($data[$vocabulary]['amt'], function($a, $b) {
			return $a[2] > $b[2];
		});
	}
}

echo json_encode(array($data));
?>