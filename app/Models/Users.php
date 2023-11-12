<?php

namespace App\Models;

use CodeIgniter\Model;

class Users extends Model
{
    protected $table = 'users';

    protected $allowedFields = ['name', 'email', 'password'];

    public function getUser(string $email, string $password)
    {
        return $this->where(['email' => $email])->where(['password' => $password])->first();
    }
}