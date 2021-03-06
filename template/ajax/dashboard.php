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
*
-->

<?php

	// initialize the page
	require_once("inc/init.php");

	/* DeepBlue Configuration */
	require_once("../lib/lib.php");

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
				<h5> Experiments <span id="total_experiments" class="txt-color-blue">0</span></h5>
			</li>
			<li class="sparks-info">
                <h5> Samples <span id="total_samples" class="txt-color-purple">0</span></h5>
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
						<div id="biosources-chart" class="chart" style="text-align:center"></div>
					</div>
					<div style="text-align:center; margin-bottom: 5px">
						<button id="bio_prev_page" type="button" class="btn btn-primary" disabled>
							<i class="fa fa-backward"></i>
						</button>
						<button id="bio_sort_amt_page" type="button" class="btn btn-primary">
							<i class="fa fa-sort-amount-asc"></i>
						</button>
						<button id="bio_sort_alp_page" type="button" class="btn btn-primary" disabled>
							<i class="fa fa-sort-alpha-asc"></i>
						</button>
						<button id="bio_next_page" name="bio_next_page" type="button" class="btn btn-primary">
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
					<h2>Epigenetic marks</h2>

				</header>

				<!-- widget div-->
				<div>

					<!-- widget content -->
					<div class="widget-body col-sm-12">
						<div id="epigenetic_marks-chart" class="chart"></div>
					</div>
					<!-- end widget content -->
					<div style="text-align:center; margin-bottom: 5px">
						<button type="button" id="epi_prev_page" class="btn btn-primary" disabled>
							<i class="fa fa-backward"></i>
						</button>
						<button type="button" id="epi_sort_amt_page" class="btn btn-primary">
							<i class="fa fa-sort-amount-asc"></i>
						</button>
						<button type="button" id="epi_sort_alp_page" class="btn btn-primary" disabled>
							<i class="fa fa-sort-alpha-asc"></i>
						</button>
						<button type="button" id="epi_next_page" class="btn btn-primary">
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
					<!-- widget content -->
					<div class="widget-body col-sm-12">
						<div id="techniques-chart" class="chart"></div>
					</div>
					<!-- end widget content -->
					<div style="text-align:center; margin-bottom: 5px">
						<button type="button" id="tech_prev_page" class="btn btn-primary" disabled>
							<i class="fa fa-backward"></i>
						</button>
						<button type="button" id="tech_sort_amt_page" class="btn btn-primary">
							<i class="fa fa-sort-amount-asc"></i>
						</button>
						<button type="button" id="tech_sort_alp_page" class="btn btn-primary" disabled>
							<i class="fa fa-sort-alpha-asc"></i>
						</button>
						<button type="button" id="tech_next_page" class="btn btn-primary">
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
	        <div class="jarviswidget jarviswidget-color-blueDark" id="datable-experiments" data-widget-editbutton="false" data-widget-deletebutton="false" data-widget-colorbutton="false" data-widget-togglebutton="false">
	            <header>
                    <span class="widget-icon"> <i class="fa fa-table"></i> </span>
                    <h2>Experiments </h2>
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
                        <table id="datatable_fixed_column" name='experiment-table' class="table table-striped table-bordered" width="100%">
                            <thead>
                                <tr>
                                    <th class="hasinput">
                                        <input class="form-control" placeholder="ID" type="text" id="experiment-id">
                                    </th>
	                                <th class="hasinput" style="width:20px">
                                        <input type="text" class="form-control" placeholder="Experiment" id="experiment-name" />
                                    </th>
                                    <th class="hasinput" style="width:20px">
                                        <input type="text" class="form-control" placeholder="Type" id="experiment-datatype" />
                                    </th>
                                    <th class="hasinput">
                                        <input type="text" class="form-control" placeholder="Description" id="experiment-description" />
                                    </th>
                                    <th class="hasinput">
                                        <input type="text" class="form-control" placeholder="Genome" id="experiment-genome" />
                                    </th>
                                    <th class="hasinput">
                                        <input type="text" class="form-control" placeholder="Epigenetic mark" id="experiment-epigenetic_mark" />
                                    </th>
                                    <th class="hasinput">
                                        <input type="text" class="form-control" placeholder="Biosource" id="experiment-biosource" />
                                    </th>
                                    <th class="hasinput">
                                        <input type="text" class="form-control" placeholder="Sample" id="experiment-sample" />
                                    </th>
                                    <th class="hasinput">
                                        <input type="text" class="form-control" placeholder="Technique" id="experiment-technique" />
                                    </th>
                                    <th class="hasinput">
                                        <input type="text" class="form-control" placeholder="Project" id="experiment-project" />
                                    </th>
                                    <th class="hasinput">
                                        <input type="text" class="form-control" placeholder="Meta data" id="experiment-metadata" />
                                    </th>
                                </tr>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Type</th>
                                    <th>Description</th>
                                    <th>Genome</th>
                                    <th>Epigenetic Mark</th>
                                    <th>Biosource</th>
                                    <th>Sample</th>
                                    <th>Technique</th>
                                    <th>Project</th>
                                    <th>Metadata</th>
                                </tr>
                            </thead>

                        </table>
                    </div>
                    <!-- end widget content -->

                </div>
                <!-- end widget div -->

            </div>

        </div>
      </div>
      <div class="modal-footer">
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
	var sort = ['technique','biosource','epigenetic_mark'];
	sort['biosource'] = 'alp';
	sort['epigenetic_mark'] = 'alp';
	sort['technique'] = 'alp';
	var counter = 0;

	$('#tech_sort_amt_page').click(function(){
		sort['technique'] = 'amt';
		tbar.setData(page['techniques'][sort['technique']][0]);
		curPageHolder['technique'] = 0;

		$("#tech_sort_amt_page").prop('disabled', true);
		$("#tech_sort_alp_page").prop('disabled', false);

		$("#tech_next_page").prop('disabled', false);
		$("#tech_prev_page").prop('disabled', true);
	});

	$('#tech_sort_alp_page').click(function(){
		sort['technique'] = 'alp';
		tbar.setData(page['techniques'][sort['technique']][0]);
		curPageHolder['technique'] = 0;

		$("#tech_sort_amt_page").prop('disabled', false);
		$("#tech_sort_alp_page").prop('disabled', true);

		$("#tech_next_page").prop('disabled', false);
		$("#tech_prev_page").prop('disabled', true);
	});

	$('#tech_next_page').click(function(){
		counter = curPageHolder['technique'];
		if (counter == 0) {
			$("#tech_prev_page").prop('disabled', false);
		}
		if (counter < page['techniques'][sort['technique']].length - 1) {
			curPageHolder['technique'] = curPageHolder['technique'] + 1;
			counter = curPageHolder['technique'];
			tbar.setData(page['techniques'][sort['technique']][counter]);
		}
		if (counter == page['techniques'][sort['technique']].length -1) {
			$("#tech_next_page").prop('disabled', true);
		}
	});

	$('#tech_prev_page').click(function(){
		counter = curPageHolder['technique'];
		if (counter == page['techniques'][sort['technique']].length - 1) {
			$("#tech_next_page").prop('disabled', false);
		}
		if (counter > 0) {
			curPageHolder['technique'] = curPageHolder['technique'] - 1;
			counter = curPageHolder['technique'];
			tbar.setData(page['techniques'][sort['technique']][counter]);
		}
		if (counter == 0) {
			$("#tech_prev_page").prop('disabled', true);
		}
	});

	$('#bio_sort_amt_page').click(function(){
		sort['biosource'] = 'amt';
		bbar.setData(page['biosources'][sort['biosource']][0]);
		curPageHolder['biosource'] = 0;

		$("#bio_sort_amt_page").prop('disabled', true);
		$("#bio_sort_alp_page").prop('disabled', false);

		$("#bio_next_page").prop('disabled', false);
		$("#bio_prev_page").prop('disabled', true);
	});

	$('#bio_sort_alp_page').click(function(){
		sort['biosource'] = 'alp';
		bbar.setData(page['biosources'][sort['biosource']][0]);
		curPageHolder['biosource'] = 0;

		$("#bio_sort_amt_page").prop('disabled', false);
		$("#bio_sort_alp_page").prop('disabled', true);

		$("#bio_next_page").prop('disabled', false);
		$("#bio_prev_page").prop('disabled', true);
	});

	$('#bio_next_page').click(function(){
		counter = curPageHolder['biosource'];
		if (counter == 0) {
			$("#bio_prev_page").prop('disabled', false);
		}
		if (counter < page['biosources'][sort['biosource']].length - 1) {
			curPageHolder['biosource'] = curPageHolder['biosource'] + 1;
			counter = curPageHolder['biosource'];
			bbar.setData(page['biosources'][sort['biosource']][counter]);
		}
		if (counter == page['biosources'][sort['biosource']].length -1) {
			$("#bio_next_page").prop('disabled', true);
		}
	});

	$('#bio_prev_page').click(function(){
		counter = curPageHolder['biosource'];
		if (counter == page['biosources'][sort['biosource']].length - 1) {
			$("#bio_next_page").prop('disabled', false);
		}
		if (counter > 0) {
			curPageHolder['biosource'] = curPageHolder['biosource'] - 1;
			counter = curPageHolder['biosource'];
			bbar.setData(page['biosources'][sort['biosource']][counter]);
		}
		if (counter == 0) {
			$("#bio_prev_page").prop('disabled', true);
		}
	});

	$('#epi_sort_amt_page').click(function(){
		sort['epigenetic_mark'] = 'amt';
		ebar.setData(page['epigenetic_marks'][sort['epigenetic_mark']][0]);
		curPageHolder['epigenetic_mark'] = 0;

		$("#epi_sort_amt_page").prop('disabled', true);
		$("#epi_sort_alp_page").prop('disabled', false);

		$("#epi_next_page").prop('disabled', false);
		$("#epi_prev_page").prop('disabled', true);
	});

	$('#epi_sort_alp_page').click(function(){
		sort['epigenetic_mark'] = 'alp'
		ebar.setData(page['epigenetic_marks'][sort['epigenetic_mark']][0]);
		curPageHolder['epigenetic_mark'] = 0;

		$("#epi_sort_amt_page").prop('disabled', false);
		$("#epi_sort_alp_page").prop('disabled', true);

		$("#epi_next_page").prop('disabled', false);
		$("#epi_prev_page").prop('disabled', true);
	});

	$('#epi_next_page').click(function(){
		counter = curPageHolder['epigenetic_mark'];
		if (counter == 0) {
			$("#epi_prev_page").prop('disabled', false);
		}
		if (counter < page['epigenetic_marks'][sort['epigenetic_mark']].length - 1) {
			curPageHolder['epigenetic_mark'] = curPageHolder['epigenetic_mark'] + 1;
			counter = curPageHolder['epigenetic_mark'];
			ebar.setData(page['epigenetic_marks'][sort['epigenetic_mark']][counter]);
		}
		if (counter == page['epigenetic_marks'][sort['epigenetic_mark']].length -1) {
			$("#epi_next_page").prop('disabled', true);
		}
	});

	$('#epi_prev_page').click(function(){
		counter = curPageHolder['epigenetic_mark'];
		if (counter == page['epigenetic_marks'][sort['epigenetic_mark']].length - 1) {
			$("#epi_next_page").prop('disabled', false);
		}
		if (counter > 0) {
			curPageHolder['epigenetic_mark'] = curPageHolder['epigenetic_mark'] - 1;
			counter = curPageHolder['epigenetic_mark'];
			ebar.setData(page['epigenetic_marks'][sort['epigenetic_mark']][counter]);
		}
		if (counter == 0) {
			$("#epi_prev_page").prop('disabled', true);
		}
	});

    function lauchModalView(label, vocab) {

		$('.modal-content').removeClass( "modalViewSingleInfo" );
		$('#modal_for_experiment').hide();
		$('#modal-content-by-jquery').show();

		var type = vocab;
		var text = label;

		// there was a special case to handle SAMPLES

		/* Hide and show experiment metadata */
		var last = null;
		$(document).off("click", '.exp-metadata-more-view');
		$(document).on("click", '.exp-metadata-more-view', function () {
			var toggle = $(this).text();
			if (toggle == "-- Hide --") {
				$(this).prev().hide(1000);
				$(this).text("-- View metadata --");
			}
			else {
				$(this).prev().show(1000);
				$(this).text("-- Hide --");
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

		var initFilter = [
	    	null,
	    	null,
	    	null,
	    	null,
	    	null,
	    	null,
	    	null,
	    	null,
	    	null,
	    	null,
	    	null
	    ];

		switch (type) {
			case 'genome':
			   	initFilter[4] = {"sSearch": text};
			    break;
			case 'epigenetic_mark':
				initFilter[5] = {"sSearch": text};
			    break;
			case 'biosource':
			    initFilter[6] = {"sSearch": text};
			    break;
			case 'technique':
			    initFilter[8] = {"sSearch": text};
			    break;
			case 'project':
			    initFilter[9] = {"sSearch": text};
			    break;
			default:
			    break;
		}


		var inputName = "#experiment-" + type;
		$(inputName).val(text);
 	    $(inputName).prop('disabled', true);


		var selectedElementsModal = [];
		/* COLUMN FILTER  */

		var otable = $('#datatable_fixed_column').DataTable({

	    	"bServerSide": true,
	        "sAjaxSource": "api/datatable",
	        "fnServerParams": function ( aoData ) {
      			aoData.push( { "name": "collection", "value": "experiments" } );
      			aoData.push( { "name": "col_0", "value": "_id"} );
      			aoData.push( { "name": "col_1", "value": "name"} );
      			aoData.push( { "name": "col_2", "value": "data_type"} );
      			aoData.push( { "name": "col_3", "value": "description"} );
      			aoData.push( { "name": "col_4", "value": "genome"} );
      			aoData.push( { "name": "col_5", "value": "epigenetic_mark"} );
      			aoData.push( { "name": "col_6", "value": "biosource"} );
      			aoData.push( { "name": "col_7", "value": "sample_id"} );
      			aoData.push( { "name": "col_8", "value": "technique"} );
      			aoData.push( { "name": "col_9", "value": "project"} );
      			aoData.push( { "name": "col_10", "value": "extra_metadata"} );
      			aoData.push( { "name": "key", "value": "<?php echo $user_key ?>"} );
      		},
		    "iDisplayLength": 50,
		    "autoWidth" : true,
		    "bDestroy": true,
		    "aoSearchCols" : initFilter,
		    "oSearch": {"bSmart": false},
			"scrollX": true,
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
				/* Insert or remove selected or unselected elements
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
				});*/
			}
		});

		$.fn.dataTableExt.sErrMode = 'none';
		otable.on('xhr.dt', function ( e, settings, json) {
			if ("error" in json) {
				swal("Error while loading the experiments table.", json["error"], "error");
				json.aaData = [];
			}
		});

		// custom toolbar
		$("div.toolbar").html('<div class="text-right"><img src="img/logo.png" alt="DeepBlue" style="width: 111px; margin-top: 3px; margin-right: 10px;"></div>');

		// Apply the filter
		$("#experiment-id, #experiment-name, #experiment-datatype, #experiment-epigenetic_mark, #experiment-project, " +
				"#experiment-biosource, #experiment-sample, #experiment-technique, #experiment-genome, #experiment-metadata, " +
				"#experiment-description").on('keyup change', function () {
			otable
				.column( $(this).parent().index()+':visible' )
				.search( this.value )
				.draw();
		});

		/* Download button :: Getting selected elements */
		$('#downloadBtnBottom').click(function(){
			if(selectedElementsModal.length == 0){
			}
			else{
			}
		});

    	$('#myModal').modal('toggle');
	}

	// PAGE RELATED SCRIPTS
	var pagefunction = function() {

		var list = [];
		var total_experiments = [];
        var total_samples = 0;
		var vocab;
		var vocabulary = ["projects","epigenetic_marks", "biosources", "techniques", "genomes", "samples"];

		/* retrieve deepblue list_in_use data */
		var list_in_use = null;

		// check local storage first
        list_in_use = JSON.parse(localStorage.getItem('list_in_use'));
		if (list_in_use == null) {
			var request1 = $.ajax({
				url: "ajax/server_side/faceting_experiments.php",
				dataType: "json",
			});

			request1.done( function(data) {
                if ("error" in data) {
                    swal({
                        title: "An error has occurred listing experiments",
                        text: data['message']
                    });
                    return;
                }

                // store data in local storage
				localStorage.setItem("list_in_use", JSON.stringify(data[0]));
				list_in_use = JSON.parse(localStorage.getItem('list_in_use'));
				loadDashboard();
				//alert("1");
			});

			request1.fail( function(jqXHR, textStatus) {
				console.log(jqXHR);
			    console.log('Error: '+ textStatus);
				alert( "Encountered an error. Please wait a few seconds and reload page. If problem persist, kindly log a complaint" );
			});
		}
		else {
			loadDashboard();
		}

		function loadDashboard() {
			//alert("3");
			for (i in vocabulary) {
				vocab = vocabulary[i];
				if (vocab == 'samples') {
					total_samples = list_in_use[vocab]['alp'].length;
					$("#total_samples").text(total_samples);
				}
				else {
					list[vocab] = []; // index for each controlled vocabulary
					list[vocab]['alp'] = [];
					list[vocab]['amt'] = [];

					page[vocab] = []; // index for each page or view
					page[vocab]['alp'] = [];
					page[vocab]['amt'] = [];

					total_experiments[vocab] = 0; // total experiments in each vocabulary - would be the same value
					othersvalue = 0;

					var currentvocab = [];
					currentvocab['alp'] = list_in_use[vocab]['alp'];
					currentvocab['amt'] = list_in_use[vocab]['amt'];

					var ct = 0;
					var pg = 0;

					for (j=0; j < currentvocab['alp'].length; j++) {
						// divide into pages of size 35
						list[vocab]['alp'][ct] = {'label' : currentvocab['alp'][j][1], 'value' : currentvocab['alp'][j][2]};
						list[vocab]['amt'][ct] = {'label' : currentvocab['amt'][j][1], 'value' : currentvocab['amt'][j][2]};

						ct = ct + 1;
						page[vocab]['alp'][pg] = list[vocab]['alp'];
						page[vocab]['amt'][pg] = list[vocab]['amt'];

						if (ct ==  35) {
							list[vocab]['alp'] = [];
							list[vocab]['amt'] = [];
							ct = 0;
							pg = pg + 1;
						}

						//list[vocab][ct] = {'label' : otherslabel, 'value' : othersvalue};
						total_experiments[vocab] = total_experiments[vocab] + currentvocab['alp'][j][2];
					}
				}
			}

			if (page['techniques']['alp'].length == 1) $("#tech_next_page").prop('disabled', true);
			if (page['epigenetic_marks']['alp'].length == 1) $("#epi_next_page").prop('disabled', true);
			if (page['biosources']['alp'].length == 1) $("#bio_next_page").prop('disabled', true);

			/* total experiment sum */
			$("#total_experiments").text(total_experiments['projects']);

			/* projects donut chart */
			if ($('#projects-chart').length){
				Morris.Donut({
					  element: 'projects-chart',
					  data:  list['projects']['alp'],
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
					  data: page['techniques']['alp'][0],
					  xkey: 'label',
					  ykeys: ['value'],
					  labels: ['Count'],
                        xLabelAngle: 270,
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
					  data: page['epigenetic_marks']['alp'][0],
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
					  data: page['biosources']['alp'][0],
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
					  data:  list['genomes']['alp'],
					  formatter: function (x) { return x},
					  resize: true
				}).on('click', function(i, row){
					lauchModalView(row['label'], 'genome')
				});
			}
		}

        // setup intro tutorial
		var tour = <?php echo $_SESSION['tour']; ?>;
		if (tour == 1) {
			swal({
					title: "",
					text: "Welcome to the DeepBlue Web interface.\nWould you like to have a brief overview?",
					type: "info",
					showCancelButton: true,
					confirmButtonText: "Yes",
					cancelButtonText: "No"
				},
				function(yes){
					if (yes) {
						bootstro.start(".bootstro", {
                            onExit : function(params) {
                              swal({
                                  title: "",
                                  text: "Would you like to see tour the next time you login?",
                                  type: "info",
                                  showCancelButton: true,
                                  confirmButtonText: "Yes",
                                  cancelButtonText: "No"
                              },
                              function(yes){
                                  if (!yes) {
                                      // cookie expire after 1year
                                      var today = new Date();
                                      var expire = new Date();

                                      expire.setYear(today.getFullYear() + 1);
                                      document.cookie="tour='true'; expires=" + expire.toUTCString() + " path=/";
                                  }
                              });
                            },
							stopOnEsc: true,
							stopOnBackdropClick: false,
							finishButtonText : "Return to DeepBlue"
						});
					}
					else {
						// NO?
						// cookie expire after 1year
						var today = new Date();
						var expire = new Date();

						expire.setYear(today.getFullYear() + 1);
						document.cookie="tour='true'; expires=" + expire.toUTCString() + " path=/";
					}
				}
			);
		}
		<?php $_SESSION['tour'] = 'false'; ?>;
    }; 	// end pagefunction

	// Load morris dependencies and run pagefunction
	loadScript("js/plugin/morris/raphael.min.js", function(){
		loadScript("js/plugin/morris/morris.min.js", function(){
			loadScript("js/plugin/datatables/jquery.dataTables.min.js", function(){
				loadScript("js/plugin/datatables/dataTables.colVis.min.js", function(){
					loadScript("js/plugin/datatables/dataTables.tableTools.min.js", function(){
						loadScript("js/plugin/datatables/dataTables.bootstrap.min.js", function(){
							loadScript("js/plugin/datatable-responsive/datatables.responsive.min.js", pagefunction);
						});
					});
				});
			});
		});
	});
</script>
