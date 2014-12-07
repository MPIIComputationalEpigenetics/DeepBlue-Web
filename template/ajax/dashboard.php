<!--*
*   DeepBlue Epigenomic Data Server
*   Copyright (c) 2014 Max Planck Institute for Computer Science.
*   All rights reserved.
*
*   File : dashboard.php
*
*   Felipe Albrecht <felipe.albrecht@mpi-inf.mpg.de>
*   Umidjon Urunov <umidjon.urunov@mpi-inf.mpg.de>
*		Obaro Odiete <s8obodie@stud.uni-saarland.de>
*
*   Created : 25-08-2014
*
*		Last Updated : 07-12-2014
*
-->

<?php 

	/* DeepBlue Configuration */
	require_once("../lib/lib.php");
	
	/* include IXR Library for RPC-XML */
	require_once("../lib/deepblue.IXR_Library.php");
	
	$client = new IXR_Client($url);
	
	/* retrieve all the data required for the table */
	$vocabulary = array("projects","epigenetic_marks", "biosources", "techniques");
	$list = array();
	$total_sum = array();
	
	foreach ($vocabulary as $vocab) {
		$list[$vocab] = array(); // index for each controlled vocabulary
		$total_sum[$vocab] = 0; // total experiments in each vocabulary - would be the same value
		
		if(!$client->query("list_in_use", $vocab, $user_key)){
				die('An error occurred - '.$client->getErrorCode().": ".$client->getErrorMessage());
		}
		else{
			$result = $client->getResponse();
			/* check if query returned a valid result */
			if ($result[0] =='okay') {
				$j = 0; // index for each experiment in each controlled vocabulary
				foreach($result[1] as $item) {
					$list[$vocab][$j] = array('value' => $item[2], 'label' => $item[1]);
					$total_sum[$vocab] = $total_sum[$vocab] + $item[2];
					$j = $j + 1;
				}
			}
			else {
				die('An error occured - '.$result[0].': '.$result[1]);
			}
		}
	}
?>

<div class="row">
	<div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
		<h1 class="page-title txt-color-blueDark">
    	<i class="fa-fw fa fa-home"></i>
      	DeepBlue Dashboard
    </h1>
	</div>
	<div class="col-xs-12 col-sm-5 col-md-5 col-lg-8">
		<ul id="sparks" class="">
			<li class="sparks-info">
				<h5> Total Experiments <span class="txt-color-blue"><?php echo json_encode($total_sum['projects']);?></span></h5>
			</li>
			<li class="sparks-info">
				<h5> Number of Users <span class="txt-color-purple"><i class="fa fa-arrow-circle-up" data-rel="bootstrap-tooltip" title="Increased"></i>&nbsp;3</span></h5>
			</li>
		</ul>
	</div>
</div>


<!-- widget grid -->
<section id="widget-grid" class="">
	<!-- row -->
	<div class="row">
		
		<!-- NEW WIDGET START -->
		<article class="col-xs-12 col-sm-6 col-md-6 col-lg-6">

			<!-- Widget ID (each widget will need unique ID)-->
			<div class="jarviswidget" id="wid-id-1" data-widget-editbutton="false">
				<!-- widget options:
					usage: <div class="jarviswidget" id="wid-id-0" data-widget-editbutton="false">
					
					data-widget-colorbutton="false"	
					data-widget-editbutton="false"
					data-widget-togglebutton="false"
					data-widget-deletebutton="false"
					data-widget-fullscreenbutton="false"
					data-widget-custombutton="false"
					data-widget-collapsed="true" 
					data-widget-sortable="false"
					
				-->
				<header>
					<span class="widget-icon"> <i class="fa fa-bar-chart-o"></i> </span>
					<h2>Projects</h2>				
					
				</header>

				<!-- widget div-->
				<div>
					
					<!-- widget edit box -->
					<div class="jarviswidget-editbox">
						<!-- This area used as dropdown edit box -->
						
					</div>
					<!-- end widget edit box -->
					
					<!-- widget content -->
					<div class="widget-body no-padding">
						
						<div id="projects-graph" class="chart no-padding"></div>
						
					</div>
					<!-- end widget content -->
					
				</div>
				<!-- end widget div -->
				
			</div>
			<!-- end widget -->

			<!-- Widget ID (each widget will need unique ID)-->
			<div class="jarviswidget" id="wid-id-3" data-widget-editbutton="false">
				<!-- widget options:
					usage: <div class="jarviswidget" id="wid-id-0" data-widget-editbutton="false">
					
					data-widget-colorbutton="false"	
					data-widget-editbutton="false"
					data-widget-togglebutton="false"
					data-widget-deletebutton="false"
					data-widget-fullscreenbutton="false"
					data-widget-custombutton="false"
					data-widget-collapsed="true" 
					data-widget-sortable="false"
					
				-->
				<header>
					<span class="widget-icon"> <i class="fa fa-bar-chart-o"></i> </span>
					<h2>Epigenetic Marks</h2>				
					
				</header>

				<!-- widget div-->
				<div>
					
					<!-- widget edit box -->
					<div class="jarviswidget-editbox">
						<!-- This area used as dropdown edit box -->
						
					</div>
					<!-- end widget edit box -->
					
					<!-- widget content -->
					<div class="widget-body no-padding">
						
						<div id="epigenetics-graph" class="chart no-padding"></div>
						
					</div>
					<!-- end widget content -->
					
				</div>
				<!-- end widget div -->
				
			</div>
			<!-- end widget -->
		</article>
		<!-- WIDGET END -->

		<!-- NEW WIDGET START -->
		<article class="col-xs-12 col-sm-6 col-md-6 col-lg-6">

			<!-- Widget ID (each widget will need unique ID)-->
			<div class="jarviswidget" id="wid-id-2" data-widget-editbutton="false">
				<!-- widget options:
					usage: <div class="jarviswidget" id="wid-id-0" data-widget-editbutton="false">
					
					data-widget-colorbutton="false"	
					data-widget-editbutton="false"
					data-widget-togglebutton="false"
					data-widget-deletebutton="false"
					data-widget-fullscreenbutton="false"
					data-widget-custombutton="false"
					data-widget-collapsed="true" 
					data-widget-sortable="false"
					
				-->
				<header>
					<span class="widget-icon"> <i class="fa fa-bar-chart-o"></i> </span>
					<h2>Biosources </h2>				
					
				</header>

				<!-- widget div-->
				<div>
					
					<!-- widget edit box -->
					<div class="jarviswidget-editbox">
						<!-- This area used as dropdown edit box -->
						
					</div>
					<!-- end widget edit box -->
					
					<!-- widget content -->
					<div class="widget-body no-padding">
						
						<div id="biosources-graph" class="chart no-padding"></div>
						
					</div>
					<!-- end widget content -->
					
				</div>
				<!-- end widget div -->
				
			</div>
			<!-- end widget -->

			<!-- Widget ID (each widget will need unique ID)-->
			<div class="jarviswidget" id="wid-id-4" data-widget-editbutton="false">
				<!-- widget options:
					usage: <div class="jarviswidget" id="wid-id-0" data-widget-editbutton="false">
					
					data-widget-colorbutton="false"	
					data-widget-editbutton="false"
					data-widget-togglebutton="false"
					data-widget-deletebutton="false"
					data-widget-fullscreenbutton="false"
					data-widget-custombutton="false"
					data-widget-collapsed="true" 
					data-widget-sortable="false"
					
				-->
				<header>
					<span class="widget-icon"> <i class="fa fa-bar-chart-o"></i> </span>
					<h2>Techniques </h2>				
					
				</header>

				<!-- widget div-->
				<div>
					
					<!-- widget edit box -->
					<div class="jarviswidget-editbox">
						<!-- This area used as dropdown edit box -->
						
					</div>
					<!-- end widget edit box -->
					
					<!-- widget content -->
					<div class="widget-body no-padding">
						
						<div id="techniques-graph" class="chart no-padding"></div>
						
					</div>
					<!-- end widget content -->
					
				</div>
				<!-- end widget div -->
				
			</div>
			<!-- end widget -->
		</article>
		<!-- WIDGET END -->
		
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
	
	// PAGE RELATED SCRIPTS
	
	// pagefunction
	
	var pagefunction = function() {
	// projects
		if ($('#projects-graph').length){
			Morris.Donut({
				element: 'projects-graph',
				data:<?php echo json_encode($list['projects']);?>,
				formatter: function (x) { return x}
			});
		}
	
		// epigenetics
		if ($('#epigenetics-graph').length){
			Morris.Donut({
				element: 'epigenetics-graph',
				data: <?php echo json_encode($list['epigenetic_marks']);?>,
				formatter: function (x) { return x + "%"}
			});
		}
		
		// biosources
		if ($('#biosources-graph').length){
			Morris.Donut({
				element: 'biosources-graph',
				data:<?php echo json_encode($list['biosources']);?>,
				formatter: function (x) { return x}
			});
		}

		// biosources
		if ($('#techniques-graph').length){
			Morris.Donut({
				element: 'techniques-graph',
				data: <?php echo json_encode($list['techniques']);?>,
				formatter: function (x) { return x}
			});
		}
	};

	// end pagefunction
	
	// Load morris dependencies and run pagefunction
	loadScript("js/plugin/morris/raphael.min.js", function(){
		loadScript("js/plugin/morris/morris.min.js", pagefunction);
	});

</script>
