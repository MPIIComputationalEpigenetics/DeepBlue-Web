<?php
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
					<input id="search_input" class="form-control input-lg" type="text" placeholder="Search again..." id="search-project">
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
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
				&times;
			</button>
			<h4 class="modal-title" id="myModalLabel"></h4>
		</div>
		<div class="modal-body custom-scroll terms-body">

			<?php echo $deepBlueObj->experimentDataTableTemplate(); ?>


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
	/* DO NOT REMOVE : GLOBAL FUNCTIONS!
	 *
	 * pageSetUp(); WILL CALL THE FOLLOWING FUNCTIONS
	 *
	 * // activate tooltips
	 * $("[rel=tooltip]").tooltip();
	 *
	 * // activate popovers
	 * $("[rel=popover]").popover();
	 *
	 * // activate popovers with hover states
	 * $("[rel=popover-hover]").popover({ trigger: "hover" });
	 *
	 * // activate inline charts
	 * runAllCharts();
	 *
	 * // setup widgets
	 * setup_widgets_desktop();
	 *
	 * // run form elements
	 * runAllForms();
	 *
	 ********************************
	 *
	 * pageSetUp() is needed whenever you load a page.
	 * It initializes and checks for all basic elements of the page
	 * and makes rendering easier.
	 *
	 */

	pageSetUp();

	/*
	 * ALL PAGE RELATED SCRIPTS CAN GO BELOW HERE
	 * eg alert("my home function");
	 *
	 * var pagefunction = function() {
	 *   ...
	 * }
	 * loadScript("js/plugin/_PLUGIN_NAME_.js", pagefunction);
	 *
	 * TO LOAD A SCRIPT:
	 * var pagefunction = function (){
	 *  loadScript(".../plugin.js", run_after_loaded);
	 * }
	 *
	 * OR
	 *
	 * loadScript(".../plugin.js", run_after_loaded);
	 */

	// PAGE RELATED SCRIPTS

	// pagefunction

	var pagefunction = function() {

		$("#search-project").focus();

	};

	/* Filtering search by type */

	$('.dropdown-menu li a').click(function(event){

		var selectShow = $('#select-show');
		selectShow.html(event.target.id);
		$('#seach-type-title').text(event.target.id);
	});

	/* Trigger searching with pressing ENTER Key */

	var isSelected = 0;

	$("#search_input").keyup(function(event){
	    if(event.keyCode == 13){
	        $("#search_bt").click();
	        isSelected = 1;
	    }
	});

	/* Start serching with clicking search button */

	$("#search_bt").button().click(function() {
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
			//alert(JSON.stringify(data));
			$( "#tempSearchResult" ).empty();

			if(data.data == ''){
				$( "#tempSearchResult" ).append( "<div class='search-results clearfix'><h2>Your search - "+$search+" - did not match any documents.</h2><ul><li>Make sure all words are spelled correctly.</li><li>Try different keywords.</li><li>Try more general keywords.</li><li>Try fewer keywords.</li></ul></div>");
			}
			else{
				$.each(data.data, function(i, item) {
			    	//$( "#tempSearchResult" ).append(item+'['+i+']'+"####<br/>");
			    	$( "#tempSearchResult" ).append( "<div class='search-results clearfix'><h4><span class='seach-result-title'><b>"
			    	+item[0]+ "</b> - <span data-toggle='modal' data-target='#myModal' class='"+item[4]+"'>" + item[1]+ "</span></span></h4><div><p class='note'><span><i class='fa fa-star txt-color-yellow'></i> " + item[4] +" "+ item[5] +" "+ item[6] +" "+ item[7] +" "+ item[8] +" "+ item[9] + "</span></p><p class='description marginTop'>" + item[2] +"</p></div><div class='searchMetadata'>"+item[3]+"</div></div>" );
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
			// alert(jqXHR);
			// alert(textStatus);
		});
	});


	/* Triggering search automatically when user changes the type */

	var timer;
	$('#seach-type-title').bind("DOMSubtreeModified",function(){
		if(isSelected != 0){
			if (timer) clearTimeout(timer);
		   	timer = setTimeout(function() {
		   		$("#search_bt").click();
		   	}, 100);
	   	}
	});

	/* Search result :: Displaying modal view after clicking the title */

	$(document).on("click", '.seach-result-title span', function () {

		var type = this.className;

		if(type == 'genome' || type == 'technique' || type == 'project' || type == 'epigenetic_mark' || type == 'bio_source'){
			var text = $(this).text();
		}
		else{
			var text = $(this).prev().text();
		}
		$('.modal-title').text(text);

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

		$('input').val("");
		$('input').prop('disabled', false);

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
				        alert('This is experiment');
				        break;
				    case 'annotation':
				        alert('Annotations');
				        break;
				    case 'genome':
				        inputName = '#experiment-genome';
				        break;
				    case 'epigenetic_mark':
				        inputName = '#experiment-em';
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

	pagefunction();

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
