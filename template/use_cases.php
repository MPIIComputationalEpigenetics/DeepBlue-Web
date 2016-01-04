<?php

//initilize the page
require_once("inc/init.php");

//require UI configuration (nav, ribbon, etc.)
require_once("inc/config.ui.php");

/*---------------- PHP Custom Scripts ---------

YOU CAN SET CONFIGURATION VARIABLES HERE BEFORE IT GOES TO NAV, RIBBON, ETC.
E.G. $page_title = "Custom Title" */

$page_title = "Use Cases - DeepBlue Epigenomic Data Server";

/* ---------------- END PHP Custom Scripts ------------- */

//include header
//you can add your custom css in $page_css array.
//Note: all css files are inside css/ folder
$page_css[] = "deepblue.css";
$no_main_header = true;
$page_body_prop = array("id"=>"extr-page");
include("inc/header.php");

?>

<style type="text/css">
@media (min-width: 768px) {
    .dl-horizontal dd {
        margin-left:10px;
        margin-right:10px;
        margin-bottom: 12px;
    }
}

</style>


<?php include("landing_menu.php"); ?>

<div id="main" role="main">
    <!-- MAIN CONTENT -->
    <div id="content" class="container">
        <div class="row">

            <h1>DeepBlue API - use cases</h1>
            <h3> Use cases that we are using DeepBlue. They are ready to use - Copy and paste into your favorite python environment. <small>(Python version 2.6 or higher is required.)</small></h3>

            <dl class="dl-horizontal" id="freelance">
                <dd>
                    <h4>Summarizing DNA methylation levels in liver tissue across H3K4me3 peaks regions derived from human embryonic stem cells</h4>
                </dd>
                <dd>
                    <script src="https://gist.github.com/felipealbrecht/f81c14d2a52e9543567c.js"></script>
                </dd>

                <dd>
                    <h4>Identification of H3k27ac peaks that overlap with promoters in all BLUEPRINT datasets and subsequent identification of transcription factor peaks that overlap with these promoters, on all ENCODE datasets</h4>
                </dd>
                <dd>
                    <script src="https://gist.github.com/felipealbrecht/058d4fc13adab7f9c146.js"></script>
                </dd>

                <dd>
                    <h4>calculating the mRNA expression level for your favorite genes across all hematopoietic cell types and subsequent filtering regarding those genes regions where the value of the column named “<i>score</i>” is higher than a given threshold</h4>
                </dd>
                <dd>
                    <script src="https://gist.github.com/felipealbrecht/c84d81c78eb06b6a1d95.js"></script>
                </dd>
            </dl>

        </div>
    </div>

</div>
<!-- END MAIN PANEL -->
<!-- ==========================CONTENT ENDS HERE ========================== -->

<?php
	//include required scripts
	include("inc/scripts.php");
?>


<?php
	//include footer
	include("inc/google-analytics.php");
?>