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

<?php include("landing_menu.php"); ?>

<div id="main" role="main">
    <!-- MAIN CONTENT -->
    <div id="content" class="container">
        <h1>DeepBlue Epigenomic Data Server: Programmatic access and analysis of region-set epigenomic data</h1>
        <h2>Supplementary Material</h2>

        <h3>Experiments list</h3>
        <p class="lead" style="text-align: justify;">The list of available experiments is available in the web page &rarr; left menu  &rarr; <a href="http://deepblue.mpi-inf.mpg.de/dashboard.php#ajax/deepblue_view_experiments.php" target="_blank">Experiments data</a>.</p>
        <p class="text-info"> <small>You need to log into DeepBlue (pressing the Access DeepBlue Web Interface button) to access this page.</small></p>

        <h3>Annotations list</h3>
        <p class="lead" style="text-align: justify;">The list of available annotations is available in the web page &rarr; left menu  &rarr; auxiliary data &rarr;  <a href="http://deepblue.mpi-inf.mpg.de/dashboard.php#ajax/deepblue_view_annotations.php" target="_blank">Annotations</a>.</p>
        <p class="text-info"> <small>You need to log into DeepBlue (pressing the Access DeepBlue Web Interface button) to access this page.</small></p>

        <h3>Operatios list</h3>
        <p class="lead" style="text-align: justify;">The list of all commands is available in the <a href="http://deepblue.mpi-inf.mpg.de/api.php" target="_blank">Reference API</a> page.</p>

        <h3>Operations examples</h3>
        <p class="lead" style="text-align: justify;">We provide a list of examples in the <a href="http://deepblue.mpi-inf.mpg.de/examples.php" target="_blank">DeepBlue API - examples</a> page.</p>

        <h3>Use cases</h3>
        <p class="lead" style="text-align: justify;">As illustrative applications and use cases of the DeepBlue API and data server, we provide example code for:</p>
        <ul>
          <li><p class="lead" style="text-align: justify;"><small> Summarizing DNA methylation levels in liver tissue across H3K4me3 peaks regions derived from human embryonic stem cells [<a href="http://tiny.cc/0g1s6x">http://tiny.cc/0g1s6x</a>].</small></p></li>
          <li><p class="lead" style="text-align: justify;"><small> Identification of H3k27ac peaks that overlap with promoters in all BLUEPRINT datasets and subsequent identification of transcription factor peaks that overlap with these promoters, on all ENCODE datasets [<a href="http://tiny.cc/yh1s6x">http://tiny.cc/yh1s6x</a>].</small></p></li>
          <li><p class="lead" style="text-align: justify;"><small> Calculating the mRNA expression level for your favorite genes across all hemato- poietic cell types and subsequent filtering regarding those genes regions where the value of the column named “score” is higher than a given threshold [<a href="http://tiny.cc/ni1s6x">http://tiny.cc/ni1s6x</a>].</small></p></li>
        </ul>

        <h3>Data model</h3>

        <img style="border: 1px solid #ccc;" class="img-responsive"  src="supplementary_nar_webservices_2016/DeepBlue Data Model - ERD.png"/>


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