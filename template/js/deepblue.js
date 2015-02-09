/*
*   DeepBlue Epigenomic Data Server
*   Copyright (c) 2014 Max Planck Institute for Computer Science.
*   All rights reserved.
*
*   File : deepblue.js
*	
*	Process deepblue wide client-side script functionalities such as:
*		> Retrieving all required deepblue data to the browser
*
*   Felipe Albrecht <felipe.albrecht@mpi-inf.mpg.de>
*   Obaro Odiete <s8obodie@stud.uni-saarland.de>
*
*   Created : 08-02-2015
*/

/* retrieve deepblue list_in_use data */
var vocabulary = ["projects","epigenetic_marks", "biosources", "techniques", "genomes"];
var list_in_use = [];

var request = $.ajax({
	url: "ajax/server_side/list_in_use.php",
	dataType: "json",
	data : {
		request : vocabulary
	}
});

request.done( function(data) {
	// store data in local storage
	localStorage.setItem("list_in_use", JSON.stringify(data[0]));
});

request.fail( function(jqXHR, textStatus) {
	console.log(jqXHR);
    console.log('Error: '+ textStatus);
	alert( "error" );
});