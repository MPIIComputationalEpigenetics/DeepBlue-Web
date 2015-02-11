<?php

/**
*   DeepBlue Epigenomic Data Server
*   Copyright (c) 2014 Max Planck Institute for Computer Science.
*   All rights reserved.
*
*   File : deepblue_list_in_use.php
*
*   Felipe Albrecht <felipe.albrecht@mpi-inf.mpg.de>
*   Obaro Odiete <s8obodie@stud.uni-saarland.de>
*
*   Created : 09-02-2015
*/

/* DeepBlue Configuration */
require_once("../../lib/lib.php");
require_once("../../lib/deepblue.IXR_Library.php");

$client = new IXR_Client($url);


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

if (isset($_GET) && isset($_GET["samples"])) {
	$samples[] = $_GET["samples"];
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

/* retrieve list of all experiments */
// list_experiments ( genome, epigenetic_mark, sample, technique, project, user key )
if(!$client->query("list_experiments", $genomes, $epigenetic_marks, $samples, $techniques, $projects, $user_key)){
	die('An error occurred - '.$client->getErrorCode().":".$client->getErrorMessage());
}
else{
	$epList[] = $client->getResponse();
}
$lists = $epList[0][1];


$vocabs = array('experiment');
$metadata = array();


for ($i = 0; $i < count($lists); $i++) {
	$metadata[$i] = array();
	$metadata[$i][0] = "<input type='checkbox' name='checkboxlist' id='".$lists[$i][0]."' class='downloadCheckBox'>";
	$metadata[$i][1] = $lists[$i][0];
	$metadata[$i][2] = $lists[$i][1];
}

echo json_encode(array('data' => $metadata));
?>