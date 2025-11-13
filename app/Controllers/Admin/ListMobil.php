<?php
namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class ListMobil extends BaseController
{
    public function index()
    {
        if (!session()->get('email') || session()->get('role') !== 'admin') {
            return redirect()->to(base_url('auth/login'))->with('error', 'Anda harus login terlebih dahulu!');
        }
        
        $mobil = model('KendaraanModel')->where('tipe', 'Mobil')->findAll();

        return view('admin/listMobil', ['kendaraan' => $mobil]);
    }
}
?>