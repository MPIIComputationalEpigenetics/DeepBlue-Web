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
*   Created : 02-03-2015
*/

/* DeepBlue Configuration */
require_once("../../lib/lib.php");

/* include IXR Library for RPC-XML */
require_once("../../lib/deepblue.IXR_Library.php");
$client = new IXR_Client($url);

if ((!isset($_GET)) || !isset($_GET["data"])) {
	return;
}

$data = $_GET["data"];
if (isset($_GET["deleted"])) {
	$deleted = $_GET["deleted"];
}
else {
	$deleted = [];
}

if (isset($_GET["removedColn"])) {
	$removedColn = $_GET["removedColn"];
}
else {
	$removedColn = [];
}
$ids = explode("; ", $data["id"], -1);

for ($i = 0; $i < count($ids); $i++) {
	// get the experiment id
	$id = $ids[$i];

	/* retrieve experiment information */
	if(!$client->query("info", $id, $user_key)){
		die('An error occurred - '.$client->getErrorCode().":".$client->getErrorMessage());
	}
	else{
		$infoList[] = $client->getResponse();
	}
	$experiment = $infoList[0][1][0];
	
	// update the experiment name
	if (count($ids) >  1)
		$name = $experiment['name'].'_'.$data['experiment'];
	else 
		$name = $data['experiment'];

	// update the experiment epigenetic_mark	
	if ($data["epigenetic_mark"] == "(Multiple Values)")
		$epigenetic_mark = $experiment['epigenetic_mark'];
	else
		$epigenetic_mark = $data["epigenetic_mark"];

	// update the experiment sample	
	if ($data["sample"] == "(Multiple Values)")
		$sample = $experiment['sample_id'];
	else
		$sample = $data["sample"];
	
	// update the experiment technique	
	if ($data["technique"] == "(Multiple Values)")
		$technique = $experiment['technique'];
	else
		$technique = $data["technique"];
	
	// update the experiment project	
	if ($data["project"] == "(Multiple Values)")
		$project = $experiment['project'];
	else
		$project = $data["project"];
	
	// update the experiment description	
	if ($data["description"] == "(Multiple Values)")
		$description = $experiment['description'];
	else
		$description = $data["description"];

	// updating the experiment column
	$j = 0;
	foreach ($data['Columns'] as $key => $value) {
		if ($key != $value && strcmp(substr($key,0,17),'CALCULATED_COLUMN') != 0) {
			$experiment['columns'][$j]['name'] = $value;
		}
		// add new calculated columns
		if (substr($key,0,17) == 'CALCULATED_COLUMN') {
			$experiment['columns'][] = ["column_type"=>"calculated","name"=>$value];
		}
		$j = $j + 1;
	}
	

	$format = $experiment['columns'][0]['name'];
	for ($j = 1; $j < count($experiment['columns']); $j++) {
		// check if a calculated column has been removed		
		if (!in_array($experiment['columns'][$j]['name'], $removedColn)) {
			$format = $format.','.$experiment['columns'][$j]['name'];
		}
	}
	
	// updating the metadata
	if (isset($data["Extra Metadata"])) {
		foreach ($data['Extra Metadata'] as $key => $value) {
			// check if a metadata was added
			if (!array_key_exists($key, $experiment['extra_metadata'])) {
				// new item added
				$experiment['extra_metadata'][$key] = $value;
			}
			else {
				// check if value has changed if changed update
				if ($value != '(Multiple Values)' && $value != $experiment['extra_metadata'][$key]) {
					// value has been updated for cloning
					$experiment['extra_metadata'][$key] = $value;
				}
			}
		}
		
		// check if a metadata have been removed
		foreach ($deleted as $item) {
			unset($experiment["extra_metadata"][$item]);
		}
		
		$extra_metadata = $experiment["extra_metadata"]; //(Object)Null;//
	}
	else {
		// test why this?
		$extra_metadata = (Object)Null;
	}

	// clone experiment with updated data
	if(!$client->query("clone_dataset", $id, $name, $epigenetic_mark, $sample, $technique, $project, $description, $format, $extra_metadata, $user_key)){
		die('An error occurred - '.$client->getErrorCode().":".$client->getErrorMessage());
	}
	else{
		$clone[] = $client->getResponse();
	}
	
	$infoList = null;
}

echo json_encode($clone);
?>