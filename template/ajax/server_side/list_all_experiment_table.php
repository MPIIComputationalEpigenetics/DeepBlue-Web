<?php

/**
*   DeepBlue Epigenomic Data Server
*   Copyright (c) 2014 Max Planck Institute for Computer Science.
*   All rights reserved.
*
*   File : list_all_experiment_table.php
*
*   Felipe Albrecht <felipe.albrecht@mpi-inf.mpg.de>
*   Obaro Odiete <s8obodie@stud.uni-saarland.de>
*
*   Created : 09-02-2015
*/

ini_set('max_execution_time', 300); //300 seconds = 5 minutes

/* DeepBlue Configuration */
require_once("../../lib/lib.php");
require_once("../../lib/server_settings.php");
require_once("../../lib/deepblue.IXR_Library.php");
require_once("../../lib/error.php");

$client = new IXR_Client(get_server());


/* DeepBlue Class */
require_once("../../lib/deepblue.functions.php");
$deepBlueObj = new Deepblue();

// check for request
if (isset($_GET) && isset($_GET["genomes"])) {
	$genomes[] = $_GET["genomes"];
} else {
	return;
}

if (isset($_GET) && isset($_GET["epigenetic_marks"])) {
	$epigenetic_marks[] = $_GET["epigenetic_marks"];
} else {
	return;
}

if (isset($_GET) && isset($_GET["biosources"])) {

	// retrieve the list of samples associated with the given biosource if no specific sample is selected
	if (strcmp($_GET['samples'], "") == 0)  {
		$client1 = new IXR_Client(get_server());
		$biosource[] = $_GET["biosources"];

		if(!$client1->query("list_samples", $biosource, (Object)Null, $user_key)){
			die('An error occurred - '.$client1->getErrorCode().":".$client1->getErrorMessage());
		}
		else {
			$response1 = $client1->getResponse();
			check_error($response1);
		}

		// retrieve the list of samples in use
		$client2 = new IXR_Client(get_server());
		if(!$client2->query("list_in_use", 'samples', $user_key)){
			die('An error occurred - '.$client2->getErrorCode().":".$client2->getErrorMessage());
		}
		else {
			$response2 = $client2->getResponse();
			check_error($response2);
		}

		$samplesin = [];
		for ($i = 0; $i < count($response2[1]); $i++) {
			$samplesin[] = $response2[1][$i][0];
		}

		$lists = array();
		$j = 0;
		for ($i = 0; $i < count($response1[1]); $i++) {
			if (in_array($response1[1][$i][0], $samplesin)) {
				$lists[$j] = $response1[1][$i][0];
				$j = $j + 1;
			}
		}
		$samples = $lists;
	}
}
else {
	return;
}

if (isset($_GET) && isset($_GET["samples"])) {
	if (strcmp($_GET['samples'], "") != 0)  {
		$samples = $_GET['samples'];
	}
} else {
	return;
}

if (isset($_GET) && isset($_GET["projects"])) {
	$projects[] = $_GET["projects"];
} else {
	return;
}

if (isset($_GET) && isset($_GET["techniques"])) {
	$techniques[] = $_GET["techniques"];
} else {
	return;
}

$deepBlueObj->experimentDataTable($type='', $title='', $genomes, $epigenetic_marks, $samples, $techniques, $projects, 'workflow');


?>



