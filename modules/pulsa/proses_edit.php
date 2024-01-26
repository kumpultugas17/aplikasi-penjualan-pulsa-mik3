<?php
require_once '../../config/config.php';

if (isset($_POST['submit'])) {
   $id_pulsa = $_POST['id_pulsa'];
   $operator = $_POST['operator'];
   $nominal = $_POST['nominal'];
   $harga = $_POST['harga'];

   $query = $conn->query("UPDATE pulsa SET operator = '$operator', nominal = '$nominal', harga = '$harga' WHERE id_pulsa = '$id_pulsa'");

   if ($query) {
      session_start();
      $_SESSION['alert'] = 'Merubah data operator.';
   } else {
      session_start();
      $_SESSION['alert'] = 'Merubah data operator.';
   }
   header('location:../../index.php?module=pulsa');
} else {
   header('location:../../index.php?module=pulsa');
}
