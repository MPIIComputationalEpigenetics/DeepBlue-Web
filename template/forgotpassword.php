<?php

//initilize the page
require_once("inc/init.php");

//require UI configuration (nav, ribbon, etc.)
require_once("inc/config.ui.php");

/*---------------- PHP Custom Scripts ---------

YOU CAN SET CONFIGURATION VARIABLES HERE BEFORE IT GOES TO NAV, RIBBON, ETC.
E.G. $page_title = "Custom Title" */

$page_title = "Forgot Password";

/* ---------------- END PHP Custom Scripts ------------- */

//include header
//you can add your custom css in $page_css array.
//Note: all css files are inside css/ folder
$page_css[] = "deepblue.css";
$no_main_header = true;
$page_body_prop = array("id"=>"extr-page", "class"=>"animated fadeInDown");
include("inc/header.php");

?>
<!-- ==========================CONTENT STARTS HERE ========================== -->
<!-- possible classes: minified, no-right-panel, fixed-ribbon, fixed-header, fixed-width-->
<header id="header">
	<!--<span id="logo"></span>-->

	<div id="logo-group">
		<span id="logo">
			<a href="<?php echo ASSETS_URL; ?>">
				<img src="<?php echo ASSETS_URL; ?>/img/logo.png" alt="DeepBlue Epigenomic Data Server">
			</a>
		</span>
	</div>

	<div class="navbar-collapse collapse">
    	<ul class="nav navbar-nav navbar-left">
			<li><span id="extr-page-header-space"><a href="features.php">Features</a></span></li>
        	<li><span id="extr-page-header-space"><a href="operations.php">Operations</a></span></li>
        	<li><span id="extr-page-header-space"><a href="manual">Manual</a></span></li>
        	<li><span id="extr-page-header-space"><a href="api.php">API Reference</a></span></li>
        	<li><span id="extr-page-header-space"><a href="tutorials.php">Tutorials</a></span></li>
    	</ul>
  	</div>

	<span id="extr-page-header-space">
		<span class="hidden-mobile">Need an account?</span>
		<a href="<?php echo APP_URL; ?>/register.php" class="btn btn-danger">Request an account</a>
	</span>

</header>

		<div id="main" role="main">

			<!-- MAIN CONTENT -->
			<div id="content" class="container">

				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-7 col-lg-8 hidden-xs hidden-sm">
						<h1 class="txt-color-red login-header-big">DeepBlue Epigenomic Data Server</h1>
						<div class="hero">

							<div class="pull-left login-desc-box-l">
								<h4 class="paragraph-header">DeepBlue provides a central data access hub for large collections of epigenomic data. It organizes the data from different sources using controlled vocabularies and ontologies. The data is stored in our server server, where the users can access the data programmatically or by or web interface.</h4>
								<h4 class="paragraph-header">DeepBlue contains a set of operations designed for operation on epigenomic data, for example, data overlapping and aggregations. The users can execute all the operations in a pipeline fashion in the server and transfer only the meaningful data. DeepBlue is open and free or charge. Request your account and start using it.</h4>
							</div>

							<img src="<?php echo ASSETS_URL; ?>/img/logo.png" class="pull-right display-image index-middle-logo" alt="">
						</div>
<div class="container">
    <div class="row">
      	<div class="col-lg-12 text-center">
      		<br/>
			<div class="navy-line"></div>
			<br/>
            <p>DeepBlue is possible because the support of:</p>
            <br/>
        </div>
    </div>
    <div class="container-fluid">
	    <div class="row">
			<div class="col-xs-6 col-sm-5cols">
				<a href="http://www.mpg.de/en"><img height="80px" src="img/minerva-MPG-small.png"/></a>
			</div>
			<div class="col-xs-6 col-sm-5cols">
				<a href="http://www.mpi-inf.mpg.de/"><img height="80px" src="img/mpilogo-inf-compact.png"/></a>
			</div>
			<div class="col-xs-6 col-sm-5cols">
				<a href="http://www.deutsches-epigenom-programm.de/"><img height="80px" src="img/DEEP_Logo.jpg"/></a>
			</div>
			<div class="col-xs-6 col-sm-5cols">
				<a href="http://www.blueprint-epigenome.eu/"><img height="80px" src="img/blueprint.png"/></a>
			</div>
		</div>
	</div>
</div>

					</div>
					<div class="col-xs-12 col-sm-12 col-md-5 col-lg-4">
						<div class="well no-padding">
							<form action="<?php echo APP_URL; ?>/index.php" id="login-form" class="smart-form client-form">
								<header>
									Forgot Password
								</header>

								<fieldset>

									<section>
										<label class="label">Enter your email address</label>
										<label class="input"> <i class="icon-append fa fa-envelope"></i>
											<input type="email" name="email">
											<b class="tooltip tooltip-top-right"><i class="fa fa-envelope txt-color-teal"></i> Please enter email address for password reset</b></label>
									</section>
									<section>
										<span class="timeline-seperator text-center text-primary"> <span class="font-sm">OR</span>
									</section>
									<section>
										<label class="label">Your Username</label>
										<label class="input"> <i class="icon-append fa fa-user"></i>
											<input type="text" name="username">
											<b class="tooltip tooltip-top-right"><i class="fa fa-user txt-color-teal"></i> Enter your username</b> </label>
										<div class="note">
											<a href="<?php echo APP_URL; ?>/index.php">I remembered my password!</a>
										</div>
									</section>

								</fieldset>
								<footer>
									<button type="submit" class="btn btn-primary">
										<i class="fa fa-refresh"></i> Reset Password
									</button>
								</footer>
							</form>

						</div>
					</div>
				</div>
			</div>

		</div>

<!-- END MAIN PANEL -->
<!-- ==========================CONTENT ENDS HERE ========================== -->

<?php
	//include required scripts
	include("inc/scripts.php");
?>

<!-- PAGE RELATED PLUGIN(S)
<script src="..."></script>-->

		<script type="text/javascript">
			runAllForms();

		</script>

<?php
	//include footer
	include("inc/google-analytics.php");
?>