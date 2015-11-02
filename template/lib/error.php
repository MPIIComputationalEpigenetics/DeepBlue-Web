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
	if ($response[0] == "error") {
		$error_msg = $response[1];
		if (empty($error_msg)) {
			echo json_encode(array("error" => "Unknown error.", "code" => "unknown", "message" => "An unknown error happened in DeepBlue. Please, inform us (deepblue@mpi-inf.mpg.de about this error. Thank you for the comprehension."));
			die;
		}
		echo "is in\n";
		list($code, $msg) = explode(":", $error_msg);
		echo json_encode(array("error" => $response[1], "code" => $code, "message" => $msg));
		die;
	}
}

?>