/**
*   DeepBlue Epigenomic Data Server
*   Copyright (c) 2014 Max Planck Institute for Computer Science.
*   All rights reserved.
*
*   Authors :
*
*   Obaro Odiete <s8obodie@stud.uni-saarland.de>
*
*
*   Created : 04-12-2014
*
*   ================================================
*
*   File : deepblue.js
*
*/

function load_dashboard_chart(chart_pos, chart_name, width, result) {
	// function to load charts into dashboard

	// add charts
	$('#'+ chart_pos).append('<canvas class="dashboard-canvass" id="' + chart_name + '"width="' + width + '" height= 600"></canvas>');
	
	// setup charts
	var ctx = document.getElementById(chart_name).getContext("2d");
	var data_chart = new Chart(ctx);

	var chart_label = new Array();
	var chart_data = new Array();
	
	for (i=0; i < result.length; i++) {
		chart_label[i] = result[i][1];
		chart_data[i] = result[i][2];
	}
	
	var data = {
		labels: chart_label,
		datasets: [
			{
					label: "Dataset",
					fillColor: "rgba(151,187,205,0.5)",
					strokeColor: "rgba(151,187,205,0.8)",
					highlightFill: "rgba(151,187,205,0.75)",
					highlightStroke: "rgba(151,187,205,1)",
					data: chart_data
			}
		]
	}

	data_chart.Bar(data);
}

window.onload = function(){
	// call the following function on windows finish loading page
	alert(user_key)
	charts_pos = ['topleft', 'topright', 'bottomleft', 'bottomright'];
	charts_name = ['chart1', 'chart2', 'chart3', 'chart4'];	
	vocabulary = ['projects','epigenetic_marks', 'biosources', 'techniques'];
	width = [400, 600, 1200,600]
	for (j=0; j < charts_pos.length; j++) {
		result = list_in_use(vocabulary[j],url, user_key);
		load_dashboard_chart(charts_pos[j], charts_name[j], width[j], result);
	}
}