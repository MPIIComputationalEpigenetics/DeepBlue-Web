<?php

/**
*   DeepBlue Epigenomic Data Server
*   Copyright (c) 2014 Max Planck Institute for Computer Science.
*   All rights reserved.
*
*   File : get_regions_server_processing.php
*
*   Felipe Albrecht <felipe.albrecht@mpi-inf.mpg.de>
*
*   Created : 23-09-2014
*/

/* DeepBlue Configuration */
require_once("../../lib/lib.php");

/* include IXR Library for RPC-XML */
require_once("../../lib/deepblue.IXR_Library.php");
$client = new IXR_Client($url);

/* DeepBlue Class */
require_once("../../lib/deepblue.functions.php");
$deepBlueObj = new Deepblue();

if ((!isset($_GET)) || !isset($_GET["query_id"])) {
	return;
}

$query_id = $_GET["query_id"];
 if (isset($_GET["format"])) {
    $format = $_GET["format"];
 } else {
    $format = "CHROMOSOME,START,END";
 }

if(!$client->query("get_regions", $query_id, $format, $user_key)){
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
header('Content-Disposition: attachment; filename=deepblue_data_'.$query_id.".bed.gz");
header('Content-Transfer-Encoding: binary');
header('Expires: 0');
header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
header('Pragma: public');
header('Content-Length: ' . strlen($compress));
ob_clean();
flush();
echo $compress;
?>