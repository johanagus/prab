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
					<li class="sidebar-item active">
						<a class="sidebar-link" href="<?= base_url(); ?>">
                            <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Dasbor</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
						<a class="sidebar-link" href="<?= base_url('profile'); ?>">
                            <i class="align-middle" data-feather="user"></i> <span class="align-middle">Profil</span>
                        </a>
					</li>
                    <li class="sidebar-item <?= $d_approval ?>">
						<a class="sidebar-link" href="<?= base_url('approval'); ?>">
                        <i class="align-middle" data-feather="check-square"></i></i> <span class="align-middle">Persetujuan PRAB</span>
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

					<div class="row mb-2 mb-xl-3">
						<div class="col-auto d-none d-sm-block">
							<h3><strong>Dashboard</strong></h3>
						</div>

						
					</div>
					<div class="row">
						<div class="col-xl-12 col-xxl-12 d-flex">
							<div class="w-100">
								<div class="row">
									<div class="col-sm-3">
										<div class="card">
											<div class="card-body">
												<h5 class="text-primary card-title mb-4">Total PRAB</h5>
												<h1 class="display-5 mt-1 mb-3"><?= $count_all_prab; ?></h1>
												<div class="mb-1">
													<span class="text-primary"> <i class="mdi mdi-arrow-bottom-right"></i> <?php if($count_all_prab > 0 ){ echo number_format(($count_all_prab/$count_global_prab)*100, 2, ',', ' '); }else{ echo 0; } ?>% </span>
													<span class="text-muted">Dari PRAB global</span>
												</div>
											</div>
                                        </div> 
									</div>
									<div class="col-sm-3">
                                        <div class="card">
											<div class="card-body">
												<h5 class="text-success card-title mb-4">Disetujui</h5>
												<h1 class="display-5 mt-1 mb-3"><?= $count_approved_prab; ?></h1>
												<div class="mb-1">
													<span class="text-success"> <i class="mdi mdi-arrow-bottom-right"></i> <?php if($count_approved_prab > 0){ echo number_format(($count_approved_prab/$count_global_prab)*100, 2, ',', ' ');}else{ echo 0; } ?>% </span>
													<span class="text-muted">Dari total PRAB</span>
												</div>
											</div>
                                        </div>
									</div>
									<div class="col-sm-3">
                                        <div class="card">
											<div class="card-body">
												<h5 class="text-danger card-title mb-4">Tidak disetujui</h5>
												<h1 class="display-5 mt-1 mb-3"><?= $count_rejected_prab; ?></h1>
												<div class="mb-1">
													<span class="text-danger"> <i class="mdi mdi-arrow-bottom-right"></i> <?php if($count_rejected_prab > 0 ){ echo number_format(($count_rejected_prab/$count_all_prab)*100, 2, ',', ' '); }else{ echo 0;} ?>% </span>
													<span class="text-muted">Dari total PRAB</span>
												</div>
											</div>
                                        </div>
									</div>
									<div class="col-sm-3">
                                        <div class="card">
											<div class="card-body">
												<h5 class="text-warning card-title mb-4">Selesai</h5>
												<h1 class="display-5 mt-1 mb-3"><?= $count_finished_prab ?></h1>
												<div class="mb-1">
													<span class="text-warning"> <i class="mdi mdi-arrow-bottom-right"></i> <?php if($count_finished_prab > 0){ echo number_format(($count_finished_prab/$count_all_prab)*100, 2, ',', ' '); }else{ echo 0; } ?>% </span>
													<span class="text-muted">Dari total PRAB</span>
												</div>
											</div>
                                        </div>
									</div>
								</div>
							</div>
						</div>
					</div>



					<div id="all_prab_table" class="row">
						<div class="col-12 col-lg-12 col-xxl-12 d-flex">
							<div class="card flex-fill">
								<div class="card-header">
                                    <div class="row">
                                        <div class="col-12 col-md-4">
                                             <h4>Daftar semua PRAB </h4>
                                        </div>
                                        <div class="col-12 col-md-8 text-center text-sm-right">
                                            <form class="form-inline d-none d-sm-inline-block mr-3" method="POST" action="<?= base_url();?>dashboard/search_prab">
                                                <div class="input-group input-group-navbar">
                                                    <input type="text" name="search" class="form-control" placeholder="Cari tema PRAB" aria-label="Search">
                                                    <div class="input-group-append">
                                                        <button class="btn" type="submit" name="submit">
                                                            <i class="align-middle" data-feather="search"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
                                            <a class="btn btn-primary" href="<?= base_url(); ?>dashboard/add_new_prab">+ Buat PRAB baru</a>
                                        </div>
                                    </div>
                                    
								</div>
								<table class="table table-striped w-100 table-responsive-lg my-0">
									<thead>
										<tr>
											<th>Tema</th>
                                            <th class="d-table-cell">Tgl. Diajukan</th>
                                            <th class="d-table-cell">Nama Pemohon</th>
                                            <th class="d-table-cell">Departement</th>
                                            <th class="d-table-cell">Cabang</th>
                                            <th class="d-table-cell">PIC Pendukung</th>
											<th class="d-table-cell">Total Anggaran </br>( Rp. )</th>
											<th>Status</th>
											<th class="d-none d-xl-table-cell">Aksi</th>
										</tr>
									</thead>
									<?php foreach($get_all_data_prab as $row){ 
									if($row->isModify == true){
										$modify_btn = "text-primary";
									}else{
										$modify_btn = "text-muted disabled";
									}	
									?>
									<tbody>
										<tr>
											<td><?= $row->topic ?></td>
											<td width="110px" class="d-table-cell"><?= date('d-m-Y', strtotime($row->date)) ?></td>
											<td class="d-table-cell"><?= $row->applicant ?></td>
											<td class="d-table-cell"><?= $row->departement ?></td>
											<td class="d-table-cell"><?= $row->outlet ?></td>
											<td class="d-table-cell"><?= $row->pic ?></td>
											<td class="d-table-cell text-right"><?= number_format($row->value,0,',','.')?></td>
											<td><span class="badge badge-success"><?= $row->status ?></span></td>
											<td class="d-table-cell"><a class="<?= $modify_btn ?>" data-toggle="tooltip" data-placement="left" title="Ubah" href="<?= base_url(); ?>dashboard/change_prab/<?= $row->id ?>"><i class="align-middle mr-1" data-feather="edit"></i></a></br><a class="text-success" data-toggle="tooltip" data-placement="left" title="Lihat" href="<?= base_url('dashboard/detail/'.$row->id)?>"><i class="align-middle mr-1" data-feather="eye"></i></a></td>
										</tr>
										
									</tbody>
									<?php } ?>
								</table>
							</div>
						</div>  
					</div>

					<!-- Approval PRAB -->


					<div id="approval_table" class="row">
						<div class="col-12 col-lg-12 col-xxl-12 d-flex">
							<div class="card flex-fill">
								<div class="card-header">
                                    <div class="row">
                                        <div class="col-12 col-md-4">
                                             <h4>Daftar PRAB yang diajukan </h4>
                                        </div>
                                        <div class="col-12 col-md-8 text-center text-sm-right">
                                            <form class="form-inline d-none d-sm-inline-block mr-3" method="POST" action="<?= base_url();?>dashboard/search_approved_prab">
                                                <div class="input-group input-group-navbar">
                                                    <input type="text" name="search" class="form-control" placeholder="Cari tema PRAB" aria-label="Search">
                                                    <div class="input-group-append">
                                                        <button class="btn" type="submit">
                                                            <i class="align-middle" data-feather="search"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
                                            
                                        </div>
                                    </div>
                                    
								</div>
								<table class="table table-striped w-100 table-responsive-lg my-0">
									<thead>
										<tr>
											<th>Tema</th>
                                            <th class="d-table-cell">Tgl. Diajukan</th>
                                            <th class="d-table-cell">Nama Pemohon</th>
                                            <th class="d-table-cell">Departement</th>
                                            <th class="d-table-cell">Cabang</th>
                                            <th class="d-table-cell">PIC Pendukung</th>
											<th class="d-table-cell">Total Anggaran </br>( Rp. )</th>
											<th>Status</th>
											<th class="d-none d-xl-table-cell">Aksi</th>
										</tr>
									</thead>
									<?php foreach($get_all_data_submitted_prab as $row){ ?>
									<tbody>
										<tr>
											<td><?= $row->topic ?></td>
											<td width="110px" class="d-table-cell"><?= date('d-m-Y', strtotime($row->date)) ?></td>
											<td class="d-table-cell"><?= $row->applicant ?></td>
											<td class="d-table-cell"><?= $row->departement ?></td>
											<td class="d-table-cell"><?= $row->outlet ?></td>
											<td class="d-table-cell"><?= $row->pic ?></td>
											<td class="d-table-cell text-right"><?= number_format($row->value,0,',','.')?></td>
											<td><span class="badge badge-success"><?= $row->status ?></span></td>
											<td class="d-table-cell"><a class="text-primary" data-toggle="tooltip" data-placement="top" title="Detail" href="<?= base_url('approval/detail/'.$row->id) ?>"><i class="align-middle mr-1" data-feather="eye"></i></a></td>
										</tr>
										
									</tbody>
									<?php } ?>
								</table>
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
									<a class="text-muted" href="#">Versi <?= $this->session->userdata('prab-version') ?></a>
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
		$(function() {
			var ctx = document.getElementById('chartjs-dashboard-line').getContext("2d");
			var gradient = ctx.createLinearGradient(0, 0, 0, 225);
			gradient.addColorStop(0, 'rgba(215, 227, 244, 1)');
			gradient.addColorStop(1, 'rgba(215, 227, 244, 0)');
			// Line chart
			new Chart(document.getElementById("chartjs-dashboard-line"), {
				type: 'line',
				data: {
					labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
					datasets: [{
						label: "Sales ($)",
						fill: true,
						backgroundColor: gradient,
						borderColor: window.theme.primary,
						data: [
							2115,
							1562,
							1584,
							1892,
							1587,
							1923,
							2566,
							2448,
							2805,
							3438,
							2917,
							3327
						]
					}]
				},
				options: {
					maintainAspectRatio: false,
					legend: {
						display: false
					},
					tooltips: {
						intersect: false
					},
					hover: {
						intersect: true
					},
					plugins: {
						filler: {
							propagate: false
						}
					},
					scales: {
						xAxes: [{
							reverse: true,
							gridLines: {
								color: "rgba(0,0,0,0.0)"
							}
						}],
						yAxes: [{
							ticks: {
								stepSize: 1000
							},
							display: true,
							borderDash: [3, 3],
							gridLines: {
								color: "rgba(0,0,0,0.0)"
							}
						}]
					}
				}
			});
		});
	</script>
	<script>
		$(document).ready(function(){
			<?php if( $this->session->userdata('prab-otoritas') == "Direktur Keuangan"){ ?>
				$('#all_prab_table').addClass('d-none');
				$('#approval_table').addClass('d-block');
			<?php }else{ ?>
				$('#all_prab_table').addClass('d-block');
				$('#approval_table').addClass('d-none');
			<?php } ?>
		});


	</script>
	<script>
		$(function() {
			// Bar chart
			new Chart(document.getElementById("chartjs-dashboard-bar"), {
				type: 'bar',
				data: {
					labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
					datasets: [{
						label: "This year",
						backgroundColor: window.theme.primary,
						borderColor: window.theme.primary,
						hoverBackgroundColor: window.theme.primary,
						hoverBorderColor: window.theme.primary,
						data: [54, 67, 41, 55, 62, 45, 55, 73, 60, 76, 48, 79],
						barPercentage: .75,
						categoryPercentage: .5
					}]
				},
				options: {
					maintainAspectRatio: false,
					legend: {
						display: false
					},
					scales: {
						yAxes: [{
							gridLines: {
								display: false
							},
							stacked: false,
							ticks: {
								stepSize: 20
							}
						}],
						xAxes: [{
							stacked: false,
							gridLines: {
								color: "transparent"
							}
						}]
					}
				}
			});
		});
	</script>
	<script>
		$(function() {
			$("#world_map").vectorMap({
				map: "world_mill",
				normalizeFunction: "polynomial",
				hoverOpacity: .7,
				hoverColor: false,
				regionStyle: {
					initial: {
						fill: "#e3eaef"
					}
				},
				markerStyle: {
					initial: {
						"r": 9,
						"fill": window.theme.primary,
						"fill-opacity": .95,
						"stroke": "#fff",
						"stroke-width": 7,
						"stroke-opacity": .4
					},
					hover: {
						"stroke": "#fff",
						"fill-opacity": 1,
						"stroke-width": 1.5
					}
				},
				backgroundColor: "transparent",
				zoomOnScroll: false,
				markers: [{
						latLng: [31.230391, 121.473701],
						name: "Shanghai"
					},
					{
						latLng: [28.704060, 77.102493],
						name: "Delhi"
					},
					{
						latLng: [6.524379, 3.379206],
						name: "Lagos"
					},
					{
						latLng: [35.689487, 139.691711],
						name: "Tokyo"
					},
					{
						latLng: [23.129110, 113.264381],
						name: "Guangzhou"
					},
					{
						latLng: [40.7127837, -74.0059413],
						name: "New York"
					},
					{
						latLng: [34.052235, -118.243683],
						name: "Los Angeles"
					},
					{
						latLng: [41.878113, -87.629799],
						name: "Chicago"
					},
					{
						latLng: [51.507351, -0.127758],
						name: "London"
					},
					{
						latLng: [40.416775, -3.703790],
						name: "Madrid"
					}
				]
			});
			setTimeout(function() {
				$(window).trigger('resize');
			}, 250)
		});
	</script>
	<script>
		<?php if($this->session->flashdata('access_denied') != ""){?>
			swal("Peringatan", "<?= $this->session->flashdata('access_denied'); ?>", "warning");
			
		<?php } ?>

		<?php if($this->session->flashdata('error_msg') != ""){?>
			swal("Gagal", "<?= $this->session->flashdata('error_msg'); ?>", "error");
			
		<?php } ?>
	</script>
	

</body>

</html>