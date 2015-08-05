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
require_once("../../lib/error.php");
require_once("../../lib/server_settings.php");

/* include IXR Library for RPC-XML */
require_once("../../lib/deepblue.IXR_Library.php");
$client = new IXR_Client(get_server());

if ((!isset($_GET)) || !isset($_GET["option"])) {
	return;
}
$option = $_GET["option"];

switch ($option) {
	case 'orequest':
		/* retrieve columns data of selected experiments*/
		if (!isset($_GET["ids"])) {
			return;
		}

		$format = [];
		$experiment = [];

		$data['common'] = [];
		$data['calculated'] = [];
		$data['optional'] = [];
		$data['experiment'] = [];

		$getIds = $_GET["ids"];

		for ($i = 0; $i < count($getIds); $i++) {
			if(!$client->query("info", $getIds[$i], $user_key)){
				die('An error occurred - '.$client->getErrorCode().":".$client->getErrorMessage());
			}
			$infoList[] = $client->getResponse();
			check_error($infoList);

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

		if(!$client->query("list_column_types", $user_key)){
			die('An error occurred - '.$client->getErrorCode().":".$client->getErrorMessage());
		}

		$colList[] = $client->getResponse();
		check_error($colList);

		$type = 'code';
		$pattern = '@'.$type.'@i';

		foreach ($colList[0][1] as $col) {
			if (preg_match($pattern, $col[1])) {
				$colName = explode(":", $col[1])[3];
				$colCode = explode("'", $col[1])[1];
				$temp = [$colName, $colCode];
				$data['calculated'][] = $temp;
			}
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
		/* manage region requests including, selecting regions, selecting annotations
			intersection and get_regions	*/

		if (!isset($_GET["experiments_ids"])) {
			return;
		}

		if (!isset($_GET["columns"])) {
			$format = 'CHROMOSOME,START,END';
		}
		else {
			$format = $_GET['columns'];
		}

		if (!isset($_GET["annotation_names"])) {
			$annotation_names = [];
		}
		else {
			$annotation_names = $_GET["annotation_names"];
		}

		if (!isset($_GET["chromosome"])) {
			$chromosome = [];
		}
		else {
			$chromosome = $_GET["chromosome"];
		}

		$experiments_ids = $_GET["experiments_ids"];
		$genome = "";
		$allgenomes = $_GET["allgenomes"];
		$epigenetic_mark = "";
		$sample_id = "";
		$technique = "";
		$project = "";

		$start = $_GET["start"];
		if (!is_numeric($start)) {
			$start = 0;
		}
		$start = (int)$start;

		$end = $_GET["end"];
		if (!is_numeric($end)) {
			$end = PHP_INT_MAX;
		}
		$end = (int)$end;

		if (!$client->query("select_regions", $experiments_ids, $genome, $epigenetic_mark, $sample_id, $technique, $project, $chromosome, $start, $end, $user_key)) {
		    die('An error occurred - '.$client->getErrorCode().":".$client->getErrorMessage());
		}

		$result[] = $client->getResponse();
		check_error($result);

		$query_ida = $result[0][1];
		$query_id = $query_ida;

		$result = [];
		$annlen = count($annotation_names);

		if ($annlen > 0) {
			// select annotations
			if (!$client->query("select_annotations", $annotation_names, $allgenomes, $chromosome, $start, $end, $user_key)) {
			    die('An error occurred - '.$client->getErrorCode().":".$client->getErrorMessage());
			}

			$result[] = $client->getResponse();
			check_error($result);

			$query_idb = $result[0][1];
			$result = [];

			if (!$client->query("intersection", $query_ida, $query_idb, $user_key)) {
		    	die('An error occurred - '.$client->getErrorCode().":".$client->getErrorMessage());
			}

			$result[] = $client->getResponse();
			check_error($result);

			$query_id = $result[0][1];
			$result = [];
		}

		if (!$client->query("get_regions", $query_id, $format, $user_key)) {
	    	die('An error occurred - '.$client->getErrorCode().":".$client->getErrorMessage());
		}

		$result[] = $client->getResponse();
		check_error($result);

		$request_id = $result[0][1];

		echo json_encode(array('request_id' => $request_id));
		break;

	case 'lrequest':
		/* list all request for the request manager*/
		if (isset($_GET["filter"])) {
		    $request_state = $_GET["filter"];

			if(!$client->query("list_requests", $request_state, $user_key)){
				die('An error occurred - '.$client->getErrorCode().":".$client->getErrorMessage());
			}

			$response = $client->getResponse();
			check_error($response);

			$data['request_list'] = $response[1];

			$rrow = [];
			foreach($data['request_list'] as $request) {
				$rid = $request[0];
				$temp[] = $rid;
				$qdetail = '';
				$rdetail = '<div style="display: block;">';

				// obtain initial query id
				if(!$client->query("info", $rid, $user_key)){
					die('An error occurred - '.$client->getErrorCode().":".$client->getErrorMessage());
				}

				$response = $client->getResponse();
				check_error($response);
				$qid = $response[1][0]['query_id'];

				// retrieve initial query details
				query_detail($qid, $rdetail);
				$rdetail = $rdetail.'</div>';

				if(!$client->query("info", $request[0], $user_key)){
					die('An error occurred - '.$client->getErrorCode().":".$client->getErrorMessage());
				}

				$response = $client->getResponse();
				check_error($response);
				$rstate = $response[1][0]['state'];

				if ($rstate == 'done') {
					$temp[] = 'ready';
					$temp[] = substr($response[1][0]['create_time'], 0, -7);
					$temp[] = substr($response[1][0]['finish_time'], 0, -7);
					$temp[] = $rdetail;
					$temp[] = '<button type="button" id="downloadBtnBottom_'.$rid.'" class="btn btn-primary" onclick = "getRegion(event)">Download</button>';
				}
				else {
					$temp[] = $rstate;
					$temp[] = substr($response[1][0]['create_time'], 0, -7);
					$temp[] = '--';
					$temp[] = $rdetail;
					$temp[] = '<button type="button" id="downloadBtnBottom_'.$rid.'" class="btn btn-primary" disabled onclick = "getRegion(event)">Download</button>';
				}
				$rrow[] = $temp;
				$temp = [];
			}
			echo json_encode(array('data' => $rrow));
		}
		break;

	case 'crequest':
		/* process genomes, chromosomes and annotations attributes of the selected experiments */
		if (!isset($_GET["ids"])) {
			return;
		}

		$getIds = $_GET["ids"];
		$genomes = [];
		for ($i = 0; $i < count($getIds); $i++) {
			if(!$client->query("info", $getIds[$i], $user_key)){
				die('An error occurred - '.$client->getErrorCode().":".$client->getErrorMessage());
			}
			$infoList[] = $client->getResponse();
			check_error($infoList);

			$genome = $infoList[0][1][0]['genome'];
			if (!in_array($genome, $genomes)) {
				$genomes[] = $genome;
			}
			$infoList = [];
		}

		$length = count($genomes);
		$data['chromosome'] = [];
		$data['genomes'] = $genomes;
		$data['annotations'] = [];
		$data['annotations_id'] = [];

		for ($j = 0; $j < $length; $j++) {
			// get chromosomes matching genome
			if(!$client->query("chromosomes", $genomes[$j], $user_key)){
				die('An error occurred - '.$client->getErrorCode().":".$client->getErrorMessage());
			}
			$result[] = $client->getResponse();
			check_error($result);
			//$chroms = array_merge($chroms, $result[0][1]);

			$chrlen = count($result[0][1]);
			for ($k = 0; $k < $chrlen; $k++) {
				$chr = $result[0][1][$k][0];
				if (!in_array($chr, $data['chromosome'])) {
					$data['chromosome'][] = $chr;
				}
			}

			$result = '';

			// get annotations matching genome
			if(!$client->query("list_annotations", $genomes[$j], $user_key)){
				die('An error occurred - '.$client->getErrorCode().":".$client->getErrorMessage());
			}
			$result[] = $client->getResponse();
			check_error($result);
			//$annots = array_merge($annots, $result[0][1]);

			$annlen = count($result[0][1]);
			for ($k = 0; $k < $annlen; $k++) {
				$ann_id = $result[0][1][$k][0];
				if (!in_array($ann_id, $data['annotations'])) {
					$ann = $result[0][1][$k][1];
					$data['annotations'][] = $ann;
					$data['annotations_id'][] = $ann_id;
				}
			}
			//var_dump($annots);
			$result = '';
		}
		//$data['chromosome'] = $chroms;
		//$data['annotations'] = $annots;
		//var_dump($data['chromosome'])
		echo json_encode($data);
		break;
	default:
		# code...
		break;
}

function query_detail($qud, &$rdetail) {
	$client = new IXR_Client(get_server());
	$user_key = get_user_key();
	$chroms = [];

	if(!$client->query("info", $qud, $user_key)) {
		die('An error occurred - '.$client->getErrorCode().":".$client->getErrorMessage());
	}

	$response = $client->getResponse();
	check_error($response);

	$qtype = $response[1][0]['type'];
	$qdetail = json_decode($response[1][0]['args'], true);

	$rdetail = $rdetail.'<b>'.$qtype.'</b>';
	$rdetail = $rdetail.' (query '.$qud.')';
	$rdetail = $rdetail."  \n\r  <br/>";

	// call server processing to check the size of the chromosomes
	$chroms_count = 0;

	if (isset($qdetail['genomes'])) {
		$genomes = $qdetail['genomes'];
		$length = count($genomes);

		for ($j = 0; $j < $length; $j++) {
			// get chromosomes matching genome
			if(!$client->query("chromosomes", $genomes[$j], $user_key)){
				die('An error occurred - '.$client->getErrorCode().":".$client->getErrorMessage());
			}

			$result[] = $client->getResponse();
			check_error($result);

			$chrlen = count($result[0][1]);
			for ($k = 0; $k < $chrlen; $k++) {
				$chr = $result[0][1][$k][0];
				if (!in_array($chr, $chroms)) {
					$chroms[] = $chr;
				}
			}

			$result = [];
		}
		$chroms_count = count($chroms);
	}

	foreach ($qdetail as $key => $value) {
		if ($key == 'qid_1' || $key == 'qid_2') {
			$rdetail = $rdetail."<hr>";
			query_detail($value, $rdetail);
			continue;
		}

		if ($key == 'start' && $value == 0) {
			continue;
		}

		if ($key == 'end' && $value == PHP_INT_MAX) {
			continue;
		}

		if ($key == 'project' || $key == 'has_filter') {
			continue;
		}

		if ($key == 'experiment_name') {
			$key = 'experiment name';
		}

		$rdetail = $rdetail.'<b>'.$key.'</b>: ';
		if ($key == 'chromosomes'){
			if (count($value) == $chroms_count) {
				$rdetail = $rdetail.' all';
				$rdetail = $rdetail."  \n\r  <br/>";
				continue;
			}
			//echo json_encode(array('len' => $length, 'qid' => $qud, 'chrcount' => $chroms_count, 'countvalue' => count($value)));
		}

		if (is_array($value)) {
			$arlen = count($value);
			for ($j = 0; $j < $arlen; $j++) {
				$rdetail = $rdetail.$value[$j];
				if ($j < $arlen - 1) {
					$rdetail = $rdetail.', ';
				}
			}
		}
		else {
			$rdetail = $rdetail.$value;
		}
		$rdetail = $rdetail."  \n\r  <br/>";
	}
}
?>