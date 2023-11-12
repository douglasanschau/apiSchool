<?php

namespace App\Controllers;

use App\Models\Student;
use App\Models\StudentAddress;

use CodeIgniter\HTTP\IncomingRequest;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;

class Students extends ResourceController
{
    use ResponseTrait;

    public function index()
    {
        $model    = model(Student::class);
        $students = $model->select('id, name, email, telephone, 
                                    CASE 
                                        WHEN hogwarts_house = "H" THEN "Hufflepuff"
                                        WHEN hogwarts_house = "R" THEN "Ravenclaw"
                                        WHEN hogwarts_house = "S" THEN "Slytherin"
                                        ELSE "Gryffindor"
                                    END as house', false)
                                    ->orderBy('name')
                                    ->findAll();

        return $this->respond(['students' => $students]);
    }

    public function create()
    {
        $request = Request();
        $validation = \Config\Services::validation();

        $validation->setRules([
            'name'           => 'required|max_length[150]',
            'email'          => 'required|max_length[150]|valid_email',
        ]);

        $data = array(
            'name'            => $request->getVar('name')? $request->getVar('name') : null,
            'email'           => $request->getVar('email') ? $request->getVar('email') : null,
        );


        if ($validation->run($data)) {

            $model = model(Student::class);

            $student = $model->getStudentByEmail($data['email']);

            if($student){
                return $this->respond(['error' => true, 'message' => 'There\'s already a student registered with this email.']);
            }

            $data['hogwarts_house'] =  $request->getVar('house') ? $request->getVar('house') : null;

            $model->insert($data);

            $student = $model->getStudentByEmail($data['email']);
            
            return $this->respond(['success' => true, 'student' => $student]);
        }

        $error = $validation->getError('name') ? $validation->getError('name') : $validation->getError('email');
        
        return $this->respond(['error' => true, 'message' => $error]);
    }

    public function show($id = null)
    {
        $model = model(Student::class);

        $student  = $model->select('students.*, students_address.street_avenue, students_address.district, students_address.city, students_address.state')
                                      ->join('students_address', 'students_address.id_student = students.id', 'left')  
                                      ->where(['students.id' => $id])
                                      ->first();


        return $this->respond($student);
    }

    public function update($id = null)
    {
        $request = Request();
        $validation = \Config\Services::validation();


        $studentModel   = model(Student::class);
        $studentAddress = model(StudentAddress::class); 

        $student   = $studentModel->getStudentById((int) $id);
        $address   = $studentAddress->getStudentAddress((int) $id);

        if(is_null($student)){
            return $this->respond(['error' => true, 'message' => 'It wasn\'t possible to update the student registration.']);
        }

        $validation->setRules([
            'name'           => 'required|max_length[150]',
            'email'          => 'required|max_length[150]|valid_email',
            'street_avenue'  => 'max_length[150]',
            'district'       => 'max_length[150]',
            'state'          => 'max_length[150]',
            'city'           => 'max_length[150]',
        ]);

        $data = array(
            'name'             => $request->getVar('name')? $request->getVar('name') : null,
            'email'            => $request->getVar('email') ? $request->getVar('email') : null,
            'street_avenue'    => $request->getVar('street_avenue') ? $request->getVar('street_avenue') : null,
            'district'         => $request->getVar('district') ? $request->getVar('district') : null,
            'state'            => $request->getVar('state') ? $request->getVar('state') : null,
            'city'             => $request->getVar('city') ? $request->getVar('city') : null,
        );

        if ($validation->run($data)) {

            $student = $studentModel->getStudentByEmail($request->getVar('email'));

            if(isset($student) && $student->id != $id){
                return $this->respond(['error' => true, 'message' => 'There\'s already a student registered with this email.']);
            }
            
            $student_info = array(
                'name'           => $request->getVar('name')? $request->getVar('name') : null,
                'email'          => $request->getVar('email') ? $request->getVar('email') : null,
                'telephone'      => $request->getVar('telephone') ? $request->getVar('telephone'): null,
                'hogwarts_house' => $request->getVar('house') ? $request->getVar('house'): null,
            );

            $studentModel->update($id, $student_info);

            $address_info = array(
                'id_student'       => $id,
                'street_avenue'    => $request->getVar('street_avenue') ? $request->getVar('street_avenue') : null,
                'district'         => $request->getVar('district') ? $request->getVar('district') : null,
                'state'            => $request->getVar('state') ? $request->getVar('state') : null,
                'city'             => $request->getVar('city') ? $request->getVar('city') : null,
            );

            if(isset($address)){
                $studentAddress->update($address['id'], $address_info);
            } else {
                $studentAddress->save($address_info);
            }

            return $this->respond(['success' => true, 'message' => 'Student\'s registration updated successfully.']);

        }

        $error = $validation->getErrors();

        return $this->respond(['error' => true, 'message' => $error]);
    }

    public function delete($id = null)
    {
        $model = model(Student::class);

        $student  = $model->getStudentById((int) $id);

        if(is_null($student)){
            return $this->respond(['error' => true, 'message' => 'It wasn\'t possible to delete this student registration.']);
        }

        $model->delete($id);

        return $this->respond(['success' => true, 'id' => $id]);
    }
}
