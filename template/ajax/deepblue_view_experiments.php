<?php

/**
*   DeepBlue Epigenomic Data Server
*   Copyright (c) 2015 Max Planck Institute for Computer Science.
*   All rights reserved.
*
*   Authors :
*
*   Felipe Albrecht <felipe.albrecht@mpi-inf.mpg.de>
*
*   Created : 07-04-2015
*
*   ================================================
*
*   File : deepblue_view_experiments_new.php
*
*/

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once("inc/init.php");

?>
<div class="row">
	<div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
		<h1 class="page-title txt-color-blueDark">
			<i class="fa fa-table fa-fw "></i>
				Data Tables > Experiments
			</span>
		</h1>
	</div>
</div>

<!-- widget grid -->
<section id="widget-grid" class="">
	<div class="alert alert-info alert-block">
		<a class="close" data-dismiss="alert" href="#">×</a>
		<h4 class="alert-heading">Experiments Datatable</h4>
		DoubleClick the row to select an experiment; It would be added to the Selected Experiments Datatable. DoubleClick again to unselect a selected experiment. Selected experiments are highlighted in green.
	</div>

	<div class="row">
		<article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
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

                        <table id="datatable_fixed_column" name='experiment-table' class="table table-striped table-bordered table-hover" width="100%">
                            <thead>
                                <tr>
                                    <th class="hasinput">
                                        <input class="form-control" placeholder="ID" type="text" id="experiment-id">
                                    </th>

                                    <th class="hasinput" style="width:20px">
                                        <input type="text" class="form-control" placeholder="Experiment" id="experiment-name" />
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
                                    <th>Experiment Name</th>
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
            <!-- end widget -->
		</article>
	</div>

</section>
<!-- end widget grid -->



<section id="widget-grid" class="">
	<div class="row">
		<article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			    <div class="jarviswidget jarviswidget-color-blueDark" id="datable-selected-experiments" data-widget-editbutton="false" data-widget-deletebutton="false" data-widget-colorbutton="false" data-widget-togglebutton="false">

                <header>
                    <span class="widget-icon"> <i class="fa fa-table"></i> </span>
                    <h2>Selected Experiments </h2>

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

                        <table id="datatable_selected_column" name='experiment-table' class="table table-striped table-bordered table-hover" width="100%">
                            <thead>
                                <tr>
                                    <th class="hasinput">
                                        <input class="form-control" placeholder="ID" type="text" id="experiment-id">
                                    </th>

                                    <th class="hasinput" style="width:20px">
                                        <input type="text" class="form-control" placeholder="Experiment" id="experiment-name" />
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
                                    <th>Experiment Name</th>
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
                        <div class="downloadButtonDiv"><button type="button" id="downloadBtnBottom" class="btn btn-primary">Download</button></div>                        
                    </div>
                    <!-- end widget content -->

                </div>
                <!-- end widget div -->

            </div>
            <!-- end widget -->
		</article>
	</div>

</section>
<!-- end widget grid -->




<script type="text/javascript">
	
	var selected = [];
	var selectedNames = [];
	pageSetUp();

	var pagefunction = function() {

		var isShow = false;
		$(document).on("click", '.exp-metadata-more-view', function () {
			//var metadata = $(this).prev();
			if(isShow == false){
				$(this).prev().show(10);
				$(this).text("-- Hide --");
				isShow = true;
			}
			else{
				$(this).prev().hide(10);
				$(this).text("-- View metadata --");
				isShow = false;
			}

		});


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
      			aoData.push( { "name": "collection", "value": "experiments" } );
      			aoData.push( { "name": "col_0", "value": "_id"} );
      			aoData.push( { "name": "col_1", "value": "name"} );
      			aoData.push( { "name": "col_2", "value": "description"} );
      			aoData.push( { "name": "col_3", "value": "genome"} );
      			aoData.push( { "name": "col_4", "value": "epigenetic_mark"} );
      			aoData.push( { "name": "col_5", "value": "biosource"} );
      			aoData.push( { "name": "col_6", "value": "sample_id"} );
      			aoData.push( { "name": "col_7", "value": "technique"} );
      			aoData.push( { "name": "col_8", "value": "project"} );
      			aoData.push( { "name": "col_9", "value": "extra_metadata"} );
    		},
	        //"sServerMethod": "POST",
	        "iDisplayLength": 50,
	        "autoWidth" : true,

			"preDrawCallback" : function() {
				// Initialize the responsive datatables helper once.
				if (!responsiveHelper_datatable_fixed_column) {
					responsiveHelper_datatable_fixed_column = new ResponsiveDatatablesHelper($('#datatable_fixed_column'), breakpointDefinition);
				}
			},

			"fnRowCallback" : function(nRow, aData, iDisplayIndex) {
				//alert($(nRow).data());
				if (selected.indexOf(aData[0]) != -1) {
					$(nRow).addClass('success');
				}
				responsiveHelper_datatable_fixed_column.createExpandIcon(nRow);
			},

			"drawCallback" : function(oSettings) {
				responsiveHelper_datatable_fixed_column.respond();
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

	    } );
	    /* END COLUMN FILTER */


		/* process experiment selection by row clicking*/

		$('#datatable_fixed_column').on('dblclick', 'tr', function () {

        	var id = $('td', this).eq(0).text();

        	if (id ==  "") {
        		return;
        	}

        	var name = $('td', this).eq(1).text();
        	var desc = $('td', this).eq(2).text();
        	var genome = $('td', this).eq(3).text();
        	var epi = $('td', this).eq(4).text();
        	var bio = $('td', this).eq(5).text();
        	var samp = $('td', this).eq(6).text();
        	var tech = $('td', this).eq(7).text();
        	var proj = $('td', this).eq(8).text();
        	var meta = $('td', this).eq(9).html();

			var index = selected.indexOf(id);
        	if (index == -1) {
	        	selected.push(id); 
	        	selectedNames.push(name);
        	
        		$('#datatable_selected_column').dataTable().fnAddData(
        			[ id, name , desc ,genome , epi ,bio ,samp ,tech ,proj ,meta]
        		);

        		$(this).addClass("success");
        	}
        	else {
				/* remove selection by clicking of row in the main table*/
	        	selected.splice(index, 1);
	        	selectedNames.splice(index, 1);
	    		$('#datatable_selected_column').dataTable().fnDeleteRow(index);

	    		$(this).removeClass("success");
        	}
    	} );


	    /* Download button :: Getting selected elements */
	    $('#downloadBtnBottom').click(function(){

	    	if(selected.length == 0){
				alert("Please select elements!");
			}
			else{
				var request = $.ajax({
					url: "ajax/server_side/select_regions_server_processing.php",
					dataType: "json",
					data : {
						experiments_names : selectedNames,
					}
				});

				request.done( function(data) {
					window.location.href = 'ajax/server_side/get_regions_server_processing.php?query_id='+data.query_id;
				});

				request.fail( function(jqXHR, textStatus) {
					console.log(jqXHR);
	        		console.log('Error: '+ textStatus);
					alert( "error" );
				});
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
