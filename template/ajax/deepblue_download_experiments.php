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
*   Created : 19-06-2015
*
*   ================================================
*
*   File : deepblue_download_experiments.php
*
*/

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once("inc/init.php");

?>

<div class="row">
    <div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
        <h1 class="page-title txt-color-blueDark">
            <i class="fa fa-download fa-fw "></i>
                Download Experiments
            </span>
        </h1>
    </div>
</div>

<!-- widget grid -->
<section id="widget-grid" class="">
    <div class="row" id="selection-table">
        <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="jarviswidget jarviswidget-color-blueDark" id="datable-download-experiments" data-widget-editbutton="false" data-widget-deletebutton="false" data-widget-colorbutton="false" data-widget-togglebutton="false">

                <header>
                    <span class="widget-icon"> <i class="fa fa-table"></i> </span>
                    <h2>Download Experiments </h2>

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

                        <table id="datatable_download_column" name='experiment-table' class="table table-striped table-bordered table-hover" width="100%">
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

    <div id="option-banner" class="alert alert-info alert-block" id="main-banner">
        <h4 class="alert-heading">Download Options</h4>
        Customized options for the experiments region downloads
    </div>

    <div id="option-div" class="row">
        <!-- NEW COL START -->
        <article class="col-sm-12 col-md-12 col-lg-12">
            <!-- Widget ID (each widget will need unique ID)-->
            <div class="jarviswidget" id="wid-id-2" data-widget-editbutton="false" data-widget-colorbutton="false" data-widget-deletebutton="false" data-widget-fullscreenbutton="false">
                <header>
                    <span class="widget-icon"> <i class="fa fa-edit"></i> </span>
                    <h2>Columns </h2>
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
                        <legend>
                            Calculated Column(s)
                        </legend>
                        <div class="form-group">
                            <select id="calculated_col" multiple style="width:100%" class="select2"></select>
                            <div class="note">
                                <strong>Usage:</strong> Use the dropdown to include a column. Click on the X to exclude the column
                            </div>
                        </div>
                    </div>
                    <!-- end widget content -->
                </div>
                <!-- end widget div -->
            </div>
            <!-- end widget -->

            <!-- Widget ID (each widget will need unique ID)-->
            <div class="jarviswidget" id="wid-id-3" data-widget-editbutton="false" data-widget-colorbutton="false" data-widget-deletebutton="false" data-widget-fullscreenbutton="false" data-widget-collapsed="true">
                <header>
                    <span class="widget-icon"> <i class="fa fa-map-marker"></i> </span>
                    <h2>Genomic Coordinate </h2>
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
                            Genomic Coordinate
                        </legend>
                        <div class="row">
                            <div class="col-sm-6 col-md-8 col-lg-8">
                                <div class="form-group">
                                    <label>Chromosome</label>
                                    <select id="genome_chrom" multiple style="width:100%" class="select2"></select>
                                    <div class="note">
                                        <strong>Usage:</strong> Keep empty to select all chromosomes. Use the dropdown to include a chromosome. Click on the X to exclude the chromosome
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-2 col-lg-2">
                                <div class="form-group">
                                    <label>Start</label>
                                    <input class="form-control"  id="genome_start" type="text">
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-2 col-lg-2">
                                <div class="form-group">
                                    <label>End</label>
                                    <input class="form-control"  id="genome_end" type="text">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end widget content -->
                </div>
                <!-- end widget div -->
            </div>
            <!-- end widget -->

            <!-- Widget ID (each widget will need unique ID)-->
            <div class="jarviswidget" id="wid-id-4" data-widget-editbutton="false" data-widget-colorbutton="false" data-widget-deletebutton="false" data-widget-fullscreenbutton="false" data-widget-collapsed="true">
                <header>
                    <span class="widget-icon"> <i class="fa fa-code-fork"></i> </span>
                    <h2>Overlapping with Annotations </h2>
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
                            Overlapping
                        </legend>
                        <div class="form-group">
                            <label>Annotations</label>
                            <select id="chrom_annot" multiple style="width:100%" class="select2"></select>
                            <div class="note">
                                <strong>Usage:</strong> Use the dropdown to include an annotation. Click on the X to exclude the annotation
                            </div>
                        </div>
                    </div>
                    <!-- end widget content -->
                </div>
                <!-- end widget div -->
            </div>
            <!-- end widget -->
        </article>
    </div>

    <div id='button-div' class="downloadButtonDiv">
        <button id="cancelOption" class="btn btn-default" type="button">
            Cancel
        </button>
        <button id= "downloadBtnBottom" class="btn btn-primary" type="button" disabled>
            <i class="fa fa-download"></i>
            Request Download
        </button>
    </div>
</section>
<!-- end widget grid -->

<script type="text/javascript">

    pageSetUp();


    var pagefunction = function() {

        var isShow = false;
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

        // custom toolbar
        $("div.toolbar").html('<div class="text-right"><img src="img/logo.png" alt="DeepBlue" style="width: 111px; margin-top: 3px; margin-right: 10px;"></div>');


        var complete1 = false;
        var complete2 = false;
        var allgenomes = [];
        var selectedData = [];
        var selected = [];

        // pull selected data from cache
        if (localStorage.getItem('selectedData') != null) {
            selectedData = JSON.parse(localStorage.getItem('selectedData'));
        }

        for (var i=0; i<selectedData.length; i++) {
            // initially load the data table
            selected[i] = selectedData[i][0];

            $('#datatable_download_column').dataTable().fnAddData(selectedData[i]);
        }

        /* Pull Column Options Data */
        var request = $.ajax({
            url: "ajax/server_side/manage_requests_server_processing.php",
            dataType: "json",
            data : {
                option : 'orequest',
                ids : selected
            }
        });

        request.done( function(data) {
            if (data[0] == "error") {
                var report = "An error has occured: " + data[1];
                swal({
                    title: "Download Experiments",
                    text: report
                });                                    
                return;            
            }
            
            // Meta Columns
            var meta_col = ['@LENGTH','@NAME','@SEQUENCE', '@EPIGENETIC_MARK','@PROJECT','@BIOSOURCE','@SAMPLE_ID'];
            for (i=0; i<meta_col.length; i++) {
                var value = meta_col[i];
                $('#meta_col')
                    .append($("<option></option>")
                    .attr("value", value)
                    .text(value));
            }

            // Calculated Columns
            for (i=0; i<data['calculated'].length; i++) {
                var key = data['calculated'][i][0];
                var value = data['calculated'][i][1];
                var text =  value + " = " + key;
                $('#calculated_col')
                    .append($("<option></option>")
                    .attr("value", value)
                    .text(text));
            }

            // Common Columns
            for (i=0; i<data['common'].length; i++) {
                var key = data['common'][i];
                var value = data['common'][i];
                $('#common_col')
                    .append($("<option></option>")
                    .attr("value", key)
                    .text(value));
            }
            $('#common_col').select2("val", data['common']);

            // Optional Columns
            for (i=0; i<data['optional'].length; i++) {
                var key = data['optional'][i];
                var value = data['optional'][i];
                var text =  value + " (" + data['experiment'][value] + ")";
                $('#optional_col')
                    .append($("<option></option>")
                    .attr("value", key)
                    .text(text));
            }

            // completed
            complete1 = true
            if (complete2) {
                $('#downloadBtnBottom').removeAttr('disabled');
            }
        });

        request.fail( function(jqXHR, textStatus) {
            console.log(jqXHR);
            console.log('Error: '+ textStatus);
            alert( "error1" );
        });

        /* Pull Additional Settings Options Data */
        var request = $.ajax({
            url: "ajax/server_side/manage_requests_server_processing.php",
            dataType: "json",
            data : {
                option : 'crequest',
                ids : selected
            }
        });

        request.done( function(data) {
            if (data[0] == "error") {
                var report = "An error has occured: " + data[1];
                swal({
                    title: "Download Experiments",
                    text: report
                });                                    
                return;            
            }
            
            var chr = data['chromosome'];
            for (i=0; i < chr.length; i++) {
                var value = chr[i];
                $('#genome_chrom')
                    .append($("<option></option>")
                    .attr("value", value)
                    .text(value));
            }

            var ann = data['annotations'];
            for (i=0; i < ann.length; i++) {
                var value = ann[i];
                $('#chrom_annot')
                    .append($("<option></option>")
                    .attr("value", value)
                    .text(value));
            }

            allgenomes = data['genomes'];

            // completed
            complete2 = true;
            if (complete1) {
                $('#downloadBtnBottom').removeAttr('disabled');
            }
        });

        request.fail( function(jqXHR, textStatus) {
            console.log(jqXHR);
            console.log('Error: '+ textStatus);
            alert( "error2" );
        });

        /* Cancle Button */
        $('#cancelOption').click(function(){
            window.history.go(-1);
        });

        /* Download button :: Getting selected elements */
        $('#downloadBtnBottom').click(function(){
            var common = $('#common_col').select2("val");
            var optional = $('#optional_col').select2("val");
            var calculated = $('#calculated_col').select2("val");
            var meta = $('#meta_col').select2("val");

            columns_format = common.concat(optional, calculated, meta).join();
            var chrom = [];
            var annot = [];

            if ($('#chrom_annot').select2("val")) {
                annot = $('#chrom_annot').select2("val");
            }

            if ($('#genome_chrom').select2("val")) {
                chrom = $('#genome_chrom').select2("val");
            }

            var start = $('#genome_start').val();
            var end = $('#genome_end').val();

            var request = $.ajax({
                url: "ajax/server_side/manage_requests_server_processing.php",
                dataType: "json",
                data : {
                    option : 'rrequest',
                    experiments_ids : selected,
                    annotation_names : annot,
                    columns :  columns_format,
                    allgenomes : allgenomes,
                    chromosome : chrom,
                    start : start,
                    end : end
                }
            });

            request.done( function(data) {                
                if (data[0] == "error") {
                    var report = "An error has occured: " + data[1];
                    swal({
                        title: "Download Experiments",
                        text: report
                    });                                    
                    return;            
                }                
                
                swal({
                    title: "Request Sent.",
                    text: "The request ID is " + data.request_id + ".\nWould you like to go to the Manage Request page ?",
                    type: "success",
                    showCancelButton: true
                },
                function(yes){
                    if (yes) {
                        window.location.href = "dashboard.php#ajax/deepblue_manage_request.php";
                    }
                    else {
                        window.history.go(-1);
                    }
                });
            });

            request.fail( function(jqXHR, textStatus) {
                console.log(jqXHR);
                console.log('Error: '+ textStatus);
                alert( "error3" );
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
