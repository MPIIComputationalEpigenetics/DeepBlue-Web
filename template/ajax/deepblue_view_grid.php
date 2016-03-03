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
 *   Created : 05-08-2015
 *
 *   ================================================
 *
 *   File : deepblue_view_info.php
 *
 */

require_once("../lib/lib.php");
require_once("inc/init.php");

?>

<div class="row">
  <div class="col-md-3">
    <div class="form-group hidden">
      <label for="userkey" id="usekey-label">User key</label>
      <input class="form-control" type="text" id="userkey" name="userkey" disabled value="mk8xHba3tqpeRPy4">
    </div>
    <h1 class="txt-color-red login-header-big">Command</h1>
    <hr/>
    <div class="radio">
      <label>
        <input type="radio" name="options" id="listexperiment" value="1" checked onChange="toggle_commands()"> List All Experiments
      </label>
    </div>
    <div class="radio">
      <label>
        <input type="radio" name="options" id="listinuse" value="2" onChange="toggle_commands()"> List All Terms
      </label>
    </div>
    <hr/>
    <div id="command1" style="display:none">
      <div class="form-group">
        <label for="vocabulary" id="vocab-label">Controlled Vocabulary</label>
        <select class="form-control" id="vocabulary" name="vocabulary">
          <option value="genomes" selected>Genomes</option>
          <option value="epigenetic_marks">Epigenetic Marks</option>
          <option value="biosources">BioSources</option>
          <option value="techniques">Techniques</option>
          <option value="projects">Projects</option>
        </select>
      </div>
    </div>
    <div id="command2">
      <div class="form-group">
        <label for="genome" id="genome-label">Genome</label>
        <select class="form-control" id="genome" name="genome">
          <option value="">None</option>
        </select>
      </div>

      <div class="form-group">
        <label for="epigenetic" id="epigenetic-label">Epigenetic Mark</label>
        <select class="form-control" id="epigenetic" name="epigenetic">
          <option value="" selected>None</option>
        </select>
      </div>
      <div class="form-group">
        <label for="biosource" id="sample-label">Biosource</label>
        <select class="form-control" id="biosource" name="biosource">
          <option value="" selected>None</option>
        </select>
      </div>
      <div class="form-group">
        <label for="sample" id="sample-label">Sample</label>
        <select class="form-control" id="sample" name="sample">
          <option value="" selected>None</option>
        </select>
      </div>
      <div class="form-group">
        <label for="technique" id="technique-label">Technique</label>
        <select class="form-control" id="technique" name="technique">
          <option value="" selected>None</option>
        </select>
      </div>
      <div class="form-group">
        <label for="project" id="project-label">Project</label>
        <select class="form-control" id="project" name="project">
          <option value="" selected>None</option>
        </select>
      </div>
    </div>
    <div>
      <button type="submit" class="btn btn-primary" onClick="filter()"> Submit </button>
    </div>
  </div>
  <div class="col-md-9">
    <h1 class="txt-color-red login-header-big">Results</h1>
    <hr/>
    <div id="container">
    </div>
  </div>
</div>
<hr>
<p id="version"></p>


<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="js/mimic.js"></script>
<script src="js/Chart.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>


<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<script src="js/ie10-viewport-bug-workaround.js"></script>