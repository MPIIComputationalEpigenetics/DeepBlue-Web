<?php

/**
*   DeepBlue Epigenomic Data Server
*   Copyright (c) 2014 Max Planck Institute for Computer Science.
*   All rights reserved.
*
*   File : list_all_experiment.php
*
*   Felipe Albrecht <felipe.albrecht@mpi-inf.mpg.de>
*   Obaro Odiete <s8obodie@stud.uni-saarland.de>
*
*   Created : 09-02-2015
*/

/* DeepBlue Configuration */
require_once("../../lib/lib.php");
require_once("../../lib/deepblue.IXR_Library.php");
require_once("../../lib/server_settings.php");
require_once("../../lib/error.php");

$client = new IXR_Client(get_server());

$filters = array();
if (isset($_GET) && isset($_GET["request"])) {
	$filters = $_GET["request"];
}

array_key_exists("experiment-project", $filters) ? $project = $filters["experiment-project"] : $project = "";
array_key_exists("experiment-genome", $filters) ? $genome = $filters["experiment-genome"] : $genome = "";
array_key_exists("experiment-technique", $filters) ? $technique = $filters["experiment-technique"] : $technique = "";
array_key_exists("experiment-epigenetic_mark", $filters) ? $epigenetic_mark = $filters["experiment-epigenetic_mark"] : $epigenetic_mark = "";
array_key_exists("experiment-biosource", $filters) ? $biosource = $filters["experiment-biosource"] : $biosource = "";
array_key_exists("experiment-datatype", $filters) ? $type = $filters["experiment-datatype"] : $type = "";
array_key_exists("experiment-sample", $filters) ? $sample = $filters["experiment-sample"] : $sample = "";

/* retrieve list of all experiments */
if(!$client->query("list_experiments", $genome, $type, $epigenetic_mark, $biosource, $sample, $technique, $project, $user_key)){
	die('An error occurred - '.$client->getErrorCode().":".$client->getErrorMessage());
}
else{
	$epList = $client->getResponse();
	check_error($epList);
}
$lists['experiment'] = $epList[1];


$result = [];
$vocabs = array('experiment');

foreach ($vocabs as $vocab) {
	$j = 0;
	$result[$vocab] = [];
	for ($i = 0; $i < count($lists[$vocab]); $i++) {
		$result[$vocab][$j]['label'] = $lists[$vocab][$i][1].' ('.$lists[$vocab][$i][0].')';
		$result[$vocab][$j]['value'] = $lists[$vocab][$i][1];
		$j = $j + 1;
	}
}

echo json_encode(array($result));