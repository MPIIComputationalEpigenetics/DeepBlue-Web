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
$content = "";

echo $content;
if (isset($_FILES['file'])) {
	$tmp_filename = $_FILES['file']['tmp_name'];
}

// check if file is text
$file_type = mime_content_type($tmp_filename);
$parts = explode("/", $file_type);
if (!($parts[0] == "text")) {
    $response = ["error", "The selected file is not a text file".":".$parts[0]];
    echo json_encode($response);
    return;
}

// check if file is empty
$content = file_get_contents($tmp_filename);
if ($content == "") {
    $response = ["error", "The uploaded file is empty"];
    echo json_encode($response);
    return;
}

$response = ["okay", $content];
echo json_encode($response);
?>