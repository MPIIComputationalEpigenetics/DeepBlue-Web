<?php

/**
*   DeepBlue Epigenomic Data Server
*   Copyright (c) 2014 Max Planck Institute for Computer Science.
*   All rights reserved.
*
*   File : init.php
*
*   Felipe Albrecht <felipe.albrecht@mpi-inf.mpg.de>
*   Umidjon Urunov <umidjon.urunov@mpi-inf.mpg.de>
*
*   Created : 25-08-2014
*/


//if (session_id() == '')
//    session_start();

require_once("../lib/config.php");

/* Deepblue Functions */
require_once("../lib/deepblue.functions.php");
$deepBlueObj = new Deepblue();

?>