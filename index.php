<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta name="description" content="Aplikasi Penjualan Pulsa">
   <meta name="keywords" content="Aplikasi Penjualan Pulsa">
   <meta name="author" content="Muhammad Iqbal Adenan">
   <!-- favicon -->
   <link rel="shortcut icon" href="assets/img/favicon.png">
   <!-- bootstrap css -->
   <link rel="stylesheet" href="assets/plugins/bootstrap-5.2.3/css/bootstrap.min.css">
   <!-- title -->
   <title>Dashboard - ELTIPONSEL</title>
</head>

<body class="d-flex flex-column vh-100">
   <!-- navbar -->
   <nav class="navbar navbar-expand-lg bg-body-tertiary border-bottom shadow-sm p-3 mb-3">
      <div class="container">
         <a class="navbar-brand" href="#">
            <img src="assets/img/logo.png" alt="logo" width="30" class="d-inline-block align-text-top">
            <span class="title">ELTIPONSEL</span>
         </a>
         <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
         </button>
         <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
               <li class="nav-item">
                  <a class="nav-link <?= $_GET['module'] == 'beranda' ? 'active' : '' ?>" aria-current="page" href="index.php?module=beranda">Beranda</a>
               </li>
               <li class="nav-item">
                  <a class="nav-link <?= $_GET['module'] == 'pelanggan' ? 'active' : '' ?>" aria-current="page" href="index.php?module=pelanggan">Pelanggan</a>
               </li>
               <li class="nav-item">
                  <a class="nav-link <?= $_GET['module'] == 'pulsa' ? 'active' : '' ?>" aria-current="page" href="index.php?module=pulsa">Pulsa</a>
               </li>
               <li class="nav-item">
                  <a class="nav-link <?= $_GET['module'] == 'penjualan' ? 'active' : '' ?>" aria-current="page" href="index.php?module=penjualan">Penjualan</a>
               </li>
               <li class="nav-item">
                  <a class="nav-link <?= $_GET['module'] == 'laporan' ? 'active' : '' ?>" aria-current="page" href="index.php?module=laporan">Laporan</a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" aria-current="page" href="logout.php">Logout</a>
               </li>
            </ul>
         </div>
      </div>
   </nav>

   <!-- main -->
   <main role="main" class="container">
      <?php
      switch ($_GET['module']) {
         case 'beranda':
            echo 'Halaman Beranda';
            break;

         case 'pelanggan':
            echo 'Halaman Pelanggan';
            break;

         case 'pulsa':
            echo 'Halaman Pulsa';
            break;

         case 'penjualan':
            echo 'Halaman Penjualan';
            break;

         case 'laporan':
            echo 'Halaman Laporan';
            break;

         default:
            echo 'Halaman Tidak Ditemukan';
            break;
      }
      ?>
   </main>

   <!-- footer -->
   <footer class="container d-flex flex-wrap justify-content-center align-item-center py-3 my-0 border-top mt-auto">
      <p class="col-md-6 mb-0 text-muted text-center">
         &#169; 2014 ELTIPONSEL, mik3
      </p>
   </footer>

   <!-- bootstrap js -->
   <script src="assets/plugins/bootstrap-5.2.3/js/bootstrap.bundle.min.js"></script>
</body>

</html>