<?php
namespace App\Controllers\Users;

use App\Controllers\BaseController;

class ListMobil extends BaseController
{
    public function index()
    {
        if (!session()->get('email') || session()->get('role') !== 'user') {
            return redirect()->to(base_url('auth/login'))->with('error', 'Anda harus login terlebih dahulu!');
        }
        
        $mobil = model('KendaraanModel')->where('tipe', 'Mobil')->findAll();

        return view('users/listMobil', ['kendaraan' => $mobil]);
    }
}
?>