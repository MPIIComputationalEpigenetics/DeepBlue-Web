<?php

//initilize the page
require_once("inc/init.php");

//require UI configuration (nav, ribbon, etc.)
require_once("inc/config.ui.php");

/*---------------- PHP Custom Scripts ---------

YOU CAN SET CONFIGURATION VARIABLES HERE BEFORE IT GOES TO NAV, RIBBON, ETC.
E.G. $page_title = "Custom Title" */

$page_title = "Tutorials - DeepBlue Epigenomic Data Server";

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
		<div class="row">
			<h1> Tutorials List </h1>
			<ul>
				<li><a href="https://gist.github.com/felipealbrecht/6e84aa529551e20268a2#file-01-01-connect_to_the_server-py">Accessing DeepBlue</a></li>
				<li><a href="https://gist.github.com/felipealbrecht/64655b560fac6a1f9674#file-01-02-data-listing-py">Data Listing</a></li>
				<li><a href="https://gist.github.com/felipealbrecht/0e61b615f0ca018510cc#file-01-03-biosources-py">BioSources</a></li>
				<li><a href="https://gist.github.com/felipealbrecht/876793c496066609940b#file-01-04-samples-py">Samples</a></li>
				<li><a href="https://gist.github.com/felipealbrecht/6d166087d4d77584b1bb#file-01-05-experiments-py">Downloading data from experiments</a></li>
				<li><a href="https://gist.github.com/felipealbrecht/28105a18e3ae3c5f3dd6#file-01-06-summarizing-py">Summarizing methylation level by CpG Island of the monocyte cells</a>
				<li>More examples in the <a href="examples.php">operations</a> page
				</li>
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