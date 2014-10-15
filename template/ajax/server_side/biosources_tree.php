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

/* include IXR Library for RPC-XML */
require_once("../../lib/deepblue.IXR_Library.php");

$client = new IXR_Client($url);

if(!$client->query("list_in_use", "biosources", $user_key)){
    die('An error occurred - '.$client->getErrorCode().":".$client->getErrorMessage());
}
else{
    $biosourceList[] = $client->getResponse();
}

$bioSourceNames = array();

foreach ($biosourceList[0][1] as $bioSource) {
        $bioSourceNames[] = array($bioSource[0], $bioSource[1], $bioSource[2], array());
}

$nodes = array();
foreach($bioSourceNames as $bioSource) {
	$nodes[$bioSource[1]] = $bioSource;
}

function exists($biosource, $nodes, $i = 0)
{
	foreach($nodes as $node) {
		if ($node[1] == $biosource) {
			return $node;
		} else {
		}
		$value = exists($biosource, $node[3], $i+1);
		if (isset($value)) {
			return $value;
		}
	}
	return NULL;
}

$actual_leaves = $bioSourceNames;
while (sizeof($actual_leaves) > 0) {
	$new_leaves = array();
	foreach ($actual_leaves as $leaf) {
		if(!$client->query("get_biosource_wider", $leaf[1], $user_key)){
		    die('An error occurred - '.$client->getErrorCode().":".$client->getErrorMessage());
		}
		else{
	    	$parentsList = $client->getResponse();

	    	foreach($parentsList[1] as $parent) {
	    		$existing = exists($parent[1], $nodes);
	    		if (isset($existing)) {

	    			// Summing how many internals experiments it does have
	    			$existing[2] +=  $leaf[2];
					$existing[3][] = $leaf;

					// Unset from the root.
	    			if (isset($nodes[$leaf[1]])) {
	    				unset($nodes[$leaf[1]]);
	    			}

	    			// Update
	    			$nodes[$existing[1]] = $existing;

				} else {
					$nodes[$parent[1]] = array($parent[0], $parent[1], $leaf[2], array($leaf));
					$new_leaves[] = array($parent[0], $parent[1], $leaf[2], array($leaf));
					unset($nodes[$leaf[1]]);
				}
	    	}
		}
	}

	$actual_leaves = $new_leaves;
}

echo json_encode(array('data' => $nodes));

?>