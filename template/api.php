<?php
	require_once("lib/deepblue.api.php");
	require_once("inc/init.php");
	require_once("inc/config.ui.php");

	$deepBlueObj = new DeepblueApi();
	$page_title = $deepBlueObj->getServerVersion() . " Reference API";

	$no_main_header = true;
	$page_body_prop = array("id"=>"deepblue-api");

	include("inc/header.php");
?>


<div style="margin:30px; padding:20px; overflow:hidden; z-index:999999; background:#FFF">
	<h1 "margin:30px; padding:20px; overflow:hidden; z-index:999999; background:#FFF"><?php echo $page_title; ?></h1>
</div>

<div style="margin:30px; padding:20px; overflow:hidden; z-index:999999; background:#FFF">
	<?php $deepBlueObj->displayAPIList();?>
</div>

<!-- Link to Google CDN's jQuery + jQueryUI; fall back to local -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
<script>
	if (!window.jQuery) {
		document.write('<script src="<?php echo ASSETS_URL; ?>/js/libs/jquery-2.0.2.min.js"><\/script>');
	}
</script>
