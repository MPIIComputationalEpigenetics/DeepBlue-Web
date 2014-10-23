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
						 	<div class="row show-grid">
								<div class="col-md-6">
									<h3>Please, select the desired BioSources</h3>
									<div class="input-group">
	  									<span class="input-group-addon">@</span>
										<input type="text" value="" class="form-control" id="user_biosource" placeholder="Search Biosource" />
									</div>
									<div id="biosources-tree"> </div>
								</div>
								<div class="col-md-6 col-md-offset-0">
									<h3>Selected BioSouces</h3>
									<div class="dd" id="selected-biosources-nestable">
										<ol class="dd-list" id="selected-biosources"> </ol>
									</div>
								</div>
							</div>





						<script>
						var tree_div = $('#biosources-tree');
						var no_dulicates = true;
						var li_id_to_biosource = {};
						var selected_biosources = [];
						var biosource_to_samples = {};

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

						function create_root(tree, id, name, count, sons, parent_id, exists) {

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

								if (count > 0) {
									var root = tree.append('<ul><li id="'+li_class+'" data-jstree=\'{"name":"'+name+'", "count":'+count+'}\'>'+ name+ " (" + count + ")" + '</li></ul>');
								}
								else {
									var root = tree.append('<ul><li id="'+li_class+'">'+ name + '</li></ul>');
								}
								var l = $('#'+li_class);
								$.each(sons, function ( index, value ) {
									create_root(l, value[0], value[1], value[2], value[3], parent_id+value[0], exists);
								});
							} else {
								$.each(sons, function ( index, value ) {
									create_root(tree, value[0], value[1], value[2], value[3], parent_id, exists);
								});
							}
						}

						function insert_sample(id, biosource_name) {
							selected_biosources[biosource_name] = id;
							var request = $.ajax({
								url: "ajax/server_side/samples_server_processing.php",
								dataType: "json",
								data : {
									biosources: biosource_name
								}
							});

							request.done( function(data) {
								$.each(data.data, function (index, value) {
									var node_id = "#" +id + '-list-group-item-sub';
									var title = "Sample ID : " + value[0];

									var content = '<ol class="dd-list"><li class="dd-item" data-id="' + value[0]+"-li'><div class='dd-handle bg-color-blue txt-color-white'><i>" + value[2] + "</i></div></li></ol>";

									$(node_id).append('<li class="dd-item" data-id="' +get_data_id()+ '"> <div class="dd-handle">'+title+'</div> </li>');
								});
							});

							request.fail( function(jqXHR, textStatus) {
								console.log(jqXHR);
			        			console.log('Error: '+ textStatus);
								alert( textStatus);
							});
						}

						function remove_sample(biosource_name) {
							var index = selected_biosources.indexOf(biosource_name);
							if (index  > -1) {
								selected_biosources.splice(index, 1);
							}
						}

						function select_node(e, data) {
							var id = data.node.id;
							var biosource = li_id_to_biosource[id];
							var name =  biosource.name;
							var count = biosource.count;
							if (count > 0) {
								insert_sample(id, name);
								var id = id + '-list-group-item';
								var id_sub = id + "-sub";
           						$('#selected-biosources').append('<li id="'+id+'" class="dd-item" data-id="'+get_data_id()+'"><div class="dd-handle">'+name+'<em class="pull-right badge" data-placement="left">'+count+'</em></div><ol class="dd-list" id="'+id_sub+'"></ol></li>');

           						$('#selected-biosources-nestable').nestable('setParent', $('#'+id));
           					}
           					$.each(data.node.children_d, function (index, id_son) {
           						biosource = li_id_to_biosource[id_son];
           						var count = biosource.count;
           						if (count > 0) {
           							var name =  biosource.name;
           							insert_sample(id_son, name);
           							var id = id_son + '-list-group-item';
           							var id_sub = id + "-sub";
           							$('#selected-biosources').append('<li id="'+id+'" data-id="'+get_data_id()+'" class="dd-item"><div class="dd-handle">'+name+'<em class="pull-right badge" data-placement="left" >'+count+'</em></div><ol class="dd-list" id="'+id_sub+'"></ol></li>');
           							$('#selected-biosources-nestable').nestable('setParent', $('#'+id));
           						}
           					});
           				}

           				function deselect_node(e, data) {
							var id = data.node.id;
							biosource = li_id_to_biosource[id];
							remove_sample(biosource.name);
							var id = '#' + id + '-list-group-item';
           					$(id).remove();

           					$.each(data.node.children_d, function (index, id_son) {
           						biosource = li_id_to_biosource[id_son];
								remove_sample(biosource.name);
           						var id_son = "#" + id_son + "-list-group-item";
           						$(id_son).remove();
           					});
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

	function build_tree() {
			var request = $.ajax({
			url: "ajax/server_side/biosources_tree.php",
			dataType: "json",
		});

		request.done( function(data) {
			exists = [];
			$.each(data.data, function (index, value) {
				create_root(tree_div, value[0], value[1], value[2], value[3], "", exists);
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
			build_tree();
			$('#selected-biosources-nestable').nestable({group : 1});
		});
	});

</script>
