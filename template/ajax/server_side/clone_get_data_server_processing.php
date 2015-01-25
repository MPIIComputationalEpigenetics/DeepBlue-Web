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

if ((!isset($_GET)) || !isset($_GET["caller"])) {
	return;
}

$caller = $_GET["caller"];
$term = $_GET["term"];

$lists = array();

/* decallerine list to retrieve based on caller */
switch ($caller) {
	case 'experiment':
		/* retrieve list of all epigenetic marks */
		if(!$client->query("list_experiments", '','','','','', $user_key)){
			die('An error occurred - '.$client->getErrorCode().":".$client->getErrorMessage());
		}
		else{
			$epList[] = $client->getResponse();
		}
		$lists = $epList[0][1];
		break;
	case 'epigenetic_mark':
		/* retrieve list of all epigenetic marks */
		if(!$client->query("list_epigenetic_marks", $user_key)){
			die('An error occurred - '.$client->getErrorCode().":".$client->getErrorMessage());
		}
		else{
			$emList[] = $client->getResponse();
		}
		$lists = $emList[0][1];
		break;
	case 'sample':
		/* retrieve list of all samples */
		if(!$client->query("list_in_use", 'samples', $user_key)){
			die('An error occurred - '.$client->getErrorCode().":".$client->getErrorMessage());
		}
		else{
			$samples[] = $client->getResponse();
			$sampleIds = array();
			foreach ($samples[0][1] as $sample) {
				$sampleIds[] = $sample[0];
			}
		}
		
		/* retrieve list of all biosources */
		$smList = array();
		if(!$client->query("info", $sampleIds, $user_key)){
			die('An error occurred - '.$client->getErrorCode().":".$client->getErrorMessage());
		}
		else{
			$infoList[] = $client->getResponse();
			$i = 0;
			foreach ($infoList[0][1] as $sample) {
				$smList[$i][0] = $sample['biosource_name'];
				$smList[$i][1] = $sample['_id'];
				$i = $i + 1;
			}
		}
		$lists = $smList;
		break;
	case 'technique':
		/* retrieve list of all techniques */
		if(!$client->query("list_techniques", $user_key)){
			die('An error occurred - '.$client->getErrorCode().":".$client->getErrorMessage());
		}
		else{
			$tqList[] = $client->getResponse();
		}
		$lists = $tqList[0][1];
		break;
	case 'project':
		/* retrieve list of all projects */
		if(!$client->query("list_projects", $user_key)){
			die('An error occurred - '.$client->getErrorCode().":".$client->getErrorMessage());
		}
		else{
			$prList[] = $client->getResponse();
		}
		$lists = $prList[0][1];
		break;
	default:
		/* retrieve list of all columns */
		if(!$client->query("list_column_types", $user_key)){
			die('An error occurred - '.$client->getErrorCode().":".$client->getErrorMessage());
		}
		else{
			$coList[] = $client->getResponse();
			$type = explode("44", $caller)[1];
			if ($type == 'range') {
				$type = 'category';
			}
			$pattern = '@'.$type.'@i';
			$i = 0;
			foreach ($coList[0][1] as $column) {
				if (preg_match($pattern, $column[1]) == 1) {
					$strList[$i][0] = $type;
					$strList[$i][1] = explode("'", $column[1])[1];
					$i = $i + 1;
//					echo json_encode($strList);
				}				
			}
		}
		$lists = $strList;		
		break;		
}

$j = 0;
$pattern = '@'.$term.'@i';
$result = [];
for ($i = 0; $i < count($lists); $i++) {
	if (preg_match($pattern, $lists[$i][0]) == 1 || preg_match($pattern, $lists[$i][1]) == 1) {
		$result[$j]['label'] = $lists[$i][1].' ('.$lists[$i][0].')';
		$result[$j]['value'] = $lists[$i][1];
		$j = $j + 1;		
	}
	if ($caller == 'sample' && $j >= 10) break;
}
echo json_encode($result);
?>