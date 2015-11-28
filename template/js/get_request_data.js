/*
*   DeepBlue Epigenomic Data Server
*   Copyright (c) 2014 Max Planck Institute for Computer Science.
*   All rights reserved.
*
*   File : get_request_data.js
*
*   Felipe Albrecht <felipe.albrecht@mpi-inf.mpg.de>
*   Obaro Odiete <s8obodie@stud.uni-saarland.de>
*
*   Created : 27-11-2015
*/

function get_data(request_id, source) {
    var request2 = $.ajax({
        url: "ajax/server_side/get_request_data_server_processing.php",
        dataType: "json",
        data : {
            _id : request_id
        }
    });
    request2.done( function(data) {
        if ("error" in data) {
            var msg = data['message'];
            swal('Get Data', msg, 'error');
            return;
        }
        if (source == 'count') {
            var msg = "Count = " + data[1]['count'];
            swal('Count Regions', msg, 'success');
        }
        else{
            var msg = '';
            for (i=0; i < data[1].length; i++) {
                msg = msg + data[1][i][0] + ": " + data[1][i][1] + "\n";
            }
            swal('Experiments By Query', msg, 'success');
        }
    });

    request2.fail( function(jqXHR, textStatus) {
        console.log(jqXHR);
        console.log('Error: '+ textStatus);
        alert( "Encountered an error. Please wait a few seconds and reload page. If problem persist, kindly log a complaint" );
    });
}

function count_regions(event) {
    var id = event.target.id.split('_')[1];
    get_data(id, 'count');
}

function experiment_query(event) {
    var id = event.target.id.split('_')[1];
    get_data(id, 'query');
}