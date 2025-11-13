<?php
namespace App\Models;

use CodeIgniter\Model;

class PembayaranModel extends Model
{
    protected $table      = 'pembayaran';
    protected $primaryKey = 'id_pembayaran';
    protected $allowedFields = [
        'id_penyewaan', 'tanggal_pembayaran', 'metode_pembayaran', 'jumlah_bayar', 'status'
    ];
}
