<?php

namespace App\Controllers;

require_once ROOTPATH . '/vendor/autoload.php';

use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;
use App\Models\Supplier;


class SupplierController extends ResourceController
{
    public function __construct()
    {
        header("Access-Control-Allow-Origin: *");
        //header("Access-Control-Allow-Methods: GET, POST, PUT, OPTIONS");
        header("Access-Control-Allow-Headers: X-Request-With");
        $this->Supplier = new Supplier();
    }

    //protected $modelName = 'App\Models\Tokenpush';
    protected $format = 'json';
    /**
     * Return an array of resource objects, themselves in array format.
     *
     * @return ResponseInterface
     */


    //get data like field Nama
    public function index()
    {
        $wherelike = $this->request->getVar('like');
        $optionlike = $this->request->getVar('option');
        $likeket = "Nama";
        if (empty($optionlike)) {
            $likeket = "Nama";
        } elseif ($optionlike == "Kota") {
            $likeket = "Kota";
        }
        $data = [
            'message' => 'success',
            'countsupplier' => $this->Supplier->like($likeket, $wherelike)->countAllResults()
        ];

        return $this->respond($data, 200);
    }

    //get data by field No ACC
    public function getsupplierbyid()
    {
        $wherelike = $this->request->getVar('id');
        $data = [
            'message' => 'success',
            'datasupplier' => $this->Supplier->where('sNo_Acc', $wherelike)->findAll()
        ];

        return $this->respond($data, 200);
    }


    //get data with filter field Nama, Person. Show limit
    public function getSupplier()
    {
        $wherelike = $this->request->getVar('like');
        $pageprev = $this->request->getVar('pageprev');
        $page = $this->request->getVar('page');
        $optionlike = $this->request->getVar('option');
        $likeket = "Nama";
        if (empty($optionlike)) {
            $likeket = "Nama";
        } elseif ($optionlike == "Kota") {
            $likeket = "Kota";
        }
        $data = [
            'message' => 'success',
            'datasupplier' => $this->Supplier->like($likeket, $wherelike)->limit(intval($page), intval($pageprev))->findAll()
        ];

        return $this->respond($data, 200);
    }

    //get max noAcc
    public function maxnoacc()
    {
        $data = [
            'message' => 'success',
            'maxnosupp' => $this->Supplier->selectMax('sNo_Acc', 'noacc')->findAll()
        ];

        return $this->respond($data, 200);
    }

    //Insert
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

    //Update
    public function update($id = null)
    {

        $this->Supplier->update($id, [
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

        return $this->respond($response, 200);
    }

    //delete
    public function deletedata()
    {
        $id = $this->request->getVar('id');
        $this->Supplier->where('sNo_Acc', $id)->delete();
        $response = ['message' => 'success'];

        return $this->respondDeleted($response);
    }
}
