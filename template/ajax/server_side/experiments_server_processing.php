<?php

//include IXR Library for RPC-XML
require_once("../../lib/deepblue.IXR_Library.php");

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

        
        $orderedDataStr = array();
        $tempArr = array();

        foreach($finalList[0][1] as $orderedData){

                $tempArr[] = "<input type='checkbox' name='' value=''>";
                $tempArr[] = $orderedData[0];
                $tempArr[] = $orderedData[1];

                array_push($orderedDataStr, $tempArr);

                $tempArr = array();
        }

        echo json_encode(array('data' => $orderedDataStr));


?>