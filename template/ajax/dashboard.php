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
					$list[$vocab][$j] = array('label' => $item[1], 'data' => $item[2]);
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
			<div class="jarviswidget" id="wid-id-0" data-widget-editbutton="false">
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
						
						<div id="projects-chart" class="chart"></div>
						
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
					<h2>Techniques</h2>				
					
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
						
						<div id="techniques-chart" class="chart"></div>
						
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

	<!-- row -->
	<div class="row">
		
		<!-- NEW WIDGET START -->
		<article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			
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
					<h2>Genomes</h2>				
					
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
						
						<div id="genomes-chart" class="chart"></div>
						
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

	<!-- row -->
	<div class="row">
		
		<!-- NEW WIDGET START -->
		<article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			
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
						
						<div id="epigenetic-marks-chart" class="chart"></div>
						
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
	
	// manage clicks
	$('#projects-chart').bind("plotclick", function (event, pos, item) {
        if (item) { 
            alert(item.series.label);
        }
    });

	$('#techniques-chart').bind("plotclick", function (event, pos, item) {
        if (item) { 
            alert(item.series.label);
        }
    });
		
	// PAGE RELATED SCRIPTS
	var pagefunction = function() {

		/* chart colors default */
		var $chrt_border_color = "#efefef";
		var $chrt_grid_color = "#DDD"
		var $chrt_main = "#E24913";			/* red       */
		var $chrt_second = "#6595b4";		/* blue      */
		var $chrt_third = "#FF9F01";		/* orange    */
		var $chrt_fourth = "#7e9d3a";		/* green     */
		var $chrt_fifth = "#BD362F";		/* dark red  */
		var $chrt_mono = "#000";

		/* pie chart default options */
		var pie_option = {
			series: {
				pie: {
					show: true,
					innerRadius: 0.5,
					radius:  1,
					label: {
						show: false,						
					}
				}
			},
			
			legend: {
				show: true,
				noColumns : 1, // number of colums in legend table
				labelFormatter : null, // fn: string -> string
				labelBoxBorderColor : "#000", // border color for the little label boxes
				container : null, // container (as jQuery object) to put legend in, null means default on top of graph
				position : "ne", // position of default legend container within plot
				margin : [5, 10], // distance from grid edge to default legend container within plot
				backgroundColor : "#efefef", // null means auto-detect
				backgroundOpacity : 1 // set to 0 to avoid background
			},
			
			grid : {
				hoverable : true,
				clickable : true
			}										
		};
													
		/* projects pie chart */
		if ($('#projects-chart').length) {
				var placeholder = "#projects-chart";
				var data = <?php echo json_encode($list['projects']);?>;
				var option = pie_option;				

				$.plot($(placeholder), data, option);
		}
		/* end projects pie chart */

		/* techniques pie chart */
		if ($('#techniques-chart').length) {
				var placeholder = "#techniques-chart";
				var data = <?php echo json_encode($list['techniques']);?>;
				var option = pie_option;				
								
				$.plot($(placeholder), data, option);
		}
		/* end techniques pie chart */
		
		
		/* bar chart */
		if ($("#genomes-chart").length) {

			var data1 = [];
			for (var i = 0; i <= 12; i += 1)
				data1.push([i, parseInt(Math.random() * 30)]);
	
			var data2 = [];
			for (var i = 0; i <= 12; i += 1)
				data2.push([i, parseInt(Math.random() * 30)]);
	
			var data3 = [];
			for (var i = 0; i <= 12; i += 1)
				data3.push([i, parseInt(Math.random() * 30)]);
	
			var ds = new Array();
	
			ds.push({
				data : data1,
				bars : {
					show : true,
					barWidth : 0.2,
					order : 1,
				}
			});
			ds.push({
				data : data2,
				bars : {
					show : true,
					barWidth : 0.2,
					order : 2
				}
			});
			ds.push({
				data : data3,
				bars : {
					show : true,
					barWidth : 0.2,
					order : 3
				}
			});
	
			//Display graph
			$.plot($("#genomes-chart"), ds, {
				colors : [$chrt_second, $chrt_fourth, "#666", "#BBB"],
				grid : {
					show : true,
					hoverable : true,
					clickable : true,
					tickColor : $chrt_border_color,
					borderWidth : 0,
					borderColor : $chrt_border_color,
				},
				legend : true,
				tooltip : true,
				tooltipOpts : {
					content : "<b>%x</b> = <span>%y</span>",
					defaultTheme : false
				}
	
			});
	
		}
		
		/* end genomes bar chart */

		
		/* epigenetic marks bar chart */
		if ($("#epigenetic-marks-chart").length) {

			var data1 = [];
			for (var i = 0; i <= 12; i += 1)
				data1.push([i, parseInt(Math.random() * 30)]);
	
			var ds = new Array();
	
			ds.push({
				data : data1,
				bars : {
					show : true,
					barWidth : 0.2,
					order : 1,
				}
			});
	
			//Display graph
			//var placeholder = 
			$.plot($("#epigenetic-marks-chart"), ds, {
				colors : [$chrt_second, $chrt_fourth, "#666", "#BBB"],
				grid : {
					show : true,
					hoverable : true,
					clickable : true,
					tickColor : $chrt_border_color,
					borderWidth : 0,
					borderColor : $chrt_border_color,
				},
				legend : true,
				tooltip : true,
				tooltipOpts : {
					content : "<b>%x</b> = <span>%y</span>",
					defaultTheme : false
				}
	
			});
		}
		
		/* end genomes bar chart */		
	}; 	// end pagefunction

	// load all flot plugins
	loadScript("js/plugin/flot/jquery.flot.cust.min.js", function(){
		loadScript("js/plugin/flot/jquery.flot.resize.min.js", function(){
			loadScript("js/plugin/flot/jquery.flot.fillbetween.min.js", function(){
				loadScript("js/plugin/flot/jquery.flot.orderBar.min.js", function(){
					loadScript("js/plugin/flot/jquery.flot.pie.min.js", function(){
						loadScript("js/plugin/flot/jquery.flot.tooltip.min.js", pagefunction);
					});
				});
			});
		});
	});
	

	
	
</script>
