<?php

/**
*   DeepBlue Epigenomic Data Server
*   Copyright (c) 2014 Max Planck Institute for Computer Science.
*   All rights reserved.
*
*   File : manage_requests_server_processing.php
*
*   Felipe Albrecht <felipe.albrecht@mpi-inf.mpg.de>
*	Obaro Odiete <s8obodie@stud.uni-saarland.de>
*
*   Created : 05-01-2015
*/

ini_set('memory_limit', '-1');
ini_set('max_execution_time', 300); //300 seconds = 5 minutes

/* DeepBlue Configuration */
require_once("../../lib/lib.php");

/* include IXR Library for RPC-XML */
require_once("../../lib/deepblue.IXR_Library.php");
$client = new IXR_Client($url);

/* DeepBlue Class */
require_once("../../lib/deepblue.functions.php");
$deepBlueObj = new Deepblue();


if ((!isset($_GET)) || !isset($_GET["option"])) {
	return;
}
$option = $_GET["option"];

switch ($option) {
	case 'orequest':

		/* manage region download options */
		if (!isset($_GET["ids"])) {
			return;
		}

		$format = [];
		$experiment = [];
		$getIds = $_GET["ids"];

		for ($i = 0; $i < count($getIds); $i++) {
			if(!$client->query("info", $getIds[$i], $user_key)){
				die('An error occurred - '.$client->getErrorCode().":".$client->getErrorMessage());
			}
			else{
				$infoList[] = $client->getResponse();
			}
			
			$columns = $infoList[0][1][0]['columns'];
			$length = count($columns);

			for ($j = 0; $j < $length; $j++) {
				$column_name = $columns[$j]['name'];
				if (array_key_exists($column_name, $format)) {
					$format[$column_name] = $format[$column_name] + 1;				
					$experiment[$column_name] = $experiment[$column_name].'; '.$getIds[$i];
				}
				else {
					$format[$column_name] = 1;
					$experiment[$column_name] = $getIds[$i];
				}			
			}

			$infoList = null;
		}

		$common_count = max(array_values($format));
		$common_format = array_keys($format, $common_count);
		$optional_format = array_values(array_diff(array_keys($format), $common_format));

		$data['common'] = $common_format;
		$data['optional'] = $optional_format;
		$data['experiment'] = $experiment;

		echo json_encode($data);
		break;
	
	case 'rrequest':

		/* manage region requests */
		if (!isset($_GET["experiments_ids"])) {
			return;
		}

		if (!isset($_GET["columns"])) {
			$format = 'CHROMOSOME,START,END';
		}
		else {
			$format = $_GET['columns'];	
		}

		$experiments_ids = $_GET["experiments_ids"];
		$genome = "";
		$epigenetic_mark = "";
		$sample_id = "";
		$technique = "";
		$project = "";
		$chromosome ="";
		$start = 0;
		$end = PHP_INT_MAX;
		
		if (!$client->query("select_regions", $experiments_ids, $genome, $epigenetic_mark, $sample_id, $technique, $project, $chromosome, $start, $end, $user_key)) {
		    die('An error occurred - '.$client->getErrorCode().":".$client->getErrorMessage());
		}
		else{
			$result[] = $client->getResponse();
			$query_id = $result[0][1];
			$result = [];
			
			if (!$client->query("get_regions", $query_id, $format, $user_key)) {
		    	die('An error occurred - '.$client->getErrorCode().":".$client->getErrorMessage());
			}
			else{
				$result[] = $client->getResponse();
			}
		}

		$request_id = $result[0][1];
		echo json_encode(array('request_id' => $request_id));
		break;

	case 'lrequest':
		/* list all request */
		if (isset($_GET["filter"])) {
		    $request_state = $_GET["filter"];

			if(!$client->query("list_requests", $request_state, $user_key)){
				die('An error occurred - '.$client->getErrorCode().":".$client->getErrorMessage());
			}
			
			$response = $client->getResponse();
			$data['request_list'] = $response[1];
			
			$request_ids = $response[0][1];

			foreach($data['request_list'] as $request) {
				if(!$client->query("info", $request[0], $user_key)){
					die('An error occurred - '.$client->getErrorCode().":".$client->getErrorMessage());
				}
				$response = $client->getResponse();
				$data['start-time'][] = substr($response[1][0]['create_time'], 0, -7);
				if ($response[1][0]['state'] == 'done')
					$data['end-time'][] = substr($response[1][0]['finish_time'], 0, -7);
				else 
					$data['end-time'][] = '--';
			}

			echo json_encode($data);
		}
		break;

	case 'srequest':
		/* query status */
		if (isset($_GET["data"])) {
			$waiting_list = $_GET["data"];
			$new_status = [];

			foreach($waiting_list as $request_id) {
				if(!$client->query("get_request_status", $request_id, $user_key)){
					die('An error occurred - '.$client->getErrorCode().":".$client->getErrorMessage());
				}
				$response = $client->getResponse();
				$new_status[] = $response;
			}
			echo json_encode(array('data' => $new_status));
		}
		break;

	case 'drequest':
		/* download request */
		if (!isset($_GET["request_id"])) {
			return;
		}

		$request_id = $_GET["request_id"];
		if(!$client->query("get_request_data", $request_id, $user_key)){
		    die('An error occurred - '.$client->getErrorCode().":".$client->getErrorMessage());
		}
		else{
		    $result[] = $client->getResponse();
		}

		$bed_file = $result[0][1];
		$compress = gzencode($bed_file);

		header('Content-Description: File Transfer');
		header('Content-Type: application/force-download');
		header('Content-Encoding: gzip');
		header('Content-Disposition: attachment; filename=deepblue_data_'.$request_id.".bed.gz");
		header('Content-Transfer-Encoding: binary');
		header('Expires: 0');
		header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
		header('Pragma: public');
		header('Content-Length: ' . strlen($compress));
		ob_clean();
		flush();
		echo $compress;
		break;
	default:
		# code...
		break;
}




?>