<?php require_once("inc/init.php"); ?>

<div class="row">
	<div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
		<h1 class="page-title txt-color-blueDark"><i class="fa fa-desktop fa-fw "></i>
			UI Elements
			<span>>
			Tree View
			</span>
		</h1>
	</div>
</div>
<!-- widget grid -->
<section id="widget-grid" class="">

	<!-- row -->
	<div class="row">

		<!-- NEW WIDGET START -->
		<article class="col-sm-12 col-md-12 col-lg-6">

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

						<div id="biosources-tree">

						</div>

					<script>
						var tree_div = $('#biosources-tree');

						function create_root(tree, id, name, count, sons, parent_id) {

							var li_class = 'biosource-tree-li-'+parent_id+id;
							var root = tree.append('<ul><li id="'+li_class+'">'+ name+ '</li></ul>');

							var l = $('#'+li_class);

							$.each(sons, function ( index, value ) {
								create_root(l, value[0], value[1], value[2], value[3], parent_id+value[0]);
							});
						}

						var request = $.ajax({
							url: "ajax/server_side/biosources_tree.php",
							dataType: "json",
						});

						request.done( function(data) {
							$.each(data.data, function (index, value) {
								create_root(tree_div, value[0], value[1], value[2], value[3], "");
							});
							$('#biosources-tree').jstree();

							$('#biosources-tree').on("changed.jstree", function (e, data) {
  								console.log(data.selected);
							});
						});

						request.fail( function(jqXHR, textStatus) {
							console.log(jqXHR);
			        		console.log('Error: '+ textStatus);
							alert( "error" );
						});


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

	var pagefunction = function() {
		loadScript("js/plugin/jstree.js");
	};

	pagefunction();

</script>
