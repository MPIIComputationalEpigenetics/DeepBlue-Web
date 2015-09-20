<?php

/**
*   DeepBlue Epigenomic Data Server
*   Copyright (c) 2015 Max Planck Institute for Computer Science.
*   All rights reserved.
*
*   Authors :
*
*   Felipe Albrecht <felipe.albrecht@mpi-inf.mpg.de>
*   Obaro Odiete <s8obodie@stud.uni-saarland.de>
*
*   Created : 09-09-2015
*
*   ================================================
*
*   File : deepblue_create_column_type.php
*
*/

/* DeepBlue Configuration */
require_once("inc/init.php");
?>

<div class="row">
	<div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
		<h1 class="page-title txt-color-blueDark"><i class="fa fa-columns"></i>
			 Create Column Type
		</h1>
	</div>
</div>

<section>
	<!-- row -->
	<div class="row">
		<!-- NEW WIDGET START -->
		<article class="col-sm-12 col-md-12 col-lg-12">
			<!-- Widget ID (each widget will need unique ID)-->
			<div class="jarviswidget jarviswidget-color-blue" id="tree-biosources" data-widget-editbutton="true">
				<header>
					<span class="widget-icon"> <i class="fa fa-columns"></i> </span>
					<h2>Column Types</h2>
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
									<h4 class="alert-heading">Options</h4>
									<p> Enter the annotation information. For the format, use the dropdown to include a format, and X to remove it.</p>
                                    <p> If column type is category, in the items field, enter a comma seperated list of items in the category.</p>
								</div>
								<div id="generalDiv">
									<table id='general' class='table table-striped table-hover'>
										<tbody>
											<tr>
												<td class='search-modal-table'>Type</td>
												<td class='search-modal-name'><input type='input' class='form-control' id='type' placeholder='Type'></td>
											</tr>                                            
											<tr>
												<td class='search-modal-table'>Name</td>
												<td class='search-modal-name'><input type='input' class='form-control' id='name' placeholder='Name'></td>
											</tr>
											<tr>
												<td class='search-modal-table'>Description</td>
												<td class='search-modal-name'><textarea class='form-control' id='desc' placeholder='Enter a description of the column type'></textarea></td>
											</tr>
                                        </tbody>
                                    </table>
                                    <table id='additional' class='table table-striped table-hover'>
                                        <tbody>
                                            <tr id='itemRow' hidden="hidden">
												<td class='search-modal-table'>Items</td>
                                                <td class='search-modal-name'><input type='input' class='form-control' id='item' placeholder='Item1, Item2, Item3, . . . , ItemN'></td>
											</tr>
                                            <tr id='codeRow' hidden="hidden">
												<td class='search-modal-table'>Code</td>
												<td class='search-modal-name'><input type='input' class='form-control' id='code' placeholder='code'></td>
											</tr>
                                            <tr id='minRow' hidden="hidden">
												<td class='search-modal-table'>Minimum</td>
												<td class='search-modal-name'><input type='input' class='form-control' id='min' placeholder='Enter integer minimum'></td>
											</tr>
                                            <tr id='maxRow' hidden="hidden">
												<td class='search-modal-table'>Maximum</td>
												<td class='search-modal-name'><input type='input' class='form-control' id='max' placeholder='Enter integer maximum'></td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
						</div>
						<div id="columnButtonGroup" class="modal-footer" >
							<button type="button" id="cancelCreateColumn" class="btn btn-default">
								Cancel
							</button>
							<button type="button" id="createColumnButton" class="btn btn-primary download-btn-size">
								Create
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


<script type="text/javascript">
	pageSetUp();

    // setup column type autocomplete
    var suggestions = ['Integer','Double','String','Range','Category', 'Calculated'];
    $('#type').autocomplete({
        source : suggestions,
        autoFocus: true,
        focus: function( event, ui ) { return false;},
        minLength: 0,
        select: function( event, ui ) {
            $(event.target).closest(".search-modal-name").removeClass('has-error');
            // call a function to unhide the other options based on the selection
            unhideOptions(ui.item.label);
        },
        change: function( event, ui ) {
            if (ui.item == null && event.target.value != "") {
                $(event.target).closest(".search-modal-name").addClass('has-error');
            }
            if (event.target.value == "") {
                $(event.target).closest(".search-modal-name").removeClass('has-error');
            }
        }
    });

    function unhideOptions(type) {
        hideOptions();
        switch (type) {
            case 'Range':
                $("#minRow").show();
                $("#maxRow").show();                
                break;
            case 'Category':
                $("#itemRow").show();
                break
            case 'Calculated':
                $("#codeRow").show();
                break
        }
    }
    
    // Add annotation Button
	$('#createColumnButton').bind('click', function (e) {
		var valid = true;
        
        // read all the information
		var column = [];        
		column['name'] = $("#name").val();
		column['type'] = $("#type").val();
		column['item'] = $('#item').val();
		column['desc'] = $("#desc").val();
		column['min'] = $("#min").val();
		column['max'] = $("#max").val();
		column['code'] = $("#code").val();
        
		// check for required missing entries and  add error to input
		if (column['name'] == "") {
			$('#name').closest(".search-modal-name").addClass('has-error');
			$('#name').focus();
		}
		else {
			$('#name').closest(".search-modal-name").removeClass('has-error');
		}

		if (column['type'] == "") {
			$('#type').closest(".search-modal-name").addClass('has-error');
			$('#type').focus();
		}
		else {
			$('#type').closest(".search-modal-name").removeClass('has-error');
            
            switch (column['type']) {
                case 'Range':
                    if (column['min'] == "") {
                        $('#min').closest(".search-modal-name").addClass('has-error');
                        $('#min').focus();
                    }
                    else {
                        $('#min').closest(".search-modal-name").removeClass('has-error');
                    }
                    
                    if (column['max'] == "") {
                        $('#max').closest(".search-modal-name").addClass('has-error');
                        $('#max').focus();
                    }
                    else {
                        $('#max').closest(".search-modal-name").removeClass('has-error');
                    }                
                    break;
                case 'Category':
                    if (column['item'] == "") {
                        $('#item').closest(".search-modal-name").addClass('has-error');
                        $('#item').focus();
                    }
                    else {
                        $('#item').closest(".search-modal-name").removeClass('has-error');
                    }
                    break;
                case 'Calculated':
                    if (column['code'] == "") {
                        $('#code').closest(".search-modal-name").addClass('has-error');
                        $('#code').focus();
                    }
                    else {
                        $('#code').closest(".search-modal-name").removeClass('has-error');
                    }
                    break;
            }
        }
        
		// check for error bars around input
		var entries = ['#name','#type','#desc', '#min', 'max', '#code','#item'];
		for (i in entries) {
			var entry = entries[i];
			if ($(entry).closest(".search-modal-name").hasClass('has-error')) {
				valid = false;
				break;
			}
		}

		if (valid) {
			// disable button
			$('#createColumnButton').attr('disabled','disabled');

			// make ajax call with input
			var request = $.ajax({
				url: "ajax/server_side/create_column_type_server_processing.php",
				dataType: "json",
				data : {
					name : column['name'],
					type : column['type'],
					description : column['desc'],
					category : column['item'],
					min : column['min'],
					max : column['max'],
                    code : column['code']
				}
			});

			request.done( function(data) {
				var title = "";
				if (data.data[0] == 'okay') {
					title = "Create column '" + column['name'] + "' successful";
                    clearInputs();
                    hideOptions();
                }
				else {
					title = "Create column '" + column['name'] + "' failed";
				}
				$('#createColumnButton').removeAttr('disabled');
				swal({
                    title: title,
                    text: data.data[1]
                });
			});

			request.fail( function(jqXHR, textStatus) {
				$('#createColumnButton').removeAttr('disabled');
				console.log(jqXHR);
		   		console.log('Error: '+ textStatus);
				alert( "error" );
			});
		}
	});

	// bind cancel annotation button
	$('#cancelCreateColumn').bind('click', function (e) {
		hideOptions();
        clearInputs();
	});

    // hide the additional options rows
    function hideOptions() {
        $("#minRow").hide();
        $("#maxRow").hide();
        $("#itemRow").hide();
        $("#codeRow").hide();     
    }
    
	// clear input entries
	function clearInputs() {
		column = [];		

		$("#name").val("");
		$("#desc").val("");
        $("#type").val("");
		$("#code").val("");
		$("#item").val("");
        $("#max").val("");
        $("#min").val("");        
		// clear variables
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