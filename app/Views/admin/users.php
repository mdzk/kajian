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
                        <h2>Kelola Akun</h2>
                    </div>
                </div>
                <!-- end col -->
                <div class="col-md-6">
                    <div class="breadcrumb-wrapper mb-30">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item active" aria-current="page">
                                    Kelola Akun
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
                                    <th>Role</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($users as $user) : ?>
                                    <tr class="">
                                        <td class="text-bold-500"><?= $user['name']; ?></td>
                                        <td class="text-bold-500"><?= $user['role']; ?></td>
                                        <td class="text-bold-500">
                                            <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#edituser<?= $user['id_users']; ?>"><i class="lni lni-pencil"></i></button>
                                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#hapususer<?= $user['id_users']; ?>"><i class="lni lni-trash-can"></i></button>

                                            <!--Hapus User Modal Content -->
                                            <div class="modal fade text-left modal-borderless" id="hapususer<?= $user['id_users']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-scrollable" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Peringatan</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>

                                                        <form action="<?= route_to('users-delete'); ?>" method="POST">

                                                            <div class="modal-body">
                                                                <p>
                                                                    Apakah anda yakin ingin menghapus user ini?
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

                                    <div class="modal fade text-left modal-borderless" id="edituser<?= $user['id_users']; ?>">
                                        <div class="modal-dialog modal-dialog-scrollable" role="document">

                                            <form action="<?= route_to('users-update'); ?>" method="POST">

                                                <input type="hidden" name="id_users" value="<?= $user['id_users']; ?>">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Edit user</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="form-group has-icon-left">
                                                            <label for="name">Nama</label>
                                                            <div class="position-relative">
                                                                <input disabled value="<?= $user['name']; ?>" type="text" name="name" class="form-control" placeholder="Masukkan nama" id="name">
                                                                <div class="form-control-icon">
                                                                    <i class="bi bi-person"></i>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="form-group has-icon-left">
                                                            <label for="username">Username</label>
                                                            <div class="position-relative">
                                                                <input disabled value="<?= $user['username']; ?>" type="text" name="username" class="form-control" placeholder="Masukkan Username" id="username">
                                                                <div class="form-control-icon">
                                                                    <i class="bi bi-person-badge"></i>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="roles">Roles</label>
                                                            <select class="form-select" name="role" id="roles">
                                                                <option value="admin" <?php if ($user['role'] == 'admin') {
                                                                                            echo 'selected';
                                                                                        } ?>>Admin</option>
                                                                <option value="user" <?php if ($user['role'] == 'user') {
                                                                                            echo 'selected';
                                                                                        } ?>>User</option>
                                                                <option value="pimpinan" <?php if ($user['role'] == 'pimpinan') {
                                                                                                echo 'selected';
                                                                                            } ?>>Pimpinan</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-light-primary" data-bs-dismiss="modal">

                                                            <span class="d-sm-block">Batal</span>
                                                        </button>
                                                        <button name="submit" type="submit" class="btn btn-primary ml-1" data-bs-dismiss="modal">

                                                            <span class="d-sm-block">Simpan</span>
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
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