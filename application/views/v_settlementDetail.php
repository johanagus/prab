<!DOCTYPE html>
<html lang="en">
<?php 
$total_payment=0;
foreach($get_total_value as $row){ 
    $total_payment = $row->total_value;
} 
?>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Responsive Web UI Kit &amp; Dashboard Template based on Bootstrap">
	<meta name="author" content="AdminKit">
	<meta name="keywords" content="adminkit, bootstrap, web ui kit, dashboard template, admin template">

	<link rel="shortcut icon" href="<?= base_url(); ?>assets/images/icons/icon-48x48.png" />

	<title>E-PRAB | Detail Penyelesain PRAB</title>

	<link href="<?= base_url() ?>assets/css/app.css" rel="stylesheet">
    <style>
   .swal-modal .swal-text {
        text-align: center;
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
					<li class="sidebar-item <?= $d_payment ?>">
						<a class="sidebar-link" href="<?= base_url('payment'); ?>">
                            <i class="align-middle" data-feather="dollar-sign"></i> <span class="align-middle">Pencairan PRAB</span>
                        </a>
					</li>
                    <li class="sidebar-item active">
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
							<h3><strong>DETAIL PENYELESAIN PRAB</strong></h3>
						</div>
						<div class="col-12 col-sm-6 d-sm-block text-right">
                            <a href="<?= base_url(); ?>settlement" class="btn btn-primary text-white"><strong><i data-feather="corner-up-left"></i></strong> Kembali</a>
                                <?php if($this->session->userdata('prab-otoritas') == "Finance"){ ?><a data-toggle="modal" data-target="#ModalSubmit" class="btn btn-success text-white"><strong><i data-feather="chevrons-up"></i></strong> Selesai</a><?php }else{}?>
							
						</div>
					</div>
                    <div class="row">
						<div class="col">
                            <div class="card">
								<div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <div class="accordion" id="accordionExample">
                                                <div class="card">
                                                    <div class="card-header" id="headingOne">
                                                        <h2 class="mb-0">
                                                            <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                                <span><i style="font-size: 20px;" data-feather="arrow-down-right"></i> Detail PRAB</span>
                                                            </button>
                                                        </h2>
                                                    </div>

                                                        <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                                                            <div class="card-body">
                                                                <?php foreach($detail_prab as $row){ 
                                                                $value_prab= $row->value;
                                                                ?>
                                                                <div class="row">
                                                                	<div class="col-12 col-md-6">
                                                                        <div class="form-group">
                                                                            <p class="text-muted m-0 mb-1">Tema</p>
                                                                            <div ><strong><?= strtoupper($row->topic); ?></strong></div>
                                                                        </div>
                                                                        <div class="form-group ">
                                                                            <p class="text-muted m-0 mb-1">Latar Belakang</p>
                                                                            <div><strong><?= $row->background; ?></strong></div>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <p class="text-muted m-0 mb-1">Tujuan</p>
                                                                            <div><strong><?= $row->goal; ?></strong></div>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <p class="text-muted m-0 mb-1">PIC / Penanggung Jawab</p>
                                                                            <div><strong><?= strtoupper($row->pic); ?></strong></div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12 col-md-6">
                                                                        
                                                                        <div class="form-group">
                                                                            <p class="text-muted m-0 mb-1">Lokasi Pelaksanaan</p>
                                                                            <div><strong><?= strtoupper($row->location); ?></strong></div>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <p class="text-muted m-0 mb-1">Tanggal Pelaksanaan</p>
                                                                            <div><strong><?= date('d-m-Y', strtotime($row->event_date)); ?></strong></div>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <p class="text-muted m-0 mb-1">Keterangan Tambahan</p>
                                                                            <div><strong><?= $row->description; ?></strong></div>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <p class="text-muted m-0 mb-1">Fasilitas Pendukung</p>
                                                                            <div><strong><?= $row->supporting_facilities; ?></strong></div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <?php } ?>
                                                            </div>
                                                    </div>
                                                </div>

                                                <!-- Detail Item -->

                                                <div class="card">
                                                    <div class="card-header" id="headingTwo">
                                                    <h2 class="mb-0">
                                                        <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                        <i style="font-size: 20px;" data-feather="arrow-down-right"></i> Detail Item
                                                        </button>
                                                    </h2>
                                                    </div>
                                                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                                                    <div class="card-body">
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
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <?php foreach($groups_prab as $row){ ?>
                                                                        <tr>
                                                                            <td class="d-table-cell text-primary"  colspan="4"><strong><?= strtoupper($row->group_name); ?></strong></td>
                                                                            <td class="d-table-cell text-primary text-right"><strong>Total : </strong></td>
														                    <td class="d-table-cell text-primary text-right"><strong><?= number_format($row->value,0,',','.'); ?></strong></td>
                                                                            <td class="d-table-cell" colspan="2"></td>
                                                                        </tr>
                                                                        <?php $items = $this->db->get_where('items', array('prab_id' => $this->uri->segment(3), 'group_id' => $row->id));
                                                                        if ($items->num_rows() > 0) { 
                                                                            foreach ($items->result() as $items_row) { ?>
                                                                            <tr>
                                                                                <td>1</td>
                                                                                <td class="d-table-cell"><?= strtoupper($items_row->item_description); ?></td>
                                                                                <td class="d-table-cell"><?= strtoupper($items_row->item_detail); ?></td>
                                                                                <td class="d-table-cell"><?= $items_row->qty; ?></td>
                                                                                <td class="d-table-cell"><?= number_format(($items_row->value_item/$items_row->qty),0,',','.'); ?></td>
                                                                                <td class="d-table-cell text-right"><?= number_format($items_row->value_item,0,',','.'); ?></td>
                                                                                <td class="d-table-cell"><?= $items_row->explanation ?></td>
                                                                            </tr>
                                                                            <?php }
                                                                            }
                                                                        
                                                                        } ?>

                                                                        
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    </div>
                                                </div>

                                                <!-- Settlement Detail -->

                                                <div class="card">
                                                    <div class="card-header bg-muted" id="headingThree">
                                                    <h2 class="mb-0">
                                                        <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                                        <i style="font-size: 20px;" data-feather="arrow-down-right"></i> Detail Penyelesaian
                                                        </button>
                                                    </h2>
                                                    </div>
                                                    <div id="collapseThree" class="collapse show" aria-labelledby="headingThree" data-parent="#accordionExample">
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col-12 col-md-6 text-left mb-3">
                                                                <p class="text-muted m-1 p-0">Total Pencairan</p>

                                                                <?php if($total_paid_payment){ ?>
                                                                    <h4 class="pl-1"><strong>Rp. <?php if($total_paid_payment[0]['total_value'] > 0 ){ echo number_format($total_paid_payment[0]['total_value'],0,',','.');}else{ echo 0;} ?></strong> </h4>
                                                                <?php }else{ ?>
                                                                    <h4 class="pl-1"><strong>Rp. 0 </strong></h4>
                                                                <?php } ?>
                                                              
                                                            </div>
                                                            <div class="col-12 col-md-6 text-right mb-3">
                                                                <a class="btn btn-primary text-white" data-toggle="modal" data-target="#ModalAddSettlement">+ Buat penyelesaian</a>
                                                                <a class="btn btn-warning text-white" data-toggle="modal" data-target="#ModalAddOverpayment">+ Kelebihan pencairan</a>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <table class="table table-striped w-100 table-responsive-lg my-0">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>No</th>
                                                                            <th>Tanggal</th>
                                                                            <th class="d-table-cell">Uraian</th>
                                                                            <th class="d-table-cell">Jumlah </br> penyelesaian ( Rp. )</th>
                                                                            <th class="d-table-cell">Status</th>
                                                                            <th class="d-none d-xl-table-cell">Aksi</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                    <?php 
                                                                        $total_settlement=0;
                                                                        foreach($get_total_settlement_value as $row){ 
                                                                        $total_settlement = $row->total_value;
                                                                        } 
                                                                        $no=0;
                                                                        foreach($settlement_list as $row){
                                                                            if($row->isOverpayment == 1){
                                                                                $isOverpayment = "text-muted";
                                                                            }else{
                                                                                $isOverpayment = "text-dark";
                                                                            }
                                                                        $no +=1; 
                                                                    ?>
                                                                        <tr class="<?= $isOverpayment; ?>">
                                                                            <td><?= $no; ?></td>
                                                                            <td class="d-table-cell"><?= date('d-m-Y', strtotime($row->date)); ?></td>
                                                                            <td class="d-table-cell"><?= $row->description; ?></td>
                                                                            <td width="160px" class="d-table-cell text-right"><?= number_format($row->value,0,',','.'); ?></td>
                                                                            <td class="d-table-cell"><?php if($row->isChecked == 0){ }else{ ?><span class="badge badge-success">Tervalidasi</span><?php } ?></td>
                                                                            <td class="d-table-cell">
                                                                                <?php if($this->session->userdata('prab-otoritas') == "Administrator" || $this->session->userdata('prab-otoritas') == "User" || $this->session->userdata('prab-otoritas') == "Supervisor" || $this->session->userdata('prab-otoritas') == "Manager"){
                                                                                    if($row->isChecked == 0){ ?>
                                                                                        <a class="text-danger" data-toggle="tooltip" data-placement="left" title="Batalkan penyelesaian" href="<?= base_url()?>settlement/cancel_settlement/<?= $row->id ?>/<?= $this->uri->segment(3);?>">
                                                                                            <i class="align-middle mr-1" data-feather="delete"></i>
                                                                                        </a>
                                                                                    <?php }else{ 
                                                                
                                                                                    }
                                                                                    }elseif($this->session->userdata('prab-otoritas') == "Finance"){  ?>
                                                                                        <a id="proof-view-btn" class="text-primary proof-view-btn" data-id="<?= $row->id; ?>" data-imgsrc="<?= $row->attachment; ?>" data-ammount="<?= number_format($row->value,0,',','.'); ?>" data-toggle="tooltip" data-placement="left" title="Lihat bukti nota">
                                                                                            <i data-toggle="modal" data-target="#ModalViewNota" class="align-middle mr-1" data-feather="eye"></i>
                                                                                        </a> 
                                                                                <?php } ?></td>
                                                                        </tr>


                                                                    <?php } ?>
                                                                        <tr>
                                                                            <td class="text-right text-dark" colspan="3"><strong>Total Penyelesaian :</strong></td>
                                                                            <td class="d-table-cell text-right"><strong><?php if($total_settlement > 0 ){ echo number_format($total_settlement,0,',','.');}else{ echo 0;} ?></strong></td>
                                                                            <td colspan="3" class="d-table-cell"></td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                        <div class="row float-right m-3">
                                                            <div class="col-auto text-left mb-3">
                                                                <p class="text-muted m-1 p-0">Belum Terselesaikan</p>
                                                                <h4 class="pl-1 text-primary"><strong>Rp. 
                                                                <?php
                                                                if($total_paid_payment && $total_settlement){ 
                                                                    echo number_format(($total_paid_payment[0]['total_value']-$total_settlement),0,',','.'); 
                                                                }else{ 
                                                                    echo number_format('0',0,',','.'); 
                                                                }; 
                                                                ?>
                                                                </strong> </h4>
                                                            </div>
                                                        </div>
                                                        <div class="row float-right m-3">
                                                            <div class="col-auto text-left mb-3">
                                                                <p class="text-muted m-1 p-0">Kelebihan pencairan</p>
                                                                <h4 class="pl-1 text-success"><strong>Rp. 
                                                                <?php

                                                                if($get_total_overpayment_value){ 
                                                                    echo number_format($get_total_overpayment_value[0]['total_value'],0,',','.'); 
                                                                }else{ 
                                                                    echo number_format('0',0,',','.'); 
                                                                }; 
                                                                ?>
                                                                </strong> </h4>
                                                            </div>
                                                        </div>
                                                        <div class="row float-right m-3">
                                                            <div class="col-auto text-left mb-3">
                                                                <p class="text-muted m-1 p-0">Tidak Dicairkan</p>
                                                                <h4 class="pl-1 text-danger"><strong>Rp. 
                                                                <?php
                                                                if($total_unpaid_payment){ 
                                                                    echo number_format($total_unpaid_payment[0]['total_value'],0,',','.'); 
                                                                }else{ 
                                                                    echo number_format('0',0,',','.');  
                                                                }; 
                                                                ?>
                                                                </strong> </h4>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    </div>
                                                </div>

                                                <!-- End Settlement Detail -->
                                            </div>
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
									<a class="text-muted" href="#">Versi <?= $this->session->userdata('prab-version')?></a>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</footer>
        </div>
        <!-- Modal add Settlement -->
        <div class="modal fade" id="ModalAddSettlement" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                <div class="modal-content">
                    <form id="form-add-settlement" action="<?= base_url(); ?>settlement/add_settlement" method="post" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Penyelesaian Baru</h5>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="form-label"><strong>Uraian</strong></label>
                            <textarea type="text" name="description" class="form-control py-3" placeholder="Masukan uraian pencairan"  required oninvalid="this.setCustomValidity('Silahkan lengkapi uraian penyelesaian !')" oninput="setCustomValidity('')"></textarea>
                        </div>
                        <div class="form-group">
                            <label class="form-label"><strong>Jumlah Penyelesaian ( Rp. )</strong></label>
                            <input type="text" name="value" class="form-control py-3" placeholder="Masukan jumlah penyelesaian"  required oninvalid="this.setCustomValidity('Silahkan masukan jumlah penyelesain !')" oninput="setCustomValidity('')">
                        </div>
                        <div class="form-group">
                            <label class="form-label"><strong>Unggah Nota</strong></label>
                            <input type="file" name="attachment"  required oninvalid="this.setCustomValidity('Silahkan upload foto nota pembelian !')" oninput="setCustomValidity('')">
                            <p class="text-danger mt-1" style="font-size: 12px;">Ukuran file maksimal 2 MB</p>
                        </div>
                        <input type="hidden" name="prab_id" value="<?= $this->uri->segment(3); ?>">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>

         <!-- Modal View Nota -->
         <div class="modal fade" id="ModalViewNota" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                <div class="modal-content">
                    <form id="form-add-settlement" action="<?= base_url(); ?>settlement/validation" method="post" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Bukti Penyelesain</h5>
                    </div>
                    <div class="modal-body">
                        <img id="img-nota" style="width: 100%;" src="">
                        <p class="text-muted mt-4 m-1 p-0">Jumlah penyelesaian</p>
                        <h4 id="ammount" class="pl-1 font-weight-bold text-dark">Rp. 0</h4>
                        <input type="hidden" name="prab_id" value="<?= $this->uri->segment(3); ?>">
                        <input id="id_settlement" type="hidden" name="id" value="">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Validasi</button>
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
						<p class="text-center" >Apakah anda ingin menyelesaikan pencairan PRAB ini ? </p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                        <a href="<?= base_url('settlement/finish_prab/'.$this->uri->segment(3)) ;?>" class="btn btn-primary">Iya</a>
                    </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal add Overpayment -->
        <div class="modal fade" id="ModalAddOverpayment" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                <div class="modal-content">
                    <form id="form-add-settlement" action="<?= base_url(); ?>settlement/add_overpayment" method="post" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Kelebihan pencairan</h5>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="form-label"><strong>Uraian</strong></label>
                            <textarea type="text" name="description" class="form-control py-3" placeholder="Masukan uraian kelebihan pencairan ( optional )" ></textarea>
                        </div>
                        <div class="form-group">
                            <label class="form-label"><strong>Jumlah Kelebihan ( Rp. )</strong></label>
                            <input type="text" name="value" class="form-control py-3" placeholder="Masukan jumlah kelebihan"  required oninvalid="this.setCustomValidity('Silahkan masukan jumlah penyelesain !')" oninput="setCustomValidity('')">
                        </div>
                        <input type="hidden" name="prab_id" value="<?= $this->uri->segment(3); ?>">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>

	</div>

	<script src="<?= base_url(); ?>assets/js/vendor.js"></script>
	<script src="<?= base_url(); ?>assets/js/app.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

	
    <script>
            <?php if($this->session->flashdata('msg') != ""){?>
                swal("Berhasil", "<?= $this->session->flashdata('msg'); ?>", "success");
            <?php } ?>

            <?php if($this->session->flashdata('error_msg') != ""){?>
                swal("Gagal", "<?= $this->session->flashdata('error_msg'); ?>", "error");
            <?php } ?>
            
         $(document).ready(function(){
            $('.btn-add-item').click(function(){
                var groupId =  $(this).data("groupid");

                document.getElementById("group_id").value = groupId;
            });

            <?php if($this->session->flashdata('msg') != ""){?>
                swal("Berhasil", "<?= $this->session->flashdata('msg'); ?>", "success");
                
                
            <?php } ?>

            <?php if($this->session->flashdata('error_msg') != ""){?>
                swal("Gagal", "<?= $this->session->flashdata('error_msg'); ?>", "error");
                
            <?php } ?>
        });
    </script>
    <script>
    $(document).ready(function(){
        $('#payment_methode').click(function(){
            var payment_methode = document.getElementById('payment_methode').value;
            var account_number = document.getElementById('account_number');
            //   alert('okee');
            if( payment_methode == 'Transfer'){
                $('#account_number').addClass("d-block");
            }else{
                $('#account_number').removeClass("d-block");
            }
        });
    });

    $('#form-add-settlement').submit(function()
    {
		$('#btn-add-group').attr('disabled','');
        $('#btn-add-group').val="Mohon Tunggu";
		

    });

    $('.proof-view-btn').click(function(){
        var imgsrc  = $(this).data("imgsrc");
        var id      = $(this).data("id");
        var ammount = $(this).data("ammount")

        document.getElementById("img-nota").src = '<?= base_url()?>uploads/'+imgsrc;
        document.getElementById("id_settlement").value = id;
        document.getElementById("ammount").innerHTML = 'Rp. '+ammount;

    });
    </script>

</body>

</html>