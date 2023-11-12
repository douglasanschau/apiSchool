<?php

namespace App\Models;

use CodeIgniter\Model;

use App\Entities\StudentEntity;

class StudentAddress extends Model
{
    protected $table = 'students_address';

    protected $allowedFields = ['id_student', 'street_avenue', 'district', 'state', 'city'];


    public function getStudentAddress(int $id_student) 
    {
        return $this->where(['id_student' => $id_student])->first();
    }
}