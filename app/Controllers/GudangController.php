<?php

namespace App\Controllers;

require_once ROOTPATH . '/vendor/autoload.php';

use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;
use App\Models\Gudang;


class GudangController extends ResourceController
{
    public function __construct()
    {
        header("Access-Control-Allow-Origin: *");
        //header("Access-Control-Allow-Methods: GET, POST, PUT, OPTIONS");
        header("Access-Control-Allow-Headers: X-Request-With");
        $this->Gudang = new Gudang();
    }

    protected $format = 'json';
    /**
     * Return an array of resource objects, themselves in array format.
     *
     * @return ResponseInterface
     */


    //get count data like field gudang
    public function index()
    {
        $wherelike = $this->request->getVar('like');
        $data = [
            'message' => 'success',
            'countgudang' => $this->Gudang->like('Gudang', $wherelike)->countAllResults()
        ];

        return $this->respond($data, 200);
    }

    //get all data
    public function alldatagudang()
    {
        $data = [
            'message' => 'success',
            'datagudang' => $this->Gudang->findAll()
        ];

        return $this->respond($data, 200);
    }

    //get data by field gudang
    public function getgudangbyid()
    {
        $wherelike = $this->request->getVar('id');
        $data = [
            'message' => 'success',
            'datagudang' => $this->Gudang->where('Gudang', $wherelike)->findAll()
        ];

        return $this->respond($data, 200);
    }


    //get data with filter field gudang Show limit
    public function getGudang()
    {
        $wherelike = $this->request->getVar('like');
        $pageprev = $this->request->getVar('pageprev');
        $page = $this->request->getVar('page');
        $data = [
            'message' => 'success',
            'datagudang' => $this->Gudang->like('Gudang', $wherelike)->limit(intval($page), intval($pageprev))->findAll()
        ];

        return $this->respond($data, 200);
    }

    //Insert
    public function create()
    {

        $this->Gudang->insert([
            'Gudang'  => esc($this->request->getVar('Gudang')),
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

        $this->Gudang->update($id, [
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
        $this->Gudang->where('Gudang', $id)->delete();
        $response = ['message' => 'success'];

        return $this->respondDeleted($response);
    }
}
