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
*   Created : 06-09-2015
*
*   ================================================
*
*   File : deepblue_remove_data.php
*
*/

require_once("../lib/lib.php");
require_once("inc/init.php");

?>
<div class="row">

	<div class="col-sm-12">

		<div id="myTabContent1" class="tab-content bg-color-white padding-10">
			<div class="tab-pane fade in active" id="s1">
				<h1> Deepblue remove data </h1>
				<br>
				<div class="input-group input-group-lg hidden-mobile">
					<input id="query_input" class="form-control input-lg" type="text" placeholder="Enter ID" />
					<div class="input-group-btn">
						<button type="button" id="query_bt" class="btn btn-default">
							&nbsp;&nbsp;&nbsp;<i class="fa fa-fw fa-search fa-lg"></i>&nbsp;&nbsp;&nbsp;
						</button>
					</div>
				</div>
				<div id="tempInfoResult"></div>
			</div>
			<div class='clear'></div>
            <div style="text-align:right;">
                <button type="button" id="remove_bt" class="btn btn-primary" disabled>
                    &nbsp;&nbsp;&nbsp;Remove&nbsp;&nbsp;&nbsp;
                </button>
            </div>
        </div>
	</div>
</div>

<script type="text/javascript">

	$("#query_input").focus();
	$("#query_bt").button().click(query_function);
    $("#remove_bt").button().click(remove_function);

    var id;

	function query_function() {

		id = $('#query_input').val();

		/* Checking query if is empty or not */
		if(id == ''){
			$( "#tempInfoResult" ).empty();
            $( "#tempInfoResult" ).append( "<br\><div class='alert alert-danger fade in'><button class='close'" +
                    " data-dismiss='alert'>×</button><i class='fa-fw fa fa-times'></i><strong>Error!</strong> " +
                    "Enter a valid ID, ID cannot be empty!</div>");
			return;
		}

		var request = $.ajax({
			url: "ajax/server_side/info_server_processing.php",
			dataType: "json",
			data : {
				id : id
			}
		});

		request.done( function(data) {
			$( "#tempInfoResult" ).empty();
			if ('error' in data) {
				var msg = data['message'];
                $( "#tempInfoResult" ).append( "<br\><div class='alert alert-danger fade in'><button class='close'" +
                        " data-dismiss='alert'>×</button><i class='fa-fw fa fa-times'></i> " + msg +"</div>");
			}
			else {
				$.each(data.data, function(i, item) {
				    $( "#tempInfoResult" ).append( "<div class='search-results clearfix'>"+
				    	"<h4><span class='seach-result-title'><i class='fa fa-star txt-color-yellow'></i> <b>"+item[0]+ "</b> - <span>" + item[1]+ "</span></span></h4>"+
				    "<div><p class='note'><span><i class='fa fa-circle txt-color-black'></i> " + item[4] +" "+ item[5] +" "+ item[6] +" "+ item[7] +" "+ item[8] +" "+ item[9] + "</span></p>"+
				    "<p class='description marginTop'>" + item[2] +"</p></div>"+
				    "<div class='searchMetadata'>"+item[3]+"</div></div>" );
			    });
                $("#remove_bt").prop('disabled', false);
                $("#remove_bt").focus();
			}
		});

		request.fail( function(jqXHR, textStatus) {
			console.log(jqXHR);
	        console.log('Error: '+ textStatus);
			alert( "error" );
		});
	}

    function remove_function() {
        swal({
            title: "Are you sure?",
            text: "You will not be able to recover this data!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, delete it!",
            closeOnConfirm: true },

            function(){
               	var request = $.ajax({
                    url: "ajax/server_side/remove_server_processing.php",
                    dataType: "json",
                    data : {
                        id : id
                    }
                });
                request.done( function(data) {
                    $( "#tempInfoResult" ).empty();
                    $("#remove_bt").prop('disabled', true);
                    if ('error' in data) {
                        var msg = data['message'];
                        $( "#tempInfoResult" ).append( "<br\><div class='alert alert-danger fade in'><button class='close'" +
                        	" data-dismiss='alert'>×</button><i class='fa-fw fa fa-times'></i>Error encountered deleting '"+id+"' : " + msg +"</div>");
                    }
                    else {
                        $('#query_input').val("");
                        swal("Removed!", id + " has been removed", "success");
                    }
                });
                request.fail( function(jqXHR, textStatus) {
                    console.log(jqXHR);
                    console.log('Error: '+ textStatus);
                    alert( "error" );
                });
            }
        );
    }

	/* Trigger searching with pressing ENTER Key */
	$("#query_input").keyup(function(event){
		if(event.keyCode == 13){
		    query_function();
		}
	});
</script>