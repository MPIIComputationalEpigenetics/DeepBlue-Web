<?php

/**
*   DeepBlue Epigenomic Data Server
*   Copyright (c) 2014 Max Planck Institute for Computer Science.
*   All rights reserved.
*
*   File : search_get_data_server_processing.php
*
*   Felipe Albrecht <felipe.albrecht@mpi-inf.mpg.de>
*   Obaro Odiete <s8obodie@stud.uni-saarland.de>
*
*   Created : 28-12-2014
*/

/* DeepBlue Configuration */
require_once("../../lib/lib.php");
require_once("../../lib/error.php");
require_once("../../lib/server_settings.php");


/* include IXR Library for RPC-XML */
require_once("../../lib/deepblue.IXR_Library.php");
$client = new IXR_Client(get_server());

if ((!isset($_GET)) || !isset($_GET["caller"])) {
	return;
}

$caller = $_GET["caller"];
$term = $_GET["term"];

$lists = array();
$calculated = false;

/* decallerine list to retrieve based on caller */
switch ($caller) {
	case 'experiment':
		/* retrieve list of all epigenetic marks */
		if(!$client->query("list_experiments", '', '', '','','','','', $user_key)){
			die('An error occurred - '.$client->getErrorCode().":".$client->getErrorMessage());
		}
		else{
			$epList[] = $client->getResponse();
			check_error($epList[0]);
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
			check_error($emList[0]);
		}
		$lists = $emList[0][1];
		break;
	case 'sample':
		/* retrieve list of all samples */
		if(!$client->query("list_samples", '', (Object)Null, $user_key)){
			die('An error occurred - '.$client->getErrorCode().":".$client->getErrorMessage());
		}
		else{
			$samples[] = $client->getResponse();
			check_error($samples[0]);
			$sampleIds = array();
			$smList = [];
			$i = 0;
			foreach ($samples[0][1] as $sample) {
				$smList[$i][1] = $sample[0];
				$smList[$i][0] = $sample[1]['biosource_name'];
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
			check_error($tqList[0]);
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
			check_error($prList[0]);
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
			check_error($prList[0]);

			//echo json_encode($coList);
			$type = explode("xyz123abc", $caller)[1];
			if ($type == 'range') {
				$type = 'category';
			}
			if ($type == 'calculated') {
				$calculated = true;
			}

			$i = 0;
			$strList = [];
			foreach ($coList[0][1] as $column) {
				$colID = $column[0];

				/* retrieve column details */
				if(!$client->query("info", $colID, $user_key)){
					die('An error occurred - '.$client->getErrorCode().":".$client->getErrorMessage());
				}
				else {
					$colDetail[] = $client->getResponse();
					check_error($prList[0]);

					if ($colDetail[0][1][0]['column_type'] == $type) {
						if ($type == 'calculated') {
							$strList[$i][0] =$colDetail[0][1][0]['code']; ;
						}
						else {
							$strList[$i][0] = $type;
						}
						$strList[$i][1] = $colDetail[0][1][0]['name'];
						$i = $i + 1;
					}
					$colDetail = "";
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
		if ($calculated) {
			$result[$j]['label'] = $lists[$i][1].' ('.$lists[$i][0].')';
			$result[$j]['value'] = $lists[$i][0];
		}
		$j = $j + 1;
	}
	if ($caller == 'sample' && $j >= 30) break;
}
echo json_encode($result);
?>