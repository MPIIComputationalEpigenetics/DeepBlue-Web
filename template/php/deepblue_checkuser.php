<?php

/* DeepBlue Login */
/* Felipe Albrecht   03.11.2014 */
/* Odiete Obaro */


/* include IXR Library for RPC-XML */
require_once("../lib/deepblue.IXR_Library.php");
require_once("../lib/server_settings.php");

// start session
session_start();

$url = get_server();
$client = new IXR_Client($url);

$remember = False;

if (isset($_POST['email']) && isset($_POST['password'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
}
else {
    $email = "anonymous.deepblue@mpi-inf.mpg.de";
    $password = "anonymous";
    $remember = True;
}

if(!$client->query("user_auth", $email, $password)){
	die('An error occurred - '.$client->getErrorCode().":".$client->getErrorMessage());
}

$response = $client->getResponse();
if ($response[0] == 'error') {

    $explode_result = explode(":", $response[1]);
    if (count($explode_result) == 2) {
        $_SESSION['login_attempt'] = $explode_result[1];
    } else {
        $_SESSION['login_attempt'] = $response[1];
    }
	header("Location: ../index.php");
}
else {
	$user_key = $response[1];
	if(!$client->query("info", "me", $user_key)) {
		die('An error occurred - '.$client->getErrorCode().":".$client->getErrorMessage());
	}

	$response = $client->getResponse();
    if ($response[0] == 'error') {
        $explode_result = explode(":", $response[1]);
        if (count($explode_result) == 2) {
            $_SESSION['login_attempt'] = $explode_result[1];
        } else {
            $_SESSION['login_attempt'] = $response[1];
        }
        header("Location: ../index.php");
        die();
    }

	$user_details = $response[1][0];

	$_SESSION['user_email'] = $user_details['email'];
	$_SESSION['user_name'] = $user_details['name'];
	$_SESSION['user_key'] = $user_key;
	$_SESSION['institution'] = $user_details['institution'];
	$_SESSION['type'] = $user_details['type'];
    $_SESSION['permission'] = $user_details['permission_level'];
    $_SESSION['time'] = time();
	$_SESSION['level'] = get_level_code($user_details['permission_level']);

    $remember = isset($_POST['remember']) || $remember;

    // get cookies for tutorial tour settings
    $_SESSION['tour'] = isset($_COOKIE['tour']) ? $_COOKIE['tour'] : "true";

    $cookie_val = '';
    if (isset($_COOKIE['PHPSESSID'])) {
        $cookie_val = $_COOKIE['PHPSESSID'];
    }

    if ($remember) {
        setcookie('PHPSESSID',$cookie_val, time() + (86400 * 365), '/');
    } else {
        setcookie('PHPSESSID',$cookie_val, 0, '/' );
    }

	header("Location:  ../dashboard.php");
}

function get_level_code($permission) {
	switch ($permission) {
		case "ADMIN":
			return 0;
		case "INCLUDE_COLLECTION_TERMS":
			return 10;
		case "INCLUDE_EXPERIMENTS":
			return 20;
		case "INCLUDE ANNOTATIONS":
			return 30;
		case "GET_DATA":
			return 40;
		case "LIST_COLLECTIONS":
			return 50;
		case "NONE":
			return 1000;
		case "NOT_SET":
			return 10000;
	}
}

?>