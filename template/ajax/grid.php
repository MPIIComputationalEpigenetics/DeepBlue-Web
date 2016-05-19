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
<!--                <a class="close" data-dismiss="alert" href="#">×</a>-->
                The grid displays the experiments that match the selected metadata. Fell free to select the metadata attributes that better suits you.</br>
                The value in the grid cells represent the number of experiments that match selected metadata, <i>Epigenetic Mark</i> (column), and <i>BioSource</i> (row).</br>
                Click on a grid cell to select the experiments associated with this cell. The selected experiments are listed in the end of this page.</br>
                Double click on the grid cells with <i>BioSource</i> name to select all experiments of this <i>BioSource</i>.</br>
                For downloading the data, click in the <i>Download</i> button in the end of the page. You will be redirected to the download page.</br>
              </div>
            </div>

            <div class="col-md-3">
              <div>
                <button type="submit" id="clearBtn" class="btn btn-default" onClick="clearSelections()" disabled> Clear metadata selection </button>
                <button type="submit" id="selectAllBtn" class="btn btn-default" onClick="selectAll()" disabled> Select all experiments </button>
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