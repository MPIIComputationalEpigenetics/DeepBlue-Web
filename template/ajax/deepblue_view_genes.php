<?php

/**
*   DeepBlue Epigenomic Data Server
*   Copyright (c) 2016 Max Planck Institute for Computer Science.
*   All rights reserved.
*
*   Authors :
*
*   Felipe Albrecht <felipe.albrecht@mpi-inf.mpg.de>
*
*   Created : 26-7-2016
*
*   ================================================
*
*   File : deepblue_view_gene_models.php
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
				Auxiliary data > Genes
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
			<div class="jarviswidget jarviswidget-color-blueDark" id="datable-genes" data-widget-editbutton="false" data-widget-deletebutton="false" data-widget-colorbutton="false" data-widget-togglebutton="false">

				<header>
					<span class="widget-icon"> <i class="fa fa-table"></i> </span>
					<h2>Genes</h2>

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

						<table id="datatable_fixed_column_genes" class="table table-striped table-bordered" width="100%">

					        <thead>
								<tr>
									<th class="hasinput">
										<input class="form-control" placeholder="ID" type="text" id="gene-id">
									</th>
									<th class="hasinput">
										<input type="text" class="form-control" placeholder="Gene model" id="gene-model" />
									</th>
									<th class="hasinput">
										<input class="form-control" placeholder="Source" type="text" id="gene-source">
									</th>
									<th class="hasinput">
										<input type="text" class="form-control" placeholder="Chromosome" id="gene-chromosome" />
									</th>
									<th class="hasinput">
										<input class="form-control" placeholder="Start" type="text" id="gene-start">
									</th>
									<th class="hasinput">
										<input type="text" class="form-control" placeholder="End" id="gene-end" />
									</th>
									<th class="hasinput">
										<input type="text" class="form-control" placeholder="Strand" id="gene-strand" />
									</th>
									<th class="hasinput">
										<input type="text" class="form-control" placeholder="Ensembl ID" id="gene-ensembl-id" />
									</th>
									<th class="hasinput">
										<input class="form-control" placeholder="Gene name" type="text" id="gene-name">
									</th>
									<th class="hasinput">
										<input type="text" class="form-control" placeholder="Type" id="gene-type" />
									</th>
									<th class="hasinput">
										<input type="text" class="form-control" placeholder="Status" id="gene-status" />
									</th>

									<th class="hasinput">
										<input type="text" class="form-control" placeholder="Level" id="gene-level" />
									</th>
								</tr>
					            <tr>
				                    <th>ID</th>
				                    <th>Gene model</th>
				                    <th>Source</th>
				                    <th>Chromosome</th>
				                    <th>Start</th>
				                    <th>End</th>
				                    <th>Strand</th>
				                    <th>Gene ID</th>
				                    <th>Gene name</th>
				                    <th>Gene type</th>
				                    <th>Gene status</th>
				                    <th>Level</th>
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

		var responsiveHelper_datatable_fixed_column_genes = undefined;

		var breakpointDefinition = {
			tablet : 1024,
			phone : 480
		};

		/* COLUMN FILTER  */
	    var otable = $('#datatable_fixed_column_genes').DataTable({
	    	"bServerSide": true,
	        "sAjaxSource": "api/datatable",
	        "fnServerParams": function ( aoData ) {
      			aoData.push( { "name": "collection", "value": "genes" } );
      			aoData.push( { "name": "col_0", "value": "_id"} );
				aoData.push( { "name": "col_1", "value": "gene_model"} );
      			aoData.push( { "name": "col_2", "value": "source"} );
      			aoData.push( { "name": "col_3", "value": "Chromosome"} );
      			aoData.push( { "name": "col_4", "value": "start"} );
      			aoData.push( { "name": "col_5", "value": "end"} );
      			aoData.push( { "name": "col_6", "value": "strand"} );
      			aoData.push( { "name": "col_7", "value": "gene_id"} );
      			aoData.push( { "name": "col_8", "value": "gene_name"} );
      			aoData.push( { "name": "col_9", "value": "gene_type"} );
      			aoData.push( { "name": "col_10", "value": "gene_status"} );
      			aoData.push( { "name": "col_11", "value": "level"} );
      			aoData.push( { "name": "key", "value": "<?php echo $user_key ?>"} );
    		},
			"preDrawCallback" : function() {
				// Initialize the responsive datatables helper once.
				if (!responsiveHelper_datatable_fixed_column_genes) {
					responsiveHelper_datatable_fixed_column_genes = new ResponsiveDatatablesHelper($('#datatable_fixed_column_genes'), breakpointDefinition);
				}
			},
			"scrollX" : true,
			"rowCallback" : function(nRow) {
				responsiveHelper_datatable_fixed_column_genes.createExpandIcon(nRow);
			},
			"drawCallback" : function(oSettings) {
				responsiveHelper_datatable_fixed_column_genes.respond();
			},
	    });


		// Apply the filter
		$("#gene-id, #gene-model, #gene-source, #gene-chromosome, #gene-start, #gene-end, #gene-feature, #gene-strand, #gene-ensembl-id, #gene-name, #gene-type, #gene-status, #gene-level").on('keyup change', function () {
			otable
				.column( $(this).parent().index()+':visible' )
				.search( this.value )
				.draw();
		});

		$.fn.dataTableExt.sErrMode = 'none';
		otable.on('xhr.dt', function ( e, settings, json) {
			if ("error" in json) {
				swal("Error while loading the genes table.", json["error"], "error");
				json.aaData = [];
			}
		});


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
