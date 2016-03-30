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
        initFilters();
      }
    }
  }

  function init() {
    for (i in vocabids) {
      filters[vocabids[i]] = [];
    }
  }

  function getDefaultsEpigeneticMarks() {
    return [];//'H3K4me3','H3K9me3','H3K27me3','H3K36me3','H3K4me1','H3K27ac','Input','DNA Methylation','CTCF','DNaseI','RNA','mRNA'];
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
        initFilters();
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

    var table_str = "<table class='table table-striped table-condensed'>";
    for (i=-1; i<table_rows; i++) {
      if (i < 0) {
        table_str = table_str + "<thead>";
      }
      table_str = table_str + "<tr>";
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
          var bio = data['cell_biosources'][i];
          var epi = data['cell_epigenetic_marks'][j];
          var cell_count = data['cell_experiment_count'][bio][epi];

          var cell_project = data['cell_projects'][bio][epi];
          var project_color = "";
          if (cell_project != "") {
            project_color = cell_colors[cell_project];
          }
          table_str = table_str + "<td style='background:" + project_color + "'>"  + cell_count + "</td>";
        }
      }
      table_str = table_str + "</tr>";
      if (i < 0) {
        table_str = table_str + "</thead>";
      }
//      else {
//        table_str = table_str + "</tbody>";
//      }
    }
    table_str = table_str + "</table>";
    //table_str = table_str + "</tbody><table>";

    $("#experiment-column").empty();
    $("#experiment-column").append(table_str);
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
    var element = $("a[id='"+id+"']")[0];
    selectHandler(element, pull_data);
  }

  function selectHandler(e, pull_data) {
    filter_active = true;

    var selList = $(e).parent(".list-group").attr('name');
    var selElemName = e.id;

    if ($(e).hasClass('active')) {
      var ind = filters[selList].indexOf(selElemName);
      $(e).removeClass('active')
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

  function initFilters() {

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
          addToList(list_id_spill, currentElem , currentBadge, false);
        }
        else {
          addToList(list_id_main, currentElem , currentBadge, false);
        }
      }
    }

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
      loadFilters();
      loadExperiments();
    }
  }

  // load script
  pagefunction();

</script>