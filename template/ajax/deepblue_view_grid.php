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
 *   Created : 04-03-2016
 *
 *   ================================================
 *
 *   File : deepblue_view_grid.php
 *
 */

/* DeepBlue Configuration */
require_once("../lib/lib.php");
require_once("../lib/server_settings.php");

require_once("inc/init.php");
?>

<div class="row">
  <div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
    <h1 class="page-title txt-color-blueDark"><i class="fa fa-th"></i>
      Experiments Grid
    </h1>
  </div>
</div>
<!-- widget grid -->
<section id="widget-grid" class="">
  <!-- row -->
  <?php include("grid.php"); ?>
</section>
<!-- end widget grid -->

<script type="text/javascript">

  var user_key = "<?php echo $user_key ?>";

  pageSetUp();
  var pagefunction = function() {
    gridPage();
  };

  // load related plugins
  loadScript("js/plugin/bootstrap-tags/bootstrap-tagsinput.min.js", function(){
    loadScript("js/plugin/datatables/jquery.dataTables.min.js", function(){
      loadScript("js/plugin/datatables/dataTables.colVis.min.js", function(){
        loadScript("js/plugin/datatables/dataTables.tableTools.min.js", function(){
          loadScript("js/plugin/datatables/dataTables.bootstrap.min.js", function(){
            loadScript("js/plugin/datatable-responsive/datatables.responsive.min.js", function(){
              loadScript("js/grid.js", pagefunction)
            });
          });
        });
      });
    });
  });

</script>