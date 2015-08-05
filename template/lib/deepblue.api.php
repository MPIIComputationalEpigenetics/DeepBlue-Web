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
*   Obaro Odiete <s8obodie@stud.uni-saarland.de>
*
*   Created : 07-07-2015
*/

/* XML-RPC Library */

require_once("deepblue.IXR_Library.php");

error_reporting(E_ALL);
ini_set('display_errors', 1);


class DeepblueApi{

	private $privateUrl;
    private $client;

	function __construct() {
        include_once("server_settings.php");
		$this->privateUrl = get_server();
        $this->client = new IXR_Client($this->privateUrl);
	}

	/* Getting API List into Array */

	public function getApiList(){

		//$client = new IXR_Client($this->privateUrl);

		if(!$this->client->query('commands')){
		   die('An error occured - '.$this->client->getErrorCode()." : ".$this->client->getErrorMessage());
		}
		else{
		    $finalCommands[] = $this->client->getResponse();
		}
		return $finalCommands[0][1];
	}

    /* Displaying API List Completly */

    public function displayAPIList(){

    	/* Collecting title and description */

        $commands = $this->getApiList();

		foreach($commands as $keyOne => $valueOne){
            $sortedArray[$valueOne['description'][0]] = $valueOne['description'][1];
        }

		/* Ordering by title */

		ksort($sortedArray);

		/* Counter for order number */
		$n = 1;

		echo "<div class='api-title'>Table of contents</div>";

		foreach ($sortedArray as $sKeyOne => $sValueOne){
            $norm_name = str_replace(' ', '-', strtolower($sKeyOne));

    	    echo "<a onclick=\"$(function() { $(document).scrollTop( $('#api-". $norm_name."').offset().top ); location.href = 'http://localhost/api.php#api-".$norm_name."'});\" href=\"javascript:void(0);\"><h3><b>$sKeyOne</b></a> — $sValueOne</h3>";

		    foreach($commands as $tKeyOne => $tValueOne){
			    if($sKeyOne == $tValueOne['description'][0]) {

                    $norm_name2 = str_replace(' ', '-', strtolower($tKeyOne));
                    echo "<div class='api-description-listing'>".$n." )\n";
                    echo "<a onclick=\"$(function() { $(document).scrollTop($('#api-". $norm_name2."').offset().top ); location.href = 'http://localhost/api.php#api-".$norm_name2."'});\" href='javascript:void(0);'>$tKeyOne</a> — ".$tValueOne['description'][2];
                    $n++;
                }
                ?>
				<div class="marginDiv"></div>
			<?php
		    }
		    $n = 1;
		}

		foreach ($sortedArray as $sKeyOne => $sValueOne){
			echo "<div class='api-panel'>
				  <div class='api-panel-header' id='api-".str_replace(' ', '-', strtolower($sKeyOne))."'>".$sValueOne."</div>";

			foreach($commands as $tKeyOne => $tValueOne){
				if($sKeyOne == $tValueOne['description'][0]){
				?>

				<div class="marginDiv"></div>
                    <div class='row'>
                    <?php
                        echo "<h3 id='api-".str_replace(' ', '-', strtolower($tKeyOne))."'>$tKeyOne</h3>";
                    ?>
                        <div class='api-description'>
                        	<?php echo $tValueOne['description'][2];?>
                        </div>
                        <div class='api-header'>
                            <?php
                            $paramSet = "";
                            $paramTypeSet = array();

                            foreach ($tValueOne['parameters'] as $param){
                                $paramSet = $paramSet.$param[0].", ";
                                $paramTypeSet[] = $param[1];
                            }

                            $paramSet = substr($paramSet, 0, -2);
                            echo "<code class='operation-name'>".$tKeyOne."</code> <code class='operation-parameter'>( ".$paramSet." ) </code>";

                            ?>
                        </div>
                    </div>

					<div class='row'>
                        <h4>Parameters:</h4>
                    </div>
                    <div class='api-parameters row'>
                        <div class='span12'>
                            <ul>
                                <?php
                                foreach($tValueOne['parameters'] as $paramTwo){
                                    echo "<li><code class='operation-parameter'>".$paramTwo[0]."</code><code class='operation-type'>(".$paramTwo[1].")</code> — ".$paramTwo[3]."</li>";
                                }
                                ?>
                            </ul>
                        </div>
                    </div>

                    <div class='row'>
                        <h4>Response:</h4>
                    </div>
                    <div class='api-responses row'>
                        <div class='span12'>
                            <ul><li><code class='api-python-code'>['okay', result]</code> — result consists of</li></ul>
                        </div>
                        <div class='span12'>
                            <ul class='apiLeftMargin'>
                            <?php
                                foreach ($tValueOne['results'] as $result){
                                    echo "<li><code class='operation-parameter'>".$result[0]."</code><code class='operation-type'>(".$result[1].")</code> — ".$result[3]."</li>";
                                }

                            ?>
                            </ul>
                        </div>
                        <div class='span12'>
                            <ul><li><code class='api-python-code'>['error', error_message]</code> — Error. Verify the error message.</li></ul>
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

        //$client = new IXR_Client($this->privateUrl);
        if(!$this->client->query('echo', $this->privateUrl)){
            die('An error occured - '.$this->client->getErrorCode()." : ".$this->client->getErrorMessage());
        }
        else{
            $serVer[] = $this->client->getResponse();
            $finalReturn = substr($serVer[0][1], 0, -21);
        }

        return $finalReturn;

    }
}
?>
