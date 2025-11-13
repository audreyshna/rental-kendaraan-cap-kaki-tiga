<?php
namespace App\Controllers\Users;

use App\Controllers\BaseController;

class Home extends BaseController
{
    public function index()
    {
        if (session()->get('role') !== 'user') {
            return redirect()->to('/login')->with('error', 'Akses ditolak!');
        }
        
        return view('users/home');
    }
}
?>