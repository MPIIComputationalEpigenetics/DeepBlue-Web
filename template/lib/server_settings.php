<?php

/**
*   DeepBlue Epigenomic Data Server
*   Copyright (c) 2014 Max Planck Institute for Computer Science.
*   All rights reserved.
*
*   File : server_settings.php
*
*   Felipe Albrecht <felipe.albrecht@mpi-inf.mpg.de>
*   Umidjon Urunov <umidjon.urunov@mpi-inf.mpg.de>
*	Obaro Odiete <s8obodie@stud.uni-saarland.de>
*
*   Created : 08-07-2015
*/

error_reporting(E_ALL);
ini_set('display_errors', 1);

/* URL to XML-RPC Server */
function get_server() {
	return 'http://srv-13-41:56573'; // 'https://deepblue.mpi-inf.mpg.de/xmlrpc'; geht nicht wegen https!!!
//	return 'http://localhost:31415/xmlrpc';
}

// Public and visible deepblue xmlrpc connector url
function get_public_url() {	
	return "https://deepblue.mpi-inf.mpg.de/xmlrpc";
}

?>