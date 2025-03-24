<?php

namespace App\Controllers;

require_once ROOTPATH . '/vendor/autoload.php';

use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;
use App\Models\Aktifday;

class AktifdayController extends ResourceController
{
    public function __construct()
    {
        header("Access-Control-Allow-Origin: *");
        //header("Access-Control-Allow-Methods: GET, POST, PUT, OPTIONS");
        header("Access-Control-Allow-Headers: X-Request-With");
        $this->Aktifday = new Aktifday();
    }

    protected $format = 'json';
    /**
     * Return an array of resource objects, themselves in array format.
     *
     * @return ResponseInterface
     */

    public function index()
    {

        $data = [
            'message' => 'success',
            'dataaktifday' => $this->Aktifday->findAll()
        ];

        return $this->respond($data, 200);
    }

    //Update
    public function update($id = null)
    {
        $data = [
            'Tgl'               => esc($this->request->getVar('Tgl')),
            'TglUbah'           => esc($this->request->getVar('TglUbah')),
            'Username'          => esc($this->request->getVar('Username')),
        ];
        $result = $this->Aktifday->where('Tgl<>', $id)->set($data)->update();

        $response = ['message' => 'success'];

        return $this->respond($response, 200);
    }
}
