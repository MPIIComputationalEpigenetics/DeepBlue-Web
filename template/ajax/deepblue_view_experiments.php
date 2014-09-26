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
*   File : deepblue_view_experiments.php
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
				DeepBlue Data > Experiments
		</h1>
	</div>
</div>

<!-- widget grid -->
<section id="widget-grid" class="">

	<!-- row -->
	<div class="row">

		<!-- NEW WIDGET START -->
		<article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<?php echo $deepBlueObj->experimentDataTableTemplate('experiments_view'); ?>
		</article>
		<!-- WIDGET END -->

	</div>

	<!-- end row -->

	<!-- end row -->
</section>
<!-- end widget grid -->

<script type="text/javascript">

	pageSetUp();

	// pagefunction
	var pagefunction = function() {

		/* Hide and show experiment metadata */

		var isShow = false;
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


		/* BASIC ;*/
			var responsiveHelper_dt_basic = undefined;
			var responsiveHelper_datatable_fixed_column = undefined;
			var responsiveHelper_datatable_col_reorder = undefined;
			var responsiveHelper_datatable_tabletools = undefined;

			var breakpointDefinition = {
				tablet : 1024,
				phone : 480
			};

		var selectedElements = [];
		var selectedElementsNames = [];

		/* COLUMN FILTER  */
	    var otable = $('#datatable_fixed_column').DataTable({

	        "ajax": "ajax/server_side/experiments_server_processing.php",
	        "iDisplayLength": 50,
	        "autoWidth" : true,
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
			},"fnInitComplete": function(oSettings, json) {

				/* Insert or remove selected or unselected elements */

				$( ".downloadCheckBox" ).change(function() {
					var downloadId = $(this).parent().next().text();
					var downloadTitle = $(this).parent().next().next().text();
					var downloadTotal = downloadId+"-"+downloadTitle;

					var found = $.inArray(downloadTotal, selectedElements);

					if(found < 0){
						selectedElements.push(downloadTotal);
						selectedElementsNames.push(downloadTitle);
					}
					else{
						selectedElements.splice(found, 1);
						selectedElementsNames.push(found, 1);
					}
				});

		    }

	    });

	    // custom toolbar
	    $("div.toolbar").html('<div class="text-right"><img src="img/logo.png" alt="DeepBlue" style="width: 111px; margin-top: 3px; margin-right: 10px;"></div>');

	    /* Apply the filter */
	    $("#datatable_fixed_column thead th input[type=text]").on( 'keyup change', function () {

	        otable
	            .column( $(this).parent().index()+':visible' )
	            .search( this.value )
            .draw();

	    } );

	    /* Created download button */
	    //$('#datatable_fixed_column_filter').append('<button type="button" id="downloadBtnTop" class="btn btn-primary">Download</button>');

	    /* Download button :: Getting selected elements */
	    $('#downloadBtnTop, #downloadBtnBottom').click(function(){

	    	if(selectedElements.length == 0){
				alert("Please select elements!");
			}
			else{
				alert(selectedElements);

				var request = $.ajax({
					url: "ajax/server_side/select_regions_server_processing.php",
					dataType: "json",
					data : {
						experiments_names : selectedElementsNames,
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
