<?php

namespace App\Controllers;

require_once ROOTPATH . '/vendor/autoload.php';

use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;
use App\Models\Satuan;


class SatuanController extends ResourceController
{
    public function __construct()
    {
        header("Access-Control-Allow-Origin: *");
        //header("Access-Control-Allow-Methods: GET, POST, PUT, OPTIONS");
        header("Access-Control-Allow-Headers: X-Request-With");
        $this->Satuan = new Satuan();
    }

    protected $format = 'json';
    /**
     * Return an array of resource objects, themselves in array format.
     *
     * @return ResponseInterface
     */


    //get count data like field Nama
    public function index()
    {
        $wherelike = $this->request->getVar('like');
        $data = [
            'message' => 'success',
            'countsatuan' => $this->Satuan->like('Satuan', $wherelike)->countAllResults()
        ];

        return $this->respond($data, 200);
    }

    //get all data
    public function allsatuan()
    {
        $data = [
            'message' => 'success',
            'datasatuan' => $this->Satuan->findAll()
        ];

        return $this->respond($data, 200);
    }

    //get data by field Satuan
    public function getsatuanbyid()
    {
        $wherelike = $this->request->getVar('id');
        $data = [
            'message' => 'success',
            'datasatuan' => $this->Satuan->where('Satuan', $wherelike)->findAll()
        ];

        return $this->respond($data, 200);
    }


    //get data with filter field satuan Show limit
    public function getSatuan()
    {
        $wherelike = $this->request->getVar('like');
        $pageprev = $this->request->getVar('pageprev');
        $page = $this->request->getVar('page');
        $data = [
            'message' => 'success',
            'datasatuan' => $this->Satuan->like('Satuan', $wherelike)->limit(intval($page), intval($pageprev))->findAll()
        ];

        return $this->respond($data, 200);
    }

    //Insert
    public function create()
    {

        $this->Satuan->insert([
            'Satuan'  => esc($this->request->getVar('Satuan')),
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

        $this->Satuan->update($id, [
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
        $this->Satuan->where('Satuan', $id)->delete();
        $response = ['message' => 'success'];

        return $this->respondDeleted($response);
    }
}
