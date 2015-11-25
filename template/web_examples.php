<?php

//initilize the page
require_once("inc/init.php");

//require UI configuration (nav, ribbon, etc.)
require_once("inc/config.ui.php");

/*---------------- PHP Custom Scripts ---------

YOU CAN SET CONFIGURATION VARIABLES HERE BEFORE IT GOES TO NAV, RIBBON, ETC.
E.G. $page_title = "Custom Title" */

$page_title = "Examples - DeepBlue Epigenomic Data Server";

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
        width:270px;
        white-space: normal;
        text-align: justify;
        text-justify: inter-word;
    }
    .dl-horizontal dd {
        margin-left:300px;
        margin-bottom: 12px;
    }
}

</style>

<?php include("landing_menu.php"); ?>

<div id="main" role="main">
    <!-- MAIN CONTENT -->
    <div id="content" class="container">
        <div class="row">

            <h1>DeepBlue Web - Examples</h1>
            <dl class="dl-horizontal" id="freelance">
                <dt>
                    <h5>Dashboard</h5>
                    <p>The dashboard provides an overview on all data available in DeepBlue. You can click on the charts elements to obtain more information about them.</p>
                </dt>
                <dd>
                    <img class="img-responsive center-block" src="img/web_examples/dashboard.png"/>
                </dd>
                <hr>
                <dt>
                    <h5>Full text search</h5>
                    <p>DeepBlue Web provides a interface for <a href="api.php#api-search">full text searching</a>.</p>
                </dt>
                <dd>
                    <img class="img-responsive center-block" src="img/web_examples/full_text_search.png"/>
                </dd>

                <hr>
                <dt>
                    <h5>Listing experiments</h5>
                    <p>You can list all epigenomic experiments in the <i>Data Tables > Experiments</i>.</p>
                    <p>This data tables provides full filtering and ordering</p>
                </dt>
                <dd>
                    <img class="img-responsive center-block" src="img/web_examples/listing_experiments.png"/>
                </dd>

                <hr>
                <dt>
                    <h5>Select epigenomic data</h5>
                    <p>Just double click the experiments that you want at <i>Data Tables > Experiments</i> and they will be selected for download.</p>
                    <p>After selecting the desired experiments, click on the <i>Download</i> button.</p>
                </dt>
                <dd>
                    <img class="img-responsive center-block" src="img/web_examples/selecting_experiments.png"/>
                </dd>

                <hr>
                <dt>
                    <h5>Download the experiments with their desired columns</h5>
                    <p>Select the experiments columns that are common to all experiments.</p>
                    <p>After, it is possible to include columns that are not common to all experiments.</p>
                    <p>Include meta-columns, like, name of the experiment region. It is also possible to include the region length, DNA sequence, epigenetic mark, project name, biosource, and sample id.</p>
                    <p>You can choose the genomic locations that you want to download by selecting the chromosomes and regions.</p>
                    <p>It is also possible to filter the regions by selecting an annotation that will overlap the desired regions.</p>
                    <p>Finally, just click on the <i>Request Download</i> button.</p>
                </dt>
                <dd>
                    <img class="img-responsive center-block" src="img/web_examples/selecting_experiments_data.png"/>
                </dd>

                <hr>
                <dt>
                    <h5>Download requests</h5>
                    <p>This page will show all yours requests (if you are a registered user) or yours session requests (if you are an anonymous user).</p>
                    <p>You can download the requests data clicking on <i>Download</i>.</p>
                </dt>
                <dd>
                    <img class="img-responsive center-block" src="img/web_examples/requests_list.png"/>
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