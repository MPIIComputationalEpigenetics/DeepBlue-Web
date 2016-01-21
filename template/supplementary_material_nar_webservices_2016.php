<?php

//initilize the page
require_once("inc/init.php");

//require UI configuration (nav, ribbon, etc.)
require_once("inc/config.ui.php");

/*---------------- PHP Custom Scripts ---------

YOU CAN SET CONFIGURATION VARIABLES HERE BEFORE IT GOES TO NAV, RIBBON, ETC.
E.G. $page_title = "Custom Title" */

$page_title = "Supplementary material for DeepBlue Epigenomic Data Server: Programmatic access and analysis of region-set epigenomic data";

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
    .dl-horizontal dt {
        width:340px;
        padding-right: 12px;
        white-space: normal;
        text-align: justify;
        text-justify: inter-word;
    }
    .dl-horizontal dd {
        margin-left:340px;
        margin-bottom: 12px;
    }
}

</style>


<?php include("landing_menu.php"); ?>

<div id="main" role="main">
    <!-- MAIN CONTENT -->
    <div id="content" class="container">

        <div style="padding: 50px">
          <h1>DeepBlue Epigenomic Data Server: Programmatic access and analysis of region-set epigenomic data</h1>
          <h2><small>This web page provides supplementary information for the manuscript presenting DeepBlue Epigenomic Data Server.</small></h2>
        </div>

        <h3>Experiments list</h3>
        <p class="lead" style="text-align: justify;">The list of available experiments is available in the web page &rarr; left menu  &rarr; <a href="http://deepblue.mpi-inf.mpg.de/dashboard.php#ajax/deepblue_view_experiments.php" target="_blank">Experiments data</a>.</p>
        <p class="text-info"> <small>You need to log into DeepBlue (pressing the Access DeepBlue Web Interface button) to access this page.</small></p>

        <div class="navy-line"></div>

        <h3>Annotations list</h3>
        <p class="lead" style="text-align: justify;">The list of available annotations is available in the web page &rarr; left menu  &rarr; auxiliary data &rarr;  <a href="http://deepblue.mpi-inf.mpg.de/dashboard.php#ajax/deepblue_view_annotations.php" target="_blank">Annotations</a>.</p>
        <p class="text-info"> <small>You need to log into DeepBlue (pressing the Access DeepBlue Web Interface button) to access this page.</small></p>

        <div class="navy-line"></div>

        <h3>Operations list</h3>
        <p class="lead" style="text-align: justify;">The list of all commands is available in the <a href="http://deepblue.mpi-inf.mpg.de/api.php" target="_blank">Reference API</a> page.</p>

        <div class="navy-line"></div>

        <h3>Operations examples</h3>
        <p class="lead" style="text-align: justify;">We provide a list of examples in the <a href="http://deepblue.mpi-inf.mpg.de/examples.php" target="_blank">DeepBlue API - examples</a> page.</p>

        <div class="navy-line"></div>

        <h3>Use cases</h3>

        <dl class="dl-horizontal" id="freelance">
          <h4 id='example-search_experiments'>Use case 1:<br/><b>Summarizing DNA methylation levels in liver tissue across H3K4me3 peaks regions derived from human embryonic stem cells</b></h4>
          <dt style="width:70%">
            <p class="lead" style="text-align: justify; padding: 15px;">
              We firstly list all experiments that has a sample with the biosource <i>H1-hESC</i>. After, we select the <i>peaks</i> experiments from this list. These experiments regions will be the boundaries of the aggregation that will be performed.
            </p>
            <p class="lead" style="text-align: justify; padding: 15px;">
              After, we list all  experiments with <i>liver</i> or <i>hepatocypes</i> biosources.
            <p>
            <p class="lead" style="text-align: justify; padding: 15px;">
              For each listed <i>liver</i> or <i>hepatocytes</i> experiment, we select the associated regions of this experiment.</p>
            <p>
            <p class="lead" style="text-align: justify; padding: 15px;">
              We perform an aggregation with the selected regions using the <i>H1-hESC</i> <i>H3K27ac</i> peaks as boundaries.</p>
            <p>
            <p class="lead" style="text-align: justify; padding: 15px;">
              Finally, we request the regions and download them.
            <p>
          </dt>
          <dd>
            <div align="right" style="padding: 10px">
              <img class="img-responsive" style="align: right; width: 40%; border: 1px solid #ccc" src="https://www.lucidchart.com/publicSegments/view/b5100771-6c4d-46a4-b3f3-f2fb9a5de5ba/image.png">
            </div>
          </dd>

          <h4 style="padding: 10px 0px 20px 0px " id='example-search_experiments'><b>Source code</b>  <small>(Copy it into your python interpreter)</small></h4>
          <dt>
            <p>We use the <a href="api.php#api-search"</a>search</a> command to find experiments that contain the texts <i>H3k27AC</i>, <i>blood</i>, and <i>peaks</i> in their metadata.
            <p>We put the names in single quotes to show that these names must be in the metadata.</p>
          </dt>
          <dd>
            <script src="https://gist.github.com/felipealbrecht/f81c14d2a52e9543567c.js"></script>
          </dd>

          <!-- -->
          <h4 id='example-search_experiments'>Use case 2:<br/><b>Identification of H3k27ac peaks that overlap with promoters in all BLUEPRINT datasets and subsequent identification of transcription factor peaks that overlap with these promoters, on all ENCODE datasets</b></h4>
          <dt style="width:70%">
            <p class="lead" style="text-align: justify; padding: 15px;">
            blabla
            </p>
          </dt>
          <dd>
            <div align="right" style="padding: 10px">
              <img class="img-responsive" style="align: right; width: 40%; border: 1px solid #ccc" src="https://www.lucidchart.com/publicSegments/view/b5100771-6c4d-46a4-b3f3-f2fb9a5de5ba/image.png">
            </div>
          </dd>

          <h4 style="padding: 10px 0px 20px 0px " id='example-search_experiments'><b>Source code</b>  <small>(Copy it into your python interpreter)</small></h4>
          <dt>
            <h5 id='example-search_experiments'>Identification of H3k27ac peaks that overlap with promoters in all BLUEPRINT datasets and subsequent identification of transcription factor peaks that overlap with these promoters, on all ENCODE datasets</h5>
            <p>We use the <a href="api.php#api-search"</a>search</a> command to find experiments that contain the texts <i>H3k27AC</i>, <i>blood</i>, and <i>peaks</i> in their metadata.
            <p>We put the names in single quotes to show that these names must be in the metadata.</p>
          </dt>
          <dd>
            <script src="https://gist.github.com/felipealbrecht/058d4fc13adab7f9c146.js"></script>
          </dd>

          <!---      -->
          <h4 id='example-search_experiments'>Use case 3:<br/><b>Calculating the mRNA expression level for your favorite genes across all hematopoietic cell types and subsequent filtering regarding those genes regions where the value of the column named “score” is higher than a given threshold</b></h4>
          <dt style="width:70%">
            <p class="lead" style="text-align: justify; padding: 15px;">
            blabla
            </p>
          </dt>
          <dd>
            <div align="right" style="padding: 10px">
              <img class="img-responsive" style="align: right; width: 40%; border: 1px solid #ccc" src="https://www.lucidchart.com/publicSegments/view/b5100771-6c4d-46a4-b3f3-f2fb9a5de5ba/image.png">
            </div>
          </dd>

          <h4 style="padding: 10px 0px 20px 0px " id='example-search_experiments'><b>Source code</b>  <small>(Copy it into your python interpreter)</small></h4>
          <dt>
            <h5 id='example-search_experiments'>Calculating the mRNA expression level for your favorite genes across all hematopoietic cell types and subsequent filtering regarding those genes regions where the value of the column named “score” is higher than a given threshold</h5>
            <p>We use the <a href="api.php#api-search"</a>search</a> command to find experiments that contain the texts <i>H3k27AC</i>, <i>blood</i>, and <i>peaks</i> in their metadata.
            <p>We put the names in single quotes to show that these names must be in the metadata.</p>
          </dt>
          <dd>
            <script src="https://gist.github.com/felipealbrecht/c84d81c78eb06b6a1d95.js"></script>
          </dd>
        </dl>

        <div class="navy-line"></div>

        <h3>Data model</h3>

        <center>
          <a href="supplementary_nar_webservices_2016/DeepBlue Data Model - ERD.png" target="_blank">
            <img width="60%" style="border: 1px solid #ccc;" class="img-responsive"  src="supplementary_nar_webservices_2016/DeepBlue Data Model - ERD.png"/>
          </a>
        </center>


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