<?php

/* DeepBlue Login */
/* Felipe Albrecht   05.08.2015 */
/* Odiete Obaro */


/* include IXR Library for RPC-XML */
require_once("../lib/deepblue.IXR_Library.php");
require_once("../lib/server_settings.php");

if (session_id() == '') {
	session_start();
}

$url = get_server();
$client = new IXR_Client($url);

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
$code = $response[0];
$msg = $response[1];

if ($code == 'error') {
	echo '<script language="javascript">';
	echo 'alert("'.$msg.'");';
	echo 'window.location.href = "../dashboard.php#ajax/profile.php";';
	echo '</script>';
}
else {
	$user_key = $msg;
	if ($newpassword != '') {
		if(!$client->query("modify_user", "password", $newpassword, $user_key)) {
			die('An error occurred - '.$client->getErrorCode().":".$client->getErrorMessage());	
		}
		$response = $client->getResponse();
		if ($response[0] == 'error') {
            die('An error has occurred: '.$response[1]);
        }
	}

	if ($username != '') {	
		if(!$client->query("modify_user", "name", $username, $user_key)) {
			die('An error occurred - '.$client->getErrorCode().":".$client->getErrorMessage());	
		}
		$response = $client->getResponse();
		if ($response[0] == 'error') {
            die('An error has occurred: '.$response[1]);
        }
		$_SESSION['user_name'] = $username;
	}

	if ($institution != '') {
		if(!$client->query("modify_user", "institution", $institution, $user_key)) {
			die('An error occurred - '.$client->getErrorCode().":".$client->getErrorMessage());	
		}
		$response = $client->getResponse();
		if ($response[0] == 'error') {
            die('An error has occurred: '.$response[1]);
        }
		$_SESSION['institution'] = $institution;
	}
	
	if ($newemail != '') {
		if(!$client->query("modify_user", "email", $newemail, $user_key)) {
			die('An error occurred - '.$client->getErrorCode().":".$client->getErrorMessage());	
		}
		$response = $client->getResponse();
		if ($response[0] == 'error') {
            die('An error has occurred: '.$response[1]);
        }
		$_SESSION['user_email'] = $newemail;
	}
	header("Location:  ../dashboard.php#ajax/profile.php");
}
?>