<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="<?= base_url(); ?>assets/images/favicon.svg" type="image/x-icon" />
    <title>PlainAdmin Demo | Bootstrap 5 Admin Template</title>

    <!-- ========== All CSS files linkup ========= -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/lineicons.css" />
    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/main.css" />
    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/sweetalert2.min.css" />
    <?= $this->renderSection('styles'); ?>

</head>

<body>
    <!-- ======== sidebar-nav start =========== -->
    <aside class="sidebar-nav-wrapper">
        <div class="navbar-logo">
            <a href="index.html">
                <img src="<?= base_url(); ?>assets/images/logo/logo.svg" alt="logo" />
            </a>
        </div>
        <nav class="sidebar-nav">
            <ul>
                <li class="nav-item nav-item-has-children">
                    <a href="#0" class="<?= get_url(2, 'kajian') ? '' : 'collapsed' ?>" data-bs-toggle="collapse" data-bs-target="#ddmenu_1" aria-controls="ddmenu_1" aria-expanded="<?= get_url(2, 'kajian') ? 'true' : 'false' ?>" aria-label="Toggle navigation">
                        <span class="icon">
                            <i class="lni lni-briefcase"></i>
                        </span>
                        <span class="text">Kajian</span>
                    </a>
                    <ul id="ddmenu_1" class="collapse <?= get_url(2, 'kajian') ? 'show' : '' ?> dropdown-nav">
                        <li>
                            <a href="<?= base_url('kajian/dahulu'); ?>" class="<?= get_url(3, 'dahulu') ? 'active' : '' ?>"> Dahulu </a>
                        </li>
                    </ul>
                    <ul id="ddmenu_1" class="collapse <?= get_url(2, 'kajian') ? 'show' : '' ?> dropdown-nav">
                        <li>
                            <a href="<?= base_url('kajian/antara'); ?>" class="<?= get_url(3, 'antara') ? 'active' : '' ?>"> Antara </a>
                        </li>
                    </ul>
                    <ul id="ddmenu_1" class="collapse <?= get_url(2, 'kajian') ? 'show' : '' ?> dropdown-nav">
                        <li>
                            <a href="<?= base_url('kajian/akhir'); ?>" class="<?= get_url(3, 'akhir') ? 'active' : '' ?>"> Akhir </a>
                        </li>
                    </ul>
                </li>

                <span class="divider">
                    <hr />
                </span>

                <li class="nav-item <?= get_url(2, 'usulan') ? 'active' : '' ?>">
                    <a href="<?= route_to('usulan'); ?>" class="">
                        <span class="icon">
                            <i class="lni lni-folder"></i>
                        </span>
                        <span class="text">Usulan</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="tables.html">
                        <span class="icon">
                            <i class="lni lni-archive"></i>
                        </span>
                        <span class="text">Rekapan</span>
                    </a>
                </li>

            </ul>
        </nav>
        <div class="promo-box">
            <a href="https://plainadmin.com/pro" target="_blank" rel="nofollow" class="main-btn primary-btn btn-hover">
                Purchase Now
            </a>
        </div>
    </aside>
    <div class="overlay"></div>
    <!-- ======== sidebar-nav end =========== -->

    <!-- ======== main-wrapper start =========== -->
    <main class="main-wrapper">
        <!-- ========== header start ========== -->
        <header class="header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-5 col-md-5 col-6">
                        <div class="header-left d-flex align-items-center">
                            <div class="menu-toggle-btn mr-20">
                                <button id="menu-toggle" class="main-btn primary-btn btn-hover">
                                    <i class="lni lni-chevron-left me-2"></i> Menu
                                </button>
                            </div>

                        </div>
                    </div>
                    <div class="col-lg-7 col-md-7 col-6">
                        <div class="header-right">
                            <!-- profile start -->
                            <div class="profile-box ml-15">
                                <button class="dropdown-toggle bg-transparent border-0" type="button" id="profile" data-bs-toggle="dropdown" aria-expanded="false">
                                    <div class="profile-info">
                                        <div class="info">
                                            <h6><?= get_user('name'); ?></h6>
                                            <div class="image">
                                                <img src="<?= base_url(); ?>assets/images/profile/profile-image.png" alt="" />
                                                <span class="status"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <i class="lni lni-chevron-down"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profile">
                                    <li>
                                        <a href="#0"> <i class="lni lni-cog"></i> Settings </a>
                                    </li>
                                    <li>
                                        <a href="<?= base_url('logout'); ?>"> <i class="lni lni-exit"></i> Sign Out </a>
                                    </li>
                                </ul>
                            </div>
                            <!-- profile end -->
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- ========== header end ========== -->

        <!-- ========== section start ========== -->
        <?= $this->renderSection('content'); ?>
        <!-- ========== section end ========== -->

        <!-- ========== footer start =========== -->
        <footer class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6 order-last order-md-first">
                        <div class="copyright text-center text-md-start">
                            <p class="text-sm">
                                &copy; Copyright <?= date('Y'); ?>
                            </p>
                        </div>
                    </div>
                    <!-- end col-->
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </footer>
        <!-- ========== footer end =========== -->
    </main>
    <!-- ======== main-wrapper end =========== -->

    <!-- ========= All Javascript files linkup ======== -->
    <script src="<?= base_url(); ?>assets/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url(); ?>assets/js/main.js"></script>
    <script src="<?= base_url(); ?>assets/js/sweetalert2.min.js"></script>
    <?= $this->renderSection('scripts'); ?>
    <?php if (session()->getFlashdata('pesan')) : ?>
        <script>
            Swal.fire(
                'Berhasil!',
                '<?= session()->getFlashdata('pesan'); ?>',
                'success'
            )
        </script>
    <?php endif; ?>
</body>

</html>