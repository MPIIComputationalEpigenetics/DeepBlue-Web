<?php

/**
*   DeepBlue Epigenomic Data Server
*   Copyright (c) 2014 Max Planck Institute for Computer Science.
*   All rights reserved.
*
*   Authors :
*
*   Felipe Albrecht <felipe.albrecht@mpi-inf.mpg.de>
*
*   Created : 07.04.2015
*
*   ================================================
*
*   File : deepblue_view_samples.php
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
				Auxiliary data > Samples
			</span>
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
			<div class="jarviswidget jarviswidget-color-blueDark" id="datatable-samples" data-widget-editbutton="false" data-widget-deletebutton="false" data-widget-colorbutton="false" data-widget-togglebutton="false">

				<header>
					<span class="widget-icon"> <i class="fa fa-table"></i> </span>
					<h2>Samples </h2>

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
										<input class="form-control" placeholder="ID" type="text" id="sample-id" />
									</th>

									<th class="hasinput">
										<input type="text" class="form-control" placeholder="BioSource" id="sample-biosource" />
									</th>

									<th class="hasinput" style="width:25%">
										<input class="form-control" placeholder="Metadata" type="text" id="sample-metadata" />
									</th>

								</tr>
					            <tr>
				                    <th>ID</th>
				                    <th>BioSource</th>
				                    <th>Metadata</th>
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

	function loadTableAutoComplete() {
		var vocabnames = ["biosources"];
		var vocabids = ["#sample-biosource"];
		var suggestion2 = [];

		for (i in vocabnames) {
			vocabname = vocabnames[i];
			vocabid = vocabids[i];
			suggestion2[vocabname] = []; // index for each controlled vocabulary
			count = 0;
			var currentvocab = list_in_use[vocabname]['alp'];
			for (j in currentvocab) {
				suggestion2[vocabname][count] = {'label' : currentvocab[j][1] + " (" + currentvocab[j][0] + ")", 'value' : currentvocab[j][1]};
				count = count + 1;
			}
			$(vocabid).autocomplete({
				source : suggestion2[vocabname],
				autoFocus: false,
				focus: function( event, ui ) { return false;},
				minLength: 0,
				select: function( event, ui ) {
					this.value = ui.item.value;
					$(this).trigger("change");
				}
			});
		}
	}
	// PAGE RELATED SCRIPTS

	// pagefunction
	var pagefunction = function() {

		list_in_use = JSON.parse(localStorage.getItem('list_in_use'));
		var vocabulary = ["projects","epigenetic_marks", "biosources", "techniques", "genomes", "samples"];
		if (list_in_use == null) {
			var request1 = $.ajax({
				url: "ajax/server_side/list_in_use.php",
				dataType: "json",
				data: {
					request: vocabulary
				}
			});

			request1.done(function (data) {
				if ("error" in data) {
					swal({
						title: "Error listing experiments",
						text: data['message']
					});
					return;
				}

				// store data in local storage
				localStorage.setItem("list_in_use", JSON.stringify(data[0]));
				list_in_use = data[0];

				loadTableAutoComplete();
			});

			request1.fail(function (jqXHR, textStatus) {
				console.log(jqXHR);
				console.log('Error: ' + textStatus);
				alert("Encountered an error. Please wait a few seconds and reload page. If problem persist, kindly log a complaint");
			});
		}
		else {
			loadTableAutoComplete();
		}
		//console.log("cleared");

		/* BASIC ;*/
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
      			aoData.push( { "name": "collection", "value": "samples" } );
      			aoData.push( { "name": "col_0", "value": "_id"} );
      			aoData.push( { "name": "col_1", "value": "biosource_name"} );
      			aoData.push( { "name": "col_2", "value": "extra_metadata"} );
      			aoData.push( { "name": "key", "value": "<?php echo $user_key ?>"} );
    		},
	        //"sServerMethod": "POST",
	        "iDisplayLength": 50,
	        "autoWidth" : true,
			"scrollX" : true,
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

	    });

		$.fn.dataTableExt.sErrMode = 'none';
		otable.on('xhr.dt', function ( e, settings, json) {
			if ("error" in json) {
				swal("Error while loading the samples table.", json["error"], "error");
				json.aaData = [];
			}
		});

		// custom toolbar
	    $("div.toolbar").html('<div class="text-right"><img src="img/logo.png" alt="DeepBlue" style="width: 111px; margin-top: 3px; margin-right: 10px;"></div>');

		// Apply the filter
		$("#sample-id, #sample-biosource, #sample-metadata").on('keyup change', function () {
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
