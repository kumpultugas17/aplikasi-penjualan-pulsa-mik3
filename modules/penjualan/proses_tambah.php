<?php
require_once '../../config/config.php';

if (isset($_POST['submit'])) {
   $tanggal = $_POST['tanggal'];
   $pelanggan = $_POST['pelanggan'];
   $pulsa = $_POST['pulsa'];
   $harga = $_POST['harga'];

   $query = $conn->query("INSERT INTO penjualan (tanggal, pelanggan_id, pulsa_id, harga) VALUES ('$tanggal', '$pelanggan', '$pulsa', '$harga')");

   if ($query) {
      session_start();
      $_SESSION['alert'] = 'Melakukan transaksi baru.';
   } else {
      session_start();
      $_SESSION['alert'] = 'Melakukan transaksi baru.';
   }
   header('location:../../index.php?module=penjualan');
} else {
   header('location:../../index.php?module=penjualan');
}
