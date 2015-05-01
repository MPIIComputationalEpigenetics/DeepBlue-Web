<?php

/**
*   DeepBlue Epigenomic Data Server
*   Copyright (c) 2014 Max Planck Institute for Computer Science.
*   All rights reserved.
*
*   Authors :
*
*   Felipe Albrecht <felipe.albrecht@mpi-inf.mpg.de>
*   Obaro Odiete <s8obodie@stud.uni-saarland.de>
*
*   Created : 30-04-2015
*
*   ================================================
*
*   File : deepblue_manage_request.php
*
*/

/* DeepBlue Configuration */
require_once("inc/init.php");
?>

<div class="row">
	<div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
		<h1 class="page-title txt-color-blueDark"><i class="fa fa-shopping-cart"></i>
			Manage Requests
		</h1>
	</div>
</div>
<!-- widget grid -->
<section id="widget-grid" class="">
	<!-- row -->
	<div class="row">

		<!-- NEW WIDGET START -->
		<article class="col-sm-12 col-md-12 col-lg-12">

			<!-- Widget ID (each widget will need unique ID)-->
			<div class="jarviswidget jarviswidget-color-blue" id="tree-biosources" data-widget-editbutton="true">

				<header>
					<span class="widget-icon"> <i class="fa fa-cloud-download"></i> </span>
					<h2>Experiments Download</h2>

				</header>

				<!-- widget div-->
				<div>

					<!-- widget edit box -->
					<div class="jarviswidget-editbox">
						<!-- This area used as dropdown edit box -->

					</div>
					<!-- end widget edit box -->

					<!-- widget content -->
					<div class="widget-body">
					 	<div class="row">
							<div class="col-md-12 col-md-offset-0">
								<div class="alert alert-info alert-block">
									<a class="close" data-dismiss="alert" href="#">×</a>
									<h4 class="alert-heading">Download Queue</h4>
									When the download is ready (Request status: READY), click "Download" to retrieve the compressed experiment data.
								</div>
			                    <div class="widget-body">
			                        <table id="datatable_fixed_column" name='experiment-table' class="table table-striped table-bordered table-hover" width="100%">
			                            <thead>
			                                <tr>
			                                    <th class="hasinput">
			                                        <input type="text" class="form-control" placeholder="Request ID" id="request-id" />
			                                    </th>
			                                    <th class="hasinput">
			                                        <input class="form-control" placeholder="Experiment ID" type="text" id="experiment-id">
			                                    </th>
			                                    <th class="hasinput">
			                                        <input type="text" class="form-control" placeholder="Request Status" id="request-status"/>
			                                    </th>
			                                    <th class="hasinput">
			                                        <input type="text" class="form-control" placeholder="Request Date Stamp" id="request-date-stamp"/>
			                                    </th>
			                                    <th class="hasinput">
			                                        
			                                    </th>
			                                </tr>
			                                <tr>
												<th>Request ID</th>
			                                    <th>Experiment ID</th>
			                                    <th>Request Status</th>
												<th>Request Date Stamp</th>			                                    
												<th>Download</th>			                                    
			                                </tr>
			                            </thead>

			                        </table>
			                    </div>
							</div>
						</div>
					</div>
					<!-- end widget content -->
				</div>
				<!-- end widget div -->

			</div>
			<!-- end widget -->

		</article>
		<!-- WIDGET END -->
	</div>
	<!-- end row -->
</section>
<!-- end widget grid -->