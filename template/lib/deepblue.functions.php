<?php

/**
*   DeepBlue Epigenomic Data Server
*   Copyright (c) 2014 Max Planck Institute for Computer Science.
*   All rights reserved.
*
*   File : deepblue.functions.php
*
*   Felipe Albrecht <felipe.albrecht@mpi-inf.mpg.de>
*   Umidjon Urunov <umidjon.urunov@mpi-inf.mpg.de>
*
*   Created : 25-08-2014
*/


/* XML-RPC Library */
require_once("deepblue.IXR_Library.php");

class Main{

	private $privateUrl;
	private $privateUserKey;

	function __construct() {

		/* Including URL and User Key */

		require_once("lib.php");

		$this->privateUrl = $url;
		$this->privateUserKey = $user_key;

	}

	/* Getting API List into Array */

	public function getApiList(){

		$client = new IXR_Client($this->privateUrl);

		if(!$client->query('commands')){
		   die('An error occured - '.$client->getErrorCode()." : ".$client->getErrorMessage());
		}
		else{
		    $finalCommands[] = $client->getResponse();
		}

		return $finalCommands;

	}

    /* Displaying API List Completly */

    public function displayAPIList(){

    	$apiArray[] = $this->getApiList();

    	/* Collecting title and description */

		foreach($apiArray[0][0][1] as $keyOne => $valueOne){
		    $sortedArray[$valueOne['description'][0]] = $valueOne['description'][1];
		}

		/* Ordering by title */

		ksort($sortedArray);

		/* Counter for order number */
		$n = 1;

		foreach ($sortedArray as $sKeyOne => $sValueOne){
		    echo "<h3><b>".$sKeyOne." - ".$sValueOne."</b></h3><br/>";

		    	foreach($apiArray[0][0] as $tKeyOne => $tValueOne){

			    	if($tValueOne!='okay'){

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

		    	}
		        $n = 1;

		    }
		}
	}

}




?>
