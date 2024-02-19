<?php
if (isset($_POST['cari'])) {
   require_once '../../config/config.php';
   $tgl_awal = date('Y-m-d', strtotime($_POST['tgl_awal']));
   $tgl_akhir = date('Y-m-d', strtotime($_POST['tgl_akhir']));

   $query = $conn->query("SELECT tanggal FROM penjualan WHERE tanggal BETWEEN '$tgl_awal' AND '$tgl_akhir'");
   $result = mysqli_num_rows($query);

   if ($result > 0) {
      session_start();
      $_SESSION['alert_success'] = 'Data transaksi dari <strong>' . date('d F Y', strtotime($tgl_awal)) . '</strong> sampai <strong>' . date('d F Y', strtotime($tgl_akhir)) . '</strong>';
      $_SESSION['tgl_awal'] = $tgl_awal;
      $_SESSION['tgl_akhir'] = $tgl_akhir;
   } else {
      session_start();
      $_SESSION['alert_error'] = 'Tidak ditemukan transaksi dari <strong>' . date('d F Y', strtotime($tgl_awal)) . '</strong> sampai <strong>' . date('d F Y', strtotime($tgl_akhir)) . '</strong>';
      $_SESSION['tgl_awal'] = $tgl_awal;
      $_SESSION['tgl_akhir'] = $tgl_akhir;
   }
   header('location:../../index.php?module=laporan');
} else {
   header('location:../../index.php?module=laporan');
}
