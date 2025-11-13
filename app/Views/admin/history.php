<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaction History</title>
    <link rel="stylesheet" href="<?= base_url('history.css')?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Jost:ital,wght@0,100..900;1,100..900&family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">
</head>
<body>
<?= $this->include('admin/navbar') ?>

<div class="container">
    <div class="link">
            <a href="<?= base_url('admin/home') ?>">Home</a> >> <a href="<?= base_url('admin/history') ?>"> History </a>
    </div>
    <div class="breadcrumb">
    <div class="history-section">
        <h2>Transaction History</h2>
        <table class="history-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Penyewa</th>
                    <th>Merk</th>
                    <th>Total Biaya</th>
                    <th>Status Pembayaran</th>
                    <th>Status Penyewaan</th>
                    <th>Actions</th> 
                </tr>
            </thead>
            <tbody>
            <?php $no = 1; ?>
                <?php foreach ($history as $item): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $item['nama'] ?></td>
                        <td><?= $item['merk'] ?></td>
                        <td>Rp. <?= number_format($item['jumlah_bayar'], 0, ',', '.') ?></td>
                        <td class="status <?= ($item['status_pembayaran'] == 'Sudah Bayar') ? 'success' : 'pending' ?>"><?= $item['status_pembayaran'] ?></td>
                        <td class="status <?= ($item['status_penyewaan'] == 'Done') ? 'success' : 'pending' ?>"><?= $item['status_penyewaan'] ?></td>
                        <td>
                            <a href="<?= base_url('admin/editHistory/' . $item['id_pembayaran']) ?>" ><button class="btn-edit">Edit</button></a>
                            <form action="<?= base_url('admin/history/delete/' . $item['id_penyewaan']) ?>" method="POST" onsubmit="return confirm('Are you sure you want to delete this transaction?');">
                                <?= csrf_field(); ?>
                                <input type="hidden" name="id_pembayaran" value="<?= $item['id_pembayaran'] ?>">
                                <button type="submit" class="btn-delete">Delete</button>
                            </form>
                        </td>
                    </tr>
            <?php endforeach; ?>
    </div>
</div>
</body>
</html>
