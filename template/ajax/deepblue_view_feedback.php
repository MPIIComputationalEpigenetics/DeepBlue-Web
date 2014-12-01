<?php

/**
*   DeepBlue Epigenomic Data Server
*   Copyright (c) 2014 Max Planck Institute for Computer Science.
*   All rights reserved.
*
*   File : deepblue_view_feedback.php
*
*   Felipe Albrecht <felipe.albrecht@mpi-inf.mpg.de>
*
*   Created : 01-12-2014
*/

require_once("inc/init.php");

?>

<section id="widget-grid-manual" class="">
	<div>
		<div class="row">
			<script type='text/javascript'>
				var _ues = {
					host:'deepblue.userecho.com',
					forum:'37282',
					lang:'en',
					tab_show:false,
					container_id:'ue-embedded-widget',
					};

					(function() {
					    var _ue = document.createElement('script'); _ue.type = 'text/javascript'; _ue.async = true;
					    _ue.src = ('https:' == document.location.protocol ? 'https://' : 'http://') + 'cdn.userecho.com/js/widget-1.4.gz.js';
					    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(_ue, s);
					  })();
				</script>

			<div id="ue-embedded-widget"></div>
		</div>
	</div>
</section>
