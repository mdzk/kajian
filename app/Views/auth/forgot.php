<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Elegant Dashboard | Sign In</title>
    <!-- Favicon -->
    <link rel="shortcut icon" href="<?= base_url(); ?>assets/img/svg/logo.svg" type="image/x-icon">
    <!-- Custom styles -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/style.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/plugins/sweetalert2/dist/sweetalert2.min.css">
</head>

<body>
    <div class="layer"></div>
    <main class="page-center">
        <article class="sign-up">
            <h1 class="sign-up__title">Lupa Password!</h1>
            <p class="sign-up__subtitle">Silakan masukkan email akun anda.</p>
            <form class="sign-up-form form" action="<?= base_url('forgot/password'); ?>" method="POST">
                <?php if ($errors = session()->getFlashdata('errors')) : ?>
                    <div style="background-color: #FF7976; color: #fff; padding: 10px; border-radius: 5px;">
                        <?= session()->getFlashdata('errors'); ?>
                    </div>
                <?php endif; ?>
                <label class="form-label-wrapper">
                    <p class="form-label">Email</p>
                    <input class="form-input" name="email" type="email" placeholder="budi@mail.com" required>
                </label>
                <button type="submit" name="submit" class="form-btn primary-default-btn transparent-btn">Sign in</button>
                <span class="mt-3">Sudah memiliki akun? <a class="link-info forget-link" href="<?= route_to('login'); ?>">Login.</a></span>
            </form>
        </article>
    </main>
    <!-- Chart library -->
    <script src="<?= base_url(); ?>assets/plugins/chart.min.js"></script>
    <!-- Icons library -->
    <script src="<?= base_url(); ?>assets/plugins/feather.min.js"></script>
    <!-- Custom scripts -->
    <script src="<?= base_url(); ?>assets/js/script.js"></script>
    <?php if (session()->getFlashdata('pesan')) : ?>
        <script src="<?= base_url(); ?>assets/plugins/sweetalert2/dist/sweetalert2.min.js"></script>

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