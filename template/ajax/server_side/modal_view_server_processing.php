<?php

/**
*   DeepBlue Epigenomic Data Server
*   Copyright (c) 2014 Max Planck Institute for Computer Science.
*   All rights reserved.
*
*   File : modal_view_server_processing.php
*
*   Felipe Albrecht <felipe.albrecht@mpi-inf.mpg.de>
*   Umidjon Urunov <umidjon.urunov@mpi-inf.mpg.de>
*
*   Created : 15-09-2014
*/

/* DeepBlue Configuration */
require_once("../../lib/lib.php");

/* include IXR Library for RPC-XML */
require_once("../../lib/deepblue.IXR_Library.php");

/* DeepBlue Class */
require_once("../../lib/deepblue.functions.php");
$deepBlueObj = new Deepblue();


if(isset($_GET['sendData']) && isset($_GET['sendOptionVal'])){
	
	$recievedData = $_GET['sendData'];
	$recievedOptionVal = $_GET["sendOptionVal"];

	$recievedData = json_decode($recievedData, true);

	if($recievedOptionVal == 'experiment'){

		$genome = ($recievedData['genome'] !='' ) ? $recievedData['genome'] : "";
		$epigenetic_mark = ($recievedData['epigenetic_mark'] !='' ) ? $recievedData['epigenetic_mark'] : "";
		$sample = ($recievedData['sample'] !='' ) ? $recievedData['sample'] : "";
		$technique = ($recievedData['technique'] !='' ) ? $recievedData['technique'] : "";
		$project = ($recievedData['project'] !='' ) ? $recievedData['project'] : "";

		$deepBlueObj->experimentDataTable($type='', $title='', $genome, $epigenetic_mark, $sample, $technique, $project, 'workflow');

	}
	else{

		$genome = ($recievedData['genome'] !='' ) ? $recievedData['genome'] : "";
		$deepBlueObj->annotationDataTable($genome, 'workflow');
		
	}
}
else{

	$type = isset($_GET["types"]) ? $_GET["types"] : '';
	$title = isset($_GET["titles"]) ? $_GET["titles"] : '';

	$deepBlueObj->experimentDataTable($type, $title, $genome='', $epigenetic_mark='', $sample='', $technique='', $project='', 'modal_view');

}

?>