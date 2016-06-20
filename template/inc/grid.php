<div class="row" id="main-view">

  <!-- NEW WIDGET START -->
  <article class="col-sm-12 col-md-12 col-lg-12">

    <!-- Widget ID (each widget will need unique ID)-->
    <div class="jarviswidget jarviswidget-color-blue" id="grid-experiments" data-widget-editbutton="false" data-widget-deletebutton="false" data-widget-colorbutton="false" data-widget-togglebutton="false" data-widget-fullscreenbutton="false">

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

            <div style="padding: 10px">
              <div class="alert alert-info alert-block">
                The grid displays the experiments that match the selected metadata. Feel free to select the metadata attributes that better suits you.</br>
                The value in the grid cells represent the number of experiments that match selected metadata, <i>Epigenetic Mark</i> (column), and <i>BioSource</i> (row).</br>
                Click on a grid cell to select the experiments associated with this cell. The selected experiments are listed in the end of this page.</br>
                Double click on the grid cells with <i>BioSource</i> name to select all experiments of this <i>BioSource</i>.</br>
              </div>
            </div>

            <div class="col-md-3">
              <div>
                <button type="submit" id="clearBtn" class="btn btn-default" onClick="clearSelections()" disabled> Clear metadata selection <i class="fa fa-circle-o"></i> </button>
                <button type="submit" id="selectAllBtn" class="btn btn-default" onClick="selectAll()" disabled> Select all experiments <i class="fa fa-circle"></i> </button>
              </div>
              <hr>
              <br>
              <div class="panel-group" id="types-panel">
                <div class="panel panel-default">
                  <div class="panel-heading" align="right">
                    <h4 class="panel-title">
                      <span style="float: left">Data types <i id="experiment-datatype-i"></i></span>
                      <a class="btn btn-xs btn-default accordion-toggle" role="button" onclick="selectVocab('experiment-datatype')"><i class="fa fa-circle"></i></a>
                      <a class="btn btn-xs btn-default accordion-toggle" role="button" onclick="clearVocab('experiment-datatype')"><i class="fa fa-circle-o"></i></a>
                      <a class="btn btn-xs btn-default accordion-toggle" role="button" data-toggle="collapse" data-parent="#types-panel" href="#types-spill" id="types-bttn" onclick="toggleButton(this.id)"><i class="fa fa-plus-square-o"></i></a>
                    </h4>
                  </div>
                  <div class="list-group" name="experiment-datatype" id="types-main"></div>
                  <ul class="list-group panel-collapse collapse out" name="experiment-datatype" id="types-spill"></ul>
                </div>
              </div>
              <div class="panel-group" id="projects-panel">
                <div class="panel panel-default">
                  <div class="panel-heading" align="right">
                    <h4 class="panel-title">
                      <span style="float: left">Projects <i id="experiment-project-i"></i></span>
                      <a class="btn btn-xs btn-default accordion-toggle" role="button" onclick="selectVocab('experiment-project')"><i class="fa fa-circle"></i></a>
                      <a class="btn btn-xs btn-default accordion-toggle" role="button" onclick="clearVocab('experiment-project')"><i class="fa fa-circle-o"></i></a>
                      <a class="btn btn-xs btn-default accordion-toggle" role="button" data-toggle="collapse" data-parent="#projects-panel" href="#projects-spill" id="projects-bttn" onclick="toggleButton(this.id)"><i class="fa fa-plus-square-o"></i></a>
                    </h4>
                  </div>
                  <div class="list-group" name="experiment-project" id="projects-main"></div>
                  <ul class="list-group panel-collapse collapse out" name="experiment-project" id="projects-spill"></ul>
                </div>
              </div>
              <div class="panel-group" id="genomes-panel">
                <div class="panel panel-default">
                  <div class="panel-heading" align="right">
                    <h4 class="panel-title">
                      <span style="float: left">Genome <i id="experiment-genome-i"></i></span>
                      <a class="btn btn-xs btn-default accordion-toggle" role="button" onclick="selectVocab('experiment-genome')"><i class="fa fa-circle"></i></a>
                      <a class="btn btn-xs btn-default accordion-toggle" role="button" onclick="clearVocab('experiment-genome')"><i class="fa fa-circle-o"></i></a>
                      <a class="btn btn-xs btn-default accordion-toggle" role="button" data-toggle="collapse" data-parent="#genomes-panel" href="#genomes-spill" id="genomes-bttn" onclick="toggleButton(this.id)"><i class="fa fa-plus-square-o"></i></a>
                    </h4>
                  </div>
                  <div class="list-group" name="experiment-genome" id="genomes-main"></div>
                  <ul class="list-group panel-collapse collapse out" name="experiment-genome" id="genomes-spill"></ul>
                </div>
              </div>
              <div class="panel-group" id="epigenetic_marks-panel">
                <div class="panel panel-default">
                  <div class="panel-heading" align="right">
                    <h4 class="panel-title">
                      <span style="float: left">Epigenetic Marks <i id="experiment-epigenetic_mark-i"></i></span>
                      <a class="btn btn-xs btn-default accordion-toggle" role="button" onclick="selectVocab('experiment-epigenetic_mark')"><i class="fa fa-circle"></i></a>
                      <a class="btn btn-xs btn-default accordion-toggle" role="button" onclick="clearVocab('experiment-epigenetic_mark')"><i class="fa fa-circle-o"></i></a>
                      <a class="btn btn-xs btn-default accordion-toggle" role="button" data-toggle="collapse" data-parent="#epigenetic_marks-panel" href="#epigenetic_marks-spill" id="epigenetic_marks-bttn" onclick="toggleButton(this.id)"><i class="fa fa-plus-square-o"></i></a>
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
                      <span style="float: left">Biosources <i id="experiment-biosource-i"></i></span>
                      <a class="btn btn-xs btn-default accordion-toggle" role="button" onclick="selectVocab('experiment-biosource')"><i class="fa fa-circle"></i></a>
                      <a class="btn btn-xs btn-default accordion-toggle" role="button" onclick="clearVocab('experiment-biosource')"><i class="fa fa-circle-o"></i></a>
                      <a class="btn btn-xs btn-default accordion-toggle" role="button" data-toggle="collapse" data-parent="#biosources-panel" href="#biosources-spill" id="biosources-bttn" onclick="toggleButton(this.id)"><i class="fa fa-plus-square-o"></i></a>
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
                      <span style="float: left">Techniques <i id="experiment-technique-i"></i></span>
                      <a class="btn btn-xs btn-default accordion-toggle" role="button" onclick="selectVocab('experiment-technique')"><i class="fa fa-circle"></i></a>
                      <a class="btn btn-xs btn-default accordion-toggle" role="button" onclick="clearVocab('experiment-technique')"><i class="fa fa-circle-o"></i></a>
                      <a class="btn btn-xs btn-default accordion-toggle" role="button" data-toggle="collapse" data-parent="#techniques-panel" href="#techniques-spill" id="techniques-bttn" onclick="toggleButton(this.id)"><i class="fa fa-plus-square-o"></i></a>
                    </h4>
                  </div>
                  <div class="list-group" name="experiment-technique" id="techniques-main"></div>
                  <ul class="list-group panel-collapse collapse out" name="experiment-technique" id="techniques-spill"></ul>
                </div>
              </div>
            </div>
            <div class="col-md-9">
              <div id="experiment-column" style="overflow-y:auto"></div>
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