<?php

namespace App\Models;

use CodeIgniter\Model;

class PenyewaModel extends Model
{
    protected $table = 'penyewa';
    protected $primaryKey = 'id_penyewa';
    protected $allowedFields = ['nama', 'alamat', 'no_telp', 'no_ktp'];
}
