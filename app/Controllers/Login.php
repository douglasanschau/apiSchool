<?php

namespace App\Controllers;

use App\Models\Users;

use CodeIgniter\HTTP\IncomingRequest;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;

class Login extends ResourceController
{
    use ResponseTrait;

    public function index()
    {
        $request = request();

        $email    = $request->getGet('email')? $request->getGet('email') : null;
        $password = $request->getGet('password') ? md5($request->getGet('password')) : null;

        if(is_null($email) || is_null($password)){
            return $this->respond(['error' => true, 'message' => 'Password and login must be informed.']);
        }
        
        try { 
            $model = model(Users::class);
            $user  = $model->getUser($email, $password);
        } catch(\Exception $e){
            throw new \Exception('We couldn\'t manage to research the registration.' , 1);
        }

        return $this->respond(['success' => true, 'user' => $user]);
    }
}
