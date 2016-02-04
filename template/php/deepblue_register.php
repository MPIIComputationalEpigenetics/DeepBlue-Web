<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    require_once("d3-helpers.php");
    require_once("inc_ag3/config.inc.php");
    require_once("class.phpmailer.php");
    include_once("classes/class.navigation.php");

    $url = 'https://www.google.com/recaptcha/api/siteverify';

    $data = array('secret' => '6LdubBcTAAAAAGN9rei_K5ZbKEDw96HCEY2tQu5b',
        'response' => $_POST["g-recaptcha-response"],
        'remoteip' => $_SERVER['REMOTE_ADDR']
    );

    $options = array(
        'http' => array(
            'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
            'method'  => 'POST',
            'content' => http_build_query($data),
        ),
    );
    $context  = stream_context_create($options);
    $result = file_get_contents($url, false, $context);

    if ($result === FALSE) { /* Handle error */ }

    $response = json_decode($result, true);

    if (!$response["success"]) {
        print_r($response['error-codes']);
        return;
    }

    $mpi_env = WebDomain::getDetails("deepblue");

    $str = "New User: \n";
    foreach ($_POST as $key => $value) {
        $str .= $key . " " . $value . "\n";
    }

    $mail_host = $mpi_env["mail_host"];

    $mail = new phpmailer();
    $mail->CharSet  = 'UTF-8';
    $mail->From     = 'deepblue@mpi-inf.mpg.de';
    $mail->FromName = 'DeepBlue';
    $mail->Host     = $mail_host;
    $mail->Mailer   = "smtp";

    $subject = "New user";
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
            print "<h1> Thank you for your interest on DeepBlue Epigenomic Data Server.</h1>";
            print "We will check your information and create an account for you.";
    }
?>

