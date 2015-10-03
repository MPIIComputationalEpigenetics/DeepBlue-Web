<?php

session_start();

//initilize the page
require_once("inc/init.php");

//require UI configuration (nav, ribbon, etc.)
require_once("inc/config.ui.php");

// require session configuration
include_once("lib/lib.php");

/*---------------- PHP Custom Scripts ---------

YOU CAN SET CONFIGURATION VARIABLES HERE BEFORE IT GOES TO NAV, RIBBON, ETC. */



/* ---------------- END PHP Custom Scripts ------------- */

//include header
//you can add your custom css in $page_css array.
//Note: all css files are inside css/ folder
$page_css[] = "sweetalert.css";
$page_css[] = "bootstro.css";
$page_css[] = "deepblue.css";
$page_css[] = "jstree/default/style.css";
include("inc/header.php");

//include left panel (navigation)
//follow the tree in inc/config.ui.php
include("inc/nav.php");

?>
<!-- ==========================CONTENT STARTS HERE ========================== -->
<!-- MAIN PANEL -->
<div id="main" role="main">
	<?php
		include("inc/ribbon.php");
	?>

	<!-- MAIN CONTENT -->
	<div id="content">

	</div>
	<!-- END MAIN CONTENT -->

</div>
<!-- END MAIN PANEL -->

<!-- FOOTER -->
	<?php
		include("inc/footer.php");
	?>
<!-- END FOOTER -->

<!-- ==========================CONTENT ENDS HERE ========================== -->
<?php
	//include required scripts
	include("inc/scripts.php");
	//include footer
	include("inc/google-analytics.php");
?>

<!-- include script to load deepblue data -->
<script src="<?php echo ASSETS_URL; ?>/js/deepblue.js"></script>