<?php

//include IXR Library for RPC-XML
require_once("../../lib/deepblue.IXR_Library.php");

/* Including URL for server and USER Key  */
require_once("../../lib/lib.php");

        /* Getting data from the server */

        $client = new IXR_Client($url);

        if(!$client->query("list_genomes", $user_key)){
            $genomeList[] = 'An error occured - '.$client->getErrorCode()." : ".$client->getErrorMessage();
        }
        else{
            $client->query("list_genomes", $user_key);
            $genomeList[] = $client->getResponse();
        }

        foreach ($genomeList[0][1] as $value) {
            $client->query("info", $value[0], $user_key);
            $infoList[] = $client->getResponse();
        }

        /* Ordering and generating json file for Datatables */


        $orderedDataStr = array();
        $tempArr = array();

        foreach($infoList as $orderedData){
            foreach ($orderedData as $key_2 => $value_2) {
                if($key_2 != 'okay'){
                    $tempArr[] = $value_2['_id'];
                    $tempArr[] = $value_2['name'];
                    $tempArr[] = $value_2['description'];
                }
            }

            array_push($orderedDataStr, $tempArr);
            $tempArr = array();
        }

        echo json_encode(array('data' => $orderedDataStr));

?>