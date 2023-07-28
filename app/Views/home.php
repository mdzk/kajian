<?= $this->extend('layouts/admin'); ?>

<?= $this->section('styles'); ?>
<?= $this->endSection(); ?>

<?= $this->section('scripts'); ?>
<script src="<?= base_url(''); ?>assets/js/jquery.js"></script>
<script src="<?= base_url(''); ?>assets/js/Chart.min.js"></script>
<script>
    var pendahuluan = $.ajax({
        url: "<?= base_url() . 'json/kajian'; ?>",
        async: false,
        dataType: 'json'
    }).responseJSON;

    var antara = $.ajax({
        url: "<?= base_url() . 'json/kajian'; ?>",
        async: false,
        dataType: 'json'
    }).responseJSON;

    var akhir = $.ajax({
        url: "<?= base_url() . 'json/kajian'; ?>",
        async: false,
        dataType: 'json'
    }).responseJSON;

    const ctx1 = document.getElementById("Chart1").getContext("2d");
    const chart1 = new Chart(ctx1, {
        type: "line", // also try bar or other graph types
        data: {
            labels: [
                "Jan",
                "Feb",
                "Mar",
                "Apr",
                "Mei",
                "Jun",
                "Jul",
                "Agu",
                "Sep",
                "Okt",
                "Nov",
                "Des",
            ],
            // Information about the dataset
            datasets: [{
                    label: "Kajian Pendahuluan",
                    backgroundColor: "transparent",
                    borderColor: "#4a6cf7",
                    data: pendahuluan,
                    pointBackgroundColor: "transparent",
                    pointHoverBackgroundColor: "#4a6cf7",
                    pointBorderColor: "transparent",
                    pointHoverBorderColor: "#fff",
                    pointHoverBorderWidth: 3,
                    pointBorderWidth: 5,
                    pointRadius: 5,
                    pointHoverRadius: 8,
                },
                {
                    label: "Kajian Antara",
                    backgroundColor: "transparent",
                    borderColor: "#9b51e0",
                    data: antara,
                    pointBackgroundColor: "transparent",
                    pointHoverBackgroundColor: "#9b51e0",
                    pointBorderColor: "transparent",
                    pointHoverBorderColor: "#fff",
                    pointHoverBorderWidth: 3,
                    pointBorderWidth: 5,
                    pointRadius: 5,
                    pointHoverRadius: 8,
                },
                {
                    label: "Kajian Akhir",
                    backgroundColor: "transparent",
                    borderColor: "#f2994a",
                    data: akhir,
                    pointBackgroundColor: "transparent",
                    pointHoverBackgroundColor: "#f2994a",
                    pointBorderColor: "transparent",
                    pointHoverBorderColor: "#fff",
                    pointHoverBorderWidth: 3,
                    pointBorderWidth: 5,
                    pointRadius: 5,
                    pointHoverRadius: 8,
                },
            ],
        },

        // Configuration options
        defaultFontFamily: "Inter",
        options: {
            tooltips: {
                callbacks: {
                    labelColor: function(tooltipItem, chart) {
                        return {
                            backgroundColor: "#ffffff",
                        };
                    },
                },
                intersect: false,
                backgroundColor: "#f9f9f9",
                titleFontFamily: "Inter",
                titleFontColor: "#8F92A1",
                titleFontColor: "#8F92A1",
                titleFontSize: 12,
                bodyFontFamily: "Inter",
                bodyFontColor: "#171717",
                bodyFontStyle: "bold",
                bodyFontSize: 16,
                multiKeyBackground: "transparent",
                displayColors: false,
                xPadding: 30,
                yPadding: 10,
                bodyAlign: "center",
                titleAlign: "center",
            },

            title: {
                display: false,
            },
            legend: {
                display: true,
            },

            scales: {
                yAxes: [{
                    gridLines: {
                        display: false,
                        drawTicks: false,
                        drawBorder: false,
                    },
                    ticks: {
                        padding: 35,
                    },
                }, ],
                xAxes: [{
                    gridLines: {
                        drawBorder: false,
                        color: "rgba(143, 146, 161, .1)",
                        zeroLineColor: "rgba(143, 146, 161, .1)",
                    },
                    ticks: {
                        padding: 20,
                    },
                }, ],
            },
        },
    });
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
                        <?php if (get_user('role') == 'admin' || get_user('role') == 'pimpinan') : ?>
                            <h2>Dashboard</h2>
                        <?php endif; ?>
                        <?php if (get_user('role') == 'user') : ?>
                            <h2>Selamat Datang, <?= get_user('name'); ?></h2>
                        <?php endif; ?>
                    </div>
                </div>
                <!-- end col -->
                <div class="col-md-6">
                    <div class="breadcrumb-wrapper mb-30">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item active" aria-current="page">
                                    Dashboard
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

        <?php if (get_user('role') == 'admin') : ?>
            <div class="row">
                <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
                    <div class="icon-card mb-30">
                        <div class="icon primary">
                            <i class="lni lni-empty-file"></i>
                        </div>
                        <div class="content">
                            <h6 class="mb-10">Kajian</h6>
                            <h3 class="text-bold mb-10"><?= $kajian; ?></h3>
                        </div>
                    </div>
                    <!-- End Icon Cart -->
                </div>
                <!-- End Col -->
                <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
                    <div class="icon-card mb-30">
                        <div class="icon purple">
                            <i class="lni lni-folder"></i>
                        </div>
                        <div class="content">
                            <h6 class="mb-10">Usulan</h6>
                            <h3 class="text-bold mb-10"><?= $usulan; ?></h3>
                        </div>
                    </div>
                    <!-- End Icon Cart -->
                </div>
                <!-- End Col -->
                <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
                    <div class="icon-card mb-30">
                        <div class="icon orange">
                            <i class="lni lni-archive"></i>
                        </div>
                        <div class="content">
                            <h6 class="mb-10">Rekapan</h6>
                            <h3 class="text-bold mb-10"><?= $rekapan; ?></h3>
                        </div>
                    </div>
                    <!-- End Icon Cart -->
                </div>
                <!-- End Col -->
                <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
                    <div class="icon-card mb-30">
                        <div class="icon success">
                            <i class="lni lni-users"></i>
                        </div>
                        <div class="content">
                            <h6 class="mb-10">Total User</h6>
                            <h3 class="text-bold mb-10"><?= $user; ?></h3>
                        </div>
                    </div>
                    <!-- End Icon Cart -->
                </div>
                <!-- End Col -->
            </div>
            <!-- End Row -->
            <div class="row">
                <div class="col-md-12">
                    <div class="card-style mb-30">
                        <div class="title d-flex flex-wrap justify-content-between">
                            <div class="left">
                                <h6 class="text-medium mb-10">Jumlah Data Terverifikasi <?= date('Y'); ?></h6>
                            </div>
                            <div class="right">
                            </div>
                        </div>
                        <!-- End Title -->
                        <div class="chart">
                            <canvas id="Chart1" style="width: 100%; height: 400px"></canvas>
                        </div>
                        <!-- End Chart -->
                    </div>
                </div>
            </div>
            <!-- End Row -->
        <?php endif; ?>

        <?php if (get_user('role') == 'pimpinan') : ?>
            <div class="row">
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                    <div class="icon-card mb-30">
                        <div class="icon primary">
                            <i class="lni lni-empty-file"></i>
                        </div>
                        <div class="content">
                            <h6 class="mb-10">Kajian</h6>
                            <h3 class="text-bold mb-10"><?= $kajian; ?></h3>
                        </div>
                    </div>
                    <!-- End Icon Cart -->
                </div>
                <!-- End Col -->
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                    <div class="icon-card mb-30">
                        <div class="icon purple">
                            <i class="lni lni-folder"></i>
                        </div>
                        <div class="content">
                            <h6 class="mb-10">Usulan</h6>
                            <h3 class="text-bold mb-10"><?= $usulan; ?></h3>
                        </div>
                    </div>
                    <!-- End Icon Cart -->
                </div>
                <!-- End Col -->
            </div>
            <!-- End Row -->
            <div class="row">
                <div class="col-md-12">
                    <div class="card-style mb-30">
                        <div class="title d-flex flex-wrap justify-content-between">
                            <div class="left">
                                <h6 class="text-medium mb-10">Jumlah Data Terverifikasi <?= date('Y'); ?></h6>
                            </div>
                            <div class="right">
                            </div>
                        </div>
                        <!-- End Title -->
                        <div class="chart">
                            <canvas id="Chart1" style="width: 100%; height: 400px"></canvas>
                        </div>
                        <!-- End Chart -->
                    </div>
                </div>
            </div>
            <!-- End Row -->
        <?php endif; ?>

        <?php if (get_user('role') == 'user') : ?>
            <div class="row">
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                    <div class="icon-card mb-30">
                        <div class="icon primary">
                            <i class="lni lni-empty-file"></i>
                        </div>
                        <div class="content">
                            <h6 class="mb-10">Kajian</h6>
                            <h3 class="text-bold mb-10"><?= $kajian; ?></h3>
                        </div>
                    </div>
                    <!-- End Icon Cart -->
                </div>
                <!-- End Col -->
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                    <div class="icon-card mb-30">
                        <div class="icon purple">
                            <i class="lni lni-folder"></i>
                        </div>
                        <div class="content">
                            <h6 class="mb-10">Usulan</h6>
                            <h3 class="text-bold mb-10"><?= $usulan; ?></h3>
                        </div>
                    </div>
                    <!-- End Icon Cart -->
                </div>
                <!-- End Col -->
            </div>
            <!-- End Row -->
        <?php endif; ?>
    </div>
    <!-- end container -->
</section>
<?= $this->endSection(); ?>