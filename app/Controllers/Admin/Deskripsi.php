<?php
namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\KendaraanModel;

class Deskripsi extends BaseController
{
    public function index($id_kendaraan)
    {
        if (!session()->get('email') || session()->get('role') !== 'admin') {
            return redirect()->to(base_url('auth/login'))->with('error', 'Anda harus login terlebih dahulu!');
        }
        
        $kendaraanModel = new KendaraanModel();
        $kendaraan = $kendaraanModel->find($id_kendaraan);

        if (!$kendaraan) {
            return redirect()->to(base_url('admin/listMobil'))->with('error', 'Data kendaraan tidak ditemukan.');
        }

        return view('admin/deskripsi', ['kendaraan' => $kendaraan]);
    }
}
?>