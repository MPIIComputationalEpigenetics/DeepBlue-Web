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
*   Created : 01-03-2015
*/

/* DeepBlue Configuration */
require_once("../../lib/lib.php");

/* include IXR Library for RPC-XML */
require_once("../../lib/deepblue.IXR_Library.php");
$client = new IXR_Client($url);

if ((!isset($_GET)) || !isset($_GET["getId"])) {
	return;
}

$getIds = $_GET["getId"];
$batch = $_GET["batch"];
$projects = $_GET['projects'];
$epigenetic_marks = $_GET['epigenetic_marks'];
$techniques = $_GET['techniques'];
$samples = $_GET['samples'];
$genomes = $_GET['genomes'];

/* retrieve experiment information */
$col_avail = [];
$j = 0;
$meta_avail = [];
$k = 0;


for ($i = 0; $i < count($getIds); $i++) {
	if(!$client->query("info", $getIds[$i], $user_key)){
		die('An error occurred - '.$client->getErrorCode().":".$client->getErrorMessage());
	}
	else{
		$infoList[] = $client->getResponse();
	}
	
	$experiment = $infoList[0][1][0];
	$infoList = null;
			
	if ($i == 0) {
		$info['id'] = "";
		$info['experiment'] = $experiment['name'];
		$names = $experiment['name'];

		if ($genomes != "")
			$info['genome'] = $genomes;
		else 
			$info['genome'] = $experiment['genome'];
		
		if ($epigenetic_marks != "")
			$info['epigenetic_mark'] = $epigenetic_marks;
		else
			$info['epigenetic_mark'] = $experiment['epigenetic_mark'];
			
		if ($samples != "")
			$info['sample'] = $samples;
		else
			$info['sample'] = $experiment['sample_id'];
		
		if ($techniques != "")
			$info['technique'] = $techniques;
		else
			$info['technique'] = $experiment['technique'];
			
		if ($projects != "")
			$info['project'] = $projects;
		else
			$info['project'] = $experiment['project'];
			
		$info['description'] = $experiment['description'];
		$info['Columns'] = $experiment['columns'];
		$temp['Columns'] = $experiment['columns'];
		$info['Extra Metadata'] = $experiment['extra_metadata'];
	}	
	
	$info['id'] = $info['id'].$experiment['_id']."; ";
	if ($i > 0) {
		$names = $names.", ".$experiment['name'];
	}

	if ($experiment['genome'] != $info['genome'])
		$info['genome'] = '(Multiple Values)';
	
	if ($experiment['epigenetic_mark'] != $info['epigenetic_mark'])
		$info['epigenetic_mark'] = '(Multiple Values)';
	
	if ($experiment['sample_id'] != $info['sample'])
		$info['sample'] = '(Multiple Values)';
	
	if ($experiment['technique'] != $info['technique'])
		$info['technique'] = '(Multiple Values)';
	
	if ($experiment['project'] != $info['project'])
		$info['project'] = '(Multiple Values)';
	
	if ($i > 0) {
		$info['experiment'] = '(Multiple Values)';
		$info['description'] = '(Multiple Values)';

		$info['Extra Metadata'] = array_intersect_key($info['Extra Metadata'], $experiment['extra_metadata']);
		foreach ($info['Extra Metadata'] as $key => $value) {
			if ($experiment['extra_metadata'][$key] != $value) {
				$info['Extra Metadata'][$key] = '(Multiple Values)';
			}
		}
		
		$length = min(count($temp['Columns']), count($experiment['columns']));
		$info['Columns'] = null;
		
		for ($j = 0; $j < $length; $j++) {
			if ($temp['Columns'][$j]['name'] == $experiment['columns'][$j]['name']) {
				if ($temp['Columns'][$j]['column_type'] == $experiment['columns'][$j]['column_type']) {
					$info['Columns'][$j] = $temp['Columns'][$j];
				}
			}
		}
		$temp['Columns'] = $info['Columns'];
	}	
}

$result = array();
$result['info'] = $info;
$result['names'] = $names;
echo json_encode(array('data' => $result));
?>