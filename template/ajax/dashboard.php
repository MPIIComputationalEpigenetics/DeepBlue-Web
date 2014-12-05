<!--*
*   DeepBlue Epigenomic Data Server
*   Copyright (c) 2014 Max Planck Institute for Computer Science.
*   All rights reserved.
*
*   File : dashboard.php
*
*   Felipe Albrecht <felipe.albrecht@mpi-inf.mpg.de>
*   Umidjon Urunov <umidjon.urunov@mpi-inf.mpg.de>
*		Obaro Odiete <s8obodie@stud.uni-saarland.de>
*
*   Created : 25-08-2014
*
*		Last Updated : 04-12-2014
*
-->

<?php require_once("inc/init.php"); ?>

<link href="../css/bootstrap.min.css" rel="stylesheet" type="text/css" />

<div class="row">
	<div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
		<h1 class="page-title txt-color-blueDark"><i class="fa-fw fa fa-home"></i> DeepBlue Dashboard </h1>
	</div>
  <div id="carousel-deepblue" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
      <li data-target="#carousel-deepblue" data-slide-to="0" class="active"></li>
      <li data-target="#carousel-deepblue" data-slide-to="1"></li>
      <li data-target="#carousel-deepblue" data-slide-to="2"></li>
      <li data-target="#carousel-deepblue" data-slide-to="3"></li>      
    </ol>
  
    <!-- Wrapper for slides -->
    <div class="carousel-inner" role="listbox">
      <div class="item active">
        <div class="carousel-caption">
					<h1 class="txt-color-blueDark">Projects</h1>
        </div>
      	<div id="topleft" class="dashboard-canvass">
        </div>
      </div>
      <div class="item">
      	<div id="topright" class="dashboard-canvass">
        </div>
        <div class="carousel-caption">
					<h1 class="txt-color-blueDark">Epigenetic Marks</h1>
        </div>
      </div>
      <div class="item">
      	<div id="bottomleft" class="dashboard-canvass">
        </div>
        <div class="carousel-caption">
					<h1 class="txt-color-blueDark">Biosources</h1>
        </div>
      </div>
      <div class="item">
      	<div id="bottomright" class="dashboard-canvass">
        </div>
        <div class="carousel-caption">
					<h1 class="txt-color-blueDark">Techniques</h1>
        </div>
      </div>    
    </div>
  
    <!-- Controls -->
    <a class="left carousel-control" href="#carousel-deepblue" role="button" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#carousel-deepblue" role="button" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
</div>

<!-- deepblue.js deepblue additional javascript -->
<script src="<?php echo ASSETS_URL; ?>/js/deepblue/deepblue.js"></script>
<script src="<?php echo ASSETS_URL; ?>/js/deepblue/api.js"></script>