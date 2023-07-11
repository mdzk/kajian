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
                            <h6 class="text-medium mb-30">Edit Usulan</h6>
                        </div>
                        <div class="right">
                            <a href="<?= base_url('usulan'); ?>" class="btn btn-outline-primary d-flex align-items-center">
                                <i class="lni lni-chevron-left me-2 d-flex"></i> Kembali
                            </a>
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
                    <form action="<?= route_to('usulan-update'); ?>" method="POST">
                        <input type="number" value="<?= $usulan['id_usulan']; ?>" name="id_usulan" hidden>
                        <div class="mb-3">
                            <label for="kajian" class="form-label">Kajian</label>
                            <input type="text" disabled value="<?= $usulan['nama_kajian']; ?>" class="form-control" id="kajian" name="kajian" placeholder="KKN">
                        </div>
                        <div class="mb-3">
                            <label for="prihal" class="form-label">Prihal</label>
                            <input type="text" value="<?= $usulan['prihal_usulan']; ?>" class="form-control" id="prihal" name="prihal" placeholder="Penelitian">
                        </div>
                        <div class="mb-3">
                            <label for="instansi" class="form-label">Instansi</label>
                            <input type="text" value="<?= $usulan['instansi']; ?>" class="form-control" id="instansi" name="instansi" placeholder="Universitas Indonesia">
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
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