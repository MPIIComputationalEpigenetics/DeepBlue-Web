<?php require_once("inc/init.php"); ?>
<!-- row -->
<div class="row">
	
	<!-- col -->
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		<h1 class="page-title txt-color-blueDark text-center">
			
			<!-- PAGE HEADER -->
				SmartAdmin Different Versions<br>
				<small class="text-success"><strong>When you buy SmartAdmin you will gain access to all four versions!</strong></small>
		</h1>
		
	</div>
	<!-- end col -->
	
</div>
<!-- end row -->

<!--
	The ID "widget-grid" will start to initialize all widgets below 
	You do not need to use widgets if you dont want to. Simply remove 
	the <section></section> and you can use wells or panels instead 
	-->

<!-- widget grid -->
<section id="widget-grid" class="">

	<!-- row -->

	<div class="row">

		<div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
			<!-- your contents here -->
				
			<div class="jumbotron padding-10 text-center bg-color-white">
				<img src="img/versions/ajaxversion.png" alt="Ajax Version" style="margin-left:-40px; width: 150px; margin-top:20px">
				<h1 style="font-size: 30px;">Jquery AJAX Version</h1>
				<h5 class="text-left padding-5" style="min-height:350px">				
					AJAX version uses robust scripts to lazyload pages, components and plugins - to act as a single page app. 
					Its built to run smoothly in all devices. Highly recommended for small scale projects as it is easily manageable. 
					<br>
					<br>
					This is the our favorite out of all four versions, mostly because it's easy to build with, customize
					and keep things into perspective. Please see the demo by clicking below.
				</h5>
				<a href="http://192.241.236.31/themes/preview/smartadmin/1.4.1/ajaxversion" target="_blank" class="btn btn-default btn-lg btn-block btn-primary">AJAX Demo <i class="fa fa-long-arrow-right"></i></a>
			</div>
			
		</div>

		<div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
			<!-- your contents here -->
			<div class="jumbotron padding-10 text-center bg-color-white">
				<img src="img/versions/angularversion.png" alt="AngularJS Version" style="margin-left:-40px; width: 150px; margin-top:20px">
				<h1 style="font-size: 30px;">AngularJS Version</h1>
				<h5 class="text-left padding-5" style="min-height:350px">
					The AngularJS version of SmartAdmin is a fusion of two worlds. AJAX and AngularJS working together in harmony.
					It uses lazyload ajax method to load scripts, custom directives for navigation, message Board 
					and angular UI components. Has basic localization (e.g language change demo) with ngRoute, while 
					keeping all BootstrapJS compatibility intact. Highly recommended for large scale projects!
					<br><br>
					This would be an ideal choise for your next AngularJS project! See the demo by clicking the link below.
				</h5>
				<a href="http://192.241.236.31/themes/preview/smartadmin/1.4.1/angularjs" target="_blank" class="btn btn-default btn-lg btn-block btn-danger">Angular Demo <i class="fa fa-long-arrow-right"></i></a>
			</div>
			
		</div>

		<div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
			<!-- your contents here -->
			<div class="jumbotron padding-10 text-center bg-color-white">
				<img src="img/versions/htmlversion.png" alt="HTML Version" style="margin-left:-40px; width: 150px; margin-top:20px">
				<h1 style="font-size: 30px;">HTML Version</h1>
				<h5 class="text-left padding-5" style="min-height:350px">
					HTML Version gives you the flexibility to go in any direction. It comes with clean and pure HTML5 
					validated codes, with no loss of design or UI integrity from other verions. Use this version of 
					SmartAdmin as a stand point to start in any platform you wish. Whether it is .Net, PHP, reactJS, 
					Django or any other platforms out there, this version would be the ideal choice to go with.
					<br><br>
					<strong>Please note</strong> : This demo is not currently available on our live site.
				</h5>
				<button class="btn btn-default btn-lg btn-block btn-warning" disabled>Not Available for Demo</button>
			</div>
			
		</div>
		
		<div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
			<!-- your contents here -->
			<div class="jumbotron padding-10 text-center bg-color-white">
				<img src="img/versions/phpversion.png" alt="PHP Version" style="margin-left:-40px; width: 150px; margin-top:20px">
				<h1 style="font-size: 30px;">PHP/HTML Version</h1>
				<h5 class="text-left padding-5" style="min-height:350px">
					<span class="air air-top-right" style="padding:15px 30px 0 0">
						<i class="fa fa-check-circle fa-3x text-primary"></i>
					</span>
					PHP version comes in two forms, <a href="javascript:void(0);">PHP HTML</a> and  <a href="javascript:void(0);">PHP AJAX</a> - they both come with a number of built in 
					PHP classes to help you get a boost in your project and save you maybe months of work. 
					<br>
					<br>				
					Just to name a few of the custom classes available off the bat are datatable, widgets, button, 
					accordion and multiple Smart Form Classes.
					<br>
					<br>
					Please click the link below to check out the list of our PHP classes. You will not be disappointed!
				</h5>
				<a href="javascript:void(0);" class="btn btn-default btn-lg btn-block btn-primary disabled txt-color-white">PHP Demo <i class="fa fa-long-arrow-right"></i></a>
			</div>
			
		</div>		
			
	</div>

	<!-- end row -->

</section>
<!-- end widget grid -->

<script type="text/javascript">
	
	/* DO NOT REMOVE : GLOBAL FUNCTIONS!
	 *
	 * pageSetUp(); WILL CALL THE FOLLOWING FUNCTIONS
	 *
	 * // activate tooltips
	 * $("[rel=tooltip]").tooltip();
	 *
	 * // activate popovers
	 * $("[rel=popover]").popover();
	 *
	 * // activate popovers with hover states
	 * $("[rel=popover-hover]").popover({ trigger: "hover" });
	 *
	 * // activate inline charts
	 * runAllCharts();
	 *
	 * // setup widgets
	 * setup_widgets_desktop();
	 *
	 * // run form elements
	 * runAllForms();
	 *
	 ********************************
	 *
	 * pageSetUp() is needed whenever you load a page.
	 * It initializes and checks for all basic elements of the page
	 * and makes rendering easier.
	 *
	 */

	pageSetUp();
	
	/*
	 * ALL PAGE RELATED SCRIPTS CAN GO BELOW HERE
	 * eg alert("my home function");
	 * 
	 * var pagefunction = function() {
	 *   ...
	 * }
	 * loadScript("js/plugin/_PLUGIN_NAME_.js", pagefunction);
	 * 
	 * TO LOAD A SCRIPT:
	 * var pagefunction = function (){ 
	 *  loadScript(".../plugin.js", run_after_loaded);	
	 * }
	 * 
	 * OR
	 * 
	 * loadScript(".../plugin.js", run_after_loaded);
	 */

	// pagefunction
	
	var pagefunction = function() {
		
	};
	
	// end pagefunction
	
	// run pagefunction on load

	pagefunction();	
	
</script>
