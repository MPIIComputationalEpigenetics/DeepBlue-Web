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
								<li><a href="https://gist.github.com/felipealbrecht/6e84aa529551e20268a2#file-01-01-connect_to_the_server-py">Accessing DeepBlue</a></li>
								<li><a href="https://gist.github.com/felipealbrecht/64655b560fac6a1f9674#file-01-02-data-listing-py">Data Listing</a></li>
								<li><a href="https://gist.github.com/felipealbrecht/0e61b615f0ca018510cc#file-01-03-biosources-py">BioSources</a></li>
								<li><a href="https://gist.github.com/felipealbrecht/876793c496066609940b#file-01-04-samples-py">Samples</a></li>
								<li><a href="https://gist.github.com/felipealbrecht/6d166087d4d77584b1bb#file-01-05-experiments-py">Downloading data from experiments</a></li>
								<li><a href="https://gist.github.com/felipealbrecht/28105a18e3ae3c5f3dd6#file-01-06-summarizing-py">Summarizing methylation level by CpG Island of the monocyte cells</a></li>
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

