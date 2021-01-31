<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Responsive Web UI Kit &amp; Dashboard Template based on Bootstrap">
	<meta name="author" content="AdminKit">
	<meta name="keywords" content="adminkit, bootstrap, web ui kit, dashboard template, admin template">

	<link rel="shortcut icon" href="<?= base_url(); ?>assets/images/icons/icon-48x48.png" />

	<title>E-PRAB | Dashboard</title>

	<link href="<?= base_url() ?>assets/css/app.css" rel="stylesheet">
	<style>
	a.disabled {
		/* Make the disabled links grayish*/
		color: gray;
		/* And disable the pointer events */
		pointer-events: none;
	}
	</style>
</head>
<?php 
if($this->session->userdata('prab-otoritas') == "Administrator"){
	$d_approval = "d-block";
	$d_setting = "d-block";
	$d_payment = "d-block";
	$d_principle = "d-block";
}elseif($this->session->userdata('prab-otoritas') == "Finance"){
	$d_approval = "d-none";
	$d_setting = "d-none";
	$d_payment = "d-block";
	$d_principle = "d-block";
}elseif($this->session->userdata('prab-otoritas') == "Direktur" || $this->session->userdata('prab-otoritas') == "Manager" || $this->session->userdata('prab-otoritas') == "Supervisor" || $this->session->userdata('prab-otoritas') == "Direktur Keuangan"){
	$d_approval = "d-block";
	$d_setting = "d-none";
	$d_payment = "d-none";
	$d_principle = "d-none";
}else{
	$d_approval = "d-none";
	$d_setting = "d-none";
	$d_payment = "d-none";
	$d_principle = "d-none";
}

?>
<body>
	<div class="wrapper">
		<nav id="sidebar" class="sidebar">
			<div class="sidebar-content js-simplebar">
				<a class="sidebar-brand" href="index.html">
          <span style="letter-spacing: 1px;" class="align-middle">E-PRAB TOPSELL</span>
        </a>

				<ul class="sidebar-nav">					
					<li class="sidebar-item">
						<a class="sidebar-link" href="<?= base_url(); ?>">
                            <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Dasbor</span>
                        </a>
                    </li>
                    <li class="sidebar-item active">
						<a class="sidebar-link" href="<?= base_url('profile'); ?> ">
                            <i class="align-middle" data-feather="user"></i> <span class="align-middle">Profil</span>
                        </a>
					</li>
                    <li class="sidebar-item <?= $d_payment ?>">
						<a class="sidebar-link" href="<?= base_url('payment'); ?>">
                            <i class="align-middle" data-feather="dollar-sign"></i> <span class="align-middle">Pencairan PRAB</span>
                        </a>
					</li>
					<li class="sidebar-item <?= $d_principle ?>">
						<a class="sidebar-link" href="<?= base_url('bill/get_principle_bill'); ?>">
                            <i class="align-middle" data-feather="credit-card"></i> <span class="align-middle">Piutang Principle</span>
                        </a>
					</li>
                    <li class="sidebar-item">
						<a class="sidebar-link" href="<?= base_url('settlement'); ?>">
                            <i class="align-middle" data-feather="check"></i> <span class="align-middle">Penyelesain PRAB</span>
                        </a>
					</li>
					<li class="sidebar-item">
						<a class="sidebar-link" href="<?= base_url('report'); ?>">
                            <i class="align-middle" data-feather="layers"></i> <span class="align-middle">Laporan</span>
                        </a>
					</li>
					<li class="sidebar-item <?= $d_setting ?>">
						<a class="sidebar-link" href="<?= base_url('setting') ?>">
                            <i class="align-middle" data-feather="settings"></i> <span class="align-middle">Pengaturan</span>
                        </a>
                    </li>	
                    <li class="sidebar-item">
						<a class="sidebar-link" href="<?= base_url('auth/logout'); ?>">
                            <i class="align-middle" data-feather="log-out"></i> <span class="align-middle">Keluar</span>
                        </a>
					</li>
				</ul>

				<!-- <div class="sidebar-cta">
					<div class="sidebar-cta-content">
						<strong class="d-inline-block mb-2">Upgrade to Pro</strong>
						<div class="mb-3 text-sm">
							Are you looking for more components?
						</div>
						<a href="https://adminkit.io/pricing" target="_blank" class="btn btn-outline-primary btn-block">Upgrade</a>
					</div>
				</div> -->
			</div>
		</nav>

		<div class="main">
			<nav class="navbar navbar-expand navbar-light navbar-bg">
				<a class="sidebar-toggle d-flex">
					<i class="hamburger align-self-center"></i>
				</a>



				<div class="navbar-collapse collapse">
					<ul class="navbar-nav navbar-align">
						<li class="nav-item dropdown">
							<a class="nav-icon dropdown-toggle" href="#" id="alertsDropdown" data-toggle="dropdown">
								<div class="position-relative">
									<i class="align-middle" data-feather="bell"></i>
									<span class="indicator"><?= $count_notification ?></span>
								</div>
							</a>
							<div class="dropdown-menu dropdown-menu-lg dropdown-menu-right py-0" aria-labelledby="alertsDropdown">
								<div class="dropdown-menu-header">
								<?= $count_notification ?> Pemberitahuan
								</div>
								<div class="list-group">
								<?php foreach($get_notification as $row){ ?>
									<a href="<?= $row->url ?>" class="list-group-item">
										<div class="row no-gutters align-items-center">
											<div class="col-2">
												<i class="text-primary" data-feather="<?= $row->icon ?>"></i>
											</div>
											<div class="col-10">
												<div class="text-dark"><?= $row->title ?></div>
												<div class="text-muted small mt-1"><?= $row->messages ?></div>
											</div>
										</div>
									</a>
								<?php } ?>
									
								</div>
								<div class="dropdown-menu-footer">
									<a href="#" class="text-muted">Show all notifications</a>
								</div>
							</div>
						</li>
						
						<li class="nav-item dropdown">
							<a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#" data-toggle="dropdown">
                <i class="align-middle" data-feather="settings"></i>
              </a>

							<a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-toggle="dropdown">
								<span class="text-dark"><?= strtoupper($this->session->userdata('prab-name')) ?></span>
							</a>
							<div class="dropdown-menu dropdown-menu-right">
								<!-- <a class="dropdown-item" href="pages-profile.html"><i class="align-middle mr-1" data-feather="user"></i> Profil</a>
								<div class="dropdown-divider"></div>
								<a class="dropdown-item" href="pages-settings.html"><i class="align-middle mr-1" data-feather="settings"></i> Pengaturan</a>
								<a class="dropdown-item" href="#"><i class="align-middle mr-1" data-feather="help-circle"></i> Pusat bantuan</a> -->
								<div class="dropdown-divider"></div>
								<a class="dropdown-item" href="<?= base_url(); ?>auth/logout">Keluar</a>
							</div>
						</li>
					</ul>
				</div>
			</nav>

			<main class="content">
            <div class="container-fluid p-0">
                <h1 class="h3 mb-3">Profil</h1>
                <div class="row">
                    <div class="col-md-3 col-xl-2">

                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Pengaturan Profil</h5>
                            </div>

                            <div class="list-group list-group-flush" role="tablist">
                                <a class="list-group-item list-group-item-action active" data-toggle="list" href="#account" role="tab">
                                    Akun
                                </a>
                                <a class="list-group-item list-group-item-action" data-toggle="list" href="#password" role="tab">
                                    Kata Sandi
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-9 col-xl-10">
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="account" role="tabpanel">
                                <div class="card">
                                    <div class="card-header">

                                        <h5 class="card-title mb-0">Informasi Pribadi</h5>
                                    </div>
                                    <div class="card-body">
                                        <form method="POST" action="<?= base_url('profile/change_profile'); ?>">
                                            <div class="form-row">
                                                <?php foreach($get_profile as $row ){ ?>
                                                <div class="form-group col-md-6">
                                                    <label for="inputFirstName">ID Akun</label>
                                                    <input type="text" class="form-control" name="username" value="<?= $row->username; ?>" placeholder="ID Akun" disabled>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="inputLastName">Email</label>
                                                    <input type="email" class="form-control" name="email" value="<?= $row->email; ?>" placeholder="Email">
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="inputFirstName">Nama Depan</label>
                                                    <input type="text" class="form-control" name="first_name" value="<?= $row->first_name; ?>" placeholder="Nama depan">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="inputLastName">Nama Belakang</label>
                                                    <input type="text" class="form-control" name="last_name" value="<?= $row->last_name; ?>" placeholder="Nama belakang">
                                                </div>
                                            </div>
                                           
												<?php } ?>
                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                        </form>

                                    </div>
                                </div>

                            </div>
                            <div class="tab-pane fade" id="password" role="tabpanel">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Password</h5>

                                        <form method="POST" action="<?= base_url('profile/change_password'); ?>">
                                            <div class="form-group">
                                                <label for="inputPasswordCurrent">Kata sandi saat ini</label>
                                                <input type="password" name="current_password" class="form-control" id="inputPasswordCurrent">
                                            </div>
                                            <div class="form-group">
                                                <label for="inputPasswordNew">Kata sandi baru</label>
                                                <input type="password" name="new_password" class="form-control" id="inputPasswordNew">
                                            </div>
                                            <div class="form-group">
                                                <label for="inputPasswordNew2">Ketik ulang kata sandi</label>
                                                <input type="password" name="retype_password" class="form-control" id="inputPasswordNew2">
                                            </div>
                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                </div>
			</main>

			<footer class="footer">
				<div class="container-fluid">
					<div class="row text-muted">
						<div class="col-6 text-left">
							<p class="mb-0">
								<a href="index.html" class="text-muted"><strong>PT. TOPSEL RAHARJA INDONESIA</strong></a> &copy;
							</p>
						</div>
						<div class="col-6 text-right">
							<ul class="list-inline">	
								<li class="list-inline-item">
									<a class="text-muted" href="#">Versi 1.4.2</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</footer>
		</div>
	</div>

	<script src="<?= base_url(); ?>assets/js/vendor.js"></script>
	<script src="<?= base_url(); ?>assets/js/app.js"></script>
	<script src="<?= base_url(); ?>assets/js/sweetalert.min.js"></script>
	<script>
		<?php if($this->session->flashdata('access_denied') != ""){?>
			swal("Peringatan", "<?= $this->session->flashdata('access_denied'); ?>", "warning");
			
        <?php } ?>
        <?php if($this->session->flashdata('msg') != ""){?>
			swal("Berhasil", "<?= $this->session->flashdata('msg'); ?>", "success");
			
		<?php } ?>

		<?php if($this->session->flashdata('error_msg') != ""){?>
			swal("Gagal", "<?= $this->session->flashdata('error_msg'); ?>", "error");
			
		<?php } ?>
    </script>
	

</body>

</html>