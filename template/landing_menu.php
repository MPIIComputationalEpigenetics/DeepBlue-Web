<div role="navigation" class="navbar navbar-default">
	<div class="container-fluid">
    	<div class="navbar-header">
    		<a id="logo"  href="<?php echo ASSETS_URL; ?>">
				<img src="<?php echo ASSETS_URL; ?>/img/logo.png" alt="DeepBlue Epigenomic Data Server">
			</a>
		</div>

		<div class="collapse navbar-collapse">
      		<ul class="nav navbar-nav">
      			<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">DeepBlue Overview <b class="caret"></b></a>
					<ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
						<li class="dropdown-header">
							DeepBlue Overview
						</li>
						<li class="divider"></li>
						<li>
							<a href="deepblue_overview.php">Overview</a>
						</li>
						<li>
							<a href="features.php">Features</a>
						</li>
						<li>
							<a href="acknowledgements.php">Acknowledgements</a>
						</li>
				  	</ul>
        		</li>

      			<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">API Interface <b class="caret"></b></a>
					<ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
						<li class="dropdown-header">
							API Interface
						</li>
						<li class="divider"></li>
						<li>
							<a href="examples.php">Examples</a>
						</li>
						<li>
							<a href="tutorials.php">Tutorials</a>
						</li>
						<li>
							<a href="manual/">Manual</a>
						</li>
						<li>
							<a href="api.php">API References Commands</a>
						</li>
						<li class="divider"></li>
						<li>
							<a href="r_users.php">R Users</a>
						</li>
				  	</ul>
        		</li>


      			<li class="dropdown">
  					<a href="#" class="dropdown-toggle" data-toggle="dropdown">Web Interface <b class="caret"></b></a>
					<ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
						<li class="dropdown-header">
							Web Interface
						</li>
						<li class="divider"></li>
						<li>
							<a href="web_examples.php">Examples</a>
						</li>
						<li>
							<a href="<?php echo APP_URL.'/php/deepblue_checkuser.php'?>">Access</a>
						</li>
				  	</ul>
        		</li>
        	 </ul>

		    <ul class="nav navbar-nav navbar-right">
		    	<li class="active">
		    		<a href="<?php echo APP_URL; ?>/register.php">Request an account</a>
				</li>
		    </ul>

        </div>
	</div>
</div>
