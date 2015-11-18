<?php

//initilize the page
require_once("inc/init.php");

//require UI configuration (nav, ribbon, etc.)
require_once("inc/config.ui.php");

/*---------------- PHP Custom Scripts ---------

YOU CAN SET CONFIGURATION VARIABLES HERE BEFORE IT GOES TO NAV, RIBBON, ETC.
E.G. $page_title = "Custom Title" */

$page_title = "DeepBlue Epigenomic Data Server";

// check server online status
require_once("php/deepblue_status.php");
check_server_status();

if (isset($_SESSION['user_key'])) {
	$user_key = $_SESSION['user_key'];
	header("Location:  ../dashboard.php");
}

/* ---------------- END PHP Custom Scripts ------------- */

//include header
//you can add your custom css in $page_css array.
//Note: all css files are inside css/ folder
$page_css[] = "deepblue.css";
$no_main_header = true;
$page_body_prop = array("id"=>"extr-page", "class"=>"landing-page");
include("inc/header.php");

?>

<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
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

	<div class="navbar-collapse collapse hidden-mobile">
    	<ul class="nav navbar-nav navbar-left">
			<li><span id="extr-page-header-space"><a href="features.php">Features</a></span></li>
        	<li><span id="extr-page-header-space"><a href="examples.php">Examples</a></span></li>
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
			<div class="row" style="padding-bottom:20px;">
				<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 hidden-xs hidden-sm no-padding">
					<img src="<?php echo ASSETS_URL; ?>/img/logo.png" class="display-image index-middle-logo" alt="">
				</div>
				<div class="col-xs-12 col-sm-12 col-md-7 col-lg-7 hidden-xs hidden-sm no-padding">
					<br/>
					<br/>
          <h3>Try DeepBlue right now! Just click on the <a href="php/deepblue_checkuser.php">Access DeepBlue</a> button!</h3>
         </div>
			</div>

			<div class="row">
				<div class="col-md-14">
					<div class="col-md-4 col-lg-4 hidden-xs hidden-sm">
						<div class="pull-left">
							<h4 class="paragraph-header" style="text-align:justify">DeepBlue Epigenomic Data Server provides a central data access hub for large collections of epigenomic data. It organizes the data from different sources using controlled vocabularies and ontologies. The data is stored in our server server, where the users can access the data programmatically or by or web interface.</h4>
							<h4 class="paragraph-header" style="text-align:justify">DeepBlue contains a set of operations designed for operation on epigenomic data, for example, data overlapping and aggregations. The users can execute all the operations in a pipeline fashion in the server and transfer only the meaningful data. DeepBlue is open and free or charge. Request your account and start using it.</h4>
						</div>
					</div>

					<div class="col-md-5 col-lg-5" style="margin-top: 15px">
						<div style=>
							<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
		  					<div class="panel panel-default">
		    					<div class="panel-heading" role="tab" id="headingOne">
		      					<h3 class="panel-title">
		        					<a role="button" style="text-decoration: none" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">Direct access to DeepBlue</a>
		      					</h3>
		    					</div>
		    					<div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
		      					<div class="panel-body">
											<a style="padding: 10px; font-size: 150%;" class="btn btn-primary btn-block" href=<?php echo APP_URL.'/php/deepblue_checkuser.php' ?> role="button">Access DeepBlue</a>
		      					</div>
		    					</div>
		  					</div>
		  					<div class="panel panel-default">
		    					<div class="panel-heading" role="tab" id="headingTwo">
		      					<h3 class="panel-title">
		        					<a class="collapsed" role="button" style="text-decoration: none" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
		          				Login with your credentials
		        					</a>
		      					</h3>
		    					</div>
		    					<div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
		      					<div class="panel-body no-padding">
		        					<form action="<?php echo APP_URL.'/php/deepblue_checkuser.php' ?>" id="login-form" class="smart-form client-form" method="post">
											<?php if (isset($_SESSION['login_attempt'])) {
													echo
			                                '
			                                <script>
			                                	$(collapseOne).removeClass("in");
			                                	$(collapseTwo).addClass("in");
			                                </script>
			                                <section>
			                                    <div class="alert alert-danger fade in" id="login-banner">
			                                        <button class="close" data-dismiss="alert">×</button>
			                                        <i class="fa-fw fa fa-times"></i>'.$_SESSION['login_attempt'].
			                                    '</div>
			                                </section>';
			                                }
			                                unset($_SESSION['login_attempt']);
													?>
												<fieldset>
													<section>
														<label class="label">E-mail</label>
														<label class="input"> <i class="icon-append fa fa-user"></i>
															<input type="email" name="email">
															<b class="tooltip tooltip-top-right"><i class="fa fa-user txt-color-teal"></i> Please enter email address/username</b>
														</label>
													</section>

													<section>
														<label class="label">Password</label>
														<label class="input"> <i class="icon-append fa fa-lock"></i>
															<input type="password" name="password">
															<b class="tooltip tooltip-top-right"><i class="fa fa-lock txt-color-teal"></i> Enter your password</b>
														</label>
														<div class="note">
															<a href="<?php echo APP_URL; ?>/forgotpassword.php">Forgot password?</a>
														</div>
													</section>

													<section>
														<label class="checkbox">
															<input type="checkbox" name="remember" checked=""><i></i>Stay signed in</input>
														</label>
													</section>

												</fieldset>
												<footer>
													<button type="submit" class="btn btn-primary">Login with your credentials</button>
												</footer>
											</form>
										</div>
		      				</div>
		    				</div>
		  				</div>
						</div>
					</div>

					<div class="col-md-3 col-lg-3 hidden-xs hidden-sm" style="margin-top: 15px">
						<a class="twitter-timeline" href="https://twitter.com/deepblue_data" data-widget-id="659363721148551169">Tweets by @deepblue_data</a>
						<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
					</div>
				</div>
			</div>
		</div>
	</div>

  <!-- Features view -->
  <div class="container features">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="navy-line"></div>
                <h1>Over 30,000 experiments accessible by </br>
                a set of commands developed for handling epigenomic data</span> </h1>
                <p>Among the DeepBlue <a href="features.php">features</a>: </p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3 text-center wow fadeInLeft">
                <div>
                    <i class="fa fa-terminal fa-3x fa-blue"></i>
                    <h2 class="txt-color-red login-header-big">API for Epigenomic data</h2>
                    <p align="justify">DeepBlue provides a set of commands specially crafted for searching, finding, handling, and download epigenomic data. The processing is made in ours servers. The users only need to download the meaningful data.</p>
                    <p align="justify">The commands are sent to ours servers through XMl-RPC protocol, that is a language agnostic protocol, meaning that the users can use they favorite programming language.</p>
                </div>
                <br>
                <div class="m-t-lg">
                    <i class="fa fa-cloud fa-3x fa-blue"></i>
                    <h2 class="txt-color-red login-header-big">Web interface</h2>
                    <p align="justify">Together with the API, DeepBlue has an intuitive web portal, where the users can access and handle the epigenomic data.</p>
                </div>
            </div>
            <div class="col-md-6 text-center wow zoomIn">
                <br>
                <br>
                <br>
                <br>
                <img src="img/landing/dashboard.png" alt="dashboard" class="img-rounded" width="100%">
                <br>
                <br>
                <br>
                <br>
            </div>
            <div class="col-md-3 text-center wow fadeInRight">
                <div>
                    <i class="fa fa-database fa-3x fa-blue"></i>
                    <h2 class="txt-color-red login-header-big">Epigenomic Data</h2>
                    <p align="justify">DeepBlue contains more than 30 thousand experiments (peaks and signal) files from the main epigenome mapping projects: ENCODE, BLUEPRINT, NIH Roadmap, and DEEP. We also allow and encourage the users to upload their own data.</p>
                    <p align="justify">The data is organized using controlled vocabularies and well defined terms from ontologies (EFO, CL, and UBERON).</p>
                    <br/>
                    <br/>
                </div>
                <br>
                <div class="m-t-lg">
                    <i class="fa fa-book fa-3x fa-blue"></i>
                    <h2 class="txt-color-red login-header-big">Documentation</h2>
                    <p align="justify">DeepBlue contains a full API reference, a complete manual, and tutorials for easing the initial steps.</p>
                </div>
            </div>
        </div>
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

<section id="contact" class="gray-section contact">
    <div class="container">
        <div class="row m-b-lg">
            <div class="col-lg-12 text-center">
                <div class="navy-line"></div>
                <h1>Contact Us</h1>
                <p>For questions, suggestions, bug reports, or any comment</p>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 text-center">
                <a href="mailto:deepblue@mpi-inf.mpg.de" class="btn btn-primary">Send us mail</a>
                <p class="m-t-sm">
                    Or follow us on social platform:
                </p>
                <ul class="list-inline social-icon">
                    <li><a href="https://twitter.com/deepblue_data"><i class="fa fa-twitter"></i> Twitter</a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 text-center m-t-lg m-b-lg">
                <p><strong>&copy; Max Planck Institute for Computer Science 2015</strong><br/>D3: Computational Biology &amp; Applied Algorithmics</p>
            </div>
        </div>
    </div>
</section>


<!-- ==========================CONTENT ENDS HERE ========================== -->
<?php
	//include required scripts
	include("inc/scripts.php");
?>

<!-- PAGE RELATED PLUGIN(S)
<script src="..."></script>-->

<script type="text/javascript">
	runAllForms();

	$(function() {
		// Validation
		$("#login-form").validate({
			// Rules for form validation
			rules : {
				email : {
					required : true,
					email : true
				},
				password : {
					required : true,
					minlength : 3,
					maxlength : 20
				}
			},

			// Messages for form validation
			messages : {
				email : {
					required : 'Please enter your email address',
					email : 'Please enter a VALID email address'
				},
				password : {
					required : 'Please enter your password'
				}
			},

			// Do not change code below
			errorPlacement : function(error, element) {
				error.insertAfter(element.parent());
			}
		});
	});

	// clear previous session local storage
	localStorage.clear();
</script>

<?php
	//include footer
	include("inc/google-analytics.php");
?>