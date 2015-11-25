<?php

//initilize the page
require_once("inc/init.php");

//require UI configuration (nav, ribbon, etc.)
require_once("inc/config.ui.php");

/*---------------- PHP Custom Scripts ---------

YOU CAN SET CONFIGURATION VARIABLES HERE BEFORE IT GOES TO NAV, RIBBON, ETC.
E.G. $page_title = "Custom Title" */

$page_title = "Using DeepBlue with R - DeepBlue Epigenomic Data Server";

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
        <h1>Using DeepBlue with R</h1>
        <h6>Just click <a href="https://raw.githubusercontent.com/MPIIComputationalEpigenetics/DeepBlue-R/master/py/deepblue.r">here</a> to download the DeepBlue R library</h6>

        <h2>Explanation</h2>

        <p class="lead" style="text-align: justify;">DeepBlue uses the XML-RPC protocol for the communication between the users and the server. Unhappily, the implementation of the <a href="http://bioconductor.org/packages/devel/extra/html/XMLRPC.html">XML-RPC in R</a> is not fully complaint with the <a href="http://xmlrpc.scripting.com/spec.html">XML-RPC specification</a>.</p>

        <p class="lead" style="text-align: justify;">We implemented a small R library that the users can access DeepBlue from R. You can download the library from <a href="https://raw.githubusercontent.com/MPIIComputationalEpigenetics/DeepBlue-R/master/py/deepblue.r">here</a>, put in your R project directory, and execute:
            <blockquote>
                <i>source("deepblue.r")</i>
            </blockquote>
        </p>

        <p class="lead" style="text-align: justify;">This library provides the DeepBlue API commands. We are currently working to include more high level commands. Please, contact us if you have some suggestion or would like to provide come code. You can also access your <a href="https://github.com/MPIIComputationalEpigenetics/DeepBlue-R">github repository</a> and create an issue there.</p>
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