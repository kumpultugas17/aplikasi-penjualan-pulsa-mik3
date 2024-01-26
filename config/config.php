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
