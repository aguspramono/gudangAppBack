<?php

namespace App\Controllers;

require_once ROOTPATH . '/vendor/autoload.php';

use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;
use App\Models\Product;


class ProductController extends ResourceController
{
    public function __construct()
    {
        header("Access-Control-Allow-Origin: *");
        //header("Access-Control-Allow-Methods: GET, POST, PUT, OPTIONS");
        header("Access-Control-Allow-Headers: X-Request-With");
        $this->Product = new Product();
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
        $data = [
            'message' => 'success',
            'countproduct' => $this->Product->like('Nama', $wherelike)->countAllResults()
        ];

        return $this->respond($data, 200);
    }

    //get data by field No ACC
    public function getProductbyid()
    {
        $wherelike = $this->request->getVar('id');
        $data = [
            'message' => 'success',
            'dataproduct' => $this->Product->where('Kode', $wherelike)->findAll()
        ];

        return $this->respond($data, 200);
    }


    //get data with filter field Nama, Person. Show limit
    public function getProduct()
    {
        $wherelike = $this->request->getVar('like');
        $pageprev = $this->request->getVar('pageprev');
        $page = $this->request->getVar('page');
        $data = [
            'message' => 'success',
            'dataproduct' => $this->Product->like('Nama', $wherelike)->orLike('Merek', $wherelike)->limit(intval($page), intval($pageprev))->findAll()
        ];

        return $this->respond($data, 200);
    }


    //Insert
    public function create()
    {

        $this->Product->insert([
            'Kode'          => esc($this->request->getVar('Kode')),
            'Nama'          => esc($this->request->getVar('Nama')),
            'Merek'         => esc($this->request->getVar('Merek')),
            'Kategori'      => esc($this->request->getVar('Kategori')),
            'Satuan'        => esc($this->request->getVar('Satuan')),
            'Spec'          => esc($this->request->getVar('Spec')),
            'Lokasi'        => esc($this->request->getVar('Lokasi')),
            'HargaEceran'   => esc($this->request->getVar('HargaEceran')),
            'HargaKanvas'   => esc($this->request->getVar('HargaKanvas')),
            'HargaAgen'     => esc($this->request->getVar('HargaAgen')),
            'HargaBeli'     => esc($this->request->getVar('HargaBeli')),
            'hBeliEnd'      => esc($this->request->getVar('hBeliEnd')),
            'Min'           => esc($this->request->getVar('Min')),
            'Max'           => esc($this->request->getVar('Max')),
            'TglUbah'       => esc($this->request->getVar('TglUbah')),
            'Username'      => esc($this->request->getVar('Username')),
            'Showing'       => esc($this->request->getVar('Showing')),
        ]);

        $response = ['message' => 'success'];

        return $this->respondCreated($response);
    }

    //Update
    public function update($id = null)
    {

        $this->Product->update($id, [

            'Nama'          => esc($this->request->getVar('Nama')),
            'Merek'         => esc($this->request->getVar('Merek')),
            'Kategori'      => esc($this->request->getVar('Kategori')),
            'Satuan'        => esc($this->request->getVar('Satuan')),
            'Spec'          => esc($this->request->getVar('Spec')),
            'Lokasi'        => esc($this->request->getVar('Lokasi')),
            'HargaEceran'   => esc($this->request->getVar('HargaEceran')),
            'HargaKanvas'   => esc($this->request->getVar('HargaKanvas')),
            'HargaAgen'     => esc($this->request->getVar('HargaAgen')),
            'HargaBeli'     => esc($this->request->getVar('HargaBeli')),
            'hBeliEnd'      => esc($this->request->getVar('hBeliEnd')),
            'Min'           => esc($this->request->getVar('Min')),
            'Max'           => esc($this->request->getVar('Max')),
            'TglUbah'       => esc($this->request->getVar('TglUbah')),
            'Username'      => esc($this->request->getVar('Username')),
            'Showing'       => esc($this->request->getVar('Showing')),
        ]);

        $response = ['message' => 'success'];

        return $this->respond($response, 200);
    }

    //delete
    public function deletedata()
    {
        $id = $this->request->getVar('id');
        $this->Product->where('Kode', $id)->delete();
        $response = ['message' => 'success'];

        return $this->respondDeleted($response);
    }

    public function stokdistribusi()
    {
        $id = $this->request->getVar('gudang');
        $data = [
            'message' => 'success',
            'datastokdistribusi' => $this->Product->stokdistribusi($id)->getResult()
        ];

        return $this->respond($data, 200);
    }
}
