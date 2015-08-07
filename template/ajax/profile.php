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
				<div class="col-sm-12 col-md-12 col-lg-8">
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
											<hr>
											</li>
												<button id="edit_profile_link" type="button" class="btn btn-link no-padding">
													<i class="fa fa-edit"></i>&nbsp;&nbsp; Edit Profile
												</button>
											</li>
										</ul>
										<br>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div id="edit_profile_div" class="col-sm-12 col-md-12 col-lg-4" style="display:none">
					<div class="well well-light well-sm no-margin no-padding">
						<form action="php/deepblue_change_password.php" method="POST" id="change-password-form" class="smart-form client-form">
							<header>
								Edit Profile
							</header>
							<fieldset>
								<section>
									<label class="input"> <i class="icon-append fa fa-user"></i>
										<input type="text" name="username" placeholder="<?php echo $_SESSION['user_name']?>">
										<b class="tooltip tooltip-bottom-right">To change, enter new name</b> </label>
								</section>
								<section>
									<label class="input"> <i class="icon-append fa fa-building-o"></i>
										<input type="text" name="affiliation" placeholder="<?php echo $_SESSION['institution']?>">
										<b class="tooltip tooltip-bottom-right">To change, enter new Affiliation (school, university, or researching center)</b> </label>
								</section>
								<section>
									<label class="input"> <i class="icon-append fa fa-envelope"></i>
										<input type="email" name="email" placeholder="<?php echo $_SESSION['user_email']?>">
										<b class="tooltip tooltip-bottom-right">To change, enter new value</b> </label>
								</section>
								<section>
									<label class="input"> <i class="icon-append fa fa-lock"></i>
										<input type="password" name="oldpassword" placeholder="Current Password" id="oldpassword">
										<b class="tooltip tooltip-bottom-right">Enter current password to verify</b> </label>
								</section>
								<section>
									<label class="input"> <i class="icon-append fa fa-lock"></i>
										<input type="password" name="newpassword" placeholder="New Password" id="newpassword">
										<b class="tooltip tooltip-bottom-right">To change, enter new password</b> </label>
								</section>
								<section>
									<label class="input"> <i class="icon-append fa fa-lock"></i>
										<input type="password" name="passwordConfirm" placeholder="Confirm password">
										<b class="tooltip tooltip-bottom-right">Confirm new password</b> </label>
								</section>
							</fieldset>
							<footer>
								<button type="submit" class="btn btn-success">
									Update Profile
								</button>
							</footer>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- end row -->
</section>
<!-- end widget grid -->

<script type="text/javascript">
	runAllForms();

	// hide/show profile_edit div
	$("#edit_profile_link").click(function() {
	    $("#edit_profile_div").show();
	});


	// Validation
	$(function() {
		// Validation
		$("#change-password-form").validate({

			// Rules for form validation
			rules : {
				username : {
					required : false
				},
				email : {
					required : false,
					email : true
				},
				oldpassword : {
					required : true,
					minlength : 3,
					maxlength : 20
				},
				newpassword : {
					required : false,
					minlength : 3,
					maxlength : 20
				},
				passwordConfirm : {
					required : false,
					minlength : 3,
					maxlength : 20,
					equalTo : '#newpassword'
				},
				affiliation : {
					required : false
				}
			},

			// Messages for form validation
			messages : {
				login : {
					required : 'Please enter your login'
				},
				oldpassword : {
					required : 'Please enter your current password'
				},
				newpassword : {
				},
				passwordConfirm : {
					equalTo : 'Please enter the same password as above'
				},
			},

			// Ajax form submition
			submitHandler : function(form) {
				$(form).ajaxSubmit({
					success : function() {
						$("#change-password-form").addClass('submited');
					}
				});
			},

			// Do not change code below
			errorPlacement : function(error, element) {
				error.insertAfter(element.parent());
			}
		});
	});
</script>