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

$deepBlueObj->experimentDataTable($type='', $title='', $genomes, $epigenetic_marks, $samples, $techniques, $projects, 'workflow');


?>



