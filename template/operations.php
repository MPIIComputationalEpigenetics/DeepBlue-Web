<?php

//initilize the page
require_once("inc/init.php");

//require UI configuration (nav, ribbon, etc.)
require_once("inc/config.ui.php");

/*---------------- PHP Custom Scripts ---------

YOU CAN SET CONFIGURATION VARIABLES HERE BEFORE IT GOES TO NAV, RIBBON, ETC.
E.G. $page_title = "Custom Title" */

$page_title = "DeepBlue Epigenomic Data Server";

/* ---------------- END PHP Custom Scripts ------------- */

//include header
//you can add your custom css in $page_css array.
//Note: all css files are inside css/ folder
$page_css[] = "deepblue.css";
$no_main_header = true;
$page_body_prop = array("id"=>"extr-page");
include("inc/header.php");

?>

<style type="text/css">
@media (min-width: 768px) {
    .dl-horizontal dt {
        width:280px;
        white-space: normal;
    }
    .dl-horizontal dd {
        margin-left:300px;
        margin-bottom: 12px;
    }
}

</style>

<header id="header">
	<!--<span id="logo"></span>-->

	<div id="logo-group">
		<span id="logo">
			<a href="<?php echo ASSETS_URL; ?>">
				<img src="<?php echo ASSETS_URL; ?>/img/logo.png" alt="DeepBlue Epigenomic Data Server">
			</a>
		</span>
	</div>

	<div class="navbar-collapse collapse">
    	<ul class="nav navbar-nav navbar-left">
			<li><span id="extr-page-header-space"><a href="features.php">Features</a></span></li>
        	<li><span id="extr-page-header-space"><a href="operations.php">Operations</a></span></li>
        	<li><span id="extr-page-header-space"><a href="manual">Manual</a></span></li>
        	<li><span id="extr-page-header-space"><a href="api.php">API Reference</a></span></li>
        	<li><span id="extr-page-header-space"><a href="tutorials.php">Tutorials</a></span></li>
    	</ul>
  	</div>

</header>

<div id="main" role="main">
	<!-- MAIN CONTENT -->
	<div id="content" class="container">
		<div class="row">

			<h1> Data operations </h1>
			<dl class="dl-horizontal" id="freelance">
				<dt>Searching for experiments</dt>
				<dd><script src="https://gist.github.com/felipealbrecht/620d77ed574fb2a90390.js"></script></dd>

				<dt>Accessing the extra-metadata</dt>
				<dd><script src="https://gist.github.com/felipealbrecht/b2a002dc9edf0117133e.js"></script></dd>

				<dt>Select epigenomic data</dt>
				<dd><script src="https://gist.github.com/felipealbrecht/6b503fb93612cab9f47d.js"></script></dd>

				<dt>Output with desired columns</dt>
				<dd><script src="https://gist.github.com/felipealbrecht/9bafb162d8d61f2c234c.js"></script></dd>

				<dt>Filter epigenomic data by metadata</dt>
				<dd><script src="https://gist.github.com/felipealbrecht/0debbec441804f62c045.js"></script></dd>

				<dt>Filter epigenomic data by region attributes</dt>
				<dd><script src="https://gist.github.com/felipealbrecht/61b9329decc31c3fa1ec.js"></script></dd>

				<dt>Find overlapping regions sets</dt>
				<dd><script src="https://gist.github.com/felipealbrecht/63999ad6da020eedf740.js"></script></dd>

				<dt>Retrieve DNA sequences</dt>
				<dd><script src="https://gist.github.com/felipealbrecht/b8f200c6e591dd41bb51.js"></script></dd>

				<dt>DNA pattern matching operations</dt>
				<dd><script src="https://gist.github.com/felipealbrecht/58740596a2f75ddf11f9.js"></script></dd>

				<dt>Genes</dt>
				<dd><script src="https://gist.github.com/felipealbrecht/9a49cc901b57d96867f8.js"></script></dd>

				<dt>Aggregate and summarize regions</dt>
				<dd><script src="https://gist.github.com/felipealbrecht/20ccc22d2f8dd2121bb1.js"></script></dd>

				<dt>Tiling regions</dt>
				<dd><script src="https://gist.github.com/felipealbrecht/c42b37e39b18d210d6cb.js"></script></dd>

				<dt>Calculated columns</dt>
				<dd><script src="https://gist.github.com/felipealbrecht/a320156ec05f87213d7a.js"></script></dd>

				<dt>Score matrix</dt>
				<dd><script src="https://gist.github.com/felipealbrecht/a555f21642406c3d8676.js"></script></dd>
			</dl>

		</div>
	</div>

</div>
<!-- END MAIN PANEL -->
<!-- ==========================CONTENT ENDS HERE ========================== -->

<?php
	//include required scripts
	include("inc/scripts.php");
?>


<?php
	//include footer
	include("inc/google-analytics.php");
?>