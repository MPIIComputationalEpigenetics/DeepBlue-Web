<?php

/**
*   DeepBlue Epigenomic Data Server
*   Copyright (c) 2014 Max Planck Institute for Computer Science.
*   All rights reserved.
*
*   File : lib.php
*
*   Felipe Albrecht <felipe.albrecht@mpi-inf.mpg.de>
*   Umidjon Urunov <umidjon.urunov@mpi-inf.mpg.de>
*	Obaro Odiete <s8obodie@stud.uni-saarland.de>
*
*   Created : 25-08-2014
*/

if (session_id() == '') {
	session_start();
}

error_reporting(E_ALL);
ini_set('display_errors', 1);

/* load server settings */
include_once("server_settings.php");

/* USER Key */
if (isset($_SESSION['user_key'])) {
	$user_key = $_SESSION['user_key'];
}
else {
	// user not properly logged in, authenticate user
	header("Location: ../php/deepblue_checkuser.php");
}

function get_user_key() {
	return $_SESSION['user_key'];
}


?>