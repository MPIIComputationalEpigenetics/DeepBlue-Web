<?php

/**
*   DeepBlue Epigenomic Data Server
*   Copyright (c) 2015 Max Planck Institute for Computer Science.
*   All rights reserved.
*
*   Authors :
*
*   Felipe Albrecht <felipe.albrecht@mpi-inf.mpg.de>
*   Obaro Odiete <s8obodie@stud.uni-saarlande.de>
*
*   Created : 07-04-2015
*
*   ================================================
*
*   File : deepblue_view_experiments.php
*
*/

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once("../lib/lib.php");
require_once("inc/init.php");

?>
<div class="row">
    <div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
        <h1 class="page-title txt-color-blueDark">
            <i class="fa fa-database fa-fw "></i>
                Experiments data
            </span>
        </h1>
    </div>
</div>

<!-- widget grid -->
<section id="widget-grid" class="">
    <div class="alert alert-info alert-block" id="main-banner">
        <h4 class="alert-heading">Experiments data table</h4>
        Double click the row to select an experiment. It will be added to the selected experiments data table. </br>
        Selected experiments are highlighted in green. </br>
        Double click to unselect a selected experiment. </br>
    </div>

    <div class="row" id="main-table">
        <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="jarviswidget jarviswidget-color-blueDark" id="datable-experiments" data-widget-editbutton="false" data-widget-deletebutton="false" data-widget-colorbutton="false" data-widget-togglebutton="false">

                <header>
                    <span class="widget-icon"> <i class="fa fa-table"></i> </span>
                    <h2>Experiments </h2>

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

                        <table id="datatable_fixed_column" name='experiment-table' class="table table-striped table-bordered table-hover" width="100%">
                            <thead>
                                <tr>
                                    <th class="hasinput">
                                        <input class="form-control" placeholder="ID" type="text" id="experiment-id">
                                    </th>
                                    <th class="hasinput" style="width:20px">
                                        <input type="text" class="form-control" placeholder="Experiment" id="experiment-name" />
                                    </th>
                                    <th class="hasinput" style="width:20px">
                                        <input type="text" class="form-control" placeholder="Type" id="experiment-datatype" />
                                    </th>
                                    <th class="hasinput">
                                        <input type="text" class="form-control" placeholder="Description" id="experiment-description" />
                                    </th>
                                    <th class="hasinput">
                                        <input type="text" class="form-control" placeholder="Genome" id="experiment-genome" />
                                    </th>
                                    <th class="hasinput">
                                        <input type="text" class="form-control" placeholder="Epigenetic mark" id="experiment-epigenetic_mark" />
                                    </th>
                                    <th class="hasinput">
                                        <input type="text" class="form-control" placeholder="Biosource" id="experiment-biosource" />
                                    </th>
                                    <th class="hasinput">
                                        <input type="text" class="form-control" placeholder="Sample" id="experiment-sample" />
                                    </th>
                                    <th class="hasinput">
                                        <input type="text" class="form-control" placeholder="Technique" id="experiment-technique" />
                                    </th>
                                    <th class="hasinput">
                                        <input type="text" class="form-control" placeholder="Project" id="experiment-project" />
                                    </th>
                                    <th class="hasinput">
                                        <input type="text" class="form-control" placeholder="Meta data" id="experiment-metadata" />
                                    </th>
                                    <th class="hasinput">
                                        <input type="text" class="form-control" placeholder="Preview" id="experiment-preview" />
                                    </th>
                                </tr>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
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
                    </div>
                    <!-- end widget content -->

                </div>
                <!-- end widget div -->

            </div>
            <!-- end widget -->
        </article>
    </div>

    <div class="alert alert-info alert-block" id="main-banner">
        <h4 class="alert-heading">Selected experiments</h4>
        Double click the row to unselect an experiment. It will be removed from the data table. </br>
        For downloading the data, click on the <i>Download</i> button in the end of the page. You will be redirected to the download page.</br>
<!--        Click <i>Download</i> to specify options for downloading the regions.</br>-->
    </div>
    <?php include("../inc/selection_table.php"); ?>
</section>
<!-- end widget grid -->

<script type="text/javascript">

    var selected = [];
    var selectedNames = [];
    var selectedData = [];
    var list_in_use;
    var filters = {};
    var filter_active = false;

    pageSetUp();

    function loadTableAutoComplete() {
        var vocabnames = ["projects","genomes", "techniques", "epigenetic_marks", "biosources", "types"];
        var vocabids = ['#experiment-project','#experiment-genome', "#experiment-technique", "#experiment-epigenetic_mark", "#experiment-biosource", "#experiment-datatype"];
        var suggestion2 = [];

        for (i in vocabnames) {
            vocabname = vocabnames[i];
            vocabid = vocabids[i];
            suggestion2[vocabname] = []; // index for each controlled vocabulary
            count = 0;

            var currentvocab = list_in_use[vocabname]['alp'];
            for (j in currentvocab) {
                suggestion2[vocabname][count] = {'label' : currentvocab[j][1], 'value' : currentvocab[j][1]};
                count = count + 1;
            }
            $(vocabid).autocomplete({
                source : suggestion2[vocabname],
                autoFocus: false,
                focus: function( event, ui ) { return false;},
                minLength: 0,
                select: function( event, ui ) {
                    this.value = ui.item.value;
                    $(this).trigger("change");
                    filter_active = true;
                    filters[event.target.id] = this.value;
                    pullData();
                }
            });
            $(vocabid).blur(function() {
                if($(this).val() == "") {
                    filter_active = true;
                    delete filters[this.id];
                    pullData();
                }
            });

        }
    }

    function pullData() {
        //alert(filters);
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
            if (filter_active) {
                localStorage.setItem("list_in_use_filter", JSON.stringify(data[0]));
            }
            else {
                localStorage.setItem("list_in_use", JSON.stringify(data[0]));
            }
            list_in_use = data[0];
            loadTableAutoComplete();
        });

        request1.fail(function (jqXHR, textStatus) {
            console.log(jqXHR);
            console.log('Error: ' + textStatus);
            alert("Encountered an error. Please wait a few seconds and reload page. If problem persist, kindly log a complaint");
        });
    }

    var pagefunction = function() {

        list_in_use = JSON.parse(localStorage.getItem('list_in_use'));
        if (list_in_use == null) {
            pullData();
        }
        else {
            loadTableAutoComplete();
        }

        $("#datatable_fixed_column, #datatable_selected_column").on("click", '.exp-metadata-more-view', function (e) {
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

        $("#datatable_fixed_column, #datatable_selected_column").on("click", '.preview-experiment', function (e) {
            var elem = this.id;
            var request = $.ajax({
                url: "ajax/server_side/preview_experiment_server_processing.php",
                dataType: "json",
                data : {
                    id : elem
                }
            });
            request.done( function(data) {
                // empty the modal window
                $("#experiment_preview").empty();

                // toggle modal
                var preview = "<pre style='font-size: medium'>"+data.data+"</pre>";
                $("#experiment_preview").append(preview);
                $('#previewModal').modal('toggle');
            });

            request.fail( function(jqXHR, textStatus) {
                console.log(jqXHR);
                console.log('Error: '+ textStatus);
                alert( "error" );
            });

            e.stopPropagation();
        });

        /**/
        $('.tagsinput').tagsinput('refresh');

        /* BASIC ;*/
        var responsiveHelper_dt_basic = undefined;
        var responsiveHelper_datatable_fixed_column = undefined;
        var responsiveHelper_datatable_col_reorder = undefined;
        var responsiveHelper_datatable_tabletools = undefined;

        var breakpointDefinition = {
            tablet : 1024,
            phone : 480
        };

        /* COLUMN FILTER  */
        var otable = $('#datatable_fixed_column').DataTable({
            "bServerSide": true,
            "sAjaxSource": "api/datatable",
            "fnServerParams": function ( aoData ) {
                aoData.push( { "name": "collection", "value": "experiments" } );
                aoData.push( { "name": "col_0", "value": "_id"} );
                aoData.push( { "name": "col_1", "value": "name"} );
                aoData.push( { "name": "col_2", "value": "data_type"} );
                aoData.push( { "name": "col_3", "value": "description"} );
                aoData.push( { "name": "col_4", "value": "genome"} );
                aoData.push( { "name": "col_5", "value": "epigenetic_mark"} );
                aoData.push( { "name": "col_6", "value": "biosource"} );
                aoData.push( { "name": "col_7", "value": "sample_id"} );
                aoData.push( { "name": "col_8", "value": "technique"} );
                aoData.push( { "name": "col_9", "value": "project"} );
                aoData.push( { "name": "col_10", "value": "extra_metadata"} );
                aoData.push( { "name": "key", "value": "<?php echo $user_key ?>"} );
            },
            //"sServerMethod": "POST",
            "iDisplayLength": 10,
            "bAutoWidth" : true,
            "scrollX" : true,

            "preDrawCallback" : function() {
                // Initialize the responsive datatables helper once.
                if (!responsiveHelper_datatable_fixed_column) {
                    responsiveHelper_datatable_fixed_column = new ResponsiveDatatablesHelper($('#datatable_fixed_column'), breakpointDefinition);
                }
            },

            "fnRowCallback" : function(nRow, aData, iDisplayIndex) {
                var $cell = $('td:eq(11)', nRow);
                var id = aData[0];
                $cell.html("<button id='" + id + "' type='button' class='btn btn-default preview-experiment'><i class='fa fa-search'></i></button>");
                if (selected.indexOf(aData[0]) != -1) {
                    $(nRow).addClass('success');
                }
                responsiveHelper_datatable_fixed_column.createExpandIcon(nRow);
            },

            "drawCallback" : function(oSettings) {
                responsiveHelper_datatable_fixed_column.respond();
            }
        });

        $.fn.dataTableExt.sErrMode = 'none';
        otable.on('xhr.dt', function ( e, settings, json) {
            if ("error" in json) {
                swal("Error while loading the experiments table.", json["error"], "error");
                json.aaData = [];
            }
        });

        // custom toolbar
        $("div.toolbar").html('<div class="text-right"><img src="img/logo.png" alt="DeepBlue" style="width: 111px; margin-top: 3px; margin-right: 10px;"></div>');

        // Apply the filter
        $("#experiment-id, #experiment-name, #experiment-datatype, #experiment-epigenetic_mark, #experiment-project, " +
            "#experiment-biosource, #experiment-sample, #experiment-technique, #experiment-genome, #experiment-metadata, " +
            "#experiment-description").on('keyup change', function () {
            otable
                .column( $(this).parent().index()+':visible' )
                .search( this.value )
                .draw();
        });
        /* END COLUMN FILTER */

        /* process experiment selection by row clicking*/
        $('#datatable_fixed_column').on('dblclick', 'tr', function () {
            var id = $('td', this).eq(0).text();

            if (id ==  "") {
                return;
            }

            var name = $('td', this).eq(1).text();
            var type = $('td', this).eq(2).text();
            var desc = $('td', this).eq(3).text();
            var genome = $('td', this).eq(4).text();
            var epi = $('td', this).eq(5).text();
            var bio = $('td', this).eq(6).text();
            var samp = $('td', this).eq(7).text();
            var tech = $('td', this).eq(8).text();
            var proj = $('td', this).eq(9).text();
            var meta = $('td', this).eq(10).html();
            var prev = $('td', this).eq(11).html();

            var index = selected.indexOf(id);
            if (index == -1) {
                selected.push(id);
                selectedNames.push(name);
                selectedData.push([ id, name, type , desc ,genome , epi ,bio ,samp ,tech ,proj ,meta]);

                $('#datatable_selected_column').dataTable().fnAddData(
                    [ id, name, type, desc ,genome , epi ,bio ,samp ,tech ,proj ,meta, prev]
                );

                $(this).addClass("success");
            }
            else {
                /* remove selection by clicking of row in the main table*/
                selected.splice(index, 1);
                selectedNames.splice(index, 1);
                selectedData.splice(index,1);

                $('#datatable_selected_column').dataTable().fnDeleteRow(index);
                $(this).removeClass("success");
            }

            if (selected.length > 0) {
                $('#downloadBtnBottom').removeAttr('disabled');
            }
            else {
                $('#downloadBtnBottom').attr('disabled','disabled');
            }

        });

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

        /* remove selection by double clicking of row in the selection table*/
        $('#datatable_selected_column').on('dblclick', 'tr', function () {
            var id = $('td', this).eq(0).text();
            if (id ==  "") {
                return;
            }

            var index = selected.indexOf(id);
            selected.splice(index, 1);
            selectedNames.splice(index, 1);
            selectedData.splice(index,1);

            $('#datatable_selected_column').dataTable().fnDeleteRow(index);

            var rowId = otable.columns(0).data().eq(0).indexOf(id);
            otable.row(rowId).nodes().to$().removeClass("success");

            if (selected.length == 0) {
                $('#downloadBtnBottom').attr('disabled','disabled');
            }
        } );

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
