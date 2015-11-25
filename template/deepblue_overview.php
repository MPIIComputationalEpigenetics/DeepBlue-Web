<?php

//initilize the page
require_once("inc/init.php");

//require UI configuration (nav, ribbon, etc.)
require_once("inc/config.ui.php");

/*---------------- PHP Custom Scripts ---------

YOU CAN SET CONFIGURATION VARIABLES HERE BEFORE IT GOES TO NAV, RIBBON, ETC.
E.G. $page_title = "Custom Title" */

$page_title = "Overview - DeepBlue Epigenomic Data Server";

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
			<h1> DeepBlue Overview </h1>
			<h6> Abstract presented during <a href="http://ihec-epigenomes-tokyo.org/abstracts/deepblue-epigenomic-data-server">IHEC 2016</a></h6>
			<p class="lead" style="text-align: justify;">High volumes of data for studying epigenetic regulation are being generated by epigenomic consortia, including ENCODE, Roadmap Epigenomics, BLUEPRINT Epigenome, and DEEP projects. New problems arise with this data deluge: how to store and distribute the data, how to handle the associated metadata, and how to perform different types of analysis on such data. We developed the DeepBlue Epigenomic Data Server, an online Data Server for storing and working with genomic and epigenomic data, in order to help to address these questions.</p>

			<p class="lead" style="text-align: justify;">DeepBlue provides a means of storing, organizing, searching, and retrieving epigenetic data, addressing the following challenges: (i) coping with the expected increase in volume of available epigenetic data; (ii) keeping our in-house software EpiExplorer [1] and EpiGraph [2] up to date in a timely and efficient manner; (iii) making all data easily accessible in a standardized form to increase efficiency of epigenomic data analysis and software development. Among the DeepBlue features, we highlight: (i) preinstalled datasets from the major epigenomic consortia (ENCODE, Roadmap Epigenomic, and BLUEPRINT Epigenome), (ii) an update module that retrieves the latest epigenome datasets from the repositories of several epigenome consortia, (iii) support for analysis operations directly on the data server, (iii) reproducibility by automatically documenting and storing the analysis steps.</p>

			<p class="lead" style="text-align: justify;">DeepBlue supports a set of analysis operations on the epigenomic data, and implements a controlled vocabulary to ensure the data consistency. The set of available operations includes: filtering epigenomic data by metadata and region attributes, finding overlapping regions sets, grouping regions, retrieving DNA sequences retrieval and pattern matching operations. DeepBlue can be accessed via an XML-RPC protocol that is supported by all major programming languages. The data are stored using MongoDB [3]. We use MongoDB because it has a flexible data model and also provides scalability through data distribution across several computers nodes (sharding). We use as internal epigenomic data storage and analysis tool. </p>

			<p class="lead" style="text-align: justify;">The manual, API reference, and tutorials are available at http://deepblue.mpi-inf.mpg.de/. This work has been supported by German Science Ministry Grant No. 01KU1216A (DEEP project) and has been performed in the context of EU grant no. HEALTH-F5-2011-282510 (BLUEPRINT project).</p>

			<p class="lead" style="text-align: justify;">
			[1] Halachev, K., Bast, H., Albrecht, F., Lengauer, T. & Bock, C. EpiExplorer: live exploration and global analysis of large epigenomic datasets. Genome Biology 13, R96 (2012). <br />
			[2] Bock, C., Halachev, K., Büch, J. &amp Lengauer, T. EpiGRAPH: user-friendly software for statistical analysis and prediction of (epi)genomic data. Genome Biology 10, R14 (2009). <br />
			[3] MongoDB, Inc. MongoDB http://www.mongodb.org/
			</p>
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