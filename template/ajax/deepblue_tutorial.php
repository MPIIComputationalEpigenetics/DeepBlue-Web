<?php

/**
*   DeepBlue Epigenomic Data Server
*   Copyright (c) 2014 Max Planck Institute for Computer Science.
*   All rights reserved.
*
*   File : deepblue_tutorial.php
*
*   Felipe Albrecht <felipe.albrecht@mpi-inf.mpg.de>
*   Obaro Odiete <s8obodie@stud.uni-saarland.de>
*   
*   Created : 07-08-2015
*/

require_once("inc/init.php");
?>
<!-- row -->

<!-- widget grid -->
<section id="widget-grid-api" class="">
	<!-- row -->
	<div class="row">
		<!-- NEW WIDGET START -->
		<article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<!-- Widget ID (each widget will need unique ID)-->
			<div class="jarviswidget" id="wid-deepblue-api" data-widget-editbutton="false" data-widget-deletebutton="false" data-widget-colorbutton="false" data-widget-togglebutton="false">
				<header>
					<span class="widget-icon"> <i class="fa fa-list-ul"></i> </span>
					<h2>DeepBlue Tutorials</h2>
				</header>

				<!-- widget div-->
				<div>
					<!-- widget edit box -->
					<div class="jarviswidget-editbox">
						<!-- This area used as dropdown edit box -->
						<input class="form-control" type="text">
					</div>
					<!-- end widget edit box -->

					<div class="alert alert-info alert-block">
						<a class="close" data-dismiss="alert" href="#">×</a>
						<h4 class="alert-heading">Information</h4>
						All the tutorials can be accessed directly at <a href="tutorials.php">http://deepblue.mpi-inf.mpg.de/tutorials.php</a>
					</div>

					<!-- widget content -->
					<div class="apiDiv widget-body">
						<div class="row">
							<ul>
								<li><a href="tutorials/01-access.html">Accessing DeepBlue</a></li>
								<li><a href="tutorials/02-listing.html">Data Listing</a></li>
								<li><a href="tutorials/03-biosources.html">BioSources</a></li>
								<li><a href="tutorials/04-samples.html">Samples</a></li>
								<li><a href="tutorials/05-experiments.html">Downloading data from Experiments</a></li>
								<li><a href="tutorials/11-blueprint_monocyte_signal_methylation_cpg_island.html">Summarizing methylation level by CpG Island of the monocyte cells</a></li>
							</ul>
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

