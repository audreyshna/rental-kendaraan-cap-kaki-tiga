<?php

namespace App\Models;

use CodeIgniter\Model;

class PenyewaanModel extends Model
{
    protected $table = 'penyewaan';
    protected $primaryKey = 'id_penyewaan';
    protected $allowedFields = ['id_penyewa', 'id_kendaraan', 'tanggal_mulai_sewa', 'tanggal_selesai_sewa', 'total_biaya', 'status'];

    public function updateStatusPenyewaan($id_penyewaan, $status)
    {
        $this->update($id_penyewaan, ['status' => $status]);

        if ($status === 'Done') {
            $kendaraanModel = new \App\Models\KendaraanModel();
            $penyewaan = $this->find($id_penyewaan);
            $id_kendaraan = $penyewaan['id_kendaraan'];

            $kendaraanModel->updateStatusAfterDone($id_kendaraan);
        } else if ($status === 'On Progress') {
            $penyewaan = $this->find($id_penyewaan);
            $id_kendaraan = $penyewaan['id_kendaraan'];

            $kendaraanModel = new \App\Models\KendaraanModel();
            $kendaraanModel->updateStatusToUnavailable($id_kendaraan);
        }
    }
}
