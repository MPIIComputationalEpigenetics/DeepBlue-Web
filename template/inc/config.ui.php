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
        "description" => "Overview of DeepBlue data.",
         "elevated" => false
    ),

    "grid" => array(
        "title" => "Grid",
        "url"=> "ajax/deepblue_view_grid.php",
        "icon" => "fa-th",
        "description" => "Display DeepBlue with grid.",
         "elevated" => false
    ),

    "search" => array(
        "title" => "Search",
        "url"=> "ajax/deepblue_view_search.php",
        "icon" => "fa-search",
        "description" => "Perform full text search on DeepBlue data.",
        "elevated" => false
    ),

    "info" => array(
        "title" => "Info",
        "url"=> "ajax/deepblue_view_info.php",
        "icon" => "fa-info-circle",
        "description" => "Obtain information about DeepBlue data.",
        "elevated" => false
    ),

    "experiments" => array(
        "title" => "Experiments data",
        "url" => "ajax/deepblue_view_experiments.php",
        "icon" => "fa-database",
        "description" => "List and download DeepBlue epigenomic data.",
        "elevated" => false
    ),

    "deepblue_tables" => array(
        "title" => "Auxiliary data",
        "icon" => "fa-table",
        "description" => "You can have access to all auxiliary data used by DeepBlue.",
        "elevated" => false,
        "sub" => array(
            "annotations" => array(
                "title" => "Annotations",
                "url" => "ajax/deepblue_view_annotations.php",
                "description" => "List existing annotations in DeepBlue."
            ),
            "genomes" => array(
                "title" => "Genomes",
                "url" => "ajax/deepblue_view_genomes.php",
                "description" => "List existing genomes in DeepBlue."
            ),
            "epigenetic_marks" => array(
                "title" => "Epigenetic Marks",
                "url" => "ajax/deepblue_view_epigenetic_marks.php",
                "description" => "List existing epigenetic marks in DeepBlue."
            ),
            "biosources" => array(
                "title" => "BioSources",
                "url" =>"ajax/deepblue_view_biosources.php",
                "description" => "list(varname) existing biosources in DeepBlue."
            ),
            "samples" => array(
                "title" => "Samples",
                "url" => "ajax/deepblue_view_samples.php",
                "description" => "List existing samples in DeepBlue."

            ),
            "techniques" => array(
                "title" => "Techniques",
                "url" =>"ajax/deepblue_view_techniques.php",
                "description" => "List existing techniques in DeepBlue."
            ),
            "projects" => array(
                "title" => "Projects",
                "url" => "ajax/deepblue_view_projects.php",
                "description" => "List existing projects in DeepBlue."
            ),
            "column_types" => array(
                "title" => "Column types",
                "url" => "ajax/deepblue_view_column_types.php",
                "description" => "List available column types in DeepBlue."
            )
        )
    ),

    "biosources_hierarchy" => array(
        "title" => "BioSources - Hierarchy",
        "url"=> "ajax/deepblue_view_biosources_hierarchy.php",
        "icon" => "fa-sitemap",
        "description" => "Display the biosources in an hierarchy fashion (imported from the ontologies).",
        "elevated" => false
    ),

    "deepblue_request" => array(
        "title" => "Previous requests",
        "url"=> "ajax/deepblue_manage_request.php",
        "icon" => "fa-download",
        "description" => "Access and download all your download requests."
    ),

    "insert_data" => array(
        "title" => "Insert data",
        "icon" => "fa-suitcase",
        "description" => "Insert new data such as annotations, column_types into DeepBlue (It requires permission)",
        "elevated" => true,
        "sub" => array(
            "insert_annotation" => array(
                "title" => "Annotation",
                "url"=> "ajax/deepblue_insert_annotation.php",
                "icon" => "fa-tags",
                "description" => "Insert a new annotation."

            ),
            "insert_column_type" => array(
                "title" => "Column type",
                "url"=> "ajax/deepblue_create_column_type.php",
                "icon" => "fa-columns",
                "description" => "Insert a new column type."
            )
        )
    ),

    "data_curation" => array(
        "title" => "Curate data",
        "icon" => "fa-edit",
        "description" => "Curate DeepBlue data. (It requires permission)",
        "elevated" => true,
        "sub" => array(
            "clone" => array(
                "title" => "Experiments cloning",
                "url"=> "ajax/deepblue_clone_dataset.php",
                "icon" => "fa-copy",
                "description" => "Allows experiments cloning."
            )
        )
    ),

    "remove" => array(
        "title" => "Remove data",
        "url"=> "ajax/deepblue_remove_data.php",
        "icon" => "fa-minus-square",
        "description" => "Remove your data from DeepBlue."
    ),

/*  "deepblue_workflow" => array(
        "title" => "Workflow",
        "url"=> "ajax/deepblue_view_workflow.php",
        "icon" => "fa-bullhorn"
    ),*/

    "documentation" => array(
        "title" => "Documentation",
        "icon" => "fa-question",
        "description" => "Access DeepBlue examples, manual and tutorials.",
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
        "title" => "Users' feedback",
        "url"=> "ajax/deepblue_view_feedback.php",
        "icon" => "fa-step-backward",
        "description" => "Give your feedback to improve DeepBlue!"
    ),

    "acknowledgement" => array(
        "title" => "Acknowledgements",
        "url"=> "ajax/deepblue_acknowledgements.php",
        "icon" => "fa-university",
        "description" => "View the people, projects, and institutions that help the DeepBlue project"
    )
);

//configuration variables
$page_title = "DeepBlue Epigenomic Data Server";
$page_css = array();
$no_main_header = false; //set true for lock.php and index.php
$page_body_prop = array(); //optional properties for <body>
$page_html_prop = array(); //optional properties for <html>

?>