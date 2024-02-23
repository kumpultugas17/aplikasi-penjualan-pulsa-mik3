<?php
require_once '../../config/config.php';
$tgl_awal = $_GET['tgl_awal'];
$tgl_akhir = $_GET['tgl_akhir']
?>

<!DOCTYPE html>
<html lang="en">

<head>
   <?php
   $periode = "Periode " . tgl_indo("d F Y", $tgl_awal) . " sampai dengan " . tgl_indo("d F Y", $tgl_akhir);
   ?>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title><?= $periode ?></title>
   <link rel="stylesheet" href="../../assets/plugins/bootstrap-5.2.3/css/bootstrap.min.css">
</head>

<body onload="window.print()">
   <h4 class="text-center">LAPORAN PENJUALAN PULSA ELTIPONSEL</h4>
   <p class="text-center"><?= $periode ?></p>
   <table class="table table-bordered table-striped">
      <thead>
         <tr>
            <th>No</th>
            <th>Tanggal</th>
            <th>Nama Pelanggan</th>
            <th>Nomor Handphone</th>
            <th>Operator</th>
            <th>Nominal</th>
            <th>Harga</th>
         </tr>
      </thead>
      <tbody>
         <?php
         $no = 1;
         $query = $conn->query("SELECT * FROM penjualan INNER JOIN pelanggan ON penjualan.pelanggan_id = pelanggan.id_pelanggan INNER JOIN pulsa ON penjualan.pulsa_id = pulsa.id_pulsa WHERE tanggal BETWEEN '$tgl_awal' AND '$tgl_akhir' ORDER BY id_penjualan DESC");
         foreach ($query as $data) :
            $total_pendapatan[] = $data['harga'];
         ?>
            <tr>
               <td><?= $no++ ?></td>
               <td><?= $data['tanggal'] ?></td>
               <td><?= $data['nama_pelanggan'] ?></td>
               <td><?= $data['no_hp'] ?></td>
               <td><?= $data['operator'] ?></td>
               <td><?= number_format($data['nominal'], 0, ',', '.') ?></td>
               <td>Rp. <?= number_format($data['harga'], 0, ',', '.') ?></td>
            </tr>
         <?php
         endforeach
         ?>
         <tr>
            <td colspan="6">Total Pendapatan</td>
            <td>Rp. <?= number_format(array_sum($total_pendapatan), 0, ',', '.') ?></td>
         </tr>
      </tbody>
   </table>
</body>

</html>