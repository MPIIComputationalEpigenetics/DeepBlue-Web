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
*   File : api.js
*
*/

function list_genomes(url, userkey) {
	// function to call the list_genomes server commmand
	var request = new XmlRpcRequest(url, "list_genomes");
	request.addParam(userkey);
	var response = request.send();
	var result = response.parseXML();
	if (result[0] == "okay") {
		return result[1];
	}
};

function list_epigenetic_marks(url, userkey) {
	// function to call the list_epigenetic_marks commmand
	var request = new XmlRpcRequest(url, "list_epigenetic_marks");
	request.addParam(userkey);
	var response = request.send();
	var result = response.parseXML();

	if (result[0] == "okay") {
		return result[1];
	}	
};

function list_biosources(url, userkey) {
	// function to call the list_biosources server function
	var request = new XmlRpcRequest(url, "list_biosources");
	request.addParam(userkey);
	var response = request.send();
	var result = response.parseXML();
	
	if (result[0] == "okay") {
		return result[1];
	}	
};

function list_sample_fields(url, userkey) {
	// function to call the list_sample_fields server function
	var request = new XmlRpcRequest(url, "list_sample_fields");
	request.addParam(userkey);
	var response = request.send();
	var result = response.parseXML();

	if (result[0] == "okay") {
		return result[1];
	}	
};

function list_samples(url, userkey) {
	// function to call the list_sample_fields server function
	var request = new XmlRpcRequest(url, "list_samples");
	request.addParam(document.getElementById("biosource").value);	
	request.addParam("{}");
	request.addParam(userkey);
	var response = request.send();
	var result = response.parseXML();

	if (result[0] == "okay") {
		return result[1];
	}	
};

function list_techniques(url, userkey) {

	var request = new XmlRpcRequest(url, "list_techniques");
	request.addParam(userkey);
	var response = request.send();
	var result = response.parseXML();
	if (result[0] == "okay") {
		return result[1];
	}	
};

function list_projects(url, userkey) {
	var request = new XmlRpcRequest(url, "list_projects");
	request.addParam(userkey);
	var response = request.send();
	var result = response.parseXML();

	if (result[0] == "okay") {
		return result[1];
	}	
};

function get_version(url, userkey) {
	// function to get the version of the server
	var request = new XmlRpcRequest(url, "echo");
	request.addParam(userkey);
	var response = request.send();
	var result = response.parseXML()
	if (result[0] == "okay") {
		return result[1];
	}	
};

function list_in_use(vocabulary, url, userkey) {
	// function to call the list_in_use command
	
	var request = new XmlRpcRequest(url, "list_in_use");
	request.addParam(vocabulary);											 
	request.addParam(userkey);

	var response = request.send();
	var result = response.parseXML();

	if (result[0] == "okay") {
		return result[1];
	}
}
