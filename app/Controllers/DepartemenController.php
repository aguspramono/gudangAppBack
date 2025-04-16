<?php

namespace App\Controllers;

require_once ROOTPATH . '/vendor/autoload.php';

use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;
use App\Models\Departemen;


class DepartemenController extends ResourceController
{
    public function __construct()
    {
        header("Access-Control-Allow-Origin: *");
        //header("Access-Control-Allow-Methods: GET, POST, PUT, OPTIONS");
        header("Access-Control-Allow-Headers: X-Request-With");
        $this->Departemen = new Departemen();
    }

    protected $format = 'json';
    /**
     * Return an array of resource objects, themselves in array format.
     *
     * @return ResponseInterface
     */


    //get count data like field Keterangan
    public function index()
    {
        $wherelike = $this->request->getVar('like');
        $data = [
            'message' => 'success',
            'countdepartemen' => $this->Departemen->like('Keterangan', $wherelike)->countAllResults()
        ];

        return $this->respond($data, 200);
    }

    //get data by field KodeDepartemen
    public function getdepartemenbyid()
    {
        $wherelike = $this->request->getVar('id');
        $data = [
            'message' => 'success',
            'datadepartemen' => $this->Departemen->where('Departemen', $wherelike)->findAll()
        ];

        return $this->respond($data, 200);
    }


    //get data with filter field Keterangan. Show limit
    public function getDepartemen()
    {
        $wherelike = $this->request->getVar('like');
        $pageprev = $this->request->getVar('pageprev');
        $page = $this->request->getVar('page');
        $data = [
            'message' => 'success',
            'datadepartemen' => $this->Departemen->like('Keterangan', $wherelike)->limit(intval($page), intval($pageprev))->findAll()
        ];

        return $this->respond($data, 200);
    }

    //get data with filter field Keterangan. no limit
    public function getAllDepartemen()
    {
        $data = [
            'message' => 'success',
            'datadepartemen' => $this->Departemen->findAll()
        ];

        return $this->respond($data, 200);
    }

    //Insert
    public function create()
    {

        $this->Departemen->insert([
            'Departemen'  => esc($this->request->getVar('Departemen')),
            'Keterangan'  => esc($this->request->getVar('Keterangan')),
            'TglUbah'     => esc($this->request->getVar('TglUbah')),
            'Username'    => esc($this->request->getVar('Username')),

        ]);

        $response = ['message' => 'success'];

        return $this->respondCreated($response);
    }

    //Update
    public function update($id = null)
    {

        $this->Departemen->update($id, [
            'Keterangan'  => esc($this->request->getVar('Keterangan')),
            'TglUbah'     => esc($this->request->getVar('TglUbah')),
            'Username'    => esc($this->request->getVar('Username')),
        ]);

        $response = ['message' => 'success'];

        return $this->respond($response, 200);
    }

    //delete
    public function deletedata()
    {
        $id = $this->request->getVar('id');
        $this->Departemen->where('Departemen', $id)->delete();
        $response = ['message' => 'success'];

        return $this->respondDeleted($response);
    }
}
