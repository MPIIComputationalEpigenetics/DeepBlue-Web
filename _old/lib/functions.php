<?php

// Including XML-RPC Library

include 'IXR_Library.php';

class Main{
    
    /* XML-RPC Config */
    
    private $url = 'http://deepblue.mpi-inf.mpg.de/xmlrpc';
    private $user_key = 'JBv8qZORmuNr7G6N';

    /* Changing content function */
    
    public function changeContent($page){
        
        if(isset($page)){
            if(file_exists("pages/".$page.".php")){
                if($page){
                    if($_GET['id']){ include('pages/detailedExp.php'); }
                    else{ include('pages/'.$page.'.php'); }
                }
            }
            else{
                include('pages/404.php');
            }
        }
        else{ include('pages/main.php');}
        
    }
    
    
    /* Getting DeepBlue Server Version */
    
    public function getServerVersion(){
                
        $client = new IXR_Client($this->url);
        
        if(!$client->query('echo', $this->user_key)){            
            $finalReturn = 'An error occured - '.$client->getErrorCode()." : ".$client->getErrorMessage();
        }
        else{
            $client->query("echo", $this->user_key); 
            $serVer[] = $client->getResponse();
            $finalReturn = substr($serVer[0][1], 0, -26);
        }
        
        return $finalReturn;
        
    }
    
    // Getting API List
    
    public function getApiList(){
        
        $client = new IXR_Client($this->url);
        
        if(!$client->query('commands')){
            $finalCommands[] = 'An error occured - '.$client->getErrorCode()." : ".$client->getErrorMessage();
        }
        else{
            $client->query("commands");
            $finalCommands[] = $client->getResponse();
        }
        
        return $finalCommands;
        
    }
    
    // Displaying API List Completly
    
    public function displayAPIList(){
        
        $apiArray[] = $this->getApiList();
                
                // Collecting title and description
                
                foreach($apiArray[0][0][1] as $keyOne => $valueOne){
                    $sortedArray[$valueOne['description'][0]] = $valueOne['description'][1];
                }
                
               /* Ordering by title*/
                
                ksort($sortedArray);
                
                /* Counter for order number */
                
                $n = 1;
                
                foreach ($sortedArray as $sKeyOne => $sValueOne){
                    echo "<h3><b>".$sKeyOne." - ".$sValueOne."</b></h3><br/>";
                    
                    foreach($apiArray[0][0] as $tKeyOne => $tValueOne){
                        foreach ($tValueOne as $tKeyTwo => $tValueTwo){
                            if($sKeyOne == $tValueTwo['description'][0]){
                                
                                echo $n." ) <a class='pointerH' id='".$tKeyTwo."'>".$tKeyTwo."</a> - ".$tValueTwo['description'][2]."<br/>";?>
                                    
                                    <div class="marginDiv"></div>
                                    <div class='toggleDiv' id='div_<?php echo $tKeyTwo; ?>'>
                                        <div class='row'>
                                            <div class='span10 apiTitle'>
                                                <?php echo $tKeyTwo;?>
                                            </div>
                                        </div>
                                        <div class='row'>
                                            <div class='span10'>
                                                <?php echo $tValueTwo['description'][2];?>
                                            </div>
                                            <div class='span10 apiSource'>
                                                <?php
                                                    $paramSet = "";
                                                    $paramTypeSet = array();
                                                    
                                                    foreach ($tValueTwo['parameters'] as $param){
                                                        $paramSet = $paramSet.$param[0].", ";
                                                        $paramTypeSet[] = $param[1];
                                                    }
                                                    
                                                    $paramSet = substr($paramSet, 0, -2);
                                                    echo "<code class='apiRCode'>".$tKeyTwo."</code> <code class='apiBCode'>( ".$paramSet." ) </code>";
                                                    
                                                ?>
                                            </div>
                                        </div>
                                        <div class='row'>
                                            <div class='span12 apiSubTitle'>
                                                Parametrs:
                                            </div>
                                        </div>
                                        <div class='row'>
                                            <div class='span12'>
                                                <ul>
                                                    
                                                    <?php
                                                    $pieces = explode(",", $paramSet);
                                                    $tcounter = 0;
                                                    foreach($pieces as $paramTwo){
                                                        echo "<li><code class='apiBCode'>".$paramTwo."</code><code class='apiGCode'>(".$paramTypeSet[$tcounter].")</code></li>";
                                                        $tcounter++;
                                                    }
                                                    ?>
                                                </ul>
                                            </div>
                                        </div>

                                        <div class='row'>
                                            <div class='span12 apiSubTitle'>
                                                Response:
                                            </div>
                                        </div>
                                        <div class='row'>
                                            <div class='span12'>
                                                <ul><li><code class='apiVCode'>['okay', result]</code> — result consists of</li></ul>
                                            </div>
                                            <div class='span12'>
                                                <ul class='apiUlMargin'>
                                                    <?php
                                                    foreach ($tValueTwo['results'] as $result){
                                                        echo "<li><code class='apiBCode'>".$result[0]."</code><code class='apiGCode'>(".$result[1].")</code> - ".$result[3]."</li>";
                                                    }
                                                    
                                                    ?>
                                                </ul>
                                            </div>
                                            <div class='span12'>
                                                <ul><li><code class='apiVCode'>['error', error_message]</code> — Error. Verify the error message.</li></ul>
                                            </div>
                                        </div>
                                    </div>
                                    <script>$('#<?php echo $tKeyTwo;?>').click(function() { $('#div_<?php echo $tKeyTwo;?>').toggle('slow'); });</script>
                                <?php $n++;
                            }
                        }
                        $n = 1;
                        
                    }
                }
        
    }
    
    /* Getting list of all expriments */
    
    public function getAllExpList($genomF, $emF){
        
        /* Checking these parametrs exist or not */
        
        (!$genomF) ? $genomF = "" : $genomF;
        (!$emF) ? $emF = "" : $emF;
        
        $client = new IXR_Client($this->url);
        
        if(!$client->query("list_experiments", $genomF, $emF, "", "", "", $this->user_key)){            
            $finalList = 'An error occured - '.$client->getErrorCode()." : ".$client->getErrorMessage();
        }
        else{
            $client->query("list_experiments", $genomF, $emF, "", "", "", $this->user_key);
            $finalList[] = $client->getResponse();
        }
        
        return $finalList[0][1];
        
    }
    
    /* Getting all GENOME List */
    
    public function getAllGenomeList(){
        
        $client = new IXR_Client($this->url);
        
        if(!$client->query('list_genomes', $this->user_key)){
            $finalList = 'An error occured - '.$client->getErrorCode()." : ".$client->getErrorMessage();
        }
        else{
            $client->query("list_genomes", $this->user_key);
            $finalList[] = $client->getResponse();
        }
        
        return $finalList[0][1];

    }
    
    /* Getting all EPIGENETIC MARKS List */
    
    public function getAllEMList(){
        
        $client = new IXR_Client($this->url);
        
        if(!$client->query('list_epigenetic_marks', $this->user_key)){
            $finalList = 'An error occured - '.$client->getErrorCode()." : ".$client->getErrorMessage();
        }
        else{
            $client->query('list_epigenetic_marks', $this->user_key);
            $finalList[] = $client->getResponse();
        }
        
        return $finalList[0][1];
        
    }
    
    public function getExpDetailed($id){
        
        $client = new IXR_Client($this->url);
        
        if(!$client->query('info', $id, $this->user_key)){
            $finalList = 'An error occured - '.$client->getErrorCode()." : ".$client->getErrorMessage();
        }
        else{
            $client->query('info', $id, $this->user_key);
            $finalList[] = $client->getResponse();
        }
        
        return $finalList[0][1];
        
    }
    
}