<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, maximum-scale=1.0">
        <title>HOME</title>
        <link rel="stylesheet" type="text/css" href="<?= base_url('home.css') ?>">
        <script src="https://cdn.jsdelivr.net/npm/@phosphor-icons/web@latest"></script>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Archivo+Black&family=Lexend:wght@100..900&display=swap" rel="stylesheet">
    </head>

    <body>
        <?= $this->include('admin/navbar') ?>

        <section id="pilih-kendaraan">
            <div class="container">
                <h2>Pilih Kategori</h2>
                <div class="pilihan">
                    <div class="mobil">
                        <a href="<?= site_url('admin/listMobil') ?>">
                            <img class="Mobil" src="<?= base_url('image/icon mobil.png') ?>" alt="Mobil">
                            <h3>Mobil</h3>
                        </a>
                    </div>
                    <div class="motor">
                        <a href="<?= site_url('admin/listMotor') ?>">
                            <img class="Motor" src="<?= base_url('image/icon motor.png') ?>" alt="Motor">
                            <h3>Motor</h3>
                        </a>
                    </div>
                </div>
            </div>
        </section>
    </body>
</html>