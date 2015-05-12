<?php

//initilize the page
require_once("inc/init.php");

//require UI configuration (nav, ribbon, etc.)
require_once("inc/config.ui.php");

/*---------------- PHP Custom Scripts ---------

YOU CAN SET CONFIGURATION VARIABLES HERE BEFORE IT GOES TO NAV, RIBBON, ETC.
E.G. $page_title = "Custom Title" */

$page_title = "DeepBlue Epigenomic Data Server";

/* ---------------- END PHP Custom Scripts ------------- */

//include header
//you can add your custom css in $page_css array.
//Note: all css files are inside css/ folder
$page_css[] = "deepblue.css";
$no_main_header = true;
$page_body_prop = array("id"=>"extr-page");
include("inc/header.php");

?>
<!-- ==========================CONTENT STARTS HERE ========================== -->
<!-- possible classes: minified, no-right-panel, fixed-ribbon, fixed-header, fixed-width-->
<header id="header">
	<!--<span id="logo"></span>-->

	<div id="logo-group">
		<span id="logo">
			<a href="<?php echo ASSETS_URL; ?>">
				<img src="<?php echo ASSETS_URL; ?>/img/logo.png" alt="DeepBlue Epigenomic Data Server">
			</a>
		</span>
	</div>

	<div class="navbar-collapse collapse">
    	<ul class="nav navbar-nav navbar-left">
			<li><span id="extr-page-header-space"><a href="features.php">Features List</a></span></li>
        	<li><span id="extr-page-header-space"><a href="manual">Manual</a></span></li>
        	<li><span id="extr-page-header-space"><a href="api.php">API Reference</a></span></li>
    	</ul>
  	</div>

	<span id="extr-page-header-space">
		<span class="hidden-mobile">Need an account?</span>
		<a href="<?php echo APP_URL; ?>/register.php" class="btn btn-danger">Create account</a>
	</span>

</header>

<div id="main" role="main">
	<!-- MAIN CONTENT -->
	<div id="content" class="container">
		<div class="row">
			<h1> Features </h1>
			<ul>
				<li>DeepBlue contains the Methylation (WGBS, RRBS, and Infinium 450k), Histone Modifications and Variants, DNaseI, Transcription Factors Binding Sites, Chromatin State Segmetation, and gene expression (mRNA-seq) datasets from the major epigenome consortia: ENCODE, Roadmap Epigenomic, and BLUEPRINT Epigenomics</li>
				<li>Update module that retrieves the latest epigenome datasets from the major epigenome consortia</li>
				<li>Access via an XML-RPC protocol that is supported by all major programming languages</li>
				<li>Web Interface (in development)</li>
				<li>User data upload facility</li>
				<li>Analysis operations performed directly on the data server</li>
				<li>Reproducibility by automatic documenting and storing of the analysis steps</li>
				<li>Controlled vocabulary to ensure data consistency</li>
				<li>Full text search command, expanded for all experiments metadata and controlled vocabularies</li>
				<li>BioSources data hierarchy and synonyms</li>
				<li>Flexible data model for storing experiments metadata</li>
				<li>Data Compression</li>
				<li>Data scalability through data distribution across several compute nodes (sharding), provided by MongoDB</li>
				<li>Distributed processing</li>
				<li>A set of operations for working with the data (see below)</li>
			</ul>
			<h1>Data Operations</h1>
			<ul>
				<li>Select epigenomic data from pre-installed datasets or datasets uploaded by the user</li>
				<li>Filter epigenomic data by metadata</li>
				<li>Filter epigenomic data by region attributes</li>
				<li>Find overlapping regions sets</li>
				<li>Group regions</li>
				<li>Retrieve DNA sequences</li>
				<li>DNA pattern matching operations</li>
				<li>Aggregate and summarize regions</li>
				<li>Count regions</li>
				<li>Output in BED format with desired columns</li>
			</ul>
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