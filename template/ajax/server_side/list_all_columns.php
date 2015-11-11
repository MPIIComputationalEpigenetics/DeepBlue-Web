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
require_once("../../lib/error.php");

$client = new IXR_Client(get_server());

/* retrieve list of all experiments */
if(!$client->query("list_column_types", $user_key)){
	die('An error occurred - '.$client->getErrorCode().":".$client->getErrorMessage());
}
else{
	$colList = $client->getResponse();
	check_error($colList);
}

$i = 0;
$strList = [];
foreach ($colList[1] as $column) {
	$colID = $column[0];

	/* retrieve column details */
	if(!$client->query("info", $colID, $user_key)){
		die('An error occurred - '.$client->getErrorCode().":".$client->getErrorMessage());
	}
	else {
		$colDetail = $client->getResponse();
		check_error($colDetail);

		$strList[] = $colDetail[1][0]['name'];
	}
}

echo json_encode($strList);
?>
