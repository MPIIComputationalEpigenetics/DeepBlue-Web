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

		<div id="myWorkflowContent" class="tab-content bg-color-white padding-10">
			<div class="tab-pane fade in active" id="s1">
				
				<div class='workFlowSelectForm_div'>
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
								<button type="button" id="selectWorkflowBtn" class="exp_selectWorkflowBtn btn btn-primary download-btn-size" data-toggle='modal' data-target='#myWorkflowModal'>Select</button>
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
								<button type="button" id="annot_selectWorkflowBtn" class="annot_selectWorkflowBtn btn btn-primary download-btn-size" data-toggle='modal' data-target='#myWorkflowModal'>Select</button>
							</div>

						</div>
					</div>
				</div>

				<!-- Div for list of selected experiments/annotations -->

				<div class='parent_workflow_selected_list' style="display:none;">
					<h2></h2><a id='selected_anno_exp_edit_link'>Edit</a><br/>
					<div class='workflow_selected_list'></div>
				</div>

				<div class='operation_combobox_append'>

					<div class='operation_combobox_info_append'></div>
					<div id='operation_combobox_1'>
					<!-- Div for operations combo box -->

					<div class='workflow_operations_combobox' style="display:none;">
						<div class='workflow-line'></div>
						<h1> Please, select the operation or download the data </h1><br>
						<div class="input-group input-group-lg hidden-mobile">
							<div class="input-group-btn">
								<select id='operationSelectForm_1' class="operationSelectForm form-control">
									<option value='0'> -- Select operations -- </option>
									<option value='experiment'>Select experiments</option>
							  		<option value='annotation'>Select annotations</option>
									<option value='aggregate'>Aggregate</option>
									<option value='count_regions'>Count regions</option>
								  	<option value='filter_regions'>Filter regions</option>
								  	<option value='get_experiments_by_query'>Get experiments by query</option>
								  	<option value='get_regions'>Get regions</option>
								  	<option value='intersection'>Intersection</option>
								  	<option value='merge_queries'>Merge queries</option>
								  	<option value='tiling_regions'>Tiling regions</option>
								</select>
								<!-- <button type="button" id="operations_download_data_1" class="btn btn-primary operation-download-btn">Download</button> -->
							</div>
						</div>
					</div>

					<!-- Div for experiment div -->

					<div id="experiment_ComboBox_1" style="display:none;">
						<h2>Experiment</h2>
						<div class='workflowInputs'>
							<input type='text' id='experiment_genome' placeholder='Genome'/>
							<input type='text' id='experiment_epigenetic_mark' placeholder='Epigenetic mark'/>
							<input type='text' id='experiment_sample' placeholder='Sample'/>
							<input type='text' id='experiment_technique' placeholder='Technique'/>
							<input type='text' id='experiment_project' placeholder='Project'/>

							<div class='workflow_additional_inputs'>
								<input type='text' id='experiment_chromosome' placeholder='Chromosome'/>
								<input type='text' id='experiment_start' placeholder='Start'/>
								<input type='text' id='experiment_end' placeholder='End'/>
								<button type="button" id="experiment_selectWorkflowBtn_1" class="operation-modal-view btn btn-primary download-btn-size" data-toggle='modal' data-target='#myWorkflowModal'>Select</button>
							</div>
							
						</div>					
					</div>

					<!-- Div for annotations div -->

					<div id="annotation_ComboBox_1" style="display:none;">
						<h2>Annotation</h2>
						<div class='workflowInputs'>
							
							<input type='text' id='annotation_genome' placeholder='Genome'/>
							<div class='workflow_additional_inputs'>
								<input type='text' id='annotation_chromosome' placeholder='Chromosome'/>
								<input type='text' id='annotation_start' placeholder='Start'/>
								<input type='text' id='annotation_end' placeholder='End'/>
								<button type="button" id="annotation_selectWorkflowBtn_1" class="operation-modal-view btn btn-primary download-btn-size" data-toggle='modal' data-target='#myWorkflowModal'>Select</button>
							</div>

						</div>
					</div>

					<!-- Div for aggregate -->

					<div id="aggregate_ComboBox_1" style="display:none;">
						<h2>Aggregate</h2>
						<div class='workflowInputs' id='aggregation_inputs'>
							
							<select name='Data_ID' class='steps-select form-control' id='aggregate_data_id_1'></select>
							<!--<input type='text' name='Data_ID' id='aggregate_data_id' placeholder='Data ID'/>-->
							
							<select name='Ranges_ID' class='steps-select form-control' id='aggregate_ranges_id_1'></select>
							<!--<input type='text' name='Ranges_ID' id='aggregate_ranges_id' placeholder='Ranges ID'/>-->
							<input type='text' name='Field' id='aggregate_field' placeholder='Field'/>
							
							<button type="button" class="btn btn-primary operationsBtn">Apply Operation</button>
							
						</div>					
					</div>

					<!-- Div for count regions -->

					<div id="count_regions_ComboBox_1" style="display:none;">
						<h2>Count regions</h2>
						<div class='workflowInputs' id='count_regions_inputs'>
							
							<select name='Query_ID' class='steps-select form-control' id='count_regions_query_id_1'></select>
							<!--<input type='text' name='Query_ID' id='count_regions_query_id' placeholder='Query ID'/>-->
							
							<button type="button" class="btn btn-primary directly_download">Download</button>
							
						</div>					
					</div>

					<!-- Div for filter regions -->

					<div id="filter_regions_ComboBox_1" style="display:none;">
						<h2>Filter regions</h2>
						<div class='workflowInputs' id='filter_regions_inputs'>
							
							<select name='Query_ID' class='steps-select form-control' id='filter_regions_query_id_1'></select>
							<!-- <input type='text' name='Query_ID' id='filter_regions_query_id' placeholder='Query ID'/> -->
							<input type='text' name='Field' id='filter_regions_field' placeholder='Field'/>
							<input type='text' name='Operation' id='filter_regions_operation' placeholder='Operation'/>
							<input type='text' name='Value' id='filter_regions_value' placeholder='Value'/>
							<input type='text' name='Type' id='filter_regions_type' placeholder='Type'/>
							
							<button type="button" class="btn btn-primary operationsBtn">Apply Operation</button>
							
						</div>					
					</div>

					<!-- Div for Get experiments by query -->

					<div id="get_experiments_by_query_ComboBox_1" style="display:none;">
						<h2>Get experiments by query</h2>
						<div class='workflowInputs' id='get_experiment_by_query_inputs'>
							
							<select name='Query_ID' class='steps-select form-control' id='get_experiments_by_query_id_1'></select>
							<!-- <input type='text' name='Query_ID' id='get_experiments_by_query_id' placeholder='Query ID'/> -->
							
							<button type="button" class="btn btn-primary directly_download">Download</button>
							
						</div>					
					</div>

					<!-- Div for Get regions -->

					<div id="get_regions_ComboBox_1" style="display:none;">
						<h2>Get regions</h2>
						<div class='workflowInputs' id='get_regions_inputs'>
							
							<select name='Query_ID' class='steps-select form-control' id='get_regions_query_id_1'></select>
							<!-- <input type='text' name='Query_ID' id='get_regions_query_id' placeholder='Query ID'/> -->
							<input type='text' name='User_format' id='get_regions_user_format' placeholder='User format'/>
							
							<button type="button" class="btn btn-primary directly_download">Download</button>
							
						</div>					
					</div>

					<!-- Div for Intersection -->

					<div id="intersection_ComboBox_1" style="display:none;">
						<h2>Intersection</h2>
						<div class='workflowInputs' id='intersection_inputs'>
							
							<select name='Query_A_ID' class='steps-select form-control' id='intersection_query_a_id_1'></select>
							<select name='Query_B_ID' class='steps-select form-control' id='intersection_query_b_id_1'></select>
							
							<button type="button" class="btn btn-primary operationsBtn">Apply Operation</button>
							
						</div>					
					</div>

					<!-- Div for Merge queries -->

					<div id="merge_queries_ComboBox_1" style="display:none;">
						<h2>Merge queries</h2>
						<div class='workflowInputs' id='merge_queries_inputs'>
							
							<select name='Query_A_ID' class='steps-select form-control' id='merge_queries_query_a_id_1'></select>
							<select name='Query_B_ID' class='steps-select form-control' id='merge_queries_query_b_id_1'></select>
							
							<button type="button" class="btn btn-primary operationsBtn">Apply Operation</button>
							
						</div>					
					</div>

					<!-- Div for Tiling regions -->

					<div id="tiling_regions_ComboBox_1" style="display:none;">
						<h2>Tiling regions</h2>
						<div class='workflowInputs' id='tiling_regions_inputs'>
							
							<input type='text' name='Size' id='tiling_regions_size' placeholder='Size'/>
							<input type='text' name='Genome' id='tiling_regions_genome' placeholder='Genome'/>
							<input type='text' name='Chromosome' id='tiling_regions_chromosome' placeholder='Chromosome'/>
							
							<button type="button" class="btn btn-primary operationsBtn">Apply Operation</button>
							
						</div>					
					</div>

					</div>
					
				</div>

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

	/* Define steps number */

	var step_number = 1;

	/* Steps collection array */

	var steps_collection = new Array();

	/* Collection of select options */

	var select_options = '';

	/* Select experiment and annotation */

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

	/* Selecting operations combo box */

	//$('.operation_combobox_append select').unbind('click').bind('click', function (e) {
	$(document).on("change", '.operation_combobox_append .workflow_operations_combobox select', function () {

		var selectElementId = this.id;
		var selectCollection = '';

		var operationVal = $('#'+selectElementId).val();
		var getCounter = selectElementId.split('_');

		$('#'+selectElementId).parents().eq(3).children().each(function () {
			var thisId = this.id;
		    if(thisId != '' && thisId != operationVal+'_ComboBox_'+getCounter[1]){
		    	selectCollection += '#'+thisId+', ';
		    }
		});

		selectCollection = selectCollection.slice(0, -2);

		$(selectCollection).hide();

		/* Appending steps into select combobox  */

		if(selectElementId == 'operationSelectForm_1'){
			$('#'+operationVal+'_ComboBox_'+getCounter[1]+' select').append(select_options);
		}

		/* Displaying selected operation */

		$('#'+operationVal+'_ComboBox_'+getCounter[1]).show();

	});

	/* Click apply button */
	var counter = 1;

	$(document).on("click", '.workflowInputs .operationsBtn', function () {

		/* Put "Remove" link to the last selected operation div */

		$('.info_remove_link').remove();

		/* Hide operation combobox div after clicking 'Apply operation' button */

		var operation_combobox_id = $(this).parents().eq(2).attr('id');
		$('#'+operation_combobox_id).hide();

		var operation_input_html = $(this).parent();
		//operation_input_html = $.parseHTML(operation_input_html);attr('id', newValue);
		
		operation_input_html.find('button').attr('class', 'btn btn-primary operation_edit_save');
		operation_input_html.find('button').text('Save');

		var loopId = $(this).parent().attr('id');
		var infoTitle = $(this).parent().prev().html();
		var infoTh = '';
		var infoBody = '';

		$('#'+loopId).children().each(function () {
		    if(this.type != 'button'){
		    	var info_input_val = $('#'+this.id).val();
		    	var className_replaced = this.name.replace(" ", "_");

		    	infoTh += "<th>"+this.name+"</th>";
		    	infoBody += "<td class='"+className_replaced+"'>"+ info_input_val + "</td>";
		    }
		});

		steps_collection.push('Step '+step_number);

		$.each(steps_collection, function(step_ids, step_names) {
			if(select_options.indexOf(step_names) === -1){
				select_options += "<option>"+step_names+"</option>";
			}
		});

		$('.operation_combobox_info_append').append("<div id='info_"+counter+"'>"+
			"<h1 class='info_title'>"+infoTitle+" [ Step "+ step_number++ +" ]</h1><a class='info_edit_link' id='info_edit_"+counter+"'>Edit</a><a class='info_remove_link' id='info_remove_"+counter+"'>Remove</a><br/>"+
			"<table id='info_table_"+counter+"' class='table table-bordered search-modal-table-td'>"+
						"<thead>"+
						  	"<tr>"+infoTh+"</tr>"+
						"</thead>"+
						"<tbody><tr class='table_values'>"+infoBody+"</tr></tbody></table>"+
			"<div class='info_edit_inputDiv workflowInputs' id='info_edit_input_"+counter+"' style='display:none;'>"+operation_input_html.html()+"</div>"+
			"</div>");

		counter++;

		//alert("Operations button clicked");
		//var idName = $(this).parent().attr('id');
		//var disableIds = "";
		// var operationSelectForm = "operationSelectForm_"+ counter++;
		// $('#operationSelectForm').attr('id', operationSelectForm);
		$('.operation_combobox_append').append("<div id='operation_combobox_"+counter+"'><!-- Div for operations combo box -->"+

		"<div class='workflow_operations_combobox'>"+
			"<div class='workflow-line'></div>"+
			"<h1> Please, select the operation or download the data </h1><br>"+
			"<div class='input-group input-group-lg hidden-mobile'>"+
				"<div class='input-group-btn'>"+
					"<select id='operationSelectForm_"+counter+"' class='operationSelectForm form-control'>"+
						"<option value='0'> -- Select operations -- </option>"+
						"<option value='experiment'>Select experiments</option>"+
						"<option value='annotation'>Select annotations</option>"+
						"<option value='aggregate'>Aggregate</option>"+
						"<option value='count_regions'>Count regions</option>"+
						"<option value='filter_regions'>Filter regions</option>"+
						"<option value='get_experiments_by_query'>Get experiments by query</option>"+
						"<option value='get_regions'>Get regions</option>"+
						"<option value='intersection'>Intersection</option>"+
						"<option value='merge_queries'>Merge queries</option>"+
						"<option value='tiling_regions'>Tiling regions</option>"+
					"</select>"+
					"<!-- <button type='button' id='operations_download_data_2' class='btn btn-primary operation-download-btn'>Download</button> -->"+
				"</div>"+
			"</div>"+
		"</div>"+

		"<!-- Div for experiment div -->"+

		"<div id='experiment_ComboBox_"+counter+"' style='display:none;'>"+
			"<h2>Experiment</h2>"+
			"<div class='workflowInputs'>"+
				"<input type='text' id='experiment_genome_"+counter+"' placeholder='Genome'/>"+
				"<input type='text' id='experiment_epigenetic_mark_"+counter+"' placeholder='Epigenetic mark'/>"+
				"<input type='text' id='experiment_sample_"+counter+"' placeholder='Sample'/>"+
				"<input type='text' id='experiment_technique_"+counter+"' placeholder='Technique'/>"+
				"<input type='text' id='experiment_project_"+counter+"' placeholder='Project'/>"+

				"<div class='workflow_additional_inputs'>"+
					"<input type='text' id='experiment_chromosome_"+counter+"' placeholder='Chromosome'/>"+
					"<input type='text' id='experiment_start_"+counter+"' placeholder='Start'/>"+
					"<input type='text' id='experiment_end_"+counter+"' placeholder='End'/>"+
					"<button type='button' id='experiment_selectWorkflowBtn_"+counter+"' class='operation-modal-view btn btn-primary download-btn-size' data-toggle='modal' data-target='#myWorkflowModal'>Select</button>"+
				"</div>"+
							
			"</div>"+
		"</div>"+

		"<!-- Div for annotations div -->"+

		"<div id='annotation_ComboBox_"+counter+"' style='display:none;'>"+
			"<h2>Annotation</h2>"+
			"<div class='workflowInputs'>"+
							
				"<input type='text' id='annotation_genome_"+counter+"' placeholder='Genome'/>"+
				"<div class='workflow_additional_inputs'>"+
					"<input type='text' id='annotation_chromosome_"+counter+"' placeholder='Chromosome'/>"+
					"<input type='text' id='annotation_start_"+counter+"' placeholder='Start'/>"+
					"<input type='text' id='annotation_end_"+counter+"' placeholder='End'/>"+
					"<button type='button' id='annotation_selectWorkflowBtn_"+counter+"' class='operation-modal-view btn btn-primary download-btn-size' data-toggle='modal' data-target='#myWorkflowModal'>Select</button>"+
				"</div>"+

			"</div>"+
		"</div>"+

		"<!-- Div for aggregate -->"+

		"<div id='aggregate_ComboBox_"+counter+"' style='display:none;'>"+
			"<h2>Aggregate</h2>"+
			"<div class='workflowInputs' id='aggregation_inputs_"+counter+"'>"+
				
				"<select class='steps-select form-control' name='Data_ID' id='aggregate_data_id_"+counter+"'>"+select_options+"</select>"+
				"<select name='Ranges_ID' class='steps-select form-control' id='aggregate_ranges_id_"+counter+"'>"+select_options+"</select>"+
				"<input type='text' name='Field' id='aggregate_field_"+counter+"' placeholder='Field'/>"+
							
				"<button type='button' class='btn btn-primary operationsBtn'>Apply Operation</button>"+
							
			"</div>"+
		"</div>"+

		"<!-- Div for count regions -->"+

		"<div id='count_regions_ComboBox_"+counter+"' style='display:none;'>"+
			"<h2>Count regions</h2>"+
			"<div class='workflowInputs' id='count_regions_inputs'>"+
				"<select name='Query_ID' class='steps-select form-control' id='count_regions_query_id_"+counter+"'>"+select_options+"</select>"+
				"<button type='button' class='btn btn-primary directly_download'>Download</button>"+
			"</div>"+
		"</div>"+

		"<!-- Div for filter regions -->"+

		"<div id='filter_regions_ComboBox_"+counter+"' style='display:none;'>"+
			"<h2>Filter regions</h2>"+
			"<div class='workflowInputs' id='filter_regions_inputs_"+counter+"'>"+

				"<select name='Query_ID' class='steps-select form-control' id='count_regions_query_id_"+counter+"'>"+select_options+"</select>"+
				"<input type='text' name='Field' id='filter_regions_field_"+counter+"' placeholder='Field'/>"+
				"<input type='text' name='Operation' id='filter_regions_operation_"+counter+"' placeholder='Operation'/>"+
				"<input type='text' name='Value' id='filter_regions_value_"+counter+"' placeholder='Value'/>"+
				"<input type='text' name='Type' id='filter_regions_type_"+counter+"' placeholder='Type'/>"+
							
				"<button type='button' class='btn btn-primary operationsBtn'>Apply Operation</button>"+
							
			"</div>"+
		"</div>"+

		"<!-- Div for Get experiments by query -->"+

		"<div id='get_experiments_by_query_ComboBox_"+counter+"' style='display:none;'>"+
			"<h2>Get experiments by query</h2>"+
			"<div class='workflowInputs' id='get_experiment_by_query_inputs_"+counter+"'>"+
				"<select name='Query_ID' class='steps-select form-control' id='get_experiments_by_query_id_"+counter+"'>"+select_options+"</select>"+
				"<button type='button' class='btn btn-primary directly_download'>Download</button>"+
			"</div>"+				
		"</div>"+

		"<!-- Div for Get regions -->"+

		"<div id='get_regions_ComboBox_"+counter+"' style='display:none;''>"+
			"<h2>Get regions</h2>"+
			"<div class='workflowInputs' id='get_regions_inputs_"+counter+"'>"+
				"<select name='Query_ID' class='steps-select form-control' id='get_regions_query_id_"+counter+"'>"+select_options+"</select>"+
				"<input type='text' name='User_format' id='get_regions_user_format_"+counter+"' placeholder='User format'/>"+
				"<button type='button' class='btn btn-primary directly_download'>Download</button>"+
							
			"</div>"+			
		"</div>"+

		"<!-- Div for Intersection -->"+

		"<div id='intersection_ComboBox_"+counter+"' style='display:none;'>"+
			"<h2>Intersection</h2>"+
			"<div class='workflowInputs' id='intersection_inputs_"+counter+"'>"+
				"<select name='Query_A_ID' class='steps-select form-control' id='intersection_query_a_id_"+counter+"'>"+select_options+"</select>"+
				"<select name='Query_B_ID' class='steps-select form-control' id='intersection_query_b_id_"+counter+"'>"+select_options+"</select>"+
				"<button type='button' class='btn btn-primary operationsBtn'>Apply Operation</button>"+
							
			"</div>"+			
		"</div>"+

		"<!-- Div for Merge queries -->"+

		"<div id='merge_queries_ComboBox_"+counter+"' style='display:none;'>"+
			"<h2>Merge queries</h2>"+
			"<div class='workflowInputs' id='merge_queries_inputs_"+counter+"'>"+
				"<select name='Query_A_ID' class='steps-select form-control' id='merge_queries_query_a_id_"+counter+"'>"+select_options+"</select>"+
				"<select name='Query_B_ID' class='steps-select form-control' id='merge_queries_query_b_id_"+counter+"'>"+select_options+"</select>"+
				"<button type='button' class='btn btn-primary operationsBtn'>Apply Operation</button>"+
							
			"</div>"+				
		"</div>"+

		"<!-- Div for Tiling regions -->"+

		"<div id='tiling_regions_ComboBox_"+counter+"' style='display:none;'>"+
			"<h2>Tiling regions</h2>"+
			"<div class='workflowInputs' id='tiling_regions_inputs_"+counter+"'>"+
				"<input type='text' name='Size' id='tiling_regions_size_"+counter+"' placeholder='Size'/>"+
				"<input type='text' name='Genome' id='tiling_regions_genome_"+counter+"' placeholder='Genome'/>"+
				"<input type='text' name='Chromosome' id='tiling_regions_chromosome_"+counter+"' placeholder='Chromosome'/>"+
				"<button type='button' class='btn btn-primary operationsBtn'>Apply Operation</button>"+
							
			"</div>"+			
		"</div></div>");

	});

	/* Search result :: Displaying modal view after clicking to the select */

	$('.exp_selectWorkflowBtn, .annot_selectWorkflowBtn').unbind('click').bind('click', function (e) {

	$('.workflow_operations_combobox').show(); // need to remove from here !!!

	//$(document).on("click", '#selectWorkflowBtn, #annot_selectWorkflowBtn', function () {

		var selectedElementsModal = [];
		var selected_elements_operation = [];

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

					var table_name = $(this).parents().eq(3).attr('name');

					var downloadIdModal = $(this).parent().next().text();
					var downloadTitleModal = $(this).parent().next().next().text();
					var downloadTotalModal = downloadIdModal+"-"+downloadTitleModal;

					if(table_name != 'annotation_data_table_1'){

						alert('Test != annotation_data_table_1');
						//selectedElementsModal = [];

						//alert(testPrint);
						//alert('idModal :'+downloadIdModal+'; titleModal : '+downloadTitleModal+'; totalModal : '+downloadTotalModal);

						var foundModal_Operation = $.inArray(downloadTotalModal, selected_elements_operation);

						if(foundModal_Operation < 0){
							selected_elements_operation.push(downloadTotalModal);
						}
						else{
							selected_elements_operation.splice(foundModal_Operation, 1);
						}


					}
					else{

						// var downloadIdModal = $(this).parent().next().text();
						// var downloadTitleModal = $(this).parent().next().next().text();
						// var downloadTotalModal = downloadIdModal+"-"+downloadTitleModal;

						//alert(testPrint);
						//alert('idModal :'+downloadIdModal+'; titleModal : '+downloadTitleModal+'; totalModal : '+downloadTotalModal);

						var foundModal = $.inArray(downloadTotalModal, selectedElementsModal);

						if(foundModal < 0){
							selectedElementsModal.push(downloadTotalModal);
						}
						else{
							selectedElementsModal.splice(foundModal, 1);
						}

					}

				});

			}


		});

		/* Download button :: Getting selected elements */

		//$('#selectWorkflowBtnModalTop, #selectWorkflowBtnModalBottom, #select_annot_workflowBtn_top, #select_annot_workflowBtn_bottom').unbind('click').bind('click', function (e) {
		$(document).on("click", '#selectWorkflowBtnModalTop, #selectWorkflowBtnModalBottom, #select_annot_workflowBtn_top, #select_annot_workflowBtn_bottom', function () {
		//$('#selectWorkflowBtnModal').click(function(){

			if(selectedElementsModal.length == 0){
				alert("Please select elements!");
			}
			else if(this.id == 'experiment_selectWorkflowBtn' || this.id == 'annotation_selectWorkflowBtn'){
				alert("Clicked exp or annotation button");
			}
			else{
				
				steps_collection.push("Step "+step_number);

				select_options += "<option>Step "+step_number+"</option>";

				/* Hiding the modal view after clicking select */
				$('#myWorkflowModal').modal('hide');
				
				$( ".workflow_selected_list" ).empty();
				$('.parent_workflow_selected_list h2').text("Selected "+optionVal+"s [ Step "+ step_number++ +" ]");
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

				/* Displaying operations combo box */

				//$('.workflow_operations_combobox').show(); !!!!! edited

				/* Hide workflow select form div for displaying selected experiment/annotations list */

				//$('#operation_combobox_1')
				$('.workFlowSelectForm_div').hide();

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

		$(document).on("click", '.operation-select', function () {
			// var slOp = $(this).attr('id');
			// alert(slOp);

			//var optionVal = 'test!!!';

			//alert('Operation select ;;;;;;; '+optionVal);

			alert(selected_elements_operation);

			steps_collection.push("Step "+step_number);

			select_options += "<option>Step "+step_number+"</option>";

			/* Hiding the modal view after clicking select */
			$('#myWorkflowModal').modal('hide');

			$('.operation_combobox_info_append').append("<div id='info_"+counter+"'>"+
			
			"<!-- Div for list of selected experiments/annotations -->"+
				"<div class='parent_workflow_selected_list'>"+
					"<h2>Selected "+optionVal+"s [ Step "+ step_number++ +" ]</h2><a id='selected_anno_exp_edit_link'>Edit</a><br/>"+
					"<div class='workflow_selected_list'></div>"+
				"</div>"+
			"</div>"
			);

			var selected_operation_elements = "";

			$.each(selected_elements_operation, function(iSelected_operation, itemSelected_operation) {
				var splitted_operation_values = itemSelected_operation.split('-');

				selected_operation_elements += '<tr><td>'+splitted_operation_values[0]+'</td><td>'+splitted_operation_values[1]+'</td></tr>';
				//alert("id : "+splitted_values[0]+" @@ name : "+splitted_values[1]);
			});				

			$('#info_'+counter).append(
				"<table class='table table-striped search-modal-table-td'>"+
					"<thead>"+
						"<tr>"+
							"<th>ID</th>"+
							"<th>Name</th>"+
						"</tr>"+
					"</thead>"+
					"<tbody>"+ selected_operation_elements);

			selected_operation_elements = "";

					/* Displaying operations combo box */

					//$('.workflow_operations_combobox').show(); !!!!! edited

					/* Hide workflow select form div for displaying selected experiment/annotations list */

					//$('#operation_combobox_1')
					//$('.workFlowSelectForm_div').hide();


		});


	});

	/* Info edit link */
	
	$(document).on("click", '.info_edit_link', function () {

		$(this).hide();
		
		var info_div_id = $(this).parent().attr('id');
		var info_edit_input_div = $('#'+info_div_id+' div').attr('id');
		var info_table = $('#'+info_div_id+' table').attr('id');
		
		$('#'+info_table).hide();
		$('#'+info_edit_input_div).show();

	});

	/* Save changes after editing the selected operations table */

	$(document).on("click", '.operation_edit_save', function () {

		$('.info_edit_link').show();
		var table_id = $(this).parents().eq(1).attr('id');
		
		var table_tr = $('#'+table_id+' table .table_values');

		$(this).parent().children().each(function (e, data_1) {
		    if(this.type != 'button'){

		    	table_tr.children().each(function (f, data_2) {

		    		if(data_1.name == data_2.className){
		    			$('#'+table_id+' table .table_values .'+data_2.className).text(data_1.value);
		    		}
		    	});
		    }
		});

		/* Hide edit inputs and show table */

		$('#'+table_id+' table').next().hide();
		$('#'+table_id+' table').show();

	});

	/* Edit Experiments or Annotations after selecting */

	$(document).on("click", '#selected_anno_exp_edit_link', function () {
		$('.parent_workflow_selected_list').hide();
		$('.workFlowSelectForm_div').show();
	});

	$(document).on("click", '.operation-download-btn', function () {
		alert("Steps : "+steps_collection);
	});

	/* Remove last wrong entered opertion */

	$(document).on("click", '.info_remove_link', function () {
		var remove_div_id = $(this).parent().attr('id');
		$('#'+remove_div_id).remove();
		step_number--;

	});

	/* Operation experiment and annotation select :: Modal view display */

	$(document).on("click", '.operation-modal-view', function () {

		$('#myWorkflowModal').find(':checked').each(function() {
		   $(this).removeAttr('checked');
		});

		$('#select_annot_workflowBtn_top').attr('id','select_annot_workflowBtn_top_'+counter);
		$('#select_annot_workflowBtn_top_'+counter).addClass('operation-select');

		$('#select_annot_workflowBtn_top_'+counter).parents().eq(3).attr('name','annotation_data_table_'+counter);

	});

	
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