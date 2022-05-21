<!DOCTYPE html>
<html lang="en">
<?php

?>

<head>
	<meta charset="utf-8">
	<meta content="width=device-width, initial-scale=1.0" name="viewport">

	<title>Gym Management System</title>

	<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>/css/bootstrap/bootstrap.css">
	<link href="<?php echo base_url(); ?>/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>/assets/vendor/icofont/icofont.min.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>/assets/vendor/venobox/venobox.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>/assets/vendor/animate.css/animate.min.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>/assets/vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>/assets/vendor/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet">


	<link href="<?php echo base_url(); ?>/assets/css/jquery.datetimepicker.min.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>/assets/fullcalendar/main.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>/assets/css/select2.min.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>/assets/css/login.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>/assets/bootstrapValidator/bootstrap.min.css" rel="stylesheet">



</head>
<style>

</style>

<body>


	<main id="main" class="bg-dark">
		<div id="login-left_1">

		</div>

		<div id="login-right">
			<div class="card col-md-8">
				<div class="card-body">

					<?php if (session('msg')) : ?>
						<article class="message is<?= session('msg.type') ?>">
							<div class="message-body">
								<?= session('msg.body') ?>
							</div>
						</article>
					<?php endif; ?>


					<form action="<?= base_url(route_to('logueo_test')) ?>" id="login-form" method="POST">
						<div class="form-group">
							<label for="username" class="control-label">Username</label>
							<input type="text" id="username" name="username" class="form-control" value="<?= old('username') ?>">
						</div>
						<p class="is-danger help"><?= session('errors.username') ?></p>
						<div class="form-group">
							<label for="password" class="control-label">Password</label>
							<input type="password" id="password" name="password" class="form-control">
							<p class="is-danger help"><?= session('errors.password') ?></p>
						</div>
						<center>	<button type="button" id="btnmiembro" class="btn-sm btn-block btn-wave col-md-4 btn-primary">Login</button></center>
					

					</form>
					
				</div>
			</div>
		</div>
	</main>

	<a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>


</body>
<script src="<?php echo base_url(); ?>/js/jquery-3.6.0.min.js"></script>
<script src="<?php echo base_url(); ?>/js/popper.min.js"></script>
<script src="<?php echo base_url(); ?>/js/bootstrap/bootstrap.js"></script>

<script src="<?php echo base_url(); ?>/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo base_url(); ?>/assets/vendor/jquery.easing/jquery.easing.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
	var site_url = "<?php echo base_url(); ?>";

	$("#btnmiembro").click(function() {


		var data = {
			'username': $('#username').val(),
			'password': $('#password').val()
		};
		$.ajax({
			url: site_url + '/student/student_log',
			method: "post",
			data: data,
			success: function(resp) {
				var result = $.parseJSON(resp);

				if (result.data == 0) {

					Swal.fire(
						'Aviso!',
						result.msj,
						'warning'
					)
				} else if (result.data == 1) {
					Swal.fire(
						'Aviso!',
						result.msj,
						'error'
					)

				} else if (result.data == 2) {
					Swal.fire(
						'Atencion!',
						result.msj,
						'warning'
					)

				}else if (result.data == 5) {
					
					window.location.href=site_url+"/principal/inicio";

				} else {
					Swal.fire(
						'Bienvenido',
						result.msj,
						'success'
					)

					$('#username').val('');
					
					$('#password').val('')
				}



			}

		})
	});
</script>


</html>