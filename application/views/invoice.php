<!DOCTYPE html>
<html>
<head>
  <title>Report Table</title>
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



      
  </style>
</head>
<body>
<div class="row header">
    <?php foreach($get_prab as $row){
        $applicant = $row->applicant;
        ?>
    <div class="col-6 ">
        <h1 class="title">PENCAIRAN PRAB </h1>
        <p class="payment_number">PRAB No. <?= $row->id ?></p>
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
                <th>Tgl. Pencairan</th>
                <th>Uraian</th>
                <th>Jumlah </br>Pencairan ( Rp. )</th>
                <th>Methode Pembayaran</th>
            </tr>
        </thead>
        <tbody>
            <?php $no=0; foreach($get_payment as $row){ $no +=1;?>
            <tr style="background-color: #F3F3F3;">
                <td><?= $no ?></td>
                <td><?= date('d-m-Y', strtotime($row->date)) ?></td>
                <td><?= strtoupper($row->description) ?></td>
                <td style="text-align: right;"><?= number_format($row->value,0,',','.') ?></td>
                <td><?= strtoupper($row->payment_methode) ?></td>
            </tr>
            <tr style="border-top: 1px solid #929292; ">
                <th colspan="3" style="text-align: right;">Total Pencairan</th>
                <th style="text-align: right;"><?= number_format($row->value,0,',','.') ?></th>
                <th></th>
            </tr>
            <?php } ?>
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
                <p style="font-weight: bold;">Penerima</p>
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