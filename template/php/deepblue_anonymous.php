<?php

/* DeepBlue Login */
/* Felipe Albrecht   19.05.2014 */
/* Odiete Obaro */


/* include IXR Library for RPC-XML */
require_once("lib/process_login.php");

$email = "anonymous.deepblue@mpi-inf.mpg.de";
$password = "anonymous";
$remember = True;
$redirect = False;

login($email, $password, $remember, $redirect);
?>