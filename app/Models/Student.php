<?php

namespace App\Models;

use CodeIgniter\Model;

use App\Entities\StudentEntity;

class Student extends Model
{
    protected $table = 'students';

    protected $allowedFields = ['name', 'email', 'telephone', 'hogwarts_house', 'photo'];

    protected $returnType    = StudentEntity::class;

    public function getStudentByEmail(string $email) 
    {
        return $this->where(['email' => $email])->first();
    }

    public function getStudentById(int $id) 
    {
        return $this->where(['id' => $id])->first();
    }
}