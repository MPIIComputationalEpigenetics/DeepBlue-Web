<?php

/**
*   DeepBlue Epigenomic Data Server
*   Copyright (c) 2014 Max Planck Institute for Computer Science.
*   All rights reserved.
*
*   Authors :
*
*   Felipe Albrecht <felipe.albrecht@mpi-inf.mpg.de>
*   Umidjon Urunov <umidjon.urunov@mpi-inf.mpg.de>
*
*   Created : 21-08-2014
*
*   ================================================
*
*   File : deepblue_view_genomes.php
*
*/

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once("../lib/lib.php");
require_once("inc/init.php");

?>
<div class="row">
	<div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
		<h1 class="page-title txt-color-blueDark">
			<i class="fa fa-table fa-fw "></i>
				Auxiliary data > Genomes
		</h1>
	</div>
</div>

<!-- widget grid -->
<section id="widget-grid" class="">

	<!-- row -->
	<div class="row">

		<!-- NEW WIDGET START -->
		<article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">



			<!-- Widget ID (each widget will need unique ID)-->
			<div class="jarviswidget jarviswidget-color-blueDark" id="datable-genomes" data-widget-editbutton="false" data-widget-deletebutton="false" data-widget-colorbutton="false" data-widget-togglebutton="false">

				<header>
					<span class="widget-icon"> <i class="fa fa-table"></i> </span>
					<h2>Genomes </h2>

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

						<table id="datatable_fixed_column" class="table table-striped table-bordered" width="100%">

					        <thead>
								<tr>
									<th class="hasinput">
										<input class="form-control" placeholder="ID" type="text" id="genome-id">
									</th>
									<th class="hasinput">
										<input type="text" class="form-control" placeholder="Genome" id="genome-name" />
									</th>
									<th class="hasinput">
										<input type="text" class="form-control" placeholder="Description" id="genome-description"/>
									</th>
								</tr>
					            <tr>
				                    <th>ID</th>
				                    <th>Genome Name</th>
				                    <th>Description</th>
					            </tr>
					        </thead>

						</table>

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

	<!-- end row -->

</section>
<!-- end widget grid -->

<script type="text/javascript">

	pageSetUp();


	var pagefunction = function() {

			var responsiveHelper_dt_basic = undefined;
			var responsiveHelper_datatable_fixed_column = undefined;
			var responsiveHelper_datatable_col_reorder = undefined;
			var responsiveHelper_datatable_tabletools = undefined;

			var breakpointDefinition = {
				tablet : 1024,
				phone : 480
			};

		/* COLUMN FILTER  */
	    var otable = $('#datatable_fixed_column').DataTable({
	    	"bServerSide": true,
	        "sAjaxSource": "api/datatable",
	        "fnServerParams": function ( aoData ) {
      			aoData.push( { "name": "collection", "value": "genomes" } );
      			aoData.push( { "name": "col_0", "value": "_id"} );
      			aoData.push( { "name": "col_1", "value": "name"} );
      			aoData.push( { "name": "col_2", "value": "description"} );
      			aoData.push( { "name": "key", "value": "<?php echo $user_key ?>"} );
    		},
			"preDrawCallback" : function() {
				// Initialize the responsive datatables helper once.
				if (!responsiveHelper_datatable_fixed_column) {
					responsiveHelper_datatable_fixed_column = new ResponsiveDatatablesHelper($('#datatable_fixed_column'), breakpointDefinition);
				}
			},
			"scrollX" : true,
			"rowCallback" : function(nRow) {
				responsiveHelper_datatable_fixed_column.createExpandIcon(nRow);
			},
			"drawCallback" : function(oSettings) {
				responsiveHelper_datatable_fixed_column.respond();
			},
	    });

		$.fn.dataTableExt.sErrMode = 'none';
		otable.on('xhr.dt', function ( e, settings, json) {
			if ("error" in json) {
				swal("Error while loading the genomes table.", json["error"], "error");
				json.aaData = [];
			}
		});

		// custom toolbar
	    $("div.toolbar").html('<div class="text-right"><img src="img/logo.png" alt="DeepBlue" style="width: 111px; margin-top: 3px; margin-right: 10px;"></div>');

		// Apply the filter
		$("#genome-id, #genome-name, #genome-description").on('keyup change', function () {
			otable
				.column( $(this).parent().index()+':visible' )
				.search( this.value )
				.draw();
		});
	    /* END COLUMN FILTER */

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
