<?php

namespace App\Controllers;

require_once ROOTPATH . '/vendor/autoload.php';

use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;
use App\Models\StockClosingPesanan;


class StockClosingPesananController extends ResourceController
{
    public function __construct()
    {
        header("Access-Control-Allow-Origin: *");
        //header("Access-Control-Allow-Methods: GET, POST, PUT, OPTIONS");
        header("Access-Control-Allow-Headers: X-Request-With");
        $this->StockClosingPesanan = new StockClosingPesanan();
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
            'countStockClosingPesanan' => $this->StockClosingPesanan->like('NoClosing', $wherelike)->countAllResults()
        ];
        return $this->respond($data, 200);;
    }

    //get data by field No ACC
    public function getStockClosingPesananbyid()
    {
        $wherelike = $this->request->getVar('id');
        $data = [
            'message' => 'success',
            'dataStockClosingPesanan' => $this->StockClosingPesanan->where('md5(NoClosing)', md5($wherelike))->findAll()
        ];

        return $this->respond($data, 200);
    }


    //get data with filter field Nama, Person. Show limit
    public function getStockClosingPesanan()
    {
        $wherelike = $this->request->getVar('like');
        $pageprev = $this->request->getVar('pageprev');
        $page = $this->request->getVar('page');
        $data = [
            'message' => 'success',
            'dataStockClosingPesanan' => $this->StockClosingPesanan->like('NoClosing', $wherelike)->orLike('Departemen', $wherelike)->limit(intval($page), intval($pageprev))->findAll()
        ];

        return $this->respond($data, 200);
    }


    //Insert
    public function create()
    {

        $this->StockClosingPesanan->insert([
            'NoClosing'             => esc($this->request->getVar('NoClosing')),
            'Tgl'                   => esc($this->request->getVar('Tgl')),
            'Departemen'            => esc($this->request->getVar('Departemen')),
            'Keterangan'            => esc($this->request->getVar('Keterangan')),
            'TglUbah'               => esc($this->request->getVar('TglUbah')),
            'Username'              => esc($this->request->getVar('Username')),
        ]);

        $response = ['message' => 'success'];

        return $this->respondCreated($response);
    }

    //Update
    public function update($id = null)
    {
        $data = [
            'Tgl'                   => esc($this->request->getVar('Tgl')),
            'Departemen'            => esc($this->request->getVar('Departemen')),
            'Keterangan'            => esc($this->request->getVar('Keterangan')),
            'TglUbah'               => esc($this->request->getVar('TglUbah')),
            'Username'              => esc($this->request->getVar('Username')),
        ];
        $result = $this->StockClosingPesanan->where('md5(NoClosing)', $id)->set($data)->update();

        $response = ['message' => 'success'];

        return $this->respond($response, 200);
    }

    //delete
    public function deletedata()
    {
        $id = $this->request->getVar('id');
        $this->StockClosingPesanan->where('md5(NoClosing)', $id)->delete();
        $response = ['message' => 'success'];
        return $this->respondDeleted($response);
    }
}
