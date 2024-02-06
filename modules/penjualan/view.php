<div class="row my-3">
   <div class="col-md-12">
      <h5>
         <!-- judul halaman tampil data penjualan -->
         <i class="fas fa-shopping-cart me-1"></i> Data Penjualan

         <!-- Button trigger modal -->
         <button type="button" class="btn btn-sm btn-info text-white float-end" data-bs-toggle="modal" data-bs-target="#modalTambah">
            <i class="fas fa-plus"></i> Tambah
         </button>
      </h5>
   </div>
</div>
<hr>
<div class="row">
   <div class="col-md-12">
      <!-- Pesan Suksess -->
      <?php
      if (isset($_SESSION['alert'])) {
      ?>
         <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-info-circle me-2"></i><strong>Sukses!</strong> <?= $_SESSION['alert'] ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
         </div>
      <?php
      }
      unset($_SESSION['alert']);
      ?>
      <!-- Pesan Gagal -->
      <?php
      if (isset($_SESSION['alert'])) {
      ?>
         <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-info-circle me-2"></i><strong>Gagal!</strong> <?= $_SESSION['alert'] ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
         </div>
      <?php
      }
      unset($_SESSION['alert']);
      ?>
      <div class="table-responsive">
         <table class="table table-striped border" id="data">
            <thead>
               <tr>
                  <th>No</th>
                  <th>Tanggal</th>
                  <th>Nama Pelanggan</th>
                  <th>Operator</th>
                  <th>Harga</th>
                  <th></th>
               </tr>
            </thead>
            <tbody>
               <?php
               $no = 1;
               $query = $conn->query("SELECT * FROM penjualan INNER JOIN pelanggan ON penjualan.pelanggan_id = pelanggan.id_pelanggan INNER JOIN pulsa ON penjualan.pulsa_id = pulsa.id_pulsa ORDER BY id_penjualan DESC");
               foreach ($query as $pjl) :
               ?>
                  <tr>
                     <td><?= $no++; ?></td>
                     <td><?= $pjl['tanggal']; ?></td>
                     <td><?= $pjl['nama_pelanggan'] . "<small class='text-muted'> - " . $pjl['no_hp'] . "</small>"; ?></td>
                     <td><?= $pjl['operator'] . "<small class='text-muted'> - " . $pjl['nominal'] . "</small>"; ?></td>
                     <td>Rp. <?= number_format($pjl['harga'], 0, ',', '.') ?></td>
                     <td>
                        <button type="button" class="btn btn-sm btn-danger" data-bs-target="#hapuspenjualan<?= $pjl['id_penjualan'] ?>" data-bs-toggle="modal">
                           <i class="fas fa-trash"></i>
                        </button>
                     </td>
                  </tr>

                  <!-- Modal Hapus-->
                  <div class="modal fade" id="hapuspenjualan<?= $pjl['id_penjualan'] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                     <div class="modal-dialog">
                        <div class="modal-content">
                           <div class="modal-header">
                              <h3 class="modal-title fs-5" id="staticBackdropLabel">
                                 <i class="fas fa-trash"></i><span> Hapus Data penjualan</span>
                              </h3>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                           </div>
                           <form action="modules/penjualan/proses_hapus.php" method="POST">
                              <div class="modal-body px-4">
                                 <input type="hidden" name="id_penjualan" value="<?= $pjl['id_penjualan']; ?>">
                                 <div class="fs-6">Apakah penjualan tanggal <strong><?= $pjl['tanggal'] ?></strong> dengan nama pelanggan <strong><?= $pjl['nama_pelanggan'] ?></strong> akan dihapus?</div>
                              </div>
                              <div class="modal-footer">
                                 <button type="submit" name="submit" class="btn btn-sm text-white btn-danger">Hapus</button>
                                 <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Batal</button>
                              </div>
                           </form>
                        </div>
                     </div>
                  </div>
               <?php
               endforeach
               ?>
            </tbody>
         </table>
      </div>
   </div>
</div>

<!-- Modal Tambah-->
<div class="modal fade" id="modalTambah" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <h3 class="modal-title fs-5" id="staticBackdropLabel">
               <i class="fas fa-cart-plus"></i><span> Entry Data penjualan</span>
            </h3>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
         <form action="modules/penjualan/proses_tambah.php" method="POST">
            <div class="modal-body px-4">
               <div class="mb-2">
                  <label class="form-label" for="tanggal">Tanggal</label>
                  <input type="date" class="form-control" id="tanggal" name="tanggal" value="<?= date('Y-m-d') ?>" autocomplete="off">
               </div>
               <div class="mb-2">
                  <label class="form-label" for="no_hp">Nomor Handphone</label>
                  <select name="pelanggan" id="pelanggan" class="select-box" onchange="get_pelanggan()" placeholder="Pilih nomor pelanggan">
                     <option value=""></option>
                     <?php
                     $pelanggan = $conn->query("SELECT * FROM pelanggan");
                     foreach ($pelanggan as $plg) :
                     ?>
                        <option value="<?= $plg['id_pelanggan'] ?>"><?= $plg['no_hp'] ?></option>
                     <?php endforeach ?>
                  </select>
               </div>

               <div class="mb-2">
                  <label class="form-label" for="nama_pelanggan">Nama Pelanggan</label>
                  <input type="text" id="nama_pelanggan" class="form-control">
               </div>

               <div class="mb-2">
                  <label class="form-label" for="operator">Operator Pulsa</label>
                  <select name="pulsa" id="pulsa" class="select-box" onchange="get_pulsa()" placeholder="Pilih operator pulsa">
                     <option value=""></option>
                     <?php
                     $pulsa = $conn->query("SELECT * FROM pulsa");
                     foreach ($pulsa as $pls) :
                     ?>
                        <option value="<?= $pls['id_pulsa'] ?>"><?= $pls['operator'] . ' - ' . $pls['nominal'] ?></option>
                     <?php endforeach ?>
                  </select>
               </div>

               <div class="mb-2">
                  <label class="form-label" for="harga">Harga</label>
                  <input type="number" id="harga" class="form-control">
               </div>
            </div>
            <div class="modal-footer">
               <button type="submit" name="submit" class="btn btn-sm text-white btn-info">Simpan</button>
               <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Batal</button>
            </div>
         </form>
      </div>
   </div>
</div>