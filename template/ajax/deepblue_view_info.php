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
*   Created : 05-08-2015
*
*   ================================================
*
*   File : deepblue_view_info.php
*
*/

require_once("../lib/lib.php");
require_once("inc/init.php");

?>
<div class="row">
    <div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
        <h1 class="page-title txt-color-blueDark">
            <i class="fa fa-info-circle fa-fw "></i>
                DeepBlue data info
            </span>
        </h1>
    </div>

	<div class="col-sm-12">

		<div id="info_content" class="tab-content bg-color-white padding-10">
			<div class="tab-pane fade in active" id="s1">
				<br />
				<div class="alert alert-info alert-block">
					<a class="close" data-dismiss="alert" href="#">×</a>
					<h6 class="alert-heading">Information</h6>
					Each data item in DeepBlue has an internal ID, e.g., the ID <i>e16917</i> refers to the experiment named <i>E002-H3K9ac.narrowPeak.bed</i> from the <i>Roadmap Epigenomics</i> project.<br/>
					If you want to look up all information linked to a DeepBlue ID, enter the ID in the above field and click <i>enter</i> or the <i>info</i> button.
					<h6 class="alert-heading">Examples</h6>
					The ID <i>g1</i> refers to the genome assembly <i>hg19</i>.<br/>
					The ID <i>em60</i> refers to the Epigenetic Mark <i>H3K27ac</i><br/>
					The ID <i>a10</i> refers to the annotation <i>Cpg Islands</i> for the genome assembly <i>hg19</i>.
				</div>
				<div class="input-group input-group-lg hidden-mobile">
					<input id="query_input" class="form-control input-lg" type="text" placeholder="Enter ID" />
					<div class="input-group-btn">
						<button type="button" id="query_bt" class="btn btn-default">
							&nbsp;&nbsp;&nbsp;<i class="fa fa-fw fa-info-circle fa-lg"></i>&nbsp;&nbsp;&nbsp;
						</button>
					</div>
				</div>
				<div id="tempInfoResult"></div>
			</div>
			<div class='clear'></div>
		</div>
	</div>
</div>

<script type="text/javascript">

	$("#query_input").focus();
	$("#query_bt").button().click(query_function);

	function query_function() {

		$id = $('#query_input').val();

		/* Checking query if is empty or not */
		if($id == ''){
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
				id : $id
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
			}
		});

		request.fail( function(jqXHR, textStatus) {
			console.log(jqXHR);
	        console.log('Error: '+ textStatus);
			alert( "error" );
		});
	}

	/* Trigger searching with pressing ENTER Key */
	$("#query_input").keyup(function(event){
		if(event.keyCode == 13){
		    query_function();
		}
	});
</script>