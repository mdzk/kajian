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
                            <h6 class="text-medium mb-3">Data Usulan Terverifikasi</h6>
                        </div>
                        <div class="right">
                            <?php if (get_user('role') == 'admin') : ?>

                                <div class="dropdown">
                                    <button class="mb-3 btn btn-primary d-flex align-items-center" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="lni lni-printer d-flex me-2"></i> <span>Cetak</span>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <?= form_open('pdf/rekapan/semua'); ?>
                                            <button class="dropdown-item" href="#">Semua</button>
                                            <?= form_close(); ?>
                                        </li>
                                        <li><button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#cetak">Filter</button></li>
                                    </ul>
                                </div>

                                <div class="modal fade" id="cetak" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Cetak Rekapan</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <form action="<?= route_to('pdf-rekapan-filter'); ?>" method="POST">
                                                <div class="modal-body">
                                                    <div class="form-group mb-3">
                                                        <label for="name">Pilih Bulan</label>
                                                        <select name="bulan" class="form-control">
                                                            <option value="1">Januari</option>
                                                            <option value="2">Februari</option>
                                                            <option value="3">Maret</option>
                                                            <option value="4">April</option>
                                                            <option value="5">Mei</option>
                                                            <option value="6">Juni</option>
                                                            <option value="7">Juli</option>
                                                            <option value="8">Agustus</option>
                                                            <option value="9">September</option>
                                                            <option value="10">Oktober</option>
                                                            <option value="11">November</option>
                                                            <option value="12">Desember</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group mb-3">
                                                        <label for="name">Pilih Tahun</label>
                                                        <select name="tahun" class="form-control">
                                                            <?php for ($x = $usulan_lama; $x <= $usulan_terbaru; $x++) : ?>
                                                                <option name="bulan" value="<?= $x; ?>"><?= $x; ?></option>
                                                            <?php endfor; ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-light-primary ml-1" data-bs-dismiss="modal">
                                                        <span class="d-sm-block">Tutup</span>
                                                    </button>
                                                    <button name="submit" type="submit" class="btn btn-primary" data-bs-dismiss="modal">
                                                        <span class="d-sm-block">Cetak</span>
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <!-- End Title -->
                    <div class="table-responsive">
                        <table class="table top-selling-table" id="example">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tgl Pengajuan</th>
                                    <th>Pengguna</th>
                                    <th>Kajian</th>
                                    <th>Prihal</th>
                                    <th>Instansi</th>
                                    <th>File KTP</th>
                                    <th>File Permohonan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1;
                                foreach ($usulan as $data) : ?>
                                    <tr>
                                        <td><?= $i++; ?></td>
                                        <td><?= $data['created_at']; ?></td>
                                        <td><?= $data['name']; ?></td>
                                        <td><?= $data['nama_kajian']; ?></td>
                                        <td><?= $data['prihal_usulan']; ?></td>
                                        <td><?= $data['instansi']; ?></td>
                                        <td><a href="<?= base_url('bukti/' . $data['file_ktp']); ?>" class="btn btn-light"><i class="lni lni-remove-file"></i></a></td>
                                        <td><a href="<?= base_url('bukti/' . $data['file_permohonan']); ?>" class="btn btn-light"><i class="lni lni-remove-file"></i></a></td>
                                        <td>
                                            <a href="<?= base_url('rekapan/show/' . $data['id_usulan']); ?>" class="btn btn-primary"><i class="lni lni-eye"></i></a>
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