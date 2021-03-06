var list_in_use;
var list_in_use_full;
var experiments;
var filters;
var filter_active;
var vocabnames;
var vocabids;
var cell_colors;
var size_main;
var defaults;
var selectedData;
var selectedNames;
var selectedCount;
var selected;
var set_all_projects;
var all_projects;
var toggleSelectAll;
var otable;
var otable2;
var request_id;
var default_project;
var default_type;
var grid_data;

function clearVocab(list_name) {

    var index = vocabids.indexOf(list_name);// index of vocabid in vocabids
    var vocabname = vocabnames[index];

    //TODO: Fix for case of individual deselection of all elements, before pressing clearVocab
    if (toggleSelectAll[list_name]) {
        filters[list_name] = [];
        for (i in list_in_use_full[vocabname]['amt']) {
            var item = list_in_use_full[vocabname]['amt'][i][1];
            var elements = $("a[id='"+item+"']");
            $(elements[0]).removeClass('active');
        }
    }
    else {
        // show loading
        $("#" + list_name + "-i").addClass("fa fa-spinner fa-spin fa-fw");

        filters[list_name] = [];
        filter_active = true;
        pullData(++request_id);
    }
    toggleSelectAll[list_name] = true;
}

function selectVocab(list_name) {

    var index = vocabids.indexOf(list_name);// index of vocabid in vocabids
    var vocabname = vocabnames[index];

    //TODO: Fix for case of individual selection of all elements, before pressing clearVocab
    if (toggleSelectAll[list_name]) {
        for (i in list_in_use_full[vocabname]['amt']) {
            var item = list_in_use_full[vocabname]['amt'][i][1];
            var elements = $("a[id='"+item+"']");
            $(elements[0]).addClass('active');

            if (filters[list_name].indexOf(item) == -1) {
                filters[list_name].push(item);
            }
        }
    }
    else {
        // show loading
        $("#"+list_name+"-i").addClass("fa fa-spinner fa-spin fa-fw");
        var currentvocab = list_in_use_full[vocabname]['amt'];
        for (j in currentvocab) {
            if (filters[list_name].indexOf(currentvocab[j][1]) == -1) {
                // console.log(currentvocab[j][1]);
                filters[list_name].push(currentvocab[j][1]);
            }
        }
        filter_active = true;
        pullData(++request_id);
    }
    toggleSelectAll[list_name] = true;
}

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
            pullData(++request_id);
        }
        else {
            initFilters(false);
        }
    }
    $("#clearBtn").attr('disabled', 'disabled');
    $("#downloadBtnBottom").attr('disabled', 'disabled');
    $("#exportBtnBottom").attr('disabled', 'disabled');

    otable2.clear().draw();

    selected = [];
    selectedCount = {};
    selectedData = [];
    selectedNames = [];
}

function selectAllMetadata() {
    swal(
        {
            title: "Are you sure?",
            text: "Selecting all elements may take some loading time.",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, select all!",
            closeOnConfirm: true
        },
        function(){
            init();
            clearList();

            // reload filter data
            list_in_use = JSON.parse(localStorage.getItem('list_in_use'));
            filter_active = true;

            for (i in vocabids) {
                toggleSelectAll[vocabids[i]] = true;
            }

            initFilters(true);
            loadExperiments(++request_id);
            fillFilter();

            set_all_projects = false;
            $("#selectAllBtn").attr('disabled', 'disabled');
        }
    );
}

function selectAllGridExperiments() {
    var table_rows = grid_data['cell_biosources'].length;
    var table_columns = grid_data['cell_epigenetic_marks'].length;

    experiments = new Array();
    for (i=0; i<table_rows; i++) {
        var bio = grid_data['cell_biosources'][i];
        var row_experiments = grid_data['cell_experiments'][bio];

        for (var epigenetic_mark in row_experiments) {
            experiments.push.apply(experiments, row_experiments[epigenetic_mark]);
        }
    }

    for (var i = 0; i < experiments.length; i+=100) {
        addSelected(experiments.slice(i, i+100));
    }

    var current_cells = otable.cells(
        function ( idx, data, node ) {
            return ((idx.column != 0) && ($(node).attr('data-val') != 0));
        }).nodes();

    current_cells.to$().addClass("selected-grid-cell");
    jumpToDownload();
}

function fillFilter() {
    for (i in vocabnames) {
        var vocabname = vocabnames[i];
        var vocabid = vocabids[i];

        var currentvocab = list_in_use[vocabname]['amt'];

        for (j in currentvocab) {
            filters[vocabid].push(currentvocab[j][1])
        }
    }
}

function init() {
    for (i in vocabids) {
        filters[vocabids[i]] = [];
        toggleSelectAll[vocabids[i]] = true;
    }
}

function getDefaultsDataTypes() {
    return ['peaks'];
}

function pullData(req_id) {
    // no delay for initial page loading
    if (req_id <= 1) {
        pullDataNow(req_id);
        return;
    }

    var delay = 1000;
    // console.log("Delay request: ", req_id);
    setTimeout(function(){
        if (req_id < request_id) {
            // console.log("ignoring pull request: ", req_id);
            return;
        }
        pullDataNow(req_id);
    }, delay);
}

function pullDataNow(req_id) {
    // console.log("pull data now for request: ", req_id);

    var request1 = $.ajax({
        url: "ajax/server_side/grid_faceting_experiments.php",
        type : "POST",
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
            loadFilters();
            loadExperiments(req_id);
        }
        else {
            list_in_use_full = data[0];
            init_projects();
            initFilters(false);
            toggleDefaults();
        }
    });

    request1.fail(function (jqXHR, textStatus) {
        swal({
            title: "Error loading experiments",
            text: textStatus,
            type: "error"
        });
    });
}

function loadExperiments(req_id) {

    $("#experiment-column").empty();
    $("#experiment-column").append("<img src='../img/loader2.gif' >");

    if (req_id < request_id) {
        return;
    }
    // console.log("load experiments for current request id: ", req_id, "and final request id", request_id);
    $('#clearBtn').attr('disabled', 'disabled');
    $('#selectAllBtn').attr('disabled', 'disabled');
    $('#selectAllExperimentsBtn').attr('disabled', 'disabled');

    // send all the projects when no one is selected
    if (filters['experiment-project'].length == 0) {
        filters['experiment-project'] = all_projects;
        set_all_projects = true;
    }

    var request2 = $.ajax({
        url: "api/grid",
        type: "POST",
        dataType: "JSON",
        data : {
            request : filters,
            key : user_key
        }
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

        // restore filters['experiment-project'] = all_projects; to empty array if manually set
        if (set_all_projects) {
            filters['experiment-project'] = [];
            set_all_projects = false;
        }

        grid_data = data;
        //show experiments
        showExperiments(data);
    });

    request2.fail( function(jqXHR, textStatus) {
        console.log(jqXHR);
        console.log('Error: '+ textStatus);
        swal({
            title: "Error loading experiments",
            text: textStatus,
            type: "error"
        });
    });
}

function showExperiments(data) {
    // show experiment in the right column
    var table_rows = data['cell_biosources'].length;
    var table_columns = data['cell_epigenetic_marks'].length;

    var table_str = "<table class='table table-striped table-bordered table-condensed' id='grid'>";

    table_str = table_str + "<thead><th></th>";
    var epi;
    for (j = 0; j < table_columns; j++) {
        epi = data['cell_epigenetic_marks'][j];
        table_str = table_str + "<th class='rotate' data-col='" + epi + "'><div><span>"  + epi + "</span></div></th>";
    }
    table_str = table_str + "</thead>";

    table_str = table_str + "<tbody>";
    for (i=0; i<table_rows; i++) {
        var bio = data['cell_biosources'][i];
        selectedCount[normalize(bio)] = {};

        table_str = table_str + "<tr>";
        table_str = table_str + "<td scope='row' data-row='" + bio + "' style='border-width: 1px;'><b>"  + bio + "</b></td>";
        for (j=0; j<table_columns; j++) {
            var epi = data['cell_epigenetic_marks'][j];
            var cell_count = data['cell_experiment_count'][bio][epi];

            var cell_project = data['cell_projects'][bio][epi];
            var project_color = "white";
            if (cell_project != "") {
                project_color = cell_colors[cell_project];
            }

            if (cell_count == 0) {
                table_str = table_str + "<td style='background:" + project_color + "; border-width: 1px;' data-val='0' data-row='" + bio + "' data-col='" + epi + "'>"  + cell_count + "</td>";
            }
            else {
                table_str = table_str + "<td style='background:" + project_color + "; border-width: 1px; cursor: pointer;' data-val='" + cell_count + "' data-row='" + bio + "' data-col='" + epi + "'>"  + cell_count + "</td>";
            }

            selectedCount[normalize(bio)][normalize(epi)] = 0; // selected experiment counter
        }
        table_str = table_str + "</tr>";
    }
    table_str = table_str + "</tbody>";
    table_str = table_str + "</table>";

    $("#experiment-column").empty();
    $("#experiment-column").append(table_str);

    otable = $('#grid').DataTable({
        "iDisplayLength": -1,
        "aoColumnDefs": [
            { "bSortable": true, "aTargets": "_all" }
        ],
        "sDom": '<"pull-left"f>rt<"bottom"><"clear">',
        "language": {
            searchPlaceholder: "Filter Biosource"
        }
    });

    $("#grid td").dblclick(function(event){
        var cell = $(this);
        var epi = cell.attr('data-col');
        var bio = cell.attr('data-row');

        if (epi == undefined) {
            var current_cells = otable.cells(
                function ( idx, data, node ) {
                    return (($(node).attr('data-row') == bio) && ($(node).attr('data-val') != 0));
                }
            ).nodes();

            var row_experiments = data['cell_experiments'][bio];
            current_cells.to$().removeClass("unselected-grid-cell");

            if ($(cell).hasClass("selected-grid-cell")) {
                current_cells.to$().removeClass("selected-grid-cell");
                for (r in row_experiments) {
                    var cell_experiments = row_experiments[r];
                    removeSelected(cell_experiments, bio, r)
                }
            }
            else {
                current_cells.to$().addClass("selected-grid-cell");
                for (r in row_experiments) {
                    var cell_experiments = row_experiments[r];
                    addSelected(cell_experiments);
                }
            }
        }
    });

    $("#grid td").click(function(event){

        var cell = $(this);
        var epi = cell.attr('data-col');
        var bio = cell.attr('data-row');

        if (epi == undefined || bio == undefined) {
            return;
        }

        var count = cell.attr('data-val');
        if (count == 0) {
            return;
        }

        if ($(cell).hasClass("selected-grid-cell") || $(cell).hasClass("unselected-grid-cell")) {
            var experiments = data['cell_experiments'][bio][epi];

            var anchor_cell = otable.cells(
                function ( idx, data, node ) {
                    if(($(node).attr('data-row') == bio) && ($(node).attr('data-col') == undefined)) {
                        return true;
                    }
                    return false;
                }
            ).nodes();
            anchor_cell.to$().removeClass("selected-grid-cell");

            removeSelected(experiments, bio, epi);
            $(cell).removeClass("selected-grid-cell");
            $(cell).removeClass("unselected-grid-cell");
        }
        else {
            $(cell).addClass("selected-grid-cell");
            var experiments = data['cell_experiments'][bio][epi];
            addSelected(experiments);
        }
    });

    $('#clearBtn').removeAttr('disabled');
    $('#selectAllBtn').removeAttr('disabled');
    $('#selectAllExperimentsBtn').removeAttr('disabled');
}

function removeSelected(experiments, bio, epi) {
    for (e in experiments) {
        var experiment = experiments[e];
        var experiment_id = experiment[0];

        var index = selected.indexOf(experiment_id);
        if (index > -1) {
            selected.splice(index, 1);
            selectedData.splice(index,1);
            selectedNames.splice(index,1);

            $('#datatable_selected_column').dataTable().fnDeleteRow(index);
        }
    }
    selectedCount[normalize(bio)][normalize(epi)] = 0;

    if (selectedData.length == 0) {
        $('#downloadBtnBottom').attr('disabled','disabled');
        $('#exportBtnBottom').attr('disabled','disabled');
    }
}

var annotations_extra_metadata = function(annotation) {
    var tmp_str = "";

    if (annotation.format) {
        tmp_str += "<b>Format</b>: " + annotation.format + "<br />";
        tmp_str += "<br />";
    }

    if (annotation.sample_info) {
        tmp_str += "<b>Sample Info</b> <br />";
        for (extra_metadata_key in annotation.sample_info) {
            var extra_metadata_value = annotation.sample_info[extra_metadata_key];
            if ((extra_metadata_value != '') && (extra_metadata_value != '-')) {
                if (extra_metadata_key == 'key') {
                    tmp_str += "<b>" + extra_metadata_key + "</b> : <a href='" + extra_metadata_value + "' target='_blank'\>" + extra_metadata_value + '</a><br />';
                } else {
                    tmp_str += '<b>' + extra_metadata_key + '</b> : ' + extra_metadata_value + "<br />";
                }
            }
        }
    }

    tmp_str += "<br />";

    if (annotation.extra_metadata) {
        tmp_str += "<b>Extra Metadata</b> <br />";
        for (var extra_metadata_key in annotation.extra_metadata) {
            var extra_metadata_value = annotation.extra_metadata[extra_metadata_key];
            if ((extra_metadata_value != '') && (extra_metadata_value != '-')) {
                if (extra_metadata_key == 'key') {
                    tmp_str += "<b>" + extra_metadata_key + "</b> : <a href='" + extra_metadata_value + "' target='_blank'\>" + extra_metadata_value + '</a><br />';
                } else {
                    tmp_str += '<b>' + extra_metadata_key + '</b> : ' + extra_metadata_value + "<br />";
                }
            }
        }
    }

    return tmp_str;
};

var experiments_extra_metadata = function(experiment) {
    var tmp_str = annotations_extra_metadata(experiment);

    return "<div class='exp-metadata'>" + tmp_str + "</div><div class='exp-metadata-more-view'>-- View metadata --</div>";
};

function addSelected(experiments) {
    var experiment_ids = experiments.map(function(a) { return a[0]});
    console.log(experiment_ids.length);
    var experiment_info_request = $.ajax({
        url: "api/info",
        type : "GET",
        data : {
            id : experiment_ids,
            user_key : user_key
        },
        dataType: "json"
    });

    experiment_info_request.done(function (data) {
        experiments = [];
        for (e in data[1]) {
            var experiment_info = data[1][e];
            var id = experiment_info["_id"];
            var name = experiment_info['name'];
            var type = experiment_info['data_type'];
            var desc = experiment_info['description'];
            var genome = experiment_info['genome'];
            var epigenetic_mark = experiment_info['epigenetic_mark'];
            var biosource = experiment_info['sample_info']['biosource_name'];
            var samp = experiment_info['sample_id'];
            var tech = experiment_info['technique'];
            var project = experiment_info['project'];
            var meta = experiments_extra_metadata(experiment_info);
            var prev = "<button id='" + id + "' type='button' class='btn btn-default preview-experiment'><i class='fa fa-search'></i></button>";

            var experiment = [ id, name, type, desc, genome, epigenetic_mark, biosource, samp, tech, project, meta, prev];

            if (selected.indexOf(id) < 0) {
                selected.push(id);
                selectedData.push(experiment);
                selectedNames.push(experiment[1]);
                experiments.push(experiment);
                selectedCount[normalize(biosource)][normalize(epigenetic_mark)] = selectedCount[normalize(biosource)][normalize(epigenetic_mark)] + 1;
            }
        }

        if (experiments.length > 0) {
            $('#datatable_selected_column').dataTable().fnAddData(experiments);
            $('#downloadBtnBottom').removeAttr('disabled');
            $('#exportBtnBottom').removeAttr('disabled');
        }

    });
}

function addToList(list_id, element, badge, active) {

    // build required variables
    var elem_id = element;
    var badge_id = element + "_badge_id";
    var style_string = "";

    if (list_id == "#projects-spill" || list_id == "#projects-main") {
        // include colors legend
        style_string =  "style='background-color: " + cell_colors[element] + "'";
    }

    if (active) {
        var elem_string = "<a class='list-group-item active' id='" + elem_id + "' onclick='selectHandler(this, true)'><span class='badge' " + style_string + " id='" +
            badge_id + "'>" + badge + "</span>" + element + "</a>";
    }
    else {
        var elem_string = "<a class='list-group-item' id='" + elem_id + "' onclick='selectHandler(this, true)'><span class='badge' " + style_string + " id='" +
            badge_id + "'>" + badge + "</span>" + element + "</a>";
    }

    $(elem_string).appendTo(list_id);
}

function emulateClick(id, pull_data) {
    var elements = $("a[id='"+id+"']");
    if (elements.length == 0) {
        return;
    }
    selectHandler(elements[0], pull_data);
}

function selectHandler(e, pull_data) {
    filter_active = true;
    var selList = $(e).parent(".list-group").attr('name');
    var selElemName = e.id;

    toggleSelectAll[selList] = false;
    if ($(e).hasClass('active')) {
        var ind = filters[selList].indexOf(selElemName);
        $(e).removeClass('active');
        filters[selList].splice(ind, 1);
    }
    else {
        $(e).addClass('active');
        filters[selList].push(selElemName);
    }
    // update filter, pull data and prepend selections
    if (pull_data) {
        // show loading
        $("#"+selList+"-i").addClass("fa fa-spinner fa-spin fa-fw");
        pullData(++request_id);
    }
}

function initPreviewModal() {

    $("#datatable_selected_column").on("click", '.preview-experiment', function (e) {
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
            swal({
                title: "Error loading experiment preview",
                text: textStatus,
                type: "error"
            });
            e.stopPropagation();
        });
    });
}

function toggleMetadata() {
    $("#datatable_selected_column").on("click", '.exp-metadata-more-view', function (e) {
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
}

var normalize = function(name) {
    return name.toLowerCase().replace(/[\W_]+/g, "");
};

function removeSelectedRow() {
    /* remove selection by clicking of row in the selection table*/
    $('#datatable_selected_column').on('dblclick', 'tr', function () {
        var id = $('td', this).eq(0).text();
        if (id ==  "") {
            return;
        }
        var bio = $('td', this).eq(6).text();
        var epi = $('td', this).eq(5).text();

        selectedCount[normalize(bio)][normalize(epi)] = selectedCount[normalize(bio)][normalize(epi)] - 1;
        var current_cell = otable.cells(
            function ( idx, data, node ) {
                if ($(node).attr('data-col') == undefined) {
                    return false;
                }
                if ($(node).attr('data-row') == undefined) {
                    return false;
                }
                if(($(node).attr('data-row') == bio) && (normalize($(node).attr('data-col')) == normalize(epi))) {
                    return true;
                }
                return false;
            }
        ).nodes();
        current_cell.to$().removeClass("selected-grid-cell");

        if (selectedCount[normalize(bio)][normalize(epi)] != 0) {
            current_cell.to$().addClass("unselected-grid-cell");
        }
        else {
            var anchor_cell = otable.cells(
                function ( idx, data, node ) {
                    if(($(node).attr('data-row') == bio) && ($(node).attr('data-col') == undefined)) {
                        return true;
                    }
                    return false;
                }
            ).nodes();
            anchor_cell.to$().removeClass("selected-grid-cell");
            current_cell.to$().removeClass("unselected-grid-cell");
        }

        var index = selected.indexOf(id);
        selected.splice(index,1);
        selectedData.splice(index,1);
        selectedNames.splice(index,1);


        $('#datatable_selected_column').dataTable().fnDeleteRow(index);

        if (selectedData.length == 0) {
            $('#downloadBtnBottom').attr('disabled','disabled');
            $('#exportBtnBottom').attr('disabled','disabled');
        }
    });
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
        // Adding from behind so that collections with more experiment comes first
        // process selected elements first
        var k = 0;
        for(j=currentvocab_size1-1; j >= 0; j--) {
            var currentElem1 = currentvocab1[j][1];
            var currentBadge1 = currentvocab1[j][2];

            if (filters[vocabid].indexOf(currentElem1) >= 0) {
                filtered_elements.push(currentElem1);
                addToList(list_id_main, currentElem1, currentBadge1, true);
            }

            if(filtered_elements.length >= filters[vocabid].length) {
                // console.log("break", vocabid);
                break;
            }
        }

        // add returned but unselected elements
        for(j=currentvocab_size1-1; j >= 0; j--) {
            var currentElem1 = currentvocab1[j][1];
            if ($.inArray(currentElem1, filtered_elements) < 0) {
                var currentBadge1 = currentvocab1[j][2];

                filtered_elements.push(currentElem1);
                if (filtered_elements.length > size_main) {
                    addToList(list_id_spill, currentElem1 , currentBadge1, false);
                }
                else {
                    addToList(list_id_main, currentElem1 , currentBadge1, false);
                }
            }
        }

        var currentvocab2 = list_in_use_full[vocabname]['alp'];
        //var currentvocab_size2 = currentvocab2.length;

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

        // hide loading
        $("#"+vocabid+"-i").removeClass("fa fa-spinner fa-spin fa-fw");
    }
}

function initFilters(active) {

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
                addToList(list_id_spill, currentElem , currentBadge, active);
            }
            else {
                addToList(list_id_main, currentElem , currentBadge, active);
            }
        }
    }
}

function toggleDefaults() {
    var pull_data = false;
    var default_datatypes = getDefaultsDataTypes();

    for (var d in default_datatypes) {
        emulateClick(default_datatypes[d], false);
        pull_data = true;
    }

    if (default_project != "") {
        emulateClick(default_project, false);
        pull_data = true;
    }

    if (default_type != "") {
        emulateClick(default_type, false);
        pull_data = true;
    }

    // update filter, pull data and prepend selections
    if (pull_data) {
        pullData(++request_id);
    }

}

function toggleButton(id) {
    $("#"+id).find('i').toggleClass('fa fa-plus-square-o fa fa-minus-square-o');
}

function jumpToDownload() {
    $('html, body').animate({
        scrollTop: $("#selection-table").offset().top
    }, 100);
}

function init_projects() {
    var p_vocab = list_in_use['projects']['amt'];
    for (j in p_vocab) {
        all_projects.push(p_vocab[j][1])
    }
}

function initPage() {
    selected = [];
    filter_active = false;
    vocabnames = ["projects","genomes", "techniques", "epigenetic_marks", "biosources", "types"];
    vocabids = ['experiment-project','experiment-genome', "experiment-technique", "experiment-epigenetic_mark", "experiment-biosource", "experiment-datatype"];
    cell_colors = {'BLUEPRINT Epigenome': 'lightblue','DEEP': 'lightgoldenrodyellow','ENCODE': 'lavender', 'Roadmap Epigenomics': 'lightsteelblue', 'others': 'lightskyblue'};
    size_main = 4;
    defaults = {};
    selectedData = []; // selected experiment
    selectedNames = []; // selected experiment name
    selectedCount = {}; // selected experiment counter
    selected = [];
    set_all_projects = false;
    all_projects = [];
    request_id = 0;

    filters = {};
    toggleSelectAll = {};

    init();
}

function gridPage(project, type) {

    initPage();

    default_project = project;
    default_type = type;

    // initialize the clipboard js
    new Clipboard('.btn');

    pullData(request_id);

    // initialize the sticker after the intial loading
    $("#gridScroll").sticky({topSpacing:100, bottomSpacing:800});

    // selected datatable
    otable2 = $('#datatable_selected_column').DataTable({
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

    removeSelectedRow();
    toggleMetadata();


    initPreviewModal();
}
