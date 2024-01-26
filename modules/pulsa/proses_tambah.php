<?php
require_once '../../config/config.php';

if (isset($_POST['submit'])) {
   $operator = $_POST['operator'];
   $nominal = $_POST['nominal'];
   $harga = $_POST['harga'];

   $query = $conn->query("INSERT INTO pulsa (operator, nominal, harga) VALUES ('$operator', '$nominal', '$harga')");

   if ($query) {
      session_start();
      $_SESSION['alert'] = 'Menambahkan operator baru.';
   } else {
      session_start();
      $_SESSION['alert'] = 'Menambahkan operator baru.';
   }
   header('location:../../index.php?module=pulsa');
} else {
   header('location:../../index.php?module=pulsa');
}
