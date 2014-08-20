<?php

//include IXR Library for RPC-XML
require_once("../../lib/deepblue.IXR_Library.php");

/* Including URL for server and USER Key  */
require_once("../../lib/lib.php");

    /* Checking these parametrs exist or not */

    (!$genomF) ? $genomF = "" : $genomF;
    (!$emF) ? $emF = "" : $emF;

    $client = new IXR_Client($url);

    if(!$client->query("list_experiments", $genomF, $emF, "", "", "", $user_key)){
        $experimentList = 'An error occured - '.$client->getErrorCode()." : ".$client->getErrorMessage();
    }
    else{
        $client->query("list_experiments", $genomF, $emF, "", "", "", $user_key);
        $experimentList[] = $client->getResponse();
    }

    $counter = 0;

    foreach ($experimentList[0][1] as $value) {

        if($counter < 6){
            $client->query("info", $value[0], $user_key);
            $infoList[] = $client->getResponse();
            $counter++;
        }
        else break;
    }


    $orderedDataStr = array();
    $tempArr = array();
    $tempExpStr = "";

    foreach($infoList as $orderedData){
        foreach ($orderedData as $key_2 => $value_2) {

            if($key_2 != 'okay'){

                $tempArr[] = "<input type='checkbox' name='' value=''>";
                $tempArr[] = $value_2['_id'];
                $tempArr[] = $value_2['name'];

                $tempArr[] = $value_2['genome'];
                $tempArr[] = $value_2['epigenetic_mark'];
                $tempArr[] = $value_2['sample_id'];
                $tempArr[] = $value_2['technique'];
                $tempArr[] = $value_2['project'];

                foreach ($value_2['extra_metadata'] as $key_3 => $value_3) {
                    $tempExpStr .= '<b>'.$key_3.'</b> : '.$value_3.'<br/>';
                }

                $tempArr[] = $tempExpStr;

            }
        }
        array_push($orderedDataStr, $tempArr);
        $tempArr = array();
        $tempExpStr = "";
    }

    echo json_encode(array('data' => $orderedDataStr));


?>