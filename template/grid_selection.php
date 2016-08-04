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

?>
<div style="padding:10px; border:none; background:#FFF">
    <?php include("inc/grid.php"); ?>
    <div class="alert alert-info alert-block" id="selection-banner">
        Double click the row to unselect an experiment. It will be removed from the data table.</br>
        Click in the <i>Select Experiments</i> button to get the queryID referencing the selected experiments.</br>
    </div>
    <?php include("inc/selection_table.php"); ?>
</div>

<script type="text/javascript">

    var user_key = "<?php echo $_SESSION['user_key'] ?>";
    var otherWindow;
    var targetOrigin;
    var server = location.protocol + "//" + location.hostname;

    pageSetUp();

    function receiveMessage(event)
    {
        // Do we trust the sender of this message?
        if (event.origin !== server) {
            console.log("address error: " +  event.origin);
            return;
        }
        if (event.data !== "connect") {
            console.log("connect value error: " +  event.data);
            return;
        }

        otherWindow = event.source;
        targetOrigin = event.origin;
    }

    var pagefunction = function() {

        window.addEventListener("message", receiveMessage, false);
        gridPage();
        $("#downloadBtnBottom").html("Select Experiments");
        $('#downloadBtnBottom').click(function(e){
            var request = $.ajax({
                url: "ajax/server_side/select_experiments_server_processing.php",
                dataType: "json",
                data : {
                    experiments_ids : selected
                }
            });
            request.done( function(data) {
                if ("error" in data) {
                    swal({
                        title: "Request Failed.",
                        text: data['message']
                    });
                    return;
                }
                var query_id = data.query_id;
                if (otherWindow !== undefined) {
                    otherWindow.postMessage(query_id, targetOrigin);
                    window.close();
                }
                else {
                    swal({
                        title: "Calling window not found",
                        type: "warning",
                        text: "The  queryID is " + data.query_id
                    }, function(){
                        window.close();
                    })
                }
            });
            request.fail( function(jqXHR, textStatus) {
                console.log(jqXHR);
                console.log('Error: '+ textStatus);
            });
        });
    };

    // load related plugins
    loadScript("js/plugin/bootstrap-tags/bootstrap-tagsinput.min.js", function(){
        loadScript("js/plugin/datatables/jquery.dataTables.min.js", function(){
            loadScript("js/plugin/datatables/dataTables.colVis.min.js", function(){
                loadScript("js/plugin/datatables/dataTables.tableTools.min.js", function(){
                    loadScript("js/plugin/datatables/dataTables.bootstrap.min.js", function(){
                        loadScript("js/plugin/datatable-responsive/datatables.responsive.min.js", function(){
                            loadScript("js/clipboard.min.js", function(){
                                loadScript("js/jquery.sticky.js", function() {
                                    loadScript("js/grid.js", pagefunction);
                                });
                            });
                        });
                    });
                });
            });
        });
    });
</script>
