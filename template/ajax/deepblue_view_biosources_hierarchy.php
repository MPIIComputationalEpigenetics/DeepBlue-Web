<?php require_once("inc/init.php"); ?>

<div class="row">
	<div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
		<h1 class="page-title txt-color-blueDark"><i class="fa fa-sitemap fa-fw "></i>
			BioSources
			<span>>
			Hierarchical View
			</span>
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
					<span class="widget-icon"> <i class="fa fa-sitemap"></i> </span>
					<h2>Biosources Hierarchy</h2>

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
								<div class="col-md-6 col-md-offset-0" style="padding-bottom: 20px;">
									<div class="alert alert-info alert-block">
										<a class="close" data-dismiss="alert" href="#">×</a>
										<h4 class="alert-heading">BioSources</h4>
										Please, select the desired BioSources. The selected BioSources will be listed in the list on the right position, where they will also contains their samples.
									</div>
									<div class="input-group">
	  									<span class="input-group-addon">@</span>
										<input type="text" value="" class="form-control" id="user_biosource" placeholder="Search Biosource" />
									</div>
									<div id="biosources-tree"> </div>
								</div>
								<div class="col-md-6 col-md-offset-0">
									<div class="alert alert-info alert-block">
										<a class="close" data-dismiss="alert" href="#">×</a>
										<h4 class="alert-heading">Samples</h4>
										Please, verify and select the desired Samples. Click on the Plus symbol to see all samples from a BioSource (+)
									</div>
									<div class="dd" id="selected-biosources-nestable">
										<ol class="dd-list" id="selected-biosources"> </ol>
									</div>
								</div>
							</div>
						 	<div class="row">
								<div class="col-md-12 col-md-offset-0">
									<div class="alert alert-info alert-block">
										<a class="close" data-dismiss="alert" href="#">×</a>
										<h4 class="alert-heading">Experiments</h4>
										All experiments from the selected samples are listed here. Please, mark the ones that you are interested and click on Download button.
									</div>
										<div class="input-group">
                  		<table id="experiments_datatable" class="table table-striped table-bordered" width="100%">
                      	<thead>
                         	<tr>
                          	<th class="hasinput">
                            	<button type="button" id="$diff_top_btn" class="btn btn-primary download-btn-size">Download</button>
														</th>
                            <th class="hasinput">
                                <input class="form-control" placeholder="ID" type="text" id="experiment-id">
                            </th>

                            <th class="hasinput" style="width:20px">
                                <input type="text" class="form-control" placeholder="Experiment" id="experiment-name" />
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
                            <th>Select</th>
                            <th>ID</th>
                            <th>Experiment Name</th>
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
                			<button type="button" id="downloadExperimentButton" class="btn btn-primary download-btn-size">
					Download
				</button>
						</div>
					</div>
				</div>
<script>
var tree_div = $('#biosources-tree');
var no_dulicates = true;
var li_id_to_biosource = {};
var selected_biosources = [];
var biosource_to_sample = {};
var selected_samples = [];
var samples_to_experiments = {};
var samples_to_row = {};

var data_id_next = 1;
function get_data_id() {
	var v = data_id_next++;
	return v.toString();
}

function is_in(name, count, sons, exists) {
	if (exists.indexOf(name) >= 0) {
		return true;
	}

	if (count > 0) {
		return false;
	}

	if (sons.length == 0) {
		return true;
	}

	var sons_is_in = true;
	$.each(sons, function(index, value) {
		var r = is_in(value[1], value[2], value[3], exists);
		if (!r) {
			sons_is_in = false;
			return false;
		}
	});
	return sons_is_in;
}

function create_root(tree, id, name, count, sons, parent_id, exists, url) {

	if (is_in(name, count, sons, exists)) {
		return;
	}

	exists.push(name);
	if (parent_id == "" || count > 0 || sons.length > 1) {
		var li_class = 'biosource-tree-li-'+parent_id+id;

		biosource = {}
		biosource.name = name;
		biosource.count = count;
		li_id_to_biosource[li_class] = biosource;

		if (url.length > 0) {
			s = url.split("/");
			ont_name = "  (" + s[s.length-1] + ")";
		} else {
			ont_name = "";
		}


		if (count > 0) {
			var root = tree.append('<ul><li id="'+li_class+'" data-jstree=\'{"name":"'+name+'", "count":'+count+'}\'>'+ name+  ont_name + '</li></ul>');
		}
		else {
			var root = tree.append('<ul><li id="'+li_class+'">'+ name + '</li></ul>');
		}
		var l = $('#'+li_class);
		$.each(sons, function ( index, value ) {
			create_root(l, value[0], value[1], value[2], value[3], parent_id+value[0], exists, value[4]);
		});
	} else {
		$.each(sons, function ( index, value ) {
			create_root(tree, value[0], value[1], value[2], value[3], parent_id, exists, value[4]);
		});
	}
}

function get_experiments(sample_id) {
	var text = $.ajax({
		type: "GET",
		url: "ajax/server_side/list_experiments_server_processing.php",
		async: false,
		data : {
			samples: sample_id
		}
	}).responseText;
	return $.parseJSON(text);
}

function select_experiment(sample_id) {
	var data = get_experiments(sample_id);

	var rows = []
	var t = $('#experiments_datatable').DataTable();
	$.each(data.data, function(c, row) {
		var rownode = t.row.add(row).node();
		rows.push(rownode);
		$(rownode).css('color', 'red').animate( { color: 'black' } );
	});
	samples_to_row[sample_id] = rows;
}

selected_biosources.remove = function () {
	for( var i = 0, l = arguments.length; i < l; i++ ) {
		var biosource_id = arguments[i];
		var index = selected_biosources.indexOf(biosource_id);
		if (index  > -1) {
			selected_biosources.splice(index, 1);
			var samples = biosource_to_sample[biosource_id];
			delete biosource_to_sample[biosource_id];
			$.each(samples, function (index, sample) {
				selected_samples.remove(sample);
			});
		}
		// remove experiments with this sample
	}
	return this.length;
}

selected_samples.push = function () {
	for( var i = 0, l = arguments.length; i < l; i++ ) {
		this[this.length] = arguments[i];
		select_experiment(arguments[i]);
	}
	return this.length;
}

selected_samples.remove = function () {
	for( var i = 0, l = arguments.length; i < l; i++ ) {
		var sample_id = arguments[i];
		var index = selected_samples.indexOf(sample_id);
		if (index  > -1) {
			selected_samples.splice(index, 1);
		}
		var rows = samples_to_row[sample_id];
		$.each(rows, function(c, row) {
			var t = $('#experiments_datatable').DataTable();
			var table_row = t.row(row);
			table_row.remove();
		});
	}
	return this.length;
}

function get_samples(biosource_name) {
	var text = $.ajax({
		type: "GET",
		url: "ajax/server_side/samples_server_processing.php",
		async: false,
		dataType: "json",
		data : {
			biosources: biosource_name
		}
	}).responseText;
	return $.parseJSON(text);
}

function insert_biosource(id, biosource_name) {
	var data = get_samples(biosource_name);
	samples_ids = [];
	var count = 0
	$.each(data.data, function (index, value) {
		var sample_id = value[0];
		samples_ids.push(sample_id);
		var node_id = "#" +id + '-sub';
		var title = "Sample ID : " + value[0];

		var content = '<ol class="dd-list"><li class="dd-item" data-id="' + sample_id+"-li'><div class='dd-handle bg-color-blue txt-color-white'><i>" + value[2] + "</i></div></li></ol>";

		$(node_id).append('<li id="'+sample_id+'-li"class="dd-item" data-id="' +get_data_id()+ '"> <div class="dd3-content">'+title+'<span class="pull-right font-xs">Use this sample <span class="onoffswitch"> <input type="checkbox" name="'+sample_id+'-selector" checked="checked" class="onoffswitch-checkbox" id="'+sample_id+'-selector"> <label class="onoffswitch-label" for="'+sample_id+'-selector"> <div class="onoffswitch-inner" data-swchon-text="YES" data-swchoff-text="NO"></div> <div class="onoffswitch-switch"></div> </label>  </span> </div><ol class="dd-list"><li class="dd-item" data-id="3"><div class="dd3-content">'+value[2]+'</div></li></ol></li>');

		$('#selected-biosources-nestable').nestable('setParent', $('#'+sample_id+"-li"));
		$('#selected-biosources-nestable').nestable('collapseAll');

		biosource_to_sample[id] = samples_ids;
		selected_samples.push(value[0]);

		$('#'+sample_id+'-selector').change(function(e) {
			var name = e.currentTarget.name.split('-')[0];
			if (e.target.checked) {
				selected_samples.push(name);
				$('#experiments_datatable').DataTable().draw();
			} else {
				selected_samples.remove(name);
				$('#experiments_datatable').DataTable().draw();
			}
		});
	});
}

function select_node(e, data) {
	var id = data.node.id;
	var biosource = li_id_to_biosource[id];
	var name =  biosource.name;
	var count = biosource.count;
	if (count > 0) {
		var id = id + '-list-group-item';
		var id_sub = id + "-sub";
		$('#selected-biosources').append('<li id="'+id+'" class="dd-item" data-id="'+get_data_id()+'"><div class="dd-handle">'+name+'<em class="pull-right badge" data-placement="left">'+count+'</em></div><ol class="dd-list" id="'+id_sub+'"></ol></li>');
		$('#selected-biosources-nestable').nestable('setParent', $('#'+id));
		insert_biosource(id, name);
	}
	$.each(data.node.children_d, function (index, id_son) {
		biosource = li_id_to_biosource[id_son];
		var count = biosource.count;
		if (count > 0) {
			var name =  biosource.name;
			var id = id_son + '-list-group-item';
			var id_sub = id + "-sub";
			$('#selected-biosources').append('<li id="'+id+'" data-id="'+get_data_id()+'" class="dd-item"><div class="dd-handle">'+name+'<em class="pull-right badge" data-placement="left" >'+count+'</em></div><ol class="dd-list" id="'+id_sub+'"></ol></li>');
			$('#selected-biosources-nestable').nestable('setParent', $('#'+id));
			insert_biosource(id, name);
			}
		});
		$('#experiments_datatable').DataTable().draw();
	}


function deselect_node(e, data) {
			var id = data.node.id;
			selected_biosources.remove(id);
			var id = '#' + id + '-list-group-item';
	$(id).remove();

	$.each(data.node.children_d, function (index, id_son) {
		biosource = li_id_to_biosource[id_son];
				selected_biosources.remove(id_son);
		var id_son = "#" + id_son + "-list-group-item";
		$(id_son).remove();
	});
	$('#experiments_datatable').DataTable().draw();
}

					</script>

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

	<!-- row -->

	<div class="row">

	</div>

	<!-- end row -->

</section>
<!-- end widget grid -->

<script type="text/javascript">

	pageSetUp();

	var experiments_datatable = undefined;
	var breakpointDefinition = {
		tablet : 1024,
		phone : 480
	};

	function build_experiments_table() {
		var otable = $('#experiments_datatable').DataTable({
	    "iDisplayLength": 50,
	    "autoWidth" : true,

			"preDrawCallback" : function() {
				if (!experiments_datatable) {
					experiments_datatable = new ResponsiveDatatablesHelper($('#experiments_datatable'), breakpointDefinition);
				}
			},
			"rowCallback" : function(nRow) {
				//alert('aa');
				//experiments_datatable.createExpandIcon(nRow);
			},
			"drawCallback" : function(oSettings) {
				//alert('bb');
				//experiments_datatable.respond();
			},"fnInitComplete": function(oSettings, json) {
				$( ".downloadCheckBox" ).change(function() {
					var downloadId = $(this).parent().next().text();
					var downloadTitle = $(this).parent().next().next().text();
					var downloadTotal = downloadId+"-"+downloadTitle;

					var found = $.inArray(downloadTotal, selectedElements);

					if(found < 0){
						selectedElements.push(downloadTotal);
						selectedElementsNames.push(downloadTitle);
					}
					else{
						selectedElements.splice(found, 1);
						selectedElementsNames.push(found, 1);
					}
				});
			}
	  });
	}

	function build_tree() {
		var request = $.ajax({
			url: "ajax/server_side/biosources_tree.php",
			dataType: "json",
		});

		request.done( function(data) {
            if (data.data[0] == 'error') {
                var report = "An error has occured: " + data.data[1];
                swal({
                    title: "View Biosources",
                    text: report
                });
                return;
            }
            
			build_experiments_table();

			exists = [];
			$.each(data.data, function (index, value) {
				create_root(tree_div, value[0], value[1], value[2], value[3], "", exists, value[4]);
			});

			$('#biosources-tree').jstree({
					"core" : {
			    "animation" : 1,
			    "check_callback" : true,
			    "themes" : { "stripes" : true },
			    "open_parents": true,
			  },
			  "types" : {
			    "#" : {
			      "max_children" : 1,
			      "max_depth" : 4,
			      "valid_children" : ["root"]
			    },
			    "root" : {
			      "icon" : "/static/3.0.6/assets/images/tree_icon.png",
			      "valid_children" : ["default"]
			    },
			    "default" : {
			      "valid_children" : ["default","file"]
			    },
			    "file" : {
			      "icon" : "glyphicon glyphicon-file",
			      "valid_children" : []
			    }
			  },
			  "plugins" : [
			    "unique","search", "state", "types", "wholerow", "checkbox", "sort"
			  ]
			})
			.bind("select_node.jstree", function (e, data) {
				select_node(e, data);
			})
			.bind("deselect_node.jstree", function (e, data) {
				deselect_node(e, data);
			});

			var to = false;
			$('#user_biosource').keyup(function () {
				if(to) { clearTimeout(to); }
				to = setTimeout(function () {
					var v = $('#user_biosource').val();
					$('#biosources-tree').jstree(true).search(v);
				}, 250);
			});

		});

		request.fail( function(jqXHR, textStatus) {
			console.log(jqXHR);
			console.log('Error: '+ textStatus);
			alert( "error" );
		});
	}

	loadScript("js/plugin/jquery-nestable/jquery.nestable.js", function () {
		loadScript("js/plugin/jstree.js", function() {
			loadScript("js/plugin/datatables/jquery.dataTables.min.js", function(){
				loadScript("js/plugin/datatables/dataTables.colVis.min.js", function(){
					loadScript("js/plugin/datatables/dataTables.tableTools.min.js", function(){
						loadScript("js/plugin/datatables/dataTables.bootstrap.min.js", function(){
							loadScript("js/plugin/datatable-responsive/datatables.responsive.min.js", function() {
								build_tree();
								$('#selected-biosources-nestable').nestable({group : 1});
							});
						});
					});
				});
			});
		});
	});

</script>
