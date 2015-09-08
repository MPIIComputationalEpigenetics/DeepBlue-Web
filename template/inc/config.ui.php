<?php

/**
*   DeepBlue Epigenomic Data Server
*   Copyright (c) 2014 Max Planck Institute for Computer Science.
*   All rights reserved.
*
*   File : config.ui.php
*
*   Felipe Albrecht <felipe.albrecht@mpi-inf.mpg.de>
*   Umidjon Urunov <umidjon.urunov@mpi-inf.mpg.de>
*
*   Created : 25-08-2014
*/


//CONFIGURATION for SmartAdmin UI

//ribbon breadcrumbs config
//array("Display Name" => "URL");
$breadcrumbs = array(
	"Home" => APP_URL
);

/*navigation array config

ex:
"dashboard" => array(
	"title" => "Display Title",
	"url" => "http://yoururl.com",
	"url_target" => "_blank",
	"icon" => "fa-home",
	"label_htm" => "<span>Add your custom label/badge html here</span>",
	"sub" => array() //contains array of sub items with the same format as the parent
)
*/

$page_nav = array(

	"dashboard" => array(
		"title" => "Dashboard",
		"url" => "ajax/dashboard.php",
		"icon" => "fa-home"
	),

	"search" => array(
		"title" => "Search",
		"url"=> "ajax/deepblue_view_search.php",
		"icon" => "fa-search"
	),

	"info" => array(
		"title" => "Info",
		"url"=> "ajax/deepblue_view_info.php",
		"icon" => "fa-info-circle"
	),

	"info" => array(
		"title" => "Remove",
		"url"=> "ajax/deepblue_remove_data.php",
		"icon" => "fa-minus-square"
	),
    
	"deepblue_tables" => array(
		"title" => "Data Tables",
		"icon" => "fa-table",
		"sub" => array(
			"annotations" => array(
				"title" => "Annotations",
				"url" => "ajax/deepblue_view_annotations.php"
			),
			"experiments" => array(
				"title" => "Experiments",
				"url" => "ajax/deepblue_view_experiments.php"
			),
			"genomes" => array(
				"title" => "Genomes",
				"url" => "ajax/deepblue_view_genomes.php"
			),
			"epigenetic_marks" => array(
				"title" => "Epigenetic Marks",
				"url" => "ajax/deepblue_view_epigenetic_marks.php"
			),
			"biosources" => array(
				"title" => "BioSources",
				"url" =>"ajax/deepblue_view_biosources.php"
			),
			"samples" => array(
				"title" => "Samples",
				"url" => "ajax/deepblue_view_samples.php"
			),
			"techniques" => array(
				"title" => "Techniques",
				"url" =>"ajax/deepblue_view_techniques.php"
			),
			"projects" => array(
				"title" => "Projects",
				"url" => "ajax/deepblue_view_projects.php"
			),
			"column_types" => array(
				"title" => "Column types",
				"url" => "ajax/deepblue_view_column_types.php"
			)
		)
	),

	"biosources_hierarchy" => array(
		"title" => "BioSources - Hierarchy",
		"url"=> "ajax/deepblue_view_biosources_hierarchy.php",
		"icon" => "fa-sitemap"
	),

	"insert_data" => array(
		"title" => "Insert Data",
		"icon" => "fa-suitcase",
		"sub" => array(
			"Annotation" => array(
				"title" => "Annotation",
				"url"=> "ajax/deepblue_insert_annotation.php",
				"icon" => "fa-tags"
			)
		)
	),

	"data_curation" => array(
		"title" => "Data Curation",
		"icon" => "fa-edit",
		"sub" => array(
			"clone" => array(
				"title" => "Experiments Cloning",
				"url"=> "ajax/deepblue_clone_dataset.php",
				"icon" => "fa-copy"
			)
		)
	),

	"deepblue_request" => array(
		"title" => "Manage Request",
		"url"=> "ajax/deepblue_manage_request.php",
		"icon" => "fa-shopping-cart"
	),

	"deepblue_workflow" => array(
		"title" => "Workflow",
		"url"=> "ajax/deepblue_view_workflow.php",
		"icon" => "fa-bullhorn"
	),

	"documentation" => array(
		"title" => "Documentation",
		"icon" => "fa-question",
		"sub" => array(
			"API Reference" => array(
				"title" => "API Reference",
				"url" => "ajax/deepblue_api_documentation.php",
				"icon" => "fa-list-ul"
			),
			"Manual" => array(
				"title" => "DeepBlue Manual",
				"url" => "ajax/deepblue_manual_documentation.php",
				"icon" => "fa-book"
			),
			"Tutorials" => array(
				"title" => "Tutorials",
				"url" => "ajax/deepblue_tutorial.php",
				"icon" => "fa-graduation-cap"
			)			
		)
	),

	"feedback" => array(
		"title" => "Feedback",
		"url"=> "ajax/deepblue_view_feedback.php",
		"icon" => "fa-step-backward"
	)
);

//configuration variables
$page_title = "DeepBlue Epigenomic Data Server - Web Interface";
$page_css = array();
$no_main_header = false; //set true for lock.php and index.php
$page_body_prop = array(); //optional properties for <body>
$page_html_prop = array(); //optional properties for <html>

?>