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
                        <h2>Verifikasi Akun</h2>
                    </div>
                </div>
                <!-- end col -->
                <div class="col-md-6">
                    <div class="breadcrumb-wrapper mb-30">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item active" aria-current="page">
                                    Verifikasi Akun
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
                            <h6 class="text-medium mb-30">Data Pengguna</h6>
                        </div>
                        <div class="right">

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
                        <table class="table table-lg" id="example">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>Username</th>
                                    <th>NIK</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($users as $user) : ?>
                                    <tr class="">
                                        <td class="text-bold-500"><?= $user['name']; ?></td>
                                        <td class="text-bold-500"><?= $user['username']; ?></td>
                                        <td class="text-bold-500"><?= $user['nik']; ?></td>
                                        <td class="text-bold-500"><?= $user['email']; ?></td>
                                        <td class="text-bold-500"><?= $user['status']; ?></td>
                                        <td class="text-bold-500">
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#hapususer<?= $user['id_users']; ?>"><i class="lni lni-checkmark"></i></button>

                                            <!--Hapus User Modal Content -->
                                            <div class="modal fade text-left modal-borderless" id="hapususer<?= $user['id_users']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-scrollable" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Peringatan</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>

                                                        <form action="<?= route_to('verification-update'); ?>" method="POST">

                                                            <div class="modal-body">
                                                                <p>
                                                                    Apakah anda yakin ingin verifikasi user ini?
                                                                </p>
                                                            </div>
                                                            <input type="number" name="id_users" value="<?= $user['id_users']; ?>" hidden>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-light-primary ml-1" data-bs-dismiss="modal">

                                                                    <span class="d-sm-block">Tidak</span>
                                                                </button>
                                                                <button name="submit" type="submit" class="btn btn-primary" data-bs-dismiss="modal">

                                                                    <span class="d-sm-block">Ya</span>
                                                                </button>
                                                            </div>
                                                        </form>

                                                    </div>
                                                </div>
                                            </div>
                                            <!--Hapus User Modal Content End-->
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
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