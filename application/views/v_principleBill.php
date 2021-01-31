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
	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css"/>
	<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.4/css/buttons.dataTables.min.css"/>
	<style>
	@media print{    
		.no-print{
			display: none !important;
		}
	}
	</style>

	 
	<title>E-PRAB | Piutang principle </title>

	<link href="<?= base_url() ?>assets/css/app.css" rel="stylesheet">
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
                    <li class="sidebar-item">
						<a class="sidebar-link" href="<?= base_url('profile'); ?>">
                            <i class="align-middle" data-feather="user"></i> <span class="align-middle">Profil</span>
                        </a>
					</li>
                    <li class="sidebar-item <?= $d_payment ?>">
						<a class="sidebar-link" href="<?= base_url('payment'); ?>">
                            <i class="align-middle" data-feather="dollar-sign"></i> <span class="align-middle">Pencairan PRAB</span>
                        </a>
					</li>
					<li class="sidebar-item active <?= $d_principle ?>">
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
							<h3><strong>Piutang principle</strong></h3>
						</div>

						
					</div>
					<!-- <div class="row">
						<div class="col-xl-12 col-xxl-12 d-flex">
							<div class="w-100">
								<div class="row">
									<div class="col-sm-4">
										<div class="card">
											<div class="card-body">
												<h5 class="text-primary card-title mb-4">Total Pembayaran</h5>
												<h1 class="display-5 mt-1 mb-3"><?= $count_all_prab; ?></h1>
												<div class="mb-1">
													<span class="text-primary"> <i class="mdi mdi-arrow-bottom-right"></i> <?php if($count_all_prab > 0 ){ echo number_format(($count_all_prab/$count_global_prab)*100, 2, ',', ' '); }else{ echo 0; } ?>% </span>
													<span class="text-muted">Dari PRAB global</span>
												</div>
											</div>
                                        </div> 
									</div>
									<div class="col-sm-4">
                                        <div class="card">
											<div class="card-body">
												<h5 class="text-success card-title mb-4">Dibayar</h5>
												<h1 class="display-5 mt-1 mb-3"><?= $count_approved_prab; ?></h1>
												<div class="mb-1">
													<span class="text-success"> <i class="mdi mdi-arrow-bottom-right"></i> <?php if($count_approved_prab > 0){ echo number_format(($count_approved_prab/$count_global_prab)*100, 2, ',', ' ');}else{ echo 0; } ?>% </span>
													<span class="text-muted">Dari total PRAB</span>
												</div>
											</div>
                                        </div>
									</div>
									<div class="col-sm-4">
                                        <div class="card">
											<div class="card-body">
												<h5 class="text-danger card-title mb-4">Belum terbayar</h5>
												<h1 class="display-5 mt-1 mb-3"><?= $count_rejected_prab; ?></h1>
												<div class="mb-1">
													<span class="text-danger"> <i class="mdi mdi-arrow-bottom-right"></i> <?php if($count_rejected_prab > 0 ){ echo number_format(($count_rejected_prab/$count_all_prab)*100, 2, ',', ' '); }else{ echo 0;} ?>% </span>
													<span class="text-muted">Dari total PRAB</span>
												</div>
											</div>
                                        </div>
									</div>
								</div>
							</div>
						</div>
					</div> -->



					<div class="row">
						<div class="col-12 col-lg-12 col-xxl-12 d-flex">
							<div class="card flex-fill">
								<div class="card-header">
                                    <div class="row">
                                        <div class="col-12 col-md-4">
                                             <h4>Rekap piutang principle</h4>
                                        </div>
										
                                       
                                    </div>
									<div class="row my-4">
										<div class="col-12">
										<h5><strong>Filter</strong></h5>
                                             <form method="POST" action="<?= base_url('bill/filter') ?>">
												<div class="row">
													<div class="col-12 col-md-1">
														<label for="start_date">Status</label>
													</div>
													<div class="col-12 col-md-2">
														<select class="form-control" name="status" id="status">
															<option value="All">Semua status</option>
															<option value="2">Lunas</option>
                                                            <option value="1">Belum Lunas</option>
														</select>
													</div>
													<div class="col-12 col-md-1">
														<label for="start_date">Mulai tgl</label>
													</div>
													<div class="col-12 col-md-2">
														<input name="start_date" type="date" class="form-control">
													</div>
													<div class="col-12 text-center col-md-1">
														<label class="text-center" for="end_date">sampai</label>
													</div>
													<div class="col-12 col-md-2">
														<input name="end_date" type="date" class="form-control">
													</div>
													<div class="col-12 col-md-1 mt-2 mt-md-0">
														<input class="btn btn-primary" type="submit" value="Filter" class="form-control">
													</div>
												</div>
											 </form>
                                        </div>
									</div>
                                    
								</div>
                                <div class="row ml-2 mr-3 overflow-auto">
                                    <div class="col-12 w-100 mr-3" >
                                        <table id="example" class="display nowrap" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>ID PRAB</th>
                                                    <th>Nama Principle</th>
                                                    <th>Uraian</th>
                                                    <th>Jumlah ( Rp. )</th>
                                                    <th>Tanggal Penagihan</th>
                                                    <th>Status</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php 
                                            $no=0;
                                            foreach($priciple_bill as $row){ 
                                            $no +=1;
                                            ?>
												
                                                <tr>
                                                    <td><a href="<?= base_url('payment/detail/').$row->prab_id?>"><?= $row->prab_id ?></td>
                                                    <td><?= $row->principle_name ?></td>
                                                    <td><?= $row->description ?></td>
                                                    <td><?= number_format($row->value,0,',','.'); ?></td>
                                                    <td><?= date('d-m-Y', strtotime($row->date_experied))  ?></td>
                                                    <td><?= $row->status ?></td>
                                                    <td class="text-center"><button id="paidBtn"  data-id="<?= $row->id ?>" data-toggle="modal" data-target="#ModalPaidConfirm" class="paidBtn btn btn-success"><i class="align-middle mr-1" data-feather="check-square"></i> Lunas</button></td>
														
												</tr>
                                            <?php } ?>
                                            </tbody>
											<tfoot>
												<tr>
													<th>ID PRAB</th>
                                                    <th>Nama Principle</th>
                                                    <th>Uraian</th>
                                                    <th>Jumlah ( Rp. )</th>
                                                    <th>Tanggal Penagihan</th>
                                                    <th>Status</th>
                                                    <th>Aksi</th>
												</tr>
											</tfoot>
                                        </table>
                                    </div>
                                </div>
							</div>
						</div>  
					</div>

				</div>
					<!-- Paid Confirmation Modal -->
				<div class="modal fade" id="ModalPaidConfirm" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
					<div class="modal-dialog modal-dialog-centered modal-sm" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="exampleModalLongTitle">Konfirmasi Persetujuan</h5>
							</div>
							<form action="<?= base_url('Bill/principle_paid_checked'); ?>" method="POST">
							<div class="modal-body">
								<p class="text-center">Apakah anda akan menandai lunas ? </p>
								<input id="id_principle" type="hidden" name="id">
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
								<input type="submit" id="btn-approval" value="Iya" class="btn btn-primary">
							</div>
							</form>
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
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
	<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap.min.js"></script>
	<script src="https://cdn.datatables.net/buttons/1.6.4/js/dataTables.buttons.min.js"></script>
	<script src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.bootstrap.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
	<script src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.html5.min.js"></script>
	<script src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.print.min.js"></script>
	<script src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.colVis.min.js"></script>
    <script>
    $(document).ready(function() {
		$('#example').DataTable( {
			dom: 'Bfrtip',
			buttons: [
				'copy', 'csv', 'excel', 'print'
			],
			
		} );

		$('.paidBtn').click(function(){
			var id = $(this).data("id");
			$('#id_principle').val(id);
			
		});
	} );
    </script>
	<script>
	
	</script>

</body>

</html>