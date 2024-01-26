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
                        <button type="button" class="btn btn-sm btn-info text-white" data-bs-target="#editpenjualan<?= $pjl['id_penjualan'] ?>" data-bs-toggle="modal">
                           <i class="fas fa-edit"></i>
                        </button>
                        <button type="button" class="btn btn-sm btn-danger" data-bs-target="#hapuspenjualan<?= $pjl['id_penjualan'] ?>" data-bs-toggle="modal">
                           <i class="fas fa-trash"></i>
                        </button>
                     </td>
                  </tr>

                  <!-- Modal Edit-->
                  <div class="modal fade" id="editpenjualan<?= $pjl['id_penjualan'] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                     <div class="modal-dialog">
                        <div class="modal-content">
                           <div class="modal-header">
                              <h3 class="modal-title fs-5" id="staticBackdropLabel">
                                 <i class="fas fa-user-edit"></i><span> Edit Data penjualan</span>
                              </h3>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                           </div>
                           <form action="modules/penjualan/proses_edit.php" method="POST">
                              <input type="hidden" name="id_penjualan" value="<?= $pjl['id_penjualan']; ?>">
                              <div class="modal-body px-4">
                                 <div class="mb-2">
                                    <label class="form-label" for="nama_penjualan">Nama penjualan</label>
                                    <input type="text" class="form-control" id="nama_penjualan" name="nama_penjualan" value="<?= $pjl['nama_penjualan']; ?>" autocomplete="off">
                                 </div>
                                 <div class="mb-2">
                                    <label class="form-label" for="no_hp">Nomor Handphone</label>
                                    <input type="number" class="form-control" id="no_hp" name="no_hp" value="<?= $pjl['no_hp']; ?>" autocomplete="off">
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
                                 <div class="fs-6">Apakah penjualan <strong><?= $pjl['nama_penjualan'] ?></strong> dengan nomor handphone <strong><?= $pjl['no_hp'] ?></strong> akan dihapus?</div>
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
               <i class="fas fa-user-plus"></i><span> Entry Data penjualan</span>
            </h3>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
         <form action="modules/penjualan/proses_tambah.php" method="POST">
            <div class="modal-body px-4">
               <div class="mb-2">
                  <label class="form-label">Nama penjualan</label>
                  <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan nama" autocomplete="off">
               </div>
               <div class="mb-2">
                  <label class="form-label" for="no_hp">No. HP</label>
                  <input type="number" class="form-control" id="no_hp" name="no_hp" placeholder="Masukkan nomor hp" autocomplete="off">
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