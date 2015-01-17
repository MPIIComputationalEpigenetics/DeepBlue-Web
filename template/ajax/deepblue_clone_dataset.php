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
					<input id="search_input" class="form-control input-lg" type="text" placeholder="Find Experiment to clone ..." />
					<div class="input-group-btn">
						<button type="button" id="search_bt" class="btn btn-default">
							&nbsp;&nbsp;&nbsp;<i class="fa fa-fw fa-search fa-lg"></i>&nbsp;&nbsp;&nbsp;
						</button>
					</div>
				</div>
				<div id="tempSearchResult"></div>
			</div>
			<div class='clear'></div>
		</div>
	</div>
</div>

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
			<div id='modal_for_experiment' style="display:none;"></div>
			<div class="modal-footer">
				<button type="button" id="cloneExperimentButton" class="btn btn-primary download-btn-size">
					Clone
				</button>
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

	// function to implement search
	function search_function() {
		$search = $('#search_input').val();

		/* Checking search value is empty or not */
		if($search == ''){
			$( "#tempSearchResult" ).empty();
			$( "#tempSearchResult" ).append( "<div class='search-results clearfix'><h2>Search text cannot be empty!</h2></div>");
			return;
		}

		$type = "Experiments";
		var request = $.ajax({
			url: "ajax/server_side/search_server_processing.php",
			dataType: "json",
			data : {
				text : $search,
				types : $type
			}
		});

		request.done( function(data) {
			$( "#tempSearchResult" ).empty();
			if(data.data == ''){
				$( "#tempSearchResult" ).append( "<div class='search-results clearfix'><h2>Your search - "+$search+" - did not match any documents.</h2><ul><li>Make sure all words are spelled correctly.</li><li>Try different keywords.</li><li>Try more general keywords.</li><li>Try fewer keywords.</li></ul></div>");
			}
			else{
				$.each(data.data, function(i, item) {
				    $( "#tempSearchResult" ).append( "<div class='search-results clearfix'>"+
				    	"<h4><span class='seach-result-title'><i class='fa fa-star txt-color-yellow'></i> <b>"+item[0]+ "</b> - <span data-toggle='modal' data-target='#myModal' class='"+item[4]+"'>" + item[1]+ "</span></span></h4>"+
				    "<div><p class='note'><span><i class='fa fa-circle txt-color-black'></i> " + item[4] +" "+ item[5] +" "+ item[6] +" "+ item[7] +" "+ item[8] +" "+ item[9] + "</span></p>"+
				    "<p class='description marginTop'>" + item[2] +"</p></div>"+
				    "<div class='searchMetadata'>"+item[3]+"</div></div>" );
			    });
			}

			/* Make metadata short with MORE button */
			$('.searchMetadata').more({
				length: 160,
				moreText: 'More', // Display text for more link
				lessText: 'Hide', // Display text for less link
			});
			
		});

		request.fail( function(jqXHR, textStatus) {
			console.log(jqXHR);
      console.log('Error: '+ textStatus);
			alert( "error" );
		});
	}; // end search function

	$("#search_bt").button().click(search_function);

	<?php
		if (isset($_GET["search"])) {
	 		$search = $_GET["search"];
			echo("$('#search_input').val('$search');");
			echo("search_function()");
		}	
	?>

	/* Trigger searching with pressing ENTER Key */
	$("#search_input").keyup(function(event){
		if(event.keyCode == 13){
		    search_function();
		}
	});

  function buildColumnsTableHTML(name, type) {
		var html = "<tr><td class='search-modal-table'>" + name + "</td><td>" + type + "</td>";		
		switch (name) {
			case 'CHROMOSOME':
				html = html + "<td id=" + name + "class='search-modal-id'>" + name + "</td></tr>"
				break;
			case 'START':
				html = html + "<td id=" + name + "class='search-modal-id'>" + name + "</td></tr>"
				break;
			case 'END':
				html = html + "<td id=" + name + "class='search-modal-id'>" + name + "</td></tr>"
				break;
			default:
				html = html + "<td><select class='form-control' id='" + name + "' name='" + name + "'><option value=''>Unchanged</option></select></td></tr>"
		}
		return html;
	}

	// table contruction for display of the information
  function buildTableHTML(i, item) {
		var html = "<tr><td class='search-modal-table'>" + i + ":</td>";		
		switch (i) {
			case 'ID':
				html = html + "<td class='search-modal-name'><input type='input' class='form-control' id='" + i + "' placeholder='" + item + "' disabled></td></tr>"
				break;
			case 'Experiment Name':
				html = html + "<td class='search-modal-name'><input type='input' class='form-control' id='" + i + "' placeholder='" + item + "'></td></tr>"
				break;
			case 'Description':
				html = html + "<td class='search-modal-name'><input type='input' class='form-control' id='" + i + "' placeholder='" + item + "'></td></tr>"
		    break;
			default:
				html = html + "<td class='search-modal-name'><input type='input' class='form-control' id='" + i + "' placeholder='" + item + "'></td></tr>"
		}
		return html;
	}

	function buildHTML(i, item, section) {
		var html;
		switch (section) {
			case 'columns':
				html = "<tr><td class='search-modal-table'>" + i + " (" + item + ")</td>";	
				switch (i) {
					case 'CHROMOSOME':
						html = html + "<td class='search-modal-name'><input type='input' class='form-control' id='" + i + "' placeholder='" + i + "' disabled></td></tr>"
						break;
					case 'START':
						html = html + "<td class='search-modal-name'><input type='input' class='form-control' id='" + i + "' placeholder='" + i + "' disabled></td></tr>"
						break;
					case 'END':
						html = html + "<td class='search-modal-name'><input type='input' class='form-control' id='" + i + "' placeholder='" + i + "' disabled></td></tr>"
						break;
					default:
						html = html + "<td class='search-modal-name'><input type='input' class='form-control' id='" + i + "' placeholder='" + i + "'></td></tr>"
				}
				break;
			case 'extra_metadata':
				// check length and change to text area
				html = "<tr><td class='search-modal-table'><input type='input' class='form-control' id='" + i + "_label' placeholder='" + i + "'></td>";
				html = html + "<td class='search-modal-name'><input type='input' class='form-control' id='" + i + "' placeholder='" + item + 
				"'></td><td><button type='button' class='close' aria-hidden='true'>&times;</button></td></tr>";
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
	
	/* Search result :: Displaying modal view after clicking the title */
	$(document).off("click",'.seach-result-title span');
	$(document).on("click", '.seach-result-title span', function () {
		$('#search_input').val($search);
		var type = this.className;
		var getId = $(this).prev().text();

		var cloneInfoRequest = $.ajax({
			url: "ajax/server_side/clone_get_info_server_processing.php",
			dataType: "json",
			data : {
				getId : getId
			}
		});

		cloneInfoRequest.done( function(data) {
			$('#modal_for_experiment').empty();
			var tableHTML = '<h4>Experiment Info</h4><hr/>'
			tableHTML = tableHTML + "<table class='table table-striped table-hover'><tbody>";
			$.each(data.data['info'], function(i, item) {
				if (i == 'Columns') {
					sect = 'columns';
					tableHTML = tableHTML + "</tbody></table>";
					columnsTableHTML = '<h4>Columns</h4><hr/>';
					columnsTableHTML = columnsTableHTML + "<table class='table table-striped table-hover'><tbody>";
					for (j in item) {
						columnsTableHTML = columnsTableHTML + buildHTML(item[j]['name'], item[j]['column_type'], sect);
					}
				}
				else if (i == 'Extra Metadata') {
					sect = 'extra_metadata';
					columnsTableHTML = columnsTableHTML + "</tbody></table>";
					metadataHTML = '<h4>Extra Metadata</h4><hr/>';
					metadataHTML = metadataHTML + "<table class='table table-striped table-hover'><tbody>";
					var key, value;
					for (key in item) {
						metadataHTML = metadataHTML + buildHTML(key, item[key], sect);
					}
					// one more time
					metadataHTML = metadataHTML + buildHTML('New Key', 'New Value', sect);
				}
				else {
					sect = 'info';
					tableHTML = tableHTML + buildHTML(i, item, sect);
				}
			});
			
			$('#modal_for_experiment').append(tableHTML + columnsTableHTML + metadataHTML);
			$('.modal-title').text("Clone Experiment");
			$('.modal-content').addClass( "modalViewSingleInfo" );
			$('#modal_for_experiment').show();

			var tags = ['sample','epigenetic_mark','technique','project'];
			var current;
			var cache = {};
			for (i in tags) {
				tag = tags[i];
				$("#" + tag).autocomplete({
					source : function( request, response ) {
	          var term = request.term;
	          if ( term in cache ) {
	            response( cache[ term ] );
	            return;
	          }
	          var url = "ajax/server_side/clone_get_data_server_processing.php?caller=" + current.id + "&term=" + term;
	          $.getJSON( url, request, function( data, status, xhr ) {
	            cache[ term ] = data;
	            response( data );
	          })
					},
					appendTo : "#modal_for_experiment",
					autoFocus: true,
					focus: function( event, ui ) { return false;},
					minLength: 2,
					select: function( event, ui ) {
						$(current).closest(".search-modal-name").removeClass('has-error'); 
					},
					change: function( event, ui ) {
						if (ui.item == null) {
							$(current).closest(".search-modal-name").addClass('has-error');
						}
					}
				});

				$("#" + tag).focus(function() {
					current = this;
				});				
			}

			// Printing experiment or anotation id and name in modal view when user clicks Clone button
			$('#cloneExperimentButton').unbind('click').bind('click', function (e) {
				var modal_id = $('.search-modal-id').text();
				var modal_name = $('.search-modal-name').text();

				var request = $.ajax({
					url: "ajax/server_side/select_regions_server_processing.php",
					dataType: "json",
					data : {
						experiments_names : [modal_name],
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
				alert("Id: "+modal_id+"\nName: "+modal_name);
			});
		});

		cloneInfoRequest.fail( function(jqXHR, textStatus) {
			console.log(jqXHR);
      console.log('Error: '+ textStatus);
			alert( "Error in experiment modal view" );
		});
		
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

		var selectedElementsModal = [];
		/* COLUMN FILTER  */

		var otable = $('#datatable_fixed_column').DataTable({
		    "ajax": {
		    "url": "ajax/server_side/modal_view_server_processing.php",
		    "data": function ( d ) {
		       		d.types = type;
		        	d.titles = text;
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

				var inputName;

				switch (type) {
					case 'experiment':
					    //alert('This is experiment');
					    break;
					case 'annotation':
					    //alert('Annotations');
					    break;
					case 'genome':
					   	inputName = '#experiment-genome';
					    break;
					case 'epigenetic_mark':
					    inputName = '#experiment-epigenetic_mark';
					    break;
					case 'sample':
					    inputName = '#experiment-sample';
					    break;
					case 'technique':
					    inputName = '#experiment-technique';
					    break;
					case 'project':
					    inputName = '#experiment-project';
					    break;
					default:
					    break;
				}

				$(inputName).val(text);
				$(inputName).prop('disabled', true);

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

		// custom toolbar
		$("div.toolbar").html('<div class="text-right"><img src="img/logo.png" alt="DeepBlue" style="width: 111px; margin-top: 3px; margin-right: 10px;"></div>');

		// Apply the filter
		$("#datatable_fixed_column thead th input[type=text]").on( 'keyup change', function () {
		    otable
		        .column( $(this).parent().index()+':visible' )
		        .search( this.value )
		        .draw();
		});
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
