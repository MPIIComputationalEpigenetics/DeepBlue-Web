<?php

//include IXR Library for RPC-XML
require_once("../../lib/deepblue.IXR_Library.php");

/* Including URL for server and USER Key  */
require_once("../../lib/lib.php");

        $client = new IXR_Client($url);

        if(!$client->query("list_genomes", $user_key)){
            $genomeList[] = 'An error occured - '.$client->getErrorCode()." : ".$client->getErrorMessage();
        }
        else{
            $client->query("list_genomes", $user_key);
            $genomeList[] = $client->getResponse();
        }

        foreach($genomeList[0][1] as $genomes){
            $genomeIds[] = $genomes[1];
        }

        $client->query("list_annotations", $genomeIds, $user_key);
        $annotations[] = $client->getResponse();

        foreach($annotations[0][1] as $orderedData){

            $client->query("info", $orderedData[0], $user_key);
            $infoList[] = $client->getResponse();

        }

        $orderedDataStr = array();
        $tempArr = array();
        $tempAnStr = "";

        foreach($infoList as $orderedData){
            foreach ($orderedData as $key_2 => $value_2) {
                if($key_2 != 'okay'){

                    $tempArr[] = $value_2['_id'];
                    $tempArr[] = $value_2['name'];
                    $tempArr[] = $value_2['genome'];
                    $tempArr[] = $value_2['description'];
                    $tempAnStr.= "<div class='format-small'><b>Format : </b>".$value_2['format']."</div><br/>";

                    foreach ($value_2['extra_metadata'] as $key_3 => $value_3) {
                        $tempAnStr .= "<div class='format-small'><b>".$key_3."</b> : ".$value_3."</div><br/>";
                    }

                    $tempArr[] = $tempAnStr;

                }
            }

            array_push($orderedDataStr, $tempArr);
            $tempArr = array();
            $tempAnStr = "";

        }

        echo json_encode(array('data' => $orderedDataStr));

?>