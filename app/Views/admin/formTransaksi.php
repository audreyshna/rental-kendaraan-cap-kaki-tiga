<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Pembayaran <?= ucfirst($kendaraan['tipe']) . ' '. $kendaraan['merk'] ?></title>
    <link rel="stylesheet" href="<?= base_url('formtransaksi.css')?>">
</head>
<body>
    <?= $this->include('admin/navbar') ?>

    <div class="container">
        <div class="link">
            <a href="<?= base_url('admin/home') ?>">Home</a> >> <a href="<?= base_url('admin/' . ($kendaraan['tipe'] === 'Mobil' ? 'listMobil' : 'listMotor')) ?>"><?= ucfirst($kendaraan['tipe']) ?></a> >> <a href="<?= base_url('admin/deskripsi/' . $kendaraan['id_kendaraan']) ?>"><?= $kendaraan['merk'] ?></a> >> <a href="<?= current_url() ?>"> Payment </a>
        </div>
        <div class="content">
            <div class="car-details">
                <div class="car-card">
                    <img src="<?= base_url($kendaraan['image']) ?>" alt="<?= $kendaraan['merk'] ?>">
                    <h2><?= $kendaraan['merk'] ?></h2>
                    <p>Rp. <?= number_format($kendaraan['harga_sewa_perhari'], 0, ',', '.') ?> /hari</p>
                </div>
            </div>
            <div class="form-section">
            <?php if (session()->getFlashdata('message')): ?>
                <div style="color: green; margin: 10px 0;">
                    <?= session()->getFlashdata('message') ?>
                </div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('error')): ?>
                <div style="color: red; margin: 10px 0;">
                <?php 
                    $errors = session()->getFlashdata('error');
                    if (is_array($errors)): ?>
                        <?php foreach ($errors as $error): ?>
                            <li><?= esc($error) ?></li>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <?= esc($errors) ?>
                <?php endif; ?>                
                </div>
            <?php endif; ?>
                <form action="<?= base_url('admin/formTransaksi/' . $kendaraan['id_kendaraan']) ?>" method="POST">

                    <label for="nik">NIK</label>
                    <input type="text" id="nik" name="nik" placeholder="NIK">

                    <label for="nama">Nama Penyewa</label>
                    <input type="text" id="nama" name="nama" placeholder="Masukkan nama penyewa">

                    <label for="no_telp">No telepon</label>
                    <input type="text" id="no_telp" name="no_telp" placeholder="Masukkan nomor telepon" required>

                    <label for="alamat">Alamat</label>
                    <textarea id="alamat" name="alamat" placeholder="Masukkan alamat" rows="3"></textarea>

                    <label for="tanggal-sewa">Tanggal Penyewaan</label>
                    <input type="date" name="tanggal-sewa" id="tanggal-sewa">

                    <label for="tanggal-kembali">Tanggal Pengembalian</label>
                    <input type="date" name="tanggal-kembali" id="tanggal-kembali">

                    <label for="pembayaran">Metode Pembayaran</label>
                    <select id="pembayaran" name="pembayaran" required>
                        <option value="cash">Cash</option>
                        <option value="transfer">Transfer</option>
                    </select>

                    <div class="total-payment-section">
                    <input type="hidden" name="total-payment" id="hidden-total-payment"><p id="total-payment" name="total-payment">Total Pembayaran: <strong>Rp. 0,00</strong></p>
                        <button type="submit">Sewa</button>
                    </div>
                    
                </form>
            </div>
        </div>
    </div>

    <script>
        function calculateTotal() {
            const tanggalSewa = document.getElementById("tanggal-sewa").value;
            const tanggalKembali = document.getElementById("tanggal-kembali").value;

            if (tanggalSewa && tanggalKembali) {
                console.log("Calculating total...");

                const sewaDate = new Date(tanggalSewa);
                const kembaliDate = new Date(tanggalKembali);

                sewaDate.setHours(0, 0, 0, 0);
                kembaliDate.setHours(0, 0, 0, 0);

                const timeDiff = kembaliDate - sewaDate;
          
                const days = timeDiff / (1000 * 3600 * 24);

                const rentalDays = days < 1 ? 1 : days;

                const hargaPerHari = <?= $kendaraan['harga_sewa_perhari'] ?>;
                const totalPayment = hargaPerHari * rentalDays;

                document.getElementById("total-payment").innerHTML = "Total Pembayaran: <strong>Rp. " + totalPayment.toLocaleString('id-ID') + "</strong> (Total for " + rentalDays + " day" + (rentalDays > 1 ? 's' : '') + ")";

                document.getElementById("hidden-total-payment").value = totalPayment;
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById("tanggal-sewa").addEventListener("change", calculateTotal);
            document.getElementById("tanggal-kembali").addEventListener("change", calculateTotal);
        });
    </script>
</body>
</html>
