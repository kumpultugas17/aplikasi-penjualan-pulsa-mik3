<?php
// set default timezone
date_default_timezone_set("ASIA/JAKARTA");
// koneksi database
require_once "koneksi.php";

// pelanggan
$pelanggan = $conn->query("SELECT COUNT(id_pelanggan) as pelanggan FROM pelanggan");
$data_pelanggan = mysqli_fetch_assoc($pelanggan);
$get_pelanggan = $data_pelanggan['pelanggan'];

// pulsa
$pulsa = $conn->query("SELECT COUNT(id_pulsa) as pulsa FROM pulsa");
$data_pulsa = mysqli_fetch_assoc($pulsa);
$get_pulsa = $data_pulsa['pulsa'];

// penjualan
$penjualan = $conn->query("SELECT COUNT(id_penjualan) as penjualan FROM penjualan");
$data_penjualan = mysqli_fetch_assoc($penjualan);
$get_penjualan = $data_penjualan['penjualan'];

// pendapatan
$pendapatan = $conn->query("SELECT SUM(harga) as pendapatan FROM penjualan");
$data_pendapatan = mysqli_fetch_assoc($pendapatan);
$get_pendapatan = $data_pendapatan['pendapatan'];


function tgl_indo($format, $time = false)
{ 
   $day   = array('Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min');
   $days  = array('Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu');
   $month = array('', 'Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des');
   $months = array('', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');

   if (!is_a($time, 'DateTime')) {
      if (is_int($time)) {
         $time = new DateTime(date('Y-m-d H:i:s.u', $time));
      } elseif (is_string($time)) {
         try {
            $time = new DateTime($time);
         } catch (Exception $e) {
            $time = new DateTime();
         }
      } else {
         $time = new DateTime();
      }
   }
   $ret = '';
   for ($i = 0; $i < strlen($format); $i++) {
      switch ($format[$i]) {
         case 'D':
            $ret .= $day[$time->format('w')];
            break;
         case 'l':
            $ret .= $days[$time->format('w')];
            break;
         case 'M':
            $ret .= $month[$time->format('n')];
            break;
         case 'F':
            $ret .= $months[$time->format('n')];
            break;
         case '\\':
            $ret .= $format[$i + 1];
            $i++;
            break;
         default:
            $ret .= $time->format($format[$i]);
            break;
      }
   }
   return $ret;
}
