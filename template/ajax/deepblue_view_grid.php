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
      Grid
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
          <span class="widget-icon"> <i class="fa fa-th"></i> </span>
          <h2>Experiments</h2>
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
              <div class="col-md-3">
                <div>
                  <button type="submit" class="btn btn-primary" onClick="clearSelections()"> Clear filter </button>
                </div>
                <br>
                <div class="panel-group" id="genomes-panel">
                  <div class="panel panel-default">
                    <div class="panel-heading" align="right">
                      <h4 class="panel-title">
                        <span style="float: left">Genome</span>
                        <a class="btn btn-xs btn-primary accordion-toggle" role="button" data-toggle="collapse" data-parent="#genomes-panel" href="#genomes-spill">+</a>
                      </h4>
                    </div>
                    <div class="list-group" id="genomes-main"></div>
                    <ul class="list-group panel-collapse collapse out" id="genomes-spill"></ul>
                  </div>
                </div>
<!--                var vocabnames = ["projects","genomes", "techniques", "epigenetic_marks", "biosources", "types"];-->
                <div class="panel-group" id="epigenetic_marks-panel">
                  <div class="panel panel-default">
                    <div class="panel-heading" align="right">
                      <h4 class="panel-title">
                        <span style="float: left">Epigenetic Marks</span>
                        <a class="btn btn-xs btn-primary accordion-toggle" role="button" data-toggle="collapse" data-parent="#epigenetic_marks-panel" href="#epigenetic_marks-spill">+</a>
                      </h4>
                    </div>
                    <div class="list-group" id="epigenetic_marks-main">
                      <!--                      <div class="list-group-item" id="genome" name="genome"><span class="badge" id="genome-span">14</span>hg19</div>-->
                      <!--                      <div class="list-group-item" id="genome" name="genome"><span class="badge" id="genome-span">14</span>mm10</div>-->
                      <!--                      <div></div>-->
                    </div>
                    <ul class="list-group panel-collapse collapse out" id="epigenetic_marks-spill">
                      <!--                      <a href="#" class="list-group-item"><span class="badge">1</span>MMC342</a>-->
                      <!--                      <a href="#" class="list-group-item"><span class="badge">12</span>GRC87</a>-->
                    </ul>
                  </div>
                </div>
              </div>
              <div class="col-md-9">
              </div>
            </div>
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
</section>
<!-- end widget grid -->

<script type="text/javascript">

  var selected = [];
  var selectedNames = [];
  var selectedData = [];
  var list_in_use;
  var filters = {};

  pageSetUp();

  function clearSelections() {
    // clear list selection
    $('.list-group-item').removeClass('active');
  }

  function pullData() {
    var request1 = $.ajax({
      url: "ajax/server_side/faceting_experiments.php",
      data : {
        request : filters
      },
      dataType: "json"
    });

    request1.done(function (data) {
      if ("error" in data) {
        swal({
          title: "Error listing experiments",
          text: data['message']
        });
        return;
      }

      // store data in local storage
      localStorage.setItem("list_in_use", JSON.stringify(data[0]));
      list_in_use = data[0];

      loadFilters();
    });

    request1.fail(function (jqXHR, textStatus) {
      console.log(jqXHR);
      console.log('Error: ' + textStatus);
      alert("Encountered an error. Please wait a few seconds and reload page. If problem persist, kindly log a complaint");
    });
  }

  function addToList(type, list, element, badge, index) {

    // build required variables
    var elem_id = element;
    var elem_name = type;
    var badge_id = element + "_badge_id";

    var elem_string = "<a class='list-group-item' id='" + elem_id + "' name='" + elem_name + "'><span class='badge' id='" +
        badge_id + "'>" + badge + "</span>" + element + "</a>";

    // populate the main list
    if (index < 4) {
      var list_id = "#" + list + "-main";
      $(elem_string).appendTo(list_id);
    }
    else {
      // populate the spillover list
      var list_id = "#" + list + "-spill";
      $(elem_string).appendTo(list_id);
    }
  }

  function clearList() {
    $(".list-group").empty();
  }

  function loadFilters() {

    var vocabnames = ["projects","genomes", "techniques", "epigenetic_marks", "biosources", "types"];
    var vocabids = ['experiment-project','experiment-genome', "experiment-technique", "experiment-epigenetic_mark", "experiment-biosource", "experiment-datatype"];

    // first empty all the list
    clearList();

    for (i in vocabnames) {
      var vocabname = vocabnames[i];
      var vocabid = vocabids[i];

      var currentvocab = list_in_use[vocabname]['amt'];
      var currentvocab_size = currentvocab.length;

      var k = 0;
      for (j=currentvocab_size-1; j>=0; j--) {
        // use jquery to add this as a list with name = currentvocab[j][1] and badge = currentvocab[j][2]
        addToList(vocabid, vocabname, currentvocab[j][1] , currentvocab[j][2], k);
        k++;
      }
    }

    // add sensitivity to the list
    $('.list-group-item').on('click',function(e){
      if ($(this).hasClass('active')) $(this).removeClass('active');
      else $(this).addClass('active');

      filters[this.name] = this.id;
      pullData();
    });
  }

  var pagefunction = function() {

    list_in_use = JSON.parse(localStorage.getItem('list_in_use'));
    if (list_in_use == null) {
      // TODO: Not only if list_in_use is null because it may not be null but the data is filtered so check
      // TODO: if any filter is active, if yes, still pull fresh data
      pullData();
    }
    else {
      loadFilters();
    }
  }

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