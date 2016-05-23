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