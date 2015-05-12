	<?php
	$str = "";
	foreach ($_POST as $key => $value) {
		$str .= $key . " " . $value . "\n";
	}

	mail("felipe.albrect@gmail.com", "New User", $str);

	print "<h1> Thank you for your interest on DeepBlue Epigenomic Data Server.</h1>";
	print "We will check your information and create an account for you.";
	?>

