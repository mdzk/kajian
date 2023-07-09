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
              <a href="" class="btn btn-primary">+ Kajian</a>
              <!-- end select -->
            </div>
          </div>
          <!-- End Title -->
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
                      <a href="" class="btn btn-light"><i class="lni lni-remove-file"></i></a>
                    </td>
                    <td>
                      <a href="" class="btn btn-warning"><i class="lni lni-pencil"></i></a>
                      <a href="" class="btn btn-danger"><i class="lni lni-trash-can"></i></a>
                      <a href="" class="btn btn-primary"><i class="lni lni-eye"></i></a>
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