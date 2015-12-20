<?php

/**
*   DeepBlue Epigenomic Data Server
*   Copyright (c) 2015 Max Planck Institute for Computer Science.
*   All rights reserved.
*
*   File : process_requests.php
*
*   Felipe Albrecht <felipe.albrecht@mpi-inf.mpg.de>
*	Obaro Odiete <s8obodie@stud.uni-saarland.de>
*
*   Created : 25-09-2015
*/

function build_request_info($ids, $user_key) {

	$client = new IXR_Client(get_server());

	$cache_chromosomes = array();
	$cache_queries = array();

	if(!$client->query("info", $ids, $user_key)){
		die('An error occurred - '.$client->getErrorCode().":".$client->getErrorMessage());
	}
	$requests_response = $client->getResponse();
	check_error($requests_response);

	$requests_info = $requests_response[1];

	$rrow = [];
	foreach($requests_info as $request_info) {
		$rid = $request_info["_id"];
		$temp[] = $rid;
		$rdetail = '<div style="display: block;"><ul class="list-unstyled">';

		$qid = $request_info['query_id'];
		// retrieve initial query details
		query_detail($qid, $rdetail, $cache_chromosomes, $cache_queries, $user_key);
		$rdetail = $rdetail.'</ul></div>';

		$rstate = $request_info['state'];
		$srv = get_server().'/download/?r='.$rid.'&key='.$user_key;
		$cusbutton = '<button type="button" id="downloadBtnBottom_'.$rid.'" class="btn btn-primary" disabled>&nbspDownload&nbsp</button>';;
		switch($request_info['command']) {
			case "get_regions":
				$cusbutton = '<button type="button" id="downloadBtnBottom_'.$rid.'" class="btn btn-primary" onclick=window.open("'.$srv.'","_blank")>&nbspDownload&nbsp</button>';
				break;
			case "count_regions":
				$cusbutton = '<button type="button" id="downloadBtnBottom_'.$rid.'" class="btn btn-primary" onclick = "count_regions(event)">View Count</button>';
				break;
			case "score_matrix":
				$cusbutton = '<button type="button" id="downloadBtnBottom_'.$rid.'" class="btn btn-primary" onclick=window.open("'.$srv.'","_blank")>&nbspDownload&nbsp</button>';
				break;
			case "get_experiments_by_query":
				$cusbutton = '<button type="button" id="downloadBtnBottom_'.$rid.'" class="btn btn-primary" onclick = "experiment_query(event)">&nbsp&nbsp&nbsp&nbsp&nbsp&nbspView&nbsp&nbsp&nbsp&nbsp&nbsp</button>';
				break;
		}

		if ($rstate == 'done') {
			$temp[] = $request_info['command'];
			$temp[] = $rdetail;
			$temp[] = substr($request_info['create_time'], 0, -7);
			$temp[] = substr($request_info['finish_time'], 0, -7);
			$temp[] = 'ready';
			$temp[] = $cusbutton;
		}
		else if ($rstate == 'failed') {
			$temp[] = $request_info['command'];
			$temp[] = $rdetail;
			$temp[] = substr($request_info['create_time'], 0, -7);
			$temp[] = '--';
			$temp[] = $rstate . ":<br />" . $request_info["message"];
			$temp[] = '<button type="button" id="downloadBtnBottom_'.$rid.'" class="btn btn-primary" disabled>&nbspDownload&nbsp</button>';;
		}
		else {
			$temp[] = $request_info['command'];
			$temp[] = $rdetail;
			$temp[] = substr($request_info['create_time'], 0, -7);
			$temp[] = '--';
			$temp[] = $rstate;
			$temp[] = '<button type="button" id="downloadBtnBottom_'.$rid.'" class="btn btn-primary" disabled>&nbspDownload&nbsp</button>';;
		}
		$rrow[] = $temp;
		$temp = [];
	}
	return $rrow;
}

function query_detail($qud, &$rdetail, &$cache_chromosomes, &$cache_queries, $user_key) {
	if (array_key_exists($qud, $cache_queries)) {
		$rdetail = $rdetail . $cache_queries[$qud];
		return;
	}

	$client = new IXR_Client(get_server());
	$chroms = [];

	if(!$client->query("info", $qud, $user_key)) {
		die('An error occurred - '.$client->getErrorCode().":".$client->getErrorMessage());
	}

	$response = $client->getResponse();
	check_error($response);

	$qtype = $response[1][0]['type'];
	$qdetail = json_decode($response[1][0]['args'], true);

	$rdetail = $rdetail.'<li><b>'.$qtype.'</b>';
	$rdetail = $rdetail.' (query '.$qud.')';
	$rdetail = $rdetail."  </li><ul>";

	// call server processing to check the size of the chromosomes
	$chroms_count = 0;

	if (isset($qdetail['genomes'])) {
		$genomes = $qdetail['genomes'];
		$length = count($genomes);

		for ($j = 0; $j < $length; $j++) {
			// get the genome chromosomes
			if (array_key_exists($genomes[$j], $cache_chromosomes)) {
				$chromosomes = $cache_chromosomes[$genomes[$j]];
			} else {
				if(!$client->query("chromosomes", $genomes[$j], $user_key)){
					die('An error occurred - '.$client->getErrorCode().":".$client->getErrorMessage());
				}
				$result = $client->getResponse();
				check_error($result);
				$chromosomes = $result[1];
				$cache_chromosomes[$genomes[$j]] = $chromosomes;
			}

			$chrlen = count($chromosomes);

			for ($k = 0; $k < $chrlen; $k++) {
				$chr = $chromosomes[$k][0];
				if (!in_array($chr, $chroms)) {
					$chroms[] = $chr;
				}
			}
		}
		$chroms_count = count($chroms);
	}

	foreach ($qdetail as $key => $value) {
		if ($key == 'qid_2') {
			$rdetail = $rdetail."</ul>";
			query_detail($value, $rdetail, $cache_chromosomes, $cache_queries, $user_key);
			continue;
		}

		if ($key == 'qid_1') {
			query_detail($value, $rdetail, $cache_chromosomes, $cache_queries, $user_key);
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

		$rdetail = $rdetail.'<li><b>'.$key.'</b>: ';
		if ($key == 'chromosomes'){
			if (count($value) == $chroms_count) {
				$rdetail = $rdetail.' all';
				continue;
			}
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
		$rdetail = $rdetail."</li>";
	}
	$cache_queries[$qud] = $rdetail;
}
?>