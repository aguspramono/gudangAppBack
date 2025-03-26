<?php

namespace App\Controllers;

require_once ROOTPATH . '/vendor/autoload.php';

use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;
use App\Models\StockPesanan;


class StockPesananController extends ResourceController
{
    public function __construct()
    {
        header("Access-Control-Allow-Origin: *");
        //header("Access-Control-Allow-Methods: GET, POST, PUT, OPTIONS");
        header("Access-Control-Allow-Headers: X-Request-With");
        $this->StockPesanan = new StockPesanan();
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
            'countStockPesanan' => $this->StockPesanan->like('NoPesanan', $wherelike)->countAllResults()
        ];
        return $this->respond($data, 200);;
    }

    //get all data StockLunasHutang
    public function allStockPesanan()
    {
        $data = [
            'message' => 'success',
            'dataStockPesanan' => $this->StockPesanan->findAll()
        ];

        return $this->respond($data, 200);
    }

    //get data by field No ACC
    public function getStockPesananbyid()
    {
        $wherelike = $this->request->getVar('id');
        $data = [
            'message' => 'success',
            'dataStockPesanan' => $this->StockPesanan->where('md5(NoPesanan)', md5($wherelike))->findAll()
        ];

        return $this->respond($data, 200);
    }


    //get data with filter field InvNum, drGudang. Show limit
    public function getStockPesanan()
    {
        $wherelike = $this->request->getVar('like');
        $pageprev = $this->request->getVar('pageprev');
        $page = $this->request->getVar('page');
        $data = [
            'message' => 'success',
            'dataStockPesanan' => $this->StockPesanan->like('NoPesanan', $wherelike)->orLike('Gudang', $wherelike)->limit(intval($page), intval($pageprev))->findAll()
        ];

        return $this->respond($data, 200);
    }


    //Insert
    public function create()
    {
        $this->StockPesanan->insert([
            'NoPesanan'              => esc($this->request->getVar('NoPesanan')),
            'Tgl'                    => esc($this->request->getVar('Tgl')),
            'Gudang'                 => esc($this->request->getVar('Gudang')),
            'Keterangan'             => esc($this->request->getVar('Keterangan')),
            'TglUbah'                => esc($this->request->getVar('TglUbah')),
            'Username'               => esc($this->request->getVar('Username')),
        ]);

        $response = ['message' => 'success'];

        return $this->respondCreated($response);
    }

    //Update
    public function update($id = null)
    {
        $data = [
            'Tgl'                    => esc($this->request->getVar('Tgl')),
            'Gudang'                 => esc($this->request->getVar('Gudang')),
            'Keterangan'             => esc($this->request->getVar('Keterangan')),
            'TglUbah'                => esc($this->request->getVar('TglUbah')),
            'Username'               => esc($this->request->getVar('Username')),
        ];
        $result = $this->StockPesanan->where('md5(NoPesanan)', $id)->set($data)->update();


        $response = ['message' => 'success'];

        return $this->respond($response, 200);
    }

    //delete
    public function deletedata()
    {
        $id = $this->request->getVar('id');
        $this->StockPesanan->where('md5(NoPesanan)', $id)->delete();
        $response = ['message' => 'success'];
        return $this->respondDeleted($response);
    }
}
