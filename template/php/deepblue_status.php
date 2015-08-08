<?php
	error_reporting(E_ALL);

    /* DeepBlue Configuration */
    require_once("lib/deepblue.IXR_Library.php");
    require_once("lib/server_settings.php");

    $client = new IXR_Client(get_server());
    if(!$client->query("echo", '')){

    	// send offline message to deepblue admin
    	
		require_once("d3-helpers.php");
		require_once("inc_ag3/config.inc.php");
		require_once("class.phpmailer.php");
		include_once("classes/class.navigation.php");

		$mpi_env = WebDomain::getDetails("deepblue");
		$mail_host = $mpi_env["mail_host"];

	    $mail = new phpmailer();

	    $mail->From     = 'deepblue@mpi-inf.mpg.de';
	    $mail->FromName = 'DeepBlue';
	    $mail->Host     = $mail_host;
	    $mail->Mailer   = "smtp";

	    $subject = "DeepBlue Server Offline";
	    $body = "The deepblue server is unreachable and may be offline.";

	    $mail->AddAddress('deepblue@mpi-inf.mpg.de', 'DeepBlue');
	    $mail->Subject = $subject;
	    $mail->Body    = $body;
	    $mail->WordWrap = 80;

	    if(!$mail->Send())
	    {
            print "There was an error sending the message";
	    } else {
    		print "<h1> Thank you for your interest on DeepBlue Epigenomic Data Server.</h1>";
			print "The deepblue team are working to get the server back online.";
	    }
		
    	// redirect to offline page
        header("Location:  ../offline.php");
    }
?>