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
				
				<!-- STEP - 0 [ Selecting annotaions or experiments ] -->

				<div id='workFlowSelectForm_div'>
					<h1> Please, select the data</h1>
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

					<!-- Div for experiment div -->

					<div id="experimentSelectedOptionDiv" style="display:none;">
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
								<button type="button" id="experiment_selectWorkflowBtn" class="exp_selectWorkflowBtn btn btn-primary download-btn-size" data-toggle='modal' data-target='#myWorkflowModal'>Select</button>
							</div>
							
						</div>					
					</div>

					<!-- Div for annotations div -->

					<div id="annotationSelectedOptionDiv" style="display:none;">
						<h2>Annotation</h2>
						<div class='workflowInputs'>
							<input type='text' id='annot_workflow_genome' placeholder='Genome'/>
							<div class='workflow_additional_inputs'>
								<input type='text' id='exp_workflow_chromosome' placeholder='Chromosome'/>
								<input type='text' id='exp_workflow_start' placeholder='Start'/>
								<input type='text' id='exp_workflow_end' placeholder='End'/>
								<button type="button" id="annotation_selectWorkflowBtn" class="annot_selectWorkflowBtn btn btn-primary download-btn-size" data-toggle='modal' data-target='#myWorkflowModal'>Select</button>
							</div>

						</div>
					</div>
				</div>

				<!-- Div for list of selected experiments/annotations -->

				<div class='parent_workflow_selected_list' style="display:none;">
					<h2></h2><a id='selected_anno_exp_edit_link'>Edit</a><br/>
					<div class='workflow_selected_list'></div>
				</div>

				<!-- Operation combobox parent div -->

				<div id='operation_combobox_append'>
					<div class='operation_combobox_info_append'></div>
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

	var pagefunction = function() {

		//$("#search_input").focus();
	};

	/* Display/Hide proper datatable content in html ( Display: none/show ) */

	function showSelectedModal(showModal, hideModal){
		if(showModal != undefined && hideModal != undefined){
			$(showModal).show();
			$(hideModal).hide();
		}
		else{
			alert("Missed data table id argument");
		}
	}

	/* Step - 1 :: Shows properly selected option div ( Experiments or Annotations ) */

	function showSelectedOption(elm, experiment, annotation, exp_modal, ann_modal){
		var selected_val = elm.val();

		if(selected_val == undefined || experiment == undefined || annotation == undefined){
			alert("Missed arguments");
			return;
		}

		switch(selected_val){
			case 'experiment':
				$(annotation_div).hide();
				$(experiment_div).show();
				showSelectedModal(exp_modal, ann_modal);
				break;
			case 'annotation':
				$(experiment_div).hide();
				$(annotation_div).show();
				showSelectedModal(ann_modal, exp_modal);
				break;
			default:
				$(experiment_div).hide();
				$(annotation_div).hide();
				alert("Please select experiment or annotation!");

		}
	}

	/* This function gets all input text values which user typed for 
	 * filtering ( genome name, sample name, technique and ... ) and returns 
	 * array with all values
	 */

	function get_textInput_values(selectedInputs){

		/* Collect all input text values into array */
		var inputDataArray = {};

		$.each(selectedInputs, function(iterationNum, iterationVal) {
			var splitted_values = iterationVal.id.split('_');
			var var_name = "";
					
			$.each(splitted_values, function(iNum_2, iVal_2){
				
				if(iNum_2 != 0 && iNum_2 != 1){
					var_name += iVal_2+'_';
				}
			});

			var_name = var_name.slice(0,-1);			

			if(var_name == 'chromosome' || var_name == 'start' || var_name == 'end'){				
				return false;
			}

			inputDataArray[var_name] = iterationVal.value;

		});

		return inputDataArray;
			
	}

	function get_chrome_start_end(selectedInputs){

		var chrome_start_end = [];

		$.each(selectedInputs, function(iterationNum, iterationVal) {
			var splitted_values = iterationVal.id.split('_');
			var var_name = "";
					
			$.each(splitted_values, function(iNum_2, iVal_2){
				
				if(iNum_2 != 0 && iNum_2 != 1){
					var_name += iVal_2+'_';
				}
			});

			var_name = var_name.slice(0,-1);			

			if(var_name == 'chromosome' || var_name == 'start' || var_name == 'end'){				
				if(iterationVal.value != ''){
					chrome_start_end.push(iterationVal.value);
				}
			}

		});

		return chrome_start_end;

	}

	/*	This function checks input text value array which filtered 
	 *	values are entered by user ( Not always all filtered values 
	 * 	will be entered ) and saves into array these filtered values.
	 */

	function get_not_empty_values(inputValue){
		var notEmptyValues = [];
		var key;

		for(key in inputValue){
			if(inputValue[key] != ''){
				notEmptyValues.push(key);
			}
		}

		return notEmptyValues;
	}

	
	/* 	Collect selected Experiments or Annotations into array 
	 * 	( from DataTable with checkboxes )
	 */

	function collect_selected_elements(element, total_collected_array){

		var selected_id = $(element).parent().next().text();
		var selected_title = $(element).parent().nextAll().eq(1).text();
		var selected_total_value = selected_id+"|-|"+selected_title;

		var found = $.inArray(selected_total_value, total_collected_array);

		if($(element).is(':checked')){
			total_collected_array.push(selected_total_value);
		}
		else{
			total_collected_array.splice(found, 1);
		}

		return total_collected_array;

	}

	/* This method we use when we want to load DataTable content from server */

	var total_collected_array = [];

	function dataTable_load_data(table_id, inputValues, optionVal, isEdited){

		/* Reset all input values in Datatable */

		$( table_id + ' .hasinput input').val("");
		$( table_id + ' .hasinput input').prop('disabled', false);


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

		var jsonString = JSON.stringify(inputValues);

		var otable = $(table_id).DataTable({

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
					responsiveHelper_datatable_fixed_column = new ResponsiveDatatablesHelper(table_id, breakpointDefinition);
				}
			},
			"rowCallback" : function(nRow) {
				responsiveHelper_datatable_fixed_column.createExpandIcon(nRow);
			},
			"drawCallback" : function(oSettings) {
				responsiveHelper_datatable_fixed_column.respond();
			},
			"fnInitComplete": function(oSettings, json) {


				/* 	In this part, we get all filled input ids and values
				 *	and put values into DataTable and disable this input text
				 */

				var notEmptyVals = get_not_empty_values(inputValues);

				$.each(notEmptyVals, function(iNum_3, iVal_3){

					$("#"+optionVal+"-"+iVal_3).val(inputValues[iVal_3]);
					$("#"+optionVal+"-"+iVal_3).prop('disabled', true);

				});

				/* 	Triggers when user selects checkboxes in experiments
				 * 	or annotation DataTable for collecting selected elements.
				 */

				if(isEdited == 'false'){
					total_collected_array = [];
					$(table_id+' .downloadCheckBox').prop('checked', false);
				}

				$(table_id+' .downloadCheckBox').change(function(){
					collect_selected_elements(this, total_collected_array);
				});

				/* 	This code helps us to check checkboxes when we click
				 *	edit link and we can see previous checked elements.
				 */

				if(isEdited != 'false'){
			 		$.each(isEdited, function(idNum, idVal) {
						$(table_id+" #"+idVal).prop('checked', true);
					});
				}

			}

		});

		return otable;

	}

	/* Apply DataTable filtering */

	function apply_filer(table_id, otable){
		$(table_id + " thead th input[type=text]").on( 'keyup change', function () {

		    otable
		        .column( $(this).parent().index()+':visible' )
		        .search( this.value )
		        .draw();

		});
	}

	/* This method we use for showing Datatable content depending on what
	 * was selected from combobox.
	 */

	function dataTable_content_show(show_type, allInputs, table_id, isEdited){

		switch(show_type){
			case 'experiment':
				
				/* Getting all text input values */

				var exp_input_values = get_textInput_values(allInputs);
				var otable = dataTable_load_data(table_id, exp_input_values, 'experiment', isEdited);
				apply_filer(table_id, otable);

				break;
			case 'annotation':

				/* Getting all text input values */

				var anno_input_values = get_textInput_values(allInputs);
				var otable = dataTable_load_data(table_id, anno_input_values, 'annotation', isEdited);
				apply_filer(table_id, otable);

				break;
			default:
				alert("Not valid Datatable content");
		}

	}

	/*	This method builds table from selected elements ( Gets selected experiments 
	 *	or annotations from collected array ) 
	 */

	function build_table(inputCollectedArr, append_div, steps_number, data_table_show_id){

		var selected_element_list = "";
		var linkOn;

 		$.each(inputCollectedArr, function(iNum_4, iValue_4) {
			
			var splitted_values = iValue_4.split('|-|');
			selected_element_list += '<tr><td>'+splitted_values[0]+'</td><td>'+splitted_values[1]+'</td></tr>';
		});

		if(data_table_show_id == 'experiment' || data_table_show_id == 'annotation'){
			linkOn = "";
		}
		else{
			linkOn = "<a class='selected_anno_exp_edit_link' id='selected_anno_exp_edit_link_"+steps_number+"'>Edit</a>";
		}

		if(steps_number != 1){

			append_div.append(
			"<div class='infos' id='info_"+steps_number+"'>"+
			"<h2>Selected "+data_table_show_id+"s [ Step "+steps_number+" ]</h2>"+linkOn+
			"<a class='info_remove_link' id='info_remove_"+steps_number+"'>Remove</a><br/>"+
			"<div class='workflow_selected_list'>"+
			"<table class='table table-striped search-modal-table-td'>"+
				"<thead>"+
				  	"<tr>"+
				    	"<th>ID</th>"+
				     	"<th>Name</th>"+
				  	"</tr>"+
				"</thead>"+
				"<tbody>"+ selected_element_list +
			"</div></div>");

		}
		else{

			append_div.append(
			"<table class='table table-striped search-modal-table-td'>"+
				"<thead>"+
				  	"<tr>"+
				    	"<th>ID</th>"+
				     	"<th>Name</th>"+
				  	"</tr>"+
				"</thead>"+
				"<tbody>"+ selected_element_list);
		}

	}

	/* Operation combobox show only selected */

	function show_only_selected(this_element){

		var selectElementId = this_element;
		var selectCollection = '';

		var operationVal = $('#'+selectElementId).val();
		var getCounter = selectElementId.split('_');	

		$('#operation_combobox_'+getCounter[1]).children().each(function () {
			var thisId = this.id;

		    if(thisId != '' && thisId != operationVal+'_ComboBox_'+getCounter[1]){
		    	selectCollection += '#'+thisId+', ';
		    }
		});

		selectCollection = selectCollection.slice(0, -2);

		$(selectCollection).hide();

		/* Displaying selected operation */

		$('#'+operationVal+'_ComboBox_'+getCounter[1]).show();

	}

	/* Getting selected element ids only ids! */

	function get_selected_ids(total_array){

		var selected_ids = [];

		$.each(total_array, function(iNum_5, iValue_5) {
			var splitted_values = iValue_5.split('|-|');
			selected_ids.push(splitted_values[0]);
		});

		return selected_ids;

	}

	/* Info edit link */

	function info_edit_link(this_element){

		$(this_element).hide();
		
		var info_div_id = $(this_element).parent().attr('id');
		var info_edit_input_div = $('#'+info_div_id+' div').attr('id');
		var info_table = $('#'+info_div_id+' table').attr('id');
		
		$('#'+info_table).hide();
		$('#'+info_edit_input_div).show();

	}

	/* Save changes after editing the selected operations table */

	function info_edit_save(this_element){

		$('.info_edit_link').show();
		var table_id = $(this_element).parents().eq(1).attr('id');
		
		var table_tr = $('#'+table_id+' table .table_values');

		$(this_element).parent().children().each(function (e, data_1) {
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

	}

	/* Update step numebers */

	function update_steps(select_element, steps_collection){

		select_element.children().each(function (i, v) {
			if(v.id != ''){

				$("#"+v.id+" .has-select-options").find("option").remove();
				$("#"+v.id+" .has-select-options").append(steps_collection);
			}

		});
	}

	/* Total step collector method */

	function total_collector(collecter_array, selected_item, current_step, parameters, chromosome, start, end){

		var parameters_array = []
		$.each(parameters, function(iN, iV) {
			
			var splitted_values = iV.split('|-|');
			parameters_array.push(splitted_values[1]);
		});

		collecter_array.push(["select_"+selected_item, "Step "+current_step, [parameters_array], chromosome, start, end ]);

		return collecter_array;

	}

	/* Step - 1 :: Selecting experiments or annotations */

	var total_steps_collector = [];
	var step_numbers = 0;
	var select_options = "";

	var step_1 = $("#workFlowSelectForm");
	var step_1_parent_div = $('#workFlowSelectForm_div');

	var experiment_div = $("#experimentSelectedOptionDiv");
	var annotation_div = $("#annotationSelectedOptionDiv");
	var experiment_table_modal = $('#modal_for_experiments');
	var annotation_table_modal = $('#modal_for_annotations');

	var exp_and_annot_select_btn = $('.exp_selectWorkflowBtn, .annot_selectWorkflowBtn');
	var dataTable_show_id;
	var workflow_table_id;
	var select_buttons = $('#exp_select_btn_top, #exp_select_btn_bottom, #annot_select_btn_top, #annot_select_btn_bottom');
	var modal_dialog_div = $('#myWorkflowModal');
	var selected_elements_table_1 = $(".workflow_selected_list");

	var edit_link_1 = $('#selected_anno_exp_edit_link');

	var meta_data_more_view = $('.exp-metadata-more-view');

	var operation_combobox_div = ".workflow_operations_combobox";
	var operation_combobox_select = $(".operation_combobox_append .workflow_operations_combobox select");
	var operation_combobox_append = $('#operation_combobox_append');

	var remove_link = $('.info_remove_link');

	var info_append_div = $('.operation_combobox_info_append');

	/* Hide and show experiment metadata */

	var isShow = false;
	meta_data_more_view.click(function(){
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
	
	/* Triggers when experiment or annotation select option changes */

	step_1.change(function(){
		showSelectedOption(step_1, experiment_div, annotation_div, experiment_table_modal, annotation_table_modal);
		
		dataTable_show_id = step_1.val();
	});

	/* Triggers when "select" button pressed ( "select" before DataTable displays ) */
	
	var allInputs;

	$(document).on("click", '.exp_selectWorkflowBtn, .annot_selectWorkflowBtn', function () {
		
		/* Selecting all input text elements */

		allInputs = $("#"+dataTable_show_id+"SelectedOptionDiv .workflowInputs input:text");
		workflow_table_id = "#"+dataTable_show_id+"_datatable_fixed_column";

		var isEdited = edit_link_1.prev().attr('class');
		
		if(isEdited != 'edited'){

			dataTable_content_show(dataTable_show_id, allInputs, workflow_table_id, 'false');

		}
		else{
			var selected_ids = get_selected_ids(total_collected_array);			
			dataTable_content_show(dataTable_show_id, allInputs, workflow_table_id, selected_ids);
		}

	});

	/* 	This click event triggers when user clicks "select" button in DataTable 
	 *	after experiments or annotations checkboxes checked
	 */

	 select_buttons.click(function(){

	 	if(total_collected_array.length != 0){

	 		/* Hide modal window after clicking select */
	 		modal_dialog_div.modal('hide');

	 		var isEdited = edit_link_1.prev().attr('class');

	 		if((step_numbers == 0) || ( step_numbers == 1 && isEdited == 'edited')){

		 		/* Make empty selected list div */
		 		selected_elements_table_1.empty();

		 		if(isEdited != 'edited'){
		 			selected_elements_table_1.parent().find("h2").text("Selected "+dataTable_show_id+"s [ Step "+ ++step_numbers +" ]");

		 			select_options += "<option>Step "+step_numbers+"</option>";
		 			var chse = get_chrome_start_end(allInputs);
		 			
		 			/* Total collecter ( Collects all selected items ) */
		 			total_collector(total_steps_collector, dataTable_show_id, step_numbers, total_collected_array, chse[0], chse[1], chse[2]);

		 			operation_combobox_template(operation_combobox_append, step_numbers, select_options);
		 		}

		 		selected_elements_table_1.parent().show();

		 		/* Build table from selected elements */
		 		build_table(total_collected_array, selected_elements_table_1, step_numbers);

		 		step_1_parent_div.hide();
		 		$(operation_combobox_div).show(); // displays select combobox

	 		}
		 	else{

		 		/* Hiding the modal view after clicking select */
				$('#myWorkflowModal').modal('hide');


		 		/* Put "Remove" link to the last selected operation div */
		
				$("#info_edit_"+step_numbers+", #info_remove_"+step_numbers+', .operation_combobox').remove();

				++step_numbers;

				select_options += "<option>Step "+step_numbers+"</option>";

				var chse = get_chrome_start_end(allInputs);
				
				/* Total collecter ( Collects all selected items ) */
		 		total_collector(total_steps_collector, dataTable_show_id, step_numbers, total_collected_array, chse[0], chse[1], chse[2]);

				/* Build table from selected elements */
		 		build_table(total_collected_array, info_append_div, step_numbers, dataTable_show_id);

		 		operation_combobox_template(operation_combobox_append, step_numbers, select_options);

		 	}

	 	}
	 	else{
	 		alert("Please select elements!");
	 	}

	 });

	/* Edit Experiments or Annotations after selecting */

	edit_link_1.click(function(){

		$(this).prev().addClass('edited');
		selected_elements_table_1.parent().hide();
		step_1_parent_div.show();		

	});

	/* Edit Experiments or Annotations after selecting ( From operation select menu ) */

	$('.selected_anno_exp_edit_link').click(function(){
		this.parent().remove();

	});

	/* 	Operation combobox select, this part of code triggers when user changes
	 *	"select" form
	 */

	$(document).on("change", '#operation_combobox_append .workflow_operations_combobox select', function () {
		show_only_selected(this.id);
	});

	/* Operation combobox :: Triggers when "Apply Operation" button click */

	$(document).on("click", '.workflowInputs .operationsBtn', function () {
		
		/* Put "Remove" link to the last selected operation div */
		
		$(".info_remove_link, #info_edit_"+step_numbers+", #selected_anno_exp_edit_link, #selected_anno_exp_edit_link_"+step_numbers).remove();

		/* Hide operation combobox div after clicking 'Apply operation' button */
		
		var operation_combobox_id = $(this).parents().eq(2).attr('id');
		$('#'+operation_combobox_id).hide();

		var operation_input_html = $(this).parent();
		
		operation_input_html.find('button').attr('class', 'btn btn-primary operation_edit_save');
		operation_input_html.find('button').text('Save');

		var loopId = $(this).parent().attr('id');
		var infoTitle = $(this).parent().prev().html();
		var infoTh = '';
		var infoBody = '';
		var val_collection_array = [];

		$('#'+loopId).children().each(function () {
		    if(this.type != 'button'){
		    	var info_input_val = $('#'+this.id).val();
		    	var className_replaced = this.name.replace(" ", "_");

		    	val_collection_array.push(info_input_val);

		    	infoTh += "<th>"+this.name+"</th>";
		    	infoBody += "<td class='"+className_replaced+"'>"+ info_input_val + "</td>";
		    }
		});

		++step_numbers;

		select_options += "<option>Step "+step_numbers+"</option>";

		/* Total collecter ( Collects all selected items ) */
		total_steps_collector.push(["select_"+infoTitle, "Step "+step_numbers, [val_collection_array]]);		

		$('.operation_combobox_info_append').append("<div id='info_"+ step_numbers +"'>"+
			"<h1 class='info_title'>"+infoTitle+" [ Step "+ step_numbers +" ]</h1><a class='info_edit_link' id='info_edit_"+step_numbers+"'>Edit</a><a class='info_remove_link' id='info_remove_"+step_numbers+"'>Remove</a><br/>"+
			"<table id='info_table_"+step_numbers+"' class='table table-bordered search-modal-table-td'>"+
						"<thead>"+
						  	"<tr>"+infoTh+"</tr>"+
						"</thead>"+
						"<tbody><tr class='table_values'>"+infoBody+"</tr></tbody></table>"+
			"<div class='info_edit_inputDiv workflowInputs' id='info_edit_input_"+step_numbers+"' style='display:none;'>"+operation_input_html.html()+"</div>"+
			"</div>");

		operation_combobox_template(operation_combobox_append, step_numbers, select_options);
		
	});

	/* Info edit link */
	
	$(document).on("click", '.info_edit_link', function () {

		info_edit_link(this);

	});

	/* Save changes after editing the selected operations table */

	$(document).on("click", '.operation_edit_save', function () {

		info_edit_save(this);

	});

	/* Remove last wrong entered opertion */

	$(document).on("click", '.info_remove_link', function () {

		var splitted_values = this.id.split('_');
		var remove_number = splitted_values[2];

		select_options = select_options.replace("<option>Step "+remove_number+"</option>", "");
		step_numbers--;
		
		var remove_div_id = $(this).parent().attr('id');
		$('#'+remove_div_id+', #operation_combobox_'+step_numbers).remove();


		var select_div = $('#operation_combobox_'+step_numbers);
		var update_div_elements = $('#operation_combobox_'+remove_number);

		update_div_elements.remove();
		operation_combobox_template(operation_combobox_append, step_numbers, select_options);

		/* Updates all select options after removing */

		update_steps(update_div_elements, select_options);

	});

	/* Operation combobox div HTML Template */

	function operation_combobox_template(append_div, counter, select_options){

		append_div.append("<div class='operation_combobox' id='operation_combobox_"+counter+"'><!-- Div for operations combo box -->"+

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
					"<button type='button' name='experiment' id='experiment_selectWorkflowBtn_"+counter+"' class='exp_selectWorkflowBtn operation-modal-view btn btn-primary download-btn-size' data-toggle='modal' data-target='#myWorkflowModal'>Select</button>"+
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
					"<button type='button' name='annotation' id='annotation_selectWorkflowBtn_"+counter+"' class='annot_selectWorkflowBtn operation-modal-view btn btn-primary download-btn-size' data-toggle='modal' data-target='#myWorkflowModal'>Select</button>"+
				"</div>"+

			"</div>"+
		"</div>"+

		"<!-- Div for aggregate -->"+

		"<div id='aggregate_ComboBox_"+counter+"' style='display:none;'>"+
			"<h2>Aggregate</h2>"+
			"<div class='workflowInputs' id='aggregation_inputs_"+counter+"'>"+
				
				"<select class='steps-select form-control has-select-options' name='Data_ID' id='aggregate_data_id_"+counter+"'>"+select_options+"</select>"+
				"<select name='Ranges_ID' class='steps-select form-control has-select-options' id='aggregate_ranges_id_"+counter+"'>"+select_options+"</select>"+
				"<input type='text' name='Field' id='aggregate_field_"+counter+"' placeholder='Field'/>"+
							
				"<button type='button' class='btn btn-primary operationsBtn'>Apply Operation</button>"+
							
			"</div>"+
		"</div>"+

		"<!-- Div for count regions -->"+

		"<div id='count_regions_ComboBox_"+counter+"' style='display:none;'>"+
			"<h2>Count regions</h2>"+
			"<div class='workflowInputs' id='count_regions_inputs'>"+
				"<select name='Query_ID' class='steps-select form-control has-select-options' id='count_regions_query_id_"+counter+"'>"+select_options+"</select>"+
				"<button type='button' class='btn btn-primary directly_download'>Download</button>"+
			"</div>"+
		"</div>"+

		"<!-- Div for filter regions -->"+

		"<div id='filter_regions_ComboBox_"+counter+"' style='display:none;'>"+
			"<h2>Filter regions</h2>"+
			"<div class='workflowInputs' id='filter_regions_inputs_"+counter+"'>"+

				"<select name='Query_ID' class='steps-select form-control has-select-options' id='count_regions_query_id_"+counter+"'>"+select_options+"</select>"+
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
				"<select name='Query_ID' class='steps-select form-control has-select-options' id='get_experiments_by_query_id_"+counter+"'>"+select_options+"</select>"+
				"<button type='button' class='btn btn-primary directly_download'>Download</button>"+
			"</div>"+				
		"</div>"+

		"<!-- Div for Get regions -->"+

		"<div id='get_regions_ComboBox_"+counter+"' style='display:none;''>"+
			"<h2>Get regions</h2>"+
			"<div class='workflowInputs' id='get_regions_inputs_"+counter+"'>"+
				"<select name='Query_ID' class='steps-select form-control has-select-options' id='get_regions_query_id_"+counter+"'>"+select_options+"</select>"+
				"<input type='text' name='User_format' id='get_regions_user_format_"+counter+"' placeholder='User format'/>"+
				"<button type='button' class='btn btn-primary directly_download'>Download</button>"+
							
			"</div>"+			
		"</div>"+

		"<!-- Div for Intersection -->"+

		"<div id='intersection_ComboBox_"+counter+"' style='display:none;'>"+
			"<h2>Intersection</h2>"+
			"<div class='workflowInputs' id='intersection_inputs_"+counter+"'>"+
				"<select name='Query_A_ID' class='steps-select form-control has-select-options' id='intersection_query_a_id_"+counter+"'>"+select_options+"</select>"+
				"<select name='Query_B_ID' class='steps-select form-control has-select-options' id='intersection_query_b_id_"+counter+"'>"+select_options+"</select>"+
				"<button type='button' class='btn btn-primary operationsBtn'>Apply Operation</button>"+
							
			"</div>"+			
		"</div>"+

		"<!-- Div for Merge queries -->"+

		"<div id='merge_queries_ComboBox_"+counter+"' style='display:none;'>"+
			"<h2>Merge queries</h2>"+
			"<div class='workflowInputs' id='merge_queries_inputs_"+counter+"'>"+
				"<select name='Query_A_ID' class='steps-select form-control has-select-options' id='merge_queries_query_a_id_"+counter+"'>"+select_options+"</select>"+
				"<select name='Query_B_ID' class='steps-select form-control has-select-options' id='merge_queries_query_b_id_"+counter+"'>"+select_options+"</select>"+
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

	}


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