<!DOCTYPE html>
<html>
<head>
  <title>PRAB | CETAK PENYELESAIAN</title>
  <link href="<?= base_url();?>assets/css/app.css" rel="stylesheet">
  <style>

    @font-face {
    font-family: 'OpenSans-Regular';
    font-style: normal;
    font-weight: normal;
    src: url(<?= base_url();?>assets/fonts/OpenSans/OpenSans-Regular.ttf) format('truetype');
    }


      *{
          padding: 0;
          margin: 0;
          color : #2C2C2C;
          font-family: 'OpenSans-Regular';
      }

     .header{
        padding: 5px;
        margin: 20px;
        border-bottom: 1px solid #929292;
     }

     .title{
         font-weight: bold;
         font-size: 20px;
         color: #4F4F4F;
     }

     .payment_number{
         font-size: 14px;
         color: #6C6C6C;
     }

     .body{
        padding: 10px;
        margin: 20px;
     }


     .payment-list tr td{
         padding: 15px;
         color: #2C2C2C;
     }

     .payment-list th{
         padding: 15px;
         color: #2C2C2C;
     }
     .payment-list{
         width: 100%;
         margin-top: 10px;
     }
	
    @media print{    
		.no-print{
			display: none !important;
		}
	}



      
  </style>
</head>
<body>
<div class="row header">
    <?php foreach($get_prab as $row){
        $applicant = $row->applicant;
        ?>
    <div class="col-6 ">
        <h1 class="title">PENYELESAIAN PRAB </h1>
        <p class="payment_number">PRAB No. <?= $row->id ?></p>
    </div>
    <div style="text-align: right;" class="col-6">
        <button class="btn btn-primary px-3 text-white no-print" onclick="window.print()">Cetak</button>
        <a href="<?= base_url(); ?>settlement" class="btn btn-warning text-white no-print">Kembali</a>
    </div>
</div>
<div class="body">
    <table>
        <tr>
           <td style="padding:2px"><h5><strong>Tanggal PRAB</strong></h5></td>
           <td><h5>: <?= date('d-m-Y', strtotime($row->date)) ?></h5></td>
       </tr>
       <tr>
           <td style="padding:2px"><h5><strong>Tema PRAB</strong></h5></td>
           <td><h5>: <?= strtoupper($row->topic) ?></h5></td>
       </tr>
       <tr>
           <td style="padding:2px"><h5><strong>Cabang Pemohon</strong> </h5></td>
           <td><h5>: <?= strtoupper($row->outlet) ?></h5></td>
       </tr>
       <tr>
           <td style="padding:2px"><h5><strong>Departemen</strong> </h5></td>
           <td><h5>: <?= strtoupper($row->departement) ?></h5></td>
       </tr>
        <?php } ?>
    </table>
    <table class="payment-list">
        <thead style="border-bottom: 1px solid #929292;">
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Uraian</th>
                <th>Jumlah </br> penyelesaian ( Rp. )</th>
                <th>Status</th>
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
                $no +=1; 
            ?>
            <tr>
                <td width="30px"><?= $no; ?></td>
                <td width="150px"><?= date('d-m-Y', strtotime($row->date)); ?></td>
                <td><?= $row->description; ?></td>
                <td style="text-align: right;" width="160px"><?= number_format($row->value,0,',','.'); ?></td>
                <td width="200px"><?php if($row->isChecked == 0){ }else{ ?><p>Tervalidasi</p><?php } ?></td> 
            </tr>
            <?php } ?>
            <tr style="border-top: 1px solid #929292;">
                <td class="text-right text-dark" colspan="3"><strong>Total Penyelesaian :</strong></td>
                <td style="text-align: right;"><strong><?php if($total_settlement > 0 ){ echo number_format($total_settlement,0,',','.');}else{ echo 0;} ?></strong></td>
                <td colspan="3" class="d-table-cell"></td>
            </tr>
            <!-- <tr>
                <td class="text-right text-dark" colspan="3"><strong>Total Pencairan :</strong></td>
                <td style="text-align: right;"><strong><?php if($get_total_value[0]['total_value'] > 0 ){ echo number_format($get_total_value[0]['total_value'],0,',','.');}else{ echo 0;} ?></strong></td>
                <td colspan="3" class="d-table-cell"></td>
            </tr>
            <tr>
                <td class="text-right text-dark" colspan="3"><strong>Kembalian :</strong></td>
                <td style="text-align: right;"><strong><?= number_format(($get_total_value[0]['total_value']-$total_settlement),0,',','.') ?></strong></td>
                <td colspan="3" class="d-table-cell"></td>
            </tr> -->
        </tbody>
    </table>
    <table style="margin-top: 30px;" width="100%">
        <tr>
            <td style="text-align: center;">
                <p style="font-weight: bold;">Mengetahui</p>
                <br>
                <br>
                <p>Dian Dwiningsih</p>
            </td>
            <td style="text-align: center;">
                <p style="font-weight: bold;">Admin</p>
                <br>
                <br>
                <p>........................</p>
            </td>
            <td  style="text-align: center;">
                <p style="font-weight: bold;">Yang menyelesaikan</p>
                <br>
                <br>
                <p><?= $applicant; ?></p>
            </td>
        </tr>
    </table>
</div>
<p style="margin : 5px 20px 5px 20px; font-size: 12px; float: right;">Dicetak : <?= strtoupper($this->session->userdata('prab-name')) ?> Tgl. <?= date('d-m-Y H:i:s')?></p>
</body>
</html>
