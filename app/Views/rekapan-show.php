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
                        <h2>Rekapan</h2>
                    </div>
                </div>
                <!-- end col -->
                <div class="col-md-6">
                    <div class="breadcrumb-wrapper mb-30">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item active" aria-current="page">
                                    Rekapan
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
                            <h6 class="text-medium mb-30">Detail Rekapan</h6>
                        </div>
                        <div class="right">
                            <a href="<?= base_url('rekapan'); ?>" class="btn btn-outline-primary d-flex align-items-center">
                                <i class="lni lni-chevron-left me-2 d-flex"></i> Kembali
                            </a>
                        </div>
                    </div>
                    <!-- End Title -->
                    <div class="row">
                        <div class="col-md-12">
                            <h6>Nama Pengguna</h6>
                            <p class="fs-6 mb-4"><?= $data['name']; ?></p>
                            <hr>
                            <h6>Instansi</h6>
                            <p class="fs-6 mb-4"><?= $data['instansi']; ?></p>
                            <h6>Tanggal Pengajuan</h6>
                            <p class="fs-6 mb-4"><?= $data['created_at']; ?></p>
                            <h6>Prihal Pengajuan</h6>
                            <p class="fs-6 mb-4"><?= $data['prihal_usulan']; ?></p>
                            <hr>
                            <h6>Nama Kajian</h6>
                            <div class="alert alert-primary mt-2 mb-4">
                                <p class="fs-6"><?= $data['nama_kajian']; ?></p>
                            </div>
                            <h6>Bidang</h6>
                            <p class="fs-6 mb-4"><?= $data['bidang']; ?></p>
                            <h6>Prihal</h6>
                            <p class="fs-6 mb-4"><?= $data['prihal']; ?></p>
                        </div>
                        <div class="col-md-12 mb-4">
                            <h6>File KTP</h6>
                            <img src="<?= base_url('bukti/' . $data['file_ktp']); ?>" width="300" alt="">
                        </div>
                        <div class="col-md-12 mb-4">
                            <h6>File Permohonan</h6>
                            <object data="<?= base_url('bukti/' . $data['file_permohonan']); ?>" type="application/pdf" width="100%" height="600px">
                                <p>Alternative text - include a link <a href="<?= base_url('file/' . $data['file']); ?>">to the PDF!</a></p>
                            </object>
                        </div>
                        <div class="col-md-12">
                            <h6>File</h6>
                            <object data="<?= base_url('file/' . $data['file']); ?>" type="application/pdf" width="100%" height="600px">
                                <p>Alternative text - include a link <a href="<?= base_url('file/' . $data['file']); ?>">to the PDF!</a></p>
                            </object>
                        </div>
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