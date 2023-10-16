<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\LoginModel;
use CodeIgniter\API\ResponseTrait;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class UserAPI extends BaseController
{
    use ResponseTrait;
    public function index()
    {
        return $this->respond(['hello' => 'panda']);
    }

    public function login(){
        $key = 'testingkeykocakajalahya';
        $loginModel = new LoginModel();
        $username = $this->request->getVar('username');
        $grantType = $this->request->getVar('grantType');
        $password = $this->request->getVar('password');
        $result = $loginModel->getUser($username, $password);

        $issuedAt = time();
        $expire = $issuedAt + 3600;

        $payload = [
            'result' => $result[0],
            'iat' => $issuedAt,
            'exp' => $expire
        ];

        $jwt = JWT::encode($payload,$key,'HS256');
        if($grantType == 'password'){
            return $this->respondCreated([
                'result'=>$jwt,
                'status'=>1,
                'message'=>'login berhasil'
            ]);
        }else{
            return $this->respondCreated([
                'status'=>1,
                'message'=>'berhasil'
            ]);
        }
        
    }

    public function readToken(){
        $key = 'testingkeykocakajalahya';
        // $request = service('request');
        $valuesInHeader = $this->request->getHeaders();
        $jwt = explode(" ",$valuesInHeader['Authorization']->getValue());
        $userData = JWT::decode($jwt[1],new Key($key,'HS256'));
        return $this->respond([
            'status' => 1,
            'userdata' => $userData
        ]);
    }
}
