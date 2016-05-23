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
  <?php include("../inc/grid.php"); ?>
  <div class="alert alert-info alert-block" id="selection-banner">
    Click the row to unselect an experiment. It will be removed from the data table.</br>
    For downloading the data, click in the <i>Download</i> button in the end of the page. You will be redirected to the download page.</br>
  </div>
  <?php include("../inc/selection_table.php"); ?>
</section>
<!-- end widget grid -->

<script type="text/javascript">

  var user_key = "<?php echo $user_key ?>";

  pageSetUp();

  var pagefunction = function() {
    gridPage();

    $('#downloadBtnBottom').click(function(e){
      // save the rows of the selected data table into local storage
      localStorage.setItem("selectedData", JSON.stringify(selectedData));
      window.location.href = "dashboard.php#ajax/deepblue_download_experiments.php";
    });
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