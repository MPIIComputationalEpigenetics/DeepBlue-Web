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

/* retrieve list of all epigenetic marks */
if(!$client->query("list_epigenetic_marks", $user_key)){
	die('An error occurred - '.$client->getErrorCode().":".$client->getErrorMessage());
}
else{
	$emList[] = $client->getResponse();
}

/* retrieve list of all biosources */
if(!$client->query("list_biosources", $user_key)){
	die('An error occurred - '.$client->getErrorCode().":".$client->getErrorMessage());
}
else{
	$bioList[] = $client->getResponse();
}

/* retrieve list of all techniques */
if(!$client->query("list_techniques", $user_key)){
	die('An error occurred - '.$client->getErrorCode().":".$client->getErrorMessage());
}
else{
	$tqList[] = $client->getResponse();
}

/* retrieve list of all projects */
if(!$client->query("list_projects", $user_key)){
	die('An error occurred - '.$client->getErrorCode().":".$client->getErrorMessage());
}
else{
	$prList[] = $client->getResponse();
}

$lists = array();
$lists['epigenetic_mark'] = $emList[0][1];
$lists['sample'] = $bioList[0][1];
$lists['technique'] = $tqList[0][1];
$lists['project'] = $prList[0][1];

foreach($lists as $term => $value) {
	for ($i = 0; $i < count($lists[$term]); $i++) {
		$result[$term][$i]['data'] = $lists[$term][$i][0];
	  $result[$term][$i]['value'] = $lists[$term][$i][1];
	}
}
echo json_encode(array('data' => $result));
?>