<?php
require_once '../../config/config.php';

if (isset($_POST['submit'])) {
   $nama = $_POST['nama'];
   $no_hp = $_POST['no_hp'];

   $query = $conn->query("INSERT INTO pelanggan (nama_pelanggan, no_hp) VALUES ('$nama', '$no_hp')");

   if ($query) {
      session_start();
      $_SESSION['alert'] = 'Menambahkan pelanggan baru.';
   } else {
      session_start();
      $_SESSION['alert'] = 'Menambahkan pelanggan baru.';
   }
   header('location:../../index.php?module=pelanggan');
} else {
   header('location:../../index.php?module=pelanggan');
}
