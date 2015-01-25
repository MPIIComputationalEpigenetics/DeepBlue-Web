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
	<div class="col-sm-12">
		<div id="myTabContent1" class="tab-content bg-color-white padding-10">
			<div class="tab-pane fade in active" id="s1">
				<h1> Clone <span id="seach-type-title" class="semi-bold">Experiments</span></h1>
				<br>
				<div class="input-group input-group-lg hidden-mobile">
					<input id="clone_input" class="form-control input-lg" type="text" placeholder="Find Experiment to clone ..." />
					<div class="input-group-btn">
						<button type="button" id="clone_bt" class="btn btn-default">
							&nbsp;&nbsp;&nbsp;<i class="fa fa-recycle"></i>&nbsp;&nbsp;&nbsp;
						</button>
					</div>
				</div>
				<div id="tempSearchResult"></div>
				<div id="cloneButtonGroup" class="modal-footer" style="display:none;" >
					<button type="button" id="cloneExperimentButton" class="btn btn-primary download-btn-size">
						Clone
					</button>
					<button type="button" id="closeExperimentButton" class="btn btn-default">
						Close
					</button>
				</div>
			</div>
			<div class='clear'></div>
		</div>
	</div>
</div>

<script type="text/javascript">
	pageSetUp();

	// PAGE RELATED SCRIPTS
	// pagefunction
	var deletedrows = [];
	var clonemetadata = [];
	var clonemetakey = [];
	var clone = false;

	var pagefunction = function() {
		$("#clone_input").focus();
	};

	$("#clone_bt").button().click(search_function);
	var cache = {};
	$('#clone_input').autocomplete({
		source : function( request, response ) {
          var term = request.term;
          	if ( term in cache ) {
            	response( cache[ term ] );
            	return;
          	}
          	var url = "ajax/server_side/clone_get_data_server_processing.php?caller=experiment";
          	$.getJSON( url, request, function( data, status, xhr ) {
            	cache[ term ] = data;
            	response( data );
          	})
		},
		//appendTo : "#modal_for_experiment",
		autoFocus: true,
		focus: function( event, ui ) { return false;},
		minLength: 3,
		select: function( event, ui ) {
			// enable clone button
			exp = ui.item.label;
			expId = exp.split(' ')[1];
			getId = expId.substring(1, expId.length-1);
			clone = true;
		},
		change: function( event, ui ) {
			if (ui.item == null) {
				clone = false;
			}		
		}
	});
	
	function search_function() {		

		/* Checking search value is empty or not */
		$search = $('#clone_input').val();
		if($search == ''){
			$( "#tempSearchResult" ).empty();
			$( "#tempSearchResult" ).append( "<div class='search-results clearfix'><h2>Search text cannot be empty!</h2></div>");
			return;
		}

		/* Check if auto-complete suggestion is selected */	
		if(clone == false){
			$( "#tempSearchResult" ).empty();
			$( "#tempSearchResult" ).append( "<div class='search-results clearfix'><h2>Experiment does not exist. Select from the suggested experiments.</h2></div>");
			return;
		}

		var cloneInfoRequest = $.ajax({
			url: "ajax/server_side/clone_get_info_server_processing.php",
			dataType: "json",
			data : {
				getId : getId
			}
		});

		cloneInfoRequest.done( function(data) {
			$( "#tempSearchResult" ).empty();
			var tableHTML = '<br/><h4>Experiment Info</h4><hr/>'
			var columns = [];
			tableHTML = tableHTML + "<table id='infoclone' class='table table-striped table-hover'><tbody>";
			cloneData = data.data['info'];
			var colTemp = {};
			$.each(data.data['info'], function(i, item) {
				if (i == 'Columns') {
					sect = 'columns';
					tableHTML = tableHTML + "</tbody></table>";
					columnsTableHTML = '<h4>Columns</h4><hr/>';
					columnsTableHTML = columnsTableHTML + "<table id='formatclone' class='table table-striped table-hover'><tbody>";
					for (j in item) {
						colTemp[item[j]['name']] = item[j]['name'];
						columns[j] = item[j]['name'] + '44' + item[j]['column_type'];
						columnsTableHTML = columnsTableHTML + buildHTML(item[j]['name'], item[j]['column_type'], sect, 0);
					}
				}
				else if (i == 'Extra Metadata') {
					sect = 'extra_metadata';
					columnsTableHTML = columnsTableHTML + "</tbody></table>";
					metadataHTML = '<h4>Extra Metadata</h4><hr/>';
					metadataHTML = metadataHTML + "<table id='metaclone' class='table table-striped table-hover'><tbody>";
					var key, value;
					var j = 1;
					for (key in item) {
						metadataHTML = metadataHTML + buildHTML(key, item[key], sect, j);
						clonemetakey[j] = key;
						clonemetadata[j] = item[key];
						j = j + 1;
					}
					// one more time
					newMeta = j;
					metadataHTML = metadataHTML + "</tbody></table>" + "<button type='button' id='addmetabutton' class='btn btn-success pull-right' onclick='addMetadata()'>New</button><br/><br/><br/>"					
				}
				else {
					sect = 'info';
					tableHTML = tableHTML + buildHTML(i, item, sect, 0);
				}
			});

			cloneData['Columns'] = colTemp;
			cloneData['sample'] = cloneData['sample'].split(' ')[0];

			$( "#tempSearchResult" ).append(tableHTML + columnsTableHTML + metadataHTML);
			//$('.modal-title').text("Clone Experiment");
			//$('.modal-content').addClass( "modalViewSingleInfo" );
			$("#cloneButtonGroup").show();
			
			var vocabs = ['sample','epigenetic_mark','technique','project'] 
			var tags = vocabs.concat(columns);
			var current;
			var cache = {};
			for (i in tags) {
				tag = tags[i];
				cache[tag] = {};
				$("#" + tag).autocomplete({
					source : function( request, response ) {
			          var term = request.term;
			          	if ( term in cache[current.id] ) {
			            	response( cache[current.id][ term ] );
			            	return;
			          	}
			          	var url = "ajax/server_side/clone_get_data_server_processing.php?caller=" + current.id;
			          	$.getJSON( url, request, function( data, status, xhr ) {
			            	cache[current.id][ term ] = data;
			            	response( data );
			          	})
					},
					appendTo : "#modal_for_experiment",
					autoFocus: true,
					focus: function( event, ui ) { return false;},
					minLength: 0,
					select: function( event, ui ) {
						$(current).closest(".search-modal-name").removeClass('has-error');
						if ($.inArray(current.id, columns) > -1) {
							coln = (current.id).split("44")[0];
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
				var tempMeta = {};
				for (j = 1; j < newMeta; j++) {
					if (deletedrows.indexOf(j) == -1) {
						tempMeta[clonemetakey[j]] = clonemetadata[j];
					}
				}
				cloneData['Extra Metadata'] = tempMeta;
				
				var request = $.ajax({
					url: "ajax/server_side/clone_data_server_processing.php",
					dataType: "json",
					data : {
						data : cloneData
					}
				});

				request.done( function(data) {
					if (data[0][0] == 'okay') {
						alert("Cloning Successful: " + data[0][1]);
					}
					else {
						alert("Cloning Failed: " + data[0][1]);
					}					
				});

				request.fail( function(jqXHR, textStatus) {
					console.log(jqXHR);
		       		console.log('Error: '+ textStatus);
					alert( "error" );
				});
			});
		});

		cloneInfoRequest.fail( function(jqXHR, textStatus) {
			console.log(jqXHR);
     	 	console.log('Error: '+ textStatus);
			alert( "Error in experiment modal view" );
		});

		$('#closeExperimentButton').unbind('click').bind('click', function (e) {
			$( "#tempSearchResult" ).empty();
			$("#cloneButtonGroup").hide();		
		});			

	}; // end search function

	/* save key or value of the metadata */
	function saveMetaData() {
		var id = event.target.id.split('_');
		var type = id[0];
		var idx = id[1];

		if (type == 'val') {
			clonemetadata[idx] = event.target.value;
		//	alert(clonemetadata);
		}
		else {
			clonemetakey[idx] = event.target.value;
	//		alert(clonemetakey);	
		}
	}

	/* add metadata */
	function addMetadata() {
		//alert(count(cloneData['Extra Metadata']));
		//alert(cursize);
		var newrow = buildHTML("Enter Key", "Enter Value", "extra_metadata", newMeta);
		$('#metaclone tr:last').after(newrow);
		clonemetakey[newMeta] = "New key " + newMeta;
		clonemetadata[newMeta] = "New Value " + newMeta;
		newMeta =  newMeta + 1;
	}
	
	/* delete metadata */
	function removeMetadata() {
		var idx = event.target.id.split("_").pop();
		deletedrows.push(parseInt(idx));
		//alert(deletedrows);
		$("#row_" + idx).remove();
	}
		
	function buildHTML(i, item, section, counter) {
		var html;
		switch (section) {
			case 'columns':
				html = "<tr><td class='search-modal-table'>" + i + " (" + item + ")</td>";	
				switch (i) {
					case 'CHROMOSOME': 
						html = html + "<td class='search-modal-name'><input type='input' class='form-control' id='" + i + "44" + item + "' placeholder='" + i + "' disabled></td></tr>"
						break;
					case 'START':
						html = html + "<td class='search-modal-name'><input type='input' class='form-control' id='" + i + "44" + item + "' placeholder='" + i + "' disabled></td></tr>"
						break;
					case 'END':
						html = html + "<td class='search-modal-name'><input type='input' class='form-control' id='" + i + "44" + item + "' placeholder='" + i + "' disabled></td></tr>"
						break;
					default:
						html = html + "<td class='search-modal-name'><input type='input' class='form-control' id='" + i + "44" + item + "' placeholder='" + i + "'></td></tr>"
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
</script>
