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

var request1 = $.ajax({
	url: "ajax/server_side/list_in_use.php",
	dataType: "json",
	data : {
		request : vocabulary
	}
});

request1.done( function(data) {
	// store data in local storage
	localStorage.setItem("list_in_use", JSON.stringify(data[0]));
});

request1.fail( function(jqXHR, textStatus) {
	console.log(jqXHR);
    console.log('Error: '+ textStatus);
	alert( "Encountered an error. Please wait a few seconds and reload page. If problem persist, kindly log a complaint" );
});


/* retrieve deepblue list_experiment data */
var request2 = $.ajax({
	url: "ajax/server_side/list_all_experiment.php",
	dataType: "json",
	data : {
	}
});

request2.done( function(data) {
	// store data in local storage
	localStorage.setItem("all_experiments", JSON.stringify(data[0]));
});

request2.fail( function(jqXHR, textStatus) {
	console.log(jqXHR);
    console.log('Error: '+ textStatus);
    alert( "Encountered an error. Please wait a few seconds and reload page. If problem persist, kindly log a complaint" );
});
