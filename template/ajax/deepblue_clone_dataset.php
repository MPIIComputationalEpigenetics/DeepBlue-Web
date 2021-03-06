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
*   Created : 27-12-2014
*
*   ================================================
*
*   File : deepblue_clone_dataset.php
*
*/

/* DeepBlue Configuration */
require_once("inc/init.php");
?>

<div class="row">
	<div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
		<h1 class="page-title txt-color-blueDark"><i class="fa fa-copy"></i>
			Experiments cloning
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
					<span class="widget-icon"> <i class="fa fa-copy"></i> </span>
					<h2>Experiment selection</h2>

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
										<h4 class="alert-heading">Filter by experiment name or ID</h4>
										Enter experiment name or ID and click on the <i>Clone</i> button.
									</div>
									<div class="input-group">
										<input id="clone_input" class="form-control" type="text" placeholder="Experiment ID or Name ..." />
										<div class="input-group-btn">
											<button type="button" id="clone_bt" class="btn btn-default">
												&nbsp;&nbsp;&nbsp;<i class="fa fa-copy"></i>&nbsp;&nbsp;&nbsp;
											</button>
										</div>
									</div>
									<div id="error_div"></div>
								</div>
							</div>
							<hr>
							<div class="row">
								<div class="col-md-12 col-md-offset-0">
									<div class="alert alert-info alert-block">
										<a class="close" data-dismiss="alert" href="#">×</a>
										<h4 class="alert-heading">Filter by metadata</h4>
										Please select the desired metadata. The selected project, genome, epigenetic mark, technique, and sample are used to filter the experiments for cloning.
									</div>
								</div>
								<div class="col-md-6 col-md-offset-0" style="padding-bottom: 20px;">
									<input type="text" value="" class="form-control" id="user_project" placeholder="Filter by Project" />
								</div>
								<div class="col-md-6 col-md-offset-0" style="padding-bottom: 20px;">
									<input type="text" value="" class="form-control" id="user_epigenetic_mark" placeholder="Filter by Epigenetic marks" />
								</div>
								<div class="col-md-6 col-md-offset-0" style="padding-bottom: 20px;">
									<input type="text" value="" class="form-control" id="user_genome" placeholder="Filter by Genomes" />
								</div>
								<div class="col-md-6 col-md-offset-0" style="padding-bottom: 20px;">
									<input type="text" value="" class="form-control" id="user_technique" placeholder="Filter by Techniques" />
								</div>
								<div class="col-md-6 col-md-offset-0" style="padding-bottom: 20px;">
									<input type="text" value="" class="form-control" id="user_biosource" placeholder="Filter by Biosources" />
								</div>
								<div class="col-md-6 col-md-offset-0" style="padding-bottom: 20px;">
									<input id="user_sample" class="form-control" type="text"   placeholder="Filter by Samples" disabled/>
								</div>
								<div class="col-md-6 col-md-offset-0" style="padding-bottom: 20px;">
									<div class="input-group-btn">
										<button type="button" id="filter_bt" class="btn btn-primary">
											<i class="fa fa-forward"></i> Select Experiments
										</button>
									</div>
								</div>
							</div>
							<div id="error_div2"></div>
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

<!-- <div id="clone_display" class="tab-content bg-color-white padding-10" style="display: none">
	<div class="tab-pane fade in active" id="s1">
 -->
<section id="clone_display" style="display:none;">
	<!-- row -->
	<div class="row">

		<!-- NEW WIDGET START -->
		<article class="col-sm-12 col-md-12 col-lg-12">

			<!-- Widget ID (each widget will need unique ID)-->
			<div class="jarviswidget jarviswidget-color-blue" id="tree-biosources" data-widget-editbutton="true">

				<header>
					<span class="widget-icon"> <i class="fa fa-copy"></i> </span>
					<h2>Clone Experiments</h2>
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
								<div id="infoDesc" class="alert alert-info alert-block">
									<a class="close" data-dismiss="alert" href="#">×</a>
									<h4 class="alert-heading">Info</h4>
								</div>
								<div id="infoResult"></div>
							</div>
						</div>
						<hr>
						<div class="row">
							<div class="col-md-12 col-md-offset-0">
								<div id="columnDesc" class="alert alert-info alert-block">
									<a class="close" data-dismiss="alert" href="#">×</a>
									<h4 class="alert-heading">Format</h4>
								</div>
								<div id="columnResult"></div>
							</div>
						</div>
						<hr>
						<div class="row">
							<div class="col-md-12 col-md-offset-0">
								<div id="metadataDesc" class="alert alert-info alert-block">
									<a class="close" data-dismiss="alert" href="#">×</a>
									<h4 class="alert-heading">Metadata</h4>
								</div>
								<div id="metadataResult"></div>
							</div>
						</div>
						<div id="cloneButtonGroup" class="modal-footer" >
							<button type="button" id="closeExperimentButton" class="btn btn-default">
								Back to Selection
							</button>
							<button type="button" id="cloneExperimentButton" class="btn btn-primary download-btn-size">
								Clone
							</button>
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
				<div id='modal_for_experiment' style="display:none;">
					<!-- row -->
					<div class="row">
						<!-- NEW WIDGET START -->
						<article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
							<?php echo $deepBlueObj->experimentDataTableTemplate('clone'); ?>
						</article>
						<!-- WIDGET END -->
					</div>
				</div>
			</div><!-- /.modal-body -->
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script type="text/javascript">
	pageSetUp();

	// PAGE RELATED SCRIPTS
	// pagefunction
	var deletedrows = []; // removed metadata
	var deletedrowskeys = []; // removed metadata keys
	var removedColn = []; // remove columns
	var clonemetadata = []; // store new metadata val
	var clonemetakey = []; // store new metadata key
	var clone = false; // clone enabled
	var batch = false; // batch cloning
	var empty = false; // to show the metadata table is empty

	var pagefunction = function() {
		$("#clone_input").focus();
	};

	var cache = {};
	var vocabnames = ['projects','epigenetic_marks','techniques', 'biosources','genomes'];
	var vocabids = ['#user_project', '#user_epigenetic_mark','#user_technique','#user_biosource','#user_genome'];
	var vocabname;
	var vocabid;
	var count;
	var newcolcount = 0;
	var filter = true;
	filterdata = {'user_project' : "", 'user_epigenetic_mark' : "" , 'user_technique': "", 'user_sample':"", 'user_genome':"",'user_biosource':""};

	var list_in_use = JSON.parse(localStorage.getItem('list_in_use'));
	if (list_in_use == null) {
		var request1 = $.ajax({
			url: "ajax/server_side/faceting_experiments.php",
			dataType: "json",
		});

		request1.done( function(data) {
            if ("error" in data) {
                swal({
                    title: "Error listing experiments",
                    text: data['message']
                });
                // disable filter button
                $("#filter_bt").attr('disabled', 'disabled');
                return;
            }

            // store data in local storage
			localStorage.setItem("list_in_use", JSON.stringify(data[0]));
			list_in_use = JSON.parse(localStorage.getItem('list_in_use'));
            fetchExperiments();
		});

		request1.fail( function(jqXHR, textStatus) {
			console.log(jqXHR);
		    console.log('Error: '+ textStatus);
			alert( "Encountered an error. Please wait a few seconds and reload page. If problem persist, kindly log a complaint" );
		});
	}
	else {
		fetchExperiments();
	}

	function fetchExperiments() {
		/* retrieve deepblue list_experiment data */
		suggestions1 = JSON.parse(localStorage.getItem('all_experiments'));
		if (suggestions1 == null) {
			var request2 = $.ajax({
				url: "ajax/server_side/list_all_experiment.php",
				dataType: "json",
				data : {
				}
			});

			request2.done( function(data) {
				// store data in local storage
				if ("error" in data) {
					swal({
						title: "Error listing experiments",
						text: data['message']
					});

					// disable experiment id clone search button
					$("#clone_bt").attr('disabled', 'disabled');
					return;
				}
				localStorage.setItem("all_experiments", JSON.stringify(data[0]));
				suggestions1 = JSON.parse(localStorage.getItem('all_experiments'));
				cloneFunction();

			});

			request2.fail( function(jqXHR, textStatus) {
				console.log(jqXHR);
				console.log('Error: '+ textStatus);
				alert( "Encountered an error. Please wait a few seconds and reload page. If problem persist, kindly log a complaint" );
			});
		}
		else {
			cloneFunction();
		}
	}

	function cloneFunction() {
		$('#clone_input').autocomplete({
			source : suggestions1['experiment'],
			autoFocus: true,
			focus: function( event, ui ) { return false;},
			minLength: 3,
			select: function( event, ui ) {
				// enable clone button
				exp = ui.item.label;
				expId = exp.split(' ')[1];
				getId = [expId.substring(1, expId.length-1)];
				clone = true;
				$(event.target).closest(".input-group").removeClass('has-error');
			},
			change: function( event, ui ) {
				if (ui.item == null && event.target.value != "") {
					$(event.target).closest(".input-group").addClass('has-error');
					clone = false;
				}
				if (event.target.value == "") {
					$(event.target).closest(".input-group").removeClass('has-error');
					clone = true;
				}
			}
		});

		var suggestion2 = [];
		for (i in vocabnames) {
			vocabname = vocabnames[i];
			vocabid = vocabids[i];
			suggestion2[vocabname] = []; // index for each controlled vocabulary
			count = 0
			var currentvocab = list_in_use[vocabname]['alp'];
			for (j in currentvocab) {
				suggestion2[vocabname][count] = {'label' : currentvocab[j][1] + " (" + currentvocab[j][0] + ")", 'value' : currentvocab[j][1]};
				count = count + 1;
			}

			$(vocabid).autocomplete({
				source : suggestion2[vocabname],
				autoFocus: true,
				focus: function( event, ui ) { return false;},
				minLength: 0,
				select: function( event, ui ) {
					// enable clone button
					exp = ui.item.label;
					expId = exp.split(' ')[1];
					getId = expId.substring(1, expId.length-1);
					if (event.target.id == "user_biosource") {
						$("#user_sample").prop('disabled', false);

						// autocomplete for the samples field
						$("#user_sample").autocomplete({
							source : "ajax/server_side/list_form_biosource_samples.php?biosource=" + ui.item.value,
							autoFocus: true,
							focus: function( event, ui ) { return false;},
							minLength: 0,
							select: function( event, ui ) {

								exp = ui.item.label;
								getId = exp.split(' : ')[0];
								$(event.target).closest(".col-md-6").removeClass('has-error');

								filterdata[event.target.id] = getId;
								filter = true;
							},
							change: function( event, ui ) {
								if (ui.item == null && event.target.value != "") {
									$(event.target).closest(".col-md-6").addClass('has-error');
									filter = false;
								}
								if (event.target.value == "") {
									$(event.target).closest(".col-md-6").removeClass('has-error');
									filterdata[event.target.id] = "";
									filter = true;
								}
							}
						});
					}

					$(event.target).closest(".col-md-6").removeClass('has-error');
					filterdata[event.target.id] = ui.item.value;
					filter = true;
				},
				change: function( event, ui ) {
					if (event.target.id == "user_biosource") {
						$("#user_sample").val("");
						filterdata["user_sample"] = "";
					}

					if (ui.item == null && event.target.value != "") {
						$(event.target).closest(".col-md-6").addClass('has-error');
						filter = false;
					}
					if (event.target.value == "") {
						$(event.target).closest(".col-md-6").removeClass('has-error');
						filterdata[event.target.id] = "";
						filter = true;
					}
				}
			});
		}

	}

	/* Trigger single experiment search with presssing ENTER key */
	$("#clone_input").keypress(function(event){
		if(event.keyCode == 13){
			search_function();
			isSelected = 1;
		}
	});

	/* Trigger searching using filter with pressing ENTER Key */
	$("#user_epigenetic_mark, #user_project, #user_biosource, #user_sample, #user_technique, #user_genome").keypress(function(event){
		if(event.keyCode == 13){
			filter_function();
			isSelected = 1;
		}
	});

	// add click event listener to the search button
	$("#clone_bt").button().click(search_function);

	// add click event listener to the filter button
	$("#filter_bt").button().click(filter_function);

	function filter_function() {

		/* Check if auto-complete suggestion is selected */
		$( "#error_div2" ).empty();
		if(filter == false){
			$( "#error_div2" ).append( "<div class='search-results clearfix'><h2>Error in selection. Please select from the suggestion or leave empty.</h2></div>");
			return;
		}

		/* clear selections */
		selectedElements = [];
		selectedElementsNames = [];

		/* retrieve the list of experience based on filter */
		$('#datatable_fixed_column').dataTable().fnDestroy();

		/* COLUMN FILTER  */
		var otable = $('#datatable_fixed_column').DataTable({
		    "ajax": {
			    "url" : "ajax/server_side/list_all_experiment_table.php",
			    "data" : {
				    "projects" : filterdata['user_project'],
					"epigenetic_marks" : filterdata['user_epigenetic_mark'],
					"techniques" : filterdata['user_technique'],
					"samples" : filterdata['user_sample'],
					"genomes" : filterdata['user_genome'],
					"biosources" : filterdata['user_biosource']
			    }
		    },
		    "iDisplayLength": 50,
		    "autoWidth" : true,
			"scrollX" :  true,
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

					var found = $.inArray(downloadId, selectedElements);
					if(found < 0){
						selectedElements.push(downloadId);
						selectedElementsNames.push(downloadTitle);
					}
					else{
						selectedElements.splice(found, 1);
						selectedElementsNames.push(found, 1);
					}
				});
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

		// launch a modal view to allow selection of experiments
		$('#modal_for_experiment').show();
		$('#myModal').modal('show');
	}

	function search_function() {

		/* Checking search value is empty or not */
		$search = $('#clone_input').val();

		/* clear error div */
		$( "#error_div" ).empty();

		/* Check if auto-complete suggestion is selected */
		if(clone == false){
			$( "#error_div" ).append( "<div class='search-results clearfix'><h2>Experiment does not exist. Please select from the suggestion.</h2></div>");
			return;
		}

		var cloneInfoRequest = $.ajax({
			url: "ajax/server_side/clone_batch_get_info_server_processing.php",
			dataType: "json",
			data : {
				getId : getId,
				batch: batch,
			    projects : filterdata['user_project'],
				epigenetic_marks : filterdata['user_epigenetic_mark'],
				techniques : filterdata['user_technique'],
				samples : filterdata['user_sample'],
				genomes : filterdata['user_genome']
			}
		});

		cloneInfoRequest.done( function(data) {
            if ("error" in data) {
                swal({
                    title: "Error occurred",
                    text: data['message']
                });
                return;
            }

            columns = [];
			infoResult = "<table id='infoclone' class='table table-striped table-hover'><tbody>";
			cloneData = data.data['info'];
			var colTemp = {};
			$.each(data.data['info'], function(i, item) {
				if (i == 'Columns') {
					sect = 'columns';
					columnResult = "<table id='formatclone' class='table table-striped table-hover'><tbody>";
					var k = 1;
					calccoln = [];
					for (j in item) {
						colTemp[item[j]['name']] = item[j]['name'];
						columns[j] = item[j]['name'] + 'xyz123abc' + item[j]['column_type'];
						if (item[j]['column_type'] == 'code' || item[j]['column_type'] == 'calculated') {
							calccoln[k] = item[j]['name'];
							columnResult = columnResult + buildHTML(item[j]['name'], item[j]['column_type'], 'calculated_columns', k);
							k = k + 1;
						}
						else {
							columnResult = columnResult + buildHTML(item[j]['name'], item[j]['column_type'], sect, 0);
						}
					}
					columnResult = columnResult + "</tbody></table>" + "<button type='button' id='addcolbutton' class='btn btn-success' onclick='addColumn()'>Add Calculated Column</button><br/><br/><br/>";
					$("#columnResult").append(columnResult);
					$("#columnDesc").append("<p>Please edit the experiments columns to be updated in the new experiment</p>");
				}
				else if (i == 'Extra Metadata') {
					sect = 'extra_metadata';
					metadataResult = "<table id='metaclone' class='table table-striped table-hover'><tbody>";
					var key, value;
					var j = 1;
					for (key in item) {
						metadataResult = metadataResult + buildHTML(key, item[key], sect, j);
						clonemetakey[j] = key;
						clonemetadata[j] = item[key];
						j = j + 1;
					}
					// one more time
					newMeta = j;
					if (newMeta == 1) {
						empty = true;
					}
					metadataResult = metadataResult + "</tbody></table>" + "<button type='button' id='addmetabutton' class='btn btn-success' onclick='addMetadata()'>Add Metadata</button><br/><br/><br/>";
					$("#metadataResult").append(metadataResult);
					$("#metadataDesc").append("<p>Please edit the experiments metadata to be updated in the new experiment</p>");
				}
				else {
					sect = 'info';
					infoResult = infoResult + buildHTML(i, item, sect, 0);
				}
			});
			$( "#infoResult" ).append(infoResult);
			$("#infoDesc").append("<p>Experiment(s): " + data.data['names'] + "</p>");


			cloneData['experiment'] = "";
			cloneData['Columns'] = colTemp;

			// perform only in single cloning, batch cloning does not pad sample id with biosource name
			if (!batch) {
				cloneData['sample'] = cloneData['sample'].split(' ')[0];
			}
			else {
				$("#infoDesc").append("<p>Multiple experiments selected for cloning. For experiment name, enter suffix to be appended to original experiment name</p>");
				$("#columnDesc").append("<p>Multiple experiments selected for cloning. Only matching columns (by name and type) across all experiment(s) are displayed for editing</p>");

				$("#metadataDesc").append("<p>Multiple experiments selected for cloning. Only matching metadata names across all experiment(s) are displayed for editing</p>");

			}

			$("#clone_display").show();
			$("#widget-grid").hide();

			var vocabs = ['sample','epigenetic_mark','technique','project']
			var tags = vocabs.concat(columns);
			var current;
			var cache2 = {};
			for (i in tags) {
				tag = tags[i];
				cache2[tag] = {};
				$("#" + tag).autocomplete({
					source : function( request, response ) {
			          	var term = request.term;
			          	if ( term in cache2[current.id] ) {
			            	response( cache2[current.id][ term ] );
			            	return;
			          	}
			          	var url = "ajax/server_side/clone_get_data_server_processing.php?caller=" + current.id;
			          	$.getJSON( url, request, function( data, status, xhr ) {
                            if ("error" in data) {
                                swal({
                                    title: "Error occurred",
                                    text: data['message']
                                });
                                return;
                            }
			            	cache2[current.id][ term ] = data;
			            	response( data );
			          	})
					},
					autoFocus: true,
					focus: function( event, ui ) { return false;},
					minLength: 0,
					select: function( event, ui ) {
						$(current).closest(".search-modal-name").removeClass('has-error');
						if ($.inArray(current.id, columns) > -1) {
							coln = (current.id).split("xyz123abc")[0];
							cloneData['Columns'][coln] = ui.item.value;
						}
						else {
							cloneData[current.id] = ui.item.value;
						}
					},
					change: function( event, ui ) {
						if (ui.item == null) {
							$(current).value = "";
							$(current).closest(".search-modal-name").addClass('has-error');
						}
					}
				});

				$("#" + tag).focus(function() {
					current = this;
				});
			}

			// add listener for experiment name input field (to save values immediately)
			$("#experiment").blur(function() {
				cloneData[this.id] = this.value;
			});

			// Clone experiment
			$('#cloneExperimentButton').unbind('click').bind('click', function (e) {

				if (cloneData['experiment'] == "") {
					$('#experiment').closest(".search-modal-name").addClass('has-error');
					$('#experiment').focus();
					return;
				}
				else {
					$('#experiment').closest(".search-modal-name").removeClass('has-error');
				}

				//var list_in_use = JSON.parse(localStorage.getItem("list_in_use"));
				var tempMeta = {};
				for (j = 1; j < newMeta; j++) {
					if (deletedrows.indexOf(j) == -1) {
						tempMeta[clonemetakey[j]] = clonemetadata[j];
					}
				}
				cloneData['Extra Metadata'] = tempMeta;
				$('#cloneExperimentButton').attr('disabled','disabled');
				var request = $.ajax({
					url: "ajax/server_side/clone_batch_data_server_processing.php",
					dataType: "json",
					data : {
						data : cloneData,
						deleted : deletedrowskeys,
						removedColn : removedColn
					}
				});

				request.done( function(data) {
					var report = "";
    				for (l = 0; l < data.length; l++) {
						if (data[l][0] == 'okay') {
							report = report + "Experiment " + getId[l] + " cloning Successful: " + data[l][1] + "\n";
							//$( "#tempSearchResult" ).empty();
							$("#infoResult").empty(); $("#columnResult").empty(); $("#metadataResult" ).empty();
							$("#infoDesc").empty(); $("#columnDesc").empty(); $("#metadataDesc" ).empty();
							infoResult = ""; columnResult = ""; metadataResult = "";
							$("#clone_display").hide();
							$("#widget-grid").show();
						}
						else {
							report = report + "Experiment " + getId[l] + " cloning failed: " + data[l][1] + "\n";
						}
					}
                    swal({
                        title: "Experiment Cloning Report",
                        text: report
                    });
					$('#cloneExperimentButton').removeAttr('disabled');
				});

				request.fail( function(jqXHR, textStatus) {
					console.log(jqXHR);
		       		console.log('Error: '+ textStatus);
					alert( "error" );
					$('#cloneExperimentButton').removeAttr('disabled');
				});
			});
		});

		cloneInfoRequest.fail( function(jqXHR, textStatus) {
			console.log(jqXHR);
     	 	console.log('Error: '+ textStatus);
			alert( "Error in experiment modal view" );
		});

		$('#closeExperimentButton').unbind('click').bind('click', function (e) {
			$("#infoResult").empty(); $("#columnResult").empty(); $("#metadataResult" ).empty();
			$("#infoDesc").empty(); $("#columnDesc").empty(); $("#metadataDesc" ).empty();
			infoResult = ""; columnResult = ""; metadataResult = "";
			$("#clone_display").hide();
			$("#widget-grid").show();
		});

	}; // end search function

	/* save key or value of the metadata */
	function saveMetaData() {
		var id = event.target.id.split('_');
		var type = id[0];
		var idx = id[1];

		if (type == 'val') {
			clonemetadata[idx] = event.target.value;
		}
		else {
			deletedrowskeys.push(clonemetakey[idx]);
			clonemetakey[idx] = event.target.value;
		}
	}

	/* add column */
	function addColumn() {
		// implement adding additional column
		newcolcount = newcolcount + 1;
		var colId = "CALCULATED_COLUMN" + newcolcount + "xyz123abc" + "calculated";
		var newrow = buildHTML("CALCULATED_COLUMN" + newcolcount, "calculated", "calculated_columns", newcolcount);
		cloneData['Columns']["CALCULATED_COLUMN" + newcolcount] = "calculated";
		calccoln[newcolcount] = "CALCULATED_COLUMN" + newcolcount;

		/* add new row for a calculated column and include autocomplete*/
		$('#formatclone tr:last').after(newrow);
		$("#" + colId).autocomplete({
			source : function( request, response ) {
	          	var term = request.term;
	          	var url = "ajax/server_side/clone_get_data_server_processing.php?caller=" + current.id;
	          	$.getJSON( url, request, function( data, status, xhr ) {
                    if ("error" in data) {
                        swal({
                            title: "Error occurred",
                            text: data['message']
                        });
                        return;
                    }
	            	response( data );
	          	})
			},
			autoFocus: true,
			focus: function( event, ui ) { return false;},
			minLength: 0,
			select: function( event, ui ) {
				$(current).closest(".search-modal-name").removeClass('has-error');
				coln = (current.id).split("xyz123abc")[0];
				cloneData['Columns'][coln] = ui.item.label.split(" (")[0];
				$("#" + current.name).text(cloneData['Columns'][coln] + " (calculated)");
			},
			change: function( event, ui ) {
				if (ui.item == null) {
					$(current).value = "";
					$(current).closest(".search-modal-name").addClass('has-error');
				}
			}
		});

		$("#" + colId).focus(function() {
			current = this;
		});

		$("#" + colId).keydown(function(event) {
			event.preventDefault();
			if(event.keyCode == 8){
				$("#" + colId).val('');
			}
    	});
	}

	/* add metadata */
	function addMetadata() {
		//alert(count(cloneData['Extra Metadata']));
		var newrow = buildHTML("Enter Key", "Enter Value", "extra_metadata", newMeta);
		if (empty) {
			$('#metaclone tbody').append(newrow);
			empty = false;
		}
		else {
			$('#metaclone tr:last').after(newrow);
		}
		clonemetakey[newMeta] = "New key " + newMeta;
		clonemetadata[newMeta] = "New Value " + newMeta;
		newMeta =  newMeta + 1;
	}

	/* delete metadata */
	function removeMetadata() {
		var idx = event.target.id.split("_").pop();
		deletedrows.push(parseInt(idx));
		deletedrowskeys.push(clonemetakey[idx]);
		$("#row_" + idx).remove();

		if (deletedrowskeys.length == newMeta - 1) {
			empty = true;
		}
	}

	/* delete calculated column */
	function removeCalculatedColumn() {
		var idx = event.target.id.split("_").pop();
		delete cloneData['Columns'][calccoln[idx]];
		removedColn.push(calccoln[idx]);
		$("#calc_" + idx).remove();
	}

	function buildHTML(i, item, section, counter) {
		var html;
		switch (section) {
			case 'calculated_columns':
				html = "<tr id='calc_" + counter + "'><td id='calc_name_" + counter + "' class='search-modal-table'>" + i + " (" + item + ")</td>";
				html = html + "<td class='search-modal-name'><input type='text' class='form-control' name='calc_name_" + counter + "' id='" + i + "xyz123abc" + item + "' placeholder='" + i + "'></td>" +
				"<td><button id='delc_" + counter + "' type='button' class='close' aria-hidden='true' onclick='removeCalculatedColumn()'>&times;</button></td></tr>";
				break
			case 'columns':
				html = "<tr><td class='search-modal-table'>" + i + " (" + item + ")</td>";
				switch (i) {
					case 'CHROMOSOME':
						html = html + "<td colspan=2 class='search-modal-name'><input type='input' class='form-control' id='" + i + "xyz123abc" + item + "' placeholder='" + i + "' disabled></td></tr>"
						break;
					case 'START':
						html = html + "<td colspan=2 class='search-modal-name'><input type='input' class='form-control' id='" + i + "xyz123abc" + item + "' placeholder='" + i + "' disabled></td></tr>"
						break;
					case 'END':
						html = html + "<td colspan=2 class='search-modal-name'><input type='input' class='form-control' id='" + i + "xyz123abc" + item + "' placeholder='" + i + "' disabled></td></tr>"
						break;
					default:
						html = html + "<td colspan=2 class='search-modal-name'><input type='input' class='form-control' id='" + i + "xyz123abc" + item + "' placeholder='" + i + "'></td></tr>"
				}
				break;
			case 'extra_metadata':
				// check length and change to text area
				html = "<tr id='row_" + counter + "'><td class='search-modal-table'><input type='input' class='form-control' id='key_" + counter + "' placeholder='" + i + "' onblur='saveMetaData()'></td>";
				html = html + "<td class='search-modal-name'><input type='input' class='form-control' id='val_" + counter + "' placeholder='" + item +
				"' onchange='saveMetaData()'></td><td><button id='del_" + counter + "' type='button' class='close' aria-hidden='true' onclick='removeMetadata()'>&times;</button></td></tr>";
				break
			default:
				switch (i) {
					case 'id':
						html = "<tr><td class='search-modal-table'>ID</td>";
						html = html + "<td class='search-modal-name'><input type='input' class='form-control' id='" + i + "' placeholder='" + item + "' disabled></td></tr>";
						break;
					case 'experiment':
						html = "<tr><td class='search-modal-table'>Experiment Name</td>";
						html = html + "<td class='search-modal-name'><input type='input' class='form-control' id='" + i + "' placeholder='" + item + "'></td></tr>";
						break;
					case 'genome':
						html = "<tr><td class='search-modal-table'>Genome</td>";
						html = html + "<td class='search-modal-name'><input type='input' class='form-control' id='" + i + "' placeholder='" + item + "' disabled></td></tr>";
						break;
					case 'epigenetic_mark':
						html = "<tr><td class='search-modal-table'>Epigenetic Mark</td>";
						html = html + "<td class='search-modal-name'><input type='input' class='form-control' id='" + i + "' placeholder='" + item + "'></td></tr>";
						break;
					case 'sample':
						html = "<tr><td class='search-modal-table'>Sample</td>";
						html = html + "<td class='search-modal-name'><input type='input' class='form-control' id='" + i + "' placeholder='" + item + "'></td></tr>";
						break;
					case 'technique':
						html = "<tr><td class='search-modal-table'>Technique</td>";
						html = html + "<td class='search-modal-name'><input type='input' class='form-control' id='" + i + "' placeholder='" + item + "'></td></tr>";
						break;
					case 'project':
						html = "<tr><td class='search-modal-table'>Project</td>";
						html = html + "<td class='search-modal-name'><input type='input' class='form-control' id='" + i + "' placeholder='" + item + "'></td></tr>";
						break;
					case 'description':
						html = "<tr><td class='search-modal-table'>Description</td>";
						html = html + "<td class='search-modal-name'><textarea class='form-control' id='" + i + "' placeholder='" + item + "'></textarea></td></tr>";
						break;
					default:
				}
		}
		return html;
	}

	/* Hide and show experiment metadata */
	$(document).off("click", '.exp-metadata-more-view');
	$(document).on("click", '.exp-metadata-more-view', function () {
		//var metadata = $(this).prev();
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

    /* Download button :: Getting selected elements */
    $('#cloneBtnTop, #cloneBtnBottom').click(function(){

    	if(selectedElements.length == 0){
			alert("Please select experiments!");
		}
		else{

			// temp: use only the first experiment
			getId = selectedElements;
			if (selectedElements.length > 1) {
				batch = true;
			}
			clone = true;
			search_function();
			$('#myModal').modal('toggle');

		}
    });

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