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
	header("Location: ../index.php?login_attempt=1");	
}
else {
	$user_key = $response[1];
	if(!$client->query("info", "me", $user_key)) {
		die('An error occurred - '.$client->getErrorCode().":".$client->getErrorMessage());	
	}

	$response = $client->getResponse();
	$user_details = $response[1][0];
	
	session_start();

	$_SESSION['user_email'] = $user_details['email'];
	$_SESSION['user_name'] = $user_details['name'];
	$_SESSION['user_key'] = $user_key;
	$_SESSION['institution'] = $user_details['institution'];
	$_SESSION['type'] = $user_details['type'];
	$_SESSION['time'] = time();
	header("Location:  ../dashboard.php");
}

?>