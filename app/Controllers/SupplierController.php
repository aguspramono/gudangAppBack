<?php

namespace App\Controllers;

require_once ROOTPATH . '/vendor/autoload.php';

use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;
use App\Models\Supplier;

header('Access-Control-Allow-Origin: *');

class SupplierController extends ResourceController
{
    public function __construct()
    {
        $this->Supplier = new Supplier();
    }

    //protected $modelName = 'App\Models\Tokenpush';
    protected $format = 'json';
    /**
     * Return an array of resource objects, themselves in array format.
     *
     * @return ResponseInterface
     */


    public function index()
    {
        $wherelike = $this->request->getVar('like');
        $data = [
            'message' => 'success',
            'countsupplier' => $this->Supplier->like('Nama', $wherelike)->countAllResults()
        ];

        return $this->respond($data, 200);
    }

    public function getSupplier()
    {
        $wherelike = $this->request->getVar('like');
        $pageprev = $this->request->getVar('pageprev');
        $page = $this->request->getVar('page');
        $data = [
            'message' => 'success',
            'datasupplier' => $this->Supplier->like('Nama', $wherelike)->orLike('Person', $wherelike)->limit(intval($page), intval($pageprev))->findAll()
        ];

        return $this->respond($data, 200);
    }


    public function maxnoacc()
    {
        $data = [
            'message' => 'success',
            'maxnosupp' => $this->Supplier->selectMax('sNo_Acc', 'noacc')->findAll()
        ];

        return $this->respond($data, 200);
    }

    public function create()
    {

        $this->Supplier->insert([
            'sNo_Acc'    => esc($this->request->getVar('sNo_Acc')),
            'Nama'       => esc($this->request->getVar('Nama')),
            'Alamat'     => esc($this->request->getVar('Alamat')),
            'Kota'       => esc($this->request->getVar('Kota')),
            'Phone'      => esc($this->request->getVar('Phone')),
            'Email'      => esc($this->request->getVar('Email')),
            'TglUbah'    => esc($this->request->getVar('TglUbah')),
            'Username'   => esc($this->request->getVar('Username')),
            'Person'     => esc($this->request->getVar('Person')),

        ]);

        $response = ['message' => 'success'];

        return $this->respondCreated($response);
    }
}
