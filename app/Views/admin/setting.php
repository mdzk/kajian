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
                        <h2>Profile</h2>
                    </div>
                </div>
                <!-- end col -->
                <div class="col-md-6">
                    <div class="breadcrumb-wrapper mb-30">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item active" aria-current="page">
                                    Profile
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
                            <h6 class="text-medium mb-30">Edit Profile</h6>
                        </div>
                    </div>
                    <?php if ($errors = session()->getFlashdata('errors')) : ?>
                        <div class="alert alert-danger" role="alert">
                            <?php foreach ($errors as $key => $value) { ?>
                                <li><?= esc($value) ?></li>
                            <?php } ?>
                        </div>
                    <?php endif; ?>

                    <!-- End Title -->
                    <form action="<?= route_to('setting-update'); ?>" method="POST" enctype="multipart/form-data">
                        <input type="number" name="id_users" hidden value="<?= $user['id_users']; ?>">
                        <div class="col-12">
                            <div class="card mx-2 my-2">
                                <div class="card-body py-4 px-4">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="d-flex align-items-center">
                                                <div class="avatar me-1">
                                                    <div class="stats-icon green">
                                                        <i class="iconly-boldProfile"></i>
                                                    </div>
                                                </div>

                                                <div class="ms-3 name">
                                                    <span class="text-muted">Nama</span>
                                                    <h5 class="font-bold"><?= $user['name']; ?>
                                                        <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#editnama"> Edit
                                                        </button>
                                                    </h5>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="card mx-2 my-2">
                                <div class="card-body py-4 px-4">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="d-flex align-items-center">
                                                <div class="avatar me-1">
                                                    <div class="stats-icon red">
                                                        <i class="iconly-boldShield-Done"></i>
                                                    </div>
                                                </div>

                                                <div class="ms-3 name">
                                                    <span class="text-muted">Username</span>
                                                    <h5 class="font-bold"><?= $user['username']; ?>
                                                        <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#editusername"> Edit
                                                        </button>
                                                    </h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="card mx-2 my-2">
                                <div class="card-body py-4 px-4">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="d-flex align-items-center">
                                                <div class="avatar me-1">
                                                    <div class="stats-icon red">
                                                        <i class="iconly-boldShield-Done"></i>
                                                    </div>
                                                </div>

                                                <div class="ms-3 name">
                                                    <span class="text-muted">NIK</span>
                                                    <h5 class="font-bold"><?= $user['nik']; ?>
                                                        <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#editnik"> Edit
                                                        </button>
                                                    </h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="card mx-2 my-2">
                                <div class="card-body py-4 px-4">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="d-flex align-items-center">
                                                <div class="avatar me-1">
                                                    <div class="stats-icon red">
                                                        <i class="iconly-boldShield-Done"></i>
                                                    </div>
                                                </div>

                                                <div class="ms-3 name">
                                                    <span class="text-muted">Email</span>
                                                    <h5 class="font-bold"><?= $user['email']; ?>
                                                        <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#editemail"> Edit
                                                        </button>
                                                    </h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="card mx-2 my-2">
                                <div class="card-body py-4 px-4">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="d-flex align-items-center">
                                                <div class="avatar me-1">
                                                    <div class="stats-icon red">
                                                        <i class="iconly-boldShield-Done"></i>
                                                    </div>
                                                </div>

                                                <div class="ms-3 name">
                                                    <span class="text-muted">Status</span>
                                                    <h5 class="font-bold"><?= $user['status']; ?>
                                                        <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#editstatus"> Edit
                                                        </button>
                                                    </h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="card mx-2 my-2">
                                <div class="card-body py-4 px-4">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="d-flex align-items-center">
                                                <div class="avatar me-1">
                                                    <div class="stats-icon blue">
                                                        <i class="iconly-boldImage-2"></i>
                                                    </div>
                                                </div>

                                                <div class="ms-3 name">
                                                    <h5 class="font-bold">Profile Picture
                                                        <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#editfoto"> Edit
                                                        </button>
                                                    </h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="card mx-2 my-2">
                                <div class="card-body py-4 px-4">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="d-flex align-items-center">

                                                <div class="avatar me-1">
                                                    <div class="stats-icon purple">
                                                        <i class="iconly-boldLock"></i>
                                                    </div>
                                                </div>

                                                <div class="ms-3 name">
                                                    <h5 class="font-bold">Password
                                                        <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#editpassword"> Edit
                                                        </button>
                                                    </h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!--Edit Nama Modal Content -->
                        <div class="modal fade text-left modal-borderless" id="editnama">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Edit nama</h5>
                                    </div>
                                    <input type="hidden" wire:model="categoryId">
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="basicInput">Masukkan Nama</label>
                                            <input type="text" value="<?= $user['name']; ?>" name="name" class="form-control" id="basicInput" placeholder="ketik disini">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-light-primary" data-bs-dismiss="modal">
                                            <span class="d-sm-block">Batal</span>
                                        </button>
                                        <button type="submit" name="submit" class="btn btn-primary ml-1" data-bs-dismiss="modal">
                                            <span class="d-sm-block">Simpan</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--Edit Nama Modal Content End-->

                        <!--Edit Username Modal Content -->
                        <div class="modal fade text-left modal-borderless" id="editusername">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Edit username</h5>
                                    </div>
                                    <input type="hidden" wire:model="categoryId">
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="basicInput">Masukkan Username</label>
                                            <input type="text" value="<?= $user['username']; ?>" name="username" class="form-control" id="basicInput" placeholder="ketik disini">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-light-primary" data-bs-dismiss="modal">
                                            <span class="d-sm-block">Batal</span>
                                        </button>
                                        <button type="submit" name="submit" class="btn btn-primary ml-1" data-bs-dismiss="modal">
                                            <span class="d-sm-block">Simpan</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--Edit Username Modal Content End-->

                        <!--Edit NIK Modal Content -->
                        <div class="modal fade text-left modal-borderless" id="editnik">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Edit NIK</h5>
                                    </div>
                                    <input type="hidden" wire:model="categoryId">
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="basicInput">Masukkan NIK</label>
                                            <input type="number" value="<?= $user['nik']; ?>" name="nik" class="form-control" id="basicInput" placeholder="ketik disini">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-light-primary" data-bs-dismiss="modal">
                                            <span class="d-sm-block">Batal</span>
                                        </button>
                                        <button type="submit" name="submit" class="btn btn-primary ml-1" data-bs-dismiss="modal">
                                            <span class="d-sm-block">Simpan</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--Edit NIK Modal Content End-->

                        <!--Edit Email Modal Content -->
                        <div class="modal fade text-left modal-borderless" id="editemail">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Edit Email</h5>
                                    </div>
                                    <input type="hidden" wire:model="categoryId">
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="basicInput">Masukkan Email</label>
                                            <input type="email" value="<?= $user['email']; ?>" name="email" class="form-control" id="basicInput" placeholder="ketik disini">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-light-primary" data-bs-dismiss="modal">
                                            <span class="d-sm-block">Batal</span>
                                        </button>
                                        <button type="submit" name="submit" class="btn btn-primary ml-1" data-bs-dismiss="modal">
                                            <span class="d-sm-block">Simpan</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--Edit Email Modal Content End-->

                        <!--Edit Status Modal Content -->
                        <div class="modal fade text-left modal-borderless" id="editstatus">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Edit Status</h5>
                                    </div>
                                    <input type="hidden" wire:model="categoryId">
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="basicInput">Masukkan Status</label>
                                            <input type="text" value="<?= $user['status']; ?>" name="status" class="form-control" id="basicInput" placeholder="ketik disini">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-light-primary" data-bs-dismiss="modal">
                                            <span class="d-sm-block">Batal</span>
                                        </button>
                                        <button type="submit" name="submit" class="btn btn-primary ml-1" data-bs-dismiss="modal">
                                            <span class="d-sm-block">Simpan</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--Edit Status Modal Content End-->

                        <!--Edit foto Modal Content -->
                        <div class="modal fade text-left modal-borderless" id="editfoto">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Profile Picture</h5>
                                    </div>
                                    <input type="hidden" wire:model="categoryId">
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="basicInput">Upload Foto</label>
                                            <input type="file" name="file" class="form-control" id="basicInput" accept="image/png, image/jpeg">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-light-primary" data-bs-dismiss="modal">
                                            <span class="d-sm-block">Batal</span>
                                        </button>
                                        <button type="submit" name="submit" class="btn btn-primary ml-1" data-bs-dismiss="modal">
                                            <span class="d-sm-block">Simpan</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--Edit Username Modal Content End-->

                        <!--Edit Password Modal Content -->
                        <div class="modal fade text-left modal-borderless" id="editpassword">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Edit Password</h5>
                                    </div>
                                    <input type="hidden" wire:model="userId">
                                    <div class="modal-body">

                                        <div class="form-group has-icon-left">
                                            <label for="password">Password</label>
                                            <div class="position-relative">
                                                <input type="password" name="password" class="form-control" placeholder="Masukkan password" id="password">
                                                <div class="form-control-icon">
                                                    <i class="bi bi-lock"></i>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-light-primary" data-bs-dismiss="modal">
                                            <span class="d-sm-block">Batal</span>
                                        </button>
                                        <button type="submit" name="submit" class="btn btn-primary ml-1" data-bs-dismiss="modal">
                                            <span class="d-sm-block">Simpan</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--Edit Password Modal Content End-->
                    </form>

                </div>
            </div>
            <!-- End Col -->
        </div>
        <!-- End Row -->
    </div>
    <!-- end container -->
</section>
<?= $this->endSection(); ?>