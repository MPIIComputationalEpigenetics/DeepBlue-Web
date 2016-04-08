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
  <div class="row" id="main-view">

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
            <div class="alert alert-info alert-block" id="main-banner">
              <a class="close" data-dismiss="alert" href="#">×</a>
              <h6 class="alert-heading">Information</h6>
              Use the filter on the left hand side to select the experiment vocabulary. By default, common epigenetic marks have been selected.
              Using the filter would change the content of the grid on the left hand side.<br>
              The number in each square indicates the number of experiments returned by your filter. You can click on to select the experiments for download.
              Selected experiments are shown at the buttom of the page. Clicking on experiments will remove that single experiment.
              Click Download to download the selected experiments
              <h6 class="alert-heading">Legend</h6>
            </div>
            <div class="row">
              <div class="col-md-3">
                <div>
                  <button type="submit" id="clearBtn" class="btn btn-default" onClick="clearSelections()" disabled> Clear All </button>
                  <button type="submit" id="selectAllBtn" class="btn btn-primary" onClick="selectAll()" disabled> Select All </button>
                </div>
                <hr>
                <br>
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
                <div class="panel-group" id="types-panel">
                  <div class="panel panel-default">
                    <div class="panel-heading" align="right">
                      <h4 class="panel-title">
                        <span style="float: left">Datatypes</span>
                        <a class="btn btn-xs btn-default accordion-toggle" role="button" data-toggle="collapse" data-parent="#types-panel" href="#types-spill" id="types-bttn" onclick="toggleButton(this.id)">+</a>
                      </h4>
                    </div>
                    <div class="list-group" name="experiment-datatype" id="types-main"></div>
                    <ul class="list-group panel-collapse collapse out" name="experiment-datatype" id="types-spill"></ul>
                  </div>
                </div>
              </div>
              <div class="col-md-9">
                <br>
                <br>
                <br>
                <div id="experiment-column" style="overflow-x: scroll;">
                </div>
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
  var size_main = 4;
  var defaults = {};
  var selectedData = [];
  var selected = [];

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
  }

  function selectAll() {
    swal(
        {
          title: "Are you sure?",
          text: "Selecting all filter will take some time to load the grid!",
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

  function getDefaultsEpigeneticMarks() {
    return ['H3K4me3','H3K9me3','H3K27me3','H3K36me3','H3K4me1','H3K27ac','Input','DNA Methylation','CTCF','DNaseI','RNA','mRNA'];
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
      list_in_use = data[0];
      if (filter_active) {
        localStorage.setItem("list_in_use_filter", JSON.stringify(data[0]));
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
    var request2 = $.ajax({
      url: "api/grid",
      data : {
        request : filters,
        key : "<?php echo $user_key ?>"
      },
      dataType: "json"
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


    var cell_colors = {'BLUEPRINT Epigenome': 'lightblue','DEEP': 'lightgoldenrodyellow','ENCODE': 'lavender', 'Roadmap Epigenomics': 'lightsteelblue', 'others': 'lightskyblue'};

    var table_str = "<table class='table table-striped table-condensed' id='grid'>";
    for (i=-1; i<table_rows; i++) {
      var bio = "";
      if (i < 0) {
        table_str = table_str + "<thead>";
      }
      else{
        bio = data['cell_biosources'][i];
      }

      table_str = table_str + "<tr id='" + bio + "'>";
      for (j=-1; j<table_columns; j++) {
        if (i<0 && j< 0) {
          table_str = table_str + "<th></th>";
        }
        else if (i < 0) {
          table_str = table_str + "<th>"  + data['cell_epigenetic_marks'][j] + "</th>";
        }
        else if (j < 0) {
          table_str = table_str + "<th scope='row'>"  + data['cell_biosources'][i] + "</th>";
        }
        else {
          var epi = data['cell_epigenetic_marks'][j];
          var cell_count = data['cell_experiment_count'][bio][epi];

          var cell_project = data['cell_projects'][bio][epi];
          var project_color = "white";
          if (cell_project != "") {
            project_color = cell_colors[cell_project];
          }
          table_str = table_str + "<td id='" + epi + "' style='background:" + project_color + "'><span data-row='" + bio + "' data-col='" + epi + "'>"  + cell_count + "</span></td>";
        }
      }
      table_str = table_str + "</tr>";
      if (i < 0) {
        table_str = table_str + "</thead>";
      }
    }
    table_str = table_str + "</table>";

    $("#experiment-column").empty();
    $("#experiment-column").append(table_str);

    $("#grid td").click(function(event){

      var cell = $(this).children('span');
      var epi = cell.attr('data-col');
      var bio = cell.attr('data-row');

      $(this).addClass('success');

      var experiments = data['cell_experiments'][bio][epi];
      for (e in experiments) {
        var experiment = experiments[e];
        var experiment_id = experiment[0];

        if (selected.indexOf(experiment_id) < 0) {
          selected.push(experiment_id);
          selectedData.push(experiment);
          $('#datatable_selected_column').dataTable().fnAddData(experiment);
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

    if (active) {
      var elem_string = "<a class='list-group-item active' id='" + elem_id + "' onclick='selectHandler(this, true)'><span class='badge' id='" +
          badge_id + "'>" + badge + "</span>" + element + "</a>";
    }
    else {
      var elem_string = "<a class='list-group-item' id='" + elem_id + "' onclick='selectHandler(this, true)'><span class='badge' id='" +
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
    var otable2 = $('#datatable_selected_column').DataTable({
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

      var index = selected.indexOf(id);
      selected.splice(index,1);
      selectedData.splice(index,1);

      // TODO
      $('#datatable_selected_column').dataTable().fnDeleteRow(index);
      //var rowId = otable.columns(0).data().eq(0).indexOf(id);
      //otable.row(rowId).nodes().to$().removeClass("success");

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