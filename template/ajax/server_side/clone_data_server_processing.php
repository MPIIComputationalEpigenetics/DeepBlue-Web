<?php

/**
*   DeepBlue Epigenomic Data Server
*   Copyright (c) 2014 Max Planck Institute for Computer Science.
*   All rights reserved.
*
*   File : search_get_info_serve_processing.php
*
*   Felipe Albrecht <felipe.albrecht@mpi-inf.mpg.de>
*   Obaro Odiete <s8obodie@stud.uni-saarland.de>
*
*   Created : 28-12-2014
*/

/* DeepBlue Configuration */
require_once("../../lib/lib.php");

/* include IXR Library for RPC-XML */
require_once("../../lib/deepblue.IXR_Library.php");
$client = new IXR_Client($url);

if ((!isset($_GET)) || !isset($_GET["data"])) {
	return;
}

$data = $_GET["data"];

$id = $data["id"];
$name = $data["experiment"];
$epigenetic_mark = $data["epigenetic_mark"];
$sample = $data["sample"];
$technique = $data["technique"];
$project = $data["project"];
$description = $data["description"];
$format = implode(',', array_values($data["Columns"]));
$extra_metadata = (Object)Null;//$data["Extra Metadata"];

if(!$client->query("clone_dataset", $id, $name, $epigenetic_mark, $sample, $technique, $project, $description, $format, $extra_metadata, $user_key)){
	die('An error occurred - '.$client->getErrorCode().":".$client->getErrorMessage());
}
else{
	$clone[] = $client->getResponse();
}

echo json_encode($clone);
?>