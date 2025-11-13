<?php
namespace App\Controllers\Authentikasi;

use App\Controllers\BaseController;
use App\Models\UsersModel;

class Login extends BaseController{
    public function index(){
        return view('authentikasi/login');
    }

    public function authenticate()
    {
        $usersModel = new UsersModel();

        $email = $this->request->getPost('Email');
        $password = $this->request->getPost('password');

        if (!$email) {
            return redirect()->back()->with('error', 'Email harus diisi!');
        }

        if (!$password) {
            return redirect()->back()->with('error', 'Password harus diisi!');
        }

        $user = $usersModel->where('email', $email)->first();

        if (!$user) {
            return redirect()->back()->with('error', 'Email tidak ditemukan!');
        }

        if (!password_verify($password, $user['Password'])) {
            return redirect()->back()->with('error', 'Password salah!');
        }

        session()->set([
            'email' => $user['email'],
            'role' => $user['role'],
            'isLoggedIn' => true,
        ]);
        
        if ($user['role'] === 'admin') {
            return redirect()->to('/admin/home');
        } else {
            return redirect()->to('/users/home');
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/auth/login');
    }
}
?>