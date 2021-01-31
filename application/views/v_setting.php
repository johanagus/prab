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

	<title>E-PRAB | Pengaturan</title>

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
					<li class="sidebar-item <?= $d_setting ?> active">
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

				<h1 class="h3 mb-3">Pengaturan</h1>
                <div class="row">
                    <div class="col-md-3 col-xl-2">

                        <div class="card">

                            <div class="list-group list-group-flush" role="tablist">
                                <a class="list-group-item list-group-item-action active" data-toggle="list" href="#account" role="tab">
                                    Pengguna
                                </a>
                                <a class="list-group-item list-group-item-action" data-toggle="list" href="#outlet" role="tab">
                                    Cabang
                                </a>
								<a class="list-group-item list-group-item-action" data-toggle="list" href="#departement" role="tab">
                                    Departemen
                                </a>
								<a class="list-group-item list-group-item-action" data-toggle="list" href="#group-item" role="tab">
                                    kelompok Item
                                </a>
								<a class="list-group-item list-group-item-action" data-toggle="list" href="#principle" role="tab">
                                    Principle
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-9 col-xl-10">
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="account" role="tabpanel">
                                <div class="card">
                                    <div class="card-body">
										<div class="card-header">
											<div class="row">
												<div class="col-12 col-md-4">
													<h4>Daftar Pengguna</h4>
												</div>
												<div class="col-12 col-md-8 text-center text-sm-right">
													<form class="form-inline d-none d-sm-inline-block mr-3" method="POST" action="<?= base_url();?>setting/search_user">
														<div class="input-group input-group-navbar">
															<input type="text" name="query" class="form-control" placeholder="Cari pengguna" aria-label="Search">
															<div class="input-group-append">
																<button class="btn" type="submit" name="submit">
																	<i class="align-middle" data-feather="search"></i>
																</button>
															</div>
														</div>
													</form>
													<a class="btn btn-primary text-white" data-toggle="modal" data-target="#ModalAddUser"><i class="align-center" data-feather="user-plus"></i> Tambah Pengguna</a>
												</div>
											</div>
											
										</div>
										<table class="table table-hover table-responsive my-0">
											<thead>
												<tr>
													<th>ID</th>
													<th class="d-table-cell">Nama Depan</th>
													<th class="d-table-cell">Nama Belakang</th>
													<th class="d-table-cell">ID Pengguna</th>
													<th class="d-table-cell">Departmen</th>
													<th class="d-table-cell">Cabang</th>
													<th class="d-table-cell">Otoritas</th>
													<th class="d-table-cell">Status</th>
													<th class="d-none d-xl-table-cell">Aksi</th>
												</tr>
											</thead>
											<?php 
											$no=0;
											foreach($users_list as $row){ 
											$no +=1;
											?>
											<tbody>
												<tr>
													<td><?= $no; ?></td>
													<td class="d-table-cell"><?= $row->first_name ?></td>
													<td class="d-table-cell"><?= $row->last_name ?></td>
													<td class="d-table-cell"><?= $row->username ?></td>
													<td class="d-table-cell"><?= $row->departement ?></td>
													<td class="d-table-cell"><?= $row->outlet ?></td>
													<td class="d-table-cell"><?= $row->authority ?></td>
													<td class="d-table-cell"><?php if($row->isActive==1){ ?> <span class="badge badge-success">Aktif</span> <?php }else{ ?> <span class="badge badge-danger">Non Aktif</span><?php } ?></td>
													<td class="d-table-cell"><?php if($row->isActive==1){ ?><a class="text-danger" data-toggle="tooltip" data-placement="left" title="Non Aktifkan" href="<?= base_url('setting/diactivate/'.$row->id)?>"><i class="align-middle mr-1" data-feather="toggle-left"></i></a> <?php }else{ ?><a class="text-success" data-toggle="tooltip" data-placement="left" title="Aktifkan" href="<?= base_url('setting/activate/'.$row->id)?>"><i class="align-middle mr-1" data-feather="toggle-left"></i></a> <?php } ?><a class="text-danger" data-toggle="tooltip" data-placement="left" title="Hapus pengguna" href="<?= base_url('setting/delete/'.$row->id)?>"><i class="align-middle mr-1" data-feather="user-x"></i></a></td>
												</tr>
												
											</tbody>
											<?php } ?>
										</table>
                                    </div>
                                </div>

                            </div>
                            <div class="tab-pane fade" id="outlet" role="tabpanel">
                                <div class="card">
                                    <div class="card-body">
										<div class="card-header">
												<div class="row">
													<div class="col-12 col-md-4">
														<h4>Daftar Cabang</h4>
													</div>
													<div class="col-12 col-md-8 text-center text-sm-right">
														<a class="btn btn-primary text-white" data-toggle="modal" data-target="#ModalAddOutlet"><i class="align-center" data-feather="plus"></i> Tambah Cabang</a>
													</div>
												</div>
												
											</div>
											<table class="table table-hover my-0">
												<thead>
													<tr>
														<th>ID</th>
														<th class="d-table-cell">Kode</th>
														<th class="d-table-cell">Nama cabang</th>
														<th class="d-table-cell">Aksi</th>
													</tr>
												</thead>
												<?php 
												$no=0;
												foreach($outlet as $row){ 
												$no +=1;
												?>
												<tbody>
													<tr>
														<td><?= $row->id; ?></td>
														<td class="d-table-cell"><?= $row->kode ?></td>
														<td class="d-table-cell"><?= $row->nama ?></td>
														<td class="d-table-cell"><a class="btn btn-danger" href="<?= base_url('setting/delete_outlet/'.$row->id) ?>">hapus</a></td>
												
													</tr>
													
												</tbody>
												<?php } ?>
											</table>
											
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="departement" role="tabpanel">
                                <div class="card">
                                    <div class="card-body">
										<div class="card-header">
												<div class="row">
													<div class="col-12 col-md-4">
														<h4>Daftar Departemen</h4>
													</div>
													<div class="col-12 col-md-8 text-center text-sm-right">
														<a class="btn btn-primary text-white" data-toggle="modal" data-target="#ModalAddDept"><i class="align-center" data-feather="plus"></i> Tambah Departemen</a>
													</div>
												</div>
												
											</div>
											<table class="table table-hover my-0">
												<thead>
													<tr>
														<th>ID</th>
														<th class="d-table-cell">Nama Departemen</th>
														<th class="d-none d-xl-table-cell">Aksi</th>
													</tr>
												</thead>
												<?php 
												$no=0;
												foreach($get_departement as $row){ 
												$no +=1;
												?>  
												<tbody>
													<tr>
														<td><?= $row->id; ?></td>
														<td class="d-table-cell"><?= $row->dept_name ?></td>
														<td class="d-table-cell"><a class="btn btn-danger" href="<?= base_url('setting/delete_dept/'.$row->id) ?>">hapus</a></td>
													</tr>
													
												</tbody>
												<?php } ?>
											</table>
											
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="group-item" role="tabpanel">
                                <div class="card">
                                    <div class="card-body">
										<div class="card-header">
												<div class="row">
													<div class="col-12 col-md-4">
														<h4>Daftar Kelompok Item</h4>
													</div>
													<div class="col-12 col-md-8 text-center text-sm-right">
														
														<a class="btn btn-primary text-white" data-toggle="modal" data-target="#ModalAddGroup"><i class="align-center" data-feather="plus"></i> Tambah Kelompok Item</a>
													</div>
												</div>
												
											</div>
											<table class="table table-hover my-0">
												<thead>
													<tr>
														<th>ID</th>
														<th class="d-table-cell">Nama Kelompok</th>
														<th class="d-none d-xl-table-cell">Aksi</th>
													</tr>
												</thead>
												<?php 
												$no=0;
												foreach($get_list_group as $row){ 
												$no +=1;
												?>
												<tbody>
													<tr>
														<td><?= $no; ?></td>
														<td class="d-table-cell"><?= $row->group_name ?></td>
														<td class="d-table-cell"><a class="btn btn-danger" href="<?= base_url('setting/delete_group/'.$row->id) ?>">hapus</a></td>
													</tr>
													
												</tbody>
												<?php } ?>
											</table>
											
                                    </div>
                                </div>
                            </div>
							<div class="tab-pane fade" id="principle" role="tabpanel">
                                <div class="card">
                                    <div class="card-body">
										<div class="card-header">
												<div class="row">
													<div class="col-12 col-md-4">
														<h4>Daftar principle</h4>
													</div>
													<div class="col-12 col-md-8 text-center text-sm-right">
														<a class="btn btn-primary text-white" data-toggle="modal" data-target="#ModalAddPrinciple"><i class="align-center" data-feather="plus"></i> Tambah Principle</a>
													</div>
												</div>
												
											</div>
											<table class="table table-hover my-0">
												<thead>
													<tr>
														<th>ID</th>
														<th class="d-table-cell">Nama Principle</th>
														<th class="d-table-cell">Alamat</th>
														<th class="d-table-cell">No. Telp</th>
														<th class="d-table-cell">Status</th>
														<th class="d-none d-xl-table-cell">Aksi</th>
													</tr>
												</thead>
												<?php 
												$no=0;
												foreach($get_principle as $row){ 
												$no +=1;
												?>  
												<tbody>
													<tr>
														<td><?= $row->id; ?></td>
														<td class="d-table-cell"><?= $row->name ?></td>
														<td class="d-table-cell"><?= $row->address ?></td>
														<td class="d-table-cell"><?= $row->phone ?></td>
														<td class="d-table-cell"><?= $row->status ?></td>
														<td class="d-table-cell"><a class="btn btn-outline-danger" href="<?= base_url('setting/delete_principle/'.$row->id) ?>">hapus</a></td>
													</tr>
													
												</tbody>
												<?php } ?>
											</table>
											
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



					

				</div>
				<!-- Modal add User -->
				<div class="modal fade" id="ModalAddUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered modal-sm" role="document">
					<div class="modal-content">
						<form id="form-add-payment" action="<?= base_url(); ?>setting/add_user" method="post">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLongTitle">Tambah pengguna</h5>
						</div>
						<div class="modal-body">
							<div class="form-group">
								<label class="form-label"><strong>Nama Depan</strong></label>
								<input type="text" name="first_name" class="form-control py-3" placeholder="Masukan nama depan pengguna" required oninvalid="this.setCustomValidity('Silahkan ketik nama depan pengguna!')" oninput="setCustomValidity('')">
							</div>
							<div class="form-group">
								<label class="form-label"><strong>Nama Belakang</strong></label>
								<input type="text" name="last_name" class="form-control py-3" placeholder="Masukan nama belakang pengguna" required oninvalid="this.setCustomValidity('Silahkan ketik nama belakang pengguna !')" oninput="setCustomValidity('')">
							</div>
							<div class="form-group">
								<label class="form-label"><strong>Nama Akun</strong></label>
								<input type="text" name="username" class="form-control py-3" placeholder="Ketik nama akun pengguna" required oninvalid="this.setCustomValidity('Silahkan ketik nama akun pengguna !')" oninput="setCustomValidity('')">
							</div>
							<div class="form-group">
								<label class="form-label"><strong>Password</strong></label>
								<input type="text" name="password" class="form-control py-3" placeholder="Ketik password pengguna" required oninvalid="this.setCustomValidity('Silahkan ketik password pengguna !')" oninput="setCustomValidity('')">
							</div>
							<div class="form-group">
								<label class="form-label"><strong>Email</strong></label>
								<input type="email" name="email" class="form-control py-3" placeholder="Ketik email pengguna" required oninvalid="this.setCustomValidity('Silahkan ketik email pengguna !')" oninput="setCustomValidity('')">
							</div>
							<div class="form-group">
								<label class="form-label"><strong>Departmen</strong></label>
								<select name="departement" class="form-control">
									<option selected>Pilih Departement</option>
									<?php foreach($get_departement as $row){ ?>
									<option value="<?= $row->dept_name ?>"><?= $row->dept_name ?></option>
									<?php } ?>
								</select>
							</div>
							<div class="form-group">
								<label class="form-label"><strong>Cabang</strong></label>
								<select name="outlet" class="form-control">
									<option selected>Pilih Cabang</option>
									<?php foreach($outlet as $row){ ?>
									<option value="<?= $row->kode ?>"><?= $row->nama ?></option>
									<?php } ?>
								</select>
							</div>
							<div class="form-group">
								<label class="form-label"><strong>Otoritas</strong></label>
								<select class="form-control" name="authority" >
									<option class="form-control" value="Administrator">Administrator</option>
									<option class="form-control" value="Direktur">Direktur</option>
									<option class="form-control" value="Direktur Keuangan">Direktur Keuangan</option>
									<option class="form-control" value="Finance">Finance</option>
									<option class="form-control" value="Manager">Manager</option>
									<option class="form-control" value="Supervisor">Supervisor</option>
									<option class="form-control" value="User">User</option>
								</select>
							</div>
							<div class="form-group">
								<label class="form-label"><strong>Atasan Langsung</strong></label>
								<select class="form-control" name="PICid" >
									<option class="form-control" value="">Pilih atasan langsung</option>
									<?php foreach($get_PIC as $row){ ?>
									<option class="form-control" value="<?= $row->id ?>"><?= strtoupper($row->first_name.' '.$row->last_name)?></option>
									<?php } ?>
									
								</select>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
							<button id="btn-add-payment" type="submit" class="btn btn-primary">Tambahkan</button>
						</div>
						</form>
					</div>
				</div>
				</div>

				<!-- Modal add Outlet -->
				<div class="modal fade" id="ModalAddOutlet" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered modal-sm" role="document">
					<div class="modal-content">
						<form id="form-add-payment" action="<?= base_url(); ?>setting/add_outlet" method="post">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLongTitle">Tambah Cabang</h5>
						</div>
						<div class="modal-body">
							<div class="form-group">
								<label class="form-label"><strong>Kode Cabang</strong></label>
								<input type="text" name="outlet_code" class="form-control py-3" placeholder="MJ01" required oninvalid="this.setCustomValidity('Silahkan masukan kode cabang!')" oninput="setCustomValidity('')">
							</div>
							<div class="form-group">
								<label class="form-label"><strong>Nama Cabang</strong></label>
								<input type="text" name="outlet_name" class="form-control py-3" placeholder="TOPSELL MOJOKERTO" required oninvalid="this.setCustomValidity('Silahkan masukan nama cabang !')" oninput="setCustomValidity('')">
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
							<button id="btn-add-payment" type="submit" class="btn btn-primary">Tambahkan</button>
						</div>
						</form>
					</div>
				</div>
				</div>


				<!-- Modal add Departement -->
				<div class="modal fade" id="ModalAddDept" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered modal-sm" role="document">
					<div class="modal-content">
						<form id="form-add-payment" action="<?= base_url(); ?>setting/add_dept" method="post">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLongTitle">Tambah Departemen</h5>
						</div>
						<div class="modal-body">
							<div class="form-group">
								<label class="form-label"><strong>Nama Departmen</strong></label>
								<input type="text" name="dept_name" class="form-control py-3" placeholder="Masukan nama departemen" required oninvalid="this.setCustomValidity('Silahkan masukan nama departemen !')" oninput="setCustomValidity('')">
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
							<button id="btn-add-payment" type="submit" class="btn btn-primary">Tambahkan</button>
						</div>
						</form>
					</div>
				</div>
				</div>

				<!-- Modal add Group -->
				<div class="modal fade" id="ModalAddGroup" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
					<div class="modal-dialog modal-dialog-centered modal-sm" role="document">
						<div class="modal-content">
							<form id="form-add-payment" action="<?= base_url(); ?>setting/add_group_item" method="post">
							<div class="modal-header">
								<h5 class="modal-title" id="exampleModalLongTitle">Tambah Kelompok Item</h5>
							</div>
							<div class="modal-body">
								<div class="form-group">
									<label class="form-label"><strong>Nama kelompok</strong></label>
									<input type="text" name="group_name" class="form-control py-3" placeholder="Masukan nama kelompok" required oninvalid="this.setCustomValidity('Silahkan masukan nama kelompok !')" oninput="setCustomValidity('')">
								</div>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
								<button id="btn-add-payment" type="submit" class="btn btn-primary">Tambahkan</button>
							</div>
							</form>
						</div>
					</div>
				</div>

				<!-- Modal add principle -->
				<div class="modal fade" id="ModalAddPrinciple" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
					<div class="modal-dialog modal-dialog-centered modal-sm" role="document">
						<div class="modal-content">
							<form id="form-add-payment" action="<?= base_url(); ?>setting/add_principle" method="post">
							<div class="modal-header">
								<h5 class="modal-title" id="exampleModalLongTitle">Tambah Principle</h5>
							</div>
							<div class="modal-body">
								<div class="form-group">
									<label class="form-label"><strong>Nama Principle</strong></label>
									<input type="text" name="name" class="form-control py-3" placeholder="Masukan nama principle" required oninvalid="this.setCustomValidity('Silahkan masukan nama principle !')" oninput="setCustomValidity('')">
								</div>
								<div class="form-group">
									<label class="form-label"><strong>Telphone / HP</strong></label>
									<input type="text" name="phone" class="form-control py-3" placeholder="Masukan nomor telp / HP" required oninvalid="this.setCustomValidity('Silahkan masukan telp / HP principle !')" oninput="setCustomValidity('')">
								</div>
								<div class="form-group">
									<label class="form-label"><strong>Alamat</strong></label>
									<textarea class="form-control py-2"  placeholder="Masukan alamat principle" name="address" id="address" cols="10" rows="2"  required oninvalid="this.setCustomValidity('Silahkan masukan nama principle !')" oninput="setCustomValidity('')"></textarea>
								</div>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
								<button id="btn-add-payment" type="submit" class="btn btn-primary">Tambahkan</button>
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
	<script src="<?= base_url(); ?>assets/js/sweetalert.min.js"></script>
	<script>
		<?php if($this->session->flashdata('msg') != ""){?>
			swal("Berhasil", "<?= $this->session->flashdata('msg'); ?>", "success");
			
		<?php } ?>
	</script>
	<script>
		<?php if($this->session->flashdata('error_msg') != ""){?>
			swal("Gagal", "<?= $this->session->flashdata('error_msg'); ?>", "error");
			
		<?php } ?>
	</script>

</body>

</html>