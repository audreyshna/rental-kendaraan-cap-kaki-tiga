<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, maximum-scale=1.0">
        <title>Deskripsi <?= ucfirst($kendaraan['tipe']) . ' '. $kendaraan['merk'] ?></title>
        <link rel="stylesheet" type="text/css" href="<?= base_url('deskripsi.css') ?>">
        <script src="https://cdn.jsdelivr.net/npm/@phosphor-icons/web@latest"></script>

    </head>

    <body>
        <?= $this->include('users/navbar') ?>

        <section id="pilih-kendaraan">
            <div class="link">
                <a href="<?= base_url('users/home') ?>">Home</a> >> <a href="<?= base_url('users/' . ($kendaraan['tipe'] === 'Mobil' ? 'listMobil' : 'listMotor')) ?>"><?= ucfirst($kendaraan['tipe']) ?></a> >> <a href="<?= current_url() ?>"><?= $kendaraan['merk'] ?></a>
            </div>
            <div class="container">
                
                <div class="image-section">
                    <img src="<?= base_url($kendaraan['image']) ?>" alt="<?= $kendaraan['merk'] ?>">
                  </div>
                  <div class="info-section">
                    <h1 id="car-name-title"><?= $kendaraan['merk'] ?></h1>
                    <p class="price" id="car-price">Rp. <?= number_format($kendaraan['harga_sewa_perhari'], 0, ',', '.') ?> /hari</p>
                    <h2>Deskripsi</h2>
                    <p id="car-description">
                        <?= $kendaraan['deskripsi'] ?>
                    </p>
                  </div>
            </div>
            <div class="btn">
                <?php if ($kendaraan['status'] == 'unavailable'): ?>
                    <button class="btn-sewa disabled" disabled>Mobil Tidak Tersedia</button>
                <?php else: ?>
                <button class="btn-sewa" onclick="window.location.href='<?= base_url('users/formTransaksi/' . $kendaraan['id_kendaraan']) ?>'">Sewa</button>
                <?php endif; ?>
            </div>
        </section>
    </body>
</html>