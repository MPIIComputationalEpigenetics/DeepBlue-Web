<?php

/* DeepBlue Login */
/* Felipe Albrecht   05.08.2015 */
/* Odiete Obaro */


/* include IXR Library for RPC-XML */
require_once("../lib/deepblue.IXR_Library.php");
require_once("../lib/server_settings.php");
require_once("../lib/error.php");

if (session_id() == '') {
	session_start();
}

$client = new IXR_Client(get_server);

$email = $_SESSION['user_email'];
$newemail = $_POST['email'];
$oldpassword = $_POST['oldpassword'];
$newpassword = $_POST['newpassword'];
$institution = $_POST['affiliation'];
$username = $_POST['username'];

if(!$client->query("user_auth", $email, $oldpassword)){
	die('An error occurred - '.$client->getErrorCode().":".$client->getErrorMessage());
}
$response = $client->getResponse();
check_error($response);

$code = $response[0];
$msg = $response[1];


$user_key = $msg;
if ($newpassword != '') {
	if(!$client->query("modify_user", "password", $newpassword, $user_key)) {
		die('An error occurred - '.$client->getErrorCode().":".$client->getErrorMessage());
	}
	$response = $client->getResponse();
	check_error($response);
}

if ($username != '') {
	if(!$client->query("modify_user", "name", $username, $user_key)) {
		die('An error occurred - '.$client->getErrorCode().":".$client->getErrorMessage());
	}
	$response = $client->getResponse();
	check_error($response);
	$_SESSION['user_name'] = $username;
}

if ($institution != '') {
	if(!$client->query("modify_user", "institution", $institution, $user_key)) {
		die('An error occurred - '.$client->getErrorCode().":".$client->getErrorMessage());
	}
	$response = $client->getResponse();
	check_error($response);
	$_SESSION['institution'] = $institution;
}

if ($newemail != '') {
	if(!$client->query("modify_user", "email", $newemail, $user_key)) {
		die('An error occurred - '.$client->getErrorCode().":".$client->getErrorMessage());
	}
	$response = $client->getResponse();
	check_error($response);
	$_SESSION['user_email'] = $newemail;
}

$response = ['okay', 'Profile edit successfully'];
echo json_encode($response);
?>