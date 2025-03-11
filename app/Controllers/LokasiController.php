<?php

namespace App\Controllers;

require_once ROOTPATH . '/vendor/autoload.php';

use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;
use App\Models\Lokasi;


class LokasiController extends ResourceController
{
    public function __construct()
    {
        header("Access-Control-Allow-Origin: *");
        //header("Access-Control-Allow-Methods: GET, POST, PUT, OPTIONS");
        header("Access-Control-Allow-Headers: X-Request-With");
        $this->Lokasi = new Lokasi();
    }

    protected $format = 'json';
    /**
     * Return an array of resource objects, themselves in array format.
     *
     * @return ResponseInterface
     */


    //get count data like field Lokasi
    public function index()
    {
        $wherelike = $this->request->getVar('like');
        $data = [
            'message' => 'success',
            'countlokasi' => $this->Lokasi->like('Lokasi', $wherelike)->countAllResults()
        ];

        return $this->respond($data, 200);
    }

    //get data by field Lokasi
    public function getlokasibyid()
    {
        $wherelike = $this->request->getVar('id');
        $data = [
            'message' => 'success',
            'datalokasi' => $this->Lokasi->where('Lokasi', $wherelike)->findAll()
        ];

        return $this->respond($data, 200);
    }


    //get data with filter field Lokasi Show limit
    public function getLokasi()
    {
        $wherelike = $this->request->getVar('like');
        $pageprev = $this->request->getVar('pageprev');
        $page = $this->request->getVar('page');
        $data = [
            'message' => 'success',
            'datalokasi' => $this->Lokasi->like('Lokasi', $wherelike)->limit(intval($page), intval($pageprev))->findAll()
        ];

        return $this->respond($data, 200);
    }

    //Insert
    public function create()
    {

        $this->Lokasi->insert([
            'Lokasi'      => esc($this->request->getVar('Lokasi')),
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

        $this->Lokasi->update($id, [
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
        $this->Lokasi->where('Lokasi', $id)->delete();
        $response = ['message' => 'success'];

        return $this->respondDeleted($response);
    }
}
