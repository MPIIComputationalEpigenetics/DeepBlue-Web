<?php

/**
*   DeepBlue Epigenomic Data Server
*   Copyright (c) 2014 Max Planck Institute for Computer Science.
*   All rights reserved.
*
*   Authors :
*
*   Felipe Albrecht <felipe.albrecht@mpi-inf.mpg.de>
*   Obaro Odiete <s8obodie@stud.uni-saarland.de>
*
*   Created : 30-04-2015
*
*   ================================================
*
*   File : deepblue_manage_request.php
*
*/

/* DeepBlue Configuration */
require_once("../lib/lib.php");
require_once("../lib/server_settings.php");

require_once("inc/init.php");

?>

<div class="row">
	<div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
		<h1 class="page-title txt-color-blueDark"><i class="fa fa-shopping-cart"></i>
			Manage Requests
		</h1>
	</div>
</div>
<!-- widget grid -->
<section id="widget-grid" class="">
	<!-- row -->
	<div class="row">

		<!-- NEW WIDGET START -->
		<article class="col-sm-12 col-md-12 col-lg-12">

			<!-- Widget ID (each widget will need unique ID)-->
			<div class="jarviswidget jarviswidget-color-blue" id="tree-biosources" data-widget-editbutton="true">

				<header>
					<span class="widget-icon"> <i class="fa fa-cloud-download"></i> </span>
					<h2>Experiments Download</h2>

				</header>

				<!-- widget div-->
				<div>
					<!-- widget edit box -->
					<div class="jarviswidget-editbox">
						<!-- This area used as dropdown edit box -->
					</div>
					<!-- end widget edit box -->

					<!-- widget content -->
					<div class="widget-body">
					 	<div class="row">
							<div class="col-md-12 col-md-offset-0">
								<div class="alert alert-info alert-block">
									<a class="close" data-dismiss="alert" href="#">×</a>
									<h4 class="alert-heading">Download Queue</h4>
									When the download is ready, (Request status: Ready), the download button would be enabled.
								</div>
			                    <div class="widget-body">
			                        <table id="datatable_fixed_column" name='experiment-table' class="table table-striped table-bordered table-hover" width="100%">
			                            <thead>
			                                <tr>
			                                    <th class="hasinput">
			                                        <input type="text" class="form-control" placeholder="Request ID" id="request-id" />
			                                    </th>
			                                    <th class="hasinput">
			                                        <input type="text" class="form-control" placeholder="Request Status" id="request-status"/>
			                                    </th>
			                                    <th class="hasinput">
			                                        <input type="text" class="form-control" placeholder="Request Start Time" id="request-start-time"/>
			                                    </th>
			                                    <th class="hasinput">
			                                        <input type="text" class="form-control" placeholder="Request End Time" id="request-end-time"/>
			                                    </th>
			                                    <th class="hasinput">
			                                        <input type="text" class="form-control" placeholder="Request Detail" id="request-detail"/>
			                                    </th>
			                                    <th class="hasinput">
			                                    </th>
			                                </tr>
			                                <tr>
												<th>Request ID</th>
			                                    <th>Request Status</th>
												<th>Request Start Time</th>
												<th>Request End Time</th>
												<th>Request Detail</th>
												<th>Downloads</th>
			                                </tr>
			                            </thead>
			                        </table>
			                    </div>
							</div>
						</div>
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

	pageSetUp();

	function getRegion(event) {
		var id = event.target.id.split('_')[1];
		window.open('<?php echo get_server() ?>/download/?r='+id+'&key=<?php echo $user_key ?>','_blank');
	}

	var pagefunction = function() {

		/* BASIC ;*/
		var responsiveHelper_dt_basic = undefined;
		var responsiveHelper_datatable_fixed_column = undefined;
		var responsiveHelper_datatable_col_reorder = undefined;
		var responsiveHelper_datatable_tabletools = undefined;

		var requestObj = localStorage.getItem('request');
		var request = JSON.parse(requestObj);
		var request_state;
		var request_ids = [];
		var waiting_state = [];
		var request_time;
		var download_button;
		var request_id;

		var otable = $('#datatable_fixed_column').DataTable({

		    "ajax": {
			    "url": "ajax/server_side/manage_requests_server_processing.php",
				"data" : {
					filter : ""
			    },
			    "iDisplayLength": 10,
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
				}
			}
		});

    	otable.on('xhr.dt', function ( e, settings, json, xhr ) {
    		if ("error" in json) {
    			swal("Error while loading table content.", json["message"], "error");
    			json.aaData = [];
    		}
    	});

		$("#datatable_fixed_column thead th input[type=text]").on( 'keyup change', function () {
		    otable
		        .column( $(this).parent().index()+':visible' )
		        .search( this.value )
		        .draw();

		});

		/* check would be run once at the begining and every seconds on disabled buttons*/
		var window_focus = true;
		$(window).focus(function(){
			window_focus = true;
		});

		$(window).blur(function(){
			window_focus = false;
		});

		setInterval(function(){
			if (window_focus) {
				otable.ajax.reload();
			}
		}, 30000);
	};

	// load related plugins
	loadScript("js/plugin/datatables/jquery.dataTables.min.js", function(){
		loadScript("js/plugin/datatables/dataTables.colVis.min.js", function(){
			loadScript("js/plugin/datatables/dataTables.tableTools.min.js", function(){
				loadScript("js/plugin/datatables/dataTables.bootstrap.min.js", function(){
					loadScript("js/plugin/datatable-responsive/datatables.responsive.min.js", pagefunction)
				});
			});
		});
	});
</script>