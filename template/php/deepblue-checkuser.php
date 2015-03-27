<?php

/* DeepBlue Login */
/* Felipe Albrecht
   03.11.2014 */

print("POST");
print_r($_POST);

$email = $_POST['email'];
$password = $_POST['password'];

if ($email == "deepblue@mpi-inf.mpg.de" && $password == "mpi123") {
	session_start();
	$_SESSION['user_email'] = $email;
	$_SESSION['user_name'] = "User Name";
	$_SESSION['user_key'] = '1234';
	$_SESSION['time'] = time();
	header("Location:  ../dashboard.php");
	die();
} else {
	header("Location: ../index.php");
}
?>