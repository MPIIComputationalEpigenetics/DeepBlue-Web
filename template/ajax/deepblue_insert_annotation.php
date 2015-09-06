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
*   Created : 05-08-2014
*
*   ================================================
*
*   File : deepblue_insert_annotation.php
*
*/

/* DeepBlue Configuration */
require_once("inc/init.php");
?>

<style>
	.ui-autocomplete {
		max-height : 200px;
		overflow-x: hidden;
		overflow-y: auto;
	}
</style>

<div class="row">
	<div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
		<h1 class="page-title txt-color-blueDark"><i class="fa fa-copy"></i>
			Insert Annotation
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
					<span class="widget-icon"> <i class="fa fa-copy"></i> </span>
					<h2>Annotation</h2>
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
									<p> Enter the annotation information. For the format, use the dropdown to include a format, and X to remove it.</p>
								</div>
								<div id="infoResult">
									<table id='info' class='table table-striped table-hover'>
										<tbody>
											<tr>
												<td class='search-modal-table'>Name</td>
												<td class='search-modal-name'><input type='input' class='form-control' id='name' placeholder='Name'></td>
											</tr>
											<tr>
												<td class='search-modal-table'>Genome</td>
												<td class='search-modal-name'><input type='input' class='form-control' id='genome' placeholder='Genome'></td>
											</tr>
											<tr>
												<td class='search-modal-table'>Description</td>
												<td class='search-modal-name'><textarea class='form-control' id='desc' placeholder='Enter Description of the Annotation'></textarea></td>
											</tr>
											<tr>
												<td class='search-modal-table'>Format</td>
												<td class='search-modal-name'><select id="format" multiple style="width:100%" class="select2"></select></td>
											</tr>											
										</tbody>
									</table>
								</div>
							</div>
						</div>
						<hr>
						<div class="row">
							<div class="col-md-12 col-md-offset-0">
								<div id="dataDesc" class="alert alert-info alert-block">
									<a class="close" data-dismiss="alert" href="#">×</a>
									<h4 class="alert-heading">Data</h4>
									<p>The data must be in the BED format. The BED format uses tabs as field separators. For upload, the file must be a text file - '.txt' extension</p>
								</div>
								<div id="uploadData">
									<table id='info' class='table table-striped table-hover'>
										<tbody>
											<tr>
												<td class='search-modal-table'>Insert data</td>
												<td class='search-modal-name'>
													<label>
														<input type="radio" name="optionsRadios" id="file_ckb" value="file" checked onChange="toggle_upload()">  Upload File
													</label>
													<br>
													<label>
														<input type="radio" name="optionsRadios" id="copypaste_ckb" value="copy" onChange="toggle_upload()">  Copy and Paste
													</label>
												</td>
											</tr>
											<tr id='file_row'>
												<td class='search-modal-table'>Upload File</td>
												<td class='search-modal-name'>
														<input type='file' class='form-control' id='file' name='data_file'><br/>
														<button type="submit" id="uploadButton" class="btn btn-success download-btn-size" disabled> Upload </button>
														<span id='data_err'> </span>
												</td>
											</tr>
											<tr id='copy_row' style="display: none">
												<td class='search-modal-table'>Copy and Paste</td>
												<td class='search-modal-name'><textarea class='form-control' id='copy' placeholder='Copy and Paste Data into Field' rows="10"></textarea></td>
											</tr>                        
										</tbody>
	                                </table>
								</div>
							</div>
						</div>
						<hr>
						<div class="row">
							<div class="col-md-12 col-md-offset-0">
								<div id="metadataDesc" class="alert alert-info alert-block">
									<a class="close" data-dismiss="alert" href="#">×</a>
									<h4 class="alert-heading">Extra Metadata Table</h4>
									<p>Click button to add metadata. Click the 'x' on the row to remove the metadata. </p>									
								</div>
								<div id="metadataResult">
									<table id='metatable' class='table table-striped table-hover'>
										<tbody>							
										</tbody>
									</table>
									<button type='button' id='addmetabutton' class='btn btn-success' onclick='addMetadata()'>Add Metadata</button>
									<br/><br/><br/>									
								</div>
							</div>
						</div>
						<div id="annotationButtonGroup" class="modal-footer" >
							<button type="button" id="cancelAnnotationButton" class="btn btn-default">
								Cancel
							</button>
							<button type="button" id="addAnnotationButton" class="btn btn-primary download-btn-size" disabled>
								Save
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

	var sel = 'file'; //default upload option
	var annotation_data = ""; //initialize annotation_data
	var deletedrows = []; // removed metadata
	var deletedrowskeys = []; // removed metadata keys
	var metadata_val = []; // store new metadata val
	var metadata_key = [];	// store new metadata key
	var newMeta = 0; // initialize value for the number of existing metadata
	var empty = true; // to show the metadata table is empty

	/* Genome Autocomplete */
    /* retrieve deepblue list_in_use data */
    var vocabulary = ["projects","epigenetic_marks", "biosources", "techniques", "genomes"];
    var list_in_use = JSON.parse(localStorage.getItem('list_in_use'));
    if (list_in_use == null) {
        var request1 = $.ajax({
            url: "ajax/server_side/list_in_use.php",
            dataType: "json",
            data : {
                request : vocabulary
            }
        });
        request1.done( function(data) {
            if (data[0] == "error") {
                var report = "An error has occured listing experiments: " + data[1];
                swal({
                    title: "Insert Annotation",
                    text: report
                });                                    
                return;            
            }

            // store data in local storage
            localStorage.setItem("list_in_use", JSON.stringify(data[0]));
            list_in_use = JSON.parse(localStorage.getItem('list_in_use'));
            
            genomeInput();
        });
        request1.fail( function(jqXHR, textStatus) {
            console.log(jqXHR);
            console.log('Error: '+ textStatus);
            alert( "Encountered an error. Please wait a few seconds and reload page. If problem persist, kindly log a complaint" );
        });
    }
    else {
        genomeInput();
    }

    function genomeInput() {
        var suggestion = [];
        suggestion['genomes'] = [];

        var count = 0;
        var currentvocab = list_in_use['genomes']['alp'];
        for (j in currentvocab) {
            suggestion['genomes'][count] = {'label' : currentvocab[j][1] + " (" + currentvocab[j][0] + ")", 'value' : currentvocab[j][1]};
            count = count + 1;
        }

        $('#genome').autocomplete({
            source : suggestion['genomes'],
            autoFocus: true,
            focus: function( event, ui ) { return false;},
            minLength: 0,
            select: function( event, ui ) {
                $(event.target).closest(".search-modal-name").removeClass('has-error');
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
    }

	// upload annotation data button
    $('#uploadButton').bind('click', function (e) {
    	var sel_file = $("#file").val();
    	if (sel_file == '') {
    		$("#data_err").text("No file selected");
    	}
    	else {
    		var file_data = $("#file").prop("files")[0];
    		var form_data = new FormData();
    		form_data.append('file', file_data);

		    var request = $.ajax({
		        url: "ajax/server_side/upload_file.php",
		        data: form_data,
		        dataType: "json",
        		type: "POST",
				cache: false,
				contentType: false,
				processData: false      		
		    });
		    request.done( function(data) {
		    	if (data.data[0] == "okay") {
		    		annotation_data = data.data[1];	
		    		$("#data_err").text('Successful');
		    	}
		    	else {
		    		$("#data_err").text(data.data[1]);
		    	}		    	
		    });
		    request.fail( function(jqXHR, textStatus) {
		        console.log(jqXHR);
		        console.log('Error: '+ textStatus);
		        alert( "error1" );
		    });		
    	}
    });

    /* Pull Format Data */
    var request = $.ajax({
        url: "ajax/server_side/list_all_columns.php",
        dataType: "json"
    });

    request.done( function(data) {
        if (data[0] == "error") {
            var report = "An error has occured: " + data[1];
            swal({
                title: "Insert Annotation",
                text: report
            });                                    
            return;            
        }
        
        for (i=0; i<data.length; i++) {
            var key = data[i];
            var value = data[i];
            $('#format')
                .append($("<option></option>")
                .attr("value", key)
                .text(value));
        }
	    var important = ['CHROMOSOME', 'START', 'END'];
	    $('#format').select2("val", important);
	    $('#uploadButton').removeAttr('disabled');
	    $('#addAnnotationButton').removeAttr('disabled');
    });

    request.fail( function(jqXHR, textStatus) {
        console.log(jqXHR);
        console.log('Error: '+ textStatus);
        alert( "error1" );
    });

	
	// Add annotation Button
	$('#addAnnotationButton').bind('click', function (e) {

		var valid = true;

		// read all the information
		var annotation = [];
		annotation['name'] = $("#name").val();
		annotation['genome'] = $("#genome").val();
		annotation['format'] = $('#format').select2("val").join();
		annotation['desc'] = $("#desc").val();
		
		if (sel == 'copy') {
			annotation['data'] = $('#copy').val();
		}
		else {
			annotation['data'] = annotation_data;			
		}

		var tempMeta = {};
		for (j = 1; j <= newMeta; j++) {
			if (deletedrows.indexOf(j) == -1) {
				tempMeta[metadata_key[j]] = metadata_val[j];
			}
		}
		annotation['metadata'] = tempMeta;

		// check for required missing entries and  add error to input
		// annotation's name
		if (annotation['name'] == "") {
			$('#name').closest(".search-modal-name").addClass('has-error');
			$('#name').focus();
		}
		else {
			$('#name').closest(".search-modal-name").removeClass('has-error');
		}

		if (annotation['genome'] == "") {
			$('#genome').closest(".search-modal-name").addClass('has-error');
			$('#genome').focus();
		}
		else {
			$('#genome').closest(".search-modal-name").removeClass('has-error');
		}
		

		// confirm that the important format is included
		// annotation's format
		var important = ['CHROMOSOME', 'START', 'END'];
		var annotation_arr = $('#format').select2("val");
		var missing = [];
		for (i=0; i<important.length; i++) {
			if (annotation_arr.indexOf(important[i]) < 0) {
				missing.push(important[i]);
			}
		}
		if (missing.length > 0) {
			$('#format').closest(".search-modal-name").addClass('has-error');
			$('#format').focus();
			alert("Missing the following important columns: " + missing.join());
		}
		else {
			$('#format').closest(".search-modal-name").removeClass('has-error');
		}

		// annotation's data
		if (annotation['data'] == "") {
			$('#'+sel).closest(".search-modal-name").addClass('has-error');
			$('#'+sel).focus();
		}
		else {
			$('#'+sel).closest(".search-modal-name").removeClass('has-error');
		}

		// add error bars around faulty input
		var entries = ['#name','#genome','#desc', '#format', '#'+sel];
		for (i in entries) {
			var entry = entries[i];
			if ($(entry).closest(".search-modal-name").hasClass('has-error')) {
				valid = false;
				break;
			}
		}

		if (valid) {
			// disable button
			$('#addAnnotationButton').attr('disabled','disabled');

			// make ajax call with input
			var request = $.ajax({
				url: "ajax/server_side/add_annotation_server_processing.php",
				dataType: "json",
				data : {
					name : annotation['name'],
					genome : annotation['genome'],
					description : annotation['desc'],
					format : annotation['format'],
					data : annotation['data'],
					metadata : annotation['metadata']
				}
			});

			request.done( function(data) {
				var report = "";
				if (data.data[0] == 'okay') {
					var id = data.data[1];
					report = report + "Insert annotation '" + annotation['name'] + "' successful: " + id + "\n";
				}
				else {
					var msg = data.data[1];
					report = report + "Insert annotation '" + annotation['name'] + "' failed: " + msg + "\n";					
				}
				$('#addAnnotationButton').removeAttr('disabled');
				clear_input();
				swal({
                    title: "Insert Annotation",
                    text: report
                });
			});

			request.fail( function(jqXHR, textStatus) {
				$('#addAnnotationButton').removeAttr('disabled');
				console.log(jqXHR);
		   		console.log('Error: '+ textStatus);
				alert( "error" );
			});
		}
	});

	// bind cancel annotation button
	$('#cancelAnnotationButton').bind('click', function (e) {
		clear_input();
	});

	// clear input entries
	function clear_input() {
		annotation = [];		

		$("#name").val("");
		$("#genome").val("");
		$("#desc").val("");
		$("#copy").val("");
		$("#file").val("");
		$("#data_err").text("");

		var important = ['CHROMOSOME', 'START', 'END'];
		$('#format').select2("val", important);

		// clear variables
		annotation_data = ""; deletedrows = [];	deletedrowskeys = []; metadata_val = []; metadata_key = [];	newMeta = 0;
		empty = true;

		// clear metadata table
		$('#metatable tbody').empty();
	}

	// function to toggle between the methods for uploading the annotation data
	function toggle_upload() {		
		sel = $("input[name=optionsRadios]:checked").val();
		if (sel == 'copy') {
			$("#file_row").hide();
			$("#copy_row").show();
		}
		else {
			$("#copy_row").hide();
			$("#file_row").show();			
		}
	}

	/* build html table row for metadata */
	function buildHTML(i, item, counter) {
		var html;
		html = "<tr id='row_" + counter + "'><td class='search-modal-table'><input type='input' class='form-control' id='key_" + counter + "' placeholder='" + i + "' onblur='saveMetaData()'></td>";
		html = html + "<td class='search-modal-name'><input type='input' class='form-control' id='val_" + counter + "' placeholder='" + item +
				"' onchange='saveMetaData()'></td><td><button id='del_" + counter + "' type='button' class='close' aria-hidden='true' onclick='removeMetadata()'>&times;</button></td></tr>";

		return html;
	}

	/* save key or value of the metadata */
	function saveMetaData() {
		var id = event.target.id.split('_');
		var type = id[0];
		var idx = id[1];

		if (type == 'val') {
			metadata_val[idx] = event.target.value;
		}
		else {
			deletedrowskeys.push(metadata_key[idx]);
			metadata_key[idx] = event.target.value;
		}
	}

	/* add metadata */
	function addMetadata() {
		
		newMeta =  newMeta + 1;
		var newrow = buildHTML("Enter Key", "Enter Value", newMeta);
		if (empty) {
			$('#metatable tbody').append(newrow);
			empty = false;
		}
		else {
			$('#metatable tr:last').after(newrow);
		}
		metadata_key[newMeta] = "New key " + newMeta;
		metadata_val[newMeta] = "New Value " + newMeta;
		
	}

	/* delete metadata */
	function removeMetadata() {
		var idx = event.target.id.split("_").pop();
		deletedrows.push(parseInt(idx));
		deletedrowskeys.push(metadata_key[idx]);
		$("#row_" + idx).remove();

		if (deletedrowskeys.length == newMeta) {
			empty = true;			
		}
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