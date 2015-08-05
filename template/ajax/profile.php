<?php 

	require("inc/init.php"); 
	date_default_timezone_set('Europe/Berlin');

?>

<!-- row -->
<div class="row">

	<!-- col -->
	<div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
		<h1 class="page-title txt-color-blueDark"><!-- PAGE HEADER --><i class="fa-fw fa fa-user"></i> User Profile </h1>
	</div>
	<!-- end col -->

</div>
<!-- end row -->

<!-- row -->
<div class="row">
	<div class="col-sm-12">
		<div class="well well-sm">
			<div class="row">
				<div class="col-sm-12 col-md-12 col-lg-6">
					<div class="well well-light well-sm no-margin no-padding">
						<div class="row">
							<div class="col-sm-12">
								<div id="myCarousel" class="carousel fade profile-carousel">
									<div class="air air-top-left padding-10">
										<h4 class="txt-color-white font-md"><?php echo date("F j, Y, g:i a")?></h4>
									</div>
									<div class="carousel-inner">
										<div class="item active">
											<img src="img/demo/s1.jpg" alt="">
										</div>
									</div>
								</div>
							</div>
							<div class="col-sm-12">
								<div class="row">
									<div class="col-sm-1"></div>
									<div class="col-sm-6">
										<h1><span class="semi-bold"><?php echo $_SESSION['user_name'] ?></span>
										<br>
										<small> <?php echo $_SESSION['institution'].', '.$_SESSION['type']?></small></h1>
										<ul class="list-unstyled">
											<li>
												<p class="text-muted">
													<i class="fa fa-key"></i>&nbsp;&nbsp;<?php echo $_SESSION['user_key'] ?>
												</p>
											</li>											
											<li>
												<p class="text-muted">
													<i class="fa fa-envelope"></i>&nbsp;&nbsp;<a href=<?php echo 'mailto:'.$_SESSION['user_email'] ?>><?php echo $_SESSION['user_email'] ?></a>
												</p>
											</li>
										</ul>
										<br>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-sm-12 col-md-12 col-lg-6">

				</div>
			</div>
		</div>
	</div>
</div>
<!-- end row -->
</section>
<!-- end widget grid -->