<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Obaro Odiete">

    <title>DeepBlue Epigenomic Data Server Portal</title>

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
      <div id="logo-group">
  	    <span id="logo"> <img src="img/logo-big.png" alt="DeepBlue Epigenomic Data Server"> </span>
      </div>
	  </header>
    <div class="container">
      <!-- Example row of columns -->
      <div class="row">
        <div class="col-md-4">
          <div class="form-group hidden">
            <label for="userkey" id="usekey-label">User key</label>
            <input class="form-control" type="text" id="userkey" name="userkey" disabled value="mk8xHba3tqpeRPy4">
          </div>
          <h1 class="txt-color-red login-header-big">Command</h1>
          <hr/>
          <div class="radio">
          	<label>
            	<input type="radio" name="options" id="listexperiment" value="1" checked onChange="toggle_commands()"> List All Experiments
            </label>
          </div>
          <div class="radio">
          	<label>
            	<input type="radio" name="options" id="listinuse" value="2" onChange="toggle_commands()"> List All Terms
            </label>
          </div>
          <hr/>
         	<div id="command1" style="display:none">
            <div class="form-group">
              <label for="vocabulary" id="vocab-label">Controlled Vocabulary</label>
              <select class="form-control" id="vocabulary" name="vocabulary">
                <option value="genomes" selected>Genomes</option>
                <option value="epigenetic_marks">Epigenetic Marks</option>
                <option value="biosources">BioSources</option>
                <option value="techniques">Techniques</option>
                <option value="projects">Projects</option>
              </select>
            </div>
					</div>
          <div id="command2">
            <div class="form-group">
              <label for="genome" id="genome-label">Genome</label>
              <select class="form-control" id="genome" name="genome">
                <option value="">None</option>
              </select>
            </div>

            <div class="form-group">
              <label for="epigenetic" id="epigenetic-label">Epigenetic Mark</label>
              <select class="form-control" id="epigenetic" name="epigenetic">
                <option value="" selected>None</option>
              </select>
            </div>
            <div class="form-group">
              <label for="biosource" id="sample-label">Biosource</label>
              <select class="form-control" id="biosource" name="biosource">
                <option value="" selected>None</option>
              </select>
            </div>
            <div class="form-group">
              <label for="sample" id="sample-label">Sample</label>
              <select class="form-control" id="sample" name="sample">
                <option value="" selected>None</option>
              </select>
            </div>
            <div class="form-group">
              <label for="technique" id="technique-label">Technique</label>
              <select class="form-control" id="technique" name="technique">
                <option value="" selected>None</option>
              </select>
            </div>
            <div class="form-group">
              <label for="project" id="project-label">Project</label>
              <select class="form-control" id="project" name="project">
                <option value="" selected>None</option>
              </select>
            </div>
          </div>
          <div>
            <button type="submit" class="btn btn-primary" onClick="filter()"> Submit </button>
          </div>
        </div>
        <div class="col-md-8">
          <h1 class="txt-color-red login-header-big">Results</h1>
          <hr/>
          <div id="container">
          </div>
      </div>
      </div>
			<hr>
      <p id="version"></p>
    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="js/mimic.js"></script>
    <script src="js/Chart.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/deepblue.js"></script>

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>