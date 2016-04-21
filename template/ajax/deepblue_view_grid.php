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

<style>
  .table .selected-grid-cell {
    border-color: green;
  }

  .table .unselected-grid-cell {
    border-color: yellowgreen;
  }
</style>

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
  <div class="row" id="main-view">

    <!-- NEW WIDGET START -->
    <article class="col-sm-12 col-md-12 col-lg-12">

      <!-- Widget ID (each widget will need unique ID)-->
      <div class="jarviswidget jarviswidget-color-blue" id="grid-experiments" data-widget-editbutton="false" data-widget-deletebutton="false" data-widget-colorbutton="false" data-widget-togglebutton="false">

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
                  <button type="submit" id="clearBtn" class="btn btn-default" onClick="clearSelections()" disabled> Clear All </button>
                  <button type="submit" id="selectAllBtn" class="btn btn-default" onClick="selectAll()" disabled> Select All </button>
                </div>
                <hr>
                <br>
                <div class="panel-group" id="types-panel">
                  <div class="panel panel-default">
                    <div class="panel-heading" align="right">
                      <h4 class="panel-title">
                        <span style="float: left">Data types</span>
                        <a class="btn btn-xs btn-default accordion-toggle" role="button" data-toggle="collapse" data-parent="#types-panel" href="#types-spill" id="types-bttn" onclick="toggleButton(this.id)">+</a>
                      </h4>
                    </div>
                    <div class="list-group" name="experiment-datatype" id="types-main"></div>
                    <ul class="list-group panel-collapse collapse out" name="experiment-datatype" id="types-spill"></ul>
                  </div>
                </div>
                <div class="panel-group" id="genomes-panel">
                  <div class="panel panel-default">
                    <div class="panel-heading" align="right">
                      <h4 class="panel-title">
                        <span style="float: left">Genome</span>
                        <a class="btn btn-xs btn-default accordion-toggle" role="button" data-toggle="collapse" data-parent="#genomes-panel" href="#genomes-spill" id="genomes-bttn" onclick="toggleButton(this.id)">+</a>
                      </h4>
                    </div>
                    <div class="list-group" name="experiment-genome" id="genomes-main"></div>
                    <ul class="list-group panel-collapse collapse out" name="experiment-genome" id="genomes-spill"></ul>
                  </div>
                </div>
<!--                var vocabnames = ["projects","genomes", "techniques", "epigenetic_marks", "biosources", "types"];-->
                <div class="panel-group" id="epigenetic_marks-panel">
                  <div class="panel panel-default">
                    <div class="panel-heading" align="right">
                      <h4 class="panel-title">
                        <span style="float: left">Epigenetic Marks</span>
                        <a class="btn btn-xs btn-default accordion-toggle" role="button" data-toggle="collapse" data-parent="#epigenetic_marks-panel" href="#epigenetic_marks-spill" id="epigenetic_marks-bttn" onclick="toggleButton(this.id)">+</a>
                      </h4>
                    </div>
                    <div class="list-group" name="experiment-epigenetic_mark" id="epigenetic_marks-main"></div>
                    <ul class="list-group panel-collapse collapse out" name="experiment-epigenetic_mark" id="epigenetic_marks-spill"></ul>
                  </div>
                </div>
                <div class="panel-group" id="biosources-panel">
                  <div class="panel panel-default">
                    <div class="panel-heading" align="right">
                      <h4 class="panel-title">
                        <span style="float: left">Biosources</span>
                        <a class="btn btn-xs btn-default accordion-toggle" role="button" data-toggle="collapse" data-parent="#biosources-panel" href="#biosources-spill" id="biosources-bttn" onclick="toggleButton(this.id)">+</a>
                      </h4>
                    </div>
                    <div class="list-group" name="experiment-biosource" id="biosources-main"></div>
                    <ul class="list-group panel-collapse collapse out" name="experiment-biosource" id="biosources-spill"></ul>
                  </div>
                </div>
                <div class="panel-group" id="techniques-panel">
                  <div class="panel panel-default">
                    <div class="panel-heading" align="right">
                      <h4 class="panel-title">
                        <span style="float: left">Techniques</span>
                        <a class="btn btn-xs btn-default accordion-toggle" role="button" data-toggle="collapse" data-parent="#techniques-panel" href="#techniques-spill" id="techniques-bttn" onclick="toggleButton(this.id)">+</a>
                      </h4>
                    </div>
                    <div class="list-group" name="experiment-technique" id="techniques-main"></div>
                    <ul class="list-group panel-collapse collapse out" name="experiment-technique" id="techniques-spill"></ul>
                  </div>
                </div>
                <div class="panel-group" id="projects-panel">
                  <div class="panel panel-default">
                    <div class="panel-heading" align="right">
                      <h4 class="panel-title">
                        <span style="float: left">Projects</span>
                        <a class="btn btn-xs btn-default accordion-toggle" role="button" data-toggle="collapse" data-parent="#projects-panel" href="#projects-spill" id="projects-bttn" onclick="toggleButton(this.id)">+</a>
                      </h4>
                    </div>
                    <div class="list-group" name="experiment-project" id="projects-main"></div>
                    <ul class="list-group panel-collapse collapse out" name="experiment-project" id="projects-spill"></ul>
                  </div>
                </div>
              </div>
              <div class="col-md-9">
                <div id="experiment-column"></div>
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
  <div class="alert alert-info alert-block" id="selection-banner">
    <h4 class="alert-heading">Selected experiments</h4>
    Click the row to unselect an experiment. It will be removed from the data table. Click <i>Download</i> to specify options for downloading the regions.
  </div>

  <div class="row" id="selection-table">
    <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
      <div class="jarviswidget jarviswidget-color-blueDark" id="datable-selected-experiments" data-widget-editbutton="false" data-widget-deletebutton="false" data-widget-colorbutton="false" data-widget-togglebutton="false">

        <header>
          <span class="widget-icon"> <i class="fa fa-table"></i> </span>
          <h2>Selected experiment(s) </h2>

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

            <table id="datatable_selected_column" name='experiment-table' class="table table-striped table-bordered table-hover" width="100%">
              <thead>
              <tr>
                <th class="hasinput">
                  <input class="form-control" placeholder="ID" type="text" id="experiment-id2">
                </th>

                <th class="hasinput" style="width:20px">
                  <input type="text" class="form-control" placeholder="Experiment" id="experiment-name2" />
                </th>
                <th class="hasinput" style="width:20px">
                  <input type="text" class="form-control" placeholder="Type" id="experiment-datatype2" />
                </th>
                <th class="hasinput">
                  <input type="text" class="form-control" placeholder="Description" id="experiment-description2" />
                </th>
                <th class="hasinput">
                  <input type="text" class="form-control" placeholder="Genome" id="experiment-genome2" />
                </th>
                <th class="hasinput">
                  <input type="text" class="form-control" placeholder="Epigenetic mark" id="experiment-epigenetic_mark2" />
                </th>
                <th class="hasinput">
                  <input type="text" class="form-control" placeholder="Biosource" id="experiment-biosource2" />
                </th>
                <th class="hasinput">
                  <input type="text" class="form-control" placeholder="Sample" id="experiment-sample2" />
                </th>
                <th class="hasinput">
                  <input type="text" class="form-control" placeholder="Technique" id="experiment-technique2" />
                </th>
                <th class="hasinput">
                  <input type="text" class="form-control" placeholder="Project" id="experiment-project2" />
                </th>
                <th class="hasinput">
                  <input type="text" class="form-control" placeholder="Meta data" id="experiment-metadata2" />
                </th>
              </tr>
              <tr>
                <th>ID</th>
                <th>Experiment Name</th>
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
            <div class="downloadButtonDiv"><button type="button" id="downloadBtnBottom" class="btn btn-primary" disabled><i class="fa fa-forward"></i> Download</button></div>
          </div>
          <!-- end widget content -->
        </div>
        <!-- end widget div -->
      </div>
      <!-- end widget -->
    </article>
  </div>
</section>
<!-- end widget grid -->

<script type="text/javascript">

  var selected = [];
  var list_in_use;
  var experiments;
  var filters = {};
  var filter_active = false;
  var vocabnames = ["projects","genomes", "techniques", "epigenetic_marks", "biosources", "types"];
  var vocabids = ['experiment-project','experiment-genome', "experiment-technique", "experiment-epigenetic_mark", "experiment-biosource", "experiment-datatype"];
  var cell_colors = {'BLUEPRINT Epigenome': 'lightblue','DEEP': 'lightgoldenrodyellow','ENCODE': 'lavender', 'Roadmap Epigenomics': 'lightsteelblue', 'others': 'lightskyblue'};
  var size_main = 4;
  var defaults = {};
  var selectedData = []; // selected experiment
  var selectedCount = {}; // selected experiment counter
  var selected = [];
  var otable;
  var otable2;

  pageSetUp();

  function clearSelections() {
    // clear list selection
    if (filter_active) {
      $("#experiment-column").empty();

      init();
      clearList();

      // reload filter data
      filter_active = false;
      list_in_use = JSON.parse(localStorage.getItem('list_in_use'));
      if (list_in_use == null) {
        pullData();
      }
      else {
        initFilters(false);
      }
    }
    $("#clearBtn").attr('disabled', 'disabled');

    otable2.clear().draw();

    selected = [];
    selectedCount = {};
    selectedData = [];
  }

  function selectAll() {
    swal(
        {
          title: "Are you sure?",
          text: "Selecting all elements may take some loading time.",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#DD6B55",
          confirmButtonText: "Yes, select all!",
          closeOnConfirm: true
        },
        function(){
          init();
          clearList();

          // reload filter data
          list_in_use = JSON.parse(localStorage.getItem('list_in_use'));
          filter_active = true;

          initFilters(true);
          loadExperiments();
          fillFilter();

          $("#selectAllBtn").attr('disabled', 'disabled');
        }
    );
  }

  function fillFilter() {
    for (i in vocabnames) {
      var vocabname = vocabnames[i];
      var vocabid = vocabids[i];

      var currentvocab = list_in_use[vocabname]['amt'];

      for (j in currentvocab) {
        filters[vocabid].push(currentvocab[j][1])
      }
    }
  }

  function init() {
    for (i in vocabids) {
      filters[vocabids[i]] = [];
    }
  }

  function getDefaultsDataTypes() {
    return ['peaks'];
  }

  function getDefaultsEpigeneticMarks() {
    return ['H3K4me3','H3K9me3','H3K27me3','H3K36me3','H3K4me1','H3K27ac','Input','DNA Methylation','CTCF','DNaseI','RNA','mRNA'];
  }

  function pullData() {
    var request1 = $.ajax({
      url: "ajax/server_side/faceting_experiments.php",
      type : "POST",
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
      list_in_use = data[0];
      if (filter_active) {
        loadFilters();
        loadExperiments();
      }
      else {
        localStorage.setItem("list_in_use", JSON.stringify(data[0]));
        initFilters(false);
        toggleDefaults();
      }
    });

    request1.fail(function (jqXHR, textStatus) {
      console.log(jqXHR);
      console.log('Error: ' + textStatus);
      alert("Encountered an error. Please wait a few seconds and reload page. If problem persist, kindly log a complaint");
    });
  }

  function loadExperiments() {

    $("#experiment-column").empty();
    $("#experiment-column").append("<img src='../img/loader2.gif' >");

    $('#clearBtn').attr('disabled', 'disabled');
    $('#selectAllBtn').attr('disabled', 'disabled');

    var request2 = $.ajax({
      url: "api/grid",
      type: "POST",
      dataType: "JSON",
      data : {
        request : filters,
        key : "<?php echo $user_key ?>",
      }
    });

    request2.done( function(data) {
      // store data in local storage
      if ("error" in data) {
        swal({
          title: "Error listing experiments",
          text: data['message']
        });
        return;
      }

      //show experiments
      showExperiments(data);
    });

    request2.fail( function(jqXHR, textStatus) {
      console.log(jqXHR);
      console.log('Error: '+ textStatus);
      alert( "Encountered an error. Please wait a few seconds and reload page. If problem persist, kindly log a complaint" );
    });
  }

  function showExperiments(data) {
    // show experiment in the right column
    var table_rows = data['cell_biosources'].length;
    var table_columns = data['cell_epigenetic_marks'].length;

    var table_str = "<table class='table table-striped table-bordered table-condensed' id='grid'>";

    table_str = table_str + "<thead><th></th>";
    for (j = 0; j < table_columns; j++) {
      table_str = table_str + "<th>"  + data['cell_epigenetic_marks'][j] + "</th>";
    }
    table_str = table_str + "</thead>";

    table_str = table_str + "<tbody>";
    for (i=0; i<table_rows; i++) {
      var bio = data['cell_biosources'][i];
      selectedCount[bio] = {};

      table_str = table_str + "<tr id='" + bio + "'>";
      table_str = table_str + "<td scope='row' style='border-width: 1px; cursor: pointer;'><b>"  + data['cell_biosources'][i] + "</b></td>";
      for (j=0; j<table_columns; j++) {
        var epi = data['cell_epigenetic_marks'][j];
        var cell_count = data['cell_experiment_count'][bio][epi];

        var cell_project = data['cell_projects'][bio][epi];
        var project_color = "white";
        if (cell_project != "") {
          project_color = cell_colors[cell_project];
        }
        table_str = table_str + "<td id='" + epi + "' style='background:" + project_color + "; border-width: 1px; cursor: pointer;' data-row='" + bio + "' data-col='" + epi + "'>"  + cell_count + "</td>";
        selectedCount[bio][epi] = 0; // selected experiment counter
      }
      table_str = table_str + "</tr>";
    }
    table_str = table_str + "</tbody>";
    table_str = table_str + "</table>";

    $("#experiment-column").empty();
//    debugger;
    $("#experiment-column").append(table_str);

    otable = $('#grid').DataTable({
      "iDisplayLength": 1000,
      "aoColumnDefs": [
        { "bSortable": true, "aTargets": "_all" }
      ]
    });

    $("#grid td").click(function(event){

      var cell = $(this);
      var epi = cell.attr('data-col');
      var bio = cell.attr('data-row');

//      debugger;

      if (data['cell_experiment_count'][bio] == undefined) {
        return;
      }

      if (data['cell_experiment_count'][bio][epi] == 0) {
        return;
      }

      if ($(cell).hasClass("selected-grid-cell") || $(cell).hasClass("unselected-grid-cell")) {

        var experiments = data['cell_experiments'][bio][epi];
        for (e in experiments) {
          var experiment = experiments[e];
          var experiment_id = experiment[0];

          var index = selected.indexOf(experiment_id);
          if (index > -1) {
            selected.splice(index, 1);
            selectedData.splice(index,1);

            $('#datatable_selected_column').dataTable().fnDeleteRow(index);
          }
        }
        selectedCount[bio][epi] = 0;
        $(cell).removeClass("selected-grid-cell");
        $(cell).removeClass("unselected-grid-cell");
      }
      else {
        $(cell).addClass("selected-grid-cell");
        var experiments = data['cell_experiments'][bio][epi];
        for (e in experiments) {
          var experiment = experiments[e];
          var experiment_id = experiment[0];

          if (selected.indexOf(experiment_id) < 0) {
            selected.push(experiment_id);
            selectedData.push(experiment);
            $('#datatable_selected_column').dataTable().fnAddData(experiment);

            selectedCount[bio][epi] = selectedCount[bio][epi] + 1;
          }
        }
      }

      if (selectedData.length > 0) {
        $('#downloadBtnBottom').removeAttr('disabled');
      }
      else {
        $('#downloadBtnBottom').attr('disabled','disabled');
      }
    });

    $('#clearBtn').removeAttr('disabled');
    $('#selectAllBtn').removeAttr('disabled');
  }

  function addToList(list_id, element, badge, active) {

    // build required variables
    var elem_id = element;
    var badge_id = element + "_badge_id";
    var style_string = "";

    if (list_id == "#projects-spill" || list_id == "#projects-main") {
      // include colors legend
      style_string =  "style='background-color: " + cell_colors[element] + "'";
    }

    if (active) {
      var elem_string = "<a class='list-group-item active' id='" + elem_id + "' onclick='selectHandler(this, true)'><span class='badge' " + style_string + " id='" +
          badge_id + "'>" + badge + "</span>" + element + "</a>";
    }
    else {
      var elem_string = "<a class='list-group-item' id='" + elem_id + "' onclick='selectHandler(this, true)'><span class='badge' " + style_string + " id='" +
          badge_id + "'>" + badge + "</span>" + element + "</a>";
    }

    $(elem_string).appendTo(list_id);
  }

  function emulateClick(id, pull_data) {
    var elements = $("a[id='"+id+"']");
    if (elements.length == 0) {
      return;
    }
    selectHandler(elements[0], pull_data);
  }

  function selectHandler(e, pull_data) {
    filter_active = true;

    var selList = $(e).parent(".list-group").attr('name');
    var selElemName = e.id;

    if ($(e).hasClass('active')) {
      var ind = filters[selList].indexOf(selElemName);
      $(e).removeClass('active');
      filters[selList].splice(ind, 1);
    }
    else {
      filters[selList].push(selElemName);
    }

    // update filter, pull data and prepend selections
    if (pull_data) {
      pullData();
    }
  }

  function removeSelectedElements(selectedElem) {
    for (e in selectedElem) {
      removeListElement(selectedElem[e]);
    }
  }

  function removeListElement(elem_id) {
    $("#"+elem_id).remove();
  }

  function clearListByName(listname) {
    $("[name='" + listname + "']").empty();
  }

  function clearList() {
    $(".list-group").empty();
  }

  function loadFilters() {

    for (i in vocabnames) {
      var vocabname = vocabnames[i];
      var vocabid = vocabids[i];
      var filtered_elements = [];

      var currentvocab1 = list_in_use[vocabname]['amt'];
      var currentvocab_size1 = currentvocab1.length;

      var list_id_spill = "#" + vocabname + "-spill";
      var list_id_main  = "#" + vocabname + "-main";

      // clear previous content
      clearListByName(vocabid);

      // add returned results to list
      for(j=currentvocab_size1-1; j >= 0; j--) {
        var currentElem1 = currentvocab1[j][1];
        var currentBadge1 = currentvocab1[j][2];
        var active = false;

        filtered_elements.push(currentElem1);
        if (filters[vocabid].indexOf(currentElem1) >= 0) {
          active = true;
        }

        if (j < currentvocab_size1 - size_main) {
          // use spill list
          addToList(list_id_spill, currentElem1 , currentBadge1, active);
        }
        else {
          addToList(list_id_main, currentElem1 , currentBadge1, active);
        }
      }

      var list_in_use_main = JSON.parse(localStorage.getItem('list_in_use'));
      var currentvocab2 = list_in_use_main[vocabname]['alp'];
      var currentvocab_size2 = currentvocab2.length;

      // add filtered results to list with count of 0
      var k = 0;
      for (j in currentvocab2) {
        var currentElem2 = currentvocab2[j][1];
        var active = false;
        if ($.inArray(currentElem2, filtered_elements) < 0) {
          // for the case where the filtering returns empty results hence even the filter selected is not returned
          if ($.inArray(currentElem2, filters[vocabid]) >= 0) {
            active = true;
          }
          if (k + currentvocab_size1 < size_main) {
            // use main list
            addToList(list_id_main, currentElem2 , 0, active);
            k++;
          }
          else {
            // use spill list
            addToList(list_id_spill, currentElem2 , 0, active);
            k++;
          }
        }
      }
    }
  }

  function initFilters(active) {

    for (i in vocabnames) {
      var vocabname = vocabnames[i];

      var currentvocab = list_in_use[vocabname]['amt'];
      var currentvocab_size = currentvocab.length;

      var list_id_spill = "#" + vocabname + "-spill";
      var list_id_main  = "#" + vocabname + "-main";

      for(j=currentvocab_size-1; j >= 0; j--) {
        var currentElem = currentvocab[j][1];
        var currentBadge = currentvocab[j][2];

        if (j < currentvocab_size - size_main) {
          // use spill list
          addToList(list_id_spill, currentElem , currentBadge, active);
        }
        else {
          addToList(list_id_main, currentElem , currentBadge, active);
        }
      }
    }
  }

  function toggleDefaults() {
    var default_epigenetic_marks = getDefaultsEpigeneticMarks();
    var default_datatypes = getDefaultsDataTypes();

    for (var d in default_datatypes) {
      emulateClick(default_datatypes[d], false);
    }

    for (var d in default_epigenetic_marks) {
      emulateClick(default_epigenetic_marks[d], d == default_epigenetic_marks.length - 1);
    }
  }

  function toggleButton(id) {
    $("#"+id).text(function(i,old){
        return old=='+' ?  '-' : '+';
      });
  }

  var pagefunction = function() {

    init();

    list_in_use = JSON.parse(localStorage.getItem('list_in_use'));
    if (list_in_use == null) {
      pullData();
    }
    else {
      initFilters(false);
      toggleDefaults();
    }

    // selected datatable
    otable2 = $('#datatable_selected_column').DataTable({
      "scrollX": true
    });

    $("#experiment-id2, #experiment-name2, #experiment-datatype2, #experiment-epigenetic_mark2, #experiment-project2, " +
        "#experiment-biosource2, #experiment-sample2, #experiment-technique2, #experiment-genome2, #experiment-metadata2, " +
        "#experiment-description2").on('keyup change', function () {
      otable2
          .column( $(this).parent().index()+':visible' )
          .search( this.value )
          .draw();
    });

    /* remove selection by clicking of row in the selection table*/
    $('#datatable_selected_column').on('click', 'tr', function () {
      var id = $('td', this).eq(0).text();
      if (id ==  "") {
        return;
      }
      var bio = $('td', this).eq(6).text();
      var epi = $('td', this).eq(5).text();

      selectedCount[bio][epi] = selectedCount[bio][epi] - 1;
      var current_cell = otable.cells(
          function ( idx, data, node ) {
            if(($(node).attr('data-row') == bio) && ($(node).attr('data-col') == epi)) {
              return true;
            }
            return false;
          }
      ).nodes();
      current_cell.to$().removeClass("selected-grid-cell");

      if (selectedCount[bio][epi] != 0) {
        current_cell.to$().addClass("unselected-grid-cell");
      }
      else {
        current_cell.to$().removeClass("unselected-grid-cell");
      }

      var index = selected.indexOf(id);
      selected.splice(index,1);
      selectedData.splice(index,1);

      $('#datatable_selected_column').dataTable().fnDeleteRow(index);

      if (selectedData.length == 0) {
        $('#downloadBtnBottom').attr('disabled','disabled');
      }
    });

    $("#datatable_selected_column").on("click", '.exp-metadata-more-view', function (e) {
      var toggle = $(this).text();
      if (toggle == "-- Hide --") {
        $(this).prev().hide(10);
        $(this).text("-- View metadata --");
      }
      else {
        $(this).prev().show(10);
        $(this).text("-- Hide --");
      }

      e.stopPropagation();
    });

    /* Show Options button */
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
            loadScript("js/plugin/datatable-responsive/datatables.responsive.min.js", pagefunction)
          });
        });
      });
    });
  });

</script>