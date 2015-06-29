<?php require("inc/init.php"); ?>

<!-- row -->
<div class="row">

	<!-- col -->
	<div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
		<h1 class="page-title txt-color-blueDark"><!-- PAGE HEADER --><i class="fa-fw fa fa-file-o"></i> User <span>>
			Profile </span></h1>
	</div>
	<!-- end col -->

</div>
<!-- end row -->

<!-- row -->

<div class="row">

	<div class="col-sm-12">

	<h1><?php echo $_SESSION['user_name'] ?> </h1>
	<h1><?php echo $_SESSION['user_email'] ?> </h1>
	<h1><?php echo $_SESSION['user_key'] ?> </h1>

	</div>

</div>

<!-- end row -->

</section>
<!-- end widget grid -->

<script type="text/javascript">

	pageSetUp();

	var pagefunction = function() {

	};

	pagefunction();

</script>
