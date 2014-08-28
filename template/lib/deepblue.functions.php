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

		return $finalCommands[0][1];

	}

    /* Displaying API List Completly */

    public function displayAPIList(){

    	/* Collecting title and description */

		foreach($this->getApiList() as $keyOne => $valueOne){
            $sortedArray[$valueOne['description'][0]] = $valueOne['description'][1];
        }

		/* Ordering by title */

		ksort($sortedArray);

		/* Counter for order number */
		$n = 1;

		echo "<div class='api-title'>Table of contents</div>";

		foreach ($sortedArray as $sKeyOne => $sValueOne){

		    echo "<a onclick=\"$(function() { $(document).scrollTop( $('#api-". str_replace(' ', '-', strtolower($sKeyOne))."').offset().top ); });\" href=\"javascript:void(0);\"><h3><b>$sKeyOne</b></a> - <b><$sValueOne; ?></b></h3>";

		    foreach($this->getApiList() as $tKeyOne => $tValueOne){
			    if($sKeyOne == $tValueOne['description'][0]){
                    echo "<div class='api-description-listing'>".$n." )\n";
                    echo "<a onclick=\"$(function() { $(document).scrollTop($('#api-". str_replace(' ', '-', strtolower($tKeyOne))."').offset().top ); });\" href='javascript:void(0);'>$tKeyOne</a>";

                    //href='#".str_replace(' ', '-', strtolower($tKeyOne))."'>".$tKeyOne."</a> — ".$tValueOne['description'][2]."</div>";
                    //

                    // $(document).scrollTop( $('str_replace(' ', '-', strtolower($tKeyOne)').offset().top );

                    ?>

					<div class="marginDiv"></div>

			        <?php
			        $n++;
			    }
		    }
		    $n = 1;
		}

		foreach ($sortedArray as $sKeyOne => $sValueOne){
			echo "<div class='api-blocks'>
<<<<<<< HEAD
				  <div class='api-block-header' id='".str_replace(' ', '-', strtolower($sKeyOne))."'>".$sValueOne."</div>";
=======
				  <div class='api-block-header' id='api-".str_replace(' ', '-', strtolower($sKeyOne))."'>".$sValueOne."</div>";
>>>>>>> b81d8bb5e5fab756406abf9e107796a1cd3a9429

			foreach($this->getApiList() as $tKeyOne => $tValueOne){
				if($sKeyOne == $tValueOne['description'][0]){
					//print_r($tValueOne);
				?>

				<div class="marginDiv"></div>
                    <div class='row'>
                    <?php
                        echo "<h3 id='api-".str_replace(' ', '-', strtolower($tKeyOne))."'>$tKeyOne</h3>"
                    ?>
                        <div class='span10'>
                        	<?php echo $tValueOne['description'][2];?>
                        </div>
                        <div class='span10 apiSource'>
                            <?php
                            $paramSet = "";
                            $paramTypeSet = array();

                            foreach ($tValueOne['parameters'] as $param){
                                $paramSet = $paramSet.$param[0].", ";
                                $paramTypeSet[] = $param[1];
                            }

                            $paramSet = substr($paramSet, 0, -2);
                            echo "<code class='apiRCode'>".$tKeyOne."</code> <code class='apiBCode'>( ".$paramSet." ) </code>";

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
                                foreach ($tValueOne['results'] as $result){
                                    echo "<li><code class='apiBCode'>".$result[0]."</code><code class='apiGCode'>(".$result[1].")</code> - ".$result[3]."</li>";
                                }

                            ?>
                            </ul>
                        </div>
                        <div class='span12'>
                            <ul><li><code class='apiVCode'>['error', error_message]</code> — Error. Verify the error message.</li></ul>
                        </div>
                    </div>

				<?php
				}
			}
			echo "</div>";
		}

	}

	/* Getting DeepBlue Server Version */

    public function getServerVersion(){

        $client = new IXR_Client($this->privateUrl);

        if(!$client->query('echo', $this->privateUrl)){
            die('An error occured - '.$client->getErrorCode()." : ".$client->getErrorMessage());
        }
        else{
            $serVer[] = $client->getResponse();
            $finalReturn = substr($serVer[0][1], 0, -21);
        }

        return $finalReturn;

    }


}




?>
