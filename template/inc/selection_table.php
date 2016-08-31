<div class="modal fade" id="previewModal" tabindex="-1" role="dialog" aria-labelledby="previewModalLabel">
  <div class="modal-dialog">
    <div class="modal-content modalViewSingleInfoShort">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="previewModelLabel">Experiment preview</h4>
      </div>
      <div class="modal-body" >
        <div id='experiment_preview'>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="exportDataModal" tabindex="-1" role="dialog" aria-labelledby="exportDataModalLabel">
  <div class="modal-dialog">
    <div class="modal-content modalViewSingleInfoSmall">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exportDataModelLabel">Export experiment data</h4>
      </div>
      <div class="modal-body" >
        <div>
          <!-- Nav tabs -->
          <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><a href="#r" aria-controls="r" role="tab" data-toggle="tab">R</a></li>
            <li role="presentation"><a href="#python" aria-controls="python" role="tab" data-toggle="tab">Python</a></li>
          </ul>
          <!-- Tab panes -->
          <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="r">
              <br>
              <textarea class="tab_areas" id="r_area" spellcheck="false" readonly></textarea>
            </div>
            <div role="tabpanel" class="tab-pane" id="python">
              <br>
              <textarea class="tab_areas" id="py_area" spellcheck="false" readonly></textarea>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" data-clipboard-target="div.active > textarea">Copy to Clipboard</button>
      </div>
    </div>
  </div>
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
              <th class="hasinput">
                <input type="text" class="form-control" placeholder="Preview" id="experiment-preview2" />
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
              <th>Preview</th>
            </tr>
            </thead>
          </table>
          <div class="downloadButtonDiv">
            <button type="button" id="downloadBtnBottom" class="btn btn-primary" disabled><i class="fa fa-forward"></i> Download</button>
            <button type="button" id="exportBtnBottom" class="btn btn-primary hidden" disabled data-toggle="modal" data-target="#exportDataModal"><i class="fa fa-clipboard" aria-hidden="true"></i> Export data</button>
          </div>
        </div>
        <!-- end widget content -->
      </div>
      <!-- end widget div -->
    </div>
    <!-- end widget -->
  </article>
</div>