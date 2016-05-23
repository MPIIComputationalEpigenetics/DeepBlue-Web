<?php
//include required scripts
include("inc/scripts.php");

//include footer
include("inc/google-analytics.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Obaro Odiete">

    <title>Launch Grid</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Style from the Deepblue website -->
    <link href="css/smartadmin-production.min.css" rel="stylesheet">
</head>

<body id="extr-page">
<header id="header">
    <!--<span id="logo"></span>-->
</header>
<div class="container">
    <!-- Example row of columns -->
    <div class="row">
        <br>
        <div>
            <button type="submit" class="btn btn-primary" onClick="openGrid()"> DeepBlue Grid </button>
        </div>
        <br>
        <div id="selection_info">
        </div>
    </div>
</div> <!-- /container -->


<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script>
    function receiveMessage(event)
    {
        // Do we trust the sender of this message?  (might be
        // different from what we originally opened, for example).

        if (event.origin !== "http://localhost") {	// should point to http://deepblue.mpi-inf.mpg.de in live application
            console.log("address error: " +  event.origin);
            return;
        }
        var query_id = event.data;
        var request2 = $.ajax({
            url: "api/info",
            type: "GET",
            dataType: "JSON",
            data : {
                id : query_id
            }
        });
        request2.done( function(data) {
            if ("error" in data) {
                swal({
                    title: "Error listing experiments",
                    text: data['message']
                });
                return;
            }
            var selections = $.parseJSON(data[1][0]['args']);
            var experiments = selections['experiment_name'];
            console.log(experiments);

            var output = "<b>Experiments:</b><br>";
            for (var i=0;i<experiments.length;i++) {
                output += experiments[i] + "<br>";
            }
            $("#selection_info").append(output);
        });
        request2.fail( function(jqXHR, textStatus) {
            console.log(jqXHR);
            console.log('Error: '+ textStatus);
            alert( "Encountered an error. Please wait a few seconds and reload page. If problem persist, kindly log a complaint" );
        });
    }

    function openGrid() {
        var popup = window.open("grid_selection.php");
        setTimeout(function(){
            console.log("Connecting");
            popup.postMessage("connect", "http://localhost"); // should point to http://deepblue.mpi-inf.mpg.de in live application
        }, 6000);
        window.addEventListener("message", receiveMessage, false);
    }
</script>
</body>
</html>
