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

    <!-- Custom styles for this template -->
    <link href="css/starter-template.css" rel="stylesheet">

    <!-- Style from the Deepblue website -->
    <link href="css/smartadmin-production.min.css" rel="stylesheet">

    <!-- FAVICONS -->
    <link rel="shortcut icon" href="img/favicon/favicon.ico" type="image/x-icon">
    <link rel="icon" href="img/favicon/favicon.ico" type="image/x-icon">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
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
    </div>
</div> <!-- /container -->


<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="js/bootstrap.min.js"></script>
<script>
    function receiveMessage(event)
    {
        // Do we trust the sender of this message?  (might be
        // different from what we originally opened, for example).

        if (event.origin !== "http://localhost") {	// should point to http://deepblue.mpi-inf.mpg.de in live application
            console.log("address error: " +  event.origin);
            return;
        }
        alert(event.data);
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
