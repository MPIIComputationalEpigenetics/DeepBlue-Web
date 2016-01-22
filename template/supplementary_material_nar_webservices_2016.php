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
        width:42%;
        padding-right: 12px;
        white-space: normal;
        text-align: justify;
        text-justify: inter-word;
    }
    .dl-horizontal dd {
        margin-left:43%;
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
          <h2><small>This web page provides supplementary information for the manuscript presenting the DeepBlue Epigenomic Data Server.</small></h2>
        </div>

        <!--

        <h3>Experiments list</h3>
        <p class="lead" style="text-align: justify;">The list of available experiments is available in the DeepBlue web client &rarr; left menu  &rarr; <a href="http://deepblue.mpi-inf.mpg.de/dashboard.php#ajax/deepblue_view_experiments.php" target="_blank">Experiments data</a>.</p>
        <p class="text-info"> <small>You need to log into DeepBlue (pressing the Access DeepBlue Web Interface button) to access this page.</small></p>

        <div class="navy-line"></div>

        <h3>Annotations list</h3>
        <p class="lead" style="text-align: justify;">The list of available annotations is available in the web page &rarr; left menu  &rarr; auxiliary data &rarr;  <a href="http://deepblue.mpi-inf.mpg.de/dashboard.php#ajax/deepblue_view_annotations.php" target="_blank">Annotations</a>.</p>
        <p class="text-info"> <small>You need to log into DeepBlue (pressing the Access DeepBlue Web Interface button) to access this page.</small></p>

        <div class="navy-line"></div>

        <h3>Operation list</h3>
        <p class="lead" style="text-align: justify;">The list of all commands is available in the <a href="http://deepblue.mpi-inf.mpg.de/api.php" target="_blank">Reference API</a> page.</p>

        <div class="navy-line"></div>

        <h3>Operations examples</h3>
        <p class="lead" style="text-align: justify;">We provide a list of examples in the <a href="http://deepblue.mpi-inf.mpg.de/examples.php" target="_blank">DeepBlue API - examples</a> page.</p>

        <div style="width: 550px" class="navy-line"></div>

        -->

        <h3>Use cases</h3>
        <dl class="dl-horizontal" id="freelance">
          <!-- -->
          <h4 id='example-search_experiments'>Use case 1:<br/><b>Identification of H3k27ac peaks that overlap with promoters in all BLUEPRINT datasets and subsequent identification of transcription factor peaks that overlap with these promoters in all ENCODE datasets</b></h4>
          <dt style="width: 60%">
            <br />
            <p class="lead" style="text-align: justify; padding: 15px;">
              We select the promoters regions and the H3K27ac peaks from BLUEPRINT.</p>
            </p>
            <p class="lead" style="text-align: justify; padding: 15px;">
              We filter the H3K27ac regions that overlap with some promoter region.</p>
            <p>
            <p class="lead" style="text-align: justify; padding: 15px;">
              We select the signal of three Transcription Factors (TF): AG01, AG02, and AG03.</p>
            <p>
            <p class="lead" style="text-align: justify; padding: 15px;">
              We filter the TFs regions that overlap with some filtered H3K27ac peaks.</p>
            <p>
            <p class="lead" style="text-align: justify; padding: 15px;">
              Finally, we request the regions and download them.
            <p>
          </dt>
          <dd>
            <div align="right" style="padding: 20px 0px 0px 0px">
              <center>
                <img class="img-responsive" style="align: right; width: 50%; border: 1px solid #ccc" src="supplementary_nar_webservices_2016/deepblue_use_cases - case_1.png">
              </center>
            </div>
          </dd>

          <h4 style="padding: 10px 0px 20px 0px " id='example-search_experiments'><b>Source code</b>  <small>(Copy it into your python interpreter)</small></h4>
          <dt>
            <br />
            <br />
            <br />
            <br />
            <p>We import the necessary libraries and assign to the variable <i>server</i> to a XML-RPC object for accessing the DeepBlue server. <small>(lines 1 - 7)</small></p>
            <br />
            <br />
            <br />
            <p>We select all the <i>H3k27ac</i> from the BLUEPRINT project. <small>(lines 9-12)</small></p>
            <br />
            <br />
            <br />
            <p>We select the regions of the annotation <i>promoter</i> from the genome <i>GRCh38</i>. <small>(lines 15-16)</small></p>
            <br />
            <p>We filter the H3K27ac regions that overlap with a promoter region. <small>(line 18)</small></p>
            <br />
            <p>We select the Transcription Factors (TF) <i>AG01</i>, <i>AG02</i>, and <i>AG03</i> from the <i>ENCODE</i> project. <small>(lines 20-21)</small></p>
            <br />
            <p>We filter the TFs regions that overlap with the previously filtered H3K27ac region. <small>(line 24)</small></p>
            <p>We request the regions. Each line will contain a region with its chromosome, start, end, experiment name, epigenetic mark, and biosource. <small>(line 24)</small></p>
            <br />
            <br />
            <br />
            <p>We wait for the processing. <small>(lines 31-35)</small></p>
            <br />
            <br />
            <br />
            <p>We download and print the regions that contains the TFs that overlap with the H3K27ac and the promoters regions. <small>(lines 37-38)</small></p>

          </dt>
          <dd>
            <script src="https://gist.github.com/felipealbrecht/058d4fc13adab7f9c146.js"></script>
          </dd>


          <!-- -->

          <h4 id='example-search_experiments'>Use case 2:<br/><b>Summarizing DNA methylation levels in liver tissue across H3K4me3 peaks regions derived from human embryonic stem cells</b></h4>
          <dt style="width: 60%">
            <br />
            <p class="lead" style="text-align: justify; padding: 15px;">
              We first list all experiments that have a sample with the biosource <i>H1-hESC</i>. After, we select the <i>peaks</i> experiments from this list. These experiment regions will be the boundaries of the aggregation.
            </p>
            <p class="lead" style="text-align: justify; padding: 15px;">
              Here, we list all  experiments with <i>liver</i> or <i>hepatocypes</i> biosources.
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
          <dd style="width: 40%;  margin-left: 55%">
            <div align="right" style="padding: 20px 0px 0px 0px">
              <center>
                <img class="img-responsive" style="align: right; width: 70%; border: 1px solid #ccc" src="supplementary_nar_webservices_2016/deepblue_use_cases - case_2.png">
              </center>
            </div>
          </dd>

          <h4 style="padding: 10px 0px 20px 0px " id='example-search_experiments'><b>Source code</b>  <small>(Copy it into your python interpreter)</small></h4>
          <dt>
            <br />
            <br />
            <br />
            <p>We import the necessary libraries and assign the variable <i>server</i> to a XML-RPC object for accessing the DeepBlue server. <small>(lines 1 - 7)</small></p>
            <p>We test the connection to the server. The expected output is <i>['okay', 'DeepBlue (1.6.5) says hi to anonymous']</i>. <small>(line 8)</small></p>
            <br />
            <br />
            <p>We list and extract all samples IDs with the biosource <i>H1-hESC</i> from the <i>ENCODE</i> project. <small>(lines 10-13)</small></p>
            <br />
            <br />
            <br />
            <p>We list all peaks experiments that contains the previously selected samples IDS, the histone modification H3K4me3 from the <i>ENCODE</i> project.<small>(line 16)</small></p>
            <br />
            <br />
            <p>We extract the IDs from the listed experiments, obtain information about the experiment using the ID, and generate a list of experiments that the original file name ends with "bed.gz". <small>(lines 21-24)</small></p>
            <p>As we are interested in only one experiment file, we do a check if found only one experiment. <small>(lines 25-26)</small></p>
            <br />
            <br />
            <br />
            <p>We select the regions of the selected h1-hESC H3K4me3 experiment. <small>(line 30)</small>
            <br />
            <br />
            <br />
            <br />
            <br />
            <br />
            <br />
            <p>Then, we list and extract the names of the <i>DNA Methylation</i> experiments that contain <i>liver</i> or <i>hepatocyte</i> biosource. <small>(lines 35-40)</small></p>
            <br />
            <br />
            <br />
            <br />
            <br />
            <br />
            <br />
            <br />
            <br />
            <br />
            <br />
            <p>We iterate over each selected <i>DNA Methylation</i> experiment, selecting its regions. <small>(lines 47-52)</small></p>
            <br />
            <br />
            <br />
            <br />
            <br />
            <p>We aggregate the selected regions using the <i>H1-hESC</i> regions.  We perform the aggregation on the column '<i>SCORE</i>'. <small>(lines 55-56)</small></p>
            <br />
            <br />
            <p>We filter and remove the aggregated regions that did not aggregate any region. <small>(lines 59-60)</small></p>
            <br />
            <br />
            <p>Finally, we request the regions with the desired columns. We store the experiment name with the associated request ID, and also the request ID in a list of IDs. <small>(line 63-67)</small>
            <br />
            <br />
            <br />
            <br />
            <br />
            <br />
            <br />
            <br />
            <p> We create an directory to store the data downloaded from DeepBlue. <small>(lines 72-73)</small>
            <br />
            <br />
            <br />
            <p>The data is retrieved later. Were each request status is verified. If the request is <i>done</i>, its data is downloaded, stored in a file, and the request is removed from the list. It is repeated until all requests are processed. <small>(lines 77-90)</small>

          </dt>
          <dd>
            <script src="https://gist.github.com/felipealbrecht/f81c14d2a52e9543567c.js"></script>
          </dd>
          <div style="width: 550px" class="navy-line"></div>


          <!---      -->

          <h4 id='example-search_experiments'>Use case 3:<br/><b>Calculating the mRNA expression level for your favorite genes across all hematopoietic cell types and subsequent filtering regarding those genes regions where the value of the column named “score” is higher than a given threshold</b></h4>
          <dt style="width: 60%">
            <br />
            <p class="lead" style="text-align: justify; padding: 15px;">
              We first select the regions of some genes ('<i>CCR1</i>', '<i>CD164</i>', '<i>CD1D</i>', '<i>CD2</i>', '<i>CD34</i>', '<i>CD3G</i>', '<i>CD44</i>') and filter those regions that are protein coding.
            </p>
            <p class="lead" style="text-align: justify; padding: 15px;">
              We list all signal experiments with <i>liver</i>, <i>hematopoietic</i>, <i>hematopoietic stem cell</i>  biosources.
            <p>
            <p class="lead" style="text-align: justify; padding: 15px;">
              For each listed experiment, we select the associated regions of this experiment.</p>
            <p>
            <p class="lead" style="text-align: justify; padding: 15px;">
              We perform an aggregation with the selected regions using the genes regions as boundaries.</p>
            <p>
            <p class="lead" style="text-align: justify; padding: 15px;">
              Finally, we request the regions and download them.
            <p>
          </dt>
          <dd style="width: 40%;  margin-left: 55%">
            <div align="right" style="padding: 20px 0px 0px 0px">
              <center>
                <img class="img-responsive" style="align: right; width: 70%; border: 1px solid #ccc" src="supplementary_nar_webservices_2016/deepblue_use_cases - case_3.png">
              </center>
           </div>
          </dd>
          <h4 style="padding: 10px 0px 20px 0px " id='example-search_experiments'><b>Source code</b>  <small>(Copy it into your python interpreter)</small></h4>
          <dt>
            <br />
            <br />
            <br />
            <p>We import the necessary libraries and assign the variable <i>server</i> to a XML-RPC object for accessing the DeepBlue server. <small>(lines 1 - 6)</small></p>
            <br />
            <br />
            <br />
            <br />
            <br />
            <br />
            <br />
            <br />
            <p>We select the regions of some selected genes and after we filter those regions that are <i>protein coding</i>. <small>(lines 14-18)</small></p>
            <br />
            <br />
            <br />
            <br />
            <br />
            <br />
            <p>We build a list of all biosources names that are related with <i>liver</i>, <i>hematopoietic</i>, and <i>hematopoietic stem cell</i>. <small>(lines 21-25)</small></p>
            <br />
            <br />
            <br />
            <br />
            <br />
            <p>We list the <i>mRNA</i> signal experiments of the biosources previously listed. <small>(lines 28-32)</small> </p>
            <br />
            <br />
            <br />
            <br />
            <br />
            <br />
            <br />
            <br />
            <br />
            <br />
            <p>We iterate over each selected <i>mRNA</i> experiment, selecting its regions. <small>(lines 39-41)</small></p>
            <br />
            <p>We aggregate the selected regions using the <i>protein encoding genes</i> regions.  We perform the aggregation on the column '<i>VALUE</i>'. <small>(line 43)</small></p>
            <br />
            <p>We filter and remove the aggregated regions that resulting mean is zero. <small>(lines 45-46)</small></p>
            <br />
            <br />
            <br />
            <br />
            <p>Finally, we request the regions with the desired columns. We store the experiment name with the associated request ID, and also the request ID in a list of IDs. <small>(line 50-55)</small>
            <br />
            <br />
            <br />
            <br />
            <br />
            <br />
            <br />
            <br />
            <br />
            <br />
            <p> We create an directory to store the data downloaded from DeepBlue. <small>(lines 62-63)</small>
            <br />
            <br />
            <br />
            <p>The data is retrieved later. Were each request status is verified. If the request is <i>done</i>, its data is downloaded, stored in a file, and the request is removed from the list. It is repeated until all requests are processed. <small>(lines 66-81)</small>
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