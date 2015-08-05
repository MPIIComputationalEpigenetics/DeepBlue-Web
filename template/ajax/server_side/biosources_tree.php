<?php

/**
*   DeepBlue Epigenomic Data Server
*   Copyright (c) 2014 Max Planck Institute for Computer Science.
*   All rights reserved.
*
*   File : biosources_tree.php
*
*   Felipe Albrecht <felipe.albrecht@mpi-inf.mpg.de>
*   Umidjon Urunov <umidjon.urunov@mpi-inf.mpg.de>
*
*   Created : 14-10-2014
*/

/* DeepBlue Configuration */
require_once("../../lib/lib.php");
require_once("../../lib/error.php");
require_once("../../lib/server_settings.php");

/* include IXR Library for RPC-XML */
require_once("../../lib/deepblue.IXR_Library.php");


function get_ontology_id($bs_id, &$client, &$user_key)
{
	if(!$client->query("info", $bs_id, $user_key)){
		die('An error occurred - '.$client->getErrorCode().":".$client->getErrorMessage());
	}

	$response = $client->getResponse();
	check_error($response);
	
	if ($response[0] == "okay") {
		$bs_info = $response[1];
		if (isset($bs_info[0]["extra_metadata"]["url"])) {
			return $bs_info[0]["extra_metadata"]["url"];
		}
	}
	return "";
}

$client = new IXR_Client(get_server());
if(!$client->query("list_in_use", "biosources", $user_key)){
    die('An error occurred - '.$client->getErrorCode().":".$client->getErrorMessage());
}
else{
    $biosourceList[] = $client->getResponse();
    check_error($biosourceList);
}

$bioSourceNames = array();

foreach ($biosourceList[0][1] as $bioSource) {
	$url = get_ontology_id($bioSource[0], $client, $user_key);
    $bioSourceNames[] = array($bioSource[0], $bioSource[1], $bioSource[2], array(), $url);
}

$all_nodes = array();
$nodes = array();
foreach($bioSourceNames as $bioSource) {
	$nodes[$bioSource[1]] = $bioSource;
}

function exists(&$parent, &$leaf, &$parent_nodes, &$root_nodes)
{
	foreach($parent_nodes as &$parent_node) {

		if ($parent_node[1] == $parent) {
			$parent_node[3][] = &$leaf;

			if (isset($root_nodes[$leaf[1]])) {
				unset($root_nodes[$leaf[1]]);
			}
			return True;
		}
		$value = exists($parent, $leaf, $parent_node[3], $root_nodes);
		if ($value == True) {
			return True;
		}
	}
	return false;
}

$actual_leaves = $bioSourceNames;
while (sizeof($actual_leaves) > 0) {

	$new_leaves = array();
	foreach ($actual_leaves as &$leaf) {
		if(!$client->query("get_biosource_parents", $leaf[1], $user_key)){
		    die('An error occurred - '.$client->getErrorCode().":".$client->getErrorMessage());
		}
		else{
	    	$parentsList = $client->getResponse();
	    	check_error($parentsList);
	    	
	    	foreach($parentsList[1] as &$parent) {
	    		$update = exists($parent[1], $leaf, $nodes, $nodes);
	    		if ($update == false) {
	    			$url = get_ontology_id($parent[0], $client, $user_key);
	    			$all_nodes[$parent[1]] = array($parent[0], $parent[1], 0, array($leaf), $url);
					$nodes[$parent[1]] = &$all_nodes[$parent[1]];
					$new_leaves[] = &$all_nodes[$parent[1]];
					unset($nodes[$leaf[1]]);
				}
	    	}
		}
	}

	$actual_leaves = $new_leaves;
}

echo json_encode(array('data' => $nodes));

?>