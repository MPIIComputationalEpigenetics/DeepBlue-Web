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
*   Obaro Odiete <s8obodie@stud.uni-saarland.de>
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
		"icon" => "fa-home",
		"description" => "You can view DeepBlue data displayed using beautiful charts."
	),

	"search" => array(
		"title" => "Search",
		"url"=> "ajax/deepblue_view_search.php",
		"icon" => "fa-search",
		"description" => "You can search everything on DeepBlue server."
	),

	"info" => array(
		"title" => "Info",
		"url"=> "ajax/deepblue_view_info.php",
		"icon" => "fa-info-circle",
		"description" => "You can retrieve information about DeepBlue data."
	),

	"deepblue_tables" => array(
		"title" => "Data Tables",
		"icon" => "fa-table",
		"description" => "You can view and download all DeepBlue data organized into different tables.",
		"sub" => array(
			"annotations" => array(
				"title" => "Annotations",
				"url" => "ajax/deepblue_view_annotations.php",
				"description" => "List all existing annotations in DeepBlue."
			),
			"experiments" => array(
				"title" => "Experiments",
				"url" => "ajax/deepblue_view_experiments.php",
				"description" => "Shows deepblue experiments."
			),
			"genomes" => array(
				"title" => "Genomes",
				"url" => "ajax/deepblue_view_genomes.php",
				"description" => "List all existing genomes in DeepBlue."
			),
			"epigenetic_marks" => array(
				"title" => "Epigenetic Marks",
				"url" => "ajax/deepblue_view_epigenetic_marks.php",
				"description" => "List all existing epigenetic marks in DeepBlue."
			),
			"biosources" => array(
				"title" => "BioSources",
				"url" =>"ajax/deepblue_view_biosources.php",
				"description" => "List all existing biosources in DeepBlue."
			),
			"samples" => array(
				"title" => "Samples",
				"url" => "ajax/deepblue_view_samples.php",
				"description" => "List all existing samples in DeepBlue."

			),
			"techniques" => array(
				"title" => "Techniques",
				"url" =>"ajax/deepblue_view_techniques.php",
				"description" => "List all existing techniques in DeepBlue."
			),
			"projects" => array(
				"title" => "Projects",
				"url" => "ajax/deepblue_view_projects.php",
				"description" => "List all existing projects in DeepBlue."
			),
			"column_types" => array(
				"title" => "Column types",
				"url" => "ajax/deepblue_view_column_types.php",
				"description" => "List all available column types in DeepBlue."
			)
		)
	),

	"biosources_hierarchy" => array(
		"title" => "BioSources - Hierarchy",
		"url"=> "ajax/deepblue_view_biosources_hierarchy.php",
		"icon" => "fa-sitemap",
		"description" => "You can view DeepBlue experiments retrieved from their biosource hierarchy."
	),

   	"deepblue_request" => array(
		"title" => "Manage Requests",
		"url"=> "ajax/deepblue_manage_request.php",
		"icon" => "fa-shopping-cart",
		"description" => "You can view and download all your download requests."
	),

	"insert_data" => array(
		"title" => "Insert Data",
		"icon" => "fa-suitcase",
		"description" => "You can insert new data such as annotations, column_types into DeepBlue",
		"sub" => array(
			"insert_annotation" => array(
				"title" => "Annotation",
				"url"=> "ajax/deepblue_insert_annotation.php",
				"icon" => "fa-tags",
				"description" => "Insert a new annotation."

			),
			"insert_column_type" => array(
				"title" => "Column Type",
				"url"=> "ajax/deepblue_create_column_type.php",
				"icon" => "fa-columns",
				"description" => "Insert a new column type."
			)
		)
	),

	"data_curation" => array(
		"title" => "Curate Data",
		"icon" => "fa-edit",
		"description" => "You can clone and edit other DeepBlue data.",
		"sub" => array(
			"clone" => array(
				"title" => "Experiments Cloning",
				"url"=> "ajax/deepblue_clone_dataset.php",
				"icon" => "fa-copy",
				"description" => "Allows experiments cloning."

			)
		)
	),

	"remove" => array(
		"title" => "Remove Data",
		"url"=> "ajax/deepblue_remove_data.php",
		"icon" => "fa-minus-square",
		"description" => "You can completely remove your data from DeepBlue."
	),

/*	"deepblue_workflow" => array(
		"title" => "Workflow",
		"url"=> "ajax/deepblue_view_workflow.php",
		"icon" => "fa-bullhorn"
	),*/

	"documentation" => array(
		"title" => "Documentation",
		"icon" => "fa-question",
		"description" => "You can view DeepBlue's extensive documentation, manual and tutorials.",
		"sub" => array(
			"api_reference" => array(
				"title" => "API Reference",
				"url" => "ajax/deepblue_api_documentation.php",
				"icon" => "fa-list-ul",
				"description" => "Displays the API commands used in DeepBlue."
			),
			"manual" => array(
				"title" => "DeepBlue Manual",
				"url" => "ajax/deepblue_manual_documentation.php",
				"icon" => "fa-book",
				"description" => "DeepBlue Manual for more information"
			),
			"tutorials" => array(
				"title" => "Tutorials",
				"url" => "ajax/deepblue_tutorial.php",
				"icon" => "fa-graduation-cap",
				"description" => "Display short tutorials for common tasks performed on DeepBlue Web Application"
			),
            "examples" => array(
                "title" => "Examples",
                "url" => "ajax/deepblue_examples.php",
                "icon" => "fa-pencil",
                "description" => "Display usage examples of the DeepBlue API"
            )
		)
	),

	"feedback" => array(
		"title" => "Feedback",
		"url"=> "ajax/deepblue_view_feedback.php",
		"icon" => "fa-step-backward",
		"description" => "You can give feedback to improve DeepBlue"
	),

	"acknowledgement" => array(
		"title" => "Acknowledgements",
		"url"=> "ajax/deepblue_acknowledgements.php",
		"icon" => "fa-university",
		"description" => "You can view the people and institutions working on or funding the DeepBlue project"
	)
);

//configuration variables
$page_title = "DeepBlue Epigenomic Data Server - Web Interface";
$page_css = array();
$no_main_header = false; //set true for lock.php and index.php
$page_body_prop = array(); //optional properties for <body>
$page_html_prop = array(); //optional properties for <html>

?>