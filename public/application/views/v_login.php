<!DOCTYPE html>
<html lang="en">
<head>
	<title>E-PRAB | Masuk</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="<?= base_url(); ?>assets/images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/vendor/animate/animate.css">
<!--===============================================================================================-->	
	<!-- <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/vendor/css-hamburgers/hamburgers.min.css"> -->
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/css/util.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/css/main.css">
<!--===============================================================================================-->
<style>
.swal-text {
  padding: 17px;
  display: block;
  margin: 22px;
  text-align: center;
  color: #61534e;
}
</style>
</head>

<body>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-50">
				<form class="login100-form validate-form" method="POST" action="<?= base_url()?>auth/login">
					<span class="login100-form-title p-b-33">
						PT TOPSEL RAHARJA INDONESIA
					</span>
						
					<div class="wrap-input100 validate-input" data-validate = "Silahkan lengkapi nama akun anda">
						<input class="input100" type="text" name="username" placeholder="Nama Akun" autocomplete="off" >
						<span class="focus-input100-1"></span>
						<span class="focus-input100-2"></span>
					</div>

					<div class="wrap-input100 rs1 validate-input" data-validate="Silahkan ketik kata sandi">
						<input class="input100" type="password" name="password" placeholder="Kata Sandi">
						<span class="focus-input100-1"></span>
						<span class="focus-input100-2"></span>
					</div>

					<div class="container-login100-form-btn m-t-20">
						<button class="login100-form-btn">
							Masuk
						</button>
					</div>

					<div class="text-center p-t-45 p-b-4">
					</div>

					<div class="text-center">
						<span class="txt1">
							Belum punya akun ?
						</span>

						<a href="<?= base_url(); ?>auth/register" class="txt2 hov1">
							Daftar
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>
	

	
<!--===============================================================================================-->
	<script src="<?= base_url(); ?>assets/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="<?= base_url(); ?>assets/vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="<?= base_url(); ?>assets/vendor/bootstrap/js/popper.js"></script>
	<script src="<?= base_url(); ?>assets/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="<?= base_url(); ?>assets/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="<?= base_url(); ?>assets/vendor/daterangepicker/moment.min.js"></script>
	<script src="<?= base_url(); ?>assets/vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="<?= base_url(); ?>assets/vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="<?= base_url(); ?>assets/js/main.js"></script>
	<script src="<?= base_url(); ?>assets/js/sweetalert.min.js"></script>

	<script>
		<?php if($this->session->flashdata('error_msg') != ""){?>
			swal("Gagal", "<?= $this->session->flashdata('error_msg'); ?>", "error");
			
		<?php } ?>

		<?php if($this->session->flashdata('msg') != ""){?>
			swal("Berhasil", "<?= $this->session->flashdata('msg'); ?>", "success");
			
		<?php } ?>
	</script>

</body>
</html>