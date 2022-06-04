<!DOCTYPE html>
<html lang="en">
<?php

?>

<head>
	<meta charset="utf-8">
	<meta content="width=device-width, initial-scale=1.0" name="viewport">

	<title>Gym Management System</title>

	<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>/css/bootstrap/bootstrap.css">
	<link href="<?php echo base_url('/assets/vendor/bootstrap/css/bootstrap.min.css'); ?>" rel="stylesheet">
	<link href="<?php echo base_url('/assets/vendor/icofont/icofont.min.css'); ?>" rel="stylesheet">
	<link href="<?php echo base_url('/assets/vendor/boxicons/css/boxicons.min.css'); ?>" rel="stylesheet">
	<link href="<?php echo base_url('/assets/vendor/venobox/venobox.css'); ?>" rel="stylesheet">
	<link href="<?php echo base_url('/assets/vendor/animate.css/animate.min.css'); ?>" rel="stylesheet">
	<link href="<?php echo base_url('/assets/vendor/remixicon/remixicon.css'); ?>" rel="stylesheet">
	<link href="<?php echo base_url('/assets/vendor/owl.carousel/assets/owl.carousel.min.css'); ?>" rel="stylesheet">
	<link href="<?php echo base_url('/assets/vendor/bootstrap-datepicker/css/bootstrap-datepicker.min.css'); ?>" rel="stylesheet">


	<link href="<?php echo base_url('/assets/css/jquery.datetimepicker.min.css'); ?>" rel="stylesheet">
	<link href="<?php echo base_url('/assets/fullcalendar/main.css'); ?>" rel="stylesheet">
	<link href="<?php echo base_url('/assets/css/select2.min.css'); ?>" rel="stylesheet">
	<link href="<?php echo base_url('/assets/css/login.css'); ?>" rel="stylesheet">
	<link href="<?php echo base_url('/assets/bootstrapValidator/bootstrap.min.css'); ?>" rel="stylesheet">



</head>
<style>

</style>

<body>

	<main id="main" class="bg-dark">
		<div id="login-left">

		</div>

		<div id="login-right">
			<div class="card col-md-8">
				<div class="card-body">

					<?php if (session('msg')) : ?>
						<article class="message is<?= session('msg.type') ?>">
							<div class="message-body">

								<div class="alert alert-danger alert-dismissible fade show" role="alert">
									<?= session('msg.body') ?>
									<button type="button" class="close" data-dismiss="alert" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>

							</div>
						</article>
					<?php endif; ?>


					<form action="<?= base_url(route_to('signin')) ?>" id="login-form" method="POST">
						
						<div class="form-group">
							<label for="username" class="control-label">Username First</label>
							<input type="text" id="username" name="username" class="form-control" value="<?= old('username') ?>">
						</div>
						<p class="is-danger help"><?= session('errors.username') ?></p>
						<div class="form-group">
							<label for="password" class="control-label">Password</label>
							<input type="password" id="password" name="password" class="form-control">
							<p class="is-danger help"><?= session('errors.password') ?></p>
						</div>
						<center><button type="submit" id="btn_enter_pass" class="btn-sm btn-block btn-wave col-md-4 btn-primary">Login</button></center>

						
					</form>
				</div>
			</div>
		</div>

	</main>

	<a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>


</body>

<script>


</script>



<script src="<?php echo base_url(); ?>/js/jquery-3.6.0.min.js"></script>
<script src="<?php echo base_url(); ?>/js/popper.min.js"></script>
<script src="<?php echo base_url(); ?>/js/bootstrap/bootstrap.js"></script>

<script src="<?php echo base_url(); ?>/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo base_url(); ?>/assets/vendor/jquery.easing/jquery.easing.min.js"></script>
<script src="<?php echo base_url(); ?>/assets/vendor/php-email-form/validate.js"></script>
<script src="<?php echo base_url(); ?>/assets/vendor/venobox/venobox.min.js"></script>
<script src="<?php echo base_url(); ?>/assets/vendor/waypoints/jquery.waypoints.min.js"></script>
<script src="<?php echo base_url(); ?>/assets/vendor/counterup/counterup.min.js"></script>
<script src="<?php echo base_url(); ?>/assets/vendor/owl.carousel/owl.carousel.min.js"></script>
<script src="<?php echo base_url(); ?>/assets/bootstrapValidator/bootstrapValidator.min.js"></script>
<script src="<?php echo base_url(); ?>/assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<script src="<?php echo base_url(); ?>/assets/data/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>/assets/js/select2.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>/assets/js/jquery.datetimepicker.full.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>/assets/font-awesome/js/all.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>/assets/fullcalendar/main.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>/assets/js/jquery-te-1.4.0.min.js" charset="utf-8"></script>



</html>