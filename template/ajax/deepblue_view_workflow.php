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
*   Created : 23-09-2014
*
*   ================================================
*
*   File : deepblue_view_workflow.php
*
*/


require_once("inc/init.php");


?>

<div class="row">

	<div class="col-sm-12">

		<div id="myWorkflowContent" class="tab-content bg-color-white padding-10 myContentPadding">
			<div class="tab-pane fade in active" id="s1">
				<h1> Please, select the data </h1>
				<br>
				<div class="input-group input-group-lg hidden-mobile">
					<div class="input-group-btn">
						<select id="workFlowSelectForm" class="form-control">
							<option value='0'> -- Select data -- </option>
							<option value='experiment'>Select experiments</option>
						  	<option value='annotation'>Select annotations</option>
						</select>
					</div>
				</div>

				<!--<h1 class="font-md"> Search Results for <span class="semi-bold">Projects</span><small class="text-danger"> &nbsp;&nbsp;(2,281 results)</small></h1>-->

				<!-- Div for experiment div -->

				<div id="expSelectedOptionDiv" style="display:none;">
					<h2>Experiment</h2>
					<div class='workflowInputs'>
						<!-- <input type='text' id='exp_workflow_experiment' placeholder='Experiment name'/> -->
						<input type='text' id='exp_workflow_genome' placeholder='Genome'/>
						<input type='text' id='exp_workflow_epigenetic_mark' placeholder='Epigenetic mark'/>
						<input type='text' id='exp_workflow_sample' placeholder='Sample'/>
						<input type='text' id='exp_workflow_technique' placeholder='Technique'/>
						<input type='text' id='exp_workflow_project' placeholder='Project'/>

						<div class='workflow_additional_inputs'>
							<input type='text' id='exp_workflow_chromosome' placeholder='Chromosome'/>
							<input type='text' id='exp_workflow_start' placeholder='Start'/>
							<input type='text' id='exp_workflow_end' placeholder='End'/>
							<button type="button" id="selectWorkflowBtn" class="btn btn-primary download-btn-size" data-toggle='modal' data-target='#myWorkflowModal'>Select</button>
						</div>
						
					</div>					
				</div>

				<!-- Div for annotations div -->

				<div id="annotSelectedOptionDiv" style="display:none;">
					<h2>Annotation</h2>
					<div class='workflowInputs'>
						<!--<input type='text' id='annot_workflow_annotation' placeholder='Annotation name'/> -->
						<input type='text' id='annot_workflow_genome' placeholder='Genome'/>
						<!--<input type='text' id='annot_workflow_description' placeholder='Description'/> -->
						<div class='workflow_additional_inputs'>
							<input type='text' id='exp_workflow_chromosome' placeholder='Chromosome'/>
							<input type='text' id='exp_workflow_start' placeholder='Start'/>
							<input type='text' id='exp_workflow_end' placeholder='End'/>
							<button type="button" id="annot_selectWorkflowBtn" class="btn btn-primary download-btn-size" data-toggle='modal' data-target='#myWorkflowModal'>Select</button>
						</div>

					</div>
				</div>

				<!-- Div for list of selected experiments/annotations -->

				<div class='parent_workflow_selected_list' style="display:none;">
					<h2></h2>
					<div class='workflow_selected_list'></div>
				<div>

			</div>
			<div class='clear'></div>
		</div>
	</div>

</div>

<!-- Modal -->
<div class="modal fade" id="myWorkflowModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
				&times;
			</button>
			<h4 class="modal-title" id="myModalLabel"></h4>
		</div>
		<div class="modal-body custom-scroll terms-body">

			<div id='modal_for_experiments' style="display:none;">
				<?php echo $deepBlueObj->experimentDataTableTemplate('workflow'); ?>
			</div>

			<div id="modal_for_annotations" style="display:none;">
				<?php echo $deepBlueObj->annotationDataTableTemplate('workflow'); ?>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">
					Close
				</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- end row -->

<script type="text/javascript">

	pageSetUp();

	// PAGE RELATED SCRIPTS

	// pagefunction

	var pagefunction = function() {

		$("#search_input").focus();
	};

	$('#workFlowSelectForm').change(function(){

		var optionVal = $('#workFlowSelectForm').val();

		/* Reseting all input texts when onchage event triggers */

		$('.workflow_selected_list').empty();
		$('.parent_workflow_selected_list').hide();
		$(".workflowInputs input[type='text']").val('');

		if(optionVal == 'experiment'){

			$('#annotSelectedOptionDiv').hide();
			$('#expSelectedOptionDiv').show();

			$('#modal_for_annotations').hide();
			$('#modal_for_experiments').show();


		}
		else if(optionVal == 'annotation'){
			$('#expSelectedOptionDiv').hide();
			$('#annotSelectedOptionDiv').show();

			$('#modal_for_experiments').hide();
			$('#modal_for_annotations').show();

		}
		else{
			$('#expSelectedOptionDiv').hide();
			$('#annotSelectedOptionDiv').hide();
		}

	});

	/* Search result :: Displaying modal view after clicking to the select */

	//$('.seach-result-title span').click(function(){

	$('#selectWorkflowBtn, #annot_selectWorkflowBtn').unbind('click').bind('click', function (e) {

	//$(document).on("click", '#selectWorkflowBtn, #annot_selectWorkflowBtn', function () {

		var selectedElementsModal = [];

		var optionVal = $('#workFlowSelectForm').val();
		var workflow_table_id;

		if(optionVal == 'experiment'){

			workflow_table_id = '#datatable_fixed_column';

			//var experiment = $('#exp_workflow_experiment').val();
			var genome = $('#exp_workflow_genome').val();
			var epigenetic_mark = $('#exp_workflow_epigenetic_mark').val();
			var sample = $('#exp_workflow_sample').val();
			var technique = $('#exp_workflow_technique').val();
			var project = $('#exp_workflow_project').val();
			//var description = $('#exp_workflow_description').val();

			var inputDataArray = {};
			
			inputDataArray['genome'] = genome;
			inputDataArray['epigenetic_mark'] = epigenetic_mark;
			inputDataArray['sample'] = sample;
			inputDataArray['technique'] = technique;
			inputDataArray['project'] = project;

			var notEmptyValues = new Array();
			var key;

			for(key in inputDataArray){
			  	if(inputDataArray[key] != ''){
					notEmptyValues.push(key);
				}
			}

		}
		else if(optionVal == 'annotation'){

			workflow_table_id = '#annotation_datatable_fixed_column';

			//var annotation = $('#annot_workflow_annotation').val();
			var genome = $('#annot_workflow_genome').val();

			var inputDataArray = {};
			inputDataArray['genome'] = genome;

		}
		else{
			alert("not selected!");
		}

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

		/* COLUMN FILTER  */

		var jsonString = JSON.stringify(inputDataArray);

		//alert("Sendgach "+jsonString);

		var otable = $(workflow_table_id).DataTable({

		    "ajax": {
		    "url": "ajax/server_side/modal_view_server_processing.php",
		    "data": function ( d ) {
		       		d.sendOptionVal = optionVal;
		       		d.sendData = jsonString;
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

				/* Collecting all not empty input text values and disable them */

				if(optionVal == 'experiment'){

					var notEmptyValCollect = "";

					$.each(notEmptyValues, function(iCollect, itemCollect) {						
						notEmptyValCollect += "#experiment-"+itemCollect+", ";
					});

					var selectTableInputs = notEmptyValCollect.slice(0,-2);		
					$(selectTableInputs).prop('disabled', true);

				}
				else{
					if(genome != ''){

						$('#annotation-genome').val(genome);
						$('#annotation-genome').prop('disabled', true);

					}
				}	

				/* Insert or remove selected or unselected elements */

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

		/* Download button :: Getting selected elements */

		$('#selectWorkflowBtnModalTop, #selectWorkflowBtnModalBottom, #select_annot_workflowBtn_top, #select_annot_workflowBtn_bottom').unbind('click').bind('click', function (e) {
		//$('#selectWorkflowBtnModal').click(function(){

			if(selectedElementsModal.length == 0){
				alert("Please select elements!");
			}
			else{
				
				/* Hiding the modal view after clicking selecting */
				$('#myWorkflowModal').modal('hide');
				
				$( ".workflow_selected_list" ).empty();
				$('.parent_workflow_selected_list h2').text("Selected "+optionVal+"s");
				$('.parent_workflow_selected_list').show();

				var selected_element_list = "";

				$.each(selectedElementsModal, function(iSelected, itemSelected) {
					var splitted_values = itemSelected.split('-');

					selected_element_list += '<tr><td>'+splitted_values[0]+'</td><td>'+splitted_values[1]+'</td></tr>';
					//alert("id : "+splitted_values[0]+" @@ name : "+splitted_values[1]);
				});				

				$('.workflow_selected_list').append(
					"<table class='table table-striped search-modal-table-td'>"+
						"<thead>"+
						  	"<tr>"+
						    	"<th>ID</th>"+
						     	"<th>Name</th>"+
						  	"</tr>"+
						"</thead>"+
						"<tbody>"+ selected_element_list);

				selected_element_list = "";

			}

		});

		//selectedElementsModal = [];

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


		// custom toolbar
		$("div.toolbar").html('<div class="text-right"><img src="img/logo.png" alt="SmartAdmin" style="width: 111px; margin-top: 3px; margin-right: 10px;"></div>');

		// Apply the filter
		$("#datatable_fixed_column thead th input[type=text]").on( 'keyup change', function () {

		    otable
		        .column( $(this).parent().index()+':visible' )
		        .search( this.value )
		        .draw();

		});


	});

	// end pagefunction

	// run pagefunction on load

	//pagefunction();

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