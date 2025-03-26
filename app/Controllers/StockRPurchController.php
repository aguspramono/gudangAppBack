<?php

namespace App\Controllers;

require_once ROOTPATH . '/vendor/autoload.php';

use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;
use App\Models\StockRPurch;


class StockRPurchController extends ResourceController
{
    public function __construct()
    {
        header("Access-Control-Allow-Origin: *");
        //header("Access-Control-Allow-Methods: GET, POST, PUT, OPTIONS");
        header("Access-Control-Allow-Headers: X-Request-With");
        $this->StockRPurch = new StockRPurch();
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
            'countStockRPurch' => $this->StockRPurch->like('ReNum', $wherelike)->countAllResults()
        ];
        return $this->respond($data, 200);
    }

    //get all data StockLunasHutang
    public function allStockRPurch()
    {
        $data = [
            'message' => 'success',
            'dataStockRPurch' => $this->StockRPurch->findAll()
        ];

        return $this->respond($data, 200);
    }

    //get data by field No ACC
    public function getStockRPurchbyid()
    {
        $wherelike = $this->request->getVar('id');
        $data = [
            'message' => 'success',
            'dataStockRPurch' => $this->StockRPurch->where('md5(Renum)', md5($wherelike))->findAll()
        ];

        return $this->respond($data, 200);
    }


    //get data with filter field InvNum, drGudang. Show limit
    public function getStockRPurch()
    {
        $wherelike = $this->request->getVar('like');
        $pageprev = $this->request->getVar('pageprev');
        $page = $this->request->getVar('page');
        $data = [
            'message' => 'success',
            'dataStockRPurch' => $this->StockRPurch->like('ReNum', $wherelike)->limit(intval($page), intval($pageprev))->findAll()
        ];

        return $this->respond($data, 200);
    }


    //Insert
    public function create()
    {
        $this->StockRPurch->insert([
            'ReNum'                => esc($this->request->getVar('ReNum')),
            'Tgl'                   => esc($this->request->getVar('Tgl')),
            'sNoAcc'                => esc($this->request->getVar('sNoAcc')),
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
            'sNoAcc'                => esc($this->request->getVar('sNoAcc')),
            'Keterangan'            => esc($this->request->getVar('Keterangan')),
            'TglUbah'               => esc($this->request->getVar('TglUbah')),
            'Username'              => esc($this->request->getVar('Username')),
        ];
        $result = $this->StockRPurch->where('md5(ReNum)', $id)->set($data)->update();


        $response = ['message' => 'success'];

        return $this->respond($response, 200);
    }

    //delete
    public function deletedata()
    {
        $id = $this->request->getVar('id');
        $this->StockRPurch->where('md5(ReNum)', $id)->delete();
        $response = ['message' => 'success'];
        return $this->respondDeleted($response);
    }
}
