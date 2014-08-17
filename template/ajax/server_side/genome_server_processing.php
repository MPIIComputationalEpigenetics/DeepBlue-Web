<?php

//include IXR Library for RPC-XML
require_once("../../lib/deepblue.IXR_Library.php");

$url = 'http://deepblue.mpi-inf.mpg.de/xmlrpc';
$user_key = 'JBv8qZORmuNr7G6N';

        /* Getting data from the server */

        $client = new IXR_Client($url);
        
        if(!$client->query("list_genomes", $user_key)){
            $genomeList[] = 'An error occured - '.$client->getErrorCode()." : ".$client->getErrorMessage();
        }
        else{
            $client->query("list_genomes", $user_key);
            $genomeList[] = $client->getResponse();
        }

        /* Ordering and generating json file for Datatables */
             
        $orderedDataStr = array();
        $tempArr = array();

        foreach($genomeList[0][1] as $orderedData){

                $tempArr[] = $orderedData[0];
                $tempArr[] = $orderedData[1];

                array_push($orderedDataStr, $tempArr);

                $tempArr = array();
        }

        echo json_encode(array('data' => $orderedDataStr));

?>