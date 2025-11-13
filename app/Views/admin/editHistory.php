<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit History</title>
    <link rel="stylesheet" href="<?= base_url('formtransaksi.css') ?>">
</head>
<body>
    <?= $this->include('admin/navbar') ?>

    <div class="container">
        <div class="link">
            <a href="<?= base_url('admin/home') ?>">Home</a> >> <a href="<?= base_url('admin/history') ?>">History</a> >> <a href="<?= current_url() ?>">Edit History</a>
        </div>
        <div class="content">
            <div class="car-details">
                <div class="car-card">
                    <img src="<?= base_url($penyewaan['image']) ?>" alt="<?= $penyewaan['merk'] ?>">
                    <h3><?= $penyewaan['merk'] ?></h3>
                    <p>Rp. <?= number_format($penyewaan['harga_sewa_perhari'], 0, ',', '.') ?> /hari</p>
                </div>
            </div>
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

            <div class="form-section">
            <?php if (session()->getFlashdata('message')): ?>
                <div style="color: green; margin: 10px 0;">
                    <?= session()->getFlashdata('message') ?>
                </div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('errors')): ?>
                <div style="color: red; margin: 10px 0;">
                    <?php foreach (session()->getFlashdata('errors') as $error): ?>
                        <?= esc($error) ?>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
            <form action="<?= base_url('admin/editHistory/update/' . $penyewaan['id_penyewaan']) ?>" method="POST">
                <h2>Edit History</h2>

                <label for="nama">Nama Penyewa:</label>
                <input type="text" name="nama" id="nama" value="<?= old('nama', $penyewaan['nama']) ?>" disabled>

                <label for="tanggal_sewa">Tanggal Sewa:</label>
                <input type="date" name="tanggal_sewa" id="tanggal_sewa" value="<?= old('tanggal-sewa', $penyewaan['tanggal_mulai_sewa']) ?>" required>

                <label for="tanggal_kembali">Tanggal Kembali:</label>
                <input type="date" name="tanggal_kembali" id="tanggal_kembali" value="<?= old('tanggal-kembali', $penyewaan['tanggal_selesai_sewa']) ?>" required>

                <label for="status_pembayaran">Status Pembayaran:</label>
                <select name="status_pembayaran" id="status_pembayaran" required>
                    <option value="Sudah Bayar" <?= $penyewaan['status_pembayaran'] == 'Sudah Bayar' ? 'selected' : '' ?>>Sudah Bayar</option>
                    <option value="Menunggu" <?= $penyewaan['status_pembayaran'] == 'Menunggu' ? 'selected' : '' ?>>Belum Bayar</option>
                </select>

                <label for="status_penyewaan">Status Penyewaan:</label>
                <select name="status_penyewaan" id="status_penyewaan" required>
                    <option value="On Progress" <?= $penyewaan['status_penyewaan'] == 'On Progress' ? 'selected' : '' ?>>On Progress</option>
                    <option value="Done" <?= $penyewaan['status_penyewaan'] == 'Done' ? 'selected' : '' ?>>Completed</option>
                </select>

                <div class="total-payment-section">
                    <input type="hidden" name="total-payment" id="hidden-total-payment"><p id="total-payment" name="total-payment">Total Pembayaran: <strong>Rp. 0,00</strong></p>
                        <button type="submit">Update</button>
                </div>
            </form>
            </div>
        </div>
    </div>

    <script>
        const hargaPerHari = <?= $penyewaan['harga_sewa_perhari'] ?>;

        function calculateTotal() {
            const tanggalSewa = document.getElementById("tanggal_sewa").value;
            const tanggalKembali = document.getElementById("tanggal_kembali").value;

            if (tanggalSewa && tanggalKembali) {
                console.log("Calculating total...");

                const sewaDate = new Date(tanggalSewa);
                const kembaliDate = new Date(tanggalKembali);

                sewaDate.setHours(0, 0, 0, 0);
                kembaliDate.setHours(0, 0, 0, 0);

                const timeDiff = kembaliDate - sewaDate;

                const days = timeDiff / (1000 * 3600 * 24);

                const rentalDays = days < 1 ? 1 : days;

                const totalPayment = hargaPerHari * rentalDays;

                document.getElementById("total-payment").innerHTML = "Total Pembayaran: <strong>Rp. " + totalPayment.toLocaleString('id-ID') + "</strong> (Total for " + rentalDays + " day" + (rentalDays > 1 ? 's' : '') + ")";

                document.getElementById("hidden-total-payment").value = totalPayment;
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById("tanggal_sewa").addEventListener("change", calculateTotal);
            document.getElementById("tanggal_kembali").addEventListener("change", calculateTotal);

            calculateTotal();
        });
    </script>
</body>
</html>
