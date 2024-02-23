<div class="row my-3">
   <div class="col-md-12">
      <h5>
         <i class="fas fa-file-alt me-1"></i>
         Laporan Penjualan
      </h5>
   </div>
</div>
<hr>
<div class="row">
   <div class="col-md-12">
      <?php if (isset($_SESSION['alert_success'])) { ?>
         <div class="alert alert-success alert-dismissible fade show">
            <i class="fas fa-info-circle me-2"></i> <?= $_SESSION['alert_success'] ?>
         </div>
      <?php }
      unset($_SESSION['alert_success']);
      ?>

      <?php if (isset($_SESSION['alert_error'])) { ?>
         <div class="alert alert-danger alert-dismissible fade show">
            <i class="fas fa-info-circle me-2"></i> <?= $_SESSION['alert_error'] ?>
         </div>
      <?php
      }
      unset($_SESSION['alert_error']);
      ?>

      <div class="mb-2">Filter</div>

      <form action="modules/laporan/get_data.php" method="post" class="row gx-3 gy-2 align-items-center">
         <div class="col-sm-6">
            <div class="input-group">
               <input type="date" name="tgl_awal" id="tgl_awal" class="form-control">
               <div class="input-group-text">to</div>
               <input type="date" name="tgl_akhir" id="tgl_akhir" class="form-control">
            </div>
         </div>
         <div class="col-sm-6">
            <button type="submit" name="cari" class="btn btn-info text-light">
               <i class="fas fa-search"></i> Cari
            </button>
            <?php
            if (isset($_SESSION['tgl_awal'])) {
               $tgl_awal = $_SESSION['tgl_awal'];
               $tgl_akhir = $_SESSION['tgl_akhir'];
            ?>
               <a target="_blank" href="modules/laporan/pdf.php?tgl_awal=<?= $tgl_awal ?>&tgl_akhir=<?= $tgl_akhir ?>" class="btn btn-outline-danger float-end">
                  <i class="fas fa-file-pdf"></i> Export pdf
               </a>
               <a target="_blank" href="modules/laporan/xls.php?tgl_awal=<?= $tgl_awal ?>&tgl_akhir=<?= $tgl_akhir ?>" class="btn btn-outline-success float-end me-2">
                  <i class="fas fa-file-excel"></i> Export xls</a>
            <?php
            }
            ?>
         </div>
      </form>

      <?php
      if (isset($_SESSION['tgl_awal'])) {
         $tgl_awal = $_SESSION['tgl_awal'];
         $tgl_akhir = $_SESSION['tgl_akhir'];
      ?>

         <hr class="my-4">
         <div class="table-responsive">
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
                     // $total_pendapatan[] = $data['harga'];
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
                  <!-- <tr>
                     <td colspan="6">Total Pendapatan</td>
                     <td>Rp. <?= number_format(array_sum($total_pendapatan), 0, ',', '.') ?></td>
                  </tr> -->
               </tbody>
            </table>
         </div>
      <?php
      }
      unset($_SESSION['tgl_awal']);
      unset($_SESSION['tgl_akhir']);
      ?>
   </div>
</div>