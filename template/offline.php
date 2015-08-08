<?php

//initilize the page
require_once("inc/init.php");

//require UI configuration (nav, ribbon, etc.)
require_once("inc/config.ui.php");

// check server status
require_once("lib/deepblue.IXR_Library.php");
require_once("lib/server_settings.php");

$client = new IXR_Client(get_server());
if($client->query("echo", '')){
    header("Location:  ../index.php");
}

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
</header>

<div id="main" role="main">

    <!-- MAIN CONTENT -->
    <div id="content" class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 hidden-xs hidden-sm">
                <h1 class="txt-color-red login-header-big">DeepBlue Server is currently offline. The DeepBlue team has been notified and is working to bring it back up.</h1>
                <div class="text-center">
                    <img src="<?php echo ASSETS_URL; ?>/img/logo.png" class="display-image index-middle-logo" alt="">
                </div>
            </div>
        </div>
    </div>
</div>

<!-- END MAIN PANEL -->
<!-- ==========================CONTENT ENDS HERE ========================== -->