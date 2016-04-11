<?php

//initilize the page
require_once("inc/init.php");

//require UI configuration (nav, ribbon, etc.)
require_once("inc/config.ui.php");

/*---------------- PHP Custom Scripts ---------

YOU CAN SET CONFIGURATION VARIABLES HERE BEFORE IT GOES TO NAV, RIBBON, ETC.
E.G. $page_title = "Custom Title" */

$page_title = "Citing DeepBlue Epigenomic Data Server";

/* ---------------- END PHP Custom Scripts ------------- */

//include header
//you can add your custom css in $page_css array.
//Note: all css files are inside css/ folder
$page_css[] = "deepblue.css";
$no_main_header = true;
$page_body_prop = array("id"=>"extr-page");
include("inc/header.php");

?>

</style>

<?php include("landing_menu.php"); ?>

<div id="main" role="main">
	<!-- MAIN CONTENT -->
	<div id="content" class="container">
		<h2>Please, use the following reference for citing DeepBlue:</h2>
		<div class="row" style="width: 525px">
			Albrecht,F., List,M., Bock,C. and Lengauer,T. (2016) DeepBlue epigenomic data server: programmatic data retrieval and analysis of epigenome region sets. <i>Nucleic Acids Research</i>, <a href="http://dx.doi.org/10.1093/nar/gkw211">doi:10.1093/nar/gkw211</a> <b>(In press)</b>
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