<?php

//include IXR Library for RPC-XML
require_once("../../lib/deepblue.IXR_Library.php");

/* Including URL for server and USER Key  */
require_once("../../lib/lib.php");

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
        $tempStr = "";

        foreach ($sampleList[0][1] as $val_1) {

            $tempArr[] = $val_1[1]['_id'];
            $tempArr[] = $val_1[1]['bio_source_name'];
            $tempArr[] = $val_1[1]['description'];

            $tempStr .= '<b>Karyotype</b> : '.$val_1[1]['karyotype'].'<br/>';
            $tempStr .= '<b>Lineage</b> : '.$val_1[1]['lineage'].'<br/>';
            $tempStr .= '<b>Organism</b> : '.$val_1[1]['organism'].'<br/>';
            $tempStr .= '<b>Sex</b>: '.$val_1[1]['sex'].'<br/>';
            $tempStr .= '<b>Source</b> : '.$val_1[1]['source'].'<br/>';
            $tempStr .= '<b>Tier</b> : '.$val_1[1]['tier'].'<br/>';
            $tempStr .= '<b>User</b> : '.$val_1[1]['user'];

            $tempArr[] = $tempStr;

            array_push($orderedDataStr, $tempArr);
            $tempArr = array();
            $tempStr = "";

        }
        echo json_encode(array('data' => $orderedDataStr));


?>