<?php

/**
*   DeepBlue Epigenomic Data Server
*   Copyright (c) 2014 Max Planck Institute for Computer Science.
*   All rights reserved.
*
*   File : list_all_columns.php
*
*   Felipe Albrecht <felipe.albrecht@mpi-inf.mpg.de>
*   Obaro Odiete <s8obodie@stud.uni-saarland.de>
*
*   Created : 15-08-2015
*/

/* DeepBlue Configuration */
require_once("../../lib/lib.php");
require_once("../../lib/deepblue.IXR_Library.php");
require_once("../../lib/server_settings.php");

$client = new IXR_Client(get_server());

/* retrieve list of all experiments */
if(!$client->query("list_column_types", $user_key)){
	die('An error occurred - '.$client->getErrorCode().":".$client->getErrorMessage());
}
else{
	$colList[] = $client->getResponse();
	if ($colList[0][0] == "error") {
        echo json_encode($colList[0]);
        die();
	}
}

$i = 0;
$strList = [];
foreach ($colList[0][1] as $column) {
	$colID = $column[0];

	/* retrieve column details */
	if(!$client->query("info", $colID, $user_key)){
		die('An error occurred - '.$client->getErrorCode().":".$client->getErrorMessage());
	}
	else {
		$colDetail[] = $client->getResponse();
		if ($colDetail[0][0] == "error") {
            echo json_encode($colDetail[0]);
            die();
		}		
		$strList[] = $colDetail[0][1][0]['name'];

		$colDetail = "";
	}	
}

echo json_encode($strList);
?>
