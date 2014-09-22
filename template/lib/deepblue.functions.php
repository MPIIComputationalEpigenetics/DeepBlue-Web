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

class Deepblue{

	private $privateUrl;
	private $privateUserKey;
    private $client;

	function __construct() {

		/* Including URL and User Key */

		include("lib.php");

		$this->privateUrl = $url;
		$this->privateUserKey = $user_key;
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

    	    echo "<a onclick=\"$(function() { $(document).scrollTop( $('#api-". str_replace(' ', '-', strtolower($sKeyOne))."').offset().top ); });\" href=\"javascript:void(0);\"><h3><b>$sKeyOne</b></a> — $sValueOne</h3>";

		    foreach($commands as $tKeyOne => $tValueOne){
			    if($sKeyOne == $tValueOne['description'][0]) {
                    echo "<div class='api-description-listing'>".$n." )\n";
                    echo "<a onclick=\"$(function() { $(document).scrollTop($('#api-". str_replace(' ', '-', strtolower($tKeyOne))."').offset().top ); });\" href='javascript:void(0);'>$tKeyOne</a> — ".$tValueOne['description'][2];
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
                        <h4>Parametrs:</h4>
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

    /* Search result to JSON format */

    public function searchResultToJson($inputArray){

        $orderedDataStr = array();

        foreach ($inputArray as $key_1 => $val_1) {

        $tempSearchString = '';
        $tempArr = array();

        if($inputArray[$key_1] == 0){
            continue;
        }

        $tempArr[] = $val_1["_id"];
        isset($val_1["name"]) ? $tempArr[] = $val_1["name"] : $tempArr[] = current(explode(",", $val_1["description"]));
        isset($val_1["description"]) ? $tempArr[] = $val_1["description"] : $tempArr[] = "";

        if(isset($val_1['extra_metadata'])){
            $fullMetadata = $this->experimentMetadata($val_1, "searchResult");
            $tempArr[] = substr($fullMetadata, 0, -2);
        }
        else{
            $tempArr[] = "";
        }

        // if(isset($val_1['extra_metadata'])){
        //     foreach ($val_1["extra_metadata"] as $key => $value){
        //         $value = ($value!='') ? $value : 'none';
        //         $tempSearchString .= "<b>".$key."</b> : ".$value.", ";
        //     }
        //     $tempArr[] = substr($tempSearchString, 0, -2);
        // }
        // else{
        //     $tempArr[] = "";
        // }

        $tempArr[] = $val_1["type"];
        isset($val_1["genome"]) ? $tempArr[] = "<i class='fa fa-star txt-color-yellow'></i> ".$val_1["genome"] : $tempArr[] = "";
        isset($val_1["epigenetic_mark"]) ? $tempArr[] = "<i class='fa fa-star txt-color-yellow'></i> ".$val_1["epigenetic_mark"] : $tempArr[] = "";

        if(isset($val_1["sample_id"]) && isset($val_1["bio_source_name"])){
            $tempArr[] = "<i class='fa fa-star txt-color-yellow'></i> ".$val_1['bio_source_name']." ( ".$val_1["sample_id"]." )";
        }
        else{
            $tempArr[] = "";
        }


        isset($val_1["technique"]) ? $tempArr[] = "<i class='fa fa-star txt-color-yellow'></i> ".$val_1["technique"] : $tempArr[] = "";
        isset($val_1["project"]) ? $tempArr[] = "<i class='fa fa-star txt-color-yellow'></i> ".$val_1["project"] : $tempArr[] = "";

        isset($val_1["format"]) ? $tempArr[] = $val_1["format"] : $tempArr[] = "";

        array_push($orderedDataStr, $tempArr);

        }

        echo json_encode(array('data' => $orderedDataStr));

    }

    /* Experiment metadata generating */

    public function experimentMetadata($inputMetadata, $forWhere){

        $tempExpStr = "";

        if($forWhere == 'searchResult'){
            $tempVar = ', ';
        }
        else{
            $tempVar = '<br/>';
        }

        foreach ($inputMetadata as $others_metadata_key => $others_metadata_value) {
            if ($others_metadata_key != '_id' && $others_metadata_key != 'name' && $others_metadata_key != 'genome' &&
            $others_metadata_key != 'epigenetic_mark' && $others_metadata_key != 'sample_id' &&
            $others_metadata_key != 'description' && $others_metadata_key != 'type' &&
            $others_metadata_key != 'done' && $others_metadata_key != 'client_address' && $others_metadata_key != 'format' &&
            $others_metadata_key != 'upload_end' && $others_metadata_key != 'upload_start' && $others_metadata_key != 'extra_metadata' &&
            $others_metadata_key != 'technique' && $others_metadata_key != 'project' && $others_metadata_key != 'user'){
                if($others_metadata_value != ''){
                    $tempExpStr .= '<b>'.$others_metadata_key.'</b> : '.$others_metadata_value.$tempVar;
                }
            }
        }

        if(isset($inputMetadata['extra_metadata'])){
            foreach ($inputMetadata['extra_metadata'] as $extra_metadata_key => $extra_metadata_value) {
                if($extra_metadata_value != ''){
                    if($extra_metadata_key == 'url'){
                        $tempExpStr .= "<b>".$extra_metadata_key."</b> : <a href='".$extra_metadata_value."' target='_blank'\>".$extra_metadata_value.'</a>'.$tempVar;
                    }
                    else{
                        $tempExpStr .= '<b>'.$extra_metadata_key.'</b> : '.$extra_metadata_value.$tempVar;
                    }
                }
            }
        }

        return $tempExpStr;

    }

    /* This function will remove only '+' and return double quotes */

    public function onlyPlusToQuotes($inData){

        $newString = "";
        $splitedData = explode(' ', $inData);

        foreach($splitedData as $value){

            if(strpos($value, '+') !== false){
                /* Checking string for '+' and double quotes */
                if(strpos($value, '"') !== false){
                    $value = str_replace('"', '', $value);
                }

                $withoutPlusValue = str_replace('+', '', $value);
                $newString .= "\"$withoutPlusValue\" ";
            }
            else {
                $newString .= $value." ";
            }
        }

        return substr($newString, 0, -1);

    }

    /**
    *   Replacing plus to double quotes, single quotes to double quotes and
    *   others e.g. 'blood' +nextItem or +"blood" 'nextItem' ... etc.
    */

    public function plusToQuotes($inputString){

        if(strpos($inputString, '+') === false && strpos($inputString, "'") === false){
            return $inputString;
        }
        elseif(strpos($inputString, '+') !== false && strpos($inputString, "'") !== false){
            $inputString = str_replace("'", '"', $inputString);

            return $this->onlyPlusToQuotes($inputString);

        }
        elseif(strpos($inputString, "'") !== false) {
            $inputString = str_replace("'", '"', $inputString);
            return $inputString;
        }
        elseif(strpos($inputString, '+') !== false){

            return $this->onlyPlusToQuotes($inputString);

        }

    }

    /* Generating experiment data table content */

    public function experimentDataTable($type, $title, $where){

        //$client = new IXR_Client($this->privateUrl);

        if($where == 'modal_view'){

            switch ($type) {

                case 'experiment':
                    $genome = "";
                    $epigenetic_mark = "";
                    $sampleIds = "";
                    $technique = "";
                    $project = "";
                    break;
                case 'annotation':
                    $genome = "";
                    $epigenetic_mark = "";
                    $sampleIds = "";
                    $technique = "";
                    $project = "";
                    break;
                case 'genome':
                    $genome = $title;
                    $epigenetic_mark = "";
                    $sampleIds = "";
                    $technique = "";
                    $project = "";
                    break;
                case 'epigenetic_mark':
                    $genome = "";
                    $epigenetic_mark = $title;
                    $sampleIds = "";
                    $technique = "";
                    $project = "";
                    break;
                case 'sample':
                    $genome = "";
                    $epigenetic_mark = "";
                    $sampleIds = $title;
                    $technique = "";
                    $project = "";
                    break;
                case 'technique':
                    $genome = "";
                    $epigenetic_mark = "";
                    $sampleIds = "";
                    $technique = $title;
                    $project = "";
                    break;
                case 'project':
                    $genome = "";
                    $epigenetic_mark = "";
                    $sampleIds = "";
                    $technique = "";
                    $project = $title;
                    break;

                default:

                    if(!$this->client->query("list_samples", $title, (object) null, $this->privateUserKey)){
                        die('An error occurred - '.$this->client->getErrorCode().":".$this->client->getErrorMessage());
                    }
                    else{

                        $sampleList[] = $this->client->getResponse();

                        if(empty($sampleList[0][1])){

                            echo '{
                                "sEcho": 1,
                                "iTotalRecords": 0,
                                "iTotalDisplayRecords": 0,
                                "aaData":[

                                ]
                            }';

                            return;
                        }

                        foreach ($sampleList[0][1] as $samples) {
                            $sampleIds[] = $samples[0];
                        }

                        $genome = "";
                        $epigenetic_mark = "";
                        $technique = "";
                        $project = "";

                    }
                    break;
            }
        }
        else{
            $genome = "";
            $epigenetic_mark = "";
            $sampleIds = "";
            $technique = "";
            $project = "";
        }


        if(!$this->client->query("list_experiments", $genome, $epigenetic_mark, $sampleIds, $technique, $project, $this->privateUserKey)){
            die('An error occurred - '.$this->client->getErrorCode().":".$this->client->getErrorMessage());
        }
        else{
            $responseList[] = $this->client->getResponse();

            /* Check the response, if it is empty then return empty datatables */

            if(empty($responseList[0][1])){

                echo '{
                        "sEcho": 1,
                        "iTotalRecords": 0,
                        "iTotalDisplayRecords": 0,
                        "aaData":[
                        ]
                    }';

                return;
            }
        }


        $experiment_ids = array();

        foreach($responseList[0][1] as $experiment){
            $experiment_ids[] = $experiment[0];
        }

        if(!$this->client->query("info", $experiment_ids, $this->privateUserKey)){
            die('An error occurred - '.$this->client->getErrorCode().":".$this->client->getErrorMessage());
        }
        else{
            $infoList = $this->client->getResponse();
        }

        $orderedDataStr = array();

        foreach($infoList[1] as $metadata) {
            $tempArr = array();

            $tempArr[] = "<input type='checkbox' name='checkboxlist' class='downloadCheckBox'>";
            $tempArr[] = $metadata['_id'];
            $tempArr[] = $metadata['name'];
            $tempArr[] = $metadata['description'];

            $tempArr[] = $metadata['genome'];
            $tempArr[] = $metadata['epigenetic_mark'];
            $tempArr[] = $metadata['sample_id'];
            $tempArr[] = $metadata['technique'];
            $tempArr[] = $metadata['project'];

            $fullMetadata = $this->experimentMetadata($metadata, "forTable");

            $tempArr[] = "<div class='exp-metadata'>".$fullMetadata."</div><div class='exp-metadata-more-view'>-- View metadata --</div>";
            array_push($orderedDataStr, $tempArr);

            $tempArr = array();
            $tempExpStr = "";
        }

        /* Generating JSON file from $tempArray final output */

        echo json_encode(array('data' => $orderedDataStr));

    }


    public function experimentDataTableTemplate(){

        $dataTableContent = <<<XYZ

        <!-- Widget ID (each widget will need unique ID)-->
            <div class="jarviswidget jarviswidget-color-blueDark" id="datable-experiments" data-widget-editbutton="false" data-widget-deletebutton="false" data-widget-colorbutton="false" data-widget-togglebutton="false">

                <header>
                    <span class="widget-icon"> <i class="fa fa-table"></i> </span>
                    <h2>Experiments </h2>

                </header>

                <!-- widget div-->
                <div>

                    <!-- widget edit box -->
                    <div class="jarviswidget-editbox">
                        <!-- This area used as dropdown edit box -->

                    </div>
                    <!-- end widget edit box -->

                    <!-- widget content -->
                    <div class="widget-body no-padding">

                        <table id="datatable_fixed_column" class="table table-striped table-bordered" width="100%">
                            <thead>
                                <tr>
                                    <th class="hasinput">
                                        <button type="button" id="downloadBtnTop" class="btn btn-primary download-btn-size">Download</button>
                                    </th>
                                    <th class="hasinput">
                                        <input class="form-control" placeholder="Filter ID" type="text" id="experiment-id">
                                    </th>

                                    <th class="hasinput" style="width:20px">
                                        <input type="text" class="form-control" placeholder="Filter Experiment" id="experiment-name" />
                                    </th>
                                    <th class="hasinput">
                                        <input type="text" class="form-control" placeholder="Filter Description" id="experiment-description" />
                                    </th>
                                    <th class="hasinput">
                                        <input type="text" class="form-control" placeholder="Filtering Genome" id="experiment-genome" />
                                    </th>
                                    <th class="hasinput">
                                        <input type="text" class="form-control" placeholder="Filtering Epegenetic mark" id="experiment-em" />
                                    </th>
                                    <th class="hasinput">
                                        <input type="text" class="form-control" placeholder="Filter Sample" id="experiment-sample" />
                                    </th>
                                    <th class="hasinput">
                                        <input type="text" class="form-control" placeholder="Filter Technique" id="experiment-technique" />
                                    </th>
                                    <th class="hasinput">
                                        <input type="text" class="form-control" placeholder="Filter Project" id="experiment-project" />
                                    </th>
                                    <th class="hasinput">
                                        <input type="text" class="form-control" placeholder="Filter Meta data" id="experiment-metadata" />
                                    </th>
                                </tr>
                                <tr>
                                    <th>Select</th>
                                    <th>ID</th>
                                    <th>Experiment Name</th>
                                    <th>Description</th>
                                    <th>Genome</th>
                                    <th>Epigenetic Mark</th>
                                    <th>Sample</th>
                                    <th>Technique</th>
                                    <th>Project</th>
                                    <th>Metadata</th>

                                </tr>
                            </thead>

                        </table>
                        <div class="downloadButtonDiv"><button type="button" id="downloadBtnBottom" class="btn btn-primary">Download</button></div>

                    </div>
                    <!-- end widget content -->

                </div>
                <!-- end widget div -->

            </div>
            <!-- end widget -->
XYZ;

        return $dataTableContent;
    }

}


?>
