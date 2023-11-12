<?php

namespace App\Controllers;

use App\Models\Users;

use CodeIgniter\HTTP\IncomingRequest;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;

class Logout extends ResourceController
{
    use ResponseTrait;

    public function index()
    {
        $request = request();
        
        $user = $request->getGet('user')? $request->getGet('user') : null;

        $email    = isset($user)  && !empty($user['email']) ? $user['email'] : '';
        $password = isset($user)  && !empty($user['password']) ? $user['password'] : '';
        
        try { 
            $model = model(Users::class);
            $user  = $model->getUser($email, $password);
        } catch(\Exception $e){
            throw new \Exception('We couldn\'t manage to research the registration.' , 1);
        }

        if(is_null($user)){
            return $this->respond(['error' => true, 'message' => 'User not found.']);
        }


        return $this->respond(['success' => true, 'user' => $user]);
    }
}
