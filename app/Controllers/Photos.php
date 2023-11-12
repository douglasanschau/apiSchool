<?php

namespace App\Controllers;

use App\Models\Student;

use CodeIgniter\HTTP\IncomingRequest;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;

class Photos extends ResourceController
{
    use ResponseTrait;

    public function show($path = null)
    {
        echo file_get_contents(WRITEPATH.'uploads/images/'.$path);
    }

    public function create()
    {
        helper('filesystem');

        $request = Request();

        $id = $request->getVar('id');


        $model  = model(Student::class); 
        $student = $model->getStudentById((int) $id);

        if(isset($student)) {

            $photo = $request->getFile('photo');

            $path = 'images';
            $file_name = $photo->getName();
    
            if(!empty($student->photo) && file_exists(WRITEPATH.'uploads/'.$path.'/'.$student->photo)){
                 unlink(WRITEPATH.'uploads/'.$path.'/'.$student->photo);
            }


            $request->getFile("photo")->store($path, $file_name);
            

            $data = array(
                'photo' => $file_name,
            );

            $model->update($id, $data);
        }


        return $this->respond(['success' => true, 'message' => 'Image upload successfully', 'photo' => $file_name]);
    }

}