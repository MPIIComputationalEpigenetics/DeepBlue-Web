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
*   Created : 23-08-2014
*
*   ================================================
*
*   File : deepblue_view_search.php
*
*/

require_once("../lib/lib.php");
require_once("inc/init.php");

?>

<div class="row">
    <div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
        <h1 class="page-title txt-color-blueDark">
            <i class="fa fa-search fa-fw "></i>
                Full text search
            </span>
        </h1>
    </div>

	<div class="col-sm-12">

		<div id="search_content" class="tab-content bg-color-white padding-10">
			<div class="tab-pane fade in active" id="s1">
				<br>
				<div class="alert alert-info alert-block">
					<a class="close" data-dismiss="alert" href="#">×</a>
					<h6 class="alert-heading">Usage</h6>
					<ul>
						<li>Use +<i>keyword</i> for keywords that must be in the search results.</li>
						<li>Use -<i>keyword</i> for keywords that must not be in the search results.</li>
						<li>Use " " (double quotes) to enclose composite keywords, e.g., <i>"DNA methylation"</i></li>
					</ul>
					<br />
					<h6 class="alert-heading">Example</h6>
					The search<br/>
					<i>"DNA methylation" +grch38 -wgbs</i><br/>
					will look for all data in DeepBlue that match "DNA methylation" and "grch38", but not "wgbs".
					<h6 class="alert-heading">Scope</h6>
					You can define where to perform the search clicking on the button <i>Everything</i> and selecting the appropriated scope.
					</p>
				</div>
				<div class="input-group input-group-lg hidden-mobile">
					<div class="input-group-btn">
						<button id='typeSelect' type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
							<span id='select-show'>Everything</span> <span class="caret"></span>
						</button>
						<ul class="dropdown-menu">
							<li id='Everything'>
								<a href="javascript:void(0)" id='Everything'>Everything</a>
							</li>
							<li class="divider"></li>
							<li id='Annotations'>
								<a href="javascript:void(0)" id='Annotations'>Annotations</a>
							</li>
							<li id='Experiments'>
								<a href="javascript:void(0)" id='Experiments'>Experiments</a>
							</li>
							<li id='Genomes'>
								<a href="javascript:void(0)" id='Genomes'>Genomes</a>
							</li>
							<li id='Epigenetic Marks'>
								<a href="javascript:void(0)" id='Epigenetic Marks'>Epigenetic Marks</a>
							</li>
							<li id='BioSources'>
								<a href="javascript:void(0)" id='BioSources'>BioSources</a>
							</li>
							<li id='Samples'>
								<a href="javascript:void(0)" id='Samples'>Samples</a>
							</li>
							<li id='Techniques'>
								<a href="javascript:void(0)" id='Techniques'>Techniques</a>
							</li>
							<li id='Projects'>
								<a href="javascript:void(0)" id='Projects'>Projects</a>
							</li>
							<li id='Column types'>
								<a href="javascript:void(0)" id='Column types'>Column types</a>
							</li>
						</ul>
					</div>
					<input id="search_input" class="form-control input-lg" type="text" placeholder="Search again..." />
					<div class="input-group-btn">
						<button type="button" id="search_bt" class="btn btn-default">
							&nbsp;&nbsp;&nbsp;<i class="fa fa-fw fa-search fa-lg"></i>&nbsp;&nbsp;&nbsp;
						</button>
					</div>
				</div>

				<!--<h1 class="font-md"> Search Results for <span class="semi-bold">Projects</span><small class="text-danger"> &nbsp;&nbsp;(2,281 results)</small></h1>-->

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
        <div id="modal-content-by-jquery" style="display:none;">
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
                        <table id="datatable_fixed_column" name='experiment-table' class="table table-striped table-bordered" width="100%">
                            <thead>
                                <tr>
                                    <th class="hasinput">
                                        <input class="form-control" placeholder="ID" type="text" id="experiment-id">
                                    </th>
	                                <th class="hasinput" style="width:20px">
                                        <input type="text" class="form-control" placeholder="Experiment" id="experiment-name" />
                                    </th>
                                    <th class="hasinput" style="width:20px">
                                        <input type="text" class="form-control" placeholder="Experiment" id="experiment-datatype" />
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
                                    <th>Name</th>
                                    <th>Type</th>
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

        </div>
      </div>
      <div id="downloadDiv" style="display:none; text-align:right; padding-right:20px;">
		<button type="button" id="downloadExperimentButton" class="btn btn-primary download-btn-size">
			Download
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

	/* Filtering search by type */

	$('.dropdown-menu li a').click(function(event){

		var selectShow = $('#select-show');
		selectShow.html(event.target.id);
		$('#seach-type-title').text(event.target.id);
	});


	var isSelected = 0;
	var selectedItem = [];
	/* Start serching with clicking search button */


	function search_function() {
		isSelected = 1;
		$search = $('#search_input').val();

		/* Checking search value is empty or not */

		if($search == ''){
			$( "#tempSearchResult" ).empty();
            $( "#tempSearchResult" ).append( "<br\><div class='alert alert-danger fade in'><button class='close'" +
                    " data-dismiss='alert'>×</button><i class='fa-fw fa fa-times'></i><strong>Error!</strong> " +
                    "Search text cannot be empty!</div>");
            return;
		}

		var selectShowElement = $('#select-show').html();

		if(selectShowElement != 'Everything'){
			$type = selectShowElement;
		}
		else{
			$type = "";
		}

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
                $( "#tempSearchResult" ).append( "<br\><div class='alert alert-danger fade in'><button class='close'" +
                    " data-dismiss='alert'>×</button><i class='fa-fw fa fa-times'></i><strong>Error!</strong> " +
                    "Your search - "+$search+" - did not match any documents.<ul><li>Make sure all words are spelled correctly.</li>"+
                    "<li>Try different keywords.</li><li>Try more general keywords.</li><li>Try fewer keywords.</li></ul></div>");
			}
			else{
                if (data.data[0] == 'error') {
                    $( "#tempSearchResult" ).append( "<br\><div class='alert alert-danger fade in'><button class='close'" +
                        " data-dismiss='alert'>×</button><i class='fa-fw fa fa-times'></i> " +
                        "An error has occurred. " + data.data[1] + "</div>");
                    return;
                }
                else {
                    $.each(data.data, function(i, item) {
                        //$( "#tempSearchResult" ).append(item+'['+i+']'+"####<br/>");
                        $( "#tempSearchResult" ).append( "<div class='search-results clearfix'>"+
                            "<h4><span class='seach-result-title'><i class='fa fa-star txt-color-yellow'></i> <b>"+item[0]+ "</b> - <span data-toggle='modal' data-target='#myModal' class='"+item[4]+"'>" + item[1]+ "</span></span></h4>"+
                        "<div><p class='note'><span><i class='fa fa-circle txt-color-black'></i> " + item[4] +" "+ item[5] +" "+ item[6] +" "+ item[7] +" "+ item[8] +" "+ item[9] + "</span></p>"+
                        "<p class='description marginTop'>" + item[2] +"</p></div>"+
                        "<div class='searchMetadata'>"+item[3]+"</div></div>" );
                    });
                }
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
	};

	$("#search_bt").button().click(search_function);

	<?php
	if (isset($_GET["search"])) {
 		$search = $_GET["search"];
		echo("$('#search_input').val('$search');");
		echo("search_function()");
	}
	?>

	/* Triggering search automatically when user changes the type */
	$('#seach-type-title').bind("DOMSubtreeModified",function(){
		if(isSelected != 0){
			search_function();
		}
	});

	/* Trigger searching with pressing ENTER Key */
	$("#search_input").keyup(function(event){
		if(event.keyCode == 13){
		    search_function();
		    isSelected = 1;
		}
	});

	/* Search result :: Displaying modal view after clicking the title */
	$(document).off("click",'.seach-result-title span');
	$(document).on("click", '.seach-result-title span', function () {

		$('#search_input').val($search);
		var type = this.className;
		if(type == 'experiment' || type == 'annotation'){

			var getId = $(this).prev().text();

			var infoRequest = $.ajax({
				url: "ajax/server_side/search_get_info_server_processing.php",
				dataType: "json",
				data : {
					getId : getId
				}
			});

			infoRequest.done( function(data) {
                if (data.data[0] == 'error') {
                    swal({
                        title: "An error has occurred",
                        text: data.data[1]
                    });
                    return;
                }
				$('#modal_for_experiment').empty();
				$.each(data.data, function(i, item) {
				    if(type == 'experiment'){
				    	$('#modal_for_experiment').append(
				    		"<table class='table table-striped'>"+
						    	"<tbody>"+
						        "<tr>"+
						            "<td class='search-modal-table'>Experiment name : </td>"+
						            "<td class='search-modal-name' id='search-modal-name'>"+item[1]+"</td>"+
						        "</tr>"+
						        "<tr>"+
						            "<td class='search-modal-table'>ID : </td>"+
						            "<td class='search-modal-id' id='search-modal-id'>"+item[0]+"</td>"+
						        "</tr>"+
						        "<tr>"+
						            "<td class='search-modal-table'>Description : </td>"+
						            "<td id='search-modal-desc'>"+item[2]+"</td>"+
						        "</tr>"+
						        "<tr>"+
						            "<td class='search-modal-table'>Type : </td>"+
						            "<td>"+item[4]+"</td>"+
						        "</tr>"+
						        "<tr>"+
						            "<td class='search-modal-table'>Genome : </td>"+
						            "<td id='search-modal-genome'>"+item[5]+"</td>"+
						        "</tr>"+
						        "<tr>"+
						            "<td class='search-modal-table'>Epigenetic mark : </td>"+
						            "<td id='search-modal-epigenetic-mark'>"+item[6]+"</td>"+
						        "</tr>"+
						        "<tr>"+
						            "<td class='search-modal-table'>Sample : </td>"+
						            "<td id='search-modal-sample'>"+item[7]+"</td>"+
						        "</tr>"+
						        "<tr>"+
						            "<td class='search-modal-table'>Technique : </td>"+
						            "<td id='search-modal-technique'>"+item[8]+"</td>"+
						        "</tr>"+
						        "<tr>"+
						            "<td class='search-modal-table'>Project : </td>"+
						            "<td id='search-modal-project'>"+item[9]+"</td>"+
						        "</tr>"+
						        "<tr>"+
						            "<td class='search-modal-table'>Metadata : </td>"+
						            "<td id='search-modal-metadata'>"+item[3]+"</td>"+
						        "</tr>"+
						    	"</tbody>"+
							"</table>");

						$('.modal-title').text("Experiment info");
						selectedItem = item;
					}
					else{

						$('#modal_for_experiment').append(
				    	"<table class='table table-striped search-modal-table-td'>"+
						    "<tbody>"+
						        "<tr>"+
						            "<td class='search-modal-table'>Annotation name : </td>"+
						            "<td class='search-modal-name'>"+item[1]+"</td>"+
						        "</tr>"+
						        "<tr>"+
						            "<td class='search-modal-table'>ID : </td>"+
						            "<td class='search-modal-id'>"+item[0]+"</td>"+
						        "</tr>"+
						        "<tr>"+
						            "<td class='search-modal-table'>Description : </td>"+
						            "<td><div class='search-modal-annotation-format'>"+item[2]+"</div></td>"+
						        "</tr>"+
						        "<tr>"+
						            "<td class='search-modal-table'>Type : </td>"+
						            "<td>"+item[4]+"</td>"+
						        "</tr>"+
						        "<tr>"+
						            "<td class='search-modal-table'>Genome : </td>"+
						            "<td class='search-modal-genome>"+item[5]+"</td>"+
						        "</tr>"+
						        "<tr>"+
						            "<td class='search-modal-table'>Format : </td>"+
						            "<td><div class='search-modal-annotation-format'>"+item[10]+"</div></td>"+
						        "</tr>"+
						        "<tr>"+
						            "<td class='search-modal-table'>Metadata : </td>"+
						            "<td id='search-modal-metadata' class='search-modal-metadata'>"+item[3]+"</td>"+
						        "</tr>"+
						    "</tbody>"+
						"</table>");

						$('.modal-title').text("Annotation info");
					}
					$("td .fa-circle").remove();
			    });

				$('#modal-content-by-jquery').hide();
				$('.modal-content').addClass( "modalViewSingleInfo" );
				$('#modal_for_experiment').show();
				$('#downloadDiv').show();

				/* Printinting experiment or anotation id and name in modal view when user
				*  clicks Download button
				*/

				$('#downloadExperimentButton').unbind('click').bind('click', function (e) {
					var modal_id = $('#search-modal-id').text();
					var modal_name = $('#search-modal-name').text();
					var modal_type = '';
					var modal_desc = $('#search-modal-desc').text();
					var modal_genome = $('#search-modal-genome').text();
					var modal_epigenetic_mark = $('#search-modal-epigenetic-mark').text();
					var modal_biosource = '';
					var modal_sample = $('#search-modal-sample').text();
					var modal_technique = $('#search-modal-technique').text();
					var modal_project = $('#search-modal-project').text();
					var modal_metadata = selectedItem[3];

					if(type == 'experiment'){
						var selectedData = [];
						selectedData.push([modal_id, modal_name, modal_type, modal_desc, modal_genome, modal_epigenetic_mark, modal_biosource,
						 modal_sample, modal_technique, modal_project, modal_metadata]);

			            localStorage.setItem("selectedData", JSON.stringify(selectedData));
			            $('#myModal').modal('toggle');
			            window.location.href = "dashboard.php#ajax/deepblue_download_experiments.php";
					}
					else {
						// TODO: Implement Downloads for annotations
					}
				});

			});

			infoRequest.fail( function(jqXHR, textStatus) {

				console.log(jqXHR);
		        console.log('Error: '+ textStatus);

				alert( "Error in modal view experiment and annotaiton views" );
			});

		}
		else{
			$('.modal-content').removeClass( "modalViewSingleInfo" );
			$('#modal_for_experiment').hide();
			$('#modal-content-by-jquery').show();


			if(type == 'genome' || type == 'technique' || type == 'project' || type == 'epigenetic_mark' || type == 'biosource'){
				var text = $(this).text();
			}
			else{
				var text = $(this).prev().text();
			}

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

			var initFilter = [
		    	null,
		    	null,
		    	null,
		    	null,
		    	null,
		    	null,
		    	null,
		    	null,
		    	null,
		    	null,
		    	null
		    ];

			switch (type) {
				case 'genome':
				   	initFilter[4] = {"sSearch": text};
				    break;
				case 'epigenetic_mark':
					initFilter[5] = {"sSearch": text};
				    break;
				case 'biosource':
				    initFilter[6] = {"sSearch": text};
				    break;
				case 'sample':
					initFilter[7] = {"sSearch": text};
					break;
				case 'technique':
				    initFilter[8] = {"sSearch": text};
				    break;
				case 'project':
				    initFilter[9] = {"sSearch": text};
				    break;
				default:
				    break;
			}


			var inputName = "#experiment-" + type;
			$(inputName).val(text);
	 	    $(inputName).prop('disabled', true);


			var selectedElementsModal = [];
			/* COLUMN FILTER  */

			var otable = $('#datatable_fixed_column').DataTable({

		    	"bServerSide": true,
		        "sAjaxSource": "api/datatable",
		        "fnServerParams": function ( aoData ) {
	      			aoData.push( { "name": "collection", "value": "experiments" } );
	      			aoData.push( { "name": "col_0", "value": "_id"} );
	      			aoData.push( { "name": "col_1", "value": "name"} );
	      			aoData.push( { "name": "col_2", "value": "data_type"} );
	      			aoData.push( { "name": "col_3", "value": "description"} );
	      			aoData.push( { "name": "col_4", "value": "genome"} );
	      			aoData.push( { "name": "col_5", "value": "epigenetic_mark"} );
	      			aoData.push( { "name": "col_6", "value": "biosource"} );
	      			aoData.push( { "name": "col_7", "value": "sample_id"} );
	      			aoData.push( { "name": "col_8", "value": "technique"} );
	      			aoData.push( { "name": "col_9", "value": "project"} );
	      			aoData.push( { "name": "col_10", "value": "extra_metadata"} );
	      			aoData.push( { "name": "key", "value": "<?php echo $user_key ?>"} );
	      		},
			    "iDisplayLength": 50,
			    "autoWidth" : true,
			    "bDestroy": true,
			    "aoSearchCols" : initFilter,
			    "oSearch": {"bSmart": false},
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
					/* Insert or remove selected or unselected elements
					//selectedElementsModal = [];
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
					});*/
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

		}
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
