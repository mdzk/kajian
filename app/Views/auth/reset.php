<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="<?= base_url(); ?>assets/images/logo.png" type="image/x-icon" />
    <title>Reset Password | Kajian</title>
    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/main.css" />
    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/sweetalert2.min.css">
</head>

<body>
    <main>
        <!-- ========== signin-section start ========== -->
        <section class="signin-section">
            <div class="">
                <div class="row g-0 auth-row">
                    <div class="col-lg-6 col-md-6 .d-sm-none .d-xs-none .d-md-block">
                        <div class="auth-cover-wrapper bg-primary-100">
                            <div class="auth-cover">
                                <div class="title text-center">
                                    <h1 class="text-primary mb-10">Reset Password</h1>
                                    <p class="text-medium">
                                        Buat password baru anda.
                                    </p>
                                </div>
                                <div class="cover-image">
                                    <img src="<?= base_url(); ?>assets/images/auth/reset-password.svg" alt="" />
                                </div>
                                <div class="shape-image">
                                    <img src="<?= base_url(); ?>assets/images/auth/shape.svg" alt="" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end col -->
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="signin-wrapper">
                            <div class="form-wrapper">
                                <h6 class="mb-15">Reset Password</h6>
                                <p class="text-sm mb-25">
                                    Lengkapi form berikut, untuk membuat password baru
                                </p>
                                <form action="<?= base_url('update-password'); ?>" method="POST">
                                    <div class="row">
                                        <?php if ($errors = session()->getFlashdata('errors')) : ?>
                                            <div class="col-12 mb-3">
                                                <div style="background-color: #FF7976; color: #fff; padding: 10px; border-radius: 5px;">
                                                    <?php foreach ($errors as $key => $value) { ?>
                                                        <li><?= esc($value) ?></li>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                        <input type="hidden" name="token" value="<?= $token ?>">
                                        <div class="col-12">
                                            <div class="input-style-1">
                                                <label>Password</label>
                                                <input name="password" type="password" placeholder="*********" required />
                                            </div>
                                        </div>
                                        <!-- end col -->
                                        <div class="col-12">
                                            <div class="input-style-1">
                                                <label>Konfirmasi Password</label>
                                                <input name="password2" type="password" placeholder="*********" required />
                                            </div>
                                        </div>
                                        <!-- end col -->

                                        <div class="col-12">
                                            <div class="button-group d-flex justify-content-center flex-wrap">
                                                <button type="submit" name="submit" class="main-btn primary-btn btn-hover w-100 text-center">
                                                    Reset Password
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end row -->
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- end col -->
                </div>
                <!-- end row -->
            </div>
        </section>
    </main>
    <!-- ======== main-wrapper end =========== -->
    <?php if (session()->getFlashdata('pesan')) : ?>
        <script src="<?= base_url(); ?>assets/js/sweetalert2.min.js"></script>

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