<?php

namespace App\Controllers;

use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, OPTIONS");

class LoginController extends ResourceController
{
    protected $modelName = 'App\Models\Login';
    protected $format = 'json';
    /**
     * Return an array of resource objects, themselves in array format.
     *
     * @return ResponseInterface
     */


    public function index()
    {
        $user = $this->request->getVar('user');
        $data = [
            'message' => 'success',
            'user' => $this->model->where('USERNAME', $user)->findAll()
        ];

        return $this->respond($data, 200);
    }
    
    public function detail()
    {
        $user = $this->request->getVar('user');
        $data = [
            'message' => 'success',
            'user' => $this->model->where('USERID', $user)->findAll()
        ];

        return $this->respond($data, 200);
    }


}
