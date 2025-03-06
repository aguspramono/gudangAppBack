<?php

namespace App\Controllers;

require_once ROOTPATH . '/vendor/autoload.php';

use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;


class TokenController extends ResourceController
{
    protected $modelName = 'App\Models\Tokenpush';
    protected $format = 'json';
    /**
     * Return an array of resource objects, themselves in array format.
     *
     * @return ResponseInterface
     */


    public function delete($id = null)
    {
        $this->model->where('iduserlogin', $id)->delete();
        $response = ['message' => 'success'];

        return $this->respondDeleted($response);
    }

    public function deletebytoken($token)
    {
        $this->model->where('token', $token)->delete();
        $response = ['message' => 'success'];

        return $this->respondDeleted($response);
    }

    public function create()
    {

        $this->model->insert([
            'token'             => esc($this->request->getVar('token')),
            'iduserlogin'       => esc($this->request->getVar('iduserlogin')),
            'statuslogin'       => esc($this->request->getVar('statuslogin'))

        ]);

        $response = ['message' => 'success'];

        return $this->respondCreated($response);
    }

    // public function sendNotif()
    // {

    //     $token = "gIlSZKEeICTiO7FicANYPx";
    //     $title = "Pengajuan Cuti";
    //     $body = "Hallo, Agus Pramono ingin mengajukan cuti, lihat detail ya";
    //     $type = "izin";

    //     $this->model->funcpushnotif($token, $title, $body, $type);
    // }
}
