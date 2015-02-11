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

$client = new IXR_Client($url);

if(!$client->query("list_samples", $biosource, (Object)Null, $user_key)){
	die('An error occurred - '.$client->getErrorCode().":".$client->getErrorMessage());
}
else {
	$response = $client->getResponse();
}

$lists = array();
for ($i = 0; $i < count($response[1]); $i++) {
	$lists[$i] = $response[1][$i][0];
}

echo json_encode($lists);
?>