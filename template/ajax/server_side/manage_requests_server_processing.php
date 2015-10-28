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
require_once("../../lib/server_settings.php");
require_once("../../lib/error.php");

/* include IXR Library for RPC-XML */
require_once("../../lib/deepblue.IXR_Library.php");
$client = new IXR_Client(get_server());

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
			check_error($result[0]);

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