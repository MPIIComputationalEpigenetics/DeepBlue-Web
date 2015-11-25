<?php

//initilize the page
require_once("inc/init.php");

//require UI configuration (nav, ribbon, etc.)
require_once("inc/config.ui.php");

/*---------------- PHP Custom Scripts ---------

YOU CAN SET CONFIGURATION VARIABLES HERE BEFORE IT GOES TO NAV, RIBBON, ETC.
E.G. $page_title = "Custom Title" */

$page_title = "Features - DeepBlue Epigenomic Data Server";

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
        width:280px;
        white-space: normal;
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

			<h1 style="margin-bottom: 25px;"> DeepBlue Features</h1>
			<dl class="dl-horizontal" id="freelance">
				<dt>Thousand datasets</dt>
				<dd>DNA Methylation, Histone modifications and variants, DNaseI, Transcription Factors Binding Sites, Chromatin State Segmentation, and gene expression (mRNA) datasets from the major epigenome consortia: <i>ENCODE</i>, <i>ROADMAP Epigenomic</i>, <i>BLUEPRINT Epigenome</i>, and <i>DEEP</i>.</dd>

				<dt>Operations for epigenomic data</dt>
				<dd>Select, filter, summarize, transform, and download the epigenomic data. See some examples in our <a href="examples.php">examples</a> page.</dd>

				<dt>Peaks and signal data experiments</dt>
				<dd>DeepBlue contains the peaks (<i>bed</i>) and signals (<i>wig</i>, <i>bedgraph</i>) datasets. It is virtually possible to import into DeepBlue any file that is based on genomic region.</dd>

				<dt>Auxiliary annotations</dt>
				<dd>Genes, promoters, CpG island, transcripts, and more. You are welcome and encouraged to upload their own annotations.</dd>

				<dt>Language-agnostic</dt>
				<dd>The access is made via an XML-RPC protocol that is supported by all major programming languages.</dd>

				<dt>Metadata consistency</dt>
				<dd>Every experiment has 5 mandatory fields (<i>genome</i>, <i>epigenetic mark</i>, <i>sample</i>, <i>technique</i>, and <i>project</i>) that are registered with their metadata into their collections for data consistency.</dd>

				<dt>Flexible metadata model</dt>
				<dd>DeepBlue ensure the consistency through the mandatory fields (<i>genome</i>, <i>epigenetic mark</i>, <i>sample</i>, <i>technique</i>, and <i>project</i>) are used to ensure the data consistency. More information about the data can be included using the <i>extra-metadata</i>, a key-value container, where any information about the data can be stored and searched.</dd>

				<dt>Names from ontologies</dt>
				<dd>DeepBlue imports the biological source names  (cell lines, cell types, tissues, organs, and others) from the CL, EFO, and UBERON ontologies. The terms synonyms and terms hierarchy are also imported.</dd>

				<dt>Full text search</dt>
				<dd>DeepBlue full text search is expanded to all experiments metadata and controlled vocabularies. The samples information, genomes, epigenetic marks, techniques, experiments, and annotations metadata are indexed and searchable by full text input.</dd>

				<dt>Upload your own data</dt>
				<dd>You can upload your own experimental and annotation data.</dd>

				<dt>Private experimental data</dt>
				<dd>You can create your own private projects, where the experiments stored there are only visible to you and invited colleagues.</dd>

				<dt>Processing in ours servers</dt>
				<dd>The operations are performed directly on the data server. You only have to download the final result.</dd>

				<dt>Reproducing analysis steps</dt>
				<dd>The data operations are stored in the server and can be re-executed and shared with colleagues. DeepBlue automatically documents the steps that were executed during the analysis.</dd>

				<dt>Web Interface</dt>
				<dd>You can browse, search, and download the data included into DeepBlue using our user friendly interface.
				</dd>

				<dt>Anonymous access</dt>
				<dd>You are not obligated to create an account. You can access DeepBlue data and its mean features without having to register.
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