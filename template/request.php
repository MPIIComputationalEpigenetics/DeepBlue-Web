<?php

//initilize the page
require_once("inc/init.php");

require_once("inc/config.ui.php");

include_once("lib/server_settings.php");

/*---------------- PHP Custom Scripts ---------

YOU CAN SET CONFIGURATION VARIABLES HERE BEFORE IT GOES TO NAV, RIBBON, ETC.
E.G. $page_title = "Custom Title" */

$page_title = "Requesting account - DeepBlue Epigenomic Data Server";

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

<div class="row">
    <div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
        <h1 class="page-title txt-color-blueDark"><i class="fa fa-info"></i>
            Request Status
        </h1>
    </div>
</div>

<div class="row" style="margin: 25px;">
    <div id="request_info"/>
</div>


<!-- ==========================CONTENT ENDS HERE ========================== -->
<?php
    //include required scripts
    include("inc/scripts.php");
    //include footer
    include("inc/google-analytics.php");
?>

<script type="text/javascript">
    function getRegion(event) {
        var id = event.target.id.split('_')[1];
        window.open('<?php echo get_server() ?>/download/?r='+id+'&key=anonymous_key','_blank');
    }

    if (location.search.split('_id=') == "")  {
        alert("plese, inform the id");
    } else {
        var request_id = location.search.split('_id=')[1]
        var request1 = $.ajax({
            url: "ajax/server_side/request_status.php",
            dataType: "json",
            data : {
                _id : request_id
            }
        });
        request1.done( function(data) {
            if ("error" in data) {
                swal({
                    title: "Error listing experiments",
                    text: data['message']
                });
                return;
            }
            console.log(data);

            $("#request_info").append("<h1>"+data[0]+"</h1><br/>").append(data[1]+"<br/>").append(data[2]+"<br/>").append(data[3]+"<br/>").append(data[4]+"<br/>").append(data[5])
        });
        request1.fail( function(jqXHR, textStatus) {
            console.log(jqXHR);
            console.log('Error: '+ textStatus);
            alert( "Encountered an error. Please wait a few seconds and reload page. If problem persist, kindly log a complaint" );
        });
    }
</script>