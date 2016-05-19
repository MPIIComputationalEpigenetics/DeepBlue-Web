<?php

// start session
if (isset($_SESSION['user_key'])) {
    $_SESSION['key'] = $_SESSION['user_key'];
}
else {
    session_start();
    include_once("php/deepblue_anonymous.php");
}

//initilize the page
require_once("inc/init.php");
require_once("inc/config.ui.php");
include_once("lib/server_settings.php");


/*---------------- PHP Custom Scripts ---------

YOU CAN SET CONFIGURATION VARIABLES HERE BEFORE IT GOES TO NAV, RIBBON, ETC.
E.G. $page_title = "Custom Title" */

$page_title = "Grid - DeepBlue Epigenomic Data Server";

/* ---------------- END PHP Custom Scripts ------------- */

//include header
//you can add your custom css in $page_css array.
//Note: all css files are inside css/ folder
$page_css[] = "deepblue.css";
$page_css[] = "sweetalert.css";

$no_main_header = true;
$page_body_prop = array("id"=>"extr-page");
include("inc/header.php");

//include required scripts
include("inc/scripts.php");

//include footer
include("inc/google-analytics.php");

include "landing_menu.php";
?>
<div style="padding:10px; border:none; background:#FFF">
    <?php include("ajax/grid.php"); ?>
</div>

<script type="text/javascript">

    var user_key = "<?php echo $_SESSION['user_key'] ?>";
    pageSetUp();
    var pagefunction = function() {
        gridPage();
    };

    // load related plugins
    loadScript("js/plugin/bootstrap-tags/bootstrap-tagsinput.min.js", function(){
        loadScript("js/plugin/datatables/jquery.dataTables.min.js", function(){
            loadScript("js/plugin/datatables/dataTables.colVis.min.js", function(){
                loadScript("js/plugin/datatables/dataTables.tableTools.min.js", function(){
                    loadScript("js/plugin/datatables/dataTables.bootstrap.min.js", function(){
                        loadScript("js/plugin/datatable-responsive/datatables.responsive.min.js", function(){
                            loadScript("js/grid.js", pagefunction)
                        });
                    });
                });
            });
        });
    });
</script>
