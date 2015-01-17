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
	case 'epigenetic_mark':
		/* retrieve list of all epigenetic marks */
		if(!$client->query("list_epigenetic_marks", $user_key)){
			die('An error occurred - '.$client->getErrorCode().":".$client->getErrorMessage());
		}
		else{
			$emList[] = $client->getResponse();
		}
		$lists['epigenetic_mark'] = $emList[0][1];
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
		$lists['sample'] = $smList;
		break;
	case 'technique':
		/* retrieve list of all techniques */
		if(!$client->query("list_techniques", $user_key)){
			die('An error occurred - '.$client->getErrorCode().":".$client->getErrorMessage());
		}
		else{
			$tqList[] = $client->getResponse();
		}
		$lists['technique'] = $tqList[0][1];
		break;
	case 'project':
		/* retrieve list of all projects */
		if(!$client->query("list_projects", $user_key)){
			die('An error occurred - '.$client->getErrorCode().":".$client->getErrorMessage());
		}
		else{
			$prList[] = $client->getResponse();
		}
		$lists['project'] = $prList[0][1];
		break;
	default:
}

$j = 0;
$pattern = '@'.$term.'@i';
$result = array(); 
for ($i = 0; $i < count($lists[$caller]); $i++) {
	if (preg_match($pattern, $lists[$caller][$i][1]) == 1 || preg_match($pattern, $lists[$caller][$i][0]) == 1) {
		$result[$j]['label'] = $lists[$caller][$i][1].' ('.$lists[$caller][$i][0].')';
		$result[$j]['value'] = $lists[$caller][$i][1];
		$j = $j + 1;		
	}
	if ($j >= 6) break;
}
echo json_encode($result);
?>