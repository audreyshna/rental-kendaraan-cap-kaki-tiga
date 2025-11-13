<?php
namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class ListMotor extends BaseController
{
    public function index()
    {
        if (!session()->get('email') || session()->get('role') !== 'admin') {
            return redirect()->to(base_url('auth/login'))->with('error', 'Anda harus login terlebih dahulu!');
        }
        
        $motor = model('KendaraanModel')->where('tipe', 'Motor')->findAll();

        return view('admin/listMotor', ['kendaraan' => $motor]);
    }
}

?>