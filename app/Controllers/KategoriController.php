<?php

namespace App\Controllers;

require_once ROOTPATH . '/vendor/autoload.php';

use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;
use App\Models\Kategori;


class KategoriController extends ResourceController
{
    public function __construct()
    {
        header("Access-Control-Allow-Origin: *");
        //header("Access-Control-Allow-Methods: GET, POST, PUT, OPTIONS");
        header("Access-Control-Allow-Headers: X-Request-With");
        $this->Kategori = new Kategori();
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
            'countkategori' => $this->Kategori->like('Kategori', $wherelike)->countAllResults()
        ];

        return $this->respond($data, 200);
    }

    //get data by field KodeDepartemen
    public function getkategoribyid()
    {
        $wherelike = $this->request->getVar('id');
        $data = [
            'message' => 'success',
            'datakategori' => $this->Kategori->where('Kategori', $wherelike)->findAll()
        ];

        return $this->respond($data, 200);
    }


    //get data with filter field Keterangan. Show limit
    public function getKategori()
    {
        $wherelike = $this->request->getVar('like');
        $pageprev = $this->request->getVar('pageprev');
        $page = $this->request->getVar('page');
        $data = [
            'message' => 'success',
            'datakategori' => $this->Kategori->like('Kategori', $wherelike)->limit(intval($page), intval($pageprev))->findAll()
        ];

        return $this->respond($data, 200);
    }

    //Insert
    public function create()
    {

        $this->Kategori->insert([
            'Kategori'  => esc($this->request->getVar('Kategori')),
            't_NoAkunStock'  => esc($this->request->getVar('t_NoAkunStock')),
            't_NoAkunKas'     => esc($this->request->getVar('t_NoAkunKas')),
            't_NoAkunHutang'  => esc($this->request->getVar('t_NoAkunHutang')),
            'k_NoAkunBiaya'  => esc($this->request->getVar('k_NoAkunBiaya')),
            'k_NoAkunStock'     => esc($this->request->getVar('k_NoAkunStock')),
            'a_NoAkunBiaya'  => esc($this->request->getVar('a_NoAkunBiaya')),
            'a_NoAkunStock'  => esc($this->request->getVar('a_NoAkunStock')),
            'Keterangan'     => esc($this->request->getVar('Keterangan')),
            'TglUbah'     => esc($this->request->getVar('TglUbah')),
            'Username'    => esc($this->request->getVar('Username')),

        ]);

        $response = ['message' => 'success'];

        return $this->respondCreated($response);
    }

    //Update
    public function update($id = null)
    {

        $this->Kategori->update($id, [
            't_NoAkunStock'  => esc($this->request->getVar('t_NoAkunStock')),
            't_NoAkunKas'     => esc($this->request->getVar('t_NoAkunKas')),
            't_NoAkunHutang' => esc($this->request->getVar('t_NoAkunHutang')),
            'k_NoAkunBiaya'  => esc($this->request->getVar('k_NoAkunBiaya')),
            'k_NoAkunStock'  => esc($this->request->getVar('k_NoAkunStock')),
            'a_NoAkunBiaya'  => esc($this->request->getVar('a_NoAkunBiaya')),
            'a_NoAkunStock'  => esc($this->request->getVar('a_NoAkunStock')),
            'Keterangan'     => esc($this->request->getVar('Keterangan')),
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
        $this->Kategori->where('Kategori', $id)->delete();
        $response = ['message' => 'success'];

        return $this->respondDeleted($response);
    }
}
