<?php
namespace App\Models;

use CodeIgniter\Model;

class KendaraanModel extends Model
{
    protected $table = 'kendaraan';
    protected $primaryKey = 'id_kendaraan';
    protected $allowedFields = ['tipe', 'merk', 'harga_sewa_perhari', 'status', 'image', 'deskripsi'];

    public function updateStatus($id_kendaraan)
    {
        $penyewaanModel = new \App\Models\PenyewaanModel();
        
        $isRented = $penyewaanModel->where('id_kendaraan', $id_kendaraan)
                                   ->where('status', 'On Progress')
                                   ->first();
        
        if (!$isRented) {
            $this->update($id_kendaraan, ['status' => 'available']);
            log_message('info', 'Status kendaraan ID ' . $id_kendaraan . ' berhasil diubah menjadi Available karena tidak ada penyewaan aktif.');
        } else {
            log_message('info', 'Kendaraan ID ' . $id_kendaraan . ' masih disewa, status tidak diubah.');
        }
    }

    public function updateStatusAfterDone($id_kendaraan)
    {
        $penyewaanModel = new \App\Models\PenyewaanModel();

        $isReturned = $penyewaanModel->where('id_kendaraan', $id_kendaraan)
                                     ->where('status', 'Done')
                                     ->first();
        
        if ($isReturned) {
            $this->update($id_kendaraan, ['status' => 'Available']);
        }
    }

    public function updateStatusToUnavailable($id_kendaraan)
    {
        $penyewaanModel = new \App\Models\PenyewaanModel();

        $isRented = $penyewaanModel->where('id_kendaraan', $id_kendaraan)
                                   ->where('status', 'On Progress')
                                   ->first();

        if ($isRented) {
            $this->update($id_kendaraan, ['status' => 'Unavailable']);
            log_message('info', 'Kendaraan ID ' . $id_kendaraan . ' statusnya diubah menjadi Unavailable karena sedang disewa.');
        }
    }

    public function getAvailableKendaraan()
    {
        return $this->where('is_available', true)->findAll();
    }

    public function getAvailableMobil()
    {
        return $this->getAvailableKendaraanByType('mobil');
    }

    public function getAvailableMotor()
    {
        return $this->getAvailableKendaraanByType('motor');
    }
}
?>