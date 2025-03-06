<?php

namespace App\Controllers;

use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;


class LoginuserController extends ResourceController
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
        //$nama = $this->request->getVar('nama');          
        $data = [
            'message' => 'success',
            'dataatasan' => $this->model->findAll()
        ];

        return $this->respond($data, 200);
    }


    public function update($id = null)
    {

        $this->model->update($id, [
            'NAMA'          => esc($this->request->getVar('NAMA')),
            'JENISKELAMIN'  => esc($this->request->getVar('JENISKELAMIN')),
            'JABATAN'       => esc($this->request->getVar('JABATAN')),
        ]);

        $response = ['message' => 'success'];

        return $this->respond($response, 200);
    }


    public function updatePassword($id = null)
    {

        $this->model->update($id, [
            'PASSWORD'          => esc($this->request->getVar('PASSWORD')),
        ]);

        $response = ['message' => 'success'];

        return $this->respond($response, 200);
    }
}
