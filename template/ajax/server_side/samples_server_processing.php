<?php

//include IXR Library for RPC-XML
require_once("../../lib/deepblue.IXR_Library.php");

$url = 'http://deepblue.mpi-inf.mpg.de/xmlrpc';
$user_key = 'JBv8qZORmuNr7G6N';

        /* Getting data from the server */

        $client = new IXR_Client($url);
        
        if(!$client->query("list_bio_sources", $user_key)){
            $bioSourceList[] = 'An error occured - '.$client->getErrorCode()." : ".$client->getErrorMessage();
        }
        else{
            $client->query("list_bio_sources", $user_key);
            $bioSourceList[] = $client->getResponse();
        }

        foreach($bioSourceList[0][1] as $bioSourceName){
            $bioNames[] = $bioSourceName[1];
        }
            
        $client->query("list_samples", $bioNames, (object) null, $user_key);
        $sampleList[] = $client->getResponse();

        $orderedDataStr = array();
        $tempArr = array();

        foreach ($sampleList[0][1] as $val_1) {
                
            $tempArr[] = $val_1[1]['_id'];
            $tempArr[] = $val_1[1]['bio_source_name'];
            $tempArr[] = $val_1[1]['description'];
            $tempArr[] = $val_1[1]['karyotype'];
            $tempArr[] = $val_1[1]['lineage'];
            $tempArr[] = $val_1[1]['organism'];
            $tempArr[] = $val_1[1]['sex'];
            $tempArr[] = $val_1[1]['source'];
            $tempArr[] = $val_1[1]['tier'];
            $tempArr[] = $val_1[1]['user'];


            array_push($orderedDataStr, $tempArr);
            $tempArr = array();

        }
        echo json_encode(array('data' => $orderedDataStr));


?>