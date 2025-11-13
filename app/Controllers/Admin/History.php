<?php
namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\PenyewaModel;
use App\Models\KendaraanModel;
use App\Models\PembayaranModel;
use App\Models\PenyewaanModel;

class History extends BaseController
{
    protected $penyewaModel;
    protected $kendaraanModel;
    protected $pembayaranModel;
    protected $penyewaanModel;

    public function __construct()
    {
        $this->penyewaModel = new PenyewaModel();
        $this->kendaraanModel = new KendaraanModel();
        $this->pembayaranModel = new PembayaranModel();
        $this->penyewaanModel = new PenyewaanModel();
    }

    public function index()
    {
        if (!session()->get('email') || session()->get('role') !== 'admin') {
            return redirect()->to(base_url('auth/login'))->with('error', 'Anda harus login terlebih dahulu!');
        }
        
        $history = $this->pembayaranModel
        ->select('pembayaran.id_pembayaran, penyewa.nama, kendaraan.merk, pembayaran.jumlah_bayar, pembayaran.status as status_pembayaran, penyewaan.id_penyewaan, penyewaan.status as status_penyewaan')
            ->join('penyewaan', 'penyewaan.id_penyewaan = pembayaran.id_penyewaan', 'left')
            ->join('penyewa', 'penyewa.id_penyewa = penyewaan.id_penyewa', 'left')
            ->join('kendaraan', 'kendaraan.id_kendaraan = penyewaan.id_kendaraan', 'left')
            ->findAll();  
            
        $data['history'] = $history;

        return view('admin/history', $data);
    }
}
?>