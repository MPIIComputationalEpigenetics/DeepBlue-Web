<?php

/**
*   DeepBlue Epigenomic Data Server
*   Copyright (c) 2016 Max Planck Institute for Computer Science.
*   All rights reserved.
*
*   File : expeirment_set.php
*
*   Felipe Albrecht <felipe.albrecht@mpi-inf.mpg.de>
*
*   Created : 08-09-2016
*/

//initilize the page
require_once("inc/init.php");
require_once("inc/config.ui.php");
include_once("lib/server_settings.php");

// start session
if (isset($_SESSION['user_key'])) {
    $_SESSION['key'] = $_SESSION['user_key'];
}
else {
    $_SESSION['key'] = 'anonymous_key';
}


/*---------------- PHP Custom Scripts ---------

YOU CAN SET CONFIGURATION VARIABLES HERE BEFORE IT GOES TO NAV, RIBBON, ETC.
E.G. $page_title = "Custom Title" */

$page_title = "Experiments set - DeepBlue Epigenomic Data Server";

/* ---------------- END PHP Custom Scripts ------------- */

//include header
//you can add your custom css in $page_css array.
//Note: all css files are inside css/ folder
$page_css[] = "deepblue.css";
$page_css[] = "sweetalert.css";

$no_main_header = true;
$page_body_prop = array("id"=>"extr-page");
include("inc/header.php");

?>

<?php include "landing_menu.php";?>

<div class="container">
    <div class="row">
        <div class="col-sm-12">

            <div id="info_content" class="tab-content bg-color-white padding-10">
                <div class="tab-pane fade in active" id="s1">
                    <br />
                    <div class="alert alert-info alert-block">
                        <h1 class="alert-heading">
                            Experiment set
                        </h1>
                    </div>
                    <div id="request_info">

                    </div>
                </div>
                <div class='clear'></div>
            </div>
        </div>
    </div>
</div>


<?php
    //include required scripts
    include("inc/scripts.php");

    //include footer
    include("inc/google-analytics.php");
?>

<script src="js/get_request_data.js"></script>
<script type="text/javascript">

    if (location.search.split('_id=') == "")  {
        var msg = "RequestID not specified. Read instructions above";
        $( "#request_info" ).append( "<br\><div class='alert alert-danger fade in'><button class='close'" +
            " data-dismiss='alert'>×</button><i class='fa-fw fa fa-times'></i> " + msg +"</div>");
    }
    else {
        var _id = location.search.split('_id=')[1];
        var request1 = $.ajax({
            url: "ajax/server_side/experiment_set_info.php",
            dataType: "json",
            data : {
                _id: _id
            }
        });
        request1.done( function(data) {
            if ("error" in data) {
                var msg = data['message'];
                $( "#request_info" ).append( "<br\><div class='alert alert-danger fade in'><button class='close'" +
                    " data-dismiss='alert'>×</button><i class='fa-fw fa fa-times'></i> " + msg +"</div>");
                return;
            }
            debugger;
            console.log(data);
            var item = data[0];
            var _id = item["_id"];
            var name = item["name"];
            var experiments = item["experiments"];
            var description = item["description"];
            $( "#request_info" ).append(
            "<table class='table'>" +
            "<tr><td>ID</td><td>" + _id + "</td></tr>" +
            "<tr><td>Name</td><td>" + name + "</td></tr>" +
            "<tr><td>Description</td><td>" + description + "</td></tr>" +
            "<tr><td>Experiments</td><td>" + experiments + "</td></tr>" +
            "</table>");
        });
        request1.fail( function(jqXHR, textStatus) {
            console.log(jqXHR);
            console.log('Error: '+ textStatus);
            alert( "Encountered an error. Please wait a few seconds and reload page. If problem persist, kindly log a complaint" );
        });
    }

    setTimeout(function(){
        window.location.reload(1);
    }, 60000);

</script>