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
require_once("server_settings.php");
require_once("lib.php");

error_reporting(E_ALL);
ini_set('display_errors', 1);


class Deepblue{
    private $privateUrl;
    private $privateUserKey;
    private $client;

    function __construct() {
        $this->privateUrl = get_server();
        $this->privateUserKey = get_user_key();
        $this->client = new IXR_Client($this->privateUrl);
    }

    /* Search result to JSON format */
    public function searchResultToJson($inputArray){
        $orderedDataStr = array();

        foreach ($inputArray as $info) {

            $tempSearchString = '';
            $tempArr = array();

            if(isset($info["id"])) {
                $info["_id"] = $info["id"];
            }

            if(isset($info["_id"])) {
                $tempArr[] = $info["_id"];
            }
            else {
                $tempArr[] = "";
            }

            if ($info["type"] == 'sample') {
                $tempArr[] = $info["biosource_name"];
            }
            else if(isset($info["name"])) {
                $tempArr[] = $info["name"];
            } else {
                $tempArr[] = "";
            }

            $tempArr[] = isset($info["description"]) ? $info["description"] : "";

            if(isset($info['extra_metadata'])){
                $fullMetadata = $this->experimentMetadata($info, "searchResult");
                $tempArr[] = substr($fullMetadata, 0, -2);
            }
            else if ($info["type"] == 'sample') {
                $sampleInfo = "";
                $sampleInfo .= '<b> Biosource </b> : ' . $info['biosource_name'] . "<br />";
                foreach ($info as $k => $v) {
                    if($v != '' && $v != '-' && $k != 'biosource_name' && $k != 'type' && $k != 'user' && $k != '_id') {
                        $sampleInfo .= '<b>'.$k.'</b> : ' . $v . "<br />";
                    }
                }
                $tempArr[] = $sampleInfo;
            }
            else if ($info["type"] == 'annotation') {
                $tempArr[] = '<b> Format </b> : ' . $info['format'];
            }
            else if ($info["type"] == 'request') {
                $details = "";
                foreach ($info as $k => $v) {
                    if ($v != '' && $v != '-' && $k != 'type') {
                        $details .= '<b>'.$k.'</b> : ' . $v . "<br />";
                    }
                }
                $tempArr[] = $details;
            } else {
                $tempArr[] = "";
            }

            $tempArr[] = $info["type"];
            $tempArr[] = isset($info["genome"]) ? "<i class='fa fa-circle txt-color-black'></i> ".$info["genome"] : "";
            $tempArr[] = isset($info["epigenetic_mark"]) ? "<i class='fa fa-circle txt-color-black'></i> ".$info["epigenetic_mark"] : "";

            if(isset($info['sample_info'])) {
                $sample_info = $info['sample_info'];
                $tempArr[] = "<i class='fa fa-circle txt-color-black'></i> ".$sample_info['biosource_name'];
            }
            else if ($info["type"] == 'sample') {
                $tempArr[] = "<i class='fa fa-circle txt-color-black'></i> ".$info['biosource_name']." ( ".$info["_id"]." )";
            } else {
                $tempArr[] = "";
            }

            $tempArr[] = isset($info["technique"]) ? "<i class='fa fa-circle txt-color-black'></i> ".$info["technique"] : "";
            $tempArr[] = isset($info["project"]) ? "<i class='fa fa-circle txt-color-black'></i> ".$info["project"] : "";

            array_push($orderedDataStr, $tempArr);
        }

        echo json_encode(array('data' => $orderedDataStr));
    }

    /* Experiment metadata generating */

    public function experimentMetadata($inputMetadata, $forWhere){

        $tempExpStr = "";

        if ($inputMetadata["type"] == 'annotation') {
            $tempExpStr .= '<b> Format </b> : ' . $inputMetadata['format'].'<br />';
        }

        if(isset($inputMetadata['sample_info'])){
            $tempExpStr .= "<b>Sample Info</b> <br />";
            foreach ($inputMetadata['sample_info'] as $extra_metadata_key => $extra_metadata_value) {
                if(($extra_metadata_value != '') && ($extra_metadata_value != '-')) {
                    if($extra_metadata_key == 'url'){
                        $tempExpStr .= "<b>".$extra_metadata_key."</b> : <a href='".$extra_metadata_value."' target='_blank'\>".$extra_metadata_value.'</a>'."<br />";
                    }
                    else{
                        $tempExpStr .= '<b>'.$extra_metadata_key.'</b> : '.$extra_metadata_value."<br />";
                    }
                }
            }
            $tempExpStr .= "<br />";
        }

        if ($inputMetadata["type"] == 'experiment') {
            $tempExpStr .= '<b> Format </b> : ' . $inputMetadata['format'].'<br />';
        }

        if(isset($inputMetadata['extra_metadata'])){
            $tempExpStr .= "<b>Extra Metadata</b> <br />";
            foreach ($inputMetadata['extra_metadata'] as $extra_metadata_key => $extra_metadata_value) {
                if(($extra_metadata_value != '') && ($extra_metadata_value != '-')) {
                    if($extra_metadata_key == 'url'){
                        $tempExpStr .= "<b>".$extra_metadata_key."</b> : <a href='".$extra_metadata_value."' target='_blank'\>".$extra_metadata_value.'</a> <br />';
                    }
                    else{
                        $tempExpStr .= '<b>'.$extra_metadata_key.'</b> : '.$extra_metadata_value."<br />";
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

    public function experimentDataTable($type, $title, $wf_genome, $wf_epigenetic_mark, $wf_sampleIds, $wf_technique, $wf_project, $where){

        if($where == 'modal_view' && $type != '' && $title != ''){

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
        elseif ($where == 'workflow') {

            $genome = $wf_genome;
            $epigenetic_mark = $wf_epigenetic_mark;
            $sampleIds = $wf_sampleIds;
            $technique = $wf_technique;
            $project = $wf_project;

        }
        else{
            $genome = "";
            $epigenetic_mark = "";
            $sampleIds = "";
            $technique = "";
            $project = "";
        }

        $type = "";
        $biosource = "";

        if(!$this->client->query("list_experiments", $genome, $type, $epigenetic_mark, $biosource, $sampleIds, $technique, $project, $this->privateUserKey)){
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

        $sizeOfItemIds = sizeof($responseList[0][1]);

        if($sizeOfItemIds == 1){
            $experiment_ids[] = $responseList[0][1][0][0];
        }
        else{
            foreach($responseList[0][1] as $experiment){
                $experiment_ids[] = $experiment[0];
            }

        }

        if(!$this->client->query("info", $experiment_ids, $this->privateUserKey)){
            die('An error occurred - '.$this->client->getErrorCode().":".$this->client->getErrorMessage());
        }
        else{
            $infoList = $this->client->getResponse();
        }

        $orderedDataStr = array();
        $tempControlArr = array();

        /* Checking the size of response */

        if($sizeOfItemIds == 1){
            $tempControlArr = $infoList;
        }
        else{
            $tempControlArr = $infoList[1];
        }

        foreach($tempControlArr as $metadata) {

            /* Ignoring 'okay' value */

            if($metadata == 'okay'){
                continue;
            }

            $tempArr = array();

            $tempArr[] = "<input type='checkbox' name='checkboxlist' id='".$metadata['_id']."' class='downloadCheckBox'>";
            $tempArr[] = $metadata['_id'];
            $tempArr[] = $metadata['name'];
            $tempArr[] = $metadata['description'];

            $tempArr[] = $metadata['genome'];
            $tempArr[] = $metadata['epigenetic_mark'];
            $tempArr[] = $metadata['sample_info']['biosource_name'];
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

    /* Generating annotation data table content */

    public function annotationDataTable($genome, $where){

        if($genome == ''){
            if(!$this->client->query("list_genomes", $this->privateUserKey)){
                die('An error occurred - '.$this->client->getErrorCode().":".$this->client->getErrorMessage());
            }
            else{
                $genomeList[] = $this->client->getResponse();
            }

            /* Collecting genome ids into array */

            $genomeIds = array();

            foreach($genomeList[0][1] as $genomes){
                $genomeIds[] = $genomes[1];
            }

        }
        else{
            $genomeIds = $genome;
        }

        /* Getting annotation list from the server  */
        $annotations = array();

        if(!$this->client->query("list_annotations", $genomeIds, $this->privateUserKey)){
            die('An error occurred - '.$this->client->getErrorCode().":".$this->client->getErrorMessage());
        }
        else{
            $annotations[] = $this->client->getResponse();

            /* Check the response, if it is empty then return empty datatables */

            if(empty($annotations[0][1])){

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

        /* Collecting annotation ids into array */
        $annotationsIds = array();

        foreach($annotations[0][1] as $annotationVal){
            $annotationsIds[] = $annotationVal[0];
        }

        if(!$this->client->query("info", $annotationsIds, $this->privateUserKey)){
            die('An error occurred - '.$this->client->getErrorCode().":".$this->client->getErrorMessage());
        }
        else{
            $infoList[] = $this->client->getResponse();
        }

        $orderedDataStr = array();
        $tempArr = array();
        $tempAnStr = "";

        foreach($infoList[0][1] as $value_2){

            if($where == 'workflow'){
                $tempArr[] = "<input type='checkbox' name='checkboxlist' id='".$value_2['_id']."' class='downloadCheckBox'>";
            }

            $tempArr[] = $value_2['_id'];
            $tempArr[] = $value_2['name'];
            $tempArr[] = $value_2['genome'];
            $tempArr[] = $value_2['description'];

            $tempAnStr.= "<div class='format-small'><b>Format : </b>".$value_2['format']."</div><br/>";

/*
            if(isset($value_2['extra_metadata'])){
                foreach ($value_2['extra_metadata'] as $key_3 => $value_3) {
                    $tempAnStr .= "<div class='format-small'><b>".$key_3."</b> : ".$value_3."</div><br/>";
                }
            }
*/

            $tempArr[] = $tempAnStr;

            array_push($orderedDataStr, $tempArr);
            $tempArr = array();
            $tempAnStr = "";
        }

        /* Generating JSON file from $tempArray final output */

        echo json_encode(array('data' => $orderedDataStr));

    }

    /* Generating annotation data table content [ Template ] */

    public function annotationDataTableTemplate($where){

        if($where == 'workflow'){
            $diffPlace = "Select";
            $diff_top_btn = "annot_select_btn_top";
            $diff_bottom_btn = "annot_select_btn_bottom";

            $checkbox_th_top = "<th class='hasinput'><button type='button' id='$diff_top_btn' class='btn btn-primary download-btn-size'>$diffPlace</button></th>";
            $checkbox_th_bottom = "<div class='downloadButtonDiv'><button type='button' id='$diff_bottom_btn' class='btn btn-primary'>$diffPlace</button></div>";
            $checkbox_td = "<th>Select</th>";

        }
        else{

            $checkbox_th_top = "";
            $checkbox_th_bottom = "";
            $checkbox_td = "";

        }

        $dataTableContent = <<<XYZ

        <!-- Widget ID (each widget will need unique ID)-->
            <div class="jarviswidget jarviswidget-color-darken" id="datable-annotations" data-widget-editbutton="false" data-widget-sortable="true">

                <header>
                    <span class="widget-icon"> <i class="fa fa-table"></i> </span>
                    <h2> Annotations </h2>
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

                        <table id="annotation_datatable_fixed_column" name='annotation_data_table_0' class="table table-striped table-bordered" width="100%">

                            <thead>
                                <tr>
                                    $checkbox_th_top
                                    <th class="hasinput">
                                        <input class="form-control" placeholder="ID" type="text" id="annotation-id"/>
                                    </th>
                                    <th class="hasinput">
                                        <input type="text" class="form-control" placeholder="Annotation" id="annotation-name"/>
                                    </th>
                                    <th class="hasinput">
                                        <input class="form-control" placeholder="Genome" type="text" id="annotation-genome"/>
                                    </th>
                                    <th class="hasinput">
                                        <input type="text" class="form-control" placeholder="Description" id="annotation-description"/>
                                    </th>
                                    <th class="hasinput">
                                        <input type="text" class="form-control" placeholder="Metadata" id="annotation-metadata"/>
                                    </th>
                                </tr>
                                <tr>
                                    $checkbox_td
                                    <th>ID</th>
                                    <th>Annotation name</th>
                                    <th>Genome</th>
                                    <th>Description</th>
                                    <th>Metadata</th>
                                </tr>
                            </thead>

                        </table>
                        $checkbox_th_bottom

                    </div>
                    <!-- end widget content -->

                </div>
                <!-- end widget div -->

            </div>
            <!-- end widget -->


XYZ;

    return $dataTableContent;



    }

    /* Prepare result to JSON format for cloning */
    public function cloneResultToJson($inputArray){
        $result = array();
        foreach($inputArray as $term => $value) {
            if ($term == 'info') {
                $info = array();
                $experiment = $inputArray['info'][0];

                $info['id'] = $experiment['_id'];
                $info['experiment'] = $experiment['name'];
                $info['genome'] = $experiment['genome'];
                $info['epigenetic_mark'] = $experiment['epigenetic_mark'];
                $info['sample'] = $experiment['sample_id']." (".$experiment['sample_info']['biosource_name'].")";
                $info['technique'] = $experiment['technique'];
                $info['project'] = $experiment['project'];
                $info['description'] = $experiment['description'];
                $info['Columns'] = $experiment['columns'];
                $info['Extra Metadata'] = $experiment['extra_metadata'];
                $result['info'] = $info;
            }
            else {
                for ($i = 0; $i < count($inputArray[$term]); $i++) {
                    $result[$term][$i]['data'] = $inputArray[$term][$i][0];
                    $result[$term][$i]['value'] = $inputArray[$term][$i][1];
                }
            }
        }
        echo json_encode(array('data' => $result));
    }

    /* Generating experiment data table content [ Template ] */
    public function experimentDataTableTemplate($where){

        if($where == "workflow"){
            $diffPlace = "Select";
            $diff_top_btn = "exp_select_btn_top";
            $diff_bottom_btn = "exp_select_btn_bottom";
        }
        elseif ($where == "clone") {
            $diffPlace = "Clone";
            $diff_top_btn = "cloneBtnTop";
            $diff_bottom_btn = "cloneBtnBottom";
        }
        else {
            $diffPlace = "Download";
            $diff_top_btn = "downloadBtnTop";
            $diff_bottom_btn = "downloadBtnBottom";
        }        $dataTableContent = <<<XYZ

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

                        <table id="datatable_fixed_column" name='experiment-table' class="table table-striped table-bordered" width="100%">
                            <thead>
                                <tr>
                                    <th class="hasinput">
                                        <button type="button" id="$diff_top_btn" class="btn btn-primary download-btn-size">$diffPlace</button>
                                    </th>
                                    <th class="hasinput">
                                        <input class="form-control" placeholder="ID" type="text" id="experiment-id">
                                    </th>

                                    <th class="hasinput" style="width:20px">
                                        <input type="text" class="form-control" placeholder="Experiment" id="experiment-name" />
                                    </th>
                                    <th class="hasinput">
                                        <input type="text" class="form-control" placeholder="Description" id="experiment-description" />
                                    </th>
                                    <th class="hasinput">
                                        <input type="text" class="form-control" placeholder="Genome" id="experiment-genome" />
                                    </th>
                                    <th class="hasinput">
                                        <input type="text" class="form-control" placeholder="Epigenetic mark" id="experiment-epigenetic_mark" />
                                    </th>
                                    <th class="hasinput">
                                        <input type="text" class="form-control" placeholder="Biosource" id="experiment-biosource" />
                                    </th>
                                    <th class="hasinput">
                                        <input type="text" class="form-control" placeholder="Sample" id="experiment-sample" />
                                    </th>
                                    <th class="hasinput">
                                        <input type="text" class="form-control" placeholder="Technique" id="experiment-technique" />
                                    </th>
                                    <th class="hasinput">
                                        <input type="text" class="form-control" placeholder="Project" id="experiment-project" />
                                    </th>
                                    <th class="hasinput">
                                        <input type="text" class="form-control" placeholder="Meta data" id="experiment-metadata" />
                                    </th>
                                </tr>
                                <tr>
                                    <th>Select</th>
                                    <th>ID</th>
                                    <th>Experiment Name</th>
                                    <th>Description</th>
                                    <th>Genome</th>
                                    <th>Epigenetic Mark</th>
                                    <th>Biosource</th>
                                    <th>Sample</th>
                                    <th>Technique</th>
                                    <th>Project</th>
                                    <th>Metadata</th>

                                </tr>
                            </thead>

                        </table>
                        <div class="downloadButtonDiv"><button type="button" id="$diff_bottom_btn" class="btn btn-primary">$diffPlace</button></div>

                    </div>
                    <!-- end widget content -->

                </div>
                <!-- end widget div -->

            </div>
            <!-- end widget -->
XYZ;

        return $dataTableContent;
    }

    /* Generating a minimized experiment data table content [ Template ] */
    public function experimentMinimizedDataTableTemplate($where){

        if($where == "workflow"){
            $diffPlace = "Select";
            $diff_top_btn = "exp_select_btn_top";
            $diff_bottom_btn = "exp_select_btn_bottom";
        }
        elseif ($where == "clone") {
            $diffPlace = "Clone";
            $diff_top_btn = "cloneBtnTop";
            $diff_bottom_btn = "cloneBtnBottom";
        }
        else {
            $diffPlace = "Download";
            $diff_top_btn = "downloadBtnTop";
            $diff_bottom_btn = "downloadBtnBottom";
        }
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

                        <table id="datatable_fixed_column" name='experiment-table' class="table table-striped table-bordered" width="100%">
                            <thead>
                                <tr>
                                    <th class="hasinput" style="width:10%">
                                        <button type="button" id="$diff_top_btn" class="btn btn-primary download-btn-size">$diffPlace</button>
                                    </th>
                                    <th class="hasinput" style="width:20%">
                                        <input class="form-control" placeholder="ID" type="text" id="experiment-id">
                                    </th>

                                    <th class="hasinput">
                                        <input type="text" class="form-control" placeholder="Experiment Name" id="experiment-name" />
                                    </th>
                                </tr>
                                <tr>
                                    <th>Select</th>
                                    <th>ID</th>
                                    <th>Experiment Name</th>
                                </tr>
                            </thead>

                        </table>
                        <div class="downloadButtonDiv"><button type="button" id="$diff_bottom_btn" class="btn btn-primary">$diffPlace</button></div>

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
