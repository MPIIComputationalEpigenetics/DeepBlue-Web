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

require_once("inc/init.php");

?>
<div class="row">
    <div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
        <h1 class="page-title txt-color-blueDark">
            <i class="fa fa-table fa-fw "></i>
                Data Tables > Experiments
            </span>
        </h1>
    </div>
</div>

<!-- widget grid -->
<section id="widget-grid" class="">
    <div class="alert alert-info alert-block" id="main-banner">
        <h4 class="alert-heading">Experiments Datatable</h4>
        Double click the row to select an experiment; It would be added to the Selected Experiments Datatable. Double click again to unselect a selected experiment. Selected experiments are highlighted in green.
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
                                </tr>
                                <tr>
                                    <th>ID</th>
                                    <th>Experiment Name</th>
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
                    </div>
                    <!-- end widget content -->

                </div>
                <!-- end widget div -->

            </div>
            <!-- end widget -->
        </article>
    </div>

    <div class="alert alert-info alert-block" id="main-banner">
        <h4 class="alert-heading">Selected Experiments</h4>
        Double click the row to unselect an experiment; It would be removed from the Datatable. Click Download Options to specify options for download the regions.
    </div>

    <div class="row" id="selection-table">
        <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="jarviswidget jarviswidget-color-blueDark" id="datable-selected-experiments" data-widget-editbutton="false" data-widget-deletebutton="false" data-widget-colorbutton="false" data-widget-togglebutton="false">

                <header>
                    <span class="widget-icon"> <i class="fa fa-table"></i> </span>
                    <h2>Selected Experiments </h2>

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
                                        <input class="form-control" placeholder="ID" type="text" id="experiment-id">
                                    </th>

                                    <th class="hasinput" style="width:20px">
                                        <input type="text" class="form-control" placeholder="Experiment" id="experiment-name" />
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
                                </tr>
                                <tr>
                                    <th>ID</th>
                                    <th>Experiment Name</th>
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
                        <div class="downloadButtonDiv"><button type="button" id="optionBtnBottom" class="btn btn-primary"><i class="fa fa-forward"></i> Download</button></div>
                    </div>
                    <!-- end widget content -->

                </div>
                <!-- end widget div -->

            </div>
            <!-- end widget -->
        </article>
    </div>

    <div id="option-banner" class="alert alert-info alert-block" id="main-banner">
        <h4 class="alert-heading">Download Options</h4>
        Customized options for the experiments region downloads
    </div>

    <div id="option-div" class="row">
        <!-- NEW COL START -->
        <article class="col-sm-12 col-md-12 col-lg-6">
            <!-- Widget ID (each widget will need unique ID)-->
            <div class="jarviswidget" id="wid-id-2" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-custombutton="false">
                <header>
                    <span class="widget-icon"> <i class="fa fa-edit"></i> </span>
                    <h2>Select Columns </h2>
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
                        <legend>
                            Common Column(s)
                        </legend>
                        <div class="form-group">
                            <select id="common_col" multiple style="width:100%" class="select2"></select>
                            <div class="note">
                                <strong>Usage:</strong> Use the dropdown to include a column. Click on the X to exclude the column
                            </div>
                        </div>
                        <legend>
                            Optional Column(s)
                        </legend>
                        <div class="form-group">
                            <select id="optional_col" multiple style="width:100%" class="select2"></select>
                            <div class="note">
                                <strong>Usage:</strong> Use the dropdown to include a column. Click on the X to exclude the column
                            </div>
                        </div>
                        <legend>
                            Meta Column(s)
                        </legend>
                        <div class="form-group">
                            <select id="meta_col" multiple style="width:100%" class="select2"></select>
                            <div class="note">
                                <strong>Usage:</strong> Use the dropdown to include a column. Click on the X to exclude the column
                            </div>
                        </div>
                        <div class="downloadButtonDiv">
                            <button id="cancelOption" class="btn btn-default" type="button">
                                Cancel
                            </button>
                            <button id= "downloadBtnBottom" class="btn btn-primary" type="button">
                                <i class="fa fa-download"></i>
                                Request Download
                            </button>
                        </div>
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
    var selectedNames = [];
    var options = true;

    pageSetUp();

    var pagefunction = function() {

        var isShow = false;

        // hide some divs
        $('#option-div').hide();
        $('#option-banner').hide();

        $(document).on("click", '.exp-metadata-more-view', function () {
            //var metadata = $(this).prev();
            if(isShow == false){
                $(this).prev().show(10);
                $(this).text("-- Hide --");
                isShow = true;
            }
            else{
                $(this).prev().hide(10);
                $(this).text("-- View metadata --");
                isShow = false;
            }

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
                aoData.push( { "name": "col_2", "value": "description"} );
                aoData.push( { "name": "col_3", "value": "genome"} );
                aoData.push( { "name": "col_4", "value": "epigenetic_mark"} );
                aoData.push( { "name": "col_5", "value": "biosource"} );
                aoData.push( { "name": "col_6", "value": "sample_id"} );
                aoData.push( { "name": "col_7", "value": "technique"} );
                aoData.push( { "name": "col_8", "value": "project"} );
                aoData.push( { "name": "col_9", "value": "extra_metadata"} );
            },
            //"sServerMethod": "POST",
            "iDisplayLength": 10,
            "autoWidth" : true,

            "preDrawCallback" : function() {
                // Initialize the responsive datatables helper once.
                if (!responsiveHelper_datatable_fixed_column) {
                    responsiveHelper_datatable_fixed_column = new ResponsiveDatatablesHelper($('#datatable_fixed_column'), breakpointDefinition);
                }
            },

            "fnRowCallback" : function(nRow, aData, iDisplayIndex) {

                if (selected.indexOf(aData[0]) != -1) {
                    $(nRow).addClass('success');
                }
                responsiveHelper_datatable_fixed_column.createExpandIcon(nRow);
            },

            "drawCallback" : function(oSettings) {
                responsiveHelper_datatable_fixed_column.respond();
            }
        });

        // custom toolbar
        $("div.toolbar").html('<div class="text-right"><img src="img/logo.png" alt="DeepBlue" style="width: 111px; margin-top: 3px; margin-right: 10px;"></div>');

        // Apply the filter
        $("#datatable_fixed_column thead th input[type=text]").on( 'keyup change', function () {
            otable
                .column( $(this).parent().index()+':visible' )
                .search( this.value )
                .draw();

        } );
        /* END COLUMN FILTER */


        /* process experiment selection by row clicking*/
        $('#datatable_fixed_column').on('dblclick', 'tr', function () {

            var id = $('td', this).eq(0).text();

            if (id ==  "") {
                return;
            }

            var name = $('td', this).eq(1).text();
            var desc = $('td', this).eq(2).text();
            var genome = $('td', this).eq(3).text();
            var epi = $('td', this).eq(4).text();
            var bio = $('td', this).eq(5).text();
            var samp = $('td', this).eq(6).text();
            var tech = $('td', this).eq(7).text();
            var proj = $('td', this).eq(8).text();
            var meta = $('td', this).eq(9).html();

            var index = selected.indexOf(id);
            if (index == -1) {
                selected.push(id);
                selectedNames.push(name);

                $('#datatable_selected_column').dataTable().fnAddData(
                    [ id, name , desc ,genome , epi ,bio ,samp ,tech ,proj ,meta]
                );

                $(this).addClass("success");
            }
            else {
                /* remove selection by clicking of row in the main table*/
                selected.splice(index, 1);
                selectedNames.splice(index, 1);
                $('#datatable_selected_column').dataTable().fnDeleteRow(index);
                $(this).removeClass("success");
            }

        });


        /* remove selection by clicking of row in the selection table*/
        $('#datatable_selected_column').on('dblclick', 'tr', function () {
            var id = $('td', this).eq(0).text();
            if (id ==  "") {
                return;
            }

            var index = selected.indexOf(id);
            selected.splice(index, 1);
            selectedNames.splice(index, 1);
            $('#datatable_selected_column').dataTable().fnDeleteRow(index);

            var rowId = otable.columns(0).data().eq(0).indexOf(id);
            otable.row(rowId).nodes().to$().removeClass("success");
        } );

        /* Show Options button */
        $('#optionBtnBottom').click(function(){

            if (options) {
                if (selected.length > 0) {
                    // show options
                    $('#optionBtnBottom').text("Re-select Experiments")
                    $('#main-table').hide();
                    $('#main-banner').hide();
                    $('#option-div').show();
                    $('#option-banner').show();

                    var request = $.ajax({
                        url: "ajax/server_side/manage_requests_server_processing.php",
                        dataType: "json",
                        data : {
                            option : 'orequest',
                            ids : selected
                        }
                    });

                    request.done( function(data) {
                        for (i=0; i<data['common'].length; i++) {
                            var key = data['common'][i];
                            var value = data['common'][i];
                            $('#common_col')
                                .append($("<option></option>")
                                .attr("value", key)
                                .text(value));
                        }
                        $('#common_col').select2("val", data['common']);

                        for (i=0; i<data['optional'].length; i++) {
                            var key = data['optional'][i];
                            var value = data['optional'][i];
                            var text =  value + " (" + data['experiment'][value] + ")";
                            $('#optional_col')
                                .append($("<option></option>")
                                .attr("value", key)
                                .text(text));
                        }

                        // Meta Columns
                        var meta_col = ['LENGTH','NAME','SEQUENCE', 'EPIGENETIC_MARK','PROJECT','BIOSOURCE','SAMPLE_ID'];
                        for (i=0; i<meta_col.length; i++) {
                            var value = meta_col[i];
                            $('#meta_col')
                                .append($("<option></option>")
                                .attr("value", value)
                                .text(value));
                        }

                    });

                    request.fail( function(jqXHR, textStatus) {
                        console.log(jqXHR);
                        console.log('Error: '+ textStatus);
                        alert( "error" );
                    });

                    options = false;
                }
                else {
                    alert("Please select elements!");
                }
            }
            else{
                $('#optionBtnBottom').text("Download");
                $('#main-table').show();
                $('#main-banner').show();
                $('#option-div').hide();
                $('#option-banner').hide();

                $('#optional_col')
                    .find('option')
                    .remove();

                $('#common_col')
                    .find('option')
                    .remove();

                $('#common_col').select2("val", []);
                $('#optional_col').select2("val", []);
                options = true;
            }
        });

        /* Download button :: Getting selected elements */
        $('#cancelOption').click(function(){
            $('#optionBtnBottom').text("Download");
            $('#main-table').show();
            $('#main-banner').show();
            $('#option-div').hide();
            $('#option-banner').hide();

            $('#optional_col')
                .find('option')
                .remove();

            $('#common_col')
                .find('option')
                .remove();

            $('#common_col').select2("val", []);
            $('#optional_col').select2("val", []);
            options = true;
        });

        /* Download button :: Getting selected elements */
        $('#downloadBtnBottom').click(function(){
            var common = $('#common_col').select2("val");
            var optional = $('#optional_col').select2("val");
            columns_format = common.concat(optional).join();

            var request = $.ajax({
                url: "ajax/server_side/manage_requests_server_processing.php",
                dataType: "json",
                data : {
                    option : 'rrequest',
                    experiments_ids : selected,
                    columns :  columns_format
                }
            });

            request.done( function(data) {
                alert("Request for experiment region successful :" + data.request_id + ". Go to Manage Requests page to download the regions");

                // hide option dialog and show datatables
                $('#optionBtnBottom').text("Download");
                $('#main-table').show();
                $('#main-banner').show();
                $('#option-div').hide();
                $('#option-banner').hide();

                // remove options input 
                $('#optional_col')
                    .find('option')
                    .remove();

                $('#common_col')
                    .find('option')
                    .remove();

                // remove options selections
                $('#common_col').select2("val", []);
                $('#optional_col').select2("val", []);
                options = true;

                // clear the tables of previous selection
                $('#datatable_selected_column').dataTable().fnClearTable();
                var rowId
                for (i=0; i<selected.length; i++) {
                    id = selected[i];
                    rowId = otable.columns(0).data().eq(0).indexOf(id);
                    otable.row(rowId).nodes().to$().removeClass("success");
                }
                selected = [];
                selectedNames = [];
            });

            request.fail( function(jqXHR, textStatus) {
                console.log(jqXHR);
                console.log('Error: '+ textStatus);
                alert( "error" );
            });
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
