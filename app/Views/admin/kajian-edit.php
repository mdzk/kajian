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
                        <h2>Kajianan</h2>
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
                                    Kajianan
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
                            <h6 class="text-medium mb-30">Edit Kajian</h6>
                        </div>
                        <div class="right">
                            <a href="<?= base_url('kajian'); ?>" class="btn btn-outline-primary d-flex align-items-center">
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
                    <form action="<?= route_to('kajian-update'); ?>" method="POST" enctype="multipart/form-data">
                        <input type="number" value="<?= $kajian['id_kajian']; ?>" name="id_kajian" hidden>
                        <div class="mb-3">
                            <label for="kajian" class="form-label">Kajian</label>
                            <input type="text" value="<?= $kajian['nama_kajian']; ?>" class="form-control" id="kajian" name="kajian" placeholder="KKN">
                        </div>
                        <div class="mb-3">
                            <label for="bidang" class="form-label">Bidang</label>
                            <input type="text" value="<?= $kajian['bidang']; ?>" class="form-control" id="bidang" name="bidang" placeholder="RIDA">
                        </div>
                        <div class="mb-3">
                            <label for="prihal" class="form-label">Prihal</label>
                            <input type="text" value="<?= $kajian['prihal']; ?>" class="form-control" id="prihal" name="prihal" placeholder="KKN1">
                        </div>
                        <div class="mb-3">
                            <label for="tanggal" class="form-label">Tanggal</label>
                            <input type="date" class="form-control" id="tanggal" name="tanggal" value="<?= $kajian['tanggal']; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="file" class="form-label">File</label>
                            <input type="file" class="form-control" id="file" name="file" accept="application/pdf">
                            <span class="text-muted">* Kosongkan file, jika tidak ingin mengubah</span>
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