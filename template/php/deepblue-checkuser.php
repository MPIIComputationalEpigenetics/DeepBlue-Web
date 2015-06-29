<?php

/* DeepBlue Login */
/* Felipe Albrecht   03.11.2014 */
/* Odiete Obaro */

/* include IXR Library for RPC-XML */
require_once("../lib/deepblue.IXR_Library.php");
include("../lib/lib.php");

//$url = 'http://deepblue.mpi-inf.mpg.de/xmlrpc';
$client = new IXR_Client($url);

$email = $_POST['email'];
$password = $_POST['password'];

if(!$client->query("user_auth", $email, $password)){
	die('An error occurred - '.$client->getErrorCode().":".$client->getErrorMessage());	
}

$response = $client->getResponse();

if ($response[0] == 'error') {
	header("Location: ../index.php");	
}
else {
	$user_key = $response[1];
	if(!$client->query("echo", $user_key)) {
		die('An error occurred - '.$client->getErrorCode().":".$client->getErrorMessage());	
	}

	$response = $client->getResponse();
	$user_name = $response[1];

	session_start();
	$_SESSION['user_email'] = $email;
	$_SESSION['user_name'] = substr($user_name, 29);
	$_SESSION['user_key'] = $user_key;
	$_SESSION['time'] = time();
	header("Location:  ../dashboard.php");
}

?>