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

        <p class="lead" style="text-align: justify;">We provide a R package specially crafted for accessing DeepBlue.</br>
        This package abstract some of the DeepBlue API and provides integration with others packages, for example, <a href="https://bioconductor.org/packages/release/bioc/html/GenomicRanges.html">genome ranges</a>.</p>

        <p class="lead" style="text-align: justify;">Please, remember that it is an in progress work. Bugs and changes may and will happen!</p>

        <p class="lead" style="text-align: justify;">For installing, just execute the following command inside R:
        <pre>library(devtools)
install_github("MPIIComputationalEpigenetics/DeepBlue-R")</pre>
        </p>

        <br />

        <p class="lead" style="text-align: justify;">For listing the use cases and examples:
        <pre>demo(package = "DeepBlue")</pre>
        </p>

        <br />

        <p class="lead" style="text-align: justify;">For executing the <a href="http://deepblue.mpi-inf.mpg.de/use_cases.php">Use case 1</a>:
        <pre>demo("use_case1", package = "DeepBlue")</pre>
        </p>

        <br />

        <p class="lead" style="text-align: justify;">Please, create an issue at our <a href="https://github.com/MPIIComputationalEpigenetics/DeepBlue-R">github repository if you found a bug or have suggestions.</a>.</p>
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