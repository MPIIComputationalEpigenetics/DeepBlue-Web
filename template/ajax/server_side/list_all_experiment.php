<?php

/**
*   DeepBlue Epigenomic Data Server
*   Copyright (c) 2014 Max Planck Institute for Computer Science.
*   All rights reserved.
*
*   File : deepblue_list_in_use.php
*
*   Felipe Albrecht <felipe.albrecht@mpi-inf.mpg.de>
*   Obaro Odiete <s8obodie@stud.uni-saarland.de>
*
*   Created : 09-02-2015
*/

/* DeepBlue Configuration */
require_once("../../lib/lib.php");
require_once("../../lib/deepblue.IXR_Library.php");

$client = new IXR_Client($url);

/* retrieve list of all experiments */
if(!$client->query("list_experiments", '','','','','', $user_key)){
	die('An error occurred - '.$client->getErrorCode().":".$client->getErrorMessage());
}
else{
	$epList[] = $client->getResponse();
}
$lists['experiment'] = $epList[0][1];


$result = [];
$vocabs = array('experiment');

foreach ($vocabs as $vocab) {
	$j = 0;
	for ($i = 0; $i < count($lists[$vocab]); $i++) {
		$result[$vocab][$j]['label'] = $lists[$vocab][$i][1].' ('.$lists[$vocab][$i][0].')';
		$result[$vocab][$j]['value'] = $lists[$vocab][$i][1];
		$j = $j + 1;
	}
}

echo json_encode(array($result));
?>