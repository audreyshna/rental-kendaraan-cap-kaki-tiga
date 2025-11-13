<?php
namespace App\Models;

use CodeIgniter\Model;

class UsersModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id_user';
    protected $allowedFields = ['nama', 'no_telepon', 'email', 'Password', 'role'];

    public function validateLogin($email, $password)
    {
        $user = $this->where('email', $email)->first();

        if ($user && password_verify($password, $user['Password'])) {
            return $user;
        }

        return false;
    }
}

?>