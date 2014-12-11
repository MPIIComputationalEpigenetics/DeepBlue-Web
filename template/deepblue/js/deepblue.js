// JavaScript Document

function list_genomes() {
	// function to call the list_genomes server commmand
	var request = new XmlRpcRequest("http://deepblue.mpi-inf.mpg.de/xmlrpc", "list_genomes");
	request.addParam(document.getElementById("userkey").value);
	var response = request.send();
	var result = response.parseXML();
	if (result[0] == "okay") {
		for (i = 0; i < result[1].length; i++)
			$("#genome").append("<option value=" + result[1][i][1] + ">" + result[1][i][1] + "</option>");
	}	
};

function list_epigenetic_marks() {
	// function to call the list_epigenetic_marks commmand
	var request = new XmlRpcRequest("http://deepblue.mpi-inf.mpg.de/xmlrpc", "list_epigenetic_marks");
	request.addParam(document.getElementById("userkey").value);
	var response = request.send();
	var result = response.parseXML();

	if (result[0] == "okay") {
		for (i = 0; i < result[1].length; i++)
			$("#epigenetic").append("<option value=" + result[1][i][1] + ">" + result[1][i][1] + "</option>");
	}	
};

function list_biosources() {
	// function to call the list_biosources server function
	var request = new XmlRpcRequest("http://deepblue.mpi-inf.mpg.de/xmlrpc", "list_biosources");
	request.addParam(document.getElementById("userkey").value);
	var response = request.send();
	var result = response.parseXML();
	
	if (result[0] == "okay") {
		for (i = 0; i < result[1].length; i++)
			$("#biosource").append("<option value=" + result[1][i][1] + ">" + result[1][i][1] + "</option>");
	}	
};

function list_sample_fields() {
	// function to call the list_sample_fields server function
	var request = new XmlRpcRequest("http://deepblue.mpi-inf.mpg.de/xmlrpc", "list_sample_fields");
	request.addParam(document.getElementById("userkey").value);
	var response = request.send();
	var result = response.parseXML();

	if (result[0] == "okay") {
		for (i = 0; i < result[1].length; i++)
			$("#sample").append("<option value=" + result[1][i][1] + ">" + result[1][i][1] + "</option>");
	}	
};

function list_samples() {
	// function to call the list_sample_fields server function
	var request = new XmlRpcRequest("http://deepblue.mpi-inf.mpg.de/xmlrpc", "list_samples");
	request.addParam(document.getElementById("biosource").value);	
	request.addParam("{}");
	request.addParam(document.getElementById("userkey").value);
	var response = request.send();
	var result = response.parseXML();

	if (result[0] == "okay") {
		for (i = 0; i < result[1].length; i++)
			$("#sample").append("<option value=" + result[1][i][1] + ">" + result[1][i][1] + "</option>");
	}	
};

function list_techniques() {

	var request = new XmlRpcRequest("http://deepblue.mpi-inf.mpg.de/xmlrpc", "list_techniques");
	request.addParam(document.getElementById("userkey").value);
	var response = request.send();
	var result = response.parseXML();
	if (result[0] == "okay") {
		for (i = 0; i < result[1].length; i++)
			$("#technique").append("<option value=" + result[1][i][1] + ">" + result[1][i][1] + "</option>");
	}	
};

function list_projects() {
	
	var request = new XmlRpcRequest("http://deepblue.mpi-inf.mpg.de/xmlrpc", "list_projects");
	request.addParam(document.getElementById("userkey").value);
	var response = request.send();
	var result = response.parseXML();
	if (result[0] == "okay") {
		for (i = 0; i < result[1].length; i++)
			$("#project").append("<option value=" + result[1][i][1] + ">" + result[1][i][1] + "</option>");
	}	
};

function get_version() {
	// function to get the version of the server
	var request = new XmlRpcRequest("http://deepblue.mpi-inf.mpg.de/xmlrpc", "echo");
	request.addParam(document.getElementById("userkey").value);
	var response = request.send();
	var result = response.parseXML()
	if (result[0] == "okay") {
		$("#version").text(result[1].substr(0,18));
	}	
};

function toggle_commands() {
	// function to toggle between the tasks: List Experiments and List Controlled Vocabularies
	if (document.getElementById("listexperiment").checked) {
		// hide the options for the command: List in use
		$("#command1").hide();
		// show the options for the command: List all Experiments
		$("#command2").show();
	}
	
	if (document.getElementById("listinuse").checked) {
		// hide the options for the command: List all Experiments
		$("#command2").hide();
		// show the options for the command: List in use
		$("#command1").show();		
	}
}

window.onload = function(){
	// call the following function on windows finish loading page
  list_genomes()
	list_epigenetic_marks()
	list_biosources()
	list_sample_fields()
	list_techniques()
	list_projects()
	toggle_commands()
	get_version()
}

function plot_chart(result) {
	// function to plot a bar chart of the input, data

	// remove previous chart or table
	$("#chart").remove();
	$("#table").remove();
	
	// add new chart
	$("#container").append('<canvas id="chart" width="400" height="400"></canvas>');

	// setup chart
	var ctx = document.getElementById("chart").getContext("2d");
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
	};

	data_chart.Bar(data);	
}

function draw_table(cols, data) {
	// function to draw the tables, the input are:
	//		cols, is an array of columns name
	//		data, is the data to plot

	// remove previous chart or table
	$("#chart").remove();
	$("#table").remove();
	
	// add new chart
	$("#container").append('<table class="table table-striped" id="table"></table>');

	table = document.getElementById("table");
	var header = table.createTHead();
	headrow = header.insertRow(0);

	// create table header
	for (i=0; i < cols.length; i++) {
		headcell = headrow.insertCell(i); 
		headcell.innerHTML = cols[i];
	}
	
	
	for (j=0; j < data.length; j++) {
		row = table.insertRow(j+1);
		for (k=0; k < cols.length; k++) {
			cell = row.insertCell(k);				
			cell.innerHTML = data[j][k];
		}
	}
}

function list_experiments() {
	// function to call the list_experiments server command
	
	var request = new XmlRpcRequest("http://deepblue.mpi-inf.mpg.de/xmlrpc", "list_experiments");
	var genome = document.getElementById("genome").value;
	var epigenetic = document.getElementById("epigenetic").value;
	var sample = document.getElementById("sample").value;
	var technique = document.getElementById("technique").value;
	var project = document.getElementById("project").value;
	var userkey = document.getElementById("userkey").value;

	request.addParam(genome);
	request.addParam(epigenetic);
	request.addParam(sample);
	request.addParam(technique);
	request.addParam(project);											 
	request.addParam(userkey);

	var response = request.send();
	var result = response.parseXML();

	if (result[0] == "okay") {
		// populate result in table
		data = result[1];
		columns = ["Id", "Name"];
		draw_table(columns, data)
	}
}

function list_in_use() {
	// function to call the list_in_use command
	
	var request = new XmlRpcRequest("http://deepblue.mpi-inf.mpg.de/xmlrpc", "list_in_use");
	var vocabulary = document.getElementById("vocabulary").value;
	var userkey = document.getElementById("userkey").value;

	request.addParam(vocabulary);											 
	request.addParam(userkey);

	var response = request.send();
	var result = response.parseXML();

	if (result[0] == "okay") {
		data = result[1];
	
		// if the data has more than 10 elements, draw a table else plot a graph
		if (data.length > 10) {
			columns = ["Id", "Name", "Count"];
			draw_table(columns, data);
		}
		else {
			plot_chart(data);
		}
	}
}

function filter() {
	// function to process the page submit
	if (document.getElementById("listexperiment").checked) {
		list_experiments();
	}	
	else {
		list_in_use();
	}
}