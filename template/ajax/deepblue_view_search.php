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

require_once("inc/init.php");

?>

<div class="row">

	<div class="col-sm-12">

		<div id="myTabContent1" class="tab-content bg-color-white padding-10">
			<div class="tab-pane fade in active" id="s1">
				<h1> Search <span id="seach-type-title" class="semi-bold">Everything</span></h1>
				<br>
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
							<li id='Bio Sources'>
								<a href="javascript:void(0)" id='Bio Sources'>Bio Sources</a>
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
				<?php echo $deepBlueObj->experimentDataTableTemplate("search"); ?>
			</div>
			<div class="modal-footer">
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
	/* Start serching with clicking search button */


	function search_function() {
		isSelected = 1;
		$search = $('#search_input').val();

		/* Checking search value is empty or not */

		if($search == ''){
			$( "#tempSearchResult" ).empty();
			$( "#tempSearchResult" ).append( "<div class='search-results clearfix'><h2>Search text cannot be empty!</h2></div>");
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
				$( "#tempSearchResult" ).append( "<div class='search-results clearfix'><h2>Your search - "+$search+" - did not match any documents.</h2><ul><li>Make sure all words are spelled correctly.</li><li>Try different keywords.</li><li>Try more general keywords.</li><li>Try fewer keywords.</li></ul></div>");
			}
			else{
				$.each(data.data, function(i, item) {
				    //$( "#tempSearchResult" ).append(item+'['+i+']'+"####<br/>");
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

				$('#modal_for_experiment').empty();

				$.each(data.data, function(i, item) {

				    if(type == 'experiment'){

				    $('#modal_for_experiment').append(
				    	"<table class='table table-striped'>"+
						    "<tbody>"+
						        "<tr>"+
						            "<td class='search-modal-table'>Experiment name : </td>"+
						            "<td class='search-modal-name'>"+item[1]+"</td>"+
						        "</tr>"+
						        "<tr>"+
						            "<td class='search-modal-table'>ID : </td>"+
						            "<td class='search-modal-id'>"+item[0]+"</td>"+
						        "</tr>"+
						        "<tr>"+
						            "<td class='search-modal-table'>Description : </td>"+
						            "<td>"+item[2]+"</td>"+
						        "</tr>"+
						        "<tr>"+
						            "<td class='search-modal-table'>Type : </td>"+
						            "<td>"+item[4]+"</td>"+
						        "</tr>"+
						        "<tr>"+
						            "<td class='search-modal-table'>Genome : </td>"+
						            "<td>"+item[5]+"</td>"+
						        "</tr>"+
						        "<tr>"+
						            "<td class='search-modal-table'>Epigenetic mark : </td>"+
						            "<td>"+item[6]+"</td>"+
						        "</tr>"+
						        "<tr>"+
						            "<td class='search-modal-table'>Sample : </td>"+
						            "<td>"+item[7]+"</td>"+
						        "</tr>"+
						        "<tr>"+
						            "<td class='search-modal-table'>Technique : </td>"+
						            "<td>"+item[8]+"</td>"+
						        "</tr>"+
						        "<tr>"+
						            "<td class='search-modal-table'>Project : </td>"+
						            "<td>"+item[9]+"</td>"+
						        "</tr>"+
						        "<tr>"+
						            "<td class='search-modal-table'>Metadata : </td>"+
						            "<td>"+item[3]+"</td>"+
						        "</tr>"+
						    "</tbody>"+
						"</table>");

						$('.modal-title').text("Experiment info");
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
						            "<td>"+item[5]+"</td>"+
						        "</tr>"+
						        "<tr>"+
						            "<td class='search-modal-table'>Format : </td>"+
						            "<td><div class='search-modal-annotation-format'>"+item[10]+"</div></td>"+
						        "</tr>"+
						        "<tr>"+
						            "<td class='search-modal-table'>Metadata : </td>"+
						            "<td>"+item[3]+"</td>"+
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

				/* Printinting experiment or anotation id and name in modal view when user
				*  clicks Download button
				*/

				$('#downloadExperimentButton').unbind('click').bind('click', function (e) {
					var modal_id = $('.search-modal-id').text();
					var modal_name = $('.search-modal-name').text();

					if(type == 'experiment'){
						var request = $.ajax({
							url: "ajax/server_side/select_regions_server_processing.php",
							dataType: "json",
							data : {
								experiments_names : [modal_name],
							}
						});
					} else {
						var request = $.ajax({
							url: "ajax/server_side/select_annotations_server_processing.php",
							dataType: "json",
							data : {
								annotations_names : [modal_name],
							}
						});
					}

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
		}


		if(type == 'genome' || type == 'technique' || type == 'project' || type == 'epigenetic_mark' || type == 'bio_source'){
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
				});

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

		/* Download button :: Getting selected elements */
		$('#downloadBtnTop').click(function(){

			if(selectedElementsModal.length == 0){
				//alert("( Modal ) Please select elements!");
				//alert("( length = 0 ) Klikkkkk");
			}
			else{
				//alert(selectedElementsModal);
				//alert("( length != 0 ) Klikkkkk");
			}

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
