<?php

/**
*   DeepBlue Epigenomic Data Server
*   Copyright (c) 2014 Max Planck Institute for Computer Science.
*   All rights reserved.
*
*   File : upload_file.php
*
*   Felipe Albrecht <felipe.albrecht@mpi-inf.mpg.de>
*	Obaro Odiete <s8obodie@stud.uni-saarland.de>
*
*   Created : 20-08-2015
*/


$data = "";
$status = "okay";
if (isset($_FILES['file'])) {
	$tmp_filename = $_FILES['file']['tmp_name'];
	$content = file_get_contents($tmp_filename);
}

// check if file is empty
if ($content == "") {
	$status = "error";
	$content = "The uploaded file is empty";
}


$response = [$status, $content];

echo json_encode($response);
?>