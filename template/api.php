<?php
	require_once("inc/init.php");
	require_once("inc/config.ui.php");
	require_once("lib/deepblue.api.php");

	$deepBlueObj = new DeepblueApi();
	$page_title = $deepBlueObj->getServerVersion() . " Reference API";

	$page_css[] = "deepblue.css";
	$no_main_header = true;
	$page_body_prop = array("id"=>"extr-page");

	include("inc/header.php");

?>

<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>

<?php include("landing_menu.php"); ?>

<div style="padding-left:20px">
	<h1 "margin:30px"><?php echo $page_title; ?></h1>
</div>

<div style="padding-left:30px; background:#FFF">
	<?php $deepBlueObj->displayAPIList(True);?>
</div>


<?php
	//include required scripts
	include("inc/scripts.php");
?>