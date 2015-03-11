<?php

/**
*   DeepBlue Epigenomic Data Server
*   Copyright (c) 2014 Max Planck Institute for Computer Science.
*   All rights reserved.
*
*   File : list_biosource_samples.php
*
*   Felipe Albrecht <felipe.albrecht@mpi-inf.mpg.de>
*   Obaro Odiete <s8obodie@stud.uni-saarland.de>
*
*   Created : 11-02-2015
*/

/* DeepBlue Configuration */
require_once("../../lib/lib.php");
require_once("../../lib/deepblue.IXR_Library.php");

if (isset($_GET) && isset($_GET["biosource"])) {
    $biosource[] = $_GET["biosource"];
} else {
	return;
}

// retrieve the list of samples associated with the given biosource
$client = new IXR_Client($url);
if(!$client->query("list_samples", $biosource, (Object)Null, $user_key)){
	die('An error occurred - '.$client->getErrorCode().":".$client->getErrorMessage());
}
else {
	$response = $client->getResponse();
}

// retrieve the list of samples in use
$client1 = new IXR_Client($url);
if(!$client1->query("list_in_use", 'samples', $user_key)){
	die('An error occurred - '.$client1->getErrorCode().":".$client1->getErrorMessage());
}
else {
	$response1 = $client1->getResponse();
}

$samplesin = [];
for ($i = 0; $i < count($response1[1]); $i++) {
	$samplesin[] = $response1[1][$i][0];
}

$lists = array();
$j = 0;
for ($i = 0; $i < count($response[1]); $i++) {
	if (in_array($response[1][$i][0], $samplesin)) {
		$lists[$j] = $response[1][$i][0];
		$j = $j + 1;
	}
}

echo json_encode($lists);
?>