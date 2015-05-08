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
	case 'rrequest':

		/* manage region requests */
		if (!isset($_GET["experiments_ids"])) {
			return;
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
		$format = 'CHROMOSOME,START,END';

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
			echo json_encode(array('data' => $response[1]));
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