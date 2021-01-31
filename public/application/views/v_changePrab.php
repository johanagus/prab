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

	<title>E-PRAB | Ubah PRAB</title>

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
						<div class="col-12 col-sm-6 d-sm-block">
							<h3><strong>Ubah PRAB</strong></h3>
						</div>
						<div class="col-12 col-sm-6 d-sm-block text-right">
							<a href="<?= base_url(); ?>dashboard" class="btn btn-primary text-white"><strong><i data-feather="corner-up-left"></i></strong> Kembali</a>
							<a class="btn btn-success text-white" data-toggle="modal" data-target="#ModalSubmit"><strong><i data-feather="chevrons-up"></i></strong> Ajukan</a>
						</div>
					</div>
                    <div class="row">
						<div class="col">
                        <div class="card">
								<div class="card-body">
                                    <form method="POST" action="<?= base_url(); ?>/dashboard/change_prab_action">
                                        <?php foreach($get_data_prab as $row){
                                            $value_prab=$row->value; 
                                        ?>
                                        <div class="row">
                                            <div class="col-12 col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label"><strong>Tema</strong></label>
                                                    <input type="text" class="form-control" name="topic" value="<?= $row->topic; ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label class="form-label"><strong>Latar Belakang</strong></label>
                                                    <input type="text" name="background" class="form-control py-3" value="<?= $row->background; ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label class="form-label"><strong>Tujuan</strong></label>
                                                    <input type="text" name="goal" class="form-control py-3"  value="<?= $row->goal; ?>">
                                                </div>
												<div class="form-group">
                                                    <label class="form-label"><strong>PIC / Penanggung Jawab</strong></label>
                                                    <input type="text" name="pic" class="form-control py-3"  value="<?= $row->pic; ?>">
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                
                                                <div class="form-group">
                                                    <label class="form-label"><strong>Lokasi Pelaksanaan</strong></label>
                                                    <input type="text" name="location" class="form-control py-3" value="<?= $row->location; ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label class="form-label"><strong>Tanggal Pelaksanaan</strong></label>
                                                    <input type="date" name="event_date" class="form-control py-3"  value="<?= $row->event_date ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label class="form-label"><strong>Keterangan Tambahan</strong></label>
                                                    <input type="text" name="description" class="form-control py-3"  value="<?= $row->description; ?>">
                                                </div>
												<div class="form-group">
                                                    <label class="form-label"><strong>Fasilitas Pendukung</strong></label>
                                                    <input type="text" name="supporting_facilities" class="form-control py-3" value="<?= $row->supporting_facilities; ?>">
                                                </div>
												<div class="form-group">
                                                    <input type="hidden" name="id" value="<?= $row->id ?>">
                                               		<button type="submit" class="btn btn-primary">SIMPAN</button>
												</div>
                                            </div>
                                        <?php } ?>
                                        </form>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 col-md-6">
                                            <h4 class="my-3">Item PRAB</h4>
                                        </div>
                                        <div class="col-12 text-md-right col-md-6 mb-3 text-center">
                                            <a class="btn btn-primary text-white" data-toggle="modal" data-target="#ModalAddGroup">+ Buat Kelompok Item</a>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-12">
                                            <table class="table table-striped w-100 table-responsive-lg my-0">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
														<th class="d-table-cell">Uraian</th>
														<th class="d-table-cell">Merk / Type / Spec.</th>
                                                        <th class="d-table-cell">Qty</th>
														<th class="d-table-cell">Harga Satuan </br>( Rp. )</th>
														<th class="d-table-cell">Harga Total </br>( Rp. )</th>
                                                        <th class="d-table-cell">Keterangan</th>
                                                        <th class="d-none d-xl-table-cell">Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php  foreach($groups_prab as $row){ ?>
                                                    <tr>
                                                        <td class="d-table-cell text-primary"  colspan="4"><strong><?= strtoupper($row->group_name); ?></strong></td>
                                                        <td class="d-table-cell text-primary text-right"><strong>Total : </strong></td>
														<td class="d-table-cell text-primary"><strong><?= number_format($row->value,0,',','.'); ?></strong></td>
														<td class="d-table-cell"></td>
                                                        <td class="d-table-cell">
                                                            <a class="text-danger" href="<?= base_url()?>dashboard/delete_group_items/<?= $row->id ?>/<?= $this->uri->segment(3);?>?redirect=change_prab">
                                                                <i data-toggle="tooltip" data-placement="left" title="Hapus Kelompok Item" class="align-left mr-1" data-feather="delete"></i>
                                                            </a>
                                                            <a class="text-primary btn-add-item" data-groupId="<?= $row->id ?>" data-toggle="modal" data-target="#ModalAddItem" href="">
                                                                <i data-toggle="tooltip" data-placement="left" title="Tambah Item" class="align-right mr-1" data-feather="plus-square"></i>
                                                            </a>
                                                        </td>
													</tr>
													<?php $items = $this->db->get_where('items', array('prab_id' => $this->uri->segment(3), 'group_id' => $row->id));
													if ($items->num_rows() > 0) { 
                                                        $no=0;
														foreach ($items->result() as $items_row) { $no++;?>
														<tr>
															<td><?= $no; ?></td>
															<td class="d-table-cell"><?= strtoupper($items_row->item_description); ?></td>
															<td class="d-table-cell"><?= strtoupper($items_row->item_detail); ?></td>
															<td class="d-table-cell"><?= $items_row->qty; ?></td>
															<td class="d-table-cell"><?= number_format(($items_row->value_item/$items_row->qty),0,',','.'); ?></td>
															<td class="d-table-cell"><?= number_format($items_row->value_item,0,',','.'); ?></td>
															<td class="d-table-cell"><?= $items_row->explanation ?></td>
															<td class="d-table-cell"><a class="text-danger" data-toggle="tooltip" data-placement="left" title="hapus item" href="<?= base_url()?>dashboard/delete_item/<?= $items_row->id ?>/<?= $this->uri->segment(3);?>/<?= $row->id ?>?redirect=change_prab"><i class="align-middle mr-1" data-feather="delete"></i></a></td>
														</tr>
														<?php }
														}
                                                    
                                                    } ?>

                                                    
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="row ml-1 mt-3">
                                        <div class="col-12 col-md-9 alert-warning p-3 rounded">
                                            <p class="text-dark p-0 m-0"><strong>Catatan</strong></p>
                                            <?php foreach($get_data_prab as $row){?>
                                            <p class="p-0 m-0"><?= $row->note ?></p>
                                            <?php } ?>
                                        </div>
										<div class="col-12 col-md-3 text-right mb-3">
											<p class="text-muted m-1 p-0">Total Anggaran</p>
											<h4 class="pl-1 text-primary"><strong>Rp. 
											<?= number_format($value_prab,0,',','.')?>
											</strong> </h4>
										</div>
									</div>
                                    <div class="row mt-3 mr-2">
                                        
                                    </div>

                                    <!-- Financing suppoert section -->
									<div class="row">
                                        <div class="col-12 col-md-6">
                                            <h4 class="my-3">Support Biaya Principle</h4>
                                        </div>
                                        <div class="col-12 text-center text-md-right col-md-6">
                                            <a class="btn btn-primary text-white" data-toggle="modal" data-target="#ModalAddSponsorship">+ Pembiayaan</a>
                                        </div>
                                    </div>
									<div class="row">
                                        <div class="col-12">
                                            <table class="table table-striped w-100 table-responsive-lg my-0">
                                                <thead>
                                                    <tr>
														<th class="d-table-cell">Nama Principle</th>
														<th class="d-table-cell">Uraian</th>
														<th class="d-table-cell">Total </br> pembiayaan ( Rp )</th>
														<th class="d-table-cell">Tanggal </br> Penagihan</th>
                                                        <th class="d-none d-xl-table-cell">Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach($financing_support as $row){ ?>
                                                    <tr>
                                                        <td class="d-table-cell"><?= strtoupper($row->principle_name); ?></td>
														<td class="d-table-cell"><?= strtoupper($row->description); ?></td>
														<td class="d-table-cell"><?= number_format($row->value,0,',','.'); ?></td>
														<td class="d-table-cell"><?= date('d-m-Y', strtotime($row->date_experied)) ?></td>
                                                        <td class="d-table-cell">
															<a class="text-danger" href="<?= base_url()?>dashboard/delete_financing_support/<?= $row->id ?>/<?= $this->uri->segment(3);?>?redirect=change_prab">
																<i data-toggle="tooltip" data-placement="left" title="Batalkan pembiayaan" class="align-left mr-1" data-feather="delete"></i>
                                                            </a>
														</td>
													</tr>
													<?php } ?>                                                    
                                                </tbody>
                                            </table>
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
									<a class="text-muted" href="#">Versi <?= $this->session->userdata('prab-version') ?></a>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</footer>
            <!-- Modal ADD Group -->
        <div class="modal fade" id="ModalAddGroup" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                <div class="modal-content">
                    <form id="form-add-group" action="<?= base_url(); ?>dashboard/add_new_group_item" method="post">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Tambah kelompok Item</h5>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="group_name" class="form-label"><strong>Nama Kelompok</strong></label>
                            <select class="form-control" name="group_name" id="group_name" required oninvalid="this.setCustomValidity('Silahkan pilih kelompok yang akan di tambahkan !')" oninput="setCustomValidity('')">
                                <option class="form-control" value="">Pilih kelompok</option>
                                <?php foreach($get_list_group as $row){  ?>
                                <option class="form-control" value="<?= $row->group_name; ?>"><?= $row->group_name ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <input type="hidden" name="prab_id" value="<?= $this->uri->segment(3); ?>">
                        <input type="hidden" name="redirect" value="change_prab">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button id="btn-add-group" type="submit" class="btn btn-primary">Tambahkan</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>

                <!-- Modal ADD Item -->
        <div class="modal fade" id="ModalAddItem" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                <div class="modal-content">
                    <form id="form-add-item" action="<?= base_url(); ?>dashboard/add_new_item" method="post">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Tambah Item PRAB</h5>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="form-label"><strong>Uraian</strong></label>
                            <input type="text" name="item_description" class="form-control py-3" placeholder="Uraian item" required oninvalid="this.setCustomValidity('Silahkan lengkapi uraian item !')" oninput="setCustomValidity('')">
                        </div>
                        <div class="form-group">
                            <label class="form-label"><strong>Merk / Type / Spec.</strong></label>
                            <input type="text" name="item_detail" class="form-control py-3" placeholder="Type, Merk atau spesifikasi" required oninvalid="this.setCustomValidity('Silahkan lengkapi merk dan spesifikasi item !')" oninput="setCustomValidity('')">
                        </div>
                        <div class="form-group">
                            <label class="form-label"><strong>Jumlah</strong></label>
                            <input type="number" min="1" name="qty" class="form-control py-3" placeholder="Jumlah item" required oninvalid="this.setCustomValidity('Silahkan masukan jumlah item !')" oninput="setCustomValidity('')">
                        </div>
                        <div class="form-group">
                            <label class="form-label"><strong>Harga satuan</strong></label>
                            <input type="text" name="value" class="form-control py-3" placeholder="Harga satuan ( Rp. )" required oninvalid="this.setCustomValidity('Silahkan masukan harga satuan !')" oninput="setCustomValidity('')">
                        </div>
                        <div class="form-group">
                            <label class="form-label"><strong>Keterangan</strong></label>
                            <input type="text" name="explanation" class="form-control py-3" placeholder="Keterangan ( optional )">
                        </div>
                        <input type="hidden" name="prab_id" value="<?= $this->uri->segment(3); ?>">
                        <input type="hidden" id="group_id" name="group_id" value="">
                        <input type="hidden" id="redirect" name="redirect" value="dashboard/change_prab/<?= $this->uri->segment(3); ?>">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button id="btn-add-item" type="submit" class="btn btn-primary">Tambahkan</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
		<!-- Modal Submit -->
		<div class="modal fade" id="ModalSubmit" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Konfirmasi Persetujuan</h5>
                    </div>
                    <div class="modal-body">
						<p class="text-center" >Apakah anda ingin mengajukan PRAB ini ? </p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                        <button id="btn-approval" class="btn btn-primary">Iya</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal ADD Sponsorship -->
	    <div class="modal fade" id="ModalAddSponsorship" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                <div class="modal-content">
                    <form id="form-add-group" action="<?= base_url(); ?>dashboard/add_financing_support" method="post">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Tambah Support Pembiayaan</h5>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="form-label"><strong>Nama Principle</strong></label>
                            <select class="form-control" name="name" id="name" required oninvalid="this.setCustomValidity('Silahkan pilih kelompok yang akan di tambahkan !')" oninput="setCustomValidity('')">
                                <option class="form-control" value="">Pilih principle</option>
                                <?php foreach($principle as $row){  ?>
                                <option class="form-control" value="<?= $row->name; ?>"><strong><?= $row->name ?></strong></option>
                                <?php } ?>
                            </select>
                        </div>
						<div class="form-group">
                            <label class="form-label"><strong>Uraian</strong></label>
                            <input type="text" name="description" class="form-control py-3" placeholder="Uraian pembiayaan" required oninvalid="this.setCustomValidity('Silahkan lengkapi uraian pembiayaan!')" oninput="setCustomValidity('')">
                        </div>
						<div class="form-group">
                            <label class="form-label"><strong>Jumlah Pembiayaan ( Rp )</strong></label>
                            <input type="text" name="value" class="form-control py-3" placeholder="Jumlah pembiayan ( Rp )" required oninvalid="this.setCustomValidity('Silahkan masukan jumlah pembiayaan!')" oninput="setCustomValidity('')">
                        </div>
						<div class="form-group">
                            <label class="form-label"><strong>Tanggal penagihan</strong></label>
                            <input type="date" name="date_experied" class="form-control py-3" required oninvalid="this.setCustomValidity('Silahkan tentukan tanggal penagihan')" oninput="setCustomValidity('')">
                        </div>
                        <input type="hidden" name="prab_id" value="<?= $this->uri->segment(3); ?>">
						<input type="hidden" name="redirect" value="change_prab">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button id="btn-add-group" type="submit" class="btn btn-primary bg-muted">Tambahkan</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
	</div>
		</div>
	</div>

	<script src="<?= base_url(); ?>assets/js/vendor.js"></script>
    <script src="<?= base_url(); ?>assets/js/app.js"></script>
    <script>
         $(document).ready(function(){
            $('.btn-add-item').click(function(){
                var groupId =  $(this).data("groupid");

                document.getElementById("group_id").value = groupId;
            });

			$('#form-add-group').submit(function(){
				$('#btn-add-group').attr('disabled','');
			});

			$('#form-add-item').submit(function(){
				$('#btn-add-item').attr('disabled','');
			});

			$('#btn-approval').click(function(){
				$('#btn-approval').attr('disabled','');
				window.location.href='<?= base_url('dashboard/submit_prab/'.$this->uri->segment(3)) ;?>';
			});
    
        });
    </script>

</body>

</html>