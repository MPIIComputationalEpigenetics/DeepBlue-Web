<?php

/**
*   DeepBlue Epigenomic Data Server
*   Copyright (c) 2014 Max Planck Institute for Computer Science.
*   All rights reserved.
*
*   File : search_get_info_serve_processing.php
*
*   Felipe Albrecht <felipe.albrecht@mpi-inf.mpg.de>
*   Umidjon Urunov <umidjon.urunov@mpi-inf.mpg.de>
*
*   Created : 22-09-2014
*/

/* DeepBlue Configuration */
require_once("../../lib/lib.php");
require_once("../../lib/server_settings.php");
require_once("../../lib/deepblue.IXR_Library.php");
require_once("../../lib/error.php");

$client = new IXR_Client(get_server());

/* DeepBlue Class */
require_once("../../lib/deepblue.functions.php");
$deepBlueObj = new Deepblue();

if ((!isset($_GET)) || !isset($_GET["getId"])) {
	return;
}

$getId = $_GET["getId"];

if(!$client->query("info", $getId, $user_key)){
    die('An error occurred - '.$client->getErrorCode().":".$client->getErrorMessage());
}
else{
    $infoList[] = $client->getResponse();
    check_error($infoList);
}

$deepBlueObj->searchResultToJson($infoList[0][1]);

?>