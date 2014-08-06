<?php
session_start();
//if (session_id() == '')
//    session_start();
require_once("lib/config.php");

//include IXR Library for RPC-XML
require_once("lib/deepblue.IXR_Library.php");

$url = 'http://deepblue.mpi-inf.mpg.de/xmlrpc';
$user_key = 'JBv8qZORmuNr7G6N';

        /* Checking these parametrs exist or not */
        
        (!$genomF) ? $genomF = "" : $genomF;
        (!$emF) ? $emF = "" : $emF;

        $client = new IXR_Client($url);
        
        if(!$client->query("list_experiments", $genomF, $emF, "", "", "", $user_key)){            
            $finalList = 'An error occured - '.$client->getErrorCode()." : ".$client->getErrorMessage();
        }
        else{
            $client->query("list_experiments", $genomF, $emF, "", "", "", $user_key);
            $finalList[] = $client->getResponse();
        }
        
        $_SESSION['finalResult'] = $finalList[0][1];

?>