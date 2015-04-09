<!--*
*   DeepBlue Epigenomic Data Server
*   Copyright (c) 2014 Max Planck Institute for Computer Science.
*   All rights reserved.
*
*   File : dashboard.php
*
*   Felipe Albrecht <felipe.albrecht@mpi-inf.mpg.de>
*   Umidjon Urunov <umidjon.urunov@mpi-inf.mpg.de>
*	Obaro Odiete <s8obodie@stud.uni-saarland.de>
*
*   Created : 25-08-2014
*
*	Last Updated : 07-12-2014
*
-->

<?php 

	/* DeepBlue Configuration */
	require_once("../lib/lib.php");
	
	/* DeepBlue Class */
	require_once("../lib/deepblue.functions.php");
	$deepBlueObj = new Deepblue();
	
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
				<h5> Total Experiments <span id="total_sum" class="txt-color-blue"></span></h5>
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
					<h2>Technique</h2>				
					
				</header>

				<!-- widget div-->
				<div>
					
					<!-- widget edit box -->
					<div class="jarviswidget-editbox">
						<!-- This area used as dropdown edit box -->
						
					</div>
					<!-- end widget edit box -->
					
					<!-- widget content -->
					<div class="col-sm-1 no-padding">
						<button type="button" id="tech_prev_page" class="btn btn-primary" disabled>
							<i class="fa fa-backward"></i>
						</button>
					</div>
					<div class="widget-body col-sm-10">
						
						<div id="techniques-chart" class="chart"></div>
						
					</div>
					<!-- end widget content -->
					<div class="col-sm-1 no-padding" style="float:right;" >
						<button type="button" id="tech_next_page" class="btn btn-primary" style="float:right;">
							<i class="fa fa-forward"></i>
						</button>
					</div>
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
					<div class="col-sm-1 no-padding">
						<button type="button" id="epi_prev_page" class="btn btn-primary"  disabled>
							<i class="fa fa-backward"></i>
						</button>
					</div>
					<!-- widget content -->
					<div class="widget-body col-sm-10">
						
						<div id="epigenetic_marks-chart" class="chart"></div>
						
					</div>
					<!-- end widget content -->
					<div class="col-sm-1 no-padding" style="float:right;" >
						<button type="button" id="epi_next_page" class="btn btn-primary" style="float:right;">
							<i class="fa fa-forward"></i>
						</button>
					</div>
				</div>
				<!-- end widget div -->
			</div>
			<!-- end widget -->
		</article>
		<!-- WIDGET END -->
	</div>
	<!-- end row -->

	<div class="row">
		
		<!-- NEW WIDGET START -->
		<article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			
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
					<h2>Biosources</h2>				
					
				</header>

				<!-- widget div-->
				<div >
				<!-- widget content -->
					<div class="widget-body col-sm-12">
						<div id="biosources-chart" class="chart" style="text-align:middle"></div>
					</div>
					<div style="text-align:center; margin-bottom: 5px">
						<button type="button" id="bio_prev_page" class="btn btn-primary" disabled>
							<i class="fa fa-backward"></i>
						</button>
						<button type="button" id="bio_sort_amt_page" class="btn btn-primary">
							<i class="fa fa-sort-amount-desc"></i>
						</button>
						<button type="button" id="bio_sort_alp_page" class="btn btn-primary">
							<i class="fa fa-sort-alpha-desc"></i>
						</button>						
						<button type="button" id="bio_next_page" class="btn btn-primary">
							<i class="fa fa-forward"></i>
						</button>
					</div>
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

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="modelSearchExperimentInfo" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
          &times;
        </button>
        <h4 class="modal-title" id="modalSearchExperimenentInfo">Experiment Info</h4>
      </div>
      <div class="modal-body custom-scroll terms-body">
        <div id='modal_for_experiment' style="display:none;"></div>
        <div id="modal-content-by-jquery" style="display:none;">
          <?php echo $deepBlueObj->experimentDataTableTemplate("search"); ?>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" id="downloadExperimentButton" class="btn btn-primary download-btn-size">
          Download
        </button>
        <button type="button" class="btn btn-default" data-dismiss="modal">
          Close
        </button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

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
	
	// MODAL VIEW
	
	// global variable
	var curPageHolder = ['technique','biosource','epigenetic_mark'];
	curPageHolder['biosource'] = 0;
	curPageHolder['epigenetic_mark'] = 0;
	curPageHolder['technique'] = 0;
	var ebar; var bbar; var gbar; var tbar;
	var page = [];
	var counter = 0;

	//

	// bind functions to command buttons
	$("#tech_next_page, #bio_next_page, #epi_next_page, #tech_prev_page, #bio_prev_page, #epi_prev_page").button().click(function(event){
		// switch case based on id
		switch (event.target.id) {
			case 'tech_next_page':
				counter = curPageHolder['technique'];
				if (counter == 0) {
					$("#tech_prev_page").prop('disabled', false);
				}
				if (counter < page['techniques'].length - 1) {
					curPageHolder['technique'] = curPageHolder['technique'] + 1;
					counter = curPageHolder['technique'];
					tbar.setData(page['techniques'][counter]);
				}
				if (counter == page['techniques'].length -1) {
					$("#tech_next_page").prop('disabled', true);
				}
				break;
			case 'tech_prev_page':
				counter = curPageHolder['technique'];
				if (counter == page['technique'].length - 1) {
					$("#tech_next_page").prop('disabled', false);
				}
				if (counter > 0) {
					curPageHolder['technique'] = curPageHolder['technique'] - 1;
					counter = curPageHolder['technique'];
					tbar.setData(page['techniques'][counter]);
				}
				if (counter == 0) {
					$("#tech_prev_page").prop('disabled', true);
				}
				break;
			case 'bio_next_page':
				counter = curPageHolder['biosource'];
				if (counter == 0) {
					$("#bio_prev_page").prop('disabled', false);
				}
				if (counter < page['biosources'].length - 1) {
					curPageHolder['biosource'] = curPageHolder['biosource'] + 1;
					counter = curPageHolder['biosource'];
					bbar.setData(page['biosources'][counter]);
				}
				if (counter == page['biosources'].length -1) {
					$("#bio_next_page").prop('disabled', true);
				}
				break;
			case 'bio_prev_page':
				counter = curPageHolder['biosource'];
				if (counter == page['biosources'].length - 1) {
					$("#bio_next_page").prop('disabled', false);
				}
				if (counter > 0) {
					curPageHolder['biosource'] = curPageHolder['biosource'] - 1;
					counter = curPageHolder['biosource'];
					bbar.setData(page['biosources'][counter]);
				}
				if (counter == 0) {
					$("#bio_prev_page").prop('disabled', true);
				}
				break;
			case 'epi_next_page':
				counter = curPageHolder['epigenetic_mark'];
				if (counter == 0) {
					$("#epi_prev_page").prop('disabled', false);
				}
				if (counter < page['epigenetic_marks'].length - 1) {
					curPageHolder['epigenetic_mark'] = curPageHolder['epigenetic_mark'] + 1;
					counter = curPageHolder['epigenetic_mark'];
					ebar.setData(page['epigenetic_marks'][counter]);
				}
				if (counter == page['epigenetic_marks'].length -1) {
					$("#epi_next_page").prop('disabled', true);
				}
				break;
			case 'epi_prev_page':
				counter = curPageHolder['epigenetic_mark'];
				if (counter == page['epigenetic_marks'].length - 1) {
					$("#epi_next_page").prop('disabled', false);
				}
				if (counter > 0) {
					curPageHolder['epigenetic_mark'] = curPageHolder['epigenetic_mark'] - 1;
					counter = curPageHolder['epigenetic_mark'];
					ebar.setData(page['epigenetic_marks'][counter]);
				}
				if (counter == 0) {
					$("#epi_prev_page").prop('disabled', true);
				}
				break;
		}
			// increment the page counter
			// bbar.setData(page['biosources'][counter]);
	});

    function lauchModalView(label, vocab) {

		$('.modal-content').removeClass( "modalViewSingleInfo" );
		$('#modal_for_experiment').hide();
		$('#modal-content-by-jquery').show();  

		var type = vocab;
		var text = label;

		// there was a special case to handle SAMPLES

		/* Hide and show experiment metadata */
		var isShow = false;
		var last = null;
		$(document).on("click", '.exp-metadata-more-view', function () {
			//var metadata = $(this).prev();
			if(isShow == false){
				$(this).prev().show(1000);
				$(this).text("-- Hide --");
				isShow = true;
			}
			else{
				$(this).prev().hide(1000);
				$(this).text("-- View metadata --");
				isShow = false;
			}

		});

		/* Reset all input values */

		$('.hasinput input').val("");
		$('.hasinput input').prop('disabled', false);

		/* BASIC */
		var responsiveHelper_dt_basic = undefined;
		var responsiveHelper_datatable_fixed_column = undefined;
		var responsiveHelper_datatable_col_reorder = undefined;
		var responsiveHelper_datatable_tabletools = undefined;

		var breakpointDefinition = {
			tablet : 1024,
			phone : 480
		};

		var selectedElementsModal = [];
		/* COLUMN FILTER  */

		var otable = $('#datatable_fixed_column').DataTable({

		    "ajax": {
		    "url": "ajax/server_side/modal_view_server_processing.php",
		    "data": function ( d ) {
		       		d.types = type;
		        	d.titles = text;
		       	}
		    },
		    "iDisplayLength": 50,
		    "autoWidth" : true,
		    "bDestroy": true,
			"preDrawCallback" : function() {
				// Initialize the responsive datatables helper once.
				if (!responsiveHelper_datatable_fixed_column) {
					responsiveHelper_datatable_fixed_column = new ResponsiveDatatablesHelper($('#datatable_fixed_column'), breakpointDefinition);
				}
			},
			"rowCallback" : function(nRow) {
				responsiveHelper_datatable_fixed_column.createExpandIcon(nRow);
			},
			"drawCallback" : function(oSettings) {
				responsiveHelper_datatable_fixed_column.respond();
			},
			"fnInitComplete": function(oSettings, json) {

				var inputName;

				switch (type) {
					case 'experiment':
					    //alert('This is experiment');
					    break;
					case 'annotation':
					    //alert('Annotations');
					    break;
					case 'genome':
					   	inputName = '#experiment-genome';
					    break;
					case 'epigenetic_mark':
					    inputName = '#experiment-epigenetic_mark';
					    break;
					case 'sample':
					    inputName = '#experiment-sample';
					    break;
					case 'technique':
					    inputName = '#experiment-technique';
					    break;
					case 'project':
					    inputName = '#experiment-project';
					    break;
					default:
					    break;
				}
				
				$(inputName).val(text);
				$(inputName).prop('disabled', true);

				/* Insert or remove selected or unselected elements */
				//selectedElementsModal = [];
				$( ".downloadCheckBox" ).change(function() {
					var downloadIdModal = $(this).parent().next().text();
					var downloadTitleModal = $(this).parent().next().next().text();
					var downloadTotalModal = downloadIdModal+"-"+downloadTitleModal;

					var foundModal = $.inArray(downloadTotalModal, selectedElementsModal);

					if(foundModal < 0){
						selectedElementsModal.push(downloadTotalModal);
					}
					else{
						selectedElementsModal.splice(foundModal, 1);
					}
				});

			}

		});


		// custom toolbar
		$("div.toolbar").html('<div class="text-right"><img src="img/logo.png" alt="DeepBlue" style="width: 111px; margin-top: 3px; margin-right: 10px;"></div>');

		// Apply the filter
		$("#datatable_fixed_column thead th input[type=text]").on( 'keyup change', function () {
		    otable
		        .column( $(this).parent().index()+':visible' )
		        .search( this.value )
		        .draw();

		});

		/* Download button :: Getting selected elements */
		$('#downloadBtnTop').click(function(){
			if(selectedElementsModal.length == 0){
				//alert("( Modal ) Please select elements!");
				//alert("( length = 0 ) Klikkkkk");
			}
			else{
				//alert(selectedElementsModal);
				//alert("( length != 0 ) Klikkkkk");
			}

		});
		
    	$('#myModal').modal('toggle');
	}    
		
	// PAGE RELATED SCRIPTS
	var pagefunction = function() {

		var list = [];
		var total_sum = [];
		var vocab;
		var vocabulary = ["projects","epigenetic_marks", "biosources", "techniques", "genomes"];
		var list_in_use = JSON.parse(localStorage.getItem('list_in_use'));
		if (list_in_use == null) {
			// if locally stored item not yet available, wait a little and check again
			setTimeout(function() {
				list_in_use = JSON.parse(localStorage.getItem('list_in_use'));
				pagefunction();
			}, 3000);
		}
		
		for (i in vocabulary) {
			vocab = vocabulary[i];
			list[vocab] = []; // index for each controlled vocabulary
			page[vocab] = []; // index for each page or view
			total_sum[vocab] = 0; // total experiments in each vocabulary - would be the same value
			othersvalue = 0;
			
			var currentvocab = list_in_use[vocab]
			var ct = 0;
			var pg = 0;

			for (j in currentvocab) {

				// divide into pages of size 20
				list[vocab][ct] = {'label' : currentvocab[j][1], 'value' : currentvocab[j][2]};
				ct = ct + 1;
				page[vocab][pg] = list[vocab];

				if (ct ==  30) {
					list[vocab] = [];
					ct = 0;
					pg = pg + 1;	
				}

				//list[vocab][ct] = {'label' : otherslabel, 'value' : othersvalue};
				total_sum[vocab] = total_sum[vocab] + currentvocab[j][2];
			}
		}

		if (page['techniques'].length == 1) $("#tech_next_page").prop('disabled', true);
		if (page['epigenetic_marks'].length == 1) $("#epi_next_page").prop('disabled', true);
		if (page['biosources'].length == 1) $("#bio_next_page").prop('disabled', true);

		/* total experiment sum */
		$("#total_sum").text(total_sum['projects']);
		
		/* projects donut chart */
		if ($('#projects-chart').length){ 
			Morris.Donut({
				  element: 'projects-chart',
				  data:  list['projects'],
				  formatter: function (x) { return x},
				  resize: true
				}).on('click', function(i, row){
					lauchModalView(row['label'], 'project')
				});
		}
		/* end projects pie chart */

		/* techniques bar chart */
		if ($('#techniques-chart').length) {
			tbar = Morris.Bar({
				  element: 'techniques-chart',
				  data: page['techniques'][0],
				  xkey: 'label',
				  ykeys: ['value'],
				  labels: ['Count'],
				  resize: true
			})
			tbar.on('click', function(i, row){
				lauchModalView(row['label'], 'technique')
			});		
		}
		/* end techniques pie chart */

		if ($("#epigenetic_marks-chart").length) {
			ebar = Morris.Bar({
				  element: 'epigenetic_marks-chart',
				  data: page['epigenetic_marks'][0],
				  xkey: 'label',
				  ykeys: ['value'],
				  labels: ['Count'],
				  xLabelAngle: 270,
				  resize: true
			});
			
			ebar.on('click', function(i, row){
				lauchModalView(row['label'], 'epigenetic_mark')	
			});
		}
		/* end epigenetic marks bar chart */

		/* biosources bar chart */
		if ($("#biosources-chart").length) {
			bbar = Morris.Bar({
				  element: 'biosources-chart',
				  data: page['biosources'][0],
				  xkey: 'label',
				  ykeys: ['value'],
				  labels: ['Count'],
				  xLabelAngle: 270,
				  resize: true
			});
			
			bbar.on('click', function(i, row){
				lauchModalView(row['label'], 'biosource')
			});			
		}
		/* end biosources bar chart */
		
		/* genomes donut chart */
		if ($("#genomes-chart").length) {
			Morris.Donut({
				  element: 'genomes-chart',
				  data:  list['genomes'],
				  formatter: function (x) { return x},
				  resize: true
			}).on('click', function(i, row){
				lauchModalView(row['label'], 'genome')
			});
		}
		
		/* end genomes bar chart */		

	}; 	// end pagefunction

	// Load morris dependencies and run pagefunction
	loadScript("js/plugin/morris/raphael.min.js", function(){
		loadScript("js/plugin/morris/morris.min.js", function(){		
			loadScript("js/plugin/datatables/jquery.dataTables.min.js", function(){
				loadScript("js/plugin/datatables/dataTables.colVis.min.js", function(){
					loadScript("js/plugin/datatables/dataTables.tableTools.min.js", function(){
						loadScript("js/plugin/datatables/dataTables.bootstrap.min.js", function(){
							loadScript("js/plugin/datatable-responsive/datatables.responsive.min.js", pagefunction)
						});
					});
				});
			});
		});
	});
</script>
