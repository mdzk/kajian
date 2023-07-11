<?= $this->extend('layouts/admin'); ?>

<?= $this->section('styles'); ?>
<link rel="stylesheet" href="<?= base_url(''); ?>assets/css/dataTables.bootstrap5.min.css">
<?= $this->endSection(); ?>

<?= $this->section('scripts'); ?>
<script src="<?= base_url(''); ?>assets/js/jquery.js"></script>
<script src="<?= base_url(''); ?>assets/js/jquery.dataTables.min.js"></script>
<script src="<?= base_url(''); ?>assets/js/dataTables.bootstrap5.min.js"></script>
<script>
  new DataTable('#example');
</script>
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<section class="section">
  <div class="container-fluid">
    <!-- ========== title-wrapper start ========== -->
    <div class="title-wrapper pt-30">
      <div class="row align-items-center">
        <div class="col-md-6">
          <div class="title mb-30">
            <h2>Pendahuluan</h2>
          </div>
        </div>
        <!-- end col -->
        <div class="col-md-6">
          <div class="breadcrumb-wrapper mb-30">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item">
                  <a href="#0">Kajian</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                  Pendahuluan
                </li>
              </ol>
            </nav>
          </div>
        </div>
        <!-- end col -->
      </div>
      <!-- end row -->
    </div>
    <!-- ========== title-wrapper end ========== -->
    <div class="row">
      <div class="col-lg-12">
        <div class="card-style mb-30">
          <div class="title d-flex flex-wrap align-items-center justify-content-between ">
            <div class="left">
              <h6 class="text-medium mb-30">Data Kajian Pendahuluan</h6>
            </div>
            <div class="right">
              <?php if (get_user('role') == 'admin') : ?>
                <a href="<?= route_to('dahulu-add'); ?>" class="btn btn-primary">+ Kajian</a>
              <?php endif; ?>
            </div>
          </div>
          <!-- End Title -->
          <?php if ($errors = session()->getFlashdata('errors')) : ?>
            <div class="alert alert-danger" role="alert">
              <?php foreach ($errors as $key => $value) { ?>
                <li><?= esc($value) ?></li>
              <?php } ?>
            </div>
          <?php endif; ?>

          <div class="table-responsive">
            <table class="table top-selling-table" id="example">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Kajian</th>
                  <th>Bidang</th>
                  <th>Prihal</th>
                  <th>File</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php $i = 1;
                foreach ($kajian as $data) : ?>
                  <tr>
                    <td><?= $i++; ?></td>
                    <td><?= $data['nama_kajian']; ?></td>
                    <td><?= $data['bidang']; ?></td>
                    <td><?= $data['prihal']; ?></td>
                    <td>
                      <?php if (get_user('role') == 'admin' || get_user('role') == 'pimpinan') : ?>
                        <a href="<?= base_url('redirect/' . $data['id_kajian']); ?>" class="btn btn-light"><i class="lni lni-remove-file"></i></a>
                      <?php endif; ?>
                      <?php if (cekUsulan(session('id_users'), $data['id_kajian'], 'terverifikasi')) : ?>
                        <a href="<?= base_url('redirect/' . $data['id_kajian']); ?>" class="btn btn-light"><i class="lni lni-remove-file"></i></a>
                      <?php endif; ?>

                      <?php if (!cekUsulan(session('id_users'), $data['id_kajian'], NULL) && get_user('role') == 'user') : ?>
                        <span class="status-btn close-btn">Tidak memiliki akses <?= cekUsulan(session('id_users'), $data['id_kajian'], NULL); ?></span>
                      <?php endif; ?>

                      <?php if (cekUsulan(session('id_users'), $data['id_kajian'], 'pending') && get_user('role') == 'user') : ?>
                        <span class="status-btn warning-btn">Sedang diajukan</span>
                      <?php endif; ?>

                      <?php if (cekUsulan(session('id_users'), $data['id_kajian'], 'proses') && get_user('role') == 'user') : ?>
                        <span class="status-btn warning-btn">Sedang diproses</span>
                      <?php endif; ?>

                      <?php if (cekUsulan(session('id_users'), $data['id_kajian'], 'revisi') && get_user('role') == 'user') : ?>
                        <span class="status-btn warning-btn">Harap direvisi</span>
                      <?php endif; ?>

                      <?php if (cekUsulan(session('id_users'), $data['id_kajian'], 'tolak') && get_user('role') == 'user') : ?>
                        <span class="status-btn close-btn">Akses ditolak</span>
                      <?php endif; ?>

                    </td>
                    <td>
                      <?php if (!cekUsulan(session('id_users'), $data['id_kajian'], NULL) && get_user('role') == 'user') : ?>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ajukankajian<?= $data['id_kajian']; ?>">Ajukan</button>
                        <!--Ajukan Kajian Modal Content -->
                        <div class="modal fade" id="ajukankajian<?= $data['id_kajian']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Form Pengajuan</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                              <form action="<?= route_to('usulan-store'); ?>" method="POST">
                                <input type="number" name="id_kajian" hidden value="<?= $data['id_kajian']; ?>">
                                <div class="modal-body">
                                  <div class="mb-3">
                                    <label for="prihal" class="form-label">Prihal Pengajuan</label>
                                    <input type="text" class="form-control" id="prihal" name="prihal" placeholder="Penelitian Artikel">
                                  </div>
                                  <div class="mb-3">
                                    <label for="instansi" class="form-label">Nama Instansi</label>
                                    <input type="text" class="form-control" id="instansi" name="instansi" placeholder="Universitas Indonesia">
                                  </div>
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                                  <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                                </div>
                              </form>
                            </div>
                          </div>
                        </div>
                        <!--Ajukan Kajian Modal Content End-->
                      <?php endif; ?>
                      <?php if (get_user('role') == 'admin') : ?>
                        <a href="<?= base_url('kajian/dahulu/edit/' . $data['id_kajian']); ?>" class="btn btn-warning"><i class="lni lni-pencil"></i></a>
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#hapuskajian<?= $data['id_kajian']; ?>"><i class="lni lni-trash-can"></i></button>
                        <!--Hapus Kajian Modal Content -->
                        <div class="modal fade" id="hapuskajian<?= $data['id_kajian']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Peringatan</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                              <form action="<?= route_to('dahulu-delete'); ?>" method="POST">
                                <input type="number" name="id_kajian" hidden value="<?= $data['id_kajian']; ?>">
                                <div class="modal-body">
                                  Apakah anda yakin ingin menghapus data ini?
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-light" data-bs-dismiss="modal">Tidak</button>
                                  <button type="submit" name="submit" class="btn btn-primary">Ya</button>
                                </div>
                              </form>
                            </div>
                          </div>
                        </div>
                        <!--Hapus Kajian Modal Content End-->
                      <?php endif; ?>
                      <?php if (cekUsulan(session('id_users'), $data['id_kajian'], 'terverifikasi') && get_user('role') == 'user') : ?>
                        <a href="<?= base_url('kajian/dahulu/show/' . $data['id_kajian']); ?>" class="btn btn-primary"><i class="lni lni-eye"></i></a>
                      <?php endif; ?>
                      <?php if (get_user('role') == 'admin' || get_user('role') == 'pimpinan') : ?>
                        <a href="<?= base_url('kajian/dahulu/show/' . $data['id_kajian']); ?>" class="btn btn-primary"><i class="lni lni-eye"></i></a>
                      <?php endif; ?>
                    </td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
            <!-- End Table -->
          </div>
        </div>
      </div>
      <!-- End Col -->
    </div>
    <!-- End Row -->
  </div>
  <!-- end container -->
</section>
<?= $this->endSection(); ?>