<?php

/**
*   DeepBlue Epigenomic Data Server
*   Copyright (c) 2015 Max Planck Institute for Computer Science.
*   All rights reserved.
*
*   File : error.php
*
*   Felipe Albrecht <felipe.albrecht@mpi-inf.mpg.de>
*   Created : 20-07-2015
*/

function check_error($response) {
	$error = $response[0] == "error";
	if ($error) {
		echo json_encode(array("error" => $response[1]));
		die;
	}
}

?>