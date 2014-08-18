<?php

//include IXR Library for RPC-XML
require_once("../../lib/deepblue.IXR_Library.php");

/* Including URL for server and USER Key  */
require_once("../../lib/lib.php");

        /* Getting data from the server */

        $client = new IXR_Client($url);

        if(!$client->query("list_projects", $user_key)){
            $projectList[] = 'An error occured - '.$client->getErrorCode()." : ".$client->getErrorMessage();
        }
        else{
            $client->query("list_projects", $user_key);
            $projectList[] = $client->getResponse();
        }

        /* Ordering and generating json file for Datatables */

        $orderedDataStr = array();
        $tempArr = array();

        foreach($projectList[0][1] as $orderedData){

                $tempArr[] = $orderedData[0];
                $tempArr[] = $orderedData[1];

                array_push($orderedDataStr, $tempArr);

                $tempArr = array();
        }

        echo json_encode(array('data' => $orderedDataStr));


?>