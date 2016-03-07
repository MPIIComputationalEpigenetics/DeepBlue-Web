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
                        <a class="btn btn-xs btn-primary accordion-toggle" role="button" data-toggle="collapse" data-parent="#genomes-panel" href="#genomes-spill" id="genomes-bttn" onclick="toggleButton(this.id)">+</a>
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
                        <a class="btn btn-xs btn-primary accordion-toggle" role="button" data-toggle="collapse" data-parent="#epigenetic_marks-panel" href="#epigenetic_marks-spill" id="epigenetic_marks-bttn" onclick="toggleButton(this.id)">+</a>
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
                        <a class="btn btn-xs btn-primary accordion-toggle" role="button" data-toggle="collapse" data-parent="#biosources-panel" href="#biosources-spill" id="biosources-bttn" onclick="toggleButton(this.id)">+</a>
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
                        <a class="btn btn-xs btn-primary accordion-toggle" role="button" data-toggle="collapse" data-parent="#techniques-panel" href="#techniques-spill" id="techniques-bttn" onclick="toggleButton(this.id)">+</a>
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
                        <a class="btn btn-xs btn-primary accordion-toggle" role="button" data-toggle="collapse" data-parent="#projects-panel" href="#projects-spill" id="projects-bttn" onclick="toggleButton(this.id)">+</a>
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
                        <a class="btn btn-xs btn-primary accordion-toggle" role="button" data-toggle="collapse" data-parent="#types-panel" href="#types-spill" id="types-bttn" onclick="toggleButton(this.id)">+</a>
                      </h4>
                    </div>
                    <div class="list-group" name="experiment-datatype" id="types-main"></div>
                    <ul class="list-group panel-collapse collapse out" name="experiment-datatype" id="types-spill"></ul>
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
  var list_in_use;
  var filters = {};
  var filter_active = false;
  var vocabnames = ["projects","genomes", "techniques", "epigenetic_marks", "biosources", "types"];
  var vocabids = ['experiment-project','experiment-genome', "experiment-technique", "experiment-epigenetic_mark", "experiment-biosource", "experiment-datatype"];

  pageSetUp();

  function clearSelections() {
    // clear list selection
    init();
    clearList();

    // reload filter data
    list_in_use = JSON.parse(localStorage.getItem('list_in_use'));
    loadFilters();
  }

  function init() {
    for (i in vocabids) {
      filters[vocabids[i]] = [];
    }
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

  function addToList(list_id, element, badge, active) {

    // build required variables
    var elem_id = element;
    var badge_id = element + "_badge_id";

    if (active) {
      var elem_string = "<a class='list-group-item active' id='" + elem_id + "' onclick='selectHandler(this)'><span class='badge' id='" +
          badge_id + "'>" + badge + "</span>" + element + "</a>";
    }
    else {
      var elem_string = "<a class='list-group-item' id='" + elem_id + "' onclick='selectHandler(this)'><span class='badge' id='" +
          badge_id + "'>" + badge + "</span>" + element + "</a>";
    }

    $(elem_string).prependTo(list_id);
  }

  function selectHandler(e) {
    filter_active = true;

    var selList = $(e).parent(".list-group").attr('name');
    var selElemName = e.id;

    if ($(e).hasClass('active')) {
      var ind = filters[selList].indexOf(selElemName);
      $(e).removeClass('active')
      filters[selList].splice(ind);
    }
    else {
      filters[selList].push(selElemName);
    }

    // update filter, pull data and prepend selections
    pullData();

    //clear all the other lists ->clear other list badge
    //TODO: remove segment
    for (i in vocabids) {
      var vocabid = vocabids[i];
      if (vocabid != selList) {
        clearListByName(vocabid);
      }
    }

    // remove current selection
    removeSelectedElements(filters[selList]);
    if (filters[selList].length == 0) {
      clearListByName(selList);
    }

    // set badges to zero
    clearListBadge();
  }

  function removeSelectedElements(selectedElem) {
    for (e in selectedElem) {
      removeListElement(selectedElem[e]);
    }
  }

  function removeListElement(elem_id) {
    $("#"+elem_id).remove();
  }

  function clearListBadge() {
    // set the badge count of all list element to zero
    $(".badge").text(0);
    $(".badge").parent(".list-group-item").off('click');
  }

  function clearListByName(listname) {
    $("[name='" + listname + "']").empty();
  }

  function clearList() {
    $(".list-group").empty();
  }

  function loadFilters() {
    var size_main = 4;

    for (i in vocabnames) {
      var vocabname = vocabnames[i];
      var vocabid = vocabids[i];

      var currentvocab = list_in_use[vocabname]['amt'];
      var currentvocab_size = currentvocab.length;

      var list_id_spill = "#" + vocabname + "-spill";
      var list_id_main  = "#" + vocabname + "-main";

      for (j in currentvocab) {
        var currentElem = currentvocab[j][1];
        var currentBadge = currentvocab[j][2]
        var active = false;

        if (filters[vocabid].indexOf(currentElem) >= 0) {
          active = true;
        }

        if (j < currentvocab_size - size_main) {
          // use spill list
          addToList(list_id_spill, currentElem , currentBadge, active);
        }
        else {
          addToList(list_id_main, currentvocab[j][1] , currentvocab[j][2], active);
        }
      }
    }
  }

  function initFilters() {

    var size_main = 4;
    for (i in vocabnames) {
      var vocabname = vocabnames[i];

      var currentvocab = list_in_use[vocabname]['amt'];
      var currentvocab_size = currentvocab.length;

      var list_id_spill = "#" + vocabname + "-spill";
      var list_id_main  = "#" + vocabname + "-main";

      for (j in currentvocab) {
        var currentElem = currentvocab[j][1];
        var currentBadge = currentvocab[j][2]
        if (j < currentvocab_size - size_main) {
          // use spill list
          addToList(list_id_spill, currentElem , currentBadge, false);
        }
        else {
          addToList(list_id_main, currentvocab[j][1] , currentvocab[j][2], false);
        }
      }
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
      initFilters();
    }
  }

  // load script
  pagefunction();

</script>