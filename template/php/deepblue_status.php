<?php
	error_reporting(E_ALL);

    /* DeepBlue Configuration */
    require_once("lib/deepblue.IXR_Library.php");
    require_once("lib/server_settings.php");

    $client = new IXR_Client(get_server());
    if(!$client->query("echo", '')){
        header("Location:  ../offline.php");
    }
?>