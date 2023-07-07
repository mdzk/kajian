<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Elegant Dashboard | Sign Up</title>
    <!-- Favicon -->
    <link rel="shortcut icon" href="<?= base_url(); ?>assets/img/svg/logo.svg" type="image/x-icon">
    <!-- Custom styles -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/style.min.css">
</head>

<body>
    <div class="layer"></div>
    <main class="page-center">
        <article class="sign-up">
            <h1 class="sign-up__title">Daftar Akun</h1>
            <p class="sign-up__subtitle">Silakan lengkapi form berikut.</p>
            <form class="sign-up-form form" action="<?= base_url('register/store'); ?>" method="POST">
                <?php if ($errors = session()->getFlashdata('errors')) : ?>
                    <div style="background-color: #FF7976; color: #fff; padding: 10px; border-radius: 5px;">
                        <?php foreach ($errors as $key => $value) { ?>
                            <li><?= esc($value) ?></li>
                        <?php } ?>
                    </div>
                <?php endif; ?>
                <label class="form-label-wrapper">
                    <p class="form-label">Name</p>
                    <input class="form-input" name="name" type="text" placeholder="Budi" required>
                </label>
                <label class="form-label-wrapper">
                    <p class="form-label">Username</p>
                    <input class="form-input" name="username" type="text" placeholder="budi123" required>
                </label>
                <label class="form-label-wrapper">
                    <p class="form-label">NIK</p>
                    <input class="form-input" name="nik" type="number" placeholder="187202 020202 0001" required>
                </label>
                <label class="form-label-wrapper">
                    <p class="form-label">Email</p>
                    <input class="form-input" name="email" type="email" placeholder="budi@mail.com" required>
                </label>
                <label class="form-label-wrapper">
                    <p class="form-label">Status</p>
                    <input class="form-input" name="status" type="text" placeholder="Pegawai" required>
                </label>
                <label class="form-label-wrapper">
                    <p class="form-label">Password</p>
                    <input class="form-input" name="password" type="password" placeholder="************" required>
                </label>
                <label class="form-label-wrapper">
                    <p class="form-label">Konfirmasi Password</p>
                    <input class="form-input" name="password2" type="password" placeholder="************" required>
                </label>

                <button name="submit" type="submit" class="form-btn primary-default-btn transparent-btn">Daftar</button>
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

</body>

</html>