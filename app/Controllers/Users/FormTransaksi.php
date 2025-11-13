<?php
namespace App\Controllers\Users;

use App\Controllers\BaseController;
use App\Models\KendaraanModel;
use App\Models\PenyewaanModel;
use App\Models\PembayaranModel;
use App\Models\PenyewaModel;

class FormTransaksi extends BaseController
{
    public function index($id_kendaraan)
    {
        if (!session()->get('email') || session()->get('role') !== 'user') {
            return redirect()->to(base_url('auth/login'))->with('error', 'Anda harus login terlebih dahulu!');
        }
        
        $kendaraanModel = new KendaraanModel();
        $kendaraan = $kendaraanModel->find($id_kendaraan);

        if (!$kendaraan) {
            return redirect()->to(base_url('users/home'))->with('error', 'Data kendaraan tidak ditemukan.');
        }

        return view('users/formTransaksi', ['kendaraan' => $kendaraan]);
    }

    public function formTransaksi($id_kendaraan)
    {
        $penyewaModel = new PenyewaModel();
        $penyewaanModel = new PenyewaanModel();
        $pembayaranModel = new PembayaranModel();
        $kendaraanModel = new KendaraanModel();
        $kendaraan = $kendaraanModel->find($id_kendaraan);

        if (!$kendaraan) {
            return redirect()->to(base_url('users/home'))->with('error', 'Data kendaraan tidak ditemukan.');
        }

        $validation = \Config\Services::validation();


        $penyewaData = [
            'nama' => $this->request->getPost('nama'),
            'alamat' => $this->request->getPost('alamat'),
            'no_telp' => $this->request->getPost('no_telp'),
            'no_ktp' => $this->request->getPost('nik')
        ];

        foreach ($penyewaData as $key => $value) {
            if (trim($value) === '') {
                return redirect()->back()->withInput()->with('error', ucfirst($key) . ' tidak boleh kosong!');
            }
        }

        if (!$penyewaModel->save($penyewaData)) {
            log_message('error', 'Penyewa save failed: ' . json_encode($penyewaModel->errors()));
            return redirect()->back()->withInput()->with('error', 'Gagal menyimpan data penyewa.');
        }

        $validationRules = [
            'nik' => 'required|numeric',
            'nama' => 'required',
            'no_telp' => 'required',
            'alamat' => 'required',
            'tanggal-sewa' => 'required',
            'tanggal-kembali' => 'required',
            'pembayaran' => 'required',
            'total-payment' => 'required|numeric',
        ];

        if (!$this->validate($validationRules)) {
            return redirect()->back()->withInput()->with('error', $validation->getErrors());
        }
        
        $existingPenyewa = $penyewaModel->where('no_ktp', $penyewaData['no_ktp'])
                                        ->first();

        if ($existingPenyewa) {
            $penyewaId = $existingPenyewa['id_penyewa'];
            log_message('info', 'Penyewa dengan nama "' . $penyewaData['nama'] . '" sudah ada, ID yang digunakan: ' . $penyewaId);
        } else {
            if (!$penyewaModel->save($penyewaData)) {
                log_message('error', 'Penyewa save failed: ' . json_encode($penyewaModel->errors()));
                return redirect()->back()->withInput()->with('error', 'Gagal menyimpan data penyewa.');
            }
            $penyewaId = $penyewaModel->getInsertID();
            log_message('info', 'Penyewa baru disimpan dengan ID: ' . $penyewaId);
        }

        $totalPayment = $this->request->getPost('total-payment');
        $totalPayment = str_replace(',', '', $totalPayment);
        $totalPayment = (float) $totalPayment;

        $penyewaanData = [
            'id_penyewa' => $penyewaId,
            'id_kendaraan' => $id_kendaraan,
            'tanggal_mulai_sewa' => $this->request->getPost('tanggal-sewa'),
            'tanggal_selesai_sewa' => $this->request->getPost('tanggal-kembali'),
            'total_biaya' => $totalPayment,
            'status' => 'On Progress',
        ];

        if ($penyewaanModel->save($penyewaanData)) {
            $penyewaanId = $penyewaanModel->getInsertID();
            log_message('info', 'Penyewaan berhasil disimpan dengan ID: ' . $penyewaanId);
        } else {
            log_message('error', 'Penyewaan gagal disimpan: ' . json_encode($penyewaanModel->errors()));
            return redirect()->back()->withInput()->with('errors', 'Gagal menyimpan data penyewaan.');
        }

        $pembayaranData = [
            'id_penyewaan' => $penyewaanId, 
            'tanggal_pembayaran' => $this->request->getPost('tanggal-sewa'), 
            'metode_pembayaran' => $this->request->getPost('pembayaran'), 
            'jumlah_bayar' => $totalPayment, 
            'status' => 'Menunggu' 
        ];

        if (!$pembayaranModel->save($pembayaranData)) {
            log_message('error', 'Pembayaran save error: ' . json_encode($pembayaranModel->errors()));
            return redirect()->back()->withInput()->with('errors', 'Gagal menyimpan data pembayaran.');
        }

        $kendaraanModel->updateStatus($id_kendaraan);

        session()->setFlashdata('message', 'Transaksi berhasil!');

        return redirect()->to(base_url('users/home'));
    }
}
?>