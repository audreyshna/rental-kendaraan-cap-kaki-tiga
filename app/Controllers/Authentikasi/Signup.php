<?php
namespace App\Controllers\Authentikasi;

use App\Controllers\BaseController;
use App\Models\UsersModel;

class Signup extends BaseController
{
    public function index()
    {
        return view('authentikasi/signup');
    }

    public function register()
    {
        $nama_lengkap = $this->request->getPost('NamaLengkap');
        $nomor_telepon = $this->request->getPost('NomorTelepon');
        $email = $this->request->getPost('Email');
        $password = password_hash($this->request->getPost('Password'), PASSWORD_DEFAULT);

        if (empty($nama_lengkap)) {
            return redirect()->back()->with('error', 'Nama Lengkap tidak boleh kosong!');
        }

        $role = (strpos(strtolower($nama_lengkap), 'admin') !== false) ? 'admin' : 'user';

        $model = new UsersModel();
        $data = [
            'nama' => $nama_lengkap,
            'no_telepon' => $nomor_telepon,
            'email' => $email,
            'Password' => $password,
            'role' => $role,
        ];
        
        $model = new UsersModel();
        if ($model->save($data)) {
            return redirect()->to('/auth/login')->with('message', 'Account created successfully!');
        } else {
            return redirect()->back()->with('error', 'There was an error, please try again!');
        }
    }
}
?>