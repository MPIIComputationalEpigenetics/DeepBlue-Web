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

/* URL to XML-RPC Server */
$url = 'http://deepblue.mpi-inf.mpg.de/xmlrpc';

/* USER Key */
$user_key = $_SESSION['user_key'];
//$user_key = 'yerIHJWYGA9odz5n';
?>