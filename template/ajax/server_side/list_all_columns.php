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
	$colList[] = $client->getResponse();
	check_error($colList);
}

$i = 0;
$strList = [];
$pattern = '@type: \'code@';
foreach ($colList[0][1] as $column) {
	if (preg_match($pattern, $column[1]) == 0) {
		$strList[] = explode("'", $column[1])[1];		
	}
}

echo json_encode($strList);
?>