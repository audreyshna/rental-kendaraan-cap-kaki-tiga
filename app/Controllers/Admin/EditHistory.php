<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\PenyewaanModel;
use App\Models\PenyewaModel;
use App\Models\PembayaranModel;
use App\Models\KendaraanModel;

class EditHistory extends BaseController
{
    protected $penyewaanModel;
    protected $penyewaModel;
    protected $pembayaranModel;

    public function __construct()
    {
        $this->penyewaanModel = new PenyewaanModel();
        $this->penyewaModel = new PenyewaModel();
        $this->pembayaranModel = new PembayaranModel();
    }

    public function edit($id_pembayaran)
    {
        if (!session()->get('email') || session()->get('role') !== 'admin') {
            return redirect()->to(base_url('auth/login'))->with('error', 'Anda harus login terlebih dahulu!');
        }
        
        $penyewaan = $this->penyewaanModel->select('penyewaan.*, pembayaran.status AS status_pembayaran, pembayaran.id_pembayaran, kendaraan.image, kendaraan.merk, kendaraan.harga_sewa_perhari, penyewa.nama, penyewaan.status AS status_penyewaan')
                                          ->join('penyewa', 'penyewa.id_penyewa = penyewaan.id_penyewa')
                                           ->join('kendaraan', 'kendaraan.id_kendaraan = penyewaan.id_kendaraan')
                                           ->join('pembayaran', 'pembayaran.id_penyewaan = penyewaan.id_penyewaan')
                                           ->where('pembayaran.id_pembayaran', $id_pembayaran)
                                           ->first();

        if (!$penyewaan) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Transaksi tidak ditemukan');
        }

        return view('admin/editHistory', ['penyewaan' => $penyewaan]);
    }

    public function update($id_penyewaan)
    {
        $input = $this->request->getPost();

        $rules = [];
        if (isset($input['tanggal_sewa'])) {
            $rules['tanggal_sewa'] = 'required|valid_date';
        }
        if (isset($input['tanggal_kembali'])) {
            $rules['tanggal_kembali'] = 'required|valid_date';
        }
        if (!empty($totalPayment)) {
            $dataPenyewaan['total_biaya'] = $totalPayment;
        }
        if (isset($input['status_pembayaran'])) {
            $rules['status_pembayaran'] = 'required';
        }
        if (isset($input['status_penyewaan'])) {
            $rules['status_penyewaan'] = 'required';
        }

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $totalPayment = $this->request->getPost('total-payment');
        $totalPayment = str_replace(',', '', $totalPayment);
        $totalPayment = (float) $totalPayment;

        $dataPenyewaan = [];
        if (isset($input['tanggal_sewa'])) {
            $dataPenyewaan['tanggal_mulai_sewa'] = $input['tanggal_sewa'];
        }
        if (isset($input['tanggal_kembali'])) {
            $dataPenyewaan['tanggal_selesai_sewa'] = $input['tanggal_kembali'];
        }
        if (!empty($totalPayment)) {
            $dataPenyewaan['total_biaya'] = $totalPayment;
        }
        if (isset($input['status_penyewaan'])) {
            $penyewaanModel = new \App\Models\PenyewaanModel();
            $statusPenyewaan = $input['status_penyewaan'];

            if ($statusPenyewaan === 'Done') {
                $penyewaanModel->updateStatusPenyewaan($id_penyewaan, 'Done');
            }
            elseif ($statusPenyewaan === 'On Progress') {
                $penyewaanModel->updateStatusPenyewaan($id_penyewaan, 'On Progress');
            }
        }

        if (!empty($dataPenyewaan)) {
            $this->penyewaanModel->update($id_penyewaan, $dataPenyewaan);
        }

        if (isset($input['status_pembayaran'])) {
            $penyewaan = $this->penyewaanModel
                ->join('pembayaran', 'penyewaan.id_penyewaan = pembayaran.id_penyewaan')
                ->where('penyewaan.id_penyewaan', $id_penyewaan)
                ->first();

            if ($penyewaan && isset($penyewaan['id_pembayaran'])) {
                $id_pembayaran = $penyewaan['id_pembayaran'];

                $dataPembayaran = [
                    'status' => $input['status_pembayaran']
                ];

                if (!empty($totalPayment)) {
                    $dataPembayaran['jumlah_bayar'] = $totalPayment;
                }

                $this->pembayaranModel->update($id_pembayaran, $dataPembayaran);
            }
        }

        session()->setFlashdata('message', 'Transaksi berhasil diperbaharui!');
        session()->setFlashdata('message_type', 'success');

        return redirect()->to(base_url('admin/history'));
    }


    public function delete($id_penyewaan)
    {
        $db = \Config\Database::connect();
        $penyewaanModel = new PenyewaanModel();
        $penyewaModel = new PenyewaModel();
        $pembayaranModel = new PembayaranModel();
        $kendaraanModel = new KendaraanModel();

        if (!$id_penyewaan) {
            log_message('error', "ID Penyewaan tidak ditemukan.");
            return redirect()->to(base_url('admin/history'))->with('error', 'ID Penyewaan tidak valid.');
        }

        $db->transBegin();

        $pembayaran = $pembayaranModel->where('id_penyewaan', $id_penyewaan)->first();
        if ($pembayaran) {
            $pembayaranModel->delete($pembayaran['id_pembayaran']);
            log_message('info', "Pembayaran terkait penyewaan ID $id_penyewaan berhasil dihapus.");
        }
        $penyewaan = $penyewaanModel->find($id_penyewaan);
        
        if ($penyewaan) {
            $penyewaanModel->delete($id_penyewaan);
            log_message('info', "Penyewaan dengan ID $id_penyewaan berhasil dihapus.");
        }

        if (isset($penyewaan['id_kendaraan'])) {
            $kendaraanModel->updateStatus($penyewaan['id_kendaraan']);
            log_message('info', "Status kendaraan ID {$penyewaan['id_kendaraan']} diperbarui.");
        }

        if (isset($penyewaan['id_penyewa'])) {
            $penyewa = $penyewaModel->find($penyewaan['id_penyewa']);
            if ($penyewa) {
                $penyewaanLain = $penyewaanModel->where('id_penyewa', $penyewa['id_penyewa'])->first();
                if (!$penyewaanLain) {
                    $penyewaModel->delete($penyewa['id_penyewa']);
                    log_message('info', "Penyewa dengan ID {$penyewa['id_penyewa']} berhasil dihapus.");
                } else {
                    log_message('info', "Penyewa dengan ID {$penyewa['id_penyewa']} masih memiliki penyewaan lainnya.");
                }
            }
        }
        
        if ($db->transStatus() === FALSE) {
            log_message('error', 'Transaksi gagal.');
            $db->transRollback();
            return redirect()->to(base_url('admin/history'))->with('error', 'Gagal menghapus transaksi.');
        } else {
            log_message('info', 'Transaksi berhasil.');
            $db->transCommit();
            return redirect()->to(base_url('admin/history'))->with('message', 'Transaksi berhasil dihapus!');
        }
    }
}
