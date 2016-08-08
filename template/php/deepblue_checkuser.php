<?php

/* DeepBlue Login */
/* Felipe Albrecht   03.11.2014 */
/* Odiete Obaro */


/* include IXR Library for RPC-XML */
require_once("../lib/process_login.php");

// start session
if (session_id() == '')
	session_start();

$remember = False;
$redirect = True;

if (isset($_POST['email']) && isset($_POST['password'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
}
else {
    $email = "anonymous.deepblue@mpi-inf.mpg.de";
    $password = "anonymous";
    $remember = True;
}

login($email, $password, $remember, $redirect);

?>