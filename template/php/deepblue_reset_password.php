<?php
	error_reporting(E_ALL);

	require_once("d3-helpers.php");
	require_once("inc_ag3/config.inc.php");
	require_once("class.phpmailer.php");
	include_once("classes/class.navigation.php");

	$mpi_env = WebDomain::getDetails("deepblue");

	$str = "New User: \n";
	foreach ($_POST as $key => $value) {
		$str .= $key . " " . $value . "\n";
	}

	$mail_host = $mpi_env["mail_host"];

    $mail = new phpmailer();

    $mail->From     = 'deepblue@mpi-inf.mpg.de';
    $mail->FromName = 'DeepBlue';
    $mail->Host     = $mail_host;
    $mail->Mailer   = "smtp";

    $subject = "Reset Password";
    $body = $str;

    $mail->AddAddress('deepblue@mpi-inf.mpg.de', 'DeepBlue');
    //$mail->AddBCC("felipe.albrecht@gmail.com", "Felipe Albrecht");
    $mail->Subject = $subject;
    $mail->Body    = $body;
    $mail->WordWrap = 80;

    if(!$mail->Send())
    {
            print "There was an error sending the message";
    } else {
    		print "<h1> Thank you for using DeepBlue Epigenomic Data Server.</h1>";
			print "We will check your information and reset your password.";
    }