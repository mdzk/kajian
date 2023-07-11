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
                        <h2>Usulan</h2>
                    </div>
                </div>
                <!-- end col -->
                <div class="col-md-6">
                    <div class="breadcrumb-wrapper mb-30">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item active" aria-current="page">
                                    Usulan
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
                            <h6 class="text-medium mb-30">Data Usulan</h6>
                        </div>
                        <div class="right">

                        </div>
                    </div>
                    <!-- End Title -->
                    <div class="table-responsive">
                        <table class="table top-selling-table" id="example">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Prihal</th>
                                    <th>Instansi</th>
                                    <th>Kajian</th>
                                    <th>Tgl Pengajuan</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1;
                                foreach ($usulan as $data) : ?>
                                    <tr>
                                        <td><?= $i++; ?></td>
                                        <td><?= $data['prihal_usulan']; ?></td>
                                        <td><?= $data['instansi']; ?></td>
                                        <td><?= $data['nama_kajian']; ?></td>
                                        <td><?= $data['created_at']; ?></td>
                                        <td><span class="status-btn <?= $data['status_usulan'] == 'tolak' ? 'danger' : 'warning' ?>-btn text-capitalize"><?= $data['status_usulan']; ?></span></td>
                                        <td>
                                            <?php if (($data['status_usulan'] == 'pending' || $data['status_usulan'] == 'revisi')  && get_user('role') == 'user') : ?>
                                                <a href="<?= base_url('usulan/edit/' . $data['id_usulan']); ?>" class="btn btn-warning"><i class="lni lni-pencil"></i></a>

                                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#hapususulan<?= $data['id_usulan']; ?>"><i class="lni lni-trash-can"></i></button>
                                                <!--Hapus Kajian Modal Content -->
                                                <div class="modal fade" id="hapususulan<?= $data['id_usulan']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Peringatan</h1>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <form action="<?= route_to('usulan-delete'); ?>" method="POST">
                                                                <input type="number" name="id_usulan" hidden value="<?= $data['id_usulan']; ?>">
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

                                            <?php if (get_user('role') == 'admin') : ?>
                                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#verifusulan<?= $data['id_usulan']; ?>"><i class="lni lni-checkmark"></i></button>
                                                <!--Hapus Usulan Modal Content -->
                                                <div class="modal fade" id="verifusulan<?= $data['id_usulan']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Peringatan</h1>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <form action="<?= route_to('usulan-process'); ?>" method="POST">
                                                                <input type="number" name="id_usulan" hidden value="<?= $data['id_usulan']; ?>">
                                                                <div class="modal-body">
                                                                    Apakah anda yakin ingin verifikasi data ini?
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Tidak</button>
                                                                    <button type="submit" name="submit" class="btn btn-primary">Ya</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--Hapus Usulan Modal Content End-->
                                            <?php endif; ?>

                                            <?php if (get_user('role') == 'pimpinan') : ?>
                                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#verifusulan<?= $data['id_usulan']; ?>"><i class="lni lni-checkmark"></i></button>
                                                <div class="modal fade" id="verifusulan<?= $data['id_usulan']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Peringatan</h1>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <form action="<?= route_to('usulan-verification'); ?>" method="POST">
                                                                <input type="number" name="id_usulan" hidden value="<?= $data['id_usulan']; ?>">
                                                                <div class="modal-body">
                                                                    Apakah anda yakin ingin verifikasi data ini?
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Tidak</button>
                                                                    <button type="submit" name="submit" class="btn btn-primary">Ya</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>

                                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#tolakusulan<?= $data['id_usulan']; ?>"><i class="lni lni-close"></i></button>
                                                <div class="modal fade" id="tolakusulan<?= $data['id_usulan']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Peringatan</h1>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <form action="<?= route_to('usulan-decline'); ?>" method="POST">
                                                                <input type="number" name="id_usulan" hidden value="<?= $data['id_usulan']; ?>">
                                                                <div class="modal-body">
                                                                    Apakah anda yakin ingin tolak data ini?
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Tidak</button>
                                                                    <button type="submit" name="submit" class="btn btn-primary">Ya</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>

                                                <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#revisiusulan<?= $data['id_usulan']; ?>">Revisi</button>
                                                <div class="modal fade" id="revisiusulan<?= $data['id_usulan']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Peringatan</h1>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <form action="<?= route_to('usulan-revision'); ?>" method="POST">
                                                                <input type="number" name="id_usulan" hidden value="<?= $data['id_usulan']; ?>">
                                                                <div class="modal-body">
                                                                    Apakah anda yakin ingin revisi data ini?
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Tidak</button>
                                                                    <button type="submit" name="submit" class="btn btn-primary">Ya</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>

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