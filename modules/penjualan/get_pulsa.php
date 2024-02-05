<?php
if (isset($_GET['id_pulsa'])) {
   require_once '../../config/koneksi.php';
   $id_pulsa = $_GET['id_pulsa'];
   $query = $conn->query("SELECT * FROM pulsa WHERE id_pulsa = '$id_pulsa'");
   $pelanggan = mysqli_fetch_assoc($query);
   $data = array(
      'harga' => $pelanggan['harga']
   );
   echo json_encode($data);
}
